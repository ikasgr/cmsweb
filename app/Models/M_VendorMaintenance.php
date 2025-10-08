<?php

namespace App\Models;

use CodeIgniter\Model;

class M_VendorMaintenance extends Model
{
    protected $table = 'custome__vendor_maintenance';
    protected $primaryKey = 'id_vendor';
    protected $allowedFields = [
        'kode_vendor', 'nama_vendor', 'jenis_vendor', 'alamat', 'telepon', 
        'email', 'contact_person', 'spesialisasi', 'rating', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua vendor
    public function list()
    {
        return $this->orderBy('nama_vendor', 'ASC')->findAll();
    }

    // List vendor aktif untuk dropdown
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('nama_vendor', 'ASC')
                    ->findAll();
    }

    // Get vendor berdasarkan jenis
    public function getByJenis($jenis_vendor)
    {
        return $this->where('jenis_vendor', $jenis_vendor)
                    ->where('status', 'Aktif')
                    ->orderBy('rating', 'DESC')
                    ->orderBy('nama_vendor', 'ASC')
                    ->findAll();
    }

    // Get vendor dengan statistik maintenance
    public function getVendorWithStats()
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT v.*, 
                   COUNT(m.id_maintenance) as total_maintenance,
                   COUNT(p.id_perbaikan) as total_perbaikan,
                   AVG(CASE WHEN m.status = 'Selesai' THEN 
                       DATEDIFF(m.tanggal_selesai, m.tanggal_jadwal) 
                   END) as avg_durasi_maintenance,
                   SUM(m.biaya_aktual) as total_biaya_maintenance,
                   SUM(p.total_biaya) as total_biaya_perbaikan
            FROM custome__vendor_maintenance v
            LEFT JOIN custome__maintenance_aset m ON m.id_vendor = v.id_vendor
            LEFT JOIN custome__perbaikan_aset p ON p.id_vendor = v.id_vendor
            GROUP BY v.id_vendor
            ORDER BY v.rating DESC, v.nama_vendor ASC
        ")->getResultArray();
    }

    // Generate kode vendor otomatis
    public function generateKodeVendor()
    {
        $prefix = 'VEN';
        
        // Cari kode terakhir
        $lastCode = $this->select('kode_vendor')
                         ->like('kode_vendor', $prefix, 'after')
                         ->orderBy('kode_vendor', 'DESC')
                         ->first();
        
        if ($lastCode) {
            $lastNumber = (int) substr($lastCode['kode_vendor'], 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Toggle status vendor
    public function toggleStatus($id_vendor)
    {
        $vendor = $this->find($id_vendor);
        $newStatus = ($vendor['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        
        return $this->update($id_vendor, ['status' => $newStatus]);
    }

    // Update rating vendor
    public function updateRating($id_vendor, $rating)
    {
        return $this->update($id_vendor, ['rating' => $rating]);
    }

    // Get dropdown options untuk form
    public function getDropdownOptions($jenis_vendor = null)
    {
        $builder = $this->where('status', 'Aktif');
        
        if ($jenis_vendor) {
            $builder->where('jenis_vendor', $jenis_vendor);
        }
        
        $vendors = $builder->orderBy('nama_vendor', 'ASC')->findAll();
        $options = [];
        
        foreach ($vendors as $vendor) {
            $options[$vendor['id_vendor']] = $vendor['nama_vendor'] . ' (' . $vendor['jenis_vendor'] . ')';
        }
        
        return $options;
    }

    // Search vendor
    public function searchVendor($keyword)
    {
        return $this->groupStart()
                        ->like('kode_vendor', $keyword)
                        ->orLike('nama_vendor', $keyword)
                        ->orLike('jenis_vendor', $keyword)
                        ->orLike('contact_person', $keyword)
                        ->orLike('spesialisasi', $keyword)
                        ->orLike('telepon', $keyword)
                        ->orLike('email', $keyword)
                    ->groupEnd()
                    ->orderBy('nama_vendor', 'ASC')
                    ->findAll();
    }

    // Check duplicate kode vendor
    public function checkDuplicateKode($kode_vendor, $id_vendor = null)
    {
        $builder = $this->where('kode_vendor', $kode_vendor);
        if ($id_vendor) {
            $builder->where('id_vendor !=', $id_vendor);
        }
        return $builder->countAllResults() > 0;
    }

    // Check duplicate email
    public function checkDuplicateEmail($email, $id_vendor = null)
    {
        if (empty($email)) return false;
        
        $builder = $this->where('email', $email);
        if ($id_vendor) {
            $builder->where('id_vendor !=', $id_vendor);
        }
        return $builder->countAllResults() > 0;
    }

    // Get vendor by kode
    public function getByKode($kode_vendor)
    {
        return $this->where('kode_vendor', $kode_vendor)->first();
    }

    // Get top vendor berdasarkan rating
    public function getTopVendorByRating($limit = 5)
    {
        return $this->where('status', 'Aktif')
                    ->where('rating > 0')
                    ->orderBy('rating', 'DESC')
                    ->orderBy('nama_vendor', 'ASC')
                    ->limit($limit)
                    ->findAll();
    }

    // Get vendor berdasarkan spesialisasi
    public function getBySpesialisasi($spesialisasi)
    {
        return $this->where('status', 'Aktif')
                    ->like('spesialisasi', $spesialisasi)
                    ->orderBy('rating', 'DESC')
                    ->findAll();
    }

    // Get statistik vendor
    public function getStatistikVendor()
    {
        $total = $this->countAll();
        $aktif = $this->where('status', 'Aktif')->countAllResults(false);
        $supplier = $this->where('jenis_vendor', 'Supplier')->countAllResults(false);
        $maintenance = $this->where('jenis_vendor', 'Maintenance')->countAllResults(false);
        $repair = $this->where('jenis_vendor', 'Repair')->countAllResults(false);
        $insurance = $this->where('jenis_vendor', 'Insurance')->countAllResults();
        
        // Average rating
        $avgRating = $this->selectAvg('rating')->where('status', 'Aktif')->first();
        
        return [
            'total_vendor' => $total,
            'vendor_aktif' => $aktif,
            'total_supplier' => $supplier,
            'total_maintenance' => $maintenance,
            'total_repair' => $repair,
            'total_insurance' => $insurance,
            'average_rating' => round($avgRating['rating'] ?? 0, 1)
        ];
    }

    // Calculate rating berdasarkan performa
    public function calculatePerformaRating($id_vendor)
    {
        $db = \Config\Database::connect();
        
        // Hitung rating berdasarkan:
        // 1. Ketepatan waktu maintenance
        // 2. Kualitas perbaikan (berapa lama aset bertahan setelah diperbaiki)
        // 3. Biaya vs estimasi
        
        $result = $db->query("
            SELECT 
                COUNT(m.id_maintenance) as total_maintenance,
                AVG(CASE 
                    WHEN m.tanggal_selesai <= m.tanggal_jadwal THEN 5
                    WHEN DATEDIFF(m.tanggal_selesai, m.tanggal_jadwal) <= 3 THEN 4
                    WHEN DATEDIFF(m.tanggal_selesai, m.tanggal_jadwal) <= 7 THEN 3
                    ELSE 2
                END) as rating_ketepatan,
                AVG(CASE 
                    WHEN m.biaya_aktual <= m.biaya_estimasi THEN 5
                    WHEN m.biaya_aktual <= (m.biaya_estimasi * 1.1) THEN 4
                    WHEN m.biaya_aktual <= (m.biaya_estimasi * 1.2) THEN 3
                    ELSE 2
                END) as rating_biaya
            FROM custome__maintenance_aset m
            WHERE m.id_vendor = ? AND m.status = 'Selesai'
        ", [$id_vendor])->getRowArray();
        
        if ($result && $result['total_maintenance'] > 0) {
            $finalRating = ($result['rating_ketepatan'] + $result['rating_biaya']) / 2;
            $this->updateRating($id_vendor, round($finalRating, 1));
            return round($finalRating, 1);
        }
        
        return 0;
    }

    // Get vendor performance report
    public function getPerformanceReport($id_vendor)
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                v.nama_vendor,
                COUNT(m.id_maintenance) as total_maintenance,
                COUNT(p.id_perbaikan) as total_perbaikan,
                AVG(CASE WHEN m.status = 'Selesai' THEN 
                    DATEDIFF(m.tanggal_selesai, m.tanggal_jadwal) 
                END) as avg_keterlambatan,
                SUM(m.biaya_aktual) as total_biaya_maintenance,
                SUM(p.total_biaya) as total_biaya_perbaikan,
                COUNT(CASE WHEN m.tanggal_selesai <= m.tanggal_jadwal THEN 1 END) as maintenance_tepat_waktu,
                COUNT(CASE WHEN m.biaya_aktual <= m.biaya_estimasi THEN 1 END) as maintenance_sesuai_budget
            FROM custome__vendor_maintenance v
            LEFT JOIN custome__maintenance_aset m ON m.id_vendor = v.id_vendor
            LEFT JOIN custome__perbaikan_aset p ON p.id_vendor = v.id_vendor
            WHERE v.id_vendor = ?
            GROUP BY v.id_vendor
        ", [$id_vendor])->getRowArray();
    }
}
