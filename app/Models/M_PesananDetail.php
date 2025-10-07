<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PesananDetail extends Model
{
    protected $table      = 'custome__pesanan_detail';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = [
        'id_pesanan', 'id_produk', 'nama_produk', 'harga', 'jumlah', 'subtotal'
    ];

    // Detail by pesanan
    public function bypesanan($id_pesanan)
    {
        return $this->table('custome__pesanan_detail')
            ->select('custome__pesanan_detail.*, custome__produk_umkm.gambar')
            ->join('custome__produk_umkm', 'custome__produk_umkm.id_produk = custome__pesanan_detail.id_produk', 'left')
            ->where('id_pesanan', $id_pesanan)
            ->get()->getResultArray();
    }

    // Hapus by pesanan
    public function hapusbypesanan($id_pesanan)
    {
        return $this->table('custome__pesanan_detail')
            ->where('id_pesanan', $id_pesanan)
            ->delete();
    }
}
