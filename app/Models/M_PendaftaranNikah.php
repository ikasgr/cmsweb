<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranNikah extends Model
{
    protected $table      = 'custome__pendaftaran_nikah';
    protected $primaryKey = 'id_nikah';
    protected $allowedFields = [
        // Data Calon Suami
        'nama_pria', 'tempat_lahir_pria', 'tgl_lahir_pria', 'alamat_pria', 
        'no_hp_pria', 'email_pria', 'pekerjaan_pria', 'status_baptis_pria',
        'gereja_baptis_pria', 'nama_ayah_pria', 'nama_ibu_pria',
        // Data Calon Istri
        'nama_wanita', 'tempat_lahir_wanita', 'tgl_lahir_wanita', 'alamat_wanita', 
        'no_hp_wanita', 'email_wanita', 'pekerjaan_wanita', 'status_baptis_wanita',
        'gereja_baptis_wanita', 'nama_ayah_wanita', 'nama_ibu_wanita',
        // Data Pernikahan
        'tgl_daftar', 'tgl_nikah_diinginkan', 'tempat_nikah', 'status', 'keterangan',
        // Dokumen Pria
        'dok_ktp_pria', 'dok_kk_pria', 'dok_baptis_pria', 'dok_sidi_pria', 'dok_foto_pria',
        // Dokumen Wanita
        'dok_ktp_wanita', 'dok_kk_wanita', 'dok_baptis_wanita', 'dok_sidi_wanita', 'dok_foto_wanita',
        // Dokumen Tambahan
        'dok_surat_izin_ortu', 'dok_surat_keterangan_gereja'
    ];

    // Backend - List semua data
    public function list()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->orderBy('id_nikah', 'DESC')
            ->get()->getResultArray();
    }

    // List data baru (status pending)
    public function listbaru()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->where('status', '0')
            ->orderBy('id_nikah', 'DESC')
            ->get()->getResultArray();
    }

    // Total data baru
    public function totalbaru()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->where('status', '0')
            ->countAllResults();
    }

    // Data yang sudah disetujui
    public function getaktif()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->where('status', '1')
            ->orderBy('id_nikah', 'DESC')
            ->get()->getResultArray();
    }

    // Data yang ditolak
    public function getditolak()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->where('status', '2')
            ->orderBy('id_nikah', 'DESC')
            ->get()->getResultArray();
    }

    // Total pendaftar
    public function totalpendaftar()
    {
        return $this->table('custome__pendaftaran_nikah')
            ->countAllResults();
    }
}
