<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Jemaat extends Model
{
    protected $table      = 'custome__jemaat';
    protected $primaryKey = 'id_jemaat';
    protected $allowedFields = [
        'no_anggota', 'nama_lengkap', 'nama_panggilan', 'tempat_lahir', 'tgl_lahir', 
        'jenis_kelamin', 'alamat_lengkap', 'rt_rw', 'kelurahan', 'kecamatan', 'kota', 
        'kode_pos', 'no_hp', 'email', 'pekerjaan', 'pendidikan', 'status_pernikahan',
        'nama_ayah', 'nama_ibu', 'nama_pasangan', 'tgl_baptis', 'tempat_baptis', 
        'pendeta_baptis', 'tgl_sidi', 'tempat_sidi', 'pendeta_sidi', 'tgl_nikah', 
        'tempat_nikah', 'pendeta_nikah', 'status_keanggotaan', 'tgl_bergabung', 
        'tgl_pindah', 'tgl_meninggal', 'gereja_asal', 'gereja_tujuan', 'keterangan', 'foto'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // List semua jemaat
    public function list()
    {
        return $this->orderBy('nama_lengkap', 'ASC')->findAll();
    }

    // List jemaat aktif
    public function listAktif()
    {
        return $this->where('status_keanggotaan', 'Aktif')
                    ->orderBy('nama_lengkap', 'ASC')
                    ->findAll();
    }

    // Cari jemaat berdasarkan nama atau nomor anggota
    public function cariJemaat($keyword)
    {
        return $this->like('nama_lengkap', $keyword)
                    ->orLike('no_anggota', $keyword)
                    ->orLike('nama_panggilan', $keyword)
                    ->orderBy('nama_lengkap', 'ASC')
                    ->findAll();
    }

    // Generate nomor anggota otomatis
    public function generateNoAnggota()
    {
        $lastMember = $this->orderBy('id_jemaat', 'DESC')->first();
        if ($lastMember) {
            $lastNumber = (int) substr($lastMember['no_anggota'], 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        return 'JMT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Statistik jemaat
    public function getStatistik()
    {
        $total = $this->countAll();
        $aktif = $this->where('status_keanggotaan', 'Aktif')->countAllResults();
        $pindah = $this->where('status_keanggotaan', 'Pindah')->countAllResults();
        $meninggal = $this->where('status_keanggotaan', 'Meninggal')->countAllResults();
        $nonaktif = $this->where('status_keanggotaan', 'Non-Aktif')->countAllResults();

        return [
            'total' => $total,
            'aktif' => $aktif,
            'pindah' => $pindah,
            'meninggal' => $meninggal,
            'nonaktif' => $nonaktif
        ];
    }

    // Jemaat berdasarkan jenis kelamin
    public function getByJenisKelamin()
    {
        $laki = $this->where('jenis_kelamin', 'L')
                     ->where('status_keanggotaan', 'Aktif')
                     ->countAllResults();
        $perempuan = $this->where('jenis_kelamin', 'P')
                          ->where('status_keanggotaan', 'Aktif')
                          ->countAllResults();

        return [
            'laki_laki' => $laki,
            'perempuan' => $perempuan
        ];
    }

    // Jemaat berdasarkan kelompok umur
    public function getByKelompokUmur()
    {
        $today = date('Y-m-d');
        
        $anak = $this->where('status_keanggotaan', 'Aktif')
                     ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') <", 13)
                     ->countAllResults();
        
        $remaja = $this->where('status_keanggotaan', 'Aktif')
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') >=", 13)
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') <", 18)
                       ->countAllResults();
        
        $pemuda = $this->where('status_keanggotaan', 'Aktif')
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') >=", 18)
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') <", 30)
                       ->countAllResults();
        
        $dewasa = $this->where('status_keanggotaan', 'Aktif')
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') >=", 30)
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') <", 60)
                       ->countAllResults();
        
        $lansia = $this->where('status_keanggotaan', 'Aktif')
                       ->where("TIMESTAMPDIFF(YEAR, tgl_lahir, '$today') >=", 60)
                       ->countAllResults();

        return [
            'anak' => $anak,
            'remaja' => $remaja,
            'pemuda' => $pemuda,
            'dewasa' => $dewasa,
            'lansia' => $lansia
        ];
    }

    // Jemaat yang berulang tahun bulan ini
    public function getUlangTahunBulanIni()
    {
        $bulan = date('m');
        return $this->where('status_keanggotaan', 'Aktif')
                    ->where("MONTH(tgl_lahir)", $bulan)
                    ->orderBy('DAY(tgl_lahir)', 'ASC')
                    ->findAll();
    }

    // Jemaat baru (bergabung dalam 30 hari terakhir)
    public function getJemaatBaru()
    {
        $tanggal30HariLalu = date('Y-m-d', strtotime('-30 days'));
        return $this->where('tgl_bergabung >=', $tanggal30HariLalu)
                    ->orderBy('tgl_bergabung', 'DESC')
                    ->findAll();
    }

    // Validasi nomor anggota unik
    public function isNoAnggotaExists($no_anggota, $id_jemaat = null)
    {
        $query = $this->where('no_anggota', $no_anggota);
        if ($id_jemaat) {
            $query->where('id_jemaat !=', $id_jemaat);
        }
        return $query->first() ? true : false;
    }

    // Update status keanggotaan
    public function updateStatus($id_jemaat, $status, $tanggal = null, $keterangan = null)
    {
        $data = ['status_keanggotaan' => $status];
        
        if ($status == 'Pindah' && $tanggal) {
            $data['tgl_pindah'] = $tanggal;
        } elseif ($status == 'Meninggal' && $tanggal) {
            $data['tgl_meninggal'] = $tanggal;
        }
        
        if ($keterangan) {
            $data['keterangan'] = $keterangan;
        }

        return $this->update($id_jemaat, $data);
    }
}
