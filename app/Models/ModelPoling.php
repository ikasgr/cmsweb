<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPoling extends Model
{
    protected $table      = 'poling';
    protected $primaryKey = 'poling_id';
    protected $allowedFields = ['pilihan', 'type', 'rating', 'status', 'id', 'informasi_id'];

    //backend
    public function list()
    {
        return $this->table('poling')
            ->join('users', 'users.id = poling.id')
            ->where('informasi_id ', 0)
            ->orderBy('poling_id', 'ASC')
            ->get()->getResultArray();
    }

    // poling by layananan
    public function listpolinglay($informasi_id)
    {
        return $this->table('poling')
            ->where('informasi_id', $informasi_id)
            ->orderBy('poling_id', 'ASC')
            ->get()->getResultArray();
    }
    //frontend poling pertanyaan
    public function poltanya()
    {
        return $this->table('poling')
            ->join('users', 'users.id = poling.id')
            ->where(array(
                'type'          => 'Pertanyaan',
                'informasi_id'  => 0,
            ))
            ->orderBy('poling_id', 'ASC')
            ->get()->getRowArray();
    }

    //frontend poling jawab
    public function poljawab()
    {
        return $this->table('poling')
            ->join('users', 'users.id = poling.id')
            ->where(array(
                'status'        => 'Y',
                'type'          => 'Jawaban',
                'informasi_id'  => 0,
            ))
            ->orderBy('poling_id', 'ASC')
            ->get()->getResultArray();
    }

    // public function polling_sum()
    // {
    //     $db      = \Config\Database::connect();
    //     $builder = $this->db->table('poling');
    //     $builder->select('(SELECT SUM(poling.rating) FROM poling WHERE poling.status="Y") AS jml_vote', false);
    //     $query = $builder->get()->getRowArray();
    //     return $query;
    // }

    // public function polling_sumlay($informasi_id)
    // {

    //     $db      = \Config\Database::connect();
    //     $builder = $this->db->table('poling');
    //     $builder->select('(SELECT SUM(poling.rating) FROM poling WHERE poling.status="Y" AND poling.informasi_id=' . $informasi_id . ') AS jml_vote', false);

    //     $query = $builder->get()->getRowArray();
    //     return $query;
    // }


    //front poling pertanyaan by layanan
    public function poljawablay($informasi_id)
    {
        return $this->table('poling')
            ->join('users', 'users.id = poling.id')
            ->where(array(
                'status'        => 'Y',
                'type'          => 'Jawaban',
                'informasi_id'  => $informasi_id,

            ))
            ->orderBy('poling_id', 'ASC')
            ->get()->getResultArray();
    }

    public function poltanyalay($informasi_id)
    {
        return $this->table('poling')
            ->join('users', 'users.id = poling.id')
            ->where(array(
                'type'          => 'Pertanyaan',
                'informasi_id'  => $informasi_id,

            ))
            ->orderBy('poling_id', 'ASC')
            ->get()->getRowArray();
    }
}
