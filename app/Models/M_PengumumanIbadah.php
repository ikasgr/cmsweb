<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PengumumanIbadah extends Model
{
    protected $table      = 'custome__pengumuman_ibadah';
    protected $primaryKey = 'id_pengumuman';
    protected $allowedFields = [
        'id_jadwal', 'judul_pengumuman', 'isi_pengumuman', 'urutan', 'is_penting'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get pengumuman berdasarkan jadwal
    public function getByJadwal($id_jadwal)
    {
        return $this->where('id_jadwal', $id_jadwal)
                    ->orderBy('is_penting', 'DESC')
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get pengumuman penting
    public function getPenting($id_jadwal)
    {
        return $this->where('id_jadwal', $id_jadwal)
                    ->where('is_penting', 1)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Update urutan pengumuman
    public function updateUrutan($data)
    {
        foreach ($data as $item) {
            $this->update($item['id'], ['urutan' => $item['urutan']]);
        }
        return true;
    }

    // Copy pengumuman dari jadwal lain
    public function copyFromJadwal($id_jadwal_sumber, $id_jadwal_tujuan)
    {
        $pengumumanSumber = $this->getByJadwal($id_jadwal_sumber);
        
        foreach ($pengumumanSumber as $pengumuman) {
            unset($pengumuman['id_pengumuman']);
            $pengumuman['id_jadwal'] = $id_jadwal_tujuan;
            $this->insert($pengumuman);
        }
        
        return count($pengumumanSumber);
    }
}
