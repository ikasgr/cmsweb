<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MasaJabatanMajelis extends Model
{
    protected $table      = 'custome__masa_jabatan_majelis';
    protected $primaryKey = 'masa_jabatan_id';
    protected $allowedFields = [
        'majelis_id', 'jabatan_id', 'tanggal_mulai', 'tanggal_selesai', 'status', 'keterangan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get masa jabatan by majelis_id
    public function getByMajelis($majelis_id)
    {
        return $this->select('custome__masa_jabatan_majelis.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__masa_jabatan_majelis.jabatan_id')
            ->where('custome__masa_jabatan_majelis.majelis_id', $majelis_id)
            ->orderBy('custome__masa_jabatan_majelis.tanggal_mulai', 'DESC')
            ->findAll();
    }

    // Get active masa jabatan
    public function getAktif($majelis_id)
    {
        return $this->select('custome__masa_jabatan_majelis.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__masa_jabatan_majelis.jabatan_id')
            ->where('custome__masa_jabatan_majelis.majelis_id', $majelis_id)
            ->where('custome__masa_jabatan_majelis.status', 'Aktif')
            ->first();
    }

    // Get expiring terms
    public function getExpiring($days = 30)
    {
        $date = date('Y-m-d', strtotime("+{$days} days"));
        return $this->select('custome__masa_jabatan_majelis.*, custome__majelis_gereja.nama, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__majelis_gereja', 'custome__majelis_gereja.majelis_id = custome__masa_jabatan_majelis.majelis_id')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__masa_jabatan_majelis.jabatan_id')
            ->where('custome__masa_jabatan_majelis.tanggal_selesai <=', $date)
            ->where('custome__masa_jabatan_majelis.tanggal_selesai >=', date('Y-m-d'))
            ->where('custome__masa_jabatan_majelis.status', 'Aktif')
            ->orderBy('custome__masa_jabatan_majelis.tanggal_selesai', 'ASC')
            ->findAll();
    }

    // End masa jabatan
    public function endTerm($masa_jabatan_id, $keterangan = null)
    {
        return $this->update($masa_jabatan_id, [
            'status' => 'Selesai',
            'tanggal_selesai' => date('Y-m-d'),
            'keterangan' => $keterangan
        ]);
    }

    // Extend masa jabatan
    public function extendTerm($masa_jabatan_id, $new_end_date, $keterangan = null)
    {
        return $this->update($masa_jabatan_id, [
            'status' => 'Diperpanjang',
            'tanggal_selesai' => $new_end_date,
            'keterangan' => $keterangan
        ]);
    }

    // Get history by majelis
    public function getHistory($majelis_id)
    {
        return $this->select('custome__masa_jabatan_majelis.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__masa_jabatan_majelis.jabatan_id')
            ->where('custome__masa_jabatan_majelis.majelis_id', $majelis_id)
            ->whereIn('custome__masa_jabatan_majelis.status', ['Selesai', 'Dibatalkan'])
            ->orderBy('custome__masa_jabatan_majelis.tanggal_mulai', 'DESC')
            ->findAll();
    }
}
