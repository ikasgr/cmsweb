<?php

namespace App\Controllers;

class Agenda extends BaseController
{

    public function index()
    {

        $konfigurasi = $this->konfigurasi->vkonfig();
        $agenda = $this->agenda->listagendapage();

        $data = [
            'title' => 'Agenda | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'agenda' => $agenda->paginate(8, 'hal'),
            'agenda6' => $agenda->paginate(6, 'hal'),
            'pager' => $agenda->pager,
            'jum' => $this->agenda->totagenda(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'beritapopuler6' => $this->berita->populer()->paginate(6),
            'beritaterkini' => $this->berita->terkini(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'infografis10' => $this->banner->listinfopage()->paginate(10),
            'kategori' => $this->kategori->list(),
            'grafisrandom' => $this->banner->grafisrandom(),
            'terkini3' => $this->berita->terkini3(),
            'folder' => $template['folder'],

        ];
        if ($template['duatema'] == 1) {
            $agent = $this->request->getUserAgent();
            if ($agent->isMobile()) {
                return view('frontend/' . $template['folder'] . '/mobile/' . 'content/semua_agenda', $data);
            } else {
                return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_agenda', $data);
            }
        } else {
            return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_agenda', $data);
        }
    }

    //list semua agenda
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Informasi',
            'subtitle' => 'Agenda',

        ];
        return view('backend/informasi/agenda/index', $data);
    }

