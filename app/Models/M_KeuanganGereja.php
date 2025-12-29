<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KeuanganGereja extends Model
{
    protected $table = 'custome__transaksi_keuangan';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'kode_transaksi',
        'id_kategori',
        'tanggal_transaksi',
        'jenis_transaksi',
        'jumlah',
        'sumber_dana',
        'penerima',
        'keterangan',
        'bukti_transaksi',
        'metode_pembayaran',
        'no_referensi',
        'id_jadwal_ibadah',
        'status',
        'disetujui_oleh',
        'tanggal_persetujuan',
        'catatan_persetujuan',
        'created_by'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // List semua transaksi dengan join kategori
    public function list()
    {
        return $this->select('
            custome__transaksi_keuangan.*,
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->orderBy('tanggal_transaksi', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // List transaksi berdasarkan periode
    public function listByPeriode($tanggal_mulai, $tanggal_selesai)
    {
        return $this->select('
            custome__transaksi_keuangan.*,
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('tanggal_transaksi >=', $tanggal_mulai)
            ->where('tanggal_transaksi <=', $tanggal_selesai)
            ->where('status', 'Disetujui')
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();
    }

    // List transaksi berdasarkan jenis
    public function listByJenis($jenis, $limit = null)
    {
        $builder = $this->select('
            custome__transaksi_keuangan.*,
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('jenis_transaksi', $jenis)
            ->where('status', 'Disetujui')
            ->orderBy('tanggal_transaksi', 'DESC');

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    // Generate kode transaksi otomatis
    public function generateKodeTransaksi()
    {
        $prefix = 'TRX';
        $today = date('Ymd');

        // Cari transaksi terakhir hari ini
        $lastTransaction = $this->like('kode_transaksi', $prefix . $today)
            ->orderBy('id_transaksi', 'DESC')
            ->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction['kode_transaksi'], -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . $today . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Statistik keuangan
    public function getStatistik($periode = 'bulan_ini')
    {
        $today = date('Y-m-d');
        $thisMonth = date('Y-m');
        $thisYear = date('Y');

        switch ($periode) {
            case 'hari_ini':
                $where = "tanggal_transaksi = '$today'";
                break;
            case 'bulan_ini':
                $where = "DATE_FORMAT(tanggal_transaksi, '%Y-%m') = '$thisMonth'";
                break;
            case 'tahun_ini':
                $where = "YEAR(tanggal_transaksi) = '$thisYear'";
                break;
            default:
                $where = "DATE_FORMAT(tanggal_transaksi, '%Y-%m') = '$thisMonth'";
        }

        // Total pemasukan
        $resPemasukan = $this->selectSum('jumlah')
            ->where('jenis_transaksi', 'Pemasukan')
            ->where('status', 'Disetujui')
            ->where($where)
            ->first();
        $pemasukan = $resPemasukan['jumlah'] ?? 0;

        // Total pengeluaran
        $resPengeluaran = $this->selectSum('jumlah')
            ->where('jenis_transaksi', 'Pengeluaran')
            ->where('status', 'Disetujui')
            ->where($where)
            ->first();
        $pengeluaran = $resPengeluaran['jumlah'] ?? 0;

        // Saldo
        $saldo = $pemasukan - $pengeluaran;

        // Jumlah transaksi
        $jumlah_transaksi = $this->where('status', 'Disetujui')
            ->where($where)
            ->countAllResults();

        return [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo,
            'jumlah_transaksi' => $jumlah_transaksi
        ];
    }

    // Statistik berdasarkan status
    public function getStatistikStatus()
    {
        $pending = $this->where('status', 'Pending')->countAllResults();
        $disetujui = $this->where('status', 'Disetujui')->countAllResults();
        $ditolak = $this->where('status', 'Ditolak')->countAllResults();
        $dibatalkan = $this->where('status', 'Dibatalkan')->countAllResults();

        return [
            'pending' => $pending,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
            'dibatalkan' => $dibatalkan
        ];
    }

    // Grafik pemasukan vs pengeluaran per bulan
    public function getGrafikBulanan($tahun = null)
    {
        if (!$tahun) {
            $tahun = date('Y');
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan = str_pad($i, 2, '0', STR_PAD_LEFT);

            $resPemasukan = $this->selectSum('jumlah')
                ->where('jenis_transaksi', 'Pemasukan')
                ->where('status', 'Disetujui')
                ->where("DATE_FORMAT(tanggal_transaksi, '%Y-%m')", "$tahun-$bulan")
                ->first();
            $pemasukan = $resPemasukan['jumlah'] ?? 0;

            $resPengeluaran = $this->selectSum('jumlah')
                ->where('jenis_transaksi', 'Pengeluaran')
                ->where('status', 'Disetujui')
                ->where("DATE_FORMAT(tanggal_transaksi, '%Y-%m')", "$tahun-$bulan")
                ->first();
            $pengeluaran = $resPengeluaran['jumlah'] ?? 0;

            $data[] = [
                'bulan' => $i,
                'nama_bulan' => date('F', mktime(0, 0, 0, $i, 1)),
                'pemasukan' => (float) $pemasukan,
                'pengeluaran' => (float) $pengeluaran,
                'saldo' => (float) ($pemasukan - $pengeluaran)
            ];
        }

        return $data;
    }

    // Top kategori pemasukan
    public function getTopKategoriPemasukan($limit = 5, $periode = 'bulan_ini')
    {
        $thisMonth = date('Y-m');

        return $this->select('
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna,
            SUM(custome__transaksi_keuangan.jumlah) as total
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('jenis_transaksi', 'Pemasukan')
            ->where('status', 'Disetujui')
            ->where("DATE_FORMAT(tanggal_transaksi, '%Y-%m')", $thisMonth)
            ->groupBy('custome__transaksi_keuangan.id_kategori')
            ->orderBy('total', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Top kategori pengeluaran
    public function getTopKategoriPengeluaran($limit = 5, $periode = 'bulan_ini')
    {
        $thisMonth = date('Y-m');

        return $this->select('
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna,
            SUM(custome__transaksi_keuangan.jumlah) as total
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('jenis_transaksi', 'Pengeluaran')
            ->where('status', 'Disetujui')
            ->where("DATE_FORMAT(tanggal_transaksi, '%Y-%m')", $thisMonth)
            ->groupBy('custome__transaksi_keuangan.id_kategori')
            ->orderBy('total', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Update status transaksi
    public function updateStatus($id_transaksi, $status, $user_id, $catatan = null)
    {
        $data = [
            'status' => $status,
            'disetujui_oleh' => $user_id,
            'tanggal_persetujuan' => date('Y-m-d H:i:s'),
            'catatan_persetujuan' => $catatan
        ];

        return $this->update($id_transaksi, $data);
    }

    // Search transaksi
    public function searchTransaksi($keyword)
    {
        return $this->select('
            custome__transaksi_keuangan.*,
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->like('kode_transaksi', $keyword)
            ->orLike('keterangan', $keyword)
            ->orLike('sumber_dana', $keyword)
            ->orLike('penerima', $keyword)
            ->orLike('custome__kategori_keuangan.nama_kategori', $keyword)
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();
    }

    // Transaksi pending approval
    public function getPendingApproval()
    {
        return $this->select('
            custome__transaksi_keuangan.*,
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('status', 'Pending')
            ->orderBy('created_at', 'ASC')
            ->findAll();
    }

    // Laporan keuangan periode
    public function getLaporanPeriode($tanggal_mulai, $tanggal_selesai)
    {
        // Summary
        $summary = $this->getStatistikPeriode($tanggal_mulai, $tanggal_selesai);

        // Detail per kategori
        $detail_pemasukan = $this->select('
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna,
            SUM(custome__transaksi_keuangan.jumlah) as total,
            COUNT(custome__transaksi_keuangan.id_transaksi) as jumlah_transaksi
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('jenis_transaksi', 'Pemasukan')
            ->where('status', 'Disetujui')
            ->where('tanggal_transaksi >=', $tanggal_mulai)
            ->where('tanggal_transaksi <=', $tanggal_selesai)
            ->groupBy('custome__transaksi_keuangan.id_kategori')
            ->orderBy('total', 'DESC')
            ->findAll();

        $detail_pengeluaran = $this->select('
            custome__kategori_keuangan.nama_kategori,
            custome__kategori_keuangan.warna,
            SUM(custome__transaksi_keuangan.jumlah) as total,
            COUNT(custome__transaksi_keuangan.id_transaksi) as jumlah_transaksi
        ')
            ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
            ->where('jenis_transaksi', 'Pengeluaran')
            ->where('status', 'Disetujui')
            ->where('tanggal_transaksi >=', $tanggal_mulai)
            ->where('tanggal_transaksi <=', $tanggal_selesai)
            ->groupBy('custome__transaksi_keuangan.id_kategori')
            ->orderBy('total', 'DESC')
            ->findAll();

        return [
            'summary' => $summary,
            'detail_pemasukan' => $detail_pemasukan,
            'detail_pengeluaran' => $detail_pengeluaran
        ];
    }

    // Statistik periode custom
    private function getStatistikPeriode($tanggal_mulai, $tanggal_selesai)
    {
        $resPemasukan = $this->selectSum('jumlah')
            ->where('jenis_transaksi', 'Pemasukan')
            ->where('status', 'Disetujui')
            ->where('tanggal_transaksi >=', $tanggal_mulai)
            ->where('tanggal_transaksi <=', $tanggal_selesai)
            ->first();
        $pemasukan = $resPemasukan['jumlah'] ?? 0;

        $resPengeluaran = $this->selectSum('jumlah')
            ->where('jenis_transaksi', 'Pengeluaran')
            ->where('status', 'Disetujui')
            ->where('tanggal_transaksi >=', $tanggal_mulai)
            ->where('tanggal_transaksi <=', $tanggal_selesai)
            ->first();
        $pengeluaran = $resPengeluaran['jumlah'] ?? 0;

        return [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $pemasukan - $pengeluaran
        ];
    }
}
