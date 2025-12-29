<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInformasi extends Model
{
    protected $table = 'informasi';
    protected $primaryKey = 'informasi_id';
    protected $allowedFields = [
        'nama',
        'slug_informasi',
        'gambar',
        'isi_informasi',
        'tgl_informasi',
        'hits',
        'type',
        'id',
        'fileunduh',
        'sts_aktif',
        'ket',
        'utm'
    ];

    //backend
    public function listlayanan()
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '0')
            ->orderBy('informasi_id', 'DESC')
            ->get()->getResultArray();
    }

    public function listlayananauthor($id)
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '0')
            ->where('informasi.id', $id)
            ->orderBy('informasi_id', 'DESC')
            ->get()->getResultArray();
    }

    //pager all/info front
    public function listlayananpage()
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '0')
            ->orderBy('informasi_id', 'DESC');
    }

    # onepage tema
    public function listlayananutmpage()
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '0')
            ->where('utm', '1')
            ->orderBy('informasi_id', 'DESC');
    }

    public function downloadfile($fileupload)
    {
        return $this->table('informasi')
            ->where('fileunduh', $fileupload)
            ->get()->getRowArray();
    }

    //total layanan back all
    public function totlayanan()
    {
        return $this->table('informasi')
            ->where(array('type' => '0'))
            ->get()->getNumRows();
    }

    public function totlayananbyid($id)
    {
        return $this->table('informasi')
            ->where(array(
                'type' => '0',
                'informasi.id' => $id,

            ))
            ->get()->getNumRows();
    }
    //pencarian layanan front
    public function cari($keywordcari)
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->like('nama', $keywordcari)
            ->orlike('isi_informasi', $keywordcari)
            ->where('type', 0)
            ->orderBy('informasi_id', 'DESC');
    }
    //total pengumuman back

    public function totpengumuman()
    {
        return $this->table('informasi')
            ->where(array(
                'type' => '1'
            ))
            ->get()->getNumRows();
    }
    public function totpengumumanbyid($id)
    {
        return $this->table('informasi')
            ->where(array(
                'type' => '1',
                'informasi.id' => $id
            ))
            ->get()->getNumRows();
    }
    //backend pengumuman
    public function listpengumuman()
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '1')
            ->orderBy('informasi_id', 'DESC')
            ->get()->getResultArray();
    }

    public function detailpengumuman($id_or_slug)
    {
        $builder = $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '1');

        if (is_numeric($id_or_slug)) {
            $builder->where('informasi_id', $id_or_slug);
        } else {
            $builder->where('slug_informasi', $id_or_slug);
        }

        return $builder->orderBy('informasi_id', 'DESC')
            ->get()->getRow();
    }

    public function pengumumanlain($informasi_id)
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '1')
            ->where('informasi_id !=', $informasi_id)
            ->orderBy('informasi_id', 'RANDOM')
            ->get(3, 0)->getResultArray();
    }

    public function listpengumumanauthor($id)
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '1')
            ->where('informasi.id', $id)
            ->orderBy('informasi_id', 'DESC')
            ->get()->getResultArray();
    }


    //pager all/side/front
    public function listpengumumanpage()
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->where('type', '1')
            ->orderBy('informasi_id', 'DESC');
    }
    public function caripengumuman($keywordcari)
    {
        return $this->table('informasi')
            ->join('users', 'users.id = informasi.id')
            ->like('nama', $keywordcari)
            ->orlike('isi_informasi', $keywordcari)
            ->where('type', 1)
            ->orderBy('informasi_id', 'DESC');
    }
}
