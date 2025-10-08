<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PelayanIbadah extends Model
{
    protected $table      = 'custome__pelayan_ibadah';
    protected $primaryKey = 'id_pelayan';
    protected $allowedFields = [
        'id_jadwal', 'id_jemaat', 'id_jabatan', 'nama_pelayan', 'keterangan', 'status_konfirmasi'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get pelayan berdasarkan jadwal
    public function getByJadwal($id_jadwal)
    {
        return $this->select('
            custome__pelayan_ibadah.*,
            custome__jabatan_pelayanan.nama_jabatan,
            custome__jabatan_pelayanan.warna,
            custome__jabatan_pelayanan.urutan,
            custome__jemaat.no_anggota,
            custome__jemaat.foto
        ')
        ->join('custome__jabatan_pelayanan', 'custome__jabatan_pelayanan.id_jabatan = custome__pelayan_ibadah.id_jabatan')
        ->join('custome__jemaat', 'custome__jemaat.id_jemaat = custome__pelayan_ibadah.id_jemaat', 'left')
        ->where('id_jadwal', $id_jadwal)
        ->orderBy('custome__jabatan_pelayanan.urutan', 'ASC')
        ->findAll();
    }

    // Get pelayan berdasarkan jemaat
    public function getByJemaat($id_jemaat, $limit = 10)
    {
        return $this->select('
            custome__pelayan_ibadah.*,
            custome__jadwal_ibadah.judul_ibadah,
            custome__jadwal_ibadah.tanggal,
            custome__jadwal_ibadah.jam_mulai,
            custome__jabatan_pelayanan.nama_jabatan
        ')
        ->join('custome__jadwal_ibadah', 'custome__jadwal_ibadah.id_jadwal = custome__pelayan_ibadah.id_jadwal')
        ->join('custome__jabatan_pelayanan', 'custome__jabatan_pelayanan.id_jabatan = custome__pelayan_ibadah.id_jabatan')
        ->where('custome__pelayan_ibadah.id_jemaat', $id_jemaat)
        ->orderBy('custome__jadwal_ibadah.tanggal', 'DESC')
        ->limit($limit)
        ->findAll();
    }

    // Update status konfirmasi
    public function updateKonfirmasi($id_pelayan, $status)
    {
        return $this->update($id_pelayan, ['status_konfirmasi' => $status]);
    }

    // Cek apakah jemaat sudah terjadwal di tanggal tertentu
    public function cekKonflikJemaat($id_jemaat, $tanggal, $id_pelayan = null)
    {
        $builder = $this->select('custome__pelayan_ibadah.*')
                        ->join('custome__jadwal_ibadah', 'custome__jadwal_ibadah.id_jadwal = custome__pelayan_ibadah.id_jadwal')
                        ->where('custome__pelayan_ibadah.id_jemaat', $id_jemaat)
                        ->where('custome__jadwal_ibadah.tanggal', $tanggal)
                        ->where('custome__pelayan_ibadah.status_konfirmasi !=', 'Ditolak');

        if ($id_pelayan) {
            $builder->where('custome__pelayan_ibadah.id_pelayan !=', $id_pelayan);
        }

        return $builder->first();
    }

    // Statistik pelayan
    public function getStatistikPelayan()
    {
        $total = $this->countAll();
        $dikonfirmasi = $this->where('status_konfirmasi', 'Dikonfirmasi')->countAllResults();
        $pending = $this->where('status_konfirmasi', 'Pending')->countAllResults();
        $ditolak = $this->where('status_konfirmasi', 'Ditolak')->countAllResults();

        return [
            'total' => $total,
            'dikonfirmasi' => $dikonfirmasi,
            'pending' => $pending,
            'ditolak' => $ditolak
        ];
    }
}
