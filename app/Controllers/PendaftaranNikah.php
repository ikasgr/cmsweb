<?php

namespace App\Controllers;

class PendaftaranNikah extends BaseController
{
    // Frontend - Halaman form pendaftaran publik
    public function index()
    {
        $konfigurasi    = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        
        $data = [
            'title'         => 'Pendaftaran Pernikahan | ' . $konfigurasi->nama,
            'deskripsi'     => $konfigurasi->deskripsi,
            'url'           => $konfigurasi->website,
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'sitekey'       => $konfigurasi->g_sitekey,
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder']
        ];
        return view('frontend/' . $template['folder'] . '/content/pendaftaran_nikah', $data);
    }

    // Frontend - Simpan pendaftaran dari publik
    public function simpanpendaftaran()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_pria' => [
                    'label' => 'Nama Calon Suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_lahir_pria' => [
                    'label' => 'Tanggal Lahir Calon Suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hp_pria' => [
                    'label' => 'No HP Calon Suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'email_pria' => [
                    'label' => 'Email Calon Suami',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => '{field} tidak valid!',
                    ]
                ],
                'nama_wanita' => [
                    'label' => 'Nama Calon Istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_lahir_wanita' => [
                    'label' => 'Tanggal Lahir Calon Istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hp_wanita' => [
                    'label' => 'No HP Calon Istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'email_wanita' => [
                    'label' => 'Email Calon Istri',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => '{field} tidak valid!',
                    ]
                ],
                'tgl_nikah_diinginkan' => [
                    'label' => 'Tanggal Pernikahan yang Diinginkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pria'             => $validation->getError('nama_pria'),
                        'tgl_lahir_pria'        => $validation->getError('tgl_lahir_pria'),
                        'no_hp_pria'            => $validation->getError('no_hp_pria'),
                        'email_pria'            => $validation->getError('email_pria'),
                        'nama_wanita'           => $validation->getError('nama_wanita'),
                        'tgl_lahir_wanita'      => $validation->getError('tgl_lahir_wanita'),
                        'no_hp_wanita'          => $validation->getError('no_hp_wanita'),
                        'email_wanita'          => $validation->getError('email_wanita'),
                        'tgl_nikah_diinginkan'  => $validation->getError('tgl_nikah_diinginkan'),
                    ]
                ];
            } else {
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $secretkey = $konfigurasi['google_secret'];
                $g_sitekey = $konfigurasi['g_sitekey'];

                // Google reCAPTCHA
                $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
                $secret = $secretkey;

                if ($secretkey != '' && $g_sitekey != '') {
                    $credential = array(
                        'secret' => $secret,
                        'response' => $recaptchaResponse
                    );

                    $verify = curl_init();
                    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($verify, CURLOPT_POST, true);
                    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
                    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($verify);

                    $status = json_decode($response, true);
                    if (!$status['success']) {
                        $msg = [
                            'gagal' => 'Gagal verifikasi reCAPTCHA. Silahkan coba lagi!'
                        ];
                        echo json_encode($msg);
                        return;
                    }
                }

                $insertdata = [
                    // Data Calon Suami
                    'nama_pria'             => $this->request->getVar('nama_pria'),
                    'tempat_lahir_pria'     => $this->request->getVar('tempat_lahir_pria'),
                    'tgl_lahir_pria'        => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_pria'))),
                    'alamat_pria'           => $this->request->getVar('alamat_pria'),
                    'no_hp_pria'            => $this->request->getVar('no_hp_pria'),
                    'email_pria'            => $this->request->getVar('email_pria'),
                    'pekerjaan_pria'        => $this->request->getVar('pekerjaan_pria'),
                    'status_baptis_pria'    => $this->request->getVar('status_baptis_pria'),
                    'gereja_baptis_pria'    => $this->request->getVar('gereja_baptis_pria'),
                    'nama_ayah_pria'        => $this->request->getVar('nama_ayah_pria'),
                    'nama_ibu_pria'         => $this->request->getVar('nama_ibu_pria'),
                    // Data Calon Istri
                    'nama_wanita'           => $this->request->getVar('nama_wanita'),
                    'tempat_lahir_wanita'   => $this->request->getVar('tempat_lahir_wanita'),
                    'tgl_lahir_wanita'      => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_wanita'))),
                    'alamat_wanita'         => $this->request->getVar('alamat_wanita'),
                    'no_hp_wanita'          => $this->request->getVar('no_hp_wanita'),
                    'email_wanita'          => $this->request->getVar('email_wanita'),
                    'pekerjaan_wanita'      => $this->request->getVar('pekerjaan_wanita'),
                    'status_baptis_wanita'  => $this->request->getVar('status_baptis_wanita'),
                    'gereja_baptis_wanita'  => $this->request->getVar('gereja_baptis_wanita'),
                    'nama_ayah_wanita'      => $this->request->getVar('nama_ayah_wanita'),
                    'nama_ibu_wanita'       => $this->request->getVar('nama_ibu_wanita'),
                    // Data Pernikahan
                    'tgl_daftar'            => date('Y-m-d'),
                    'tgl_nikah_diinginkan'  => date('Y-m-d', strtotime($this->request->getVar('tgl_nikah_diinginkan'))),
                    'tempat_nikah'          => $this->request->getVar('tempat_nikah'),
                    'status'                => '0',
                ];

                $this->pendaftarannikah->insert($insertdata);

                $msg = [
                    'sukses' => 'Pendaftaran Pernikahan Anda berhasil terkirim. Kami akan menghubungi Anda segera!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - List data pendaftaran
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title'     => 'Pendaftaran Pernikahan',
            'subtitle'  => 'Manajemen Data',
        ];
        return view('backend/morvin/cmscust/pendaftaran_nikah/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pendaftaran-nikah/list';
            $listgrupf =  $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data) :
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title'     => 'Pendaftaran Pernikahan',
                        'list'      => $this->pendaftarannikah->list(),
                        'akses'     => $akses
                    ];
                    $msg = [
                        'data' => view('backend/morvin/cmscust/pendaftaran_nikah/list', $data)
                    ];
                } else {
                    $msg = [
                        'noakses' => []
                    ];
                }
            } else {
                $msg = [
                    'blmakses' => []
                ];
            }

            echo json_encode($msg);
        }
    }

    // Backend - Form lihat detail
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $id_nikah = $this->request->getVar('id_nikah');
            $list =  $this->pendaftarannikah->find($id_nikah);

            $data = [
                'title' => 'Detail Pendaftaran Pernikahan',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_nikah/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_nikah = $this->request->getVar('id_nikah');
            $list =  $this->pendaftarannikah->find($id_nikah);

            $data = [
                'title' => 'Edit Pendaftaran Pernikahan',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_nikah/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_nikah = $this->request->getVar('id_nikah');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_pria' => [
                    'label' => 'Nama Calon Suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'nama_wanita' => [
                    'label' => 'Nama Calon Istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pria'     => $validation->getError('nama_pria'),
                        'nama_wanita'   => $validation->getError('nama_wanita'),
                    ]
                ];
            } else {
                $updatedata = [
                    // Data Calon Suami
                    'nama_pria'             => $this->request->getVar('nama_pria'),
                    'tempat_lahir_pria'     => $this->request->getVar('tempat_lahir_pria'),
                    'tgl_lahir_pria'        => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_pria'))),
                    'alamat_pria'           => $this->request->getVar('alamat_pria'),
                    'no_hp_pria'            => $this->request->getVar('no_hp_pria'),
                    'email_pria'            => $this->request->getVar('email_pria'),
                    'pekerjaan_pria'        => $this->request->getVar('pekerjaan_pria'),
                    'status_baptis_pria'    => $this->request->getVar('status_baptis_pria'),
                    'gereja_baptis_pria'    => $this->request->getVar('gereja_baptis_pria'),
                    'nama_ayah_pria'        => $this->request->getVar('nama_ayah_pria'),
                    'nama_ibu_pria'         => $this->request->getVar('nama_ibu_pria'),
                    // Data Calon Istri
                    'nama_wanita'           => $this->request->getVar('nama_wanita'),
                    'tempat_lahir_wanita'   => $this->request->getVar('tempat_lahir_wanita'),
                    'tgl_lahir_wanita'      => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_wanita'))),
                    'alamat_wanita'         => $this->request->getVar('alamat_wanita'),
                    'no_hp_wanita'          => $this->request->getVar('no_hp_wanita'),
                    'email_wanita'          => $this->request->getVar('email_wanita'),
                    'pekerjaan_wanita'      => $this->request->getVar('pekerjaan_wanita'),
                    'status_baptis_wanita'  => $this->request->getVar('status_baptis_wanita'),
                    'gereja_baptis_wanita'  => $this->request->getVar('gereja_baptis_wanita'),
                    'nama_ayah_wanita'      => $this->request->getVar('nama_ayah_wanita'),
                    'nama_ibu_wanita'       => $this->request->getVar('nama_ibu_wanita'),
                    // Data Pernikahan
                    'tgl_nikah_diinginkan'  => date('Y-m-d', strtotime($this->request->getVar('tgl_nikah_diinginkan'))),
                    'tempat_nikah'          => $this->request->getVar('tempat_nikah'),
                    'status'                => $this->request->getVar('status'),
                    'keterangan'            => $this->request->getVar('keterangan'),
                ];

                $this->pendaftarannikah->update($id_nikah, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diubah!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Form tambah
    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Pendaftaran Pernikahan',
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/pendaftaran_nikah/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan data baru
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_pria' => [
                    'label' => 'Nama Calon Suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'nama_wanita' => [
                    'label' => 'Nama Calon Istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_pria'     => $validation->getError('nama_pria'),
                        'nama_wanita'   => $validation->getError('nama_wanita'),
                    ]
                ];
            } else {
                $insertdata = [
                    // Data Calon Suami
                    'nama_pria'             => $this->request->getVar('nama_pria'),
                    'tempat_lahir_pria'     => $this->request->getVar('tempat_lahir_pria'),
                    'tgl_lahir_pria'        => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_pria'))),
                    'alamat_pria'           => $this->request->getVar('alamat_pria'),
                    'no_hp_pria'            => $this->request->getVar('no_hp_pria'),
                    'email_pria'            => $this->request->getVar('email_pria'),
                    'pekerjaan_pria'        => $this->request->getVar('pekerjaan_pria'),
                    'status_baptis_pria'    => $this->request->getVar('status_baptis_pria'),
                    'gereja_baptis_pria'    => $this->request->getVar('gereja_baptis_pria'),
                    'nama_ayah_pria'        => $this->request->getVar('nama_ayah_pria'),
                    'nama_ibu_pria'         => $this->request->getVar('nama_ibu_pria'),
                    // Data Calon Istri
                    'nama_wanita'           => $this->request->getVar('nama_wanita'),
                    'tempat_lahir_wanita'   => $this->request->getVar('tempat_lahir_wanita'),
                    'tgl_lahir_wanita'      => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir_wanita'))),
                    'alamat_wanita'         => $this->request->getVar('alamat_wanita'),
                    'no_hp_wanita'          => $this->request->getVar('no_hp_wanita'),
                    'email_wanita'          => $this->request->getVar('email_wanita'),
                    'pekerjaan_wanita'      => $this->request->getVar('pekerjaan_wanita'),
                    'status_baptis_wanita'  => $this->request->getVar('status_baptis_wanita'),
                    'gereja_baptis_wanita'  => $this->request->getVar('gereja_baptis_wanita'),
                    'nama_ayah_wanita'      => $this->request->getVar('nama_ayah_wanita'),
                    'nama_ibu_wanita'       => $this->request->getVar('nama_ibu_wanita'),
                    // Data Pernikahan
                    'tgl_daftar'            => date('Y-m-d'),
                    'tgl_nikah_diinginkan'  => date('Y-m-d', strtotime($this->request->getVar('tgl_nikah_diinginkan'))),
                    'tempat_nikah'          => $this->request->getVar('tempat_nikah'),
                    'status'                => $this->request->getVar('status'),
                    'keterangan'            => $this->request->getVar('keterangan'),
                ];

                $this->pendaftarannikah->insert($insertdata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus data
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_nikah = $this->request->getVar('id_nikah');
            $cekdata = $this->pendaftarannikah->find($id_nikah);

            // Hapus file dokumen jika ada
            $dokumen = [
                'dok_ktp_pria', 'dok_kk_pria', 'dok_baptis_pria', 'dok_sidi_pria', 'dok_foto_pria',
                'dok_ktp_wanita', 'dok_kk_wanita', 'dok_baptis_wanita', 'dok_sidi_wanita', 'dok_foto_wanita',
                'dok_surat_izin_ortu', 'dok_surat_keterangan_gereja'
            ];
            foreach ($dokumen as $dok) {
                if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/nikah/' . $cekdata[$dok])) {
                    unlink('public/file/dokumen/nikah/' . $cekdata[$dok]);
                }
            }

            $this->pendaftarannikah->delete($id_nikah);
            $msg = [
                'sukses' => 'Data berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple data
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_nikah = $this->request->getVar('id_nikah');
            $jmldata = count($id_nikah);
            
            for ($i = 0; $i < $jmldata; $i++) {
                $cekdata = $this->pendaftarannikah->find($id_nikah[$i]);
                
                // Hapus file dokumen jika ada
                $dokumen = [
                    'dok_ktp_pria', 'dok_kk_pria', 'dok_baptis_pria', 'dok_sidi_pria', 'dok_foto_pria',
                    'dok_ktp_wanita', 'dok_kk_wanita', 'dok_baptis_wanita', 'dok_sidi_wanita', 'dok_foto_wanita',
                    'dok_surat_izin_ortu', 'dok_surat_keterangan_gereja'
                ];
                foreach ($dokumen as $dok) {
                    if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/nikah/' . $cekdata[$dok])) {
                        unlink('public/file/dokumen/nikah/' . $cekdata[$dok]);
                    }
                }
                
                $this->pendaftarannikah->delete($id_nikah[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Toggle status
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_nikah');
            $status = $this->request->getVar('status');

            $updatedata = [
                'status' => $status,
            ];
            $this->pendaftarannikah->update($id, $updatedata);
            
            $statusText = ['Pending', 'Disetujui', 'Ditolak'];
            $msg = [
                'sukses' => 'Status berhasil diubah menjadi: ' . $statusText[$status]
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Form upload dokumen
    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_nikah');
            $list =  $this->pendaftarannikah->find($id);
            
            $data = [
                'title' => 'Upload Dokumen',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_nikah/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan upload dokumen
    public function simpanupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_nikah');
            $jenis_dok = $this->request->getVar('jenis_dok');
            
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file_dokumen' => [
                    'label' => 'File Dokumen',
                    'rules' => 'uploaded[file_dokumen]|max_size[file_dokumen,3024]|mime_in[file_dokumen,image/png,image/jpg,image/jpeg,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih file',
                        'max_size' => 'Ukuran file maksimal 3 MB',
                        'mime_in' => 'Format file harus PNG, JPG, JPEG, atau PDF'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'file_dokumen' => $validation->getError('file_dokumen')
                    ]
                ];
            } else {
                $cekdata = $this->pendaftarannikah->find($id);
                $filelama = $cekdata[$jenis_dok];

                // Hapus file lama jika ada
                if ($filelama != '' && file_exists('public/file/dokumen/nikah/' . $filelama)) {
                    unlink('public/file/dokumen/nikah/' . $filelama);
                }

                $file = $this->request->getFile('file_dokumen');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    $jenis_dok => $nama_file
                ];

                $this->pendaftarannikah->update($id, $updatedata);
                $file->move('public/file/dokumen/nikah/', $nama_file);

                $msg = [
                    'sukses' => 'Dokumen berhasil diupload!',
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus file dokumen
    public function hapusfile()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_nikah');
            $jenis_dok = $this->request->getVar('jenis_dok');
            
            $cekdata = $this->pendaftarannikah->find($id);
            $file = $cekdata[$jenis_dok];

            if ($file != '' && file_exists('public/file/dokumen/nikah/' . $file)) {
                unlink('public/file/dokumen/nikah/' . $file);
            }

            $updatedata = [
                $jenis_dok => ''
            ];

            $this->pendaftarannikah->update($id, $updatedata);

            $msg = [
                'sukses' => 'Dokumen berhasil dihapus'
            ];

            echo json_encode($msg);
        }
    }
}
