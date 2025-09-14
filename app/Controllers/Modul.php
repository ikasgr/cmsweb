<?php

namespace App\Controllers;

class Modul extends BaseController
{

    //list frontend
    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin = $this->template->tempadminaktif();
        $konfigurasi = $this->konfigurasi->vkonfig();

        $data = [
            'title'       => 'Setting Modul ',
            'subtitle'    => $konfigurasi->nama,
            'folder'       => esc($tadmin['folder'])
        ];

        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/grupmenu/index', $data);
    }

    public function det($gm = null)
    {

        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($gm == '') {
            return redirect()->to(base_url('modul'));
        }
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'            => 'Pengaturan',
            'subtitle'         => 'Modul',
            'gm'               => $gm,
            'folder'           => esc($tadmin['folder'])

        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/index', $data);
    }

    # get sub modul
    public function getdata()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil data dari session dan request
        $id_grup = session()->get('id_grup');
        $url = 'modul';
        $gm = $this->request->getVar('gm');

        // Ambil grup akses dan modul
        $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
        $list = $this->modulecms->listbygrupall($gm);
        $modulmenu = $this->modulecms->listmenuutama();

        // Tentukan pilihan modul
        $pilmodul = $modulmenu ?: '-';

        // Pastikan grup akses ditemukan dan cek akses
        if (!$listgrupf || !in_array($listgrupf[0]['akses'], ['1'])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil akses dari grup
        $akses = $listgrupf[0]['akses'];

        // Siapkan data untuk tampilan
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title' => 'Modul CMS',
            'list' => $list,
            'akses' => $akses,
            'modulmenu' => $pilmodul,
        ];

        // Siapkan respons JSON dengan data dan CSRF token
        $msg = [
            'csrf_tokencmsikasmedia' => csrf_hash(),
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/modul/list', $data),
        ];

        echo json_encode($msg);
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'         => 'Tambah Modul',
                'gm'            => $this->request->getVar('gm'),
                // 'modulmenu'     => $this->modulecms->listmenuutama()
            ];
            $msg = [
                'data'          => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/tambah', $data),

            ];
            echo json_encode($msg);
        }
    }

    public function simpanmodul()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'modul' => [
                    'label' => 'Nama Modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        // 'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'urlmenu' => [
                    'label' => 'Link URL',
                    'rules' => 'required|is_unique[cms__modul.urlmenu]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'

                    ]
                ],
                'urut' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modul'          => $validation->getError('modul'),
                        'urlmenu'        => $validation->getError('urlmenu'),
                        'urut'         => $validation->getError('urut'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'modul'          => $this->request->getVar('modul'),
                    'urlmenu'        => $this->request->getVar('urlmenu'),
                    'gm'             => $this->request->getVar('gm'),
                    'urut'           => $this->request->getVar('urut'),
                    'ikonmn'         => $this->request->getVar('ikonmn'),
                    'tipemn'         => 'sm',
                    'level'          => '3',

                ];
                $this->modulecms->insert($insertdata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            }
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id_modul');
            $cekmodulakses =  $this->grupakses->listaksesmodul($id);
            // GRUPAKSES 
            if ($cekmodulakses) {
                foreach ($cekmodulakses as $data) :
                    $this->grupakses->delete($data['id_grupakses']);
                endforeach;
                # code...
            }
            $this->modulecms->delete($id);
            $msg = [
                'sukses'                => 'Data Berhasil Dihapus',
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

            $id_modul = $this->request->getVar('id_modul');
            $list =  $this->modulecms->find($id_modul);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'      => 'Edit Modul',
                'id_modul'   => $list['id_modul'],
                'modul'      => esc($list['modul']),
                'gm'         => $list['gm'],
                'urlmenu'    => esc($list['urlmenu']),
                'urut'       => $list['urut'],
                'ikonmn'     => $list['ikonmn'],
                'modulmenu'  => $this->modulecms->listmenuutama()

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatemodul()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_modul = $this->request->getVar('id_modul');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'modul' => [
                    'label' => 'Nama Modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'urlmenu' => [
                    'label' => 'Link URL',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urut' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modul'        => $validation->getError('modul'),
                        'urlmenu'      => $validation->getError('urlmenu'),
                        'urut'         => $validation->getError('urut'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'modul'          => $this->request->getVar('modul'),
                    'urlmenu'        => $this->request->getVar('urlmenu'),
                    'gm'             => $this->request->getVar('gm'),
                    'urut'           => $this->request->getVar('urut'),
                    'ikonmn'         => $this->request->getVar('ikonmn'),


                ];
                $this->modulecms->update($id_modul, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // Set akses modul ke Role

    public function formsetakses()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_modul   = $this->request->getVar('id_modul');
            $urlget     = $this->request->getVar('urlmenu');
            $list       = $this->modulecms->find($id_modul);
            $jrole      = $this->grupuser->selectCount('id_grup')->first();
            $tadmin     = $this->template->tempadminaktif();
            $id_grup    = session()->get('id_grup');
            $listgrupf  = $this->grupakses->viewgrupakses($id_grup, $urlget);
            // $carigrupakses =  $this->grupakses->find($id_modul); 
            $totalmodul     = $this->grupakses->totmodul($id_modul);
            if ($listgrupf) {
                $tambah = $listgrupf->tambah;
                $ubah   = $listgrupf->ubah;
                $hapus  = $listgrupf->hapus;
                $akses  = $listgrupf->akses;
            } else {
                $tambah = '1';
                $ubah   = '1';
                $hapus  = '1';
                $akses  = '1';
            }
            if ($totalmodul == $jrole['id_grup']) {
                $statusnya = 'OK';
            } else {
                $statusnya = 'No Akses';
            }
            $data = [
                'title'         => 'Set Akses Modul',
                'id_modul'      => $list['id_modul'],
                'modul'         => $list['modul'],
                'statusnya'     => $statusnya,
                'tambah'        => $tambah,
                'hapus'         => $hapus,
                'ubah'          => $ubah,
                'akses'         => $akses,

                'modulmenu'     => $this->modulecms->listmenuutama(),
                'listgrup'      => $this->grupuser->list(),

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/setakses', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // simpan ke grup akses module baru

    public function simpansetakses()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'id_grup' => [
                    'label' => 'Grup Akses',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_grup'           => $validation->getError('id_grup'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $id_modul = $this->request->getVar('id_modul');
                $id_grup  = $this->request->getVar('id_grup');
                $akses    = $this->request->getVar('akses');
                $tambah   = $this->request->getVar('tambah');
                $ubah     = $this->request->getVar('ubah');
                $hapus    = $this->request->getVar('hapus');

                $listganda =  $this->grupakses->listgrupaksesganda($id_grup, $id_modul);
                $dataakses = [
                    'id_grup'    => $id_grup,
                    'id_modul'   => $id_modul,
                    'akses'      => $akses,
                    'tambah'     => $tambah,
                    'ubah'       => $ubah,
                    'hapus'      => $hapus,
                ];

                if ($listganda) {
                    // dapatkan id_grupakses
                    foreach ($listganda as $datamod) :
                        $id_grupakses = $datamod['id_grupakses'];
                    endforeach;
                    $this->grupakses->update($id_grupakses, $dataakses);
                    // $msg = [
                    //     'aksesganda'            => 'Grup Akses sudah ditentukan.',
                    //     'csrf_tokencmsikasmedia'  => csrf_hash(),
                    // ];
                    $msg = [
                        'sukses'                => 'Role grup berhasil diubah!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {


                    $this->grupakses->insert($dataakses);

                    $msg = [
                        'sukses'                => 'Modul berhasil ditambahkan ke Role Grup!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('id_modul');
            $cari   = $this->modulecms->find($id);

            $sts    = $cari['aktif'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->modulecms->update($id, ['aktif' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }


    // GRUP MENU (UTAMA)------------------------------------------------------------

    public function grupmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'        => 'Pengaturan',
            'subtitle'     => 'Modul',
            'folder'        => esc($tadmin['folder'])
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/grupmenu/index', $data);
    }

    public function getgrupmenu()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil data dari session dan URL
        $id_grup = session()->get('id_grup');
        $url = 'modul';

        // Ambil grup akses dan menu modul
        $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
        $list = $this->modulecms->listmenuutamaall();

        // Jika tidak ada grup akses atau akses tidak sesuai, kirimkan respon tanpa akses
        if (!$listgrupf || !in_array($listgrupf[0]['akses'], ['1'])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil akses dari grup
        $akses = $listgrupf[0]['akses'];

        // Siapkan data untuk tampilan
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title' => 'Menu Grup',
            'list' => $list,
            'akses' => $akses,
        ];

        // Siapkan respons JSON dengan data
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/modul/grupmenu/list', $data)
        ];

        echo json_encode($msg);
    }

    public function formtambahmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'         => 'Tambah Modul',
                'modulmenu'     => $this->modulecms->listmenuutama()
            ];
            $msg = [
                'data'          => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/grupmenu/tambah', $data),

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

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'modul' => [
                    'label' => 'Nama Menu',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        // 'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

                'urut' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'gm' => [
                    'label' => 'Grup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modul'        => $validation->getError('modul'),
                        'urut'         => $validation->getError('urut'),
                        'gm'         => $validation->getError('gm'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'modul'      => $this->request->getVar('modul'),
                    'urlmenu'    => '-',
                    'gm'         => $this->request->getVar('gm'),
                    'urut'      => $this->request->getVar('urut'),
                    'ikonmn'    => $this->request->getVar('ikonmn'),
                    'tipemn'    => 'utm',
                    'level'     => '3',


                ];
                $this->modulecms->insert($insertdata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            }
        }
    }

    // Set akses modul ke Role

    public function formsetaksesmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_modul = $this->request->getVar('id_modul');
            $list =  $this->modulecms->find($id_modul);
            $tadmin = $this->template->tempadminaktif();
            // $carigrupakses =  $this->grupakses->find($id_modul);
            $jrole = $this->grupuser->selectCount('id_grup')->first();
            $totalmodul     = $this->grupakses->totmodul($id_modul);
            if ($totalmodul >= $jrole['id_grup']) {
                $statusnya = 'OK';
            } else {
                $statusnya = 'Belum';
            }
            $data = [
                'title'         => 'Set Akses Menu',
                'id_modul'     => $list['id_modul'],
                'modul'          => $list['modul'],
                'statusnya'       => $statusnya,
                'modulmenu'     => $this->modulecms->listmenuutama(),
                'listgrup'   => $this->grupuser->list(),

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/grupmenu/setakses', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // simpan set akses ke grup akses module baru (dalam)

    public function simpansetaksesmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_modul = $this->request->getVar('id_modul');
            $id_grup = $this->request->getVar('id_grup');
            $aksesmenu = $this->request->getVar('aksesmenu');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'id_grup' => [
                    'label' => 'Grup Akses',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        // 'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_grup'    => $validation->getError('id_grup'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                // listgrupaksesganda
                $listganda =  $this->grupakses->listgrupaksesganda($id_grup, $id_modul);
                if ($listganda) {
                    $msg = [
                        'aksesganda'            => 'Grup Akses sudah ditentukan.',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {

                    $insertakses = [
                        'id_grup'    => $id_grup,
                        'id_modul'   => $id_modul,
                        'aksesmenu'  => $aksesmenu,
                    ];

                    $this->grupakses->insert($insertakses);

                    $msg = [
                        'sukses'                => 'Menu berhasil ditambahkan ke Role Grup!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    // edit grup menu
    public function formeditmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_modul = $this->request->getVar('id_modul');
            $list =  $this->modulecms->find($id_modul);
            $tadmin = $this->template->tempadminaktif();

            $data = [
                'title'      => 'Edit Menu',
                'id_modul'   => $list['id_modul'],
                'modul'      => $list['modul'],
                'gm'         => $list['gm'],
                // 'urlmenu'    => $list['urlmenu'],
                'urut'       => $list['urut'],
                'ikonmn'     => $list['ikonmn'],
                'modulmenu'  => $this->modulecms->listmenuutama()

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/grupmenu/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatemodulmenu()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_modul = $this->request->getVar('id_modul');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'modul' => [
                    'label' => 'Nama Modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        // 'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'gm' => [
                    'label' => 'Grup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'urut' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modul'          => $validation->getError('modul'),
                        'gm'        => $validation->getError('gm'),
                        'urut'         => $validation->getError('urut'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'modul'      => $this->request->getVar('modul'),
                    'gm'         => $this->request->getVar('gm'),
                    'urut'      => $this->request->getVar('urut'),
                    'ikonmn'    => $this->request->getVar('ikonmn'),

                ];
                $this->modulecms->update($id_modul, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // MODUL UNTUK PUBLIK

    public function publik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'       => 'Modul',
            'subtitle'    => 'Publik',
            'folder'        => esc($tadmin['folder'])
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/publik/index', $data);
    }

    public function getpublik()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }
        // Ambil data dari session dan URL
        $id_grup = session()->get('id_grup');
        $url = 'modul';

        // Ambil grup akses
        $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

        // Jika grup akses tidak ada atau akses tidak sesuai, kirimkan respon tanpa akses
        if (!$listgrupf || !in_array($listgrupf[0]['akses'], ['1', '2'])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil akses dari grup
        $akses = $listgrupf[0]['akses'];

        // Ambil data modul publik
        $modulList = $this->modulpublic->list();

        // Siapkan data untuk tampilan
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title' => 'Modul Publik',
            'list' => $modulList,
            'akses' => $akses
        ];

        // Siapkan respons JSON dengan data
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/modul/publik/list', $data)
        ];

        echo json_encode($msg);
    }



    public function formpublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title' => 'Tambah Modul'
            ];
            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/publik/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanpublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'modpublic' => [
                    'label' => 'Modul',
                    'rules' => 'required|is_unique[cms__modpublic.modpublic]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],
                'link' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modpublic' => $validation->getError('modpublic'),
                        'link' => $validation->getError('link'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'modpublic' => $this->request->getVar('modpublic'),
                    'link'      => $this->request->getVar('link'),
                ];

                $this->modulpublic->insert($simpandata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditpublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_modpublic = $this->request->getVar('id_modpublic');
            $list =  $this->modulpublic->find($id_modpublic);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'          => 'Edit Modul',
                'id_modpublic'   => $list['id_modpublic'],
                'modpublic'      => $list['modpublic'],
                'link'           => $list['link'],
            ];
            $msg = [
                'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'pengaturan/modul/publik/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatepublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'modpublic' => [
                    'label' => 'Modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'link' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'modpublic' => $validation->getError('modpublic'),
                        'link'      => $validation->getError('link'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'modpublic' => $this->request->getVar('modpublic'),
                    'link'      => $this->request->getVar('link'),
                ];

                $id_modpublic = $this->request->getVar('id_modpublic');
                $this->modulpublic->update($id_modpublic, $updatedata);

                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuspublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_modpublic = $this->request->getVar('id_modpublic');
            $this->modulpublic->delete($id_modpublic);
            $msg = [
                'sukses'                => 'Modul Publik Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    //publish dan unpublish modul publik
    public function togglepublik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('id_modpublic');
            $cari   = $this->modulpublic->find($id);

            $sts    = $cari['stsmod'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->modulpublic->update($id, ['stsmod' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ]);
        }
    }

    // End MODul Publik
}
