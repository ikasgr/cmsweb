<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PendaftaranCatatan extends Model
{
    protected $table      = 'custome__pendaftaran_catatan';
    protected $primaryKey = 'catatan_id';
    protected $allowedFields = [
        'jenis_pendaftaran', 'pendaftaran_id', 'catatan', 'tipe', 'user_id', 'tgl_catatan'
    ];

    // Get catatan by pendaftaran
    public function getCatatanByPendaftaran($jenis_pendaftaran, $pendaftaran_id, $tipe = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table)
            ->select('custome__pendaftaran_catatan.*, users.fullname, users.user_image')
            ->join('users', 'users.id = custome__pendaftaran_catatan.user_id', 'left')
            ->where('jenis_pendaftaran', $jenis_pendaftaran)
            ->where('pendaftaran_id', $pendaftaran_id);

        if ($tipe) {
            $builder->where('tipe', $tipe);
        }

        return $builder->orderBy('tgl_catatan', 'DESC')
                      ->get()->getResultArray();
    }

    // Add catatan
    public function addCatatan($jenis_pendaftaran, $pendaftaran_id, $catatan, $tipe = 'internal', $user_id = null)
    {
        $data = [
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'pendaftaran_id' => $pendaftaran_id,
            'catatan' => $catatan,
            'tipe' => $tipe,
            'user_id' => $user_id ?? session()->get('id'),
            'tgl_catatan' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    // Get catatan internal (admin only)
    public function getCatatanInternal($jenis_pendaftaran, $pendaftaran_id)
    {
        return $this->getCatatanByPendaftaran($jenis_pendaftaran, $pendaftaran_id, 'internal');
    }

    // Get catatan eksternal (visible to user)
    public function getCatatanEksternal($jenis_pendaftaran, $pendaftaran_id)
    {
        return $this->getCatatanByPendaftaran($jenis_pendaftaran, $pendaftaran_id, 'eksternal');
    }

    // Get catatan terbaru
    public function getRecentCatatan($limit = 10)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)
            ->select('custome__pendaftaran_catatan.*, users.fullname')
            ->join('users', 'users.id = custome__pendaftaran_catatan.user_id', 'left')
            ->orderBy('tgl_catatan', 'DESC')
            ->limit($limit)
            ->get()->getResultArray();
    }

    // Count catatan by pendaftaran
    public function countCatatan($jenis_pendaftaran, $pendaftaran_id)
    {
        return $this->where('jenis_pendaftaran', $jenis_pendaftaran)
                    ->where('pendaftaran_id', $pendaftaran_id)
                    ->countAllResults();
    }

    // Get catatan by user
    public function getCatatanByUser($user_id, $limit = 20)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('tgl_catatan', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Update catatan
    public function updateCatatan($catatan_id, $catatan, $tipe = null)
    {
        $data = ['catatan' => $catatan];
        if ($tipe) {
            $data['tipe'] = $tipe;
        }
        return $this->update($catatan_id, $data);
    }

    // Delete catatan
    public function deleteCatatan($catatan_id)
    {
        return $this->delete($catatan_id);
    }
}
