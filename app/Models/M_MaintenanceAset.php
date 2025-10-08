<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MaintenanceAset extends Model
{
    protected $table = 'custome__maintenance_aset';
    protected $primaryKey = 'id_maintenance';
    protected $allowedFields = [
        'kode_maintenance', 'id_aset', 'jenis_maintenance', 'tanggal_jadwal', 
        'tanggal_selesai', 'deskripsi', 'id_vendor', 'teknisi', 'biaya_estimasi', 
        'biaya_aktual', 'status', 'hasil_maintenance', 'rekomendasi', 
        'foto_sebelum', 'foto_sesudah', 'next_maintenance', 'created_by', 'updated_by'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua maintenance dengan join
    public function list()
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor,
                            users.fullname as created_by_name')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__maintenance_aset.created_by', 'left')
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'DESC')
                    ->findAll();
    }

    // Get maintenance by ID dengan join lengkap
    public function getMaintenanceById($id_maintenance)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset, custome__aset_gereja.merk, custome__aset_gereja.model,
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor, custome__vendor_maintenance.telepon as vendor_telepon,
                            users.fullname as created_by_name')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__maintenance_aset.created_by', 'left')
                    ->where('custome__maintenance_aset.id_maintenance', $id_maintenance)
                    ->first();
    }

    // Generate kode maintenance otomatis
    public function generateKodeMaintenance()
    {
        $prefix = 'MNT';
        $date = date('Ymd');
        
        // Cari kode terakhir hari ini
        $lastCode = $this->select('kode_maintenance')
                         ->like('kode_maintenance', $prefix . $date, 'after')
                         ->orderBy('kode_maintenance', 'DESC')
                         ->first();
        
        if ($lastCode) {
            $lastNumber = (int) substr($lastCode['kode_maintenance'], -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Get maintenance berdasarkan aset
    public function getByAset($id_aset)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__vendor_maintenance.nama_vendor,
                            users.fullname as created_by_name')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->join('users', 'users.id = custome__maintenance_aset.created_by', 'left')
                    ->where('custome__maintenance_aset.id_aset', $id_aset)
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'DESC')
                    ->findAll();
    }

    // Get maintenance berdasarkan status
    public function getByStatus($status)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->where('custome__maintenance_aset.status', $status)
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'ASC')
                    ->findAll();
    }

    // Get maintenance berdasarkan jenis
    public function getByJenis($jenis_maintenance)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->where('custome__maintenance_aset.jenis_maintenance', $jenis_maintenance)
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'DESC')
                    ->findAll();
    }

    // Get maintenance berdasarkan periode
    public function getByPeriode($start_date, $end_date)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->where('custome__maintenance_aset.tanggal_jadwal >=', $start_date)
                    ->where('custome__maintenance_aset.tanggal_jadwal <=', $end_date)
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'ASC')
                    ->findAll();
    }

    // Get maintenance yang akan datang (upcoming)
    public function getUpcomingMaintenance($days = 30)
    {
        $endDate = date('Y-m-d', strtotime("+{$days} days"));
        
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->where('custome__maintenance_aset.tanggal_jadwal >=', date('Y-m-d'))
                    ->where('custome__maintenance_aset.tanggal_jadwal <=', $endDate)
                    ->whereIn('custome__maintenance_aset.status', ['Dijadwalkan', 'Sedang Proses'])
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'ASC')
                    ->findAll();
    }

    // Get maintenance overdue
    public function getOverdueMaintenance()
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->where('custome__maintenance_aset.tanggal_jadwal <', date('Y-m-d'))
                    ->whereIn('custome__maintenance_aset.status', ['Dijadwalkan', 'Sedang Proses'])
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'ASC')
                    ->findAll();
    }

    // Search maintenance
    public function searchMaintenance($keyword)
    {
        return $this->select('custome__maintenance_aset.*, 
                            custome__aset_gereja.kode_aset, custome__aset_gereja.nama_aset,
                            custome__kategori_aset.nama_kategori,
                            custome__lokasi_aset.nama_lokasi,
                            custome__vendor_maintenance.nama_vendor')
                    ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                    ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
                    ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
                    ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                    ->groupStart()
                        ->like('custome__maintenance_aset.kode_maintenance', $keyword)
                        ->orLike('custome__aset_gereja.kode_aset', $keyword)
                        ->orLike('custome__aset_gereja.nama_aset', $keyword)
                        ->orLike('custome__maintenance_aset.deskripsi', $keyword)
                        ->orLike('custome__maintenance_aset.teknisi', $keyword)
                        ->orLike('custome__vendor_maintenance.nama_vendor', $keyword)
                    ->groupEnd()
                    ->orderBy('custome__maintenance_aset.tanggal_jadwal', 'DESC')
                    ->findAll();
    }

    // Get statistik maintenance
    public function getStatistik()
    {
        $total = $this->countAll();
        $dijadwalkan = $this->where('status', 'Dijadwalkan')->countAllResults(false);
        $sedang_proses = $this->where('status', 'Sedang Proses')->countAllResults(false);
        $selesai = $this->where('status', 'Selesai')->countAllResults(false);
        $overdue = $this->where('tanggal_jadwal <', date('Y-m-d'))
                        ->whereIn('status', ['Dijadwalkan', 'Sedang Proses'])
                        ->countAllResults();
        
        // Total biaya maintenance
        $totalBiaya = $this->selectSum('biaya_aktual')->where('status', 'Selesai')->first();
        
        return [
            'total_maintenance' => $total,
            'dijadwalkan' => $dijadwalkan,
            'sedang_proses' => $sedang_proses,
            'selesai' => $selesai,
            'overdue' => $overdue,
            'total_biaya' => $totalBiaya['biaya_aktual'] ?? 0
        ];
    }

    // Get maintenance per jenis untuk chart
    public function getMaintenancePerJenis()
    {
        return $this->select('jenis_maintenance, COUNT(*) as jumlah, SUM(biaya_aktual) as total_biaya')
                    ->groupBy('jenis_maintenance')
                    ->orderBy('jumlah', 'DESC')
                    ->findAll();
    }

    // Get maintenance per bulan untuk chart
    public function getMaintenancePerBulan($tahun = null)
    {
        if (!$tahun) $tahun = date('Y');
        
        $db = \Config\Database::connect();
        
        return $db->query("
            SELECT 
                MONTH(tanggal_jadwal) as bulan,
                MONTHNAME(tanggal_jadwal) as nama_bulan,
                COUNT(*) as jumlah_maintenance,
                SUM(biaya_aktual) as total_biaya
            FROM custome__maintenance_aset 
            WHERE YEAR(tanggal_jadwal) = ?
            GROUP BY MONTH(tanggal_jadwal)
            ORDER BY MONTH(tanggal_jadwal)
        ", [$tahun])->getResultArray();
    }

    // Update status maintenance
    public function updateStatus($id_maintenance, $status, $data = [])
    {
        $updateData = ['status' => $status];
        
        if ($status == 'Selesai' && !isset($data['tanggal_selesai'])) {
            $updateData['tanggal_selesai'] = date('Y-m-d');
        }
        
        if (!empty($data)) {
            $updateData = array_merge($updateData, $data);
        }
        
        return $this->update($id_maintenance, $updateData);
    }

    // Generate jadwal maintenance preventif otomatis
    public function generatePreventifSchedule($id_aset, $interval_months = 6)
    {
        // Get last maintenance
        $lastMaintenance = $this->where('id_aset', $id_aset)
                                ->where('jenis_maintenance', 'Preventif')
                                ->where('status', 'Selesai')
                                ->orderBy('tanggal_selesai', 'DESC')
                                ->first();
        
        $nextDate = $lastMaintenance 
                    ? date('Y-m-d', strtotime($lastMaintenance['tanggal_selesai'] . " +{$interval_months} months"))
                    : date('Y-m-d', strtotime("+{$interval_months} months"));
        
        return $nextDate;
    }

    // Check duplicate kode maintenance
    public function checkDuplicateKode($kode_maintenance, $id_maintenance = null)
    {
        $builder = $this->where('kode_maintenance', $kode_maintenance);
        if ($id_maintenance) {
            $builder->where('id_maintenance !=', $id_maintenance);
        }
        return $builder->countAllResults() > 0;
    }

    // Get maintenance calendar events
    public function getCalendarEvents($start_date, $end_date)
    {
        $maintenances = $this->select('custome__maintenance_aset.*, 
                                     custome__aset_gereja.nama_aset,
                                     custome__vendor_maintenance.nama_vendor')
                             ->join('custome__aset_gereja', 'custome__aset_gereja.id_aset = custome__maintenance_aset.id_aset', 'left')
                             ->join('custome__vendor_maintenance', 'custome__vendor_maintenance.id_vendor = custome__maintenance_aset.id_vendor', 'left')
                             ->where('custome__maintenance_aset.tanggal_jadwal >=', $start_date)
                             ->where('custome__maintenance_aset.tanggal_jadwal <=', $end_date)
                             ->findAll();
        
        $events = [];
        foreach ($maintenances as $maintenance) {
            $color = '#007bff'; // Default blue
            switch ($maintenance['status']) {
                case 'Dijadwalkan': $color = '#28a745'; break;
                case 'Sedang Proses': $color = '#ffc107'; break;
                case 'Selesai': $color = '#6c757d'; break;
                case 'Ditunda': $color = '#fd7e14'; break;
                case 'Dibatalkan': $color = '#dc3545'; break;
            }
            
            $events[] = [
                'id' => $maintenance['id_maintenance'],
                'title' => $maintenance['jenis_maintenance'] . ': ' . $maintenance['nama_aset'],
                'start' => $maintenance['tanggal_jadwal'],
                'backgroundColor' => $color,
                'borderColor' => $color,
                'extendedProps' => [
                    'kode_maintenance' => $maintenance['kode_maintenance'],
                    'vendor' => $maintenance['nama_vendor'],
                    'status' => $maintenance['status'],
                    'jenis' => $maintenance['jenis_maintenance']
                ]
            ];
        }
        
        return $events;
    }
}
