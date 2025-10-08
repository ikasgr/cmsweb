<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Keranjang extends Model
{
    protected $table      = 'custome__keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $allowedFields = ['session_id', 'user_id', 'id_produk', 'jumlah', 'harga', 'subtotal', 'tgl_input'];

    // Keranjang by session
    public function bysession($session_id)
    {
        return $this->table('custome__keranjang')
            ->select('custome__keranjang.*, custome__produk_umkm.nama_produk, custome__produk_umkm.slug_produk, custome__produk_umkm.gambar, custome__produk_umkm.stok, custome__produk_umkm.berat, custome__produk_umkm.satuan, custome__kategori_produk.nama_kategori')
            ->join('custome__produk_umkm', 'custome__produk_umkm.id_produk = custome__keranjang.id_produk')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('session_id', $session_id)
            ->get()->getResultArray();
    }

    // Keranjang by user
    public function byuser($user_id)
    {
        return $this->table('custome__keranjang')
            ->select('custome__keranjang.*, custome__produk_umkm.nama_produk, custome__produk_umkm.gambar, custome__produk_umkm.stok, custome__produk_umkm.berat')
            ->join('custome__produk_umkm', 'custome__produk_umkm.id_produk = custome__keranjang.id_produk')
            ->where('user_id', $user_id)
            ->get()->getResultArray();
    }

    // Total item keranjang
    public function totalitem($session_id)
    {
        return $this->table('custome__keranjang')
            ->where('session_id', $session_id)
            ->countAllResults();
    }

    // Total harga keranjang
    public function totalharga($session_id)
    {
        return $this->table('custome__keranjang')
            ->selectSum('subtotal')
            ->where('session_id', $session_id)
            ->get()->getRow();
    }

    // Cek produk di keranjang
    public function cekproduk($session_id, $id_produk)
    {
        return $this->table('custome__keranjang')
            ->where('session_id', $session_id)
            ->where('id_produk', $id_produk)
            ->get()->getRow();
    }

    // Hapus keranjang by session
    public function hapusbysession($session_id)
    {
        return $this->table('custome__keranjang')
            ->where('session_id', $session_id)
            ->delete();
    }
}
