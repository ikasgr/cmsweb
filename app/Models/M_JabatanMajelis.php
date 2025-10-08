<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JabatanMajelis extends Model
{
    protected $table      = 'custome__jabatan_majelis';
    protected $primaryKey = 'jabatan_id';
    protected $allowedFields = [
        'nama_jabatan', 'deskripsi', 'tingkatan', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    // Get all active jabatan
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
            ->orderBy('nama_jabatan', 'ASC')
            ->findAll();
    }

    // Get all jabatan
    public function list()
    {
        return $this->orderBy('nama_jabatan', 'ASC')->findAll();
    }

    // Get jabatan by tingkatan
    public function getByTingkatan($tingkatan)
    {
        return $this->where('tingkatan', $tingkatan)
            ->where('status', 'Aktif')
            ->orderBy('nama_jabatan', 'ASC')
            ->findAll();
    }

    // Check if jabatan name exists
    public function cekNama($nama_jabatan, $exclude_id = null)
    {
        $builder = $this->where('nama_jabatan', $nama_jabatan);
        if ($exclude_id) {
            $builder->where('jabatan_id !=', $exclude_id);
        }
        return $builder->first();
    }

    // Get dropdown options
    public function getDropdown()
    {
        $jabatan = $this->listAktif();
        $options = [];
        foreach ($jabatan as $item) {
            $options[$item['jabatan_id']] = $item['nama_jabatan'];
        }
        return $options;
    }
}
