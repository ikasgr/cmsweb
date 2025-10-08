<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranTimeline extends Model
{
    protected $table      = 'custome__pendaftaran_timeline';
    protected $primaryKey = 'timeline_id';
    protected $allowedFields = [
        'jenis_pendaftaran', 'pendaftaran_id', 'status', 'keterangan', 'user_id', 'tgl_update'
    ];

    // Get timeline by pendaftaran
    public function getTimelineByPendaftaran($jenis_pendaftaran, $pendaftaran_id)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_timeline.*, users.fullname, users.user_image')
            ->join('users', 'users.id = custome__pendaftaran_timeline.user_id', 'left')
            ->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('pendaftaran_id', $pendaftaran_id)
            ->orderBy('tgl_update', 'DESC')
            ->get()->getResultArray();
    }

    // Add timeline entry
    public function addTimeline($jenis_pendaftaran, $pendaftaran_id, $status, $keterangan = null, $user_id = null)
    {
        $data = [
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'pendaftaran_id' => $pendaftaran_id,
            'status' => $status,
            'keterangan' => $keterangan,
            'user_id' => $user_id ?? session()->get('id'),
            'tgl_update' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    // Get timeline terbaru
    public function getRecentTimeline($limit = 10)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_timeline.*, users.fullname')
            ->join('users', 'users.id = custome__pendaftaran_timeline.user_id', 'left')
            ->orderBy('tgl_update', 'DESC')
            ->limit($limit)
            ->get()->getResultArray();
    }

    // Get timeline by jenis pendaftaran
    public function getByJenisPendaftaran($jenis_pendaftaran, $limit = 50)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->orderBy('tgl_update', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Get timeline by status
    public function getByStatus($status, $limit = 50)
    {
        return $this->where('status', $status)
                    ->orderBy('tgl_update', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Get aktivitas user
    public function getAktivitasUser($user_id, $limit = 20)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('tgl_update', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Get statistik timeline
    public function getStatistik($jenis_pendaftaran = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        if ($jenis_pendaftaran) {
            $builder->where('jenis_pendaftaran', $jenis_pendaftaran);
        }

        // Group by status
        $result = $builder->select('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->get()->getResultArray();

        $stats = [];
        foreach ($result as $row) {
            $stats[$row['status']] = $row['jumlah'];
        }

        return $stats;
    }

    // Get timeline hari ini
    public function getTimelineToday()
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_timeline.*, users.fullname')
            ->join('users', 'users.id = custome__pendaftaran_timeline.user_id', 'left')
            ->where('DATE(tgl_update)', date('Y-m-d'))
            ->orderBy('tgl_update', 'DESC')
            ->get()->getResultArray();
    }
}
