<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Prj_master extends Model
{
    protected $table      = 'custome__masterdata';
    protected $primaryKey = 'id_masterdata';
    protected $allowedFields = [
        'nama_master', 'jns_master', 'sts_master', 'slug_master', 'image_master', 'ket_master', 'hits_master'
    ];

    public function listmaster($jns)
    {
        return $this->table('custome__masterdata')
            // ->orderBy('id_masterdata', 'DESC')
            ->where('jns_master', $jns)
            ->get()->getResultArray();
    }

    public function listmasterpublik($jns)
    {
        return $this->table('custome__masterdata')
            ->where('jns_master', $jns)
            ->where('sts_master', '1')
            ->get()->getResultArray();
    }
}
