<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KasGereja extends Model
{
    protected $table      = 'custome__kas_gereja';
    protected $primaryKey = 'id_kas';
    protected $allowedFields = [
        'nama_kas', 'jenis_kas', 'saldo_awal', 'saldo_akhir', 'bank', 
        'no_rekening', 'atas_nama', 'keterangan', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua kas
    public function list()
    {
        return $this->orderBy('jenis_kas', 'ASC')
                    ->orderBy('nama_kas', 'ASC')
                    ->findAll();
    }

    // List kas aktif
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('jenis_kas', 'ASC')
                    ->orderBy('nama_kas', 'ASC')
                    ->findAll();
    }

    // Get untuk dropdown
    public function getDropdown()
    {
        $data = $this->listAktif();
        $dropdown = [];
        
        foreach ($data as $item) {
            $dropdown[$item['id_kas']] = $item['nama_kas'] . ' (' . number_format($item['saldo_akhir']) . ')';
        }
        
        return $dropdown;
    }

    // Update saldo kas
    public function updateSaldo($id_kas, $jumlah, $jenis_mutasi)
    {
        $kas = $this->find($id_kas);
        if (!$kas) {
            return false;
        }

        $saldo_baru = $kas['saldo_akhir'];
        
        if ($jenis_mutasi == 'Masuk') {
            $saldo_baru += $jumlah;
        } else {
            $saldo_baru -= $jumlah;
        }

        return $this->update($id_kas, ['saldo_akhir' => $saldo_baru]);
    }

    // Get total saldo semua kas
    public function getTotalSaldo()
    {
        return $this->selectSum('saldo_akhir')
                    ->where('status', 'Aktif')
                    ->first()['saldo_akhir'] ?? 0;
    }

    // Get saldo per jenis kas
    public function getSaldoPerJenis()
    {
        return $this->select('jenis_kas, SUM(saldo_akhir) as total_saldo')
                    ->where('status', 'Aktif')
                    ->groupBy('jenis_kas')
                    ->findAll();
    }

    // Toggle status
    public function toggleStatus($id)
    {
        $current = $this->find($id);
        $newStatus = ($current['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        return $this->update($id, ['status' => $newStatus]);
    }

    // Cek apakah kas sedang digunakan
    public function isUsed($id_kas)
    {
        $db = \Config\Database::connect();
        $count = $db->table('custome__mutasi_kas')
                   ->where('id_kas', $id_kas)
                   ->countAllResults();
        
        return $count > 0;
    }

    // Get kas utama
    public function getKasUtama()
    {
        return $this->where('jenis_kas', 'Kas Utama')
                    ->where('status', 'Aktif')
                    ->first();
    }

    // Rekonsiliasi saldo (hitung ulang dari mutasi)
    public function rekonsiliasi($id_kas)
    {
        $kas = $this->find($id_kas);
        if (!$kas) {
            return false;
        }

        $db = \Config\Database::connect();
        
        // Hitung total mutasi masuk
        $total_masuk = $db->table('custome__mutasi_kas')
                         ->selectSum('jumlah')
                         ->where('id_kas', $id_kas)
                         ->where('jenis_mutasi', 'Masuk')
                         ->get()
                         ->getRow()
                         ->jumlah ?? 0;

        // Hitung total mutasi keluar
        $total_keluar = $db->table('custome__mutasi_kas')
                          ->selectSum('jumlah')
                          ->where('id_kas', $id_kas)
                          ->where('jenis_mutasi', 'Keluar')
                          ->get()
                          ->getRow()
                          ->jumlah ?? 0;

        // Hitung saldo akhir
        $saldo_akhir = $kas['saldo_awal'] + $total_masuk - $total_keluar;

        // Update saldo akhir
        return $this->update($id_kas, ['saldo_akhir' => $saldo_akhir]);
    }

    // Get riwayat mutasi kas
    public function getRiwayatMutasi($id_kas, $limit = 10)
    {
        $db = \Config\Database::connect();
        
        return $db->table('custome__mutasi_kas m')
                 ->select('m.*, t.kode_transaksi, t.keterangan as keterangan_transaksi')
                 ->join('custome__transaksi_keuangan t', 't.id_transaksi = m.id_transaksi')
                 ->where('m.id_kas', $id_kas)
                 ->orderBy('m.tanggal_mutasi', 'DESC')
                 ->limit($limit)
                 ->get()
                 ->getResultArray();
    }
}
