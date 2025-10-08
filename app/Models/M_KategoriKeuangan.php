<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KategoriKeuangan extends Model
{
    protected $table      = 'custome__kategori_keuangan';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = [
        'nama_kategori', 'jenis', 'deskripsi', 'warna', 'is_default', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua kategori
    public function list()
    {
        return $this->orderBy('jenis', 'ASC')
                    ->orderBy('nama_kategori', 'ASC')
                    ->findAll();
    }

    // List kategori aktif
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('jenis', 'ASC')
                    ->orderBy('nama_kategori', 'ASC')
                    ->findAll();
    }

    // List kategori berdasarkan jenis
    public function listByJenis($jenis)
    {
        return $this->where('jenis', $jenis)
                    ->where('status', 'Aktif')
                    ->orderBy('nama_kategori', 'ASC')
                    ->findAll();
    }

    // Get untuk dropdown
    public function getDropdown($jenis = null)
    {
        $builder = $this->where('status', 'Aktif');
        
        if ($jenis) {
            $builder->where('jenis', $jenis);
        }
        
        $data = $builder->orderBy('nama_kategori', 'ASC')->findAll();
        $dropdown = [];
        
        foreach ($data as $item) {
            $dropdown[$item['id_kategori']] = $item['nama_kategori'];
        }
        
        return $dropdown;
    }

    // Get dropdown grouped by jenis
    public function getDropdownGrouped()
    {
        $data = $this->listAktif();
        $grouped = [];
        
        foreach ($data as $item) {
            $grouped[$item['jenis']][$item['id_kategori']] = $item['nama_kategori'];
        }
        
        return $grouped;
    }

    // Toggle status
    public function toggleStatus($id)
    {
        $current = $this->find($id);
        $newStatus = ($current['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        return $this->update($id, ['status' => $newStatus]);
    }

    // Cek apakah kategori sedang digunakan
    public function isUsed($id_kategori)
    {
        $db = \Config\Database::connect();
        $count = $db->table('custome__transaksi_keuangan')
                   ->where('id_kategori', $id_kategori)
                   ->countAllResults();
        
        return $count > 0;
    }

    // Get kategori default
    public function getDefault($jenis)
    {
        return $this->where('jenis', $jenis)
                    ->where('is_default', 1)
                    ->where('status', 'Aktif')
                    ->first();
    }

    // Set kategori sebagai default
    public function setDefault($id_kategori)
    {
        $kategori = $this->find($id_kategori);
        if (!$kategori) {
            return false;
        }

        // Reset semua default untuk jenis yang sama
        $this->where('jenis', $kategori['jenis'])
             ->set(['is_default' => 0])
             ->update();

        // Set kategori ini sebagai default
        return $this->update($id_kategori, ['is_default' => 1]);
    }

    // Statistik penggunaan kategori
    public function getStatistikPenggunaan()
    {
        $db = \Config\Database::connect();
        
        return $db->table('custome__kategori_keuangan k')
                 ->select('k.*, COUNT(t.id_transaksi) as jumlah_transaksi, SUM(t.jumlah) as total_nominal')
                 ->join('custome__transaksi_keuangan t', 't.id_kategori = k.id_kategori', 'left')
                 ->where('t.status', 'Disetujui')
                 ->groupBy('k.id_kategori')
                 ->orderBy('total_nominal', 'DESC')
                 ->get()
                 ->getResultArray();
    }
}
