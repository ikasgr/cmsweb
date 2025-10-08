<?php

namespace App\Models;

use CodeIgniter\Model;

class M_JadwalIbadah extends Model
{
    protected $table      = 'custome__jadwal_ibadah';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = [
        'id_jenis_ibadah', 'judul_ibadah', 'tanggal', 'jam_mulai', 'jam_selesai',
        'tempat', 'tema_ibadah', 'ayat_tema', 'liturgi', 'keterangan', 'max_peserta',
        'is_recurring', 'recurring_type', 'recurring_end', 'status', 'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua jadwal dengan join jenis ibadah
    public function list()
    {
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('jam_mulai', 'ASC')
                    ->findAll();
    }

    // List jadwal berdasarkan bulan dan tahun
    public function listByMonth($bulan, $tahun)
    {
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->where('MONTH(tanggal)', $bulan)
                    ->where('YEAR(tanggal)', $tahun)
                    ->orderBy('tanggal', 'ASC')
                    ->orderBy('jam_mulai', 'ASC')
                    ->findAll();
    }

    // List jadwal hari ini
    public function listToday()
    {
        $today = date('Y-m-d');
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->where('tanggal', $today)
                    ->orderBy('jam_mulai', 'ASC')
                    ->findAll();
    }

    // List jadwal minggu ini
    public function listThisWeek()
    {
        $startWeek = date('Y-m-d', strtotime('monday this week'));
        $endWeek = date('Y-m-d', strtotime('sunday this week'));
        
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->where('tanggal >=', $startWeek)
                    ->where('tanggal <=', $endWeek)
                    ->orderBy('tanggal', 'ASC')
                    ->orderBy('jam_mulai', 'ASC')
                    ->findAll();
    }

    // List jadwal mendatang (7 hari ke depan)
    public function listUpcoming($days = 7)
    {
        $today = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime("+$days days"));
        
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->where('tanggal >=', $today)
                    ->where('tanggal <=', $endDate)
                    ->where('status', 'Terjadwal')
                    ->orderBy('tanggal', 'ASC')
                    ->orderBy('jam_mulai', 'ASC')
                    ->findAll();
    }

