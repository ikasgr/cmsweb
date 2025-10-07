<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JadwalPelayanan extends Model
{
    protected $table      = 'custome__jadwal_pelayanan';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = [
        'judul_jadwal', 'jenis_pelayanan', 'tanggal', 'waktu_mulai', 'waktu_selesai',
        'tempat', 'pengkhotbah', 'liturgis', 'singer', 'pemusik', 'multimedia',
        'usher', 'keterangan', 'status', 'warna', 'user_id', 'tgl_input'
    ];

    // List semua jadwal
    public function list()
    {
        return $this->table('custome__jadwal_pelayanan')
            ->select('custome__jadwal_pelayanan.*, users.fullname')
            ->join('users', 'users.id = custome__jadwal_pelayanan.user_id', 'left')
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal aktif untuk frontend
    public function listaktif()
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('status', '1')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu_mulai', 'ASC');
    }

    // Jadwal by tanggal
    public function bytanggal($tanggal)
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('tanggal', $tanggal)
            ->where('status', '1')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal by bulan
    public function bybulan($tahun, $bulan)
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('YEAR(tanggal)', $tahun)
            ->where('MONTH(tanggal)', $bulan)
            ->where('status', '1')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal by jenis pelayanan
    public function byjenis($jenis_pelayanan)
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('jenis_pelayanan', $jenis_pelayanan)
            ->where('status', '1')
            ->where('tanggal >=', date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal minggu ini
    public function mingguini()
    {
        $start = date('Y-m-d', strtotime('monday this week'));
        $end = date('Y-m-d', strtotime('sunday this week'));
        
        return $this->table('custome__jadwal_pelayanan')
            ->where('tanggal >=', $start)
            ->where('tanggal <=', $end)
            ->where('status', '1')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal hari ini
    public function hariini()
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('tanggal', date('Y-m-d'))
            ->where('status', '1')
            ->orderBy('waktu_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Jadwal mendatang (upcoming)
    public function upcoming($limit = 5)
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('tanggal >=', date('Y-m-d'))
            ->where('status', '1')
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu_mulai', 'ASC')
            ->limit($limit)
            ->get()->getResultArray();
    }

    // Jadwal untuk calendar (format JSON)
    public function forcalendar($start_date, $end_date)
    {
        $jadwal = $this->table('custome__jadwal_pelayanan')
            ->where('tanggal >=', $start_date)
            ->where('tanggal <=', $end_date)
            ->where('status', '1')
            ->get()->getResultArray();

        $events = [];
        foreach ($jadwal as $item) {
            $events[] = [
                'id' => $item['id_jadwal'],
                'title' => $item['judul_jadwal'],
                'start' => $item['tanggal'] . 'T' . $item['waktu_mulai'],
                'end' => $item['tanggal'] . 'T' . $item['waktu_selesai'],
                'backgroundColor' => $item['warna'] ?? '#007bff',
                'borderColor' => $item['warna'] ?? '#007bff',
                'extendedProps' => [
                    'jenis' => $item['jenis_pelayanan'],
                    'tempat' => $item['tempat'],
                    'pengkhotbah' => $item['pengkhotbah'],
                ]
            ];
        }
        
        return $events;
    }

    // Total jadwal
    public function totaljadwal()
    {
        return $this->table('custome__jadwal_pelayanan')
            ->countAllResults();
    }

    // Total jadwal aktif
    public function totaljadwalaktif()
    {
        return $this->table('custome__jadwal_pelayanan')
            ->where('status', '1')
            ->countAllResults();
    }
}
