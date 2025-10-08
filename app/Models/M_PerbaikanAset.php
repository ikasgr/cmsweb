<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PerbaikanAset extends Model
{
    protected $table = 'custome__perbaikan_aset';
    protected $primaryKey = 'id_perbaikan';
    protected $allowedFields = [
        'kode_perbaikan', 'id_aset', 'tanggal_laporan', 'tanggal_perbaikan', 
        'jenis_kerusakan', 'deskripsi_kerusakan', 'penyebab_kerusakan', 
        'tindakan_perbaikan', 'spare_part', 'id_vendor', 'teknisi', 
        'biaya_perbaikan', 'biaya_spare_part', 'total_biaya', 'status', 
        'kondisi_setelah', 'garansi_perbaikan', 'foto_kerusakan', 
        'foto_perbaikan', 'keterangan', 'created_by', 'updated_by'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua perbaikan dengan join
    public function list()
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor,
                            users.fullname as created_by_name')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__perbaikan_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__perbaikan_aset.created_by', 'left')
                    ->orderBy('custome__perbaikan_aset.tanggal_laporan', 'DESC')
                    ->findAll();
    }

    // Get perbaikan by ID dengan join lengkap
    public function getPerbaikanById($id_perbaikan)
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset, custome__aset_gereja.merk, custome__aset_gereja.model,
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor, custome__vendor_maintenance.telepon as vendor_telepon,
                            users.fullname as created_by_name')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__perbaikan_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__perbaikan_aset.created_by', 'left')
                    ->where('custome__perbaikan_aset.id_perbaikan', $id_perbaikan)
                    ->first();
    }

    // Generate kode perbaikan otomatis
    public function generateKodePerbaikan()
    {
        $prefix = 'RPR';
        $date = date('Ymd');
        
        // Cari kode terakhir hari ini
        $lastCode = $this->select('kode_perbaikan')
                         ->like('kode_perbaikan', $prefix . $date, 'after')
                         ->orderBy('kode_perbaikan', 'DESC')
                         ->first();
        
        if ($lastCode) {
            $lastNumber = (int) substr($lastCode['kode_perbaikan'], -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Get perbaikan berdasarkan aset
    public function getByAset($id_aset)
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__vendor_maintenance.nama_vendor,
                            users.fullname as created_by_name')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__perbaikan_aset.created_by', 'left')
                    ->where('custome__perbaikan_aset.id_aset', $id_aset)
                    ->orderBy('custome__perbaikan_aset.tanggal_laporan', 'DESC')
                    ->findAll();
    }

    // Get perbaikan berdasarkan status
    public function getByStatus($status)
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__perbaikan_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->where('custome__perbaikan_aset.status', $status)
                    ->orderBy('custome__perbaikan_aset.tanggal_laporan', 'DESC')
                    ->findAll();
    }

    // Get perbaikan berdasarkan periode
    public function getByPeriode($start_date, $end_date)
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__perbaikan_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->where('custome__perbaikan_aset.tanggal_laporan >=', $start_date)
                    ->where('custome__perbaikan_aset.tanggal_laporan <=', $end_date)
                    ->orderBy('custome__perbaikan_aset.tanggal_laporan', 'DESC')
                    ->findAll();
    }

    // Search perbaikan
    public function searchPerbaikan($keyword)
    {
        return $this->select('custome__perbaikan_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__perbaikan_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__perbaikan_aset.id_vendor', 'left')
                    ->groupStart()
                        ->like('custome__perbaikan_aset.kode_perbaikan', $keyword)
                        ->orLike('custome__aset_gereja.kode_aset', $keyword)
                        ->orLike('custome__aset_gereja.nama_aset', $keyword)
                        ->orLike('custome__perbaikan_aset.jenis_kerusakan', $keyword)
                        ->orLike('custome__perbaikan_aset.teknisi', $keyword)
                        ->orLike('custome__vendor_maintenance.nama_vendor', $keyword)
                    ->groupEnd()
                    ->orderBy('custome__perbaikan_aset.tanggal_laporan', 'DESC')
                    ->findAll();
    }

    // Get statistik perbaikan
    public function getStatistik()
    {
        $total = $this->countAll();
        $dilaporkan = $this->where('status', 'Dilaporkan')->countAllResults(false);
        $sedang_diperbaiki = $this->where('status', 'Sedang Diperbaiki')->countAllResults(false);
        $selesai = $this->where('status', 'Selesai')->countAllResults(false);
        $tidak_dapat_diperbaiki = $this->where('status', 'Tidak Dapat Diperbaiki')->countAllResults();
        
        // Total biaya perbaikan
        $totalBiaya = $this->selectSum('total_biaya')->where('status', 'Selesai')->first();
        
        return [
            'total_perbaikan' => $total,
            'dilaporkan' => $dilaporkan,
            'sedang_diperbaiki' => $sedang_diperbaiki,
            'selesai' => $selesai,
            'tidak_dapat_diperbaiki' => $tidak_dapat_diperbaiki,
            'total_biaya' => $totalBiaya['total_biaya'] ?? 0
        ];
    }

    // Get perbaikan per jenis kerusakan untuk chart
    public function getPerbaikanPerJenis()
    {
        return $this->select('jenis_kerusakan, COUNT(*) as jumlah, SUM(total_biaya) as total_biaya')
                    ->groupBy('jenis_kerusakan')
                    ->orderBy('jumlah', 'DESC')
                    ->limit(10)
                    ->findAll();
    }

    // Get perbaikan per bulan untuk chart
    public function getPerbaikanPerBulan($tahun = null)
    {
        if (!$tahun) $tahun = date('Y');
        
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                MONTH(tanggal_laporan) as bulan,
                MONTHNAME(tanggal_laporan) as nama_bulan,
                COUNT(*) as jumlah_perbaikan,
                SUM(total_biaya) as total_biaya
            FROM custome__perbaikan_aset 
            WHERE YEAR(tanggal_laporan) = ?
            GROUP BY MONTH(tanggal_laporan)
            ORDER BY MONTH(tanggal_laporan)
        ", [$tahun])->getResultArray();
    }

    // Update status perbaikan
    public function updateStatus($id_perbaikan, $status, $data = [])
    {
        $updateData = ['status' => $status];
        
        if ($status == 'Selesai' && !isset($data['tanggal_perbaikan'])) {
            $updateData['tanggal_perbaikan'] = date('Y-m-d');
        }
        
        if (!empty($data)) {
            $updateData = array_merge($updateData, $data);
        }
        
        return $this->update($id_perbaikan, $updateData);
    }

    // Calculate total biaya (perbaikan + spare part)
    public function calculateTotalBiaya($biaya_perbaikan, $biaya_spare_part)
    {
        return $biaya_perbaikan + $biaya_spare_part;
    }

    // Check duplicate kode perbaikan
    public function checkDuplicateKode($kode_perbaikan, $id_perbaikan = null)
    {
        $builder = $this->where('kode_perbaikan', $kode_perbaikan);
        if ($id_perbaikan) {
            $builder->where('id_perbaikan !=', $id_perbaikan);
        }
        return $builder->countAllResults() > 0;
    }

    // Get aset yang sering rusak
    public function getAsetSeringRusak($limit = 10)
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                a.kode_aset, a.nama_aset,
                k.nama_kategori,
                l.nama_lokasi,
                COUNT(p.id_perbaikan) as jumlah_perbaikan,
                SUM(p.total_biaya) as total_biaya_perbaikan,
                MAX(p.tanggal_laporan) as perbaikan_terakhir
            FROM custome__aset_gereja a
            INNER JOIN custome__perbaikan_aset p ON p.id_aset = a.id_aset
            LEFT JOIN custome__kategori_aset k ON k.id_kategori = a.id_kategori
            LEFT JOIN custome__lokasi_aset l ON l.id_lokasi = a.id_lokasi
            GROUP BY a.id_aset
            ORDER BY jumlah_perbaikan DESC, total_biaya_perbaikan DESC
            LIMIT ?
        ", [$limit])->getResultArray();
    }

    // Get vendor performance untuk perbaikan
    public function getVendorPerformance()
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                v.nama_vendor,
                COUNT(p.id_perbaikan) as total_perbaikan,
                COUNT(CASE WHEN p.status = 'Selesai' THEN 1 END) as perbaikan_selesai,
                COUNT(CASE WHEN p.status = 'Tidak Dapat Diperbaiki' THEN 1 END) as perbaikan_gagal,
                AVG(p.total_biaya) as avg_biaya,
                AVG(CASE WHEN p.tanggal_perbaikan IS NOT NULL THEN 
                    DATEDIFF(p.tanggal_perbaikan, p.tanggal_laporan) 
                END) as avg_durasi_perbaikan
            FROM custome__vendor_maintenance v
            INNER JOIN custome__perbaikan_aset p ON p.id_vendor = v.id_vendor
            GROUP BY v.id_vendor
            ORDER BY perbaikan_selesai DESC, avg_durasi_perbaikan ASC
        ")->getResultArray();
    }

    // Get trend kerusakan per kategori
    public function getTrendKerusakanPerKategori($tahun = null)
    {
        if (!$tahun) $tahun = date('Y');
        
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                k.nama_kategori,
                k.warna,
                COUNT(p.id_perbaikan) as jumlah_kerusakan,
                SUM(p.total_biaya) as total_biaya
            FROM custome__kategori_aset k
            INNER JOIN custome__aset_gereja a ON a.id_kategori = k.id_kategori
            INNER JOIN custome__perbaikan_aset p ON p.id_aset = a.id_aset
            WHERE YEAR(p.tanggal_laporan) = ?
            GROUP BY k.id_kategori
            ORDER BY jumlah_kerusakan DESC
        ", [$tahun])->getResultArray();
    }

    // Get garansi perbaikan yang akan habis
    public function getGaransiExpiringSoon($days = 30)
    {
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                p.*,
                a.kode_aset, a.nama_aset,
                v.nama_vendor,
                DATE_ADD(p.tanggal_perbaikan, INTERVAL p.garansi_perbaikan DAY) as tanggal_garansi_habis
            FROM custome__perbaikan_aset p
            INNER JOIN custome__aset_gereja a ON a.id_aset = p.id_aset
            LEFT JOIN custome__vendor_maintenance v ON v.id_vendor = p.id_vendor
            WHERE p.status = 'Selesai' 
            AND p.garansi_perbaikan > 0
            AND DATE_ADD(p.tanggal_perbaikan, INTERVAL p.garansi_perbaikan DAY) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL ? DAY)
            ORDER BY tanggal_garansi_habis ASC
        ", [$days])->getResultArray();
    }
}
