<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pesanan extends Model
{
    protected $table      = 'custome__pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $allowedFields = [
        'no_pesanan', 'user_id', 'nama_pemesan', 'email', 'no_hp', 'alamat',
        'provinsi', 'kota', 'kecamatan', 'kode_pos', 'total_harga', 'ongkir',
        'grand_total', 'metode_pembayaran', 'status_pembayaran', 'status_pesanan',
        'bukti_transfer', 'catatan', 'tgl_pesan', 'tgl_bayar', 'tgl_kirim', 'tgl_selesai',
        'resi_pengiriman', 'kurir'
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

    // Generate nomor pesanan
    public function generateNoPesanan()
    {
        $prefix = 'ORD';
        $date = date('Ymd');
        
        // Cari nomor terakhir hari ini
        $last = $this->table('custome__pesanan')
            ->like('no_pesanan', $prefix . $date, 'after')
            ->orderBy('id_pesanan', 'DESC')
            ->limit(1)
            ->get()->getRow();
        
        if ($last) {
            $lastNumber = (int) substr($last->no_pesanan, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
