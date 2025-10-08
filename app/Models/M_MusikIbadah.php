<?php

namespace App\Models;

use CodeIgniter\Model;

class M_MusikIbadah extends Model
{
    protected $table      = 'custome__musik_ibadah';
    protected $primaryKey = 'id_musik';
    protected $allowedFields = [
        'id_jadwal', 'judul_lagu', 'pengarang', 'nomor_kidung', 'kategori', 
        'urutan', 'chord', 'lirik', 'audio_file', 'keterangan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get musik berdasarkan jadwal
    public function getByJadwal($id_jadwal)
    {
        return $this->where('id_jadwal', $id_jadwal)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Get musik berdasarkan kategori
    public function getByKategori($id_jadwal, $kategori)
    {
        return $this->where('id_jadwal', $id_jadwal)
                    ->where('kategori', $kategori)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    // Update urutan musik
    public function updateUrutan($data)
    {
        foreach ($data as $item) {
            $this->update($item['id'], ['urutan' => $item['urutan']]);
        }
        return true;
    }

    // Get daftar lagu populer
    public function getLaguPopuler($limit = 10)
    {
        return $this->select('judul_lagu, pengarang, COUNT(*) as jumlah_pakai')
                    ->groupBy('judul_lagu, pengarang')
                    ->orderBy('jumlah_pakai', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // Search lagu
    public function searchLagu($keyword)
    {
        return $this->like('judul_lagu', $keyword)
                    ->orLike('pengarang', $keyword)
                    ->orLike('nomor_kidung', $keyword)
                    ->orderBy('judul_lagu', 'ASC')
                    ->findAll();
    }

    // Copy musik dari jadwal lain
    public function copyFromJadwal($id_jadwal_sumber, $id_jadwal_tujuan)
    {
        $musikSumber = $this->getByJadwal($id_jadwal_sumber);
        
        foreach ($musikSumber as $musik) {
            unset($musik['id_musik']);
            $musik['id_jadwal'] = $id_jadwal_tujuan;
            $this->insert($musik);
        }
        
        return count($musikSumber);
    }
}
