<?php

namespace App\Controllers;

class PendaftaranSidi extends BaseController
{
    // Frontend - Halaman form pendaftaran publik
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();


        $data = [
            'title' => 'Pendaftaran Sidi | ' . $konfigurasi->nama,
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

        ];
        return view('frontend/pendaftaran/sidi', $data);
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
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'tempat_lahir' => $validation->getError('tempat_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'alamat' => $validation->getError('alamat'),
                        'no_hp' => $validation->getError('no_hp'),
                        'email' => $validation->getError('email'),
                        'tgl_baptis' => $validation->getError('tgl_baptis'),
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
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'nama_ayah' => $this->request->getVar('nama_ayah'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'tgl_baptis' => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis' => $this->request->getVar('gereja_baptis'),
                    'tgl_daftar' => date('Y-m-d'),
                    'status' => '0',
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
            'title' => 'Pendaftaran Sidi',
            'subtitle' => 'Manajemen Data',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/pendaftaran_sidi/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pendaftaran-sidi/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Pendaftaran Sidi',
                        'list' => $this->pendaftaransidi->list(),
                        'akses' => $akses
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/pendaftaran_sidi/list', $data)
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
            $list = $this->pendaftaransidi->find($id_sidi);

            $data = [
                'title' => 'Detail Pendaftaran Sidi',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_sidi = $this->request->getVar('id_sidi');
            $list = $this->pendaftaransidi->find($id_sidi);

            $data = [
                'title' => 'Edit Pendaftaran Sidi',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/edit', $data)
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
                    'tgl_baptis' => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis' => $this->request->getVar('gereja_baptis'),
                    'tgl_sidi' => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                    'status' => $this->request->getVar('status'),
                    'keterangan' => $this->request->getVar('keterangan'),
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
                'data' => view('backend/cmscust/pendaftaran_sidi/tambah', $data)
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
                    'tgl_baptis' => date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))),
                    'gereja_baptis' => $this->request->getVar('gereja_baptis'),
                    'tgl_daftar' => date('Y-m-d'),
                    'tgl_sidi' => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                    'status' => $this->request->getVar('status'),
                    'keterangan' => $this->request->getVar('keterangan'),
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
            $list = $this->pendaftaransidi->find($id);

            $data = [
                'title' => 'Upload Dokumen',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/upload', $data)
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

    // ============================================
    // DOCUMENT MANAGEMENT - NEW METHODS
    // ============================================

    // Upload dokumen pendukung
    public function uploaddokumen()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jenis_dokumen = $this->request->getVar('jenis_dokumen');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file_dokumen' => [
                    'rules' => 'uploaded[file_dokumen]|max_size[file_dokumen,5120]|ext_in[file_dokumen,jpg,jpeg,png,pdf]',
                    'errors' => [
                        'uploaded' => 'File harus diupload',
                        'max_size' => 'Ukuran file maksimal 5MB',
                        'ext_in' => 'Format file harus jpg, jpeg, png, atau pdf'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = ['error' => $validation->getErrors()];
                echo json_encode($msg);
                return;
            }

            $file = $this->request->getFile('file_dokumen');
            if ($file->isValid() && !$file->hasMoved()) {
                // Generate nama file unik
                $newName = 'sidi_' . $id . '_' . time() . '_' . $file->getRandomName();

                // Pindahkan file
                $file->move(FCPATH . 'public/img/pendaftaran/sidi/', $newName);

                // Simpan ke database
                $data_dokumen = [
                    'jenis_pendaftaran' => 'sidi',
                    'pendaftaran_id' => $id,
                    'jenis_dokumen' => $jenis_dokumen,
                    'nama_file' => $file->getClientName(),
                    'file_path' => 'public/img/pendaftaran/sidi/' . $newName,
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getClientMimeType(),
                    'status_dokumen' => 'pending',
                    'uploaded_by' => session()->get('id'),
                    'tgl_upload' => date('Y-m-d H:i:s')
                ];

                $this->pendaftarandokumen->insert($data_dokumen);

                // Update kelengkapan dokumen
                $kelengkapan = $this->pendaftarandokumen->hitungKelengkapan('sidi', $id);
                $this->pendaftaransidi->update($id, ['kelengkapan_dokumen' => $kelengkapan]);

                // Add timeline
                $this->pendaftarantimeline->addTimeline(
                    'sidi',
                    $id,
                    'Upload Dokumen',
                    'Upload dokumen: ' . $jenis_dokumen
                );

                $msg = [
                    'sukses' => 'Dokumen berhasil diupload',
                    'kelengkapan' => $kelengkapan
                ];
            } else {
                $msg = ['error' => 'Gagal upload file'];
            }

            echo json_encode($msg);
        }
    }

    // Get list dokumen
    public function getdokumen()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $dokumen = $this->pendaftarandokumen->getDokumenWithUser('sidi', $id);
            $master = $this->masterdokumen->getByJenisPendaftaran('sidi');

