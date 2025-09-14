<?php

namespace App\Controllers;

class Menu extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin             = $this->template->tempadminaktif();

        $data = [
            'title'         => 'Setting',
            'subtitle'      => 'Menu',
            'folder'        => esc($tadmin['folder']),
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/index', $data);
    }

    public function getmenu()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        // Ambil data session dan request
        $id_grup = session()->get('id_grup');
        $url = 'menu';
        $posisi = $this->request->getVar('posisimn');
        $tadmin = $this->template->tempadminaktif();

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil akses, hapus, ubah, tambah
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Cek akses, jika tidak sesuai, beri pesan noakses
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil list menu berdasarkan posisi
        $list = $this->menu->listutama($posisi);

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Setting - Menu',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
            'posisimn' => $posisi,
        ];

        // Siapkan respons JSON dengan data dan CSRF token
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/menu/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }

    // add menu
    public function formmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title'             => 'Tambah Menu',
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),
            ];
            $tadmin             = $this->template->tempadminaktif();

            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            // Validasi input
            $valid = $this->validate([
                'nama_menu' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required|is_unique[menu.nama_menu]|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'is_unique'     => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 20 karakter!',
                    ]
                ],
                'menu_link' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'urutan' => [
                    'label' => 'Urutan Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);

            // Jika validasi gagal
            if (!$valid) {
                $msg = [
                    'error'                => $validation->getErrors(),
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                // Persiapkan data yang akan disimpan
                $simpandata = [
                    'nama_menu'     => $this->request->getVar('nama_menu'),
                    'menu_link'     => $this->request->getVar('menu_link'),
                    'parent'        => $this->request->getVar('parent'),
                    'icon'          => $this->request->getVar('icon'),
                    'urutan'        => $this->request->getVar('urutan'),
                    'target'        => $this->request->getVar('target'),
                    'linkexternal'  => $this->request->getVar('linkexternal')
                ];

                // Simpan data menu
                $this->menu->insert($simpandata);

                // Kirimkan response sukses
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }

            // Kembalikan respon dalam format JSON
            echo json_encode($msg);
        }
    }

    public function formeditmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $menu_id = $this->request->getVar('menu_id');
            $list =  $this->menu->find($menu_id);
            $tadmin      = $this->template->tempadminaktif();

            $data = [
                'title'             => 'Edit Menu',
                'menu_id'           => $list['menu_id'],
                'nama_menu'         => $list['nama_menu'],
                'menu_link'         => $list['menu_link'],
                'parent'            => $list['parent'],
                'icon'              => $list['icon'],
                'urutan'            => $list['urutan'],
                'target'            => $list['target'],
                'linkexternal'      => $list['linkexternal'],
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),

            ];
            $msg = [
                'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatemenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_menu' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'menu_link' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urutan' => [
                    'label' => 'Uratan Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_menu' => $validation->getError('nama_menu'),
                        'menu_link' => $validation->getError('menu_link'),
                        'urutan'    => $validation->getError('urutan'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $updatedata = [

                    'nama_menu'     => $this->request->getVar('nama_menu'),
                    'menu_link'     => $this->request->getVar('menu_link'),
                    'parent'        => $this->request->getVar('parent'),
                    'icon'          => $this->request->getVar('icon'),
                    'urutan'        => $this->request->getVar('urutan'),
                    'target'        => $this->request->getVar('target'),
                    'linkexternal'  => $this->request->getVar('linkexternal')

                ];

                $menu_id = $this->request->getVar('menu_id');
                $this->menu->update($menu_id, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $menu_id = $this->request->getVar('menu_id');

            $this->menu->delete($menu_id);
            $msg = [
                'sukses'                => 'Menu Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    //publish dan unpublish menu
    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('menu_id');
            $cari   = $this->menu->find($id);

            $sts    = $cari['stsmenu'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->menu->update($id, ['stsmenu' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }

    // start secodary menu add
    public function formmenusec()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title'             => 'Tambah Menu Secondary',
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),

            ];
            $tadmin             = $this->template->tempadminaktif();
            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/tambahsec', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formeditmenusec()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $menu_id = $this->request->getVar('menu_id');
            $list =  $this->menu->find($menu_id);
            $tadmin             = $this->template->tempadminaktif();
            $data = [
                'title'             => 'Edit Secondary Menu',
                'menu_id'           => $list['menu_id'],
                'nama_menu'         => $list['nama_menu'],
                'menu_link'         => $list['menu_link'],
                'parent'            => $list['parent'],
                'icon'              => $list['icon'],
                'urutan'            => $list['urutan'],
                'target'            => $list['target'],
                'linkexternal'      => $list['linkexternal'],
                'posisi'            => $list['posisi'],
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/editsec', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpanmenusec()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_menu' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required|is_unique[menu.nama_menu]|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'is_unique'     => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'menu_link' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'urutan' => [
                    'label' => 'Uratan Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_menu' => $validation->getError('nama_menu'),
                        'menu_link' => $validation->getError('menu_link'),
                        'urutan'    => $validation->getError('urutan'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_menu'     => $this->request->getVar('nama_menu'),
                    'menu_link'     => $this->request->getVar('menu_link'),
                    'parent'        => 'N',
                    'icon'          => $this->request->getVar('icon'),
                    'urutan'        => $this->request->getVar('urutan'),
                    'target'        => $this->request->getVar('target'),
                    'posisi'        => $this->request->getVar('posisi'),
                    'linkexternal'  => $this->request->getVar('linkexternal'),


                ];

                $this->menu->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updatemenusec()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_menu' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'menu_link' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urutan' => [
                    'label' => 'Uratan Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_menu' => $validation->getError('nama_menu'),
                        'menu_link' => $validation->getError('menu_link'),
                        'urutan'    => $validation->getError('urutan'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $updatedata = [

                    'nama_menu'     => $this->request->getVar('nama_menu'),
                    'menu_link'     => $this->request->getVar('menu_link'),
                    'parent'        => $this->request->getVar('parent'),
                    'icon'          => $this->request->getVar('icon'),
                    'urutan'        => $this->request->getVar('urutan'),
                    'target'        => $this->request->getVar('target'),
                    'linkexternal'  => $this->request->getVar('linkexternal'),
                    'posisi'        => $this->request->getVar('posisi'),


                ];

                $menu_id = $this->request->getVar('menu_id');
                $this->menu->update($menu_id, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // end second
    //Start SUB MENU (backend)
    public function submenu($menu_id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($menu_id == '') {
            return redirect()->to(base_url('menu'));
        }
        $list      =  $this->submenu->listbyutm($menu_id);
        if ($list) {
            foreach ($list as $data) :
                $menuinduk = $data['nama_menu'];
            endforeach;
        } else {
            $menuinduk = '';
        }
        $tadmin             = $this->template->tempadminaktif();
        $data = [
            'title'          => 'Pengaturan',
            'subtitle'       => 'Menu',
            'menu_id'        => $menu_id,
            'menuinduk'      => $menuinduk,
            'folder'      => esc($tadmin['folder']),
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/submenu/index', $data);
    }

    // get data
    public function getsubmenu()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        // Ambil data session dan request
        $menu_id = $this->request->getVar('menu_id');
        $id_grup = session()->get('id_grup');
        $url = 'menu';
        $tadmin = $this->template->tempadminaktif();

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil akses, hapus, ubah, tambah
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Cek akses, jika tidak sesuai, beri pesan noakses
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil submenu berdasarkan menu_id
        $list = $this->submenu->listbyutm($menu_id);

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Setting - Sub Menu',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Siapkan respons JSON dengan data dan CSRF token
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/menu/submenu/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }

    // ADD sub menu
    public function formsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title'             => 'Tambah Sub Menu',
                'menu_id'           => $this->request->getVar('menu_id'),
                'modulpublic'       => $this->modulpublic->listaktif(),
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                // 'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            $tadmin    = $this->template->tempadminaktif();
            $msg = [
                // 'csrf_tokencmsikasmedia'  => csrf_hash(),
                'data'                  => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/submenu/tambah', $data),

            ];
            echo json_encode($msg);
        }
    }

    public function simpansubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_submenu' => [
                    'label' => 'Nama Sub Menu',
                    'rules' => 'required|is_unique[submenu.nama_submenu]|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'is_unique'     => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'menu_id' => [
                    'label' => 'Menu Induk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'link_submenu' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'urutansm' => [
                    'label' => 'Uratan Sub Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_submenu' => $validation->getError('nama_submenu'),
                        'menu_id' => $validation->getError('menu_id'),
                        'link_submenu' => $validation->getError('link_submenu'),
                        'urutansm' => $validation->getError('urutansm'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_submenu' => $this->request->getVar('nama_submenu'),
                    'menu_id' => $this->request->getVar('menu_id'),
                    'link_submenu' => $this->request->getVar('link_submenu'),
                    'iconsm' => $this->request->getVar('iconsm'),
                    'urutansm' => $this->request->getVar('urutansm'),
                    'targetsm' => $this->request->getVar('targetsm'),
                    'linkexternalsm' => $this->request->getVar('linkexternalsm'),
                    'parentsm' => $this->request->getVar('parentsm')

                ];

                $this->submenu->insert($simpandata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $submenu_id = $this->request->getVar('submenu_id');
            $list =  $this->submenu->find($submenu_id);
            $tadmin             = $this->template->tempadminaktif();

            $data = [
                'title'          => 'Edit Sub Menu',
                'submenu_id'     => $list['submenu_id'],
                'menu_id'        => $list['menu_id'],
                'nama_submenu'   => $list['nama_submenu'],
                'link_submenu'   => $list['link_submenu'],
                'iconsm'          => $list['iconsm'],
                'urutansm'        => $list['urutansm'],
                'targetsm'        => $list['targetsm'],
                'linkexternalsm'  => $list['linkexternalsm'],
                'parentsm'        => $list['parentsm'],
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),
                // 'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/submenu/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatesubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_submenu' => [
                    'label' => 'Nama Sub Menu',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'link_submenu' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urutansm' => [
                    'label' => 'Uratan Sub Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_submenu' => $validation->getError('nama_submenu'),
                        'link_submenu' => $validation->getError('link_submenu'),
                        'urutansm' => $validation->getError('urutansm'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $updatedata = [

                    'nama_submenu' => $this->request->getVar('nama_submenu'),
                    'link_submenu' => $this->request->getVar('link_submenu'),
                    // 'menu_id' => $this->request->getVar('menu_id'),
                    'iconsm' => $this->request->getVar('iconsm'),
                    'urutansm' => $this->request->getVar('urutansm'),
                    'linkexternalsm' => $this->request->getVar('linkexternalsm'),
                    'targetsm' => $this->request->getVar('targetsm'),
                    'parentsm' => $this->request->getVar('parentsm')

                ];

                $submenu_id = $this->request->getVar('submenu_id');
                $this->submenu->update($submenu_id, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapussubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $submenu_id = $this->request->getVar('submenu_id');

            $this->submenu->delete($submenu_id);
            $msg = [
                'sukses'                => 'Menu Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    //publish dan unpublish sub menu
    public function togglesub()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('submenu_id');
            $cari   = $this->submenu->find($id);

            $sts    = $cari['stssubmenu'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->submenu->update($id, ['stssubmenu' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }


    // START SUB-SUB MENU

    public function subsubmenu($submenu_id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($submenu_id == '') {
            return redirect()->to(base_url('menu'));
        }
        $list      =  $this->subsubmenu->listbysub($submenu_id);
        $tadmin             = $this->template->tempadminaktif();

        if ($list) {
            foreach ($list as $data) :
                $submenu = $data['nama_submenu'];
            endforeach;
        } else {
            $submenu = '';
        }

        $data = [
            'title'          => 'Pengaturan',
            'subtitle'       => 'Menu Level 3',
            'submenu_id'        => $submenu_id,
            'submenu'        => $submenu,
            'folder'      => esc($tadmin['folder']),
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/subsubmenu/index', $data);
    }

    // get data
    public function getsubsubmenu()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        // Ambil data session dan request
        $submenu_id = $this->request->getVar('submenu_id');
        $id_grup = session()->get('id_grup');
        $url = 'menu';
        $tadmin = $this->template->tempadminaktif();

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil akses, hapus, ubah, tambah
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Cek akses, jika tidak sesuai, beri pesan noakses
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil subsubmenu berdasarkan submenu_id
        $list = $this->subsubmenu->listbysub($submenu_id);

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Setting - Menu Level 3',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Siapkan respons JSON dengan data dan CSRF token
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/menu/subsubmenu/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }

    // ADD subsub menu
    public function formsubsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title'             => 'Tambah Menu',
                'submenu_id'        => $this->request->getVar('submenu_id'),
                'modulpublic'       => $this->modulpublic->listaktif(),
                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
            ];
            $tadmin             = $this->template->tempadminaktif();

            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/subsubmenu/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpansubsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_subsubmenu' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required|is_unique[subsubmenu.nama_subsubmenu]|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'is_unique'     => '{field} tidak boleh sama',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],

                'link_subsubmenu' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'urutanssm' => [
                    'label' => 'Uratan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_subsubmenu' => $validation->getError('nama_subsubmenu'),
                        'link_subsubmenu' => $validation->getError('link_subsubmenu'),
                        'urutanssm'       => $validation->getError('urutanssm'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_subsubmenu'      => $this->request->getVar('nama_subsubmenu'),
                    'submenu_id'        => $this->request->getVar('submenu_id'),
                    'link_subsubmenu'   => $this->request->getVar('link_subsubmenu'),
                    'iconssm'           => $this->request->getVar('iconssm'),
                    'urutanssm'         => $this->request->getVar('urutanssm'),
                    'targetssm'         => $this->request->getVar('targetssm'),
                    'linkexternalssm'   => $this->request->getVar('linkexternalssm'),
                    'stsssm'            => '1'

                ];

                $this->subsubmenu->insert($simpandata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditsubsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $subsubmenu_id = $this->request->getVar('subsubmenu_id');
            $list =  $this->subsubmenu->find($subsubmenu_id);
            $data = [
                'title'          => 'Edit Menu',
                'subsubmenu_id'     => $list['subsubmenu_id'],
                'submenu_id'        => $list['submenu_id'],
                'nama_subsubmenu'   => $list['nama_subsubmenu'],
                'link_subsubmenu'   => $list['link_subsubmenu'],
                'iconssm'          => $list['iconssm'],
                'urutanssm'        => $list['urutanssm'],
                'targetssm'        => $list['targetssm'],
                'linkexternalssm'  => $list['linkexternalssm'],

                'kategoriberita'    => $this->kategori->list(),
                'halaman'           => $this->berita->listhalaman(),
                'modulpublic'       => $this->modulpublic->listaktif(),

            ];
            $tadmin             = $this->template->tempadminaktif();

            $msg = [
                'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/menu/subsubmenu/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatesubsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_subsubmenu' => [
                    'label' => 'Nama Sub Menu',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required'      => '{field} tidak boleh kosong',
                        'max_length'    => 'Masukkan {field} maksimal 20 Karakter!',
                    ]
                ],
                'link_subsubmenu' => [
                    'label' => 'Menu Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urutanssm' => [
                    'label' => 'Uratan Sub Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_subsubmenu' => $validation->getError('nama_subsubmenu'),
                        'link_subsubmenu' => $validation->getError('link_subsubmenu'),
                        'urutanssm' => $validation->getError('urutanssm'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $updatedata = [

                    'nama_subsubmenu' => $this->request->getVar('nama_subsubmenu'),
                    'link_subsubmenu' => $this->request->getVar('link_subsubmenu'),
                    // 'menu_id' => $this->request->getVar('menu_id'),
                    'iconssm' => $this->request->getVar('iconssm'),
                    'urutanssm' => $this->request->getVar('urutanssm'),
                    'linkexternalssm' => $this->request->getVar('linkexternalssm'),
                    'targetssm' => $this->request->getVar('targetssm'),
                    'parentssm' => $this->request->getVar('parentssm')

                ];

                $subsubmenu_id = $this->request->getVar('subsubmenu_id');
                $this->subsubmenu->update($subsubmenu_id, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapussubsubmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $subsubmenu_id = $this->request->getVar('subsubmenu_id');

            $this->subsubmenu->delete($subsubmenu_id);
            $msg = [
                'sukses' => 'Menu Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    //publish dan unpublish sub menu
    public function togglesubsub()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('subsubmenu_id');
            $cari   = $this->subsubmenu->find($id);

            $sts    = $cari['stsssm'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->subsubmenu->update($id, ['stsssm' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }
}