    // Get jadwal untuk calendar (format JSON)
    public function getCalendarEvents($start = null, $end = null)
    {
        $builder = $this->select('
            custome__jadwal_ibadah.id_jadwal as id,
            custome__jadwal_ibadah.judul_ibadah as title,
            CONCAT(custome__jadwal_ibadah.tanggal, " ", custome__jadwal_ibadah.jam_mulai) as start,
            CONCAT(custome__jadwal_ibadah.tanggal, " ", custome__jadwal_ibadah.jam_selesai) as end,
            custome__jenis_ibadah.warna as color,
            custome__jadwal_ibadah.tempat,
            custome__jadwal_ibadah.tema_ibadah,
            custome__jadwal_ibadah.status
        ')
        ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah');

        if ($start) {
            $builder->where('tanggal >=', $start);
        }
        if ($end) {
            $builder->where('tanggal <=', $end);
        }

        return $builder->findAll();
    }

    // Statistik jadwal
    public function getStatistik()
    {
        $total = $this->countAll();
        $bulanIni = $this->where('MONTH(tanggal)', date('m'))
                         ->where('YEAR(tanggal)', date('Y'))
                         ->countAllResults();
        $mingguIni = $this->where('tanggal >=', date('Y-m-d', strtotime('monday this week')))
                          ->where('tanggal <=', date('Y-m-d', strtotime('sunday this week')))
                          ->countAllResults();
        $hariIni = $this->where('tanggal', date('Y-m-d'))->countAllResults();

        return [
            'total' => $total,
            'bulan_ini' => $bulanIni,
            'minggu_ini' => $mingguIni,
            'hari_ini' => $hariIni
        ];
    }

    // Statistik berdasarkan status
    public function getStatistikStatus()
    {
        $terjadwal = $this->where('status', 'Terjadwal')->countAllResults();
        $berlangsung = $this->where('status', 'Berlangsung')->countAllResults();
        $selesai = $this->where('status', 'Selesai')->countAllResults();
        $dibatalkan = $this->where('status', 'Dibatalkan')->countAllResults();

        return [
            'terjadwal' => $terjadwal,
            'berlangsung' => $berlangsung,
            'selesai' => $selesai,
            'dibatalkan' => $dibatalkan
        ];
    }

    // Cek konflik jadwal
    public function cekKonflik($tanggal, $jam_mulai, $jam_selesai, $id_jadwal = null)
    {
        $builder = $this->where('tanggal', $tanggal)
                        ->where('status !=', 'Dibatalkan')
                        ->groupStart()
                            ->where('jam_mulai <=', $jam_mulai)
                            ->where('jam_selesai >', $jam_mulai)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('jam_mulai <', $jam_selesai)
                            ->where('jam_selesai >=', $jam_selesai)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('jam_mulai >=', $jam_mulai)
                            ->where('jam_selesai <=', $jam_selesai)
                        ->groupEnd();

        if ($id_jadwal) {
            $builder->where('id_jadwal !=', $id_jadwal);
        }

        return $builder->first();
    }

    // Update status jadwal
    public function updateStatus($id_jadwal, $status)
    {
        return $this->update($id_jadwal, ['status' => $status]);
    }

    // Generate jadwal recurring
    public function generateRecurring($id_jadwal)
    {
        $jadwal = $this->find($id_jadwal);
        if (!$jadwal || !$jadwal['is_recurring']) {
            return false;
        }

        $tanggal_mulai = $jadwal['tanggal'];
        $tanggal_akhir = $jadwal['recurring_end'];
        $type = $jadwal['recurring_type'];

        $generated = [];
        $current_date = strtotime($tanggal_mulai);
        $end_date = strtotime($tanggal_akhir);

        while ($current_date <= $end_date) {
            // Skip tanggal pertama (sudah ada)
            if (date('Y-m-d', $current_date) != $tanggal_mulai) {
                $new_jadwal = $jadwal;
                unset($new_jadwal['id_jadwal']);
                $new_jadwal['tanggal'] = date('Y-m-d', $current_date);
                $new_jadwal['is_recurring'] = 0; // Jadwal hasil generate bukan recurring
                
                $this->insert($new_jadwal);
                $generated[] = date('Y-m-d', $current_date);
            }

            // Increment berdasarkan tipe recurring
            switch ($type) {
                case 'Mingguan':
                    $current_date = strtotime('+1 week', $current_date);
                    break;
                case 'Bulanan':
                    $current_date = strtotime('+1 month', $current_date);
                    break;
                case 'Tahunan':
                    $current_date = strtotime('+1 year', $current_date);
                    break;
            }
        }

        return $generated;
    }

    // Get detail jadwal dengan semua relasi
    public function getDetailLengkap($id_jadwal)
    {
        $jadwal = $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                       ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                       ->find($id_jadwal);

        if (!$jadwal) {
            return null;
        }

        // Get pelayan
        $pelayanModel = new M_PelayanIbadah();
        $jadwal['pelayan'] = $pelayanModel->getByJadwal($id_jadwal);

        // Get musik
        $musikModel = new M_MusikIbadah();
        $jadwal['musik'] = $musikModel->getByJadwal($id_jadwal);

        // Get pengumuman
        $pengumumanModel = new M_PengumumanIbadah();
        $jadwal['pengumuman'] = $pengumumanModel->getByJadwal($id_jadwal);

        return $jadwal;
    }

    // Search jadwal
    public function searchJadwal($keyword)
    {
        return $this->select('custome__jadwal_ibadah.*, custome__jenis_ibadah.nama_jenis, custome__jenis_ibadah.warna')
                    ->join('custome__jenis_ibadah', 'custome__jenis_ibadah.id_jenis_ibadah = custome__jadwal_ibadah.id_jenis_ibadah')
                    ->like('judul_ibadah', $keyword)
                    ->orLike('tema_ibadah', $keyword)
                    ->orLike('tempat', $keyword)
                    ->orLike('custome__jenis_ibadah.nama_jenis', $keyword)
                    ->orderBy('tanggal', 'DESC')
                    ->findAll();
    }
}