    public function getdata($id = null)
    {
        // Cek apakah session dan request AJAX valid
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'agenda/all';

        // Ambil grup akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan, kirimkan pesan akses belum ada
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses
        $akses = $listgrupf->akses;

        // Cek akses yang valid
        if ($akses != 1 && $akses != 2) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Tentukan list agenda berdasarkan akses
        $list = ($akses == 1) ? $this->agenda->listagenda() : $this->agenda->listagendaauthor(session()->get('id'));

        // Ambil template admin aktif


        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Agenda',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/informasi/agenda/list', $data)
        ];

        echo json_encode($msg);
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Agenda',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            $msg = [
                'data' => view('backend/informasi/agenda/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpanAgenda()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tema' => [
                    'label' => 'Tema Agenda',
                    'rules' => 'required|is_unique[agenda.tema]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

                'isi_agenda' => [
                    'label' => 'Isi agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'gambar' => [
                    'label' => 'gambar agenda',
                    'rules' => 'max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [
                        // 'uploaded' => 'Silahkan Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ],
                'tempat' => [
                    'label' => 'Tempat agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'pengirim' => [
                    'label' => 'Penyelenggara / Pengirim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_mulai' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_selesai' => [
                    'label' => 'Tanggal selesai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jam' => [
                    'label' => 'Jam agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tema' => $validation->getError('tema'),
                        'isi_agenda' => $validation->getError('isi_agenda'),
                        'gambar' => $validation->getError('gambar'),
                        'tempat' => $validation->getError('tempat'),
                        'pengirim' => $validation->getError('pengirim'),
                        'tgl_mulai' => $validation->getError('tgl_mulai'),
                        'tgl_selesai' => $validation->getError('tgl_selesai'),
                        'pengirim' => $validation->getError('pengirim'),
                        'jam' => $validation->getError('jam')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $userid = session()->get('id');
                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();
                $tgl_mulai_input = $this->request->getVar('tgl_mulai');
                $tgl_selesai_input = $this->request->getVar('tgl_selesai');

                $tgl_mulai = \DateTime::createFromFormat('d M, Y', $tgl_mulai_input); // Konversi ke objek DateTime
                $tgl_selesai = \DateTime::createFromFormat('d M, Y', $tgl_selesai_input); // Konversi ke objek DateTime
                //jika gambar tidak ada
                if ($filegambar->GetError() == 4) {

                    $insertdata = [

                        'tema' => $this->request->getVar('tema'),
                        'slug_tema' => mb_url_title($this->request->getVar('tema'), '-', TRUE),
                        'isi_agenda' => $this->request->getVar('isi_agenda'),
                        'tempat' => $this->request->getVar('tempat'),
                        'pengirim' => $this->request->getVar('pengirim'),
                        'tgl_mulai' => $tgl_mulai ? $tgl_mulai->format('Y-m-d') : null, // Format untuk tipe DATE
                        'tgl_selesai' => $tgl_selesai ? $tgl_selesai->format('Y-m-d') : null, // Format untuk tipe DATE
                        'tgl_posting' => date('Y-m-d'),
                        'jam' => $this->request->getVar('jam'),
                        'gambar' => 'default.png',
                        'id' => $userid,
                        'hits' => '0'

                    ];

                    $this->agenda->insert($insertdata);

                    $msg = [
                        'sukses' => 'Agenda berhasil disimpan!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {

                    $insertdata = [

                        'tema' => $this->request->getVar('tema'),
                        'slug_tema' => mb_url_title($this->request->getVar('tema'), '-', TRUE),
                        'isi_agenda' => $this->request->getVar('isi_agenda'),
                        'tempat' => $this->request->getVar('tempat'),
                        'pengirim' => $this->request->getVar('pengirim'),
                        'tgl_mulai' => $tgl_mulai ? $tgl_mulai->format('Y-m-d') : null, // Format untuk tipe DATE
                        'tgl_selesai' => $tgl_selesai ? $tgl_selesai->format('Y-m-d') : null, // Format untuk tipe DATE
                        'tgl_posting' => date('Y-m-d'),
                        'jam' => $this->request->getVar('jam'),
                        'gambar' => $nama_file,
                        'id' => $userid,
                        'hits' => '0'

                    ];

                    $this->agenda->insert($insertdata);
                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->save('public/img/informasi/agenda/' . $nama_file, 70);
                    $msg = [
                        'sukses' => 'Agenda berhasil disimpan!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                }
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

            $id = $this->request->getVar('agenda_id');
            //check
            $cekdata = $this->agenda->find($id);
            $fotolama = $cekdata['gambar'];
            if ($fotolama != 'default.png' && file_exists('public/img/informasi/agenda/' . $fotolama)) {
                unlink('public/img/informasi/agenda/' . $fotolama);
            }
            $this->agenda->delete($id);
            $msg = [
                'sukses' => 'Data Agenda Berhasil Dihapus',
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
            $id = $this->request->getVar('agenda_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->agenda->find($id[$i]);
                $fotolama = $cekdata['gambar'];
                if ($fotolama != 'default.png' && file_exists('public/img/informasi/agenda/' . $fotolama)) {
                    unlink('public/img/informasi/agenda/' . $fotolama);
                }
                $this->agenda->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data agenda berhasil dihapus",
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

            $agenda_id = $this->request->getVar('agenda_id');
            $list = $this->agenda->find($agenda_id);


            $data = [
                'title' => 'Edit Agenda',
                'agenda_id' => $list['agenda_id'],
                'tema' => $list['tema'],
                'isi_agenda' => $list['isi_agenda'],
                'tempat' => $list['tempat'],
                'tgl_mulai' => $list['tgl_mulai'],
                'tgl_selesai' => $list['tgl_selesai'],
                'jam' => $list['jam'],
                'pengirim' => $list['pengirim'],

            ];
            $msg = [
                'sukses' => view('backend/informasi/agenda/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    public function updateagenda()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $agenda_id = $this->request->getVar('agenda_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'tema' => [
                    'label' => 'Tema Agenda',
                    'rules' => 'required[agenda.tema]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'isi_agenda' => [
                    'label' => 'Isi agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],


                'tempat' => [
                    'label' => 'Tempat agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'pengirim' => [
                    'label' => 'Penyelenggara / Pengirim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_mulai' => [
                    'label' => 'Tanggal mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_selesai' => [
                    'label' => 'Tanggal selesai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jam' => [
                    'label' => 'Jam agenda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tema' => $validation->getError('tema'),
                        'isi_agenda' => $validation->getError('isi_agenda'),
                        'tempat' => $validation->getError('tempat'),
                        'pengirim' => $validation->getError('pengirim'),
                        'tgl_mulai' => $validation->getError('tgl_mulai'),
                        'tgl_selesai' => $validation->getError('tgl_selesai'),
                        'pengirim' => $validation->getError('pengirim'),
                        'jam' => $validation->getError('jam')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),

                ];
            } else {

                $updatedata = [

                    'tema' => $this->request->getVar('tema'),
                    'slug_tema' => mb_url_title($this->request->getVar('tema'), '-', TRUE),
                    'isi_agenda' => $this->request->getVar('isi_agenda'),
                    'tempat' => $this->request->getVar('tempat'),
                    'pengirim' => $this->request->getVar('pengirim'),
                    'tgl_mulai' => date('Y-m-d', strtotime($this->request->getVar('tgl_mulai'))),
                    'tgl_selesai' => date('Y-m-d', strtotime($this->request->getVar('tgl_selesai'))),
                    'tgl_posting' => date('Y-m-d'),
                    'jam' => $this->request->getVar('jam'),

                ];

                $this->agenda->update($agenda_id, $updatedata);

                $msg = [
                    'sukses' => 'Data Agenda berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),

                ];
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
            $id = $this->request->getVar('agenda_id');
            $list = $this->agenda->find($id);


            $data = [
                'title' => 'Ganti Cover',
                'id' => $list['agenda_id'],
                'gambar' => $list['gambar']

            ];
            $msg = [
                'sukses' => view('backend/informasi/agenda/gantifoto', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }


    public function douploadAgenda()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('agenda_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'gambar' => [
                    'label' => 'Cover',
                    'rules' => 'uploaded[gambar]|max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
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
                        'gambar' => $validation->getError('gambar')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->agenda->find($id);
                $fotolama = $cekdata['gambar'];

                if ($fotolama != 'default.png' && file_exists('public/img/informasi/agenda/' . $fotolama)) {
                    unlink('public/img/informasi/agenda/' . $fotolama);
                }

                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();

                $updatedata = [
                    'gambar' => $nama_file
                ];

                $this->agenda->update($id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/informasi/agenda/' . $nama_file, 70);

                $msg = [
                    'sukses' => 'Cover berhasil diganti!',
                ];
            }
            echo json_encode($msg);
        }
    }

    //lihat agenda front end
    public function formlihatagenda()
    {

        if ($this->request->isAJAX()) {
            $agenda_id = $this->request->getVar('agenda_id');
            $list = $this->agenda->find($agenda_id);
            // 

            // Update hits
            $data = [
                'hits' => $list['hits'] + 1
            ];
            $this->agenda->update($list['agenda_id'], $data);

            $data = [
                'title' => 'Detail Agenda',
                'agenda_id' => $list['agenda_id'],
                'tema' => $list['tema'],
                'isi' => $list['isi_agenda'],
                'tgl_mulai' => $list['tgl_mulai'],
                'tgl_selesai' => $list['tgl_selesai'],
                'jam' => $list['jam'],
                'tempat' => $list['tempat'],
                'pengirim' => $list['pengirim'],
                'gambar' => $list['gambar'],

            ];
            $msg = [
                'sukses' => view('backend/modal/v_agenda', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }
}
