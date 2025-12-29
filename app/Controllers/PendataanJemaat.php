<?php

namespace App\Controllers;

class PendataanJemaat extends BaseController
{
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $data = [
            'title' => 'Formulir Pendataan Jemaat | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
        ];

        return view('frontend/pendaftaran/jemaat', $data);
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            // Validasi input
            $valid = $this->validate([
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!']
                ],
                'nik' => [ // Asumsi pakai NIK atau ekuivalen untuk No Anggota sementara/otomatis
                    'label' => 'NIK / No. Identitas',
                    'rules' => 'required', // numeric removed to flexibility? No, let's keep it loose for now.
                    'errors' => ['required' => '{field} wajib diisi!']
                ],
                'tempat_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!']
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} wajib diisi!',
                        'valid_date' => 'Format {field} tidak valid!'
                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required|in_list[L,P]',
                    'errors' => [
                        'required' => '{field} wajib dipilih!',
                        'in_list' => '{field} tidak valid!'
                    ]
                ],
                'alamat_lengkap' => [
                    'label' => 'Alamat Lengkap',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!']
                ],
                'no_hp' => [
                    'label' => 'Nomor HP/WA',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!']
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'nik' => $validation->getError('nik'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'alamat_lengkap' => $validation->getError('alamat_lengkap'),
                        'no_hp' => $validation->getError('no_hp'),
                    ]
                ];
            } else {
                // Auto generate No Anggota if not provided or handle overlap
                // Here we might just treat 'nik' as 'no_anggota' temporarily 
                // OR generate a temporary one. 
                // Let's use the Model's logic if possible, or simple timestamp/random.

                // Using input directly for simplicity as per requirement "integrated"
                $no_anggota = $this->request->getVar('nik'); // Using NIK as base

                if ($this->jemaat->isNoAnggotaExists($no_anggota)) {
                    $msg = ['error' => ['nik' => 'NIK/No. Identitas ini sudah terdaftar!']];
                } else {
                    $insertdata = [
                        'no_anggota' => $no_anggota,
                        'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                        'nama_panggilan' => $this->request->getVar('nama_panggilan'),
                        'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                        'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                        'alamat_lengkap' => $this->request->getVar('alamat_lengkap'),
                        'rt_rw' => $this->request->getVar('rt_rw'),
                        'kelurahan' => $this->request->getVar('kelurahan'),
                        'kecamatan' => $this->request->getVar('kecamatan'),
                        'kota' => $this->request->getVar('kota'),
                        'kode_pos' => $this->request->getVar('kode_pos'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'email' => $this->request->getVar('email'),
                        'pekerjaan' => $this->request->getVar('pekerjaan'),
                        'pendidikan' => $this->request->getVar('pendidikan'),
                        'status_pernikahan' => $this->request->getVar('status_pernikahan'),
                        'nama_ayah' => $this->request->getVar('nama_ayah'),
                        'nama_ibu' => $this->request->getVar('nama_ibu'),
                        'nama_pasangan' => $this->request->getVar('nama_pasangan'),
                        'status_keanggotaan' => 'Baru', // Default 'Baru' for verification
                        'tgl_bergabung' => date('Y-m-d'), // Today
                        'gereja_asal' => $this->request->getVar('gereja_asal'),
                    ];

                    $this->jemaat->insert($insertdata);

                    $msg = [
                        'sukses' => 'Data Anda berhasil dikirim! Silakan tunggu verifikasi admin.'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            return redirect()->to('pendataan-jemaat');
        }
    }
}
