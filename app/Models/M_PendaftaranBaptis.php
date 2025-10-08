<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class M_PendaftaranBaptis extends Model
{
    protected $table      = 'custome__pendaftaran_baptis';
    protected $primaryKey = 'id_baptis';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $allowedFields = [
        'nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 
        'no_hp', 'email', 'nama_ayah', 'nama_ibu', 'jenis_baptis',
        'nama_pendamping', 'hubungan_pendamping', 'tgl_daftar', 'tgl_baptis', 
        'status', 'keterangan', 'created_by', 'updated_by',
        'dok_ktp', 'dok_kk', 'dok_akta_lahir', 'dok_foto', 'dok_surat_nikah_ortu'
    ];

    // Aturan validasi untuk insert dan update
    protected $validationRules = [
        'nama_lengkap' => 'required|max_length[255]',
        'tempat_lahir' => 'required|max_length[100]',
        'tgl_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'alamat' => 'required',
        'no_hp' => 'required|max_length[20]',
        'email' => 'required|valid_email|max_length[100]',
        'jenis_baptis' => 'required|in_list[Baptis Anak,Baptis Dewasa]',
        'status' => 'required|in_list[0,1,2]',
    ];

    protected $validationMessages = [
        'nama_lengkap' => [
            'required' => 'Nama lengkap harus diisi',
            'max_length' => 'Nama lengkap maksimal 255 karakter'
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]
    ];

    protected $skipValidation = false;
    protected $beforeInsert = ['setCreatedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];

    /**
     * Set created_by field before insert
     */
    protected function setCreatedBy(array $data)
    {
        if (session()->has('user_id')) {
            $data['data']['created_by'] = session('user_id');
        } else {
            $data['data']['created_by'] = 0; // System or guest
        }
        
        // Set tanggal daftar
        if (!isset($data['data']['tgl_daftar'])) {
            $data['data']['tgl_daftar'] = Time::now('Asia/Jakarta')->toDateString();
        }
        
        return $data;
    }

    /**
     * Set updated_by field before update
     */
    protected function setUpdatedBy(array $data)
    {
        if (session()->has('user_id')) {
            $data['data']['updated_by'] = session('user_id');
        } else {
            $data['data']['updated_by'] = 0; // System or guest
        }
        return $data;
    }

    /**
     * Get all registrations with optional filters
     * 
     * @param array $filters
     * @param int $perPage Items per page for pagination
     * @return array
     */
    public function getAll($filters = [], $perPage = 10)
    {
        $builder = $this->builder();
        
        // Apply filters
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        
        if (!empty($filters['jenis_baptis'])) {
            $builder->where('jenis_baptis', $filters['jenis_baptis']);
        }
        
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $builder->groupStart()
                   ->like('nama_lengkap', $search)
                   ->orLike('no_hp', $search)
                   ->orLike('email', $search)
                   ->orLike('no_pendaftaran', $search)
                   ->groupEnd();
        }
        
        // Date range filter
        if (!empty($filters['start_date'])) {
            $builder->where('tgl_daftar >=', $filters['start_date']);
        }
        
        if (!empty($filters['end_date'])) {
            $builder->where('tgl_daftar <=', $filters['end_date']);
        }
        
        // Order and pagination
        $builder->orderBy('created_at', 'DESC');
        
        if ($perPage > 0) {
            return [
                'data' => $builder->paginate($perPage),
                'pager' => $this->pager
            ];
        }
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get registration by ID with related data
     */
    public function getById($id)
    {
        return $this->where('id_baptis', $id)
                   ->first();
    }

    /**
     * Get registration by status
     */
    public function getByStatus($status, $limit = 0)
    {
        $builder = $this->where('status', $status)
                       ->orderBy('tgl_daftar', 'DESC');
        
        if ($limit > 0) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }

    /**
     * Get total registrations by status
     */
    public function getCountByStatus($status = null)
    {
        if ($status !== null) {
            return $this->where('status', $status)->countAllResults();
        }
        
        return [
            'pending' => $this->where('status', '0')->countAllResults(),
            'approved' => $this->where('status', '1')->countAllResults(),
            'rejected' => $this->where('status', '2')->countAllResults()
        ];
    }

    /**
     * Generate registration number
     */
    public function generateNoPendaftaran()
    {
        $prefix = 'BAP' . date('Ym');
        $last = $this->select('no_pendaftaran')
                    ->like('no_pendaftaran', $prefix, 'after')
                    ->orderBy('no_pendaftaran', 'DESC')
                    ->first();
        
        if ($last) {
            $lastNumber = (int) substr($last['no_pendaftaran'], -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return $prefix . $newNumber;
    }

    /**
     * Update registration status
     */
    public function updateStatus($id, $status, $keterangan = '')
    {
        return $this->update($id, [
            'status' => $status,
            'keterangan' => $keterangan,
            'tgl_verifikasi' => Time::now('Asia/Jakarta')->toDateTimeString()
        ]);
    }

    /**
     * Get statistics for dashboard
     */
    public function getDashboardStats()
    {
        $today = Time::today('Asia/Jakarta');
        $monthStart = $today->firstOfMonth()->toDateString();
        $monthEnd = $today->lastOfMonth()->toDateString();
        
        return [
            'total' => $this->countAll(),
            'today' => $this->where('DATE(created_at)', $today->toDateString())->countAllResults(),
            'this_month' => $this->where('created_at >=', $monthStart)
                               ->where('created_at <=', $monthEnd)
                               ->countAllResults(),
            'pending' => $this->where('status', '0')->countAllResults(),
            'by_status' => [
                'pending' => $this->where('status', '0')->countAllResults(),
                'approved' => $this->where('status', '1')->countAllResults(),
                'rejected' => $this->where('status', '2')->countAllResults()
            ],
            'by_type' => [
                'anak' => $this->where('jenis_baptis', 'Baptis Anak')->countAllResults(),
                'dewasa' => $this->where('jenis_baptis', 'Baptis Dewasa')->countAllResults()
            ]
        ];
    }

    /**
     * Get rejected registrations
     */
    public function getDitolak()
    {
        return $this->where('status', '2')
                   ->orderBy('id_baptis', 'DESC')
                   ->findAll();
    }

    // Total pendaftar
    public function totalpendaftar()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->countAllResults();
    }
}
