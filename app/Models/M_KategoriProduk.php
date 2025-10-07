<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KategoriProduk extends Model
{
    protected $table      = 'custome__kategori_produk';
    protected $primaryKey = 'kategori_id';
    protected $allowedFields = ['nama_kategori', 'slug_kategori', 'deskripsi', 'gambar', 'urutan', 'status'];

    // List semua kategori
    public function list()
    {
        return $this->table('custome__kategori_produk')
            ->orderBy('urutan', 'ASC')
            ->get()->getResultArray();
    }

    // Kategori aktif
    public function listaktif()
    {
        return $this->table('custome__kategori_produk')
            ->where('status', '1')
            ->orderBy('urutan', 'ASC')
            ->get()->getResultArray();
    }

    // Kategori dengan jumlah produk
    public function withcount()
    {
        return $this->table('custome__kategori_produk')
            ->select('custome__kategori_produk.*, COUNT(custome__produk_umkm.id_produk) as jml_produk')
            ->join('custome__produk_umkm', 'custome__produk_umkm.kategori_id = custome__kategori_produk.kategori_id', 'left')
            ->where('custome__kategori_produk.status', '1')
            ->groupBy('custome__kategori_produk.kategori_id')
            ->orderBy('urutan', 'ASC')
            ->get()->getResultArray();
    }

    // Detail by slug
    public function detail($slug_kategori)
    {
        return $this->table('custome__kategori_produk')
            ->where('slug_kategori', $slug_kategori)
            ->get()->getRow();
    }
}
