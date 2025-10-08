<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KategoriAset extends Model
{
    protected $table = 'custome__kategori_aset';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = [
        'kode_kategori', 'nama_kategori', 'parent_id', 'deskripsi', 'icon', 
        'warna', 'masa_pakai', 'metode_depreciation', 'status', 'urutan'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua kategori dengan hierarki
    public function list()
    {
        return $this->select('custome__kategori_aset.*, 
                            parent.nama_kategori as parent_nama')
                    ->join('custome__kategori_aset parent', 'parent.id_kategori = custome__kategori_aset.parent_id', 'left')
                    ->orderBy('custome__kategori_aset.urutan', 'ASC')
                    ->orderBy('custome__kategori_aset.nama_kategori', 'ASC')
                    ->findAll();
    }

    // List kategori aktif untuk dropdown
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('urutan', 'ASC')
                    ->orderBy('nama_kategori', 'ASC')
                    ->findAll();
    }

    // Get kategori parent (level 1)
    public function getParentKategori()
    {
        return $this->where('parent_id IS NULL')
                    ->where('status', 'Aktif')
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get sub kategori berdasarkan parent
    public function getSubKategori($parent_id)
    {
        return $this->where('parent_id', $parent_id)
                    ->where('status', 'Aktif')
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get kategori dengan jumlah aset
    public function getKategoriWithCount()
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT k.*, 
                   COUNT(a.id_aset) as jumlah_aset,
                   SUM(CASE WHEN a.status = 'Aktif' THEN 1 ELSE 0 END) as aset_aktif,
                   SUM(a.harga_perolehan) as total_nilai
            FROM custome__kategori_aset k
            LEFT JOIN custome__aset_gereja a ON a.id_kategori = k.id_kategori
            GROUP BY k.id_kategori
            ORDER BY k.urutan ASC, k.nama_kategori ASC
        ")->getResultArray();
    }

    // Generate kode kategori otomatis
    public function generateKodeKategori()
    {
        // Ambil 4 huruf pertama dari nama kategori yang akan dibuat
        // Untuk sementara return format default
        $lastCode = $this->select('kode_kategori')
                         ->orderBy('id_kategori', 'DESC')
                         ->first();
        
        if ($lastCode) {
            $lastNumber = (int) filter_var($lastCode['kode_kategori'], FILTER_SANITIZE_NUMBER_INT);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return 'KAT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Toggle status kategori
    public function toggleStatus($id_kategori)
    {
        $kategori = $this->find($id_kategori);
        $newStatus = ($kategori['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        
        return $this->update($id_kategori, ['status' => $newStatus]);
    }

    // Check apakah kategori digunakan oleh aset
    public function isUsedByAset($id_kategori)
    {
        $db = \Config\Database::connect();
        $result = $db->table('custome__aset_gereja')
                     ->where('id_kategori', $id_kategori)
                     ->countAllResults();
        
        return $result > 0;
    }

    // Update urutan kategori
    public function updateUrutan($id_kategori, $urutan)
    {
        return $this->update($id_kategori, ['urutan' => $urutan]);
    }

    // Get dropdown options untuk form
    public function getDropdownOptions()
    {
        $categories = $this->listAktif();
        $options = [];
        
        foreach ($categories as $category) {
            $prefix = $category['parent_id'] ? '-- ' : '';
            $options[$category['id_kategori']] = $prefix . $category['nama_kategori'];
        }
        
        return $options;
    }

    // Get kategori tree structure
    public function getKategoriTree()
    {
        $allCategories = $this->list();
        $tree = [];
        
        // Build tree structure
        foreach ($allCategories as $category) {
            if ($category['parent_id'] == null) {
                $tree[$category['id_kategori']] = $category;
                $tree[$category['id_kategori']]['children'] = [];
            }
        }
        
        foreach ($allCategories as $category) {
            if ($category['parent_id'] != null && isset($tree[$category['parent_id']])) {
                $tree[$category['parent_id']]['children'][] = $category;
            }
        }
        
        return array_values($tree);
    }

    // Check duplicate kode kategori
    public function checkDuplicateKode($kode_kategori, $id_kategori = null)
    {
        $builder = $this->where('kode_kategori', $kode_kategori);
        if ($id_kategori) {
            $builder->where('id_kategori !=', $id_kategori);
        }
        return $builder->countAllResults() > 0;
    }

    // Get kategori by kode
    public function getByKode($kode_kategori)
    {
        return $this->where('kode_kategori', $kode_kategori)->first();
    }

    // Set default masa pakai dan metode depreciation
    public function setDefaultDepreciation($id_kategori, $masa_pakai, $metode)
    {
        return $this->update($id_kategori, [
            'masa_pakai' => $masa_pakai,
            'metode_depreciation' => $metode
        ]);
    }

    // Get statistik kategori
    public function getStatistikKategori()
    {
        $total = $this->countAll();
        $aktif = $this->where('status', 'Aktif')->countAllResults(false);
        $parent = $this->where('parent_id IS NULL')->countAllResults(false);
        $child = $this->where('parent_id IS NOT NULL')->countAllResults();
        
        return [
            'total_kategori' => $total,
            'kategori_aktif' => $aktif,
            'kategori_parent' => $parent,
            'kategori_child' => $child
        ];
    }
}
