<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JabatanPelayanan extends Model
{
    protected $table      = 'custome__jabatan_pelayanan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = [
        'nama_jabatan', 'deskripsi', 'warna', 'urutan', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua jabatan
    public function list()
    {
        return $this->orderBy('urutan', 'ASC')->findAll();
    }

    // List jabatan aktif
    public function listAktif()
    {
        return $this->where('status', 'Aktif')
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get untuk dropdown
    public function getDropdown()
    {
        $data = $this->listAktif();
        $dropdown = [];
        foreach ($data as $item) {
            $dropdown[$item['id_jabatan']] = $item['nama_jabatan'];
        }
        return $dropdown;
    }

    // Update urutan
    public function updateUrutan($data)
    {
        foreach ($data as $item) {
            $this->update($item['id'], ['urutan' => $item['urutan']]);
        }
        return true;
    }

    // Toggle status
    public function toggleStatus($id)
    {
        $current = $this->find($id);
        $newStatus = ($current['status'] == 'Aktif') ? 'Non-Aktif' : 'Aktif';
        return $this->update($id, ['status' => $newStatus]);
    }
}
