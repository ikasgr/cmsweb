<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranDokumen extends Model
{
    protected $table      = 'custome__pendaftaran_dokumen';
    protected $primaryKey = 'dokumen_id';
    protected $allowedFields = [
        'jenis_pendaftaran', 'pendaftaran_id', 'jenis_dokumen', 'nama_file',
        'file_path', 'file_size', 'file_type', 'status_dokumen', 'keterangan',
        'uploaded_by', 'tgl_upload', 'verified_by', 'tgl_verified'
    ];

    // Get dokumen by pendaftaran
    public function getDokumenByPendaftaran($jenis_pendaftaran, $pendaftaran_id)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('pendaftaran_id', $pendaftaran_id)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get dokumen dengan info user
    public function getDokumenWithUser($jenis_pendaftaran, $pendaftaran_id)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_dokumen.*, 
                      u1.fullname as uploaded_by_name,
                      u2.fullname as verified_by_name')
            ->join('users u1', 'u1.id = custome__pendaftaran_dokumen.uploaded_by', 'left')
            ->join('users u2', 'u2.id = custome__pendaftaran_dokumen.verified_by', 'left')
            ->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('pendaftaran_id', $pendaftaran_id)
            ->orderBy('tgl_upload', 'DESC')
            ->get()->getResultArray();
    }

    // Hitung kelengkapan dokumen (persentase)
    public function hitungKelengkapan($jenis_pendaftaran, $pendaftaran_id)
    {
        $db = \Config\Database::connect();
        
        // Total dokumen wajib
        $totalWajib = $db->table('custome__master_dokumen_pendaftaran')
            ->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('wajib', 1)
            ->where('aktif', 1)
            ->countAllResults();

        if ($totalWajib == 0) return 100;

        // Dokumen wajib yang sudah diupload dan valid
        $uploaded = $this->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('pendaftaran_id', $pendaftaran_id)
            ->whereIn('status_dokumen', ['valid', 'pending'])
            ->countAllResults();

        return round(($uploaded / $totalWajib) * 100);
    }

    // Get dokumen by status
    public function getByStatus($status)
    {
        return $this->where('status_dokumen', $status)
                    ->orderBy('tgl_upload', 'DESC')
                    ->findAll();
    }

    // Update status dokumen
    public function updateStatus($dokumen_id, $status, $keterangan = null, $verified_by = null)
    {
        $data = [
            'status_dokumen' => $status,
            'keterangan' => $keterangan,
            'verified_by' => $verified_by,
            'tgl_verified' => date('Y-m-d H:i:s')
        ];

        return $this->update($dokumen_id, $data);
    }

    // Hapus dokumen dan file fisik
    public function hapusDokumen($dokumen_id)
    {
        $dokumen = $this->find($dokumen_id);
        if (!$dokumen) return false;

        // Hapus file fisik
        $file_path = FCPATH . $dokumen['file_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus record
        return $this->delete($dokumen_id);
    }

    // Get statistik dokumen
    public function getStatistik($jenis_pendaftaran = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        if ($jenis_pendaftaran) {
            $builder->where('jenis_pendaftaran', $jenis_pendaftaran);
        }

        $stats = [
            'total' => $builder->countAllResults(false),
            'pending' => $builder->where('status_dokumen', 'pending')->countAllResults(false),
            'valid' => $builder->where('status_dokumen', 'valid')->countAllResults(false),
            'invalid' => $builder->where('status_dokumen', 'invalid')->countAllResults(false),
            'revisi' => $builder->where('status_dokumen', 'revisi')->countAllResults(false)
        ];

        return $stats;
    }

    // Get dokumen yang perlu diverifikasi
    public function getDokumenPendingVerifikasi($limit = 10)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_dokumen.*, users.fullname as uploaded_by_name')
            ->join('users', 'users.id = custome__pendaftaran_dokumen.uploaded_by', 'left')
            ->where('status_dokumen', 'pending')
            ->orderBy('tgl_upload', 'ASC')
            ->limit($limit)
            ->get()->getResultArray();
    }

    // Check apakah dokumen sudah lengkap
    public function isDokumenLengkap($jenis_pendaftaran, $pendaftaran_id)
    {
        $kelengkapan = $this->hitungKelengkapan($jenis_pendaftaran, $pendaftaran_id);
        return $kelengkapan >= 100;
    }

    // Get missing dokumen (dokumen wajib yang belum diupload)
    public function getMissingDokumen($jenis_pendaftaran, $pendaftaran_id)
    {
        $db = \Config\Database::connect();
        
        // Get semua dokumen wajib
        $masterDokumen = $db->table('custome__master_dokumen_pendaftaran')
            ->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('wajib', 1)
            ->where('aktif', 1)
            ->get()->getResultArray();

        // Get dokumen yang sudah diupload
        $uploadedDokumen = $this->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('pendaftaran_id', $pendaftaran_id)
            ->findAll();

        $uploadedJenis = array_column($uploadedDokumen, 'jenis_dokumen');

        // Filter dokumen yang belum diupload
        $missing = [];
        foreach ($masterDokumen as $master) {
            if (!in_array($master['nama_dokumen'], $uploadedJenis)) {
                $missing[] = $master;
            }
        }

        return $missing;
    }
}
