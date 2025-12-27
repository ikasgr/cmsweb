<?php

namespace App\Controllers;

class User extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }


        $data = [
            'title' => 'Setting',
            'subtitle' => 'Manage User',

        ];
        return view('backend/pengaturan/user/index', $data);
    }

    public function getdata()
    {
        // Pastikan ada session id dan request adalah AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        $id_grup = session()->get('id_grup');
        $id = session()->get('id');
        $url = 'user';

        // Ambil grup akses untuk mengecek akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses ditemukan
        if ($listgrupf) {
            $akses = $listgrupf->akses;
            // Menentukan daftar user berdasarkan akses
            $list = ($akses == 1) ? $this->user->listuserall() : (($akses == 2) ? $this->user->listbyid($id) : []);

            // Jika akses sesuai, tampilkan data
            if (in_array($akses, [1, 2])) {
                $data = [
                    'title' => 'Manage User',
                    'list' => $list,
                    'akses' => $akses,
                    'hapus' => $listgrupf->hapus,
                    'ubah' => $listgrupf->ubah,
                    'tambah' => $listgrupf->tambah,
                ];
                $msg = ['data' => view('backend/pengaturan/user/list', $data)];
            } else {
                // Tidak ada akses
                $msg = ['noakses' => []];
            }
        } else {
            // Grup akses tidak ditemukan
            $msg = ['blmakses' => []];
        }

        // Kirim respons JSON
        echo json_encode($msg);
    }

    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jns = $this->request->getVar('jns');

            $updatedata = ($jns == 1)
                ? ['active' => ($this->user->find($id)['active'] == '1') ? 0 : 1]
                : ['login_attempts' => 0];

            $pesan = ($jns == 1)
                ? ($updatedata['active'] ? 'Berhasil mengaktifkan user' : 'Berhasil nonaktifkan user!')
                : 'Berhasil reset akses Login';

            $this->user->update($id, $updatedata);

            echo json_encode([
                'sukses' => $pesan,
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
        }
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $list = $this->konfigurasi->orderBy('id_setaplikasi ')->first();
            $konopd = $list['konek_opd'];

            if ($konopd == 1) {
                $opd = $this->unitkerja->listopd();
            } else {
                $opd = '';
            }
            $data = [
                'title' => 'Tambah User',
                'opd' => $opd,
                'listgrup' => $this->grupuser->listgrups(),

            ];

            $msg = [
                'data' => view('backend/pengaturan/user/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpanUser()
    {
        if (!session()->get('id'))
            return redirect()->to('');

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $rules = [
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} tidak boleh sama!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],

                'fullname' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} tidak valid!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],

                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                        'is_unique' => '{field} tidak boleh sama!',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[10]|max_length[20]|regex_match[/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'min_length' => 'Masukkan {field} minimal 10 Karakter!',
                        'max_length' => 'Masukkan {field} maksimal 20 Karakter!',
                        'regex_match' => '{field} sangat lemah',
                    ]
                ],

                'id_grup' => [
                    'label' => 'Grup User',
                    'rules' => 'required',
                    'errors' => ['required' => 'Silahkan pilih {field}!']
                ],
                'foto' => [
                    'label' => 'Foto Profil',
                    'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]|is_image[foto]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                echo json_encode([
                    'error' => $validation->getErrors(),
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            $opd_id = $this->request->getVar('opd_id');
            $konopd = $this->konfigurasi->orderBy('id_setaplikasi')->first()['konek_opd'];
            $filegambar = $this->request->getFile('foto');
            $nama_file = $filegambar->isValid() ? $filegambar->getRandomName() : 'default.png';

            $insertdata = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'fullname' => $this->request->getVar('fullname'),
                'user_image' => $nama_file,
                'id_grup' => $this->request->getVar('id_grup'),
                'active' => 1,
                'login_attempts' => 0,
            ];

            if ($konopd == 1 && $opd_id == '') {
                echo json_encode([
                    'gopdid' => 'Unit kerja belum dipilih!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            $insertdata['opd_id'] = $opd_id;
            $this->user->insert($insertdata);

            if ($filegambar->isValid()) {
                $filegambar->move('public/img/user/', $nama_file);
            }

            echo json_encode([
                'sukses' => 'User berhasil ditambahkan!',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
        }
    }


    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            //check
            $cekdata = $this->user->find($id);
            $fotolama = $cekdata['user_image'];
            if ($fotolama != 'default.png' && file_exists('public/img/user/' . $fotolama)) {
                unlink('public/img/user/' . $fotolama);
            }
            $this->user->delete($id);
            $msg = [
                'sukses' => 'Data User Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->user->find($id[$i]);
                $fotolama = $cekdata['user_image'];
                if ($fotolama != 'default.png' && file_exists('public/img/user/' . $fotolama)) {
                    unlink('public/img/user/' . $fotolama);
                }
                $this->user->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $list = $this->user->find($id);

            $listset = $this->konfigurasi->orderBy('id_setaplikasi ')->first();
            // cari setingkan konek opd di seting
            $konopd = $listset['konek_opd'];

            if ($konopd == 1) {
                $opd = $this->unitkerja->listopd();
            } else {
                $opd = '';
            }

            $data = [
                'title' => 'Edit User',
                'id' => $list['id'],
                'username' => $list['username'],
                'email' => $list['email'],
                'fullname' => $list['fullname'],
                // 'level'      => $list['level'],
                'opd_id' => $list['opd_id'],
                'opd' => $opd,
                'id_grup' => $list['id_grup'],
                'jenisgrp' => $this->request->getVar('jenisgrp'),
                'listgrup' => $this->grupuser->listgrups()

            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updateuser()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getVar('id');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'fullname' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                    ]
                ],
                'id_grup' => [
                    'label' => 'Grup User',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'email' => $validation->getError('email'),
                        'fullname' => $validation->getError('fullname'),
                        'id_grup' => $validation->getError('id_grup')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $namausernew = $this->request->getVar('username');
                $namauserold = $this->request->getpost('userold');
                $opd_id = $this->request->getVar('opd_id');

                $pass = $this->request->getpost('password');

                if ($pass != '') {

                    $valid = $this->validate([
                        'password' => [
                            'label' => 'Password',
                            'rules' => 'min_length[10]|max_length[20]|regex_match[/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/]',
                            'errors' => [
                                'min_length' => 'Masukkan {field} minimal 10 Karakter!',
                                'max_length' => 'Masukkan {field} maksimal 20 Karakter!',
                                'regex_match' => 'Ganti {field} yang kuat!',
                            ]
                        ],
                    ]);
                    if (!$valid) {

                        $msg = [
                            'errorpass' => $validation->getError('password'),
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                        // echo json_encode($msg);
                    } else {

                        $data = array(
                            'password_hash' => (password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)),
                        );
                        $this->user->update($user_id, $data);
                    }
                    // echo json_encode($msg);
                }
                if ($namausernew == $namauserold) {
                    $updatedata = [
                        'email' => $this->request->getVar('email'),
                        'fullname' => $this->request->getVar('fullname'),
                        'id_grup' => $this->request->getVar('id_grup'),
                        'opd_id' => $opd_id
                    ];
                    $this->user->update($user_id, $updatedata);
                    $msg = [
                        'sukses' => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {
                    $userganda = $this->user->listuserganda($namausernew);
                    if ($userganda) {
                        $msg = [
                            'namaganda' => 'Data gagal diubah..!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                    } else {
                        $updatedata = [
                            'username' => $namausernew,
                            'email' => $this->request->getVar('email'),
                            'fullname' => $this->request->getVar('fullname'),
                            'id_grup' => $this->request->getVar('id_grup'),
                            'opd_id' => $opd_id
                        ];
                        $this->user->update($user_id, $updatedata);
                        $msg = [
                            'sukses' => 'Data berhasil diubah!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                    }
                }
            }
            echo json_encode($msg);
        }
    }

    public function formgantifoto()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $list = $this->user->find($id);

            $data = [
                'title' => 'Ganti Foto Profil',
                'id' => $list['id'],
                'user_image' => $list['user_image'],
                'username' => $list['username']
            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/gantifoto', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }


    public function douploaduser()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'fotouser' => [
                    'label' => 'Foto Profil',
                    'rules' => 'uploaded[fotouser]|max_size[fotouser,1024]|mime_in[fotouser,image/png,image/jpg,image/jpeg,image/gif]|is_image[fotouser]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'fotouser' => $validation->getError('fotouser')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->user->find($id);
                $fotolama = $cekdata['user_image'];

                if ($fotolama != 'default.png' && file_exists('public/img/user/' . $fotolama)) {
                    unlink('public/img/user/' . $fotolama);
                }

                $filegambar = $this->request->getFile('fotouser');
                $nama_file = $filegambar->getRandomName();

                $updatedata = [
                    'user_image' => $nama_file
                ];

                $this->user->update($id, $updatedata);
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(215, 220, 'center')
                    ->save('public/img/user/' . $nama_file);
                $msg = [
                    'sukses' => 'Foto profil berhasil diganti!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formlihat()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $list = $this->user->find($id);
            $listset = $this->konfigurasi->orderBy('id_setaplikasi ')->first();
            // cari setingkan konek opd di seting
            $konopd = $listset['konek_opd'];

            if ($konopd == 1) {
                $opd = $this->unitkerja->listopd();
            } else {
                $opd = '';
            }
            $berita = $this->berita->selectCount('berita_id')->where('id', $id)->where('jenis_berita', 'Berita')->first();
            if ($berita) {
                $jberita = $berita['berita_id'];
            } else {
                $jberita = 0;
            }

            $halaman = $this->berita->selectCount('berita_id')->where('id', $id)->where('jenis_berita', 'Halaman')->first();

            if ($halaman) {
                $jhalaman = $halaman['berita_id'];
            } else {
                $jhalaman = 0;
            }
            $pengumuman = $this->pengumuman->selectCount('informasi_id')->where('id', $id)->where('type', '1')->first();
            if ($pengumuman) {
                $jpengumuman = $pengumuman['informasi_id'];
                # code...
            } else {
                $jpengumuman = 0;
            }

            $layanan = $this->layanan->selectCount('informasi_id')->where('id', $id)->where('type', '0')->first();
            if ($layanan) {
                $jlayanan = $layanan['informasi_id'];
                # code...
            } else {
                $jlayanan = 0;
            }
            $bank = $this->bankdata->selectCount('bankdata_id')->where('id', $id)->first();
            if ($bank) {
                $jbankdata = $bank['bankdata_id'];
                # code...
            } else {
                $jbankdata = 0;
            }

            $foto = $this->foto->selectCount('foto_id')->where('id', $id)->first();
            if ($foto) {
                $jfoto = $foto = $foto['foto_id'];
                # code...
            } else {
                $jfoto = 0;
            }
            $video = $this->video->selectCount('video_id')->where('id', $id)->first();
            if ($video) {
                $jvideo = $video['video_id'];
                # code...
            } else {
                $jvideo = 0;
            }
            $ebook = $this->ebook->selectCount('ebook_id')->where('id', $id)->first();
            if ($ebook) {
                $jebook = $ebook['ebook_id'];
                # code...
            } else {
                $jebook = 0;
            }
            $beritakomen = $this->beritakomen->selectCount('beritakomen_id')->where('id', $id)->first();
            if ($beritakomen) {
                $jberitakomen = $beritakomen['beritakomen_id'];
                # code...
            } else {
                $jberitakomen = 0;
            }
            $poling = $this->poling->selectCount('poling_id')->where('id', $id)->first();

            if ($poling) {
                $jpoling = $poling['poling_id'];
                # code...
            } else {
                $jpoling = 0;
            }

            $produkhukum = $this->produkhukum->selectCount('produk_id')->where('id', $id)->first();
            if ($produkhukum) {
                $jprodukhukum = $produkhukum['produk_id'];
                # code...
            } else {
                $jprodukhukum = 0;
            }
            $surveytopik = $this->surveytopik->selectCount('survey_id')->where('id', $id)->first();
            if ($surveytopik) {
                $jsurveytopik = $surveytopik['survey_id'];
                # code...
            } else {
                $jsurveytopik = 0;
            }
            $transparan = $this->transparan->selectCount('transparan_id')->where('id', $id)->first();
            if ($transparan) {
                $jtransparan = $transparan['transparan_id'];
                # code...
            } else {
                $jtransparan = 0;
            }
            $totposting = $jtransparan + $jsurveytopik + $jprodukhukum + $jpoling + $jberitakomen
                + $jebook + $jvideo + $jfoto + $jbankdata + $jlayanan + $jpengumuman + $jhalaman + $jberita;
            $data = [
                'title' => 'Statistik Postingan ' . esc($list['fullname']),
                'id' => $list['id'],
                'username' => esc($list['username']),
                'email' => esc($list['email']),
                'fullname' => esc($list['fullname']),
                'opd_id' => $list['opd_id'],
                'opd' => $opd,
                'id_grup' => $list['id_grup'],
                'jenisgrp' => $this->request->getVar('jenisgrp'),
                'listgrup' => $this->grupuser->listgrups(),
                'berita' => $jberita,
                'totlayanan' => $jlayanan,
                'totpengumuman' => $jpengumuman,
                'bankdata' => $jbankdata,
                'foto' => $jfoto,
                'video' => $jvideo,
                'ebook' => $jebook,
                'jtransparan' => $jtransparan,
                'jhalaman' => $jhalaman,
                'jsurveytopik' => $jsurveytopik,
                'jprodukhukum' => $jprodukhukum,
                'jpoling' => $jpoling,
                'jberitakomen' => $jberitakomen,
                'totposting' => $totposting,

            ];

            $msg = [
                'sukses' => view('backend/pengaturan/user/lihat', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // GRUP USER (LEVEL)------------------------------------------------------------

    public function grup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Pengaturan',
            'subtitle' => 'User Group',

        ];
        return view('backend/pengaturan/user/grup/index', $data);
    }

    public function getgrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'user';
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            $akses = $listgrupf->akses;
            $hapus = $listgrupf->hapus;
            $ubah = $listgrupf->ubah;
            $tambah = $listgrupf->tambah;

            if ($akses == 1) {
                $list = $this->grupuser->list();
            } elseif ($akses == 2) {
                $list = $this->grupuser->listbyid($id_grup);
            }
            // jika temukan maka eksekusi

            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Group User',
                        'list' => $list,
                        'akses' => $akses,
                        'hapus' => $hapus,
                        'ubah' => $ubah,
                        'tambah' => $tambah,
                    ];
                    $msg = [
                        'data' => view('backend/pengaturan/user/grup/list', $data)

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

    // form add grup
    public function formgrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Grup',
                'listgrupakses' => $this->modulecms->listmodulgrup(),

            ];

            $msg = [
                'data' => view('backend/pengaturan/user/grup/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpangrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_grup' => [
                    'label' => 'Nama Grup',
                    'rules' => 'required|is_unique[cms__usergrup.nama_grup]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_grup' => $validation->getError('nama_grup'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $akses = $this->request->getVar('akses');
                $id_modul = $this->request->getVar('id_modul');

                $simpandata = [
                    'nama_grup' => $this->request->getVar('nama_grup'),
                    'ketgrup' => $this->request->getVar('ketgrup'),
                    'jenis' => '2',

                ];

                $this->grupuser->insert($simpandata);

                // detail
                $id_grup = $this->grupuser->getInsertID();

                $jdata = count($id_modul);
                for ($i = 0; $i < $jdata; $i++) {
                    $insertakses = [
                        'id_grup' => $id_grup,
                        'id_modul' => $id_modul[$i],
                        'akses' => $akses[$i],
                    ];

                    $this->grupakses->insert($insertakses);
                }

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }
    // Form Edit hak akses grup
    public function formeditgrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');
            $list = $this->grupuser->find($id_grup);


            $data = [
                'title' => 'Edit Group',
                'id_grup' => $list['id_grup'],
                'nama_grup' => $list['nama_grup'],
                // 'modul'         => $this->modulecms->list() 
                // 'listgrupakses' => $this->modulecms->listmodulgrup(), listgrupedit
                // 'modul'         => $this->grupakses->listgrupaksesedit($id_grup),
                'modul' => $this->grupakses->listgrupedit($id_grup),


            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/grup/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // Proses update hak akses grup
    public function updategrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_grup' => [
                    'label' => 'Nama Grup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_grup' => $validation->getError('nama_grup'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $id_grup = $this->request->getVar('id_grup');
                $akses = $this->request->getVar('akses');
                $tambah = $this->request->getVar('tambah');
                $ubah = $this->request->getVar('ubah');
                $hapus = $this->request->getVar('hapus');
                $id_modul = $this->request->getVar('id_modul');
                $id_grupakses = $this->request->getVar('id_grupakses');

                // $listakses      =  $this->grupakses->editaksesmenu($id_grup);

                // foreach ($listakses as $key => $value) {
                //     $this->grupakses->delete($id_grupakses);
                // }

                $jdata = count($id_modul);
                for ($i = 0; $i < $jdata; $i++) {
                    $updatedatadet = [
                        'id_grup' => $id_grup,
                        'id_modul' => $id_modul[$i],
                        'akses' => $akses[$i],
                        'tambah' => $tambah[$i],
                        'ubah' => $ubah[$i],
                        'hapus' => $hapus[$i],
                    ];
                    $this->grupakses->update($id_grupakses[$i], $updatedatadet);
                    // $this->grupakses->insert($updatedatadet);
                }

                $msg = [
                    'sukses' => 'Hak Akses berhasil diubah',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }
    // Form Edit hak akses grup
    public function formlihatakses()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');
            $list = $this->grupuser->find($id_grup);

            $data = [
                'title' => 'Lihat Akses',
                'id_grup' => $list['id_grup'],
                'nama_grup' => $list['nama_grup'],
                'modul' => $this->grupakses->listgrupedit($id_grup),
                // 'modul'         => $this->grupakses->listgrupaksesedit($id_grup),
            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/grup/lihatakses', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // edit nama dan ket saja
    public function formeditgrupnm()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');
            $list = $this->grupuser->find($id_grup);

            $data = [
                'title' => 'Edit Group',
                'id_grup' => $id_grup,
                'nama_grup' => $list['nama_grup'],
                'ketgrup' => $list['ketgrup'],
                // 'modul'         => $this->grupakses->listgrupaksesedit($id_grup),

            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/grup/editnm', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updategrupnm()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_grup' => [
                    'label' => 'Nama Grup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_grup' => $validation->getError('nama_grup'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'nama_grup' => $this->request->getVar('nama_grup'),
                    'ketgrup' => $this->request->getVar('ketgrup'),
                ];

                $id_grup = $this->request->getVar('id_grup');
                $this->grupuser->update($id_grup, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diubah',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // ADD AKSES MENU

    public function formaddmenugrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');


            $data = [
                'title' => 'Tambah Akses Menu',
                'id_grup' => $id_grup,
                'modul' => $this->modulecms->listmenuutama()

            ];
            $msg = [
                'sukses' => view('backend/pengaturan/user/grup/addmenu', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpangrupmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $aksesmenu = $this->request->getVar('aksesmenu');
            $id_modul = $this->request->getVar('id_modul');

            // ubah status menu agar siap ditambahkan di konfigurasi & user
            $id_grup = $this->request->getVar('id_grup');

            $updatedata = [
                'sts_menu' => '1',
            ];

            $id_grup = $this->request->getVar('id_grup');
            $this->grupuser->update($id_grup, $updatedata);

            // Tambahkan ke role grup akses menu
            $jdata = count($id_modul);
            for ($i = 0; $i < $jdata; $i++) {
                $insertakses = [
                    'id_grup' => $id_grup,
                    'id_modul' => $id_modul[$i],
                    'aksesmenu' => $aksesmenu[$i],
                ];

                $this->grupakses->insert($insertakses);
            }
            $msg = [
                'sukses' => 'Data berhasil disimpan',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    // EDIT MENU ...........

    public function formeditmenugrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');
            $data = [
                'title' => 'Tambah Akses Menu',
                'id_grup' => $id_grup,
                'modul' => $this->grupakses->editaksesmenu($id_grup),

            ];


            $msg = [
                'sukses' => view('backend/pengaturan/user/grup/editmenu', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // Proses update hak akses menu grup
    public function updatemenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_grup = $this->request->getVar('id_grup');
            $aksesmenu = $this->request->getVar('aksesmenu');
            $id_modul = $this->request->getVar('id_modul');
            $id_grupakses = $this->request->getVar('id_grupakses');
            $listakses = $this->grupakses->editaksesmenu($id_grup);

            foreach ($listakses as $key => $value) {
                $this->grupakses->delete($id_grupakses);
            }

            $jdata = count($id_modul);
            for ($i = 0; $i < $jdata; $i++) {

                $updatedatadet = [
                    'id_grup' => $id_grup,
                    'id_modul' => $id_modul[$i],
                    'aksesmenu' => $aksesmenu[$i],
                ];

                $this->grupakses->insert($updatedatadet);
            }
            $msg = [
                'sukses' => 'Hak Akses Menu berhasil diubah',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
        }
        echo json_encode($msg);
    }

    public function hapusgrup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = $this->request->getVar('id_grup');

            //   cek dan hapus juga di grup akses
            $cekmodulakses = $this->grupakses->listaksesgrup($id_grup);
            // GRUPAKSES 
            if ($cekmodulakses) {
                foreach ($cekmodulakses as $data):
                    $this->grupakses->delete($data['id_grupakses']);
                endforeach;
            }

            $this->grupuser->delete($id_grup);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
}
