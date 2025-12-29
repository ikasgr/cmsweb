<?php

namespace App\Models;

use CodeIgniter\Model;

class M_InventarisGereja extends Model
{
    protected $table = 'custome__aset_gereja';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = [
        'kode_aset',
        'nama_aset',
        'id_kategori',
        'id_lokasi',
        'merk',
        'model',
        'serial_number',
        'tahun_pembuatan',
        'tanggal_pembelian',
        'harga_perolehan',
        'nilai_residu',
        'masa_pakai',
        'metode_depreciation',
        'nilai_buku',
        'akumulasi_depreciation',
        'supplier',
        'no_faktur',
        'warranty_start',
        'warranty_end',
        'insurance_company',
        'insurance_policy',
        'insurance_value',
        'kondisi',
        'status',
        'qr_code',
        'barcode',
        'foto_aset',
        'spesifikasi',
        'keterangan',
        'created_by',
        'updated_by'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'object';

    protected $validationRules = [
        'nama_aset' => 'required|min_length[3]',
        'id_kategori' => 'required',
        'id_lokasi' => 'required',
        'tanggal_pembelian' => 'required|valid_date',
        'harga_perolehan' => 'required|numeric|greater_than[0]'
    ];

    protected $validationMessages = [
        'nama_aset' => [
            'required' => 'Nama Aset tidak boleh kosong',
            'min_length' => 'Nama Aset minimal 3 karakter'
        ],
        'id_kategori' => [
            'required' => 'Kategori harus dipilih'
        ],
        'id_lokasi' => [
            'required' => 'Lokasi harus dipilih'
        ],
        'tanggal_pembelian' => [
            'required' => 'Tanggal Pembelian tidak boleh kosong',
            'valid_date' => 'Tanggal Pembelian harus berformat tanggal yang valid'
        ],
        'harga_perolehan' => [
            'required' => 'Harga Perolehan tidak boleh kosong',
            'numeric' => 'Harga Perolehan harus berupa angka',
            'greater_than' => 'Harga Perolehan harus lebih besar dari 0'
        ]
    ];

    // List semua aset dengan join
    public function list()
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi,
                            users.fullname as created_by_name')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->join('users', 'users.id = custome__aset_gereja.created_by', 'left')
            ->orderBy('custome__aset_gereja.created_at', 'DESC')
            ->findAll();
    }

