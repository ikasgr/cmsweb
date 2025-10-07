<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranBaptis extends Model
{
    protected $table      = 'custome__pendaftaran_baptis';
    protected $primaryKey = 'id_baptis';
    protected $allowedFields = [
        'nama_lengkap', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'alamat', 
        'no_hp', 'email', 'nama_ayah', 'nama_ibu', 'jenis_baptis',
        'nama_pendamping', 'hubungan_pendamping', 'tgl_daftar', 'tgl_baptis', 
        'status', 'keterangan',
        'dok_ktp', 'dok_kk', 'dok_akta_lahir', 'dok_foto', 'dok_surat_nikah_ortu'
    ];

    // Backend - List semua data
    public function list()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->orderBy('id_baptis', 'DESC')
            ->get()->getResultArray();
    }

    // List data baru (status pending)
    public function listbaru()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->where('status', '0')
            ->orderBy('id_baptis', 'DESC')
            ->get()->getResultArray();
    }

    // Total data baru
    public function totalbaru()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->where('status', '0')
            ->countAllResults();
    }

    // Data yang sudah disetujui
    public function getaktif()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->where('status', '1')
            ->orderBy('id_baptis', 'DESC')
            ->get()->getResultArray();
    }

    // Data yang ditolak
    public function getditolak()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->where('status', '2')
            ->orderBy('id_baptis', 'DESC')
            ->get()->getResultArray();
    }

    // Total pendaftar
    public function totalpendaftar()
    {
        return $this->table('custome__pendaftaran_baptis')
            ->countAllResults();
    }
}
