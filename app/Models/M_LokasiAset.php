<?php

namespace App\Models;

use CodeIgniter\Model;

class M_LokasiAset extends Model
{
    protected $table = 'custome__lokasi_aset';
    protected $primaryKey = 'id_lokasi';
    protected $allowedFields = [
        'kode_lokasi', 'nama_lokasi', 'jenis_lokasi', 'parent_id', 
        'deskripsi', 'kapasitas', 'penanggung_jawab', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua lokasi dengan hierarki
    public function list()
    {
        return $this->select('custome__lokasi_aset.*, 
                            parent.nama_lokasi as parent_nama')
                    ->join('custome__lokasi_aset parent', 'parent.id_lokasi = custome__lokasi_aset.parent_id', 'left')
                    ->orderBy('custome__lokasi_aset.jenis_lokasi', 'ASC')
                    ->orderBy('custome__lokasi_aset.nama_lokasi', 'ASC')
                    ->findAll();
    }

    // List lokasi aktif untuk dropdown
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('jenis_lokasi', 'ASC')
                    ->orderBy('nama_lokasi', 'ASC')
                    ->findAll();
    }

    // Get lokasi berdasarkan jenis
    public function getByJenis($jenis_lokasi)
    {
        return $this->where('jenis_lokasi', $jenis_lokasi)
                    ->where('status', 'Aktif')
                    ->orderBy('nama_lokasi', 'ASC')
                    ->findAll();
    }

    // Get gedung (parent locations)
    public function getGedung()
    {
        return $this->where('jenis_lokasi', 'Gedung')
                    ->where('status', 'Aktif')
                    ->orderBy('nama_lokasi', 'ASC')
                    ->findAll();
    }

    // Get ruangan berdasarkan gedung
    public function getRuanganByGedung($id_gedung)
    {
        return $this->where('parent_id', $id_gedung)
                    ->where('status', 'Aktif')
                    ->orderBy('nama_lokasi', 'ASC')
                    ->findAll();
    }

    // Get lokasi dengan jumlah aset
    public function getLokasiWithCount()
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT l.*, 
                   COUNT(a.id_aset) as jumlah_aset,
                   SUM(CASE WHEN a.status = 'Aktif' THEN 1 ELSE 0 END) as aset_aktif,
                   SUM(a.harga_perolehan) as total_nilai
            FROM custome__lokasi_aset l
            LEFT JOIN custome__aset_gereja a ON a.id_lokasi = l.id_lokasi
            GROUP BY l.id_lokasi
            ORDER BY l.jenis_lokasi ASC, l.nama_lokasi ASC
        ")->getResultArray();
    }

    // Generate kode lokasi otomatis
    public function generateKodeLokasi($jenis_lokasi)
    {
        $prefix = '';
        switch ($jenis_lokasi) {
            case 'Gedung':
                $prefix = 'GU';
                break;
            case 'Ruangan':
                $prefix = 'RU';
                break;
            case 'Area':
                $prefix = 'AR';
                break;
            case 'Lantai':
                $prefix = 'LT';
                break;
            default:
                $prefix = 'LK';
        }
        
        // Cari kode terakhir dengan prefix yang sama
        $lastCode = $this->select('kode_lokasi')
                         ->like('kode_lokasi', $prefix, 'after')
                         ->orderBy('kode_lokasi', 'DESC')
                         ->first();
        
        if ($lastCode) {
            $lastNumber = (int) substr($lastCode['kode_lokasi'], 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }

    // Toggle status lokasi
    public function toggleStatus($id_lokasi)
    {
        $lokasi = $this->find($id_lokasi);
        $newStatus = ($lokasi['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        
        return $this->update($id_lokasi, ['status' => $newStatus]);
    }

    // Check apakah lokasi digunakan oleh aset
    public function isUsedByAset($id_lokasi)
    {
        $db = \Config\Database::connect();
        $result = $db->table('custome__aset_gereja')
                     ->where('id_lokasi', $id_lokasi)
                     ->countAllResults();
        
        return $result > 0;
    }

    // Get dropdown options untuk form
    public function getDropdownOptions()
    {
        $locations = $this->listAktif();
        $options = [];
        
        foreach ($locations as $location) {
            $prefix = '';
            if ($location['jenis_lokasi'] == 'Ruangan' && $location['parent_id']) {
                $prefix = '-- ';
            }
            $options[$location['id_lokasi']] = $prefix . $location['nama_lokasi'] . ' (' . $location['jenis_lokasi'] . ')';
        }
        
        return $options;
    }

    // Get lokasi tree structure
    public function getLokasiTree()
    {
        $allLocations = $this->list();
        $tree = [];
        
        // Build tree structure
        foreach ($allLocations as $location) {
            if ($location['parent_id'] == null) {
                $tree[$location['id_lokasi']] = $location;
                $tree[$location['id_lokasi']]['children'] = [];
            }
        }
        
        foreach ($allLocations as $location) {
            if ($location['parent_id'] != null && isset($tree[$location['parent_id']])) {
                $tree[$location['parent_id']]['children'][] = $location;
            }
        }
        
        return array_values($tree);
    }

    // Check duplicate kode lokasi
    public function checkDuplicateKode($kode_lokasi, $id_lokasi = null)
    {
        $builder = $this->where('kode_lokasi', $kode_lokasi);
        if ($id_lokasi) {
            $builder->where('id_lokasi !=', $id_lokasi);
        }
        return $builder->countAllResults() > 0;
    }

    // Get lokasi by kode
    public function getByKode($kode_lokasi)
    {
        return $this->where('kode_lokasi', $kode_lokasi)->first();
    }

    // Update penanggung jawab
    public function updatePenanggungJawab($id_lokasi, $penanggung_jawab)
    {
        return $this->update($id_lokasi, ['penanggung_jawab' => $penanggung_jawab]);
    }

    // Get statistik lokasi
    public function getStatistikLokasi()
    {
        $total = $this->countAll();
        $aktif = $this->where('status', 'Aktif')->countAllResults(false);
        $gedung = $this->where('jenis_lokasi', 'Gedung')->countAllResults(false);
        $ruangan = $this->where('jenis_lokasi', 'Ruangan')->countAllResults(false);
        $area = $this->where('jenis_lokasi', 'Area')->countAllResults(false);
        $lantai = $this->where('jenis_lokasi', 'Lantai')->countAllResults();
        
        return [
            'total_lokasi' => $total,
            'lokasi_aktif' => $aktif,
            'total_gedung' => $gedung,
            'total_ruangan' => $ruangan,
            'total_area' => $area,
            'total_lantai' => $lantai
        ];
    }

    // Search lokasi
    public function searchLokasi($keyword)
    {
        return $this->select('custome__lokasi_aset.*, 
                            parent.nama_lokasi as parent_nama')
                    ->join('custome__lokasi_aset parent', 'parent.id_lokasi = custome__lokasi_aset.parent_id', 'left')
                    ->groupStart()
                        ->like('custome__lokasi_aset.kode_lokasi', $keyword)
                        ->orLike('custome__lokasi_aset.nama_lokasi', $keyword)
                        ->orLike('custome__lokasi_aset.penanggung_jawab', $keyword)
                        ->orLike('custome__lokasi_aset.deskripsi', $keyword)
                    ->groupEnd()
                    ->orderBy('custome__lokasi_aset.nama_lokasi', 'ASC')
                    ->findAll();
    }

    // Get lokasi dengan kapasitas terbesar
    public function getTopLokasiByKapasitas($limit = 5)
    {
        return $this->where('kapasitas IS NOT NULL')
                    ->where('kapasitas > 0')
                    ->orderBy('kapasitas', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
