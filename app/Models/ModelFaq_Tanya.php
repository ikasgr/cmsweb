<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFaq_Tanya extends Model
{
    protected $table      = 'faq_tanya';
    protected $primaryKey = 'faq_tanyaid';
    protected $allowedFields = [
        'faqtanya', 'sts_faqtanya', 'kat_faq'
    ];


    public function list()
    {
        return $this->table('faq_tanya')
            // ->join('survey_topik', 'survey_topik.survey_id = faq_tanya.survey_id')
            ->orderBy('faq_tanyaid', 'ASC')
            ->get()->getResultArray();
    }

    public function listpublish()
    {
        return $this->table('faq_tanya')
            ->join('faq_jawab', 'faq_jawab.faq_tanyaid = faq_tanya.faq_tanyaid')
            ->orderBy('faq_tanya.faq_tanyaid', 'ASC')
            ->get(4, 0)->getResultArray();
    }

    public function listpublishbykat($kat_faq)
    {
        return $this->table('faq_tanya')
            ->join('faq_jawab', 'faq_jawab.faq_tanyaid = faq_tanya.faq_tanyaid')
            ->where('faq_tanya.kat_faq', $kat_faq)
            ->orderBy('faq_tanya.faq_tanyaid', 'ASC')
            ->get()->getResultArray();
    }
}
