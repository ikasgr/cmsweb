<?php

namespace App\Models;

use CodeIgniter\Model;

class M_KomisiMajelis extends Model
{
    protected $table      = 'custome__komisi_majelis';
    protected $primaryKey = 'komisi_id';
    protected $allowedFields = [
        'nama_komisi', 'deskripsi', 'ketua_komisi', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    // Get all active komisi
    public function listAktif()
    {
        return $this->select('custome__komisi_majelis.*, custome__majelis_gereja.nama as nama_ketua')
            ->join('custome__majelis_gereja', 'custome__majelis_gereja.majelis_id = custome__komisi_majelis.ketua_komisi', 'left')
            ->where('custome__komisi_majelis.status', 'Aktif')
            ->orderBy('custome__komisi_majelis.nama_komisi', 'ASC')
            ->findAll();
    }

    // Get all komisi
    public function list()
    {
        return $this->select('custome__komisi_majelis.*, custome__majelis_gereja.nama as nama_ketua')
            ->join('custome__majelis_gereja', 'custome__majelis_gereja.majelis_id = custome__komisi_majelis.ketua_komisi', 'left')
            ->orderBy('custome__komisi_majelis.nama_komisi', 'ASC')
            ->findAll();
    }

    // Get komisi with member count
    public function getWithMemberCount()
    {
        return $this->select('custome__komisi_majelis.*, custome__majelis_gereja.nama as nama_ketua, COUNT(custome__majelis_komisi.majelis_id) as jumlah_anggota')
            ->join('custome__majelis_gereja', 'custome__majelis_gereja.majelis_id = custome__komisi_majelis.ketua_komisi', 'left')
            ->join('custome__majelis_komisi', 'custome__majelis_komisi.komisi_id = custome__komisi_majelis.komisi_id AND custome__majelis_komisi.status = "Aktif"', 'left')
            ->where('custome__komisi_majelis.status', 'Aktif')
            ->groupBy('custome__komisi_majelis.komisi_id')
            ->orderBy('custome__komisi_majelis.nama_komisi', 'ASC')
            ->findAll();
    }

    // Get dropdown options
    public function getDropdown()
    {
        $komisi = $this->listAktif();
        $options = [];
        foreach ($komisi as $item) {
            $options[$item['komisi_id']] = $item['nama_komisi'];
        }
        return $options;
    }

    // Check if komisi name exists
    public function cekNama($nama_komisi, $exclude_id = null)
    {
        $builder = $this->where('nama_komisi', $nama_komisi);
        if ($exclude_id) {
            $builder->where('komisi_id !=', $exclude_id);
        }
        return $builder->first();
    }
}
