<?php

namespace App\Controllers;

class PendaftaranBaptis extends BaseController
{
    // Frontend - Halaman form pendaftaran publik
    public function index()
    {
        $konfigurasi    = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        
        $data = [
            'title'         => 'Pendaftaran Baptis | ' . $konfigurasi->nama,
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
        return view('frontend/' . $template['folder'] . '/content/pendaftaran_baptis', $data);
    }

    // Frontend - Simpan pendaftaran dari publik
    public function simpanpendaftaran()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tempat_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hp' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => '{field} tidak valid!',
                    ]
                ],
                'jenis_baptis' => [
                    'label' => 'Jenis Baptis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap'  => $validation->getError('nama_lengkap'),
                        'tempat_lahir'  => $validation->getError('tempat_lahir'),
                        'tgl_lahir'     => $validation->getError('tgl_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'alamat'        => $validation->getError('alamat'),
                        'no_hp'         => $validation->getError('no_hp'),
                        'email'         => $validation->getError('email'),
                        'jenis_baptis'  => $validation->getError('jenis_baptis'),
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
                    'nama_lengkap'          => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'          => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'             => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'         => $this->request->getVar('jenis_kelamin'),
                    'alamat'                => $this->request->getVar('alamat'),
                    'no_hp'                 => $this->request->getVar('no_hp'),
                    'email'                 => $this->request->getVar('email'),
                    'nama_ayah'             => $this->request->getVar('nama_ayah'),
                    'nama_ibu'              => $this->request->getVar('nama_ibu'),
                    'jenis_baptis'          => $this->request->getVar('jenis_baptis'),
                    'nama_pendamping'       => $this->request->getVar('nama_pendamping'),
                    'hubungan_pendamping'   => $this->request->getVar('hubungan_pendamping'),
                    'tgl_daftar'            => date('Y-m-d'),
                    'status'                => '0',
                ];

                $this->pendaftaranbaptis->insert($insertdata);

                $msg = [
                    'sukses' => 'Pendaftaran Baptis Anda berhasil terkirim. Kami akan menghubungi Anda segera!'
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
            'title'     => 'Pendaftaran Baptis',
            'subtitle'  => 'Manajemen Data',
        ];
        return view('backend/morvin/cmscust/pendaftaran_baptis/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pendaftaran-baptis/list';
            $listgrupf =  $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data) :
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title'     => 'Pendaftaran Baptis',
                        'list'      => $this->pendaftaranbaptis->list(),
                        'akses'     => $akses
                    ];
                    $msg = [
                        'data' => view('backend/morvin/cmscust/pendaftaran_baptis/list', $data)
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
            $id_baptis = $this->request->getVar('id_baptis');
            $list =  $this->pendaftaranbaptis->find($id_baptis);

            $data = [
                'title' => 'Detail Pendaftaran Baptis',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_baptis/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_baptis = $this->request->getVar('id_baptis');
            $list =  $this->pendaftaranbaptis->find($id_baptis);

            $data = [
                'title' => 'Edit Pendaftaran Baptis',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_baptis/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_baptis = $this->request->getVar('id_baptis');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hp' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => '{field} tidak valid!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap'  => $validation->getError('nama_lengkap'),
                        'no_hp'         => $validation->getError('no_hp'),
                        'email'         => $validation->getError('email'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_lengkap'          => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'          => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'             => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'         => $this->request->getVar('jenis_kelamin'),
                    'alamat'                => $this->request->getVar('alamat'),
                    'no_hp'                 => $this->request->getVar('no_hp'),
                    'email'                 => $this->request->getVar('email'),
                    'nama_ayah'             => $this->request->getVar('nama_ayah'),
                    'nama_ibu'              => $this->request->getVar('nama_ibu'),
                    'jenis_baptis'          => $this->request->getVar('jenis_baptis'),
                    'nama_pendamping'       => $this->request->getVar('nama_pendamping'),
                    'hubungan_pendamping'   => $this->request->getVar('hubungan_pendamping'),
                    'tgl_baptis'            => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                    'status'                => $this->request->getVar('status'),
                    'keterangan'            => $this->request->getVar('keterangan'),
                ];

                $this->pendaftaranbaptis->update($id_baptis, $updatedata);

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
                'title' => 'Tambah Pendaftaran Baptis',
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/pendaftaran_baptis/tambah', $data)
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
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hp' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => '{field} tidak valid!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap'  => $validation->getError('nama_lengkap'),
                        'no_hp'         => $validation->getError('no_hp'),
                        'email'         => $validation->getError('email'),
                    ]
                ];
            } else {
                $insertdata = [
                    'nama_lengkap'          => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'          => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'             => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'         => $this->request->getVar('jenis_kelamin'),
                    'alamat'                => $this->request->getVar('alamat'),
                    'no_hp'                 => $this->request->getVar('no_hp'),
                    'email'                 => $this->request->getVar('email'),
                    'nama_ayah'             => $this->request->getVar('nama_ayah'),
                    'nama_ibu'              => $this->request->getVar('nama_ibu'),
                    'jenis_baptis'          => $this->request->getVar('jenis_baptis'),
                    'nama_pendamping'       => $this->request->getVar('nama_pendamping'),
                    'hubungan_pendamping'   => $this->request->getVar('hubungan_pendamping'),
                    'tgl_daftar'            => date('Y-m-d'),
                    'tgl_baptis'            => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                    'status'                => $this->request->getVar('status'),
                    'keterangan'            => $this->request->getVar('keterangan'),
                ];

                $this->pendaftaranbaptis->insert($insertdata);

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
            $id_baptis = $this->request->getVar('id_baptis');
            $cekdata = $this->pendaftaranbaptis->find($id_baptis);

            // Hapus file dokumen jika ada
            $dokumen = ['dok_ktp', 'dok_kk', 'dok_akta_lahir', 'dok_foto', 'dok_surat_nikah_ortu'];
            foreach ($dokumen as $dok) {
                if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/baptis/' . $cekdata[$dok])) {
                    unlink('public/file/dokumen/baptis/' . $cekdata[$dok]);
                }
            }

            $this->pendaftaranbaptis->delete($id_baptis);
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
            $id_baptis = $this->request->getVar('id_baptis');
            $jmldata = count($id_baptis);
            
            for ($i = 0; $i < $jmldata; $i++) {
                $cekdata = $this->pendaftaranbaptis->find($id_baptis[$i]);
                
                // Hapus file dokumen jika ada
                $dokumen = ['dok_ktp', 'dok_kk', 'dok_akta_lahir', 'dok_foto', 'dok_surat_nikah_ortu'];
                foreach ($dokumen as $dok) {
                    if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/baptis/' . $cekdata[$dok])) {
                        unlink('public/file/dokumen/baptis/' . $cekdata[$dok]);
                    }
                }
                
                $this->pendaftaranbaptis->delete($id_baptis[$i]);
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
            $id = $this->request->getVar('id_baptis');
            $status = $this->request->getVar('status');

            $updatedata = [
                'status' => $status,
            ];
            $this->pendaftaranbaptis->update($id, $updatedata);
            
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
            $id = $this->request->getVar('id_baptis');
            $list =  $this->pendaftaranbaptis->find($id);
            
            $data = [
                'title' => 'Upload Dokumen',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_baptis/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan upload dokumen
    public function simpanupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_baptis');
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
                $cekdata = $this->pendaftaranbaptis->find($id);
                $filelama = $cekdata[$jenis_dok];

                // Hapus file lama jika ada
                if ($filelama != '' && file_exists('public/file/dokumen/baptis/' . $filelama)) {
                    unlink('public/file/dokumen/baptis/' . $filelama);
                }

                $file = $this->request->getFile('file_dokumen');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    $jenis_dok => $nama_file
                ];

                $this->pendaftaranbaptis->update($id, $updatedata);
                $file->move('public/file/dokumen/baptis/', $nama_file);

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
            $id = $this->request->getVar('id_baptis');
            $jenis_dok = $this->request->getVar('jenis_dok');
            
            $cekdata = $this->pendaftaranbaptis->find($id);
            $file = $cekdata[$jenis_dok];

            if ($file != '' && file_exists('public/file/dokumen/baptis/' . $file)) {
                unlink('public/file/dokumen/baptis/' . $file);
            }

            $updatedata = [
                $jenis_dok => ''
            ];

            $this->pendaftaranbaptis->update($id, $updatedata);

            $msg = [
                'sukses' => 'Dokumen berhasil dihapus'
            ];

            echo json_encode($msg);
        }
    }
}
