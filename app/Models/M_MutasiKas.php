<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MutasiKas extends Model
{
    protected $table      = 'custome__mutasi_kas';
    protected $primaryKey = 'id_mutasi';
    protected $allowedFields = [
        'id_kas', 'id_transaksi', 'tanggal_mutasi', 'jenis_mutasi',
        'jumlah', 'saldo_sebelum', 'saldo_sesudah', 'keterangan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Catat mutasi kas
    public function catatMutasi($id_kas, $id_transaksi, $jenis_mutasi, $jumlah, $keterangan = null)
    {
        // Get saldo kas saat ini
        $kasModel = new M_KasGereja();
        $kas = $kasModel->find($id_kas);
        
        if (!$kas) {
            return false;
        }

        $saldo_sebelum = $kas['saldo_akhir'];
        
        // Hitung saldo sesudah
        if ($jenis_mutasi == 'Masuk') {
            $saldo_sesudah = $saldo_sebelum + $jumlah;
        } else {
            $saldo_sesudah = $saldo_sebelum - $jumlah;
        }

        // Insert mutasi
        $data_mutasi = [
            'id_kas' => $id_kas,
            'id_transaksi' => $id_transaksi,
            'tanggal_mutasi' => date('Y-m-d H:i:s'),
            'jenis_mutasi' => $jenis_mutasi,
            'jumlah' => $jumlah,
            'saldo_sebelum' => $saldo_sebelum,
            'saldo_sesudah' => $saldo_sesudah,
            'keterangan' => $keterangan
        ];

        $result = $this->insert($data_mutasi);

        if ($result) {
            // Update saldo kas
            $kasModel->update($id_kas, ['saldo_akhir' => $saldo_sesudah]);
        }

        return $result;
    }

    // List mutasi dengan join kas dan transaksi
    public function listMutasi($id_kas = null, $limit = null)
    {
        $builder = $this->select('
            custome__mutasi_kas.*,
            custome__kas_gereja.nama_kas,
            custome__transaksi_keuangan.kode_transaksi,
            custome__transaksi_keuangan.keterangan as keterangan_transaksi
        ')
        ->join('custome__kas_gereja', 'custome__kas_gereja.id_kas = custome__mutasi_kas.id_kas')
        ->join('custome__transaksi_keuangan', 'custome__transaksi_keuangan.id_transaksi = custome__mutasi_kas.id_transaksi')
        ->orderBy('tanggal_mutasi', 'DESC');

        if ($id_kas) {
            $builder->where('custome__mutasi_kas.id_kas', $id_kas);
        }

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    // Get mutasi berdasarkan periode
    public function getMutasiPeriode($tanggal_mulai, $tanggal_selesai, $id_kas = null)
    {
        $builder = $this->select('
            custome__mutasi_kas.*,
            custome__kas_gereja.nama_kas,
            custome__transaksi_keuangan.kode_transaksi,
            custome__transaksi_keuangan.keterangan as keterangan_transaksi
        ')
        ->join('custome__kas_gereja', 'custome__kas_gereja.id_kas = custome__mutasi_kas.id_kas')
        ->join('custome__transaksi_keuangan', 'custome__transaksi_keuangan.id_transaksi = custome__mutasi_kas.id_transaksi')
        ->where('DATE(tanggal_mutasi) >=', $tanggal_mulai)
        ->where('DATE(tanggal_mutasi) <=', $tanggal_selesai)
        ->orderBy('tanggal_mutasi', 'DESC');

        if ($id_kas) {
            $builder->where('custome__mutasi_kas.id_kas', $id_kas);
        }

        return $builder->findAll();
    }

    // Statistik mutasi
    public function getStatistikMutasi($periode = 'bulan_ini')
    {
        $today = date('Y-m-d');
        $thisMonth = date('Y-m');
        $thisYear = date('Y');

        switch ($periode) {
            case 'hari_ini':
                $where = "DATE(tanggal_mutasi) = '$today'";
                break;
            case 'bulan_ini':
                $where = "DATE_FORMAT(tanggal_mutasi, '%Y-%m') = '$thisMonth'";
                break;
            case 'tahun_ini':
                $where = "YEAR(tanggal_mutasi) = '$thisYear'";
                break;
            default:
                $where = "DATE_FORMAT(tanggal_mutasi, '%Y-%m') = '$thisMonth'";
        }

        // Total mutasi masuk
        $total_masuk = $this->selectSum('jumlah')
                           ->where('jenis_mutasi', 'Masuk')
                           ->where($where)
                           ->first()['jumlah'] ?? 0;

        // Total mutasi keluar
        $total_keluar = $this->selectSum('jumlah')
                            ->where('jenis_mutasi', 'Keluar')
                            ->where($where)
                            ->first()['jumlah'] ?? 0;

        // Jumlah transaksi
        $jumlah_transaksi = $this->where($where)->countAllResults();

        return [
            'total_masuk' => $total_masuk,
            'total_keluar' => $total_keluar,
            'selisih' => $total_masuk - $total_keluar,
            'jumlah_transaksi' => $jumlah_transaksi
        ];
    }

    // Hapus mutasi (untuk rollback)
    public function hapusMutasi($id_transaksi)
    {
        // Get mutasi yang akan dihapus
        $mutasi = $this->where('id_transaksi', $id_transaksi)->findAll();
        
        if (empty($mutasi)) {
            return true; // Tidak ada mutasi untuk dihapus
        }

        $kasModel = new M_KasGereja();
        
        foreach ($mutasi as $m) {
            // Rollback saldo kas
            $kas = $kasModel->find($m['id_kas']);
            if ($kas) {
                $saldo_rollback = $m['saldo_sebelum'];
                $kasModel->update($m['id_kas'], ['saldo_akhir' => $saldo_rollback]);
            }
        }

        // Hapus mutasi
        return $this->where('id_transaksi', $id_transaksi)->delete();
    }

    // Get saldo kas pada tanggal tertentu
    public function getSaldoPadaTanggal($id_kas, $tanggal)
    {
        $kasModel = new M_KasGereja();
        $kas = $kasModel->find($id_kas);
        
        if (!$kas) {
            return 0;
        }

        // Hitung mutasi sampai tanggal tersebut
        $total_masuk = $this->selectSum('jumlah')
                           ->where('id_kas', $id_kas)
                           ->where('jenis_mutasi', 'Masuk')
                           ->where('DATE(tanggal_mutasi) <=', $tanggal)
                           ->first()['jumlah'] ?? 0;

        $total_keluar = $this->selectSum('jumlah')
                            ->where('id_kas', $id_kas)
                            ->where('jenis_mutasi', 'Keluar')
                            ->where('DATE(tanggal_mutasi) <=', $tanggal)
                            ->first()['jumlah'] ?? 0;

        return $kas['saldo_awal'] + $total_masuk - $total_keluar;
    }

    // Grafik mutasi kas harian
    public function getGrafikHarian($id_kas, $tanggal_mulai, $tanggal_selesai)
    {
        $data = [];
        $current_date = strtotime($tanggal_mulai);
        $end_date = strtotime($tanggal_selesai);

        while ($current_date <= $end_date) {
            $tanggal = date('Y-m-d', $current_date);
            
            $masuk = $this->selectSum('jumlah')
                         ->where('id_kas', $id_kas)
                         ->where('jenis_mutasi', 'Masuk')
                         ->where('DATE(tanggal_mutasi)', $tanggal)
                         ->first()['jumlah'] ?? 0;

            $keluar = $this->selectSum('jumlah')
                          ->where('id_kas', $id_kas)
                          ->where('jenis_mutasi', 'Keluar')
                          ->where('DATE(tanggal_mutasi)', $tanggal)
                          ->first()['jumlah'] ?? 0;

            $data[] = [
                'tanggal' => $tanggal,
                'masuk' => (float) $masuk,
                'keluar' => (float) $keluar,
                'selisih' => (float) ($masuk - $keluar)
            ];

            $current_date = strtotime('+1 day', $current_date);
        }

        return $data;
    }
}
