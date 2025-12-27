<?php

namespace App\Controllers;

use App\Models\M_PendaftaranBaptis as PendaftaranBaptisModel;

class PendaftaranBaptis extends BaseController
{
    protected $pendaftaranBaptisModel;
    protected $helpers = ['form', 'url', 'file'];

    /**
     * Menampilkan halaman form pendaftaran baptis untuk umum
     */
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();


        $data = [
            'title' => 'Pendaftaran Baptis | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'sitekey' => $konfigurasi->g_sitekey,
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'validation' => \Config\Services::validation()
        ];

        return view('frontend/' . $template['folder'] . '/content/pendaftaran_baptis', $data);
    }

    /**
     * Menyimpan data pendaftaran baptis dari form
     */
    public function simpanpendaftaran()
    {
        $this->pendaftaranBaptisModel = new PendaftaranBaptisModel();

        // Validasi CSRF Token
        if (!$this->request->isAJAX() || !$this->validate(['_method' => 'post'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Permintaan tidak valid atau sesi telah berakhir. Silakan refresh halaman dan coba lagi.'
            ]);
        }

        // Validasi reCAPTCHA jika aktif
        if ($this->konfigurasi->recaptcha == 1) {
            $recaptcha = \Config\Services::recaptcha();
            $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

            if (!$recaptcha->verify($recaptchaResponse)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'
                ]);
            }
        }

        // Aturan validasi
        $rules = [
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'max_length' => '{field} maksimal 255 karakter!'
                ]
            ],
            'tempat_lahir' => [
                'label' => 'Tempat Lahir',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'max_length' => '{field} maksimal 100 karakter!'
                ]
            ],
            'tgl_lahir' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'valid_date' => 'Format {field} tidak valid!'
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => '{field} harus dipilih!',
                    'in_list' => '{field} tidak valid!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ],
            'no_hp' => [
                'label' => 'Nomor HP',
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'max_length' => '{field} maksimal 20 karakter!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'valid_email' => 'Format {field} tidak valid!',
                    'max_length' => '{field} maksimal 100 karakter!'
                ]
            ],
            'nama_ayah' => [
                'label' => 'Nama Ayah',
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => '{field} maksimal 255 karakter!'
                ]
            ],
            'nama_ibu' => [
                'label' => 'Nama Ibu',
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => '{field} maksimal 255 karakter!'
                ]
            ],
            'jenis_baptis' => [
                'label' => 'Jenis Baptis',
                'rules' => 'required|in_list[Baptis Anak,Baptis Dewasa]',
                'errors' => [
                    'required' => '{field} harus dipilih!',
                    'in_list' => '{field} tidak valid!'
                ]
            ],
            'dok_ktp' => [
                'label' => 'Dokumen KTP',
                'rules' => 'uploaded[dok_ktp]|max_size[dok_ktp,2048]|mime_in[dok_ktp,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah!',
                    'max_size' => 'Ukuran {field} maksimal 2MB!',
                    'mime_in' => 'Format {field} harus JPG, PNG, atau PDF!'
                ]
            ],
            'dok_kk' => [
                'label' => 'Dokumen KK',
                'rules' => 'uploaded[dok_kk]|max_size[dok_kk,2048]|mime_in[dok_kk,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah!',
                    'max_size' => 'Ukuran {field} maksimal 2MB!',
                    'mime_in' => 'Format {field} harus JPG, PNG, atau PDF!'
                ]
            ],
            'dok_akta_lahir' => [
                'label' => 'Dokumen Akta Lahir',
                'rules' => 'uploaded[dok_akta_lahir]|max_size[dok_akta_lahir,2048]|mime_in[dok_akta_lahir,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah!',
                    'max_size' => 'Ukuran {field} maksimal 2MB!',
                    'mime_in' => 'Format {field} harus JPG, PNG, atau PDF!'
                ]
            ],
            'dok_foto' => [
                'label' => 'Foto',
                'rules' => 'uploaded[dok_foto]|max_size[dok_foto,1024]|is_image[dok_foto]|mime_in[dok_foto,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah!',
                    'max_size' => 'Ukuran {field} maksimal 1MB!',
                    'is_image' => 'File yang diunggah harus berupa gambar!',
                    'mime_in' => 'Format {field} harus JPG atau PNG!'
                ]
            ]
        ];

        // Hanya validasi dokumen pernikahan ortu jika baptis anak
        if ($this->request->getPost('jenis_baptis') === 'Baptis Anak') {
            $rules['dok_surat_nikah_ortu'] = [
                'label' => 'Dokumen Surat Nikah Orang Tua',
                'rules' => 'uploaded[dok_surat_nikah_ortu]|max_size[dok_surat_nikah_ortu,2048]|mime_in[dok_surat_nikah_ortu,image/jpeg,image/png,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} wajib diunggah untuk baptis anak!',
                    'max_size' => 'Ukuran {field} maksimal 2MB!',
                    'mime_in' => 'Format {field} harus JPG, PNG, atau PDF!'
                ]
            ];
        }

        // Jalankan validasi
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $errors,
                'message' => 'Terdapat kesalahan pada form. Silakan periksa kembali.'
            ]);
        }

        // Proses upload file
        $uploadedFiles = [];
        $uploadPath = WRITEPATH . 'uploads/pendaftaran_baptis/' . date('Y/m/d');

        // Buat direktori jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Daftar field file yang akan diupload
        $fileFields = ['dok_ktp', 'dok_kk', 'dok_akta_lahir', 'dok_foto', 'dok_surat_nikah_ortu'];

        foreach ($fileFields as $field) {
            $file = $this->request->getFile($field);

            // Skip jika tidak ada file yang diupload
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);
                $uploadedFiles[$field] = 'pendaftaran_baptis/' . date('Y/m/d') . '/' . $newName;
            } elseif ($field === 'dok_surat_nikah_ortu' && $this->request->getPost('jenis_baptis') !== 'Baptis Anak') {
                // Skip validasi untuk dokumen pernikahan ortu jika bukan baptis anak
                continue;
            }
        }

        // Siapkan data untuk disimpan
        $data = [
            'no_pendaftaran' => $this->pendaftaranBaptisModel->generateNoPendaftaran(),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'email' => $this->request->getPost('email'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'jenis_baptis' => $this->request->getPost('jenis_baptis'),
            'nama_pendamping' => $this->request->getPost('nama_pendamping'),
            'hubungan_pendamping' => $this->request->getPost('hubungan_pendamping'),
            'tgl_daftar' => date('Y-m-d'),
            'status' => '0', // Status pending
            'keterangan' => 'Pendaftaran baru'
        ];

        // Gabungkan data file yang sudah diupload
        $data = array_merge($data, $uploadedFiles);

        // Simpan ke database
        try {
            // Simpan data
            $saved = $this->pendaftaranBaptisModel->save($data);

            if (!$saved) {
                // Hapus file yang sudah diupload jika gagal menyimpan ke database
                foreach ($uploadedFiles as $file) {
                    if (file_exists(WRITEPATH . 'uploads/' . $file)) {
                        unlink(WRITEPATH . 'uploads/' . $file);
                    }
                }

                throw new \RuntimeException('Gagal menyimpan data pendaftaran');
            }

            // Kirim email notifikasi jika diperlukan
            $this->_sendNotificationEmail($data);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pendaftaran berhasil disimpan. Nomor pendaftaran Anda: ' . $data['no_pendaftaran'],
                'no_pendaftaran' => $data['no_pendaftaran']
            ]);

        } catch (\Exception $e) {
            // Hapus file yang sudah diupload jika terjadi error
            foreach ($uploadedFiles as $file) {
                if (file_exists(WRITEPATH . 'uploads/' . $file)) {
                    unlink(WRITEPATH . 'uploads/' . $file);
                }
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    /**
     * Send notification email for new registration
     */
    private function _sendNotificationEmail($data)
    {
        // Skip if email notification is disabled
        if (!$this->konfigurasi->email_notification) {
            return false;
        }

        $email = \Config\Services::email();
        $template = view('emails/pendaftaran_baptis', $data);

        $email->setTo($data['email']);
        $email->setFrom($this->konfigurasi->email_from, $this->konfigurasi->nama);
        $email->setSubject('Konfirmasi Pendaftaran Baptis - ' . $data['no_pendaftaran']);
        $email->setMessage($template);

        // Attach files if needed
        // $email->attach(WRITEPATH . 'uploads/' . $data['dok_ktp']);

        return $email->send();
    }

    // Backend - List data pendaftaran
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Pendaftaran Baptis',
            'subtitle' => 'Manajemen Data',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/pendaftaran_baptis/index', $data);
    }

    // Backend - Get data untuk datatables
    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pendaftaran-baptis/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            $akses = 0;
            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Pendaftaran Baptis',
                        'list' => $this->pendaftaranbaptis->list(),
                        'akses' => $akses
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/pendaftaran_baptis/list', $data)
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
            $list = $this->pendaftaranbaptis->find($id_baptis);

            $data = [
                'title' => 'Detail Pendaftaran Baptis',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_baptis/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_baptis = $this->request->getVar('id_baptis');
            $list = $this->pendaftaranbaptis->find($id_baptis);

            $data = [
                'title' => 'Edit Pendaftaran Baptis',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_baptis/edit', $data)
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
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'nama_ayah' => $this->request->getVar('nama_ayah'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'jenis_baptis' => $this->request->getVar('jenis_baptis'),
                    'nama_pendamping' => $this->request->getVar('nama_pendamping'),
                    'hubungan_pendamping' => $this->request->getVar('hubungan_pendamping'),
                    'tgl_baptis' => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                    'status' => $this->request->getVar('status'),
                    'keterangan' => $this->request->getVar('keterangan'),
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
                'data' => view('backend/cmscust/pendaftaran_baptis/tambah', $data)
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
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                    ]
                ];
            } else {
                $insertdata = [
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'nama_ayah' => $this->request->getVar('nama_ayah'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'jenis_baptis' => $this->request->getVar('jenis_baptis'),
                    'nama_pendamping' => $this->request->getVar('nama_pendamping'),
                    'hubungan_pendamping' => $this->request->getVar('hubungan_pendamping'),
                    'tgl_daftar' => date('Y-m-d'),
                    'tgl_baptis' => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                    'status' => $this->request->getVar('status'),
                    'keterangan' => $this->request->getVar('keterangan'),
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
            $list = $this->pendaftaranbaptis->find($id);

            $data = [
                'title' => 'Upload Dokumen',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_baptis/upload', $data)
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
