<?php

namespace App\Controllers;

class Template extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $konfigurasi    = $this->konfigurasi->orderBy('id_setaplikasi')->first();
        $tadmin         = $this->template->tempadminaktif();
        $jtemaback      = $this->template->where('jtema =', 0)->get()->getNumRows();
        $jtemafront     = $this->template->where('jtema =', 1)->get()->getNumRows();
        $data = [
            'title'       => 'Setting Template ',
            'subtitle'    => esc($konfigurasi['nama']),
            'folder'      => esc($tadmin['folder']),
            'jtemaback'   => $jtemaback,
            'jtemafront'  => $jtemafront,

        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/index', $data);
    }

    public function front()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'       => 'Tema Website ',
            'subtitle'    => esc($konfigurasi['nama']),
            'folder'      => esc($tadmin['folder'])

        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/front/index', $data);
    }

    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('template_id');
            $cari   = $this->template->find($id);
            $folder = $this->request->getVar('folder');

            if ($cari['status'] == '1') {
                $sts = 0;
                $stsket = 'Berhasil nonaktifkan template!';
            } else {
                $sts = 1;
                $stsket = 'Berhasil menerapkan template!';
                $this->template->resetstatus();
                $logos = [
                    'plus1'     => 'p1.png',
                    'yayasan'   => 'p1.png',
                    'plus2'     => 'p3.png',
                    'plus3'     => 'p3.png',
                    'basic'     => 'bs.png',
                    'herobiz'   => 'bs.png',
                    'desaku'    => 'p2.png',
                    'company'   => 'p2.png',
                    'perijinan' => 'pnpt.png',
                    'plus4'     => 'p4.png',
                ];
                if (isset($logos[$folder])) {
                    $uptema = [
                        'logo' => $logos[$folder],
                    ];
                    $this->konfigurasi->update(1, $uptema);
                }
            }
            $updatedata = [
                'status'        => $sts,
            ];

            $this->template->update($id, $updatedata);
            $msg = [
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function getdata()
    {
        // Cek apakah session id ada
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Pastikan request adalah AJAX
        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, hentikan eksekusi
        }

        // Ambil data grup dan akses
        $id_grup = session()->get('id_grup');
        $url = 'template';
        $tadmin = $this->template->tempadminaktif();
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek jika grup akses tidak ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil hak akses dan operasi yang terkait
        $akses = $listgrupf->akses;
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil data template
        $data = [
            'title'     => 'Template Website',
            'list'      => $this->template->list(),
            'akses'     => $akses,
            'hapus'     => $listgrupf->hapus,
            'ubah'      => $listgrupf->ubah,
            'tambah'    => $listgrupf->tambah,
        ];

        // Siapkan dan kirimkan respons
        echo json_encode([
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/template/front/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }


    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title' => 'Tambah Template',
            ];
            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/front/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function duplikasitema()
    {
        // Cek apakah session id ada
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Cek apakah request AJAX
        if (!$this->request->isAJAX()) {
            return;
        }

        $template_id = $this->request->getVar('template_id');
        $datatema = $this->template->listduplikat($template_id);

        // Cek apakah data ditemukan
        if (!$datatema) {
            echo json_encode([
                'nodata' => 'Data tidak ditemukan',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
            return;
        }

        // Loop untuk duplikasi tema
        foreach ($datatema as $a) {
            // Generate random strings
            $folderrand = substr(rand(100000, 999999), 0, 4);
            $namarand = substr(rand(100000, 999999), 0, 4);
            $namadup = $a['nama'] . '_' . $namarand;
            $namafolder = $a['folder'] . '_' . $folderrand;

            // Data yang akan disalin
            $data = [
                'nama' => $namadup,
                'pembuat' => $a['pembuat'],
                'folder' => $namafolder,
                'ket' => $a['ket'],
                'status' => '0',
                'id' => session()->get('id'),
                'img' => 'default.png',
                'wllogo' => $a['wllogo'],
                'hplogo' => $a['hplogo'],
                'wlbanner' => $a['wlbanner'],
                'hpbanner' => $a['hpbanner'],
                'verbost' => $a['verbost'],
                'duatema' => $a['duatema'],
                'warna_topbar' => $a['warna_topbar'],
                'sidebar_mode' => $a['sidebar_mode'],
            ];

            // Insert data ke template
            $this->template->insert($data);
        }

        // Kirim respons sukses
        echo json_encode([
            'sukses' => 'Tema berhasil di duplikasi!',
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    public function simpantemplate()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Template',
                    'rules' => 'required|is_unique[template.nama]|max_length[20]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'max_length' => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'folder' => [
                    'label' => 'Nama Folder',
                    'rules' => 'required|is_unique[template.folder]|max_length[10]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'max_length' => 'Masukkan {field} maksimal 10 Karakter!',
                    ]
                ],
                'pembuat' => [
                    'label'         => 'Sumber',
                    'rules'         => 'required|max_length[15]',
                    'errors'        => [
                        'required' => '{field} tidak boleh kosong',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'wllogo'    => ['label' => 'Lebar Logo', 'rules' => 'required', 'errors' => ['required' => '{field} tidak boleh kosong']],
                'hplogo'    => ['label' => 'Tinggi Logo', 'rules' => 'required', 'errors' => ['required' => '{field} tidak boleh kosong']],
                'wlbanner'  => ['label' => 'Lebar Banner', 'rules' => 'required', 'errors' => ['required' => '{field} tidak boleh kosong']],
                'hpbanner'  => ['label' => 'Panjang Banner', 'rules' => 'required', 'errors' => ['required' => '{field} tidak boleh kosong']],
                'img'       => [
                    'label' => 'Cover',
                    'rules' => 'max_size[img,3024]|mime_in[img,image/png,image/jpg,image/jpeg,image/gif]|is_image[img]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} Maksimal 3024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!',
                    ]
                ]
            ]);

            if (!$valid) {
                echo json_encode([
                    'error'                => $validation->getErrors(),
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            $filegambar = $this->request->getFile('img');
            $nama_file = $filegambar->isValid() ? $filegambar->getRandomName() : 'default.png';

            $this->template->insert([
                'nama'          => $this->request->getVar('nama'),
                'pembuat'       => $this->request->getVar('pembuat'),
                'folder'        => $this->request->getVar('folder'),
                'ket'           => $this->request->getVar('ket'),
                'status'        => '0',
                'id'            => session()->get('id'),
                'img'           => $nama_file,
                'wllogo'        => $this->request->getVar('wllogo'),
                'hplogo'        => $this->request->getVar('hplogo'),
                'wlbanner'      => $this->request->getVar('wlbanner'),
                'hpbanner'      => $this->request->getVar('hpbanner'),
                'verbost'       => $this->request->getVar('verbost'),
                'duatema'       => $this->request->getVar('duatema'),
                'warna_topbar'  => '-'
            ]);

            if ($filegambar->isValid()) {
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/template/' . $nama_file, 70);
            }

            echo json_encode([
                'sukses' => 'Data berhasil disimpan!',
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

            $id = $this->request->getVar('template_id');

            $cekdata = $this->template->find($id);
            $fotolama = $cekdata['img'];

            if ($fotolama != 'default.png'  && file_exists('public/img/template/' . $fotolama)) {
                unlink('public/img/template/' . $fotolama);
            }

            $this->template->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
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

            $template_id = $this->request->getVar('template_id');
            $list =  $this->template->find($template_id);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'             => 'Edit Template',
                'template_id'       => $list['template_id'],
                'nama'              => $list['nama'],
                'pembuat'           => $list['pembuat'],
                'folder'            => $list['folder'],
                'ket'               => $list['ket'],
                'img'               => $list['img'],
                'wllogo'            => $list['wllogo'],
                'hplogo'            => $list['hplogo'],
                'wlbanner'          => $list['wlbanner'],
                'hpbanner'          => $list['hpbanner'],
                'verbost'           => $list['verbost'],
                'duatema'           => $list['duatema'],
                'video_bag'         => $list['video_bag'],

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/front/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatetemplate()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $template_id = $this->request->getVar('template_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama' => [
                    'label' => 'Nama Template',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'pembuat' => [
                    'label' => 'Sumber',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'folder' => [
                    'label' => 'Folder',
                    'rules' => 'required|max_length[10]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 10 Karakter!',
                    ]
                ],
                'wllogo' => [
                    'label' => 'Lebar Logo',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hplogo' => [
                    'label' => 'Tinggi Logo',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'wlbanner' => [
                    'label' => 'Lebar Banner',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'hpbanner' => [
                    'label' => 'Panjang Banner',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'img' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[img,3024]|mime_in[img,image/png,image/jpg,image/jpeg,image/gif]|is_image[img]',
                    'errors' => [
                        // 'uploaded' => 'Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 3024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'          => $validation->getError('nama'),
                        'pembuat'       => $validation->getError('pembuat'),
                        'folder'        => $validation->getError('folder'),
                        'wllogo'        => $validation->getError('wllogo'),
                        'hplogo'        => $validation->getError('hplogo'),
                        'wlbanner'      => $validation->getError('wlbanner'),
                        'hpbanner'      => $validation->getError('hpbanner'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $filegambar = $this->request->getFile('img');
                $nama_file = $filegambar->getRandomName();

                if ($filegambar->GetError() == 4) {
                    $updatedata = [
                        'nama'          => $this->request->getVar('nama'),
                        'pembuat'       => $this->request->getVar('pembuat'),
                        'folder'        => $this->request->getVar('folder'),
                        'ket'           => $this->request->getVar('ket'),
                        'wllogo'        => $this->request->getVar('wllogo'),
                        'hplogo'        => $this->request->getVar('hplogo'),
                        'wlbanner'      => $this->request->getVar('wlbanner'),
                        'hpbanner'      => $this->request->getVar('hpbanner'),
                        'verbost'       => $this->request->getVar('verbost'),
                        'duatema'       => $this->request->getVar('duatema'),
                        'video_bag'     => $this->request->getVar('video_bag'),
                    ];
                    $this->template->update($template_id, $updatedata);
                    $msg = [
                        'sukses'                => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {
                    //check
                    $cekdata = $this->template->find($template_id);
                    $fotolama = $cekdata['img'];
                    if ($fotolama != '' && file_exists('public/img/template/' . $fotolama)) {
                        unlink('public/img/template/' . $fotolama);
                    }

                    $updatedata = [
                        'nama'      => $this->request->getVar('nama'),
                        'pembuat'   => $this->request->getVar('pembuat'),
                        'folder'    => $this->request->getVar('folder'),
                        'ket'       => $this->request->getVar('ket'),
                        'img'       => $nama_file,
                        'wllogo'    => $this->request->getVar('wllogo'),
                        'hplogo'    => $this->request->getVar('hplogo'),
                        'wlbanner'  => $this->request->getVar('wlbanner'),
                        'hpbanner'  => $this->request->getVar('hpbanner'),
                        'verbost'   => $this->request->getVar('verbost'),
                        'duatema'   => $this->request->getVar('duatema'),
                        'video_bag'   => $this->request->getVar('video_bag'),
                    ];

                    $this->template->update($template_id, $updatedata);

                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->save('public/img/template/' . $nama_file, 65);

                    $msg = [
                        'sukses' => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
            }
            echo json_encode($msg);
        }
    }


    public function formuploadvideo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $template_id    = $this->request->getVar('template_id');
            $list =  $this->template->find($template_id);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'          => 'Upload Video',
                'video_bag'      => $list['video_bag'],
                'id'             => $list['template_id'],
            ];
            $msg = [
                'sukses'               => view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/template/front/gantifile', $data),
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];
            echo json_encode($msg);
        }
    }


    public function douploadvideo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $ukuran = 30000;
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'video_bag' => [
                    'label' => 'Upload Video',
                    'rules' => [
                        'uploaded[video_bag]',
                        'max_size[video_bag,' . $ukuran . ']',
                    ],
                    'errors' => [
                        'uploaded' => 'Silahkan Masukkan file',
                        'max_size' => 'Ukuran {field} Maksimal ' . $ukuran . ' KB..!!',
                        // 'mime_in' => 'Format {field} tidak valid..!! '
                    ],
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'video_bag' => $validation->getError('video_bag'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                // $fileunduhan = $this->request->getFile('video_bag');
                // $ext = $fileunduhan->getClientExtension();
                $filevideo  = $this->request->getFile('video_bag');
                $mimeType   = $filevideo->getMimeType();

                // Allowed video MIME types
                $allowedMimeTypes = ['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime', 'video/x-matroska'];

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    $msg = [
                        'nofile'                => 'Hanya file video yang diizinkan!',
                        'csrf_tokencmsikasmedia' => csrf_hash()
                    ];
                } else {
                    // Proceed with video file processing
                    $template_id    = $this->request->getVar('template_id');
                    $cekdata        = $this->template->find($template_id);
                    $vidlama        = $cekdata['video_bag'];

                    if ($vidlama != '' && file_exists('public/file/' . $vidlama)) {
                        unlink('public/file/' . $vidlama);
                    }

                    $nama_file = $filevideo->getRandomName();
                    if ($filevideo->isValid() && !$filevideo->hasMoved()) {
                        $filevideo->move(ROOTPATH . 'public/file/', $nama_file); //folder file

                        $updatedata = [
                            'video_bag' => $nama_file,
                        ];
                        $this->template->update($template_id, $updatedata);
                    }

                    $msg = [
                        'sukses' => 'Video berhasil diupload!',
                        'csrf_tokencmsikasmedia' => csrf_hash()
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function back()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
        $tadmin = $this->template->tempadminaktif();
        if ($tadmin) {
            $folder = esc($tadmin['folder']);
        } else {
            $folder = 'standar';
        }
        $data = [
            'title'       => 'Tema Dashboard Admin',
            'subtitle'    => esc($konfigurasi['nama']),
            'folder'      => $folder
        ];
        return view('backend/' . $folder . '/' . 'pengaturan/template/back/index', $data);
    }

    public function getdataback()
    {
        // Cek apakah session ID ada
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Cek apakah request AJAX
        if (!$this->request->isAJAX()) {
            return;
        }

        $id_grup = session()->get('id_grup');
        $url = 'template';
        $tadmin = $this->template->tempadminaktif();
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek apakah grup akses ditemukan dan valid
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        $akses = $listgrupf->akses;
        // Cek apakah akses valid (1 atau 2)
        if (!in_array($akses, ['1', '2'])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Jika akses valid, ambil data template
        $data = [
            'title' => 'Template Website',
            'list' => $this->template->listtadmin(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        echo json_encode([
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/template/back/list', $data),
        ]);
    }

    public function formtambahback()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title' => 'Tambah Template Admin',
            ];
            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/back/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpantemplateback()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Template',
                    'rules' => 'required|is_unique[template.nama]|max_length[20]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'folder' => [
                    'label' => 'Nama Folder',
                    'rules' => 'required|is_unique[template.folder]|max_length[10]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 10 Karakter!',
                    ]
                ],
                'pembuat' => [
                    'label' => 'Sumber',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'img' => [
                    'label' => 'Cover',
                    'rules' => 'max_size[img,3024]|mime_in[img,image/png,image/jpg,image/jpeg,image/gif]|is_image[img]',
                    'errors' => [
                        // 'uploaded' => 'Silahkan Masukkan Cover',
                        'max_size' => 'Ukuran {field} Maksimal 3024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'    => $validation->getError('nama'),
                        'pembuat'        => $validation->getError('pembuat'),
                        'folder'         => $validation->getError('folder'),
                        'img'         => $validation->getError('img'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {
                $filegambar = $this->request->getFile('img');
                $nama_file = $filegambar->getRandomName();
                if ($filegambar->GetError() == 4) {
                    $insertdata = [
                        'nama'          => $this->request->getVar('nama'),
                        'pembuat'       => $this->request->getVar('pembuat'),
                        'folder'        => $this->request->getVar('folder'),
                        'ket'           => $this->request->getVar('ket'),
                        'status'        => '0',
                        'jtema'         => '0',
                        'id'            => session()->get('id'),
                        'img'           => 'default.png',
                        'sidebar_mode'  => $this->request->getVar('sidebar_mode'),
                        'warna_topbar'  => $this->request->getVar('warna_topbar'),

                    ];
                    $this->template->insert($insertdata);

                    $msg = [
                        'sukses'                => 'Data berhasil disimpan!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {
                    $insertdata = [
                        'nama'          => $this->request->getVar('nama'),
                        'pembuat'       => $this->request->getVar('pembuat'),
                        'folder'        => $this->request->getVar('folder'),
                        'ket'           => $this->request->getVar('ket'),
                        'status'        => '0',
                        'jtema'         => '0',
                        'id'            => session()->get('id'),
                        'img'           => $nama_file,
                        'sidebar_mode'  => $this->request->getVar('sidebar_mode'),
                        'warna_topbar'  => $this->request->getVar('warna_topbar'),

                    ];
                    $this->template->insert($insertdata);

                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->save('public/img/template/' . $nama_file, 70);
                    $msg = [
                        'sukses'                => 'Data berhasil disimpan!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
                echo json_encode($msg);
            }
        }
    }

    public function formeditback()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $template_id = $this->request->getVar('template_id');
            $list =  $this->template->find($template_id);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'             => 'Edit Template Admin',
                'template_id'       => $list['template_id'],
                'nama'               => $list['nama'],
                'pembuat'           => $list['pembuat'],
                'folder'             => $list['folder'],
                'ket'               => $list['ket'],
                'img'               => $list['img'],
                'sidebar_mode'     => $list['sidebar_mode'],
                'warna_topbar'     => $list['warna_topbar'],

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/template/back/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatetemplateback()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $template_id = $this->request->getVar('template_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama' => [
                    'label' => 'Nama Template',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'pembuat' => [
                    'label' => 'Sumber',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 15 Karakter!',
                    ]
                ],
                'folder' => [
                    'label' => 'Folder',
                    'rules' => 'required|max_length[10]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 10 Karakter!',
                    ]
                ],
                'img' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[img,2024]|mime_in[img,image/png,image/jpg,image/jpeg,image/gif]|is_image[img]',
                    'errors' => [
                        // 'uploaded' => 'Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 2024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'           => $validation->getError('nama'),
                        'pembuat'        => $validation->getError('pembuat'),
                        'folder'         => $validation->getError('folder'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $filegambar = $this->request->getFile('img');
                $nama_file = $filegambar->getRandomName();

                if ($filegambar->GetError() == 4) {
                    $updatedata = [
                        'nama'          => $this->request->getVar('nama'),
                        'pembuat'       => $this->request->getVar('pembuat'),
                        'folder'        => $this->request->getVar('folder'),
                        'ket'           => $this->request->getVar('ket'),
                        'sidebar_mode'  => $this->request->getVar('sidebar_mode'),
                        'warna_topbar'  => $this->request->getVar('warna_topbar'),

                    ];
                    $this->template->update($template_id, $updatedata);
                    $msg = [
                        'sukses' => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {
                    //check
                    $cekdata = $this->template->find($template_id);
                    $fotolama = $cekdata['img'];
                    if ($fotolama != '' && file_exists('public/img/template/' . $fotolama)) {
                        unlink('public/img/template/' . $fotolama);
                    }

                    $updatedata = [
                        'nama'          => $this->request->getVar('nama'),
                        'pembuat'       => $this->request->getVar('pembuat'),
                        'folder'        => $this->request->getVar('folder'),
                        'ket'           => $this->request->getVar('ket'),
                        'img'           => $nama_file,
                        'sidebar_mode'  => $this->request->getVar('sidebar_mode'),
                        'warna_topbar'  => $this->request->getVar('warna_topbar'),
                    ];

                    $this->template->update($template_id, $updatedata);

                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->save('public/img/template/' . $nama_file, 65);

                    $msg = [
                        'sukses'                => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function toggleback()
    {
        // Cek apakah session ID ada
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Cek apakah request AJAX
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('template_id');
            $cari = $this->template->find($id);

            // Tentukan status baru dan pesan berdasarkan status saat ini
            $sts = ($cari['status'] == '1') ? 0 : 1;
            $stsket = ($sts == 1) ? 'Berhasil menerapkan template!' : 'Berhasil nonaktifkan template!';

            // Reset status jika template diaktifkan
            if ($sts == 1) {
                $this->template->resetstatusback();
            }

            // Update status template
            $this->template->update($id, ['status' => $sts]);

            // Kirim respons JSON
            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }
}
