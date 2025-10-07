<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranSidi extends Model
{
    protected $table      = 'custome__pendaftaran_sidi';
    protected $primaryKey = 'id_sidi';
    protected $allowedFields = [
        'nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 
        'no_hp', 'email', 'nama_ayah', 'nama_ibu', 'tgl_baptis', 'gereja_baptis',
        'tgl_daftar', 'tgl_sidi', 'status', 'keterangan',
        'dok_ktp', 'dok_kk', 'dok_baptis', 'dok_foto'
    ];

    // Backend - List semua data
    public function list()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->orderBy('id_sidi', 'DESC')
            ->get()->getResultArray();
    }

    // List data baru (status pending)
    public function listbaru()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->where('status', '0')
            ->orderBy('id_sidi', 'DESC')
            ->get()->getResultArray();
    }

    // Total data baru
    public function totalbaru()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->where('status', '0')
            ->countAllResults();
    }

    // Data yang sudah disetujui
    public function getaktif()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->where('status', '1')
            ->orderBy('id_sidi', 'DESC')
            ->get()->getResultArray();
    }

    // Data yang ditolak
    public function getditolak()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->where('status', '2')
            ->orderBy('id_sidi', 'DESC')
            ->get()->getResultArray();
    }

    // Total pendaftar
    public function totalpendaftar()
    {
        return $this->table('custome__pendaftaran_sidi')
            ->countAllResults();
    }
}