    // Get aset by ID dengan join lengkap
    public function getAsetById($id_aset)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi, custome__lokasi_aset.jenis_lokasi,
                            users.fullname as created_by_name')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->join('users', 'users.id = custome__aset_gereja.created_by', 'left')
            ->where('custome__aset_gereja.id_aset', $id_aset)
            ->first();
    }

    // Generate kode aset otomatis
    public function generateKodeAset()
    {
        $prefix = 'AST';
        $date = date('Ymd');

        // Cari kode terakhir hari ini
        $lastCode = $this->select('kode_aset')
            ->like('kode_aset', $prefix . $date, 'after')
            ->orderBy('kode_aset', 'DESC')
            ->first();

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode['kode_aset'], -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Generate QR Code
    public function generateQRCode($kode_aset)
    {
        return 'QR' . $kode_aset . time();
    }

    // Filter aset berdasarkan kategori
    public function filterByKategori($id_kategori)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->where('custome__aset_gereja.id_kategori', $id_kategori)
            ->orderBy('custome__aset_gereja.nama_aset', 'ASC')
            ->findAll();
    }

    // Filter aset berdasarkan lokasi
    public function filterByLokasi($id_lokasi)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->where('custome__aset_gereja.id_lokasi', $id_lokasi)
            ->orderBy('custome__aset_gereja.nama_aset', 'ASC')
            ->findAll();
    }

    // Filter aset berdasarkan status
    public function filterByStatus($status)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->where('custome__aset_gereja.status', $status)
            ->orderBy('custome__aset_gereja.nama_aset', 'ASC')
            ->findAll();
    }

    // Search aset
    public function searchAset($keyword)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->groupStart()
            ->like('custome__aset_gereja.kode_aset', $keyword)
            ->orLike('custome__aset_gereja.nama_aset', $keyword)
            ->orLike('custome__aset_gereja.merk', $keyword)
            ->orLike('custome__aset_gereja.model', $keyword)
            ->orLike('custome__aset_gereja.serial_number', $keyword)
            ->orLike('custome__kategori_aset.nama_kategori', $keyword)
            ->orLike('custome__lokasi_aset.nama_lokasi', $keyword)
            ->groupEnd()
            ->orderBy('custome__aset_gereja.nama_aset', 'ASC')
            ->findAll();
    }

    // Get statistik aset
    public function getStatistik()
    {
        $total = $this->countAll();
        $aktif = $this->where('status', 'Aktif')->countAllResults();
        $maintenance = $this->where('status', 'Maintenance')->countAllResults();
        $rusak = $this->where('status', 'Rusak')->countAllResults();

        // Total nilai aset
        $totalNilai = $this->selectSum('harga_perolehan')->first();
        $totalDepreciasi = $this->selectSum('akumulasi_depreciation')->first();
        $totalNilaiBuku = $this->selectSum('nilai_buku')->first();

        // Calculate maintenance costs
        $db = \Config\Database::connect();
        $biayaMaint = $db->table('custome__maintenance_aset')->selectSum('biaya_aktual')->get()->getRow();
        $biayaPerbaikan = $db->table('custome__perbaikan_aset')->selectSum('total_biaya')->get()->getRow();

        $totalMaint = $db->table('custome__maintenance_aset')->countAllResults();
        $totalPerbaikan = $db->table('custome__perbaikan_aset')->countAllResults();

        return [
            'total_aset' => $total,
            'aset_aktif' => $aktif,
            'aset_maintenance' => $maintenance,
            'aset_rusak' => $rusak,
            'total_nilai_perolehan' => isset($totalNilai) ? ($totalNilai->harga_perolehan ?? 0) : 0,
            'total_akumulasi_depreciation' => isset($totalDepreciasi) ? ($totalDepreciasi->akumulasi_depreciation ?? 0) : 0,
            'total_nilai_buku' => isset($totalNilaiBuku) ? ($totalNilaiBuku->nilai_buku ?? 0) : 0,
            'total_maintenance' => $totalMaint,
            'total_perbaikan' => $totalPerbaikan,
            'total_biaya' => ($biayaMaint->biaya_aktual ?? 0) + ($biayaPerbaikan->total_biaya ?? 0)
        ];
    }

    public function getAsetPerKategori()
    {
        return $this->select('custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            COUNT(custome__aset_gereja.id_aset) as jumlah_aset,
                            SUM(custome__aset_gereja.harga_perolehan) as total_nilai')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->groupBy('custome__aset_gereja.id_kategori')
            ->orderBy('jumlah_aset', 'DESC')
            ->findAll();
    }

    // Get aset per lokasi untuk chart
    public function getAsetPerLokasi()
    {
        return $this->select('custome__lokasi_aset.nama_lokasi, 
                            COUNT(custome__aset_gereja.id_aset) as jumlah_aset,
                            SUM(custome__aset_gereja.harga_perolehan) as total_nilai')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->groupBy('custome__aset_gereja.id_lokasi')
            ->orderBy('jumlah_aset', 'DESC')
            ->findAll();
    }

    // Get aset yang perlu maintenance
    public function getAsetPerluMaintenance()
    {
        $db = \Config\Database::connect();

        return $db->query("
            SELECT a.*, k.nama_kategori, k.warna, l.nama_lokasi,
                   COALESCE(MAX(m.next_maintenance), DATE_ADD(a.tanggal_pembelian, INTERVAL 6 MONTH)) as next_maintenance_date
            FROM custome__aset_gereja a
            LEFT JOIN custome__kategori_aset k ON k.id_kategori = a.id_kategori
            LEFT JOIN custome__lokasi_aset l ON l.id_lokasi = a.id_lokasi
            LEFT JOIN custome__maintenance_aset m ON m.id_aset = a.id_aset AND m.status = 'Selesai'
            WHERE a.status = 'Aktif'
            GROUP BY a.id_aset
            HAVING next_maintenance_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
            ORDER BY next_maintenance_date ASC
        ")->getResultArray();
    }

    // Get aset dengan warranty akan habis
    public function getWarrantyExpiringSoon()
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna, custome__kategori_aset.icon,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->where('custome__aset_gereja.warranty_end IS NOT NULL')
            ->where('custome__aset_gereja.warranty_end >=', date('Y-m-d'))
            ->where('custome__aset_gereja.warranty_end <=', date('Y-m-d', strtotime('+60 days')))
            ->where('custome__aset_gereja.status', 'Aktif')
            ->orderBy('custome__aset_gereja.warranty_end', 'ASC')
            ->findAll();
    }

    // Update nilai buku dan akumulasi depreciation
    public function updateDepreciation($id_aset, $nilai_buku, $akumulasi_depreciation)
    {
        return $this->update($id_aset, [
            'nilai_buku' => $nilai_buku,
            'akumulasi_depreciation' => $akumulasi_depreciation
        ]);
    }

    // Get aset by QR Code
    public function getByQRCode($qr_code)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->where('custome__aset_gereja.qr_code', $qr_code)
            ->first();
    }

    // Toggle status aset
    public function toggleStatus($id_aset, $status)
    {
        return $this->update($id_aset, ['status' => $status]);
    }

    // Get top aset berdasarkan nilai
    public function getTopAsetByValue($limit = 10)
    {
        return $this->select('custome__aset_gereja.*, 
                            custome__kategori_aset.nama_kategori, custome__kategori_aset.warna,
                            custome__lokasi_aset.nama_lokasi')
            ->join('custome__kategori_aset', 'custome__kategori_aset.id_kategori = custome__aset_gereja.id_kategori', 'left')
            ->join('custome__lokasi_aset', 'custome__lokasi_aset.id_lokasi = custome__aset_gereja.id_lokasi', 'left')
            ->orderBy('custome__aset_gereja.harga_perolehan', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Check duplicate kode aset
    public function checkDuplicateKode($kode_aset, $id_aset = null)
    {
        $builder = $this->where('kode_aset', $kode_aset);
        if ($id_aset) {
            $builder->where('id_aset !=', $id_aset);
        }
        return $builder->countAllResults() > 0;
    }

    // Check duplicate serial number
    public function checkDuplicateSerial($serial_number, $id_aset = null)
    {
        if (empty($serial_number))
            return false;

        $builder = $this->where('serial_number', $serial_number);
        if ($id_aset) {
            $builder->where('id_aset !=', $id_aset);
        }
        return $builder->countAllResults() > 0;
    }
}
