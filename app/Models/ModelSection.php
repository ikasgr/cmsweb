<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSection extends Model
{
    protected $table      = 'section';
    protected $primaryKey = 'section_id';
    protected $allowedFields = ['nama_section', 'gambar', 'link', 'linksumber', 'jns', 'template_id', 'urutan', 'isi_script', 'deskripsi'];

    //backend service /section old
    public function list()
    {
        return $this->table('section')
            ->orderBy('section_id', 'ASC')
            ->where('jns', 0)
            ->get()->getResultArray();
    }
    public function list6()
    {
        return $this->table('section')
            ->where('jns', 0)
            ->orderBy('section_id', 'ASC')
            ->get(6, 0)->getResultArray();
    }

    public function list_script()
    {
        return $this->table('section')
            ->join('template', 'template.template_id = section.template_id')
            ->orderBy('section_id', 'ASC')
            ->where('jns', 1)
            ->get()->getResultArray();
    }

    // cek ganda
    public function cektemaurut($template_id, $urutan)
    {
        return $this->table('section')
            ->where('template_id', $template_id)
            ->where('urutan', $urutan)
            ->get()->getResultArray();
    }

    public function tampil_section($template_id, $urutan)
    {
        return $this->table('section')
            // ->join('template', 'template.template_id = section.template_id')
            ->where('template_id', $template_id)
            ->where('urutan', $urutan)
            ->get()->getRow();
    }
}
