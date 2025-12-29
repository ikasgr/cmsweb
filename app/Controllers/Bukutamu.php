<?php

namespace App\Controllers;

class Bukutamu extends BaseController
{
    //list frontend
    public function index()
    {

        $konfigurasi = $this->konfigurasi->vkonfig();
        $kategori = $this->kategori->list();
        $agenda = $this->agenda->listagendapage();

        $pengumuman = $this->pengumuman->listpengumumanpage();
        $data = [
            'title' => 'Buku Tamu | ' . esc($konfigurasi->nama),
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi' => $konfigurasi,
            'mbidang' => $this->bidang->list(),

            'beritapopuler' => $this->berita->populer()->paginate(4),
            'kategori' => $kategori,
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'pengumuman' => $pengumuman->paginate(2),
            'agenda' => $agenda->paginate(4),
            'infografis1' => $this->banner->listinfo1(),
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'sitekey' => $konfigurasi->g_sitekey,
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'infografis10' => $this->banner->listinfopage()->paginate(10),
            'grafisrandom' => $this->banner->grafisrandom(),
            'terkini3' => $this->berita->terkini3(),
        ];

        return view('frontend/interaksi/bukutamu', $data);
    }

    public function simpanbukutamu()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],

                'instansi' => [
                    'label' => 'Instansi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',

                    ]
                ],

                'bidang_id' => [
                    'label' => 'Bidang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field} !',

                    ]
                ],

                'keperluan' => [
                    'label' => 'Keperluan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'telp' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'telp' => $validation->getError('telp'),
                        'bidang_id' => $validation->getError('bidang_id'),
                        'instansi' => $validation->getError('instansi'),
                        'keperluan' => $validation->getError('keperluan'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();

                $secretkey = $konfigurasi['google_secret'];
                $g_sitekey = $konfigurasi['g_sitekey'];
                // gcaptcha
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
                    if ($status['success']) {

                        $insertdata = [
                            'nama' => $this->request->getVar('nama'),
                            'bidang_id' => $this->request->getVar('bidang_id'),
                            'telp' => $this->request->getVar('telp'),
                            'instansi' => $this->request->getVar('instansi'),
                            'keperluan' => $this->request->getVar('keperluan'),
                            'tanggal' => date('Y-m-d'),
                            'status' => '0'

                        ];

                        $this->bukutamu->insert($insertdata);

                        $msg = [
                            'sukses' => 'Pesan Anda sukses terkirim..!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                    } else {
                        $msg = [
                            'gagal' => 'Gagal kirim pesan Silahkan periksa Kembali!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                    }
                } else {
                    $insertdata = [
                        'nama' => $this->request->getVar('nama'),
                        'bidang_id' => $this->request->getVar('bidang_id'),
                        'telp' => $this->request->getVar('telp'),
                        'instansi' => $this->request->getVar('instansi'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'tanggal' => date('Y-m-d'),
                        'status' => '0'

                    ];
                    $this->bukutamu->insert($insertdata);
                    $msg = [
                        'sukses' => 'Pesan Anda sukses terkirim..!'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    //back end
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Buku',
            'subtitle' => 'Tamu',

        ];
        return view('backend/interaksi/bukutamu/index', $data);
    }


    public function getdata()
    {
        // Cek apakah session ada dan request adalah AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'bukutamu/list';

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan, kirimkan pesan akses belum ada
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses dan lainnya
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Cek akses yang valid (1 atau 2)
        if ($akses != '1' && $akses != '2') {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil data daftar buku tamu
        $list = $this->bukutamu->list();

        // Ambil template admin aktif


        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Buku Tamu',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Siapkan respons JSON dengan data tampilan dan csrf token
        $msg = [
            'data' => view('backend/interaksi/bukutamu/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }


    public function getdatanew()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }
        $data = [
            'list' => $this->bukutamu->listkritiknew(),
            'totkritik' => $this->bukutamu->totkritik(),
        ];


        $msg = [
            'data' => view('backend/interaksi/bukutamu/vmenukritik', $data),
        ];
        echo json_encode($msg);
    }

    public function formedit()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $bukutamu_id = $this->request->getVar('bukutamu_id');
            $bidang_id = $this->request->getVar('bidang_id');
            $list = $this->bukutamu->find($bukutamu_id);
            $cari = $this->bidang->find($bidang_id);


            $data = [
                'title' => 'Detail Buku Tamu',
                'bukutamu_id' => $list['bukutamu_id'],
                'nama' => $list['nama'],
                'instansi' => $list['instansi'],
                'bidang' => $cari['nama_bidang'],
                'keperluan' => $list['keperluan'],
                'tanggal' => $list['tanggal'],
                'status' => $list['status'],
                'telp' => $list['telp'],

            ];
            $msg = [
                'sukses' => view('backend/interaksi/bukutamu/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $bukutamu_id = $this->request->getVar('bukutamu_id');

            $this->bukutamu->delete($bukutamu_id);
            $msg = [
                'sukses' => 'Data berhasil dihapus!',
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
            $bukutamu_id = $this->request->getVar('bukutamu_id');
            $jmldata = count($bukutamu_id);
            for ($i = 0; $i < $jmldata; $i++) {

                $this->bukutamu->delete($bukutamu_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // start bidang
    public function bidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Master',
            'subtitle' => 'Bidang',

        ];
        return view('backend/interaksi/bukutamu/bt_bidang/index', $data);
    }

    public function getbidang()
    {
        // Cek apakah session aktif dan request adalah AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil data grup akses berdasarkan id_grup dan url
        $id_grup = session()->get('id_grup');
        $url = 'bukutamu/list';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Validasi akses
        if ($listgrupf) {
            $akses = $listgrupf->akses;
            $hapus = $listgrupf->hapus;
            $ubah = $listgrupf->ubah;
            $tambah = $listgrupf->tambah;

            // Cek akses pengguna
            if (in_array($akses, ['1', '2'])) {
                // Ambil template admin aktif


                // Siapkan data untuk dikirim ke tampilan
                $data = [
                    'title' => 'Data Bidang',
                    'list' => $this->bidang->list(),
                    'akses' => $akses,
                    'hapus' => $hapus,
                    'ubah' => $ubah,
                    'tambah' => $tambah,
                ];

                // Buat respons untuk AJAX
                $msg = [
                    'data' => view('backend/interaksi/bukutamu/bt_bidang/list', $data),
                ];
            } else {
                // Jika tidak memiliki akses
                $msg = [
                    'noakses' => [],
                ];
            }
        } else {
            // Jika grup akses tidak ditemukan
            $msg = [
                'blmakses' => [],
            ];
        }

        // Kirimkan respons JSON
        echo json_encode($msg);
    }

    public function formbidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Bidang'
            ];


            $msg = [
                'data' => view('backend/interaksi/bukutamu/bt_bidang/tambah', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpanbidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_bidang' => [
                    'label' => 'Bidang',
                    'rules' => 'required|is_unique[bt_bidang.nama_bidang]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bidang' => $validation->getError('nama_bidang'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_bidang' => $this->request->getVar('nama_bidang'),

                ];

                $this->bidang->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditbidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $bidang_id = $this->request->getVar('bidang_id');
            $list = $this->bidang->find($bidang_id);

            $data = [
                'title' => 'Edit Bidang',
                'bidang_id' => $list['bidang_id'],
                'nama_bidang' => $list['nama_bidang'],
            ];
            $msg = [
                'sukses' => view('backend/interaksi/bukutamu/bt_bidang/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatebidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_bidang' => [
                    'label' => 'Nama Bidang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bidang' => $validation->getError('nama_bidang'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'nama_bidang' => $this->request->getVar('nama_bidang'),
                ];

                $bidang_id = $this->request->getVar('bidang_id');
                $this->bidang->update($bidang_id, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusbidang()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $bidang_id = $this->request->getVar('bidang_id');
            $this->bidang->delete($bidang_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
}





