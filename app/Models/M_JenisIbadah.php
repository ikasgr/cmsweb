<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JenisIbadah extends Model
{
    protected $table      = 'custome__jenis_ibadah';
    protected $primaryKey = 'id_jenis_ibadah';
    protected $allowedFields = [
        'nama_jenis', 'deskripsi', 'warna', 'durasi_menit', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua jenis ibadah
    public function list()
    {
        return $this->orderBy('nama_jenis', 'ASC')->findAll();
    }

    // List jenis ibadah aktif
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('nama_jenis', 'ASC')
                    ->findAll();
    }

    // Get untuk dropdown
    public function getDropdown()
    {
        $data = $this->listAktif();
        $dropdown = [];
        foreach ($data as $item) {
            $dropdown[$item['id_jenis_ibadah']] = $item['nama_jenis'];
        }
        return $dropdown;
    }

    // Toggle status
    public function toggleStatus($id)
    {
        $current = $this->find($id);
        $newStatus = ($current['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        return $this->update($id, ['status' => $newStatus]);
    }
}
