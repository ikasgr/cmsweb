<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ProdukUmkm extends Model
{
    protected $table      = 'custome__produk_umkm';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = [
        'nama_produk', 'slug_produk', 'kategori_id', 'deskripsi', 'harga', 
        'harga_promo', 'stok', 'berat', 'satuan', 'gambar', 'galeri',
        'status', 'featured', 'hits', 'tgl_input', 'user_id'
    ];

    // List semua produk
    public function list()
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori, users.fullname')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->join('users', 'users.id = custome__produk_umkm.user_id', 'left')
            ->orderBy('id_produk', 'DESC')
            ->get()->getResultArray();
    }

    // Produk aktif untuk frontend
    public function listaktif()
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('custome__produk_umkm.status', '1')
            ->where('custome__produk_umkm.stok >', 0)
            ->orderBy('id_produk', 'DESC');
    }

    // Produk featured
    public function featured()
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('custome__produk_umkm.status', '1')
            ->where('custome__produk_umkm.featured', '1')
            ->where('custome__produk_umkm.stok >', 0)
            ->orderBy('id_produk', 'DESC');
    }

    // Produk terlaris
    public function terlaris()
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('custome__produk_umkm.status', '1')
            ->where('custome__produk_umkm.stok >', 0)
            ->orderBy('hits', 'DESC');
    }

    // Detail produk by slug
    public function detail($slug_produk)
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori, users.fullname')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->join('users', 'users.id = custome__produk_umkm.user_id', 'left')
            ->where('slug_produk', $slug_produk)
            ->get()->getRow();
    }

    // Produk by kategori
    public function bykategori($kategori_id)
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('custome__produk_umkm.kategori_id', $kategori_id)
            ->where('custome__produk_umkm.status', '1')
            ->where('custome__produk_umkm.stok >', 0)
            ->orderBy('id_produk', 'DESC');
    }

    // Produk terkait
    public function terkait($kategori_id, $id_produk)
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->where('custome__produk_umkm.kategori_id', $kategori_id)
            ->where('custome__produk_umkm.id_produk !=', $id_produk)
            ->where('custome__produk_umkm.status', '1')
            ->where('custome__produk_umkm.stok >', 0)
            ->orderBy('RAND()')
            ->limit(4)
            ->get()->getResultArray();
    }

    // Search produk
    public function search($keyword)
    {
        return $this->table('custome__produk_umkm')
            ->select('custome__produk_umkm.*, custome__kategori_produk.nama_kategori')
            ->join('custome__kategori_produk', 'custome__kategori_produk.kategori_id = custome__produk_umkm.kategori_id', 'left')
            ->like('nama_produk', $keyword)
            ->orLike('deskripsi', $keyword)
            ->where('custome__produk_umkm.status', '1')
            ->orderBy('id_produk', 'DESC');
    }

    // Total produk
    public function totalproduk()
    {
        return $this->table('custome__produk_umkm')
            ->countAllResults();
    }

    // Total produk aktif
    public function totalprodukaktif()
    {
        return $this->table('custome__produk_umkm')
            ->where('status', '1')
            ->countAllResults();
    }
}
