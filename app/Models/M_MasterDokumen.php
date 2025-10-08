<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MasterDokumen extends Model
{
    protected $table      = 'custome__master_dokumen_pendaftaran';
    protected $primaryKey = 'master_dokumen_id';
    protected $allowedFields = [
        'jenis_pendaftaran', 'nama_dokumen', 'keterangan', 'wajib', 'urutan', 'aktif'
    ];

    // Get master dokumen by jenis pendaftaran
    public function getByJenisPendaftaran($jenis_pendaftaran, $aktif_only = true)
    {
        $builder = $this->where('jenis_pendaftaran', $jenis_pendaftaran);
        
        if ($aktif_only) {
            $builder->where('aktif', 1);
        }

        return $builder->orderBy('urutan', 'ASC')->findAll();
    }

    // Get dokumen wajib
    public function getDokumenWajib($jenis_pendaftaran)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('wajib', 1)
                    ->where('aktif', 1)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get dokumen opsional
    public function getDokumenOpsional($jenis_pendaftaran)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('wajib', 0)
                    ->where('aktif', 1)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Count dokumen wajib
    public function countDokumenWajib($jenis_pendaftaran)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('wajib', 1)
                    ->where('aktif', 1)
                    ->countAllResults();
    }

    // Check if dokumen exists
    public function isDokumenExists($jenis_pendaftaran, $nama_dokumen)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('nama_dokumen', $nama_dokumen)
                    ->countAllResults() > 0;
    }

    // Add dokumen baru
    public function addDokumen($jenis_pendaftaran, $nama_dokumen, $keterangan = null, $wajib = 1)
    {
        // Get urutan terakhir
        $last = $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->orderBy('urutan', 'DESC')
                    ->first();

        $urutan = $last ? $last['urutan'] + 1 : 1;

        $data = [
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'nama_dokumen' => $nama_dokumen,
            'keterangan' => $keterangan,
            'wajib' => $wajib,
            'urutan' => $urutan,
            'aktif' => 1
        ];

        return $this->insert($data);
    }

    // Update urutan
    public function updateUrutan($master_dokumen_id, $urutan)
    {
        return $this->update($master_dokumen_id, ['urutan' => $urutan]);
    }

    // Toggle aktif/nonaktif
    public function toggleAktif($master_dokumen_id)
    {
        $dokumen = $this->find($master_dokumen_id);
        if (!$dokumen) return false;

        $aktif = $dokumen['aktif'] == 1 ? 0 : 1;
        return $this->update($master_dokumen_id, ['aktif' => $aktif]);
    }

    // Get all master dokumen (untuk admin)
    public function getAllMaster()
    {
        return $this->orderBy('jenis_pendaftaran', 'ASC')
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get statistik master dokumen
    public function getStatistik()
    {
        $db = \Config\Database::connect();
        
        $stats = [];
        $jenis = ['sidi', 'baptis', 'nikah'];
        
        foreach ($jenis as $j) {
            $total = $this->where('jenis_pendaftaran', $j)->countAllResults(false);
            $wajib = $this->where('wajib', 1)->countAllResults(false);
            $opsional = $this->where('wajib', 0)->countAllResults(false);
            $aktif = $this->where('aktif', 1)->countAllResults();
            
            $stats[$j] = [
                'total' => $total,
                'wajib' => $wajib,
                'opsional' => $opsional,
                'aktif' => $aktif
            ];
        }
        
        return $stats;
    }
}
