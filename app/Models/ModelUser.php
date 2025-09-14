<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email', 'username', 'opd_id', 'id_grup', 'fullname', 'user_image',
        'password_hash', 'active', 'level', 'activate_hash', 'reset_hash', 'reset_expires',
        'last_login', 'sts_on', 'login_attempts', 'nomor_wa', 'otp_code'

    ];

    //backend
    public function list()
    {
        return $this->table('users')
            // ->join('custome__opd', 'custome__opd.opd_id = users.opd_id')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function listuserall()
    {
        return $this->table('users')
            ->where('level !=', 'admin')
            ->orWhere('level IS NULL')
            ->get()->getResultArray();
    }

    # add berita
    public function listaddnews($id)
    {
        return $this->table('users')
            ->where('active', 1)
            ->get()->getResultArray();
    }


    public function listbyid($id)
    {
        return $this->table('users')
            // ->join('custome__opd', 'custome__opd.opd_id = users.opd_id')
            ->where('id', $id)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }


    public function getaktif()
    {
        return $this->table('users')
            ->like('active', '1')
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getnonaktif()
    {
        return $this->table('users')
            ->where('active', 0)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getonline()
    {
        return $this->table('users')
            ->where('sts_on', 1)
            ->orderBy('id', 'ASC')
            ->get()->getResultArray();
    }

    public function getaktif5()
    {
        return $this->table('users')
            ->like('active', '1')
            ->orderBy('last_login', 'DESC')
            ->get(5, 0)->getResultArray();
    }

    public function getonline5($id)
    {
        return $this->table('users')
            ->where('sts_on', 1)
            ->where('id !=', $id)
            ->orderBy('id', 'ASC')
            ->get(5, 0)->getResultArray();
    }

    public function resetstatus()
    {
        $this->db->table('users')
            ->update(['sts_on' => 0]);
    }

    public function kunjungan()
    {
        // Ambil IP dan tanggal
        $ip         = $_SERVER['REMOTE_ADDR'];
        $date       = date("Y-m-d");  // Menggunakan tanggal agar data hanya dihitung per hari
        $waktu      = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Debugging: Log untuk memastikan IP dan tanggal yang digunakan
        // log_message('debug', 'IP: ' . $ip . ' Tanggal: ' . $date);

        // Query untuk menambahkan data atau memperbarui jika data sudah ada
        $sql = "
        INSERT INTO visitor (ip, tgl, hits, online, time)
        VALUES (?, ?, 1, ?, ?)
        ON DUPLICATE KEY UPDATE
        hits = hits + 1,  -- Menambah jumlah hits jika sudah ada
        online = ?,      -- Memperbarui waktu online
        time = ?         -- Memperbarui waktu entry
    ";
        // Eksekusi query menggunakan db->query
        $this->db->query($sql, [
            $ip, $date, $waktu, $timeinsert, $waktu, $timeinsert
        ]);
    }

    public function countOnlineVisitors()
    {
        $timeLimit = time() - 300; // 30 menit sebelumnya
        $builder = $this->db->table('visitor');
        $query = $builder->where('online >=', $timeLimit)->countAllResults();

        return $query;
    }

    public function totonline()
    {
        $bataswaktu = time() - 300;
        $builder = $this->db->table('visitor');
        $builder->where('online >', $bataswaktu);
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function pengunjungblnini()
    {
        $builder = $this->db->query("SET SESSION sql_mode ='' ");
        $builder = $this->db->table('visitor');
        $builder->where('month(tgl)=', date('m'));
        $builder->groupBy('ip');
        $query = $builder->get();
        return $query->getNumRows();
    }

    public function listuserganda($namauser)
    {
        return $this->table('users')
            ->where('username', $namauser)
            ->get()->getResultArray();
    }
}
