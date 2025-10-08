<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MajelisGereja extends Model
{
    protected $table      = 'custome__majelis_gereja';
    protected $primaryKey = 'majelis_id';
    protected $allowedFields = [
        'nama', 'nip', 'tempat_lahir', 'tgl_lahir', 'jk', 'agama', 'alamat', 'no_hp', 'email',
        'jenis_jabatan', 'jabatan_id', 'tanggal_penahbisan', 'tanggal_pelantikan', 'tanggal_akhir_jabatan',
        'status_jabatan', 'gereja_asal', 'pendidikan_teologi', 'sertifikasi', 'komisi',
        'pangkat', 'jabatan', 'gambar', 'file_sk_pengangkatan', 'file_sertifikat', 'file_foto',
        'publikasi', 'penelitian', 'pengabdian', 'asal_s1', 'asal_s2', 'asal_s3', 'bidang_pakar', 'bio_singkat',
        'created_by', 'updated_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Backend - List all majelis
    public function list()
    {
        return $this->select('custome__majelis_gereja.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__majelis_gereja.jabatan_id', 'left')
            ->orderBy('custome__majelis_gereja.majelis_id', 'DESC')
            ->findAll();
    }

    // Frontend - List with pagination
    public function listMajelisPage()
    {
        return $this->select('custome__majelis_gereja.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__majelis_gereja.jabatan_id', 'left')
            ->where('custome__majelis_gereja.status_jabatan', 'Aktif')
            ->orderBy('custome__majelis_gereja.majelis_id', 'ASC');
    }

    // Frontend - List active majelis for homepage
    public function listaktif()
    {
        return $this->select('custome__majelis_gereja.*, custome__jabatan_majelis.nama_jabatan')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__majelis_gereja.jabatan_id', 'left')
            ->where('custome__majelis_gereja.status_jabatan', 'Aktif')
            ->orderBy('custome__majelis_gereja.majelis_id', 'ASC')
            ->limit(8)
            ->findAll();
    }

    // Get total majelis count
    public function totMajelis()
    {
        return $this->where('status_jabatan', 'Aktif')->countAllResults();
    }

    // Check if NIP exists
    public function cekdata($nip)
    {
        return $this->where('nip', $nip)->first();
    }

    // Get majelis by ID with related data
    public function getMajelisWithDetails($majelis_id)
    {
        return $this->select('custome__majelis_gereja.*, custome__jabatan_majelis.nama_jabatan, custome__jabatan_majelis.deskripsi as jabatan_deskripsi')
            ->join('custome__jabatan_majelis', 'custome__jabatan_majelis.jabatan_id = custome__majelis_gereja.jabatan_id', 'left')
            ->where('custome__majelis_gereja.majelis_id', $majelis_id)
            ->first();
    }

    // Get majelis by jenis jabatan
    public function getByJenisJabatan($jenis_jabatan)
    {
        return $this->where('jenis_jabatan', $jenis_jabatan)
            ->where('status_jabatan', 'Aktif')
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    // Get majelis by status
    public function getByStatus($status)
    {
        return $this->where('status_jabatan', $status)
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    // Get active majelis count by jabatan
    public function countByJabatan($jenis_jabatan)
    {
        return $this->where('jenis_jabatan', $jenis_jabatan)
            ->where('status_jabatan', 'Aktif')
            ->countAllResults();
    }

    // Get majelis with expiring terms (masa jabatan akan habis)
    public function getExpiringTerms($days = 30)
    {
        $date = date('Y-m-d', strtotime("+{$days} days"));
        return $this->where('tanggal_akhir_jabatan <=', $date)
            ->where('tanggal_akhir_jabatan >=', date('Y-m-d'))
            ->where('status_jabatan', 'Aktif')
            ->orderBy('tanggal_akhir_jabatan', 'ASC')
            ->findAll();
    }

    // Search majelis
    public function search($keyword)
    {
        return $this->groupStart()
            ->like('nama', $keyword)
            ->orLike('nip', $keyword)
            ->orLike('jenis_jabatan', $keyword)
            ->orLike('email', $keyword)
            ->orLike('no_hp', $keyword)
            ->groupEnd()
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    // Get statistics for dashboard
    public function getStatistics()
    {
        $stats = [
            'total_majelis' => $this->where('status_jabatan', 'Aktif')->countAllResults(),
            'total_pendeta' => $this->where('jenis_jabatan', 'Pendeta')->where('status_jabatan', 'Aktif')->countAllResults(),
            'total_diakon' => $this->where('jenis_jabatan', 'Diakon')->where('status_jabatan', 'Aktif')->countAllResults(),
            'total_ketua' => $this->where('jenis_jabatan', 'Ketua Majelis')->where('status_jabatan', 'Aktif')->countAllResults(),
            'total_anggota' => $this->where('jenis_jabatan', 'Anggota Majelis')->where('status_jabatan', 'Aktif')->countAllResults(),
            'total_non_aktif' => $this->where('status_jabatan', 'Non-Aktif')->countAllResults(),
        ];

        return $stats;
    }

    // Get majelis grouped by jabatan
    public function getGroupedByJabatan()
    {
        return $this->select('jenis_jabatan, COUNT(*) as jumlah')
            ->where('status_jabatan', 'Aktif')
            ->groupBy('jenis_jabatan')
            ->orderBy('jumlah', 'DESC')
            ->findAll();
    }

    // Update status jabatan
    public function updateStatus($majelis_id, $status)
    {
        return $this->update($majelis_id, ['status_jabatan' => $status]);
    }

    // Get majelis with upcoming ordination anniversary
    public function getUpcomingAnniversary($days = 30)
    {
        $currentMonth = date('m');
        $currentDay = date('d');
        
        return $this->where("MONTH(tanggal_penahbisan) = {$currentMonth}")
            ->where("DAY(tanggal_penahbisan) >= {$currentDay}")
            ->where('status_jabatan', 'Aktif')
            ->orderBy('tanggal_penahbisan', 'ASC')
            ->findAll();
    }
}
