<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pesanan extends Model
{
    protected $table      = 'custome__pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $allowedFields = [
        'kode_pesanan', 'session_id', 'user_id', 'nama_pembeli', 'no_hp', 'alamat', 'email', 'catatan',
        'total_item', 'total_qty', 'subtotal', 'ongkir', 'total_bayar',
        'status_pesanan', 'metode_pembayaran', 'bukti_bayar',
        'tgl_pesanan', 'tgl_diproses', 'tgl_dikirim', 'tgl_selesai',
        'whatsapp_sent', 'tgl_whatsapp', 'admin_id', 'keterangan'
    ];

    // List semua pesanan
    public function list()
    {
        return $this->table('custome__pesanan')
            ->orderBy('id_pesanan', 'DESC')
            ->get()->getResultArray();
    }

    // Pesanan by user
    public function byuser($user_id)
    {
        return $this->table('custome__pesanan')
            ->where('user_id', $user_id)
            ->orderBy('id_pesanan', 'DESC')
            ->get()->getResultArray();
    }

    // Pesanan by status
    public function bystatus($status_pesanan)
    {
        return $this->table('custome__pesanan')
            ->where('status_pesanan', $status_pesanan)
            ->orderBy('id_pesanan', 'DESC')
            ->get()->getResultArray();
    }

    // Detail pesanan by no_pesanan
    public function detail($no_pesanan)
    {
        return $this->table('custome__pesanan')
            ->where('no_pesanan', $no_pesanan)
            ->get()->getRow();
    }

    // Pesanan baru (pending)
    public function pesananbaru()
    {
        return $this->table('custome__pesanan')
            ->where('status_pesanan', 'pending')
            ->countAllResults();
    }

    // Total pesanan
    public function totalpesanan()
    {
        return $this->table('custome__pesanan')
            ->countAllResults();
    }

    // Total pendapatan
    public function totalpendapatan()
    {
        return $this->table('custome__pesanan')
            ->selectSum('grand_total')
            ->where('status_pembayaran', 'paid')
            ->get()->getRow();
    }

    // Generate kode pesanan
    public function generateKodePesanan()
    {
        $prefix = 'PO';
        $date = date('Ymd');
        
        // Cari nomor terakhir hari ini
        $last = $this->table('custome__pesanan')
            ->like('kode_pesanan', $prefix . '-' . $date, 'after')
            ->orderBy('pesanan_id', 'DESC')
            ->limit(1)
            ->get()->getRow();
        
        if ($last) {
            $lastNumber = (int) substr($last->kode_pesanan, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . '-' . $date . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // Get pesanan dengan detail
    public function getPesananWithDetail($pesanan_id)
    {
        $pesanan = $this->find($pesanan_id);
        if (!$pesanan) return null;

        $db = \Config\Database::connect();
        $detail = $db->table('custome__pesanan_detail')
            ->where('pesanan_id', $pesanan_id)
            ->get()->getResultArray();

        $pesanan['detail'] = $detail;
        return $pesanan;
    }

    // Get pesanan by kode
    public function getByKode($kode_pesanan)
    {
        return $this->where('kode_pesanan', $kode_pesanan)->first();
    }
}

