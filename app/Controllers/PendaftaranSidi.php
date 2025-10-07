<?php

namespace App\Controllers;

class PendaftaranSidi extends BaseController
{
    // Frontend - Halaman form pendaftaran publik
    public function index()
    {
        $konfigurasi    = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        
        $data = [
            'title'         => 'Pendaftaran Sidi | ' . $konfigurasi->nama,
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
        return view('frontend/' . $template['folder'] . '/content/pendaftaran_sidi', $data);
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
                'tgl_baptis' => [
                    'label' => 'Tanggal Baptis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
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
                        'tgl_baptis'    => $validation->getError('tgl_baptis'),
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
                    'nama_lengkap'      => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'      => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'         => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
                    'alamat'            => $this->request->getVar('alamat'),
                    'no_hp'             => $this->request->getVar('no_hp'),
                    'email'             => $this->request->getVar('email'),
                    'nama_ayah'         => $this->request->getVar('nama_ayah'),
                    'nama_ibu'          => $this->request->getVar('nama_ibu'),
                    'tgl_baptis'        => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis'     => $this->request->getVar('gereja_baptis'),
                    'tgl_daftar'        => date('Y-m-d'),
                    'status'            => '0',
                ];

                $this->pendaftaransidi->insert($insertdata);

                $msg = [
                    'sukses' => 'Pendaftaran Sidi Anda berhasil terkirim. Kami akan menghubungi Anda segera!'
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
            'title'     => 'Pendaftaran Sidi',
            'subtitle'  => 'Manajemen Data',
        ];
        return view('backend/morvin/cmscust/pendaftaran_sidi/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pendaftaran-sidi/list';
            $listgrupf =  $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data) :
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title'     => 'Pendaftaran Sidi',
                        'list'      => $this->pendaftaransidi->list(),
                        'akses'     => $akses
                    ];
                    $msg = [
                        'data' => view('backend/morvin/cmscust/pendaftaran_sidi/list', $data)
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
            $id_sidi = $this->request->getVar('id_sidi');
            $list =  $this->pendaftaransidi->find($id_sidi);

            $data = [
                'title' => 'Detail Pendaftaran Sidi',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_sidi/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_sidi = $this->request->getVar('id_sidi');
            $list =  $this->pendaftaransidi->find($id_sidi);

            $data = [
                'title' => 'Edit Pendaftaran Sidi',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_sidi/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_sidi = $this->request->getVar('id_sidi');
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
                    'nama_lengkap'      => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'      => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'         => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
                    'alamat'            => $this->request->getVar('alamat'),
                    'no_hp'             => $this->request->getVar('no_hp'),
                    'email'             => $this->request->getVar('email'),
                    'nama_ayah'         => $this->request->getVar('nama_ayah'),
                    'nama_ibu'          => $this->request->getVar('nama_ibu'),
                    'tgl_baptis'        => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis'     => $this->request->getVar('gereja_baptis'),
                    'tgl_sidi'          => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                    'status'            => $this->request->getVar('status'),
                    'keterangan'        => $this->request->getVar('keterangan'),
                ];

                $this->pendaftaransidi->update($id_sidi, $updatedata);

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
                'title' => 'Tambah Pendaftaran Sidi',
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/pendaftaran_sidi/tambah', $data)
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
                    'nama_lengkap'      => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir'      => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir'         => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
                    'alamat'            => $this->request->getVar('alamat'),
                    'no_hp'             => $this->request->getVar('no_hp'),
                    'email'             => $this->request->getVar('email'),
                    'nama_ayah'         => $this->request->getVar('nama_ayah'),
                    'nama_ibu'          => $this->request->getVar('nama_ibu'),
                    'tgl_baptis'        => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis'     => $this->request->getVar('gereja_baptis'),
                    'tgl_daftar'        => date('Y-m-d'),
                    'tgl_sidi'          => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                    'status'            => $this->request->getVar('status'),
                    'keterangan'        => $this->request->getVar('keterangan'),
                ];

                $this->pendaftaransidi->insert($insertdata);

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
            $id_sidi = $this->request->getVar('id_sidi');
            $cekdata = $this->pendaftaransidi->find($id_sidi);

            // Hapus file dokumen jika ada
            $dokumen = ['dok_ktp', 'dok_kk', 'dok_baptis', 'dok_foto'];
            foreach ($dokumen as $dok) {
                if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/sidi/' . $cekdata[$dok])) {
                    unlink('public/file/dokumen/sidi/' . $cekdata[$dok]);
                }
            }

            $this->pendaftaransidi->delete($id_sidi);
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
            $id_sidi = $this->request->getVar('id_sidi');
            $jmldata = count($id_sidi);
            
            for ($i = 0; $i < $jmldata; $i++) {
                $cekdata = $this->pendaftaransidi->find($id_sidi[$i]);
                
                // Hapus file dokumen jika ada
                $dokumen = ['dok_ktp', 'dok_kk', 'dok_baptis', 'dok_foto'];
                foreach ($dokumen as $dok) {
                    if (!empty($cekdata[$dok]) && file_exists('public/file/dokumen/sidi/' . $cekdata[$dok])) {
                        unlink('public/file/dokumen/sidi/' . $cekdata[$dok]);
                    }
                }
                
                $this->pendaftaransidi->delete($id_sidi[$i]);
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
            $id = $this->request->getVar('id_sidi');
            $status = $this->request->getVar('status');

            $updatedata = [
                'status' => $status,
            ];
            $this->pendaftaransidi->update($id, $updatedata);
            
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
            $id = $this->request->getVar('id_sidi');
            $list =  $this->pendaftaransidi->find($id);
            
            $data = [
                'title' => 'Upload Dokumen',
                'data'  => $list
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/pendaftaran_sidi/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan upload dokumen
    public function simpanupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_sidi');
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
                $cekdata = $this->pendaftaransidi->find($id);
                $filelama = $cekdata[$jenis_dok];

                // Hapus file lama jika ada
                if ($filelama != '' && file_exists('public/file/dokumen/sidi/' . $filelama)) {
                    unlink('public/file/dokumen/sidi/' . $filelama);
                }

                $file = $this->request->getFile('file_dokumen');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    $jenis_dok => $nama_file
                ];

                $this->pendaftaransidi->update($id, $updatedata);
                $file->move('public/file/dokumen/sidi/', $nama_file);

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
            $id = $this->request->getVar('id_sidi');
            $jenis_dok = $this->request->getVar('jenis_dok');
            
            $cekdata = $this->pendaftaransidi->find($id);
            $file = $cekdata[$jenis_dok];

            if ($file != '' && file_exists('public/file/dokumen/sidi/' . $file)) {
                unlink('public/file/dokumen/sidi/' . $file);
            }

            $updatedata = [
                $jenis_dok => ''
            ];

            $this->pendaftaransidi->update($id, $updatedata);

            $msg = [
                'sukses' => 'Dokumen berhasil dihapus'
            ];

            echo json_encode($msg);
        }
    }
}