            $data = [
                'dokumen' => $dokumen,
                'master' => $master,
                'id' => $id
            ];


            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/dokumen', $data)
            ];

            echo json_encode($msg);
        }
    }

    // Verifikasi dokumen
    public function verifydokumen()
    {
        if ($this->request->isAJAX()) {
            $dokumen_id = $this->request->getVar('dokumen_id');
            $status = $this->request->getVar('status');
            $keterangan = $this->request->getVar('keterangan');

            $dokumen = $this->pendaftarandokumen->find($dokumen_id);
            if (!$dokumen) {
                $msg = ['error' => 'Dokumen tidak ditemukan'];
                echo json_encode($msg);
                return;
            }

            // Update status dokumen
            $this->pendaftarandokumen->updateStatus($dokumen_id, $status, $keterangan, session()->get('id'));

            // Update kelengkapan
            $kelengkapan = $this->pendaftarandokumen->hitungKelengkapan('sidi', $dokumen['pendaftaran_id']);
            $this->pendaftaransidi->update($dokumen['pendaftaran_id'], ['kelengkapan_dokumen' => $kelengkapan]);

            // Add timeline
            $status_text = [
                'valid' => 'Dokumen disetujui',
                'invalid' => 'Dokumen ditolak',
                'revisi' => 'Dokumen perlu revisi'
            ];
            $this->pendaftarantimeline->addTimeline(
                'sidi',
                $dokumen['pendaftaran_id'],
                $status_text[$status],
                $dokumen['jenis_dokumen'] . ': ' . $keterangan
            );

            $msg = [
                'sukses' => 'Status dokumen berhasil diupdate',
                'kelengkapan' => $kelengkapan
            ];

            echo json_encode($msg);
        }
    }

    // Hapus dokumen
    public function hapusdokumen()
    {
        if ($this->request->isAJAX()) {
            $dokumen_id = $this->request->getVar('dokumen_id');

            $dokumen = $this->pendaftarandokumen->find($dokumen_id);
            if (!$dokumen) {
                $msg = ['error' => 'Dokumen tidak ditemukan'];
                echo json_encode($msg);
                return;
            }

            // Hapus file fisik dan record
            $this->pendaftarandokumen->hapusDokumen($dokumen_id);

            // Update kelengkapan
            $kelengkapan = $this->pendaftarandokumen->hitungKelengkapan('sidi', $dokumen['pendaftaran_id']);
            $this->pendaftaransidi->update($dokumen['pendaftaran_id'], ['kelengkapan_dokumen' => $kelengkapan]);

            // Add timeline
            $this->pendaftarantimeline->addTimeline(
                'sidi',
                $dokumen['pendaftaran_id'],
                'Hapus Dokumen',
                'Dokumen ' . $dokumen['jenis_dokumen'] . ' dihapus'
            );

            $msg = ['sukses' => 'Dokumen berhasil dihapus'];
            echo json_encode($msg);
        }
    }

    // Get timeline
    public function gettimeline()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $timeline = $this->pendaftarantimeline->getTimelineByPendaftaran('sidi', $id);

            $data = ['timeline' => $timeline];


            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/timeline', $data)
            ];

            echo json_encode($msg);
        }
    }

    // Add catatan
    public function addcatatan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $catatan = $this->request->getVar('catatan');
            $tipe = $this->request->getVar('tipe');

            if (empty($catatan)) {
                $msg = ['error' => 'Catatan tidak boleh kosong'];
                echo json_encode($msg);
                return;
            }

            $this->pendaftarancatatan->addCatatan('sidi', $id, $catatan, $tipe);

            // Add timeline
            $this->pendaftarantimeline->addTimeline(
                'sidi',
                $id,
                'Catatan Ditambahkan',
                'Catatan ' . $tipe . ' ditambahkan'
            );

            $msg = ['sukses' => 'Catatan berhasil ditambahkan'];
            echo json_encode($msg);
        }
    }

    // Get catatan
    public function getcatatan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $catatan = $this->pendaftarancatatan->getCatatanByPendaftaran('sidi', $id);

            $data = ['catatan' => $catatan, 'id' => $id];


            $msg = [
                'sukses' => view('backend/cmscust/pendaftaran_sidi/catatan', $data)
            ];

            echo json_encode($msg);
        }
    }

    // Approve pendaftaran
    public function approve()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $keterangan = $this->request->getVar('keterangan');

            // Check kelengkapan dokumen
            if (!$this->pendaftarandokumen->isDokumenLengkap('sidi', $id)) {
                $msg = ['error' => 'Dokumen belum lengkap! Tidak dapat disetujui.'];
                echo json_encode($msg);
                return;
            }

            $data = [
                'status' => 'Disetujui',
                'tgl_disetujui' => date('Y-m-d H:i:s'),
                'approved_by' => session()->get('id')
            ];

            $this->pendaftaransidi->update($id, $data);

            // Add timeline
            $this->pendaftarantimeline->addTimeline('sidi', $id, 'Disetujui', $keterangan);

            // Add catatan eksternal
            if ($keterangan) {
                $this->pendaftarancatatan->addCatatan(
                    'sidi',
                    $id,
                    'Pendaftaran disetujui. ' . $keterangan,
                    'eksternal'
                );
            }

            $msg = ['sukses' => 'Pendaftaran berhasil disetujui'];
            echo json_encode($msg);
        }
    }

    // Reject pendaftaran
    public function reject()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $alasan = $this->request->getVar('alasan');

            if (empty($alasan)) {
                $msg = ['error' => 'Alasan penolakan harus diisi'];
                echo json_encode($msg);
                return;
            }

            $data = [
                'status' => 'Ditolak',
                'tgl_ditolak' => date('Y-m-d H:i:s'),
                'approved_by' => session()->get('id'),
                'alasan_tolak' => $alasan
            ];

            $this->pendaftaransidi->update($id, $data);

            // Add timeline
            $this->pendaftarantimeline->addTimeline('sidi', $id, 'Ditolak', $alasan);

            // Add catatan eksternal
            $this->pendaftarancatatan->addCatatan(
                'sidi',
                $id,
                'Pendaftaran ditolak. Alasan: ' . $alasan,
                'eksternal'
            );

            $msg = ['sukses' => 'Pendaftaran berhasil ditolak'];
            echo json_encode($msg);
        }
    }
}





