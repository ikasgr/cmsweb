<?php

namespace App\Controllers;

class Survey extends BaseController
{

    public function index()
    {

        $konfigurasi = $this->konfigurasi->vkonfig();
        $kategori = $this->kategori->list();
        $agenda = $this->agenda->listagendapage();
        $surveytopik = $this->surveytopik->listsurveytopikpg();
        $pengumuman = $this->pengumuman->listpengumumanpage();

        $data = [
            'title' => 'Survei | ' . esc($konfigurasi->nama),
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),

            'konfigurasi' => $konfigurasi,
            'surveytopik' => $surveytopik->paginate(1, 'hal'),
            'pager' => $surveytopik->pager,
            'jum' => $this->surveytopik->totsurvey(),
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
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'infografis10' => $this->banner->listinfopage()->paginate(10),
            'kategori' => $this->kategori->list(),
            'sitekey' => $konfigurasi->g_sitekey,
            'grafisrandom' => $this->banner->grafisrandom(),
            'terkini3' => $this->berita->terkini3(),
            'pekerjaan' => $this->masterdata->listmasterpublik(2),
            'pendidikan' => $this->masterdata->listmasterpublik(3),


        ];

        return view('frontend/interaksi/survey', $data);
    }

    public function cetak($survey_id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($survey_id == '') {

            return redirect()->to(base_url('surveytopik/all'));
        }

        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
        $surveytopik = $this->surveytopik->listcetak($survey_id);

        $data = [
            'title' => 'Masukan dan Saran',
            'subtitle' => 'Detail',
            'konfigurasi' => $konfigurasi,
            'survey_id' => $survey_id,
            'surveytopik' => $surveytopik,
            'nama_survey' => $surveytopik['nama_survey'],
        ];
        return view('backend/' . 'interaksi/surveytopik/cetaksurvey', $data);
    }

    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();

        $data = [
            'title' => 'Survei ',
            'subtitle' => $konfigurasi['nama'],


        ];
        return view('backend/' . 'interaksi/surveytopik/index', $data);
    }

    public function getdata()
    {
        // Cek sesi dan pastikan request adalah AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $id_user = session()->get('id');
        $url = 'survey/all';

        // Ambil data grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        $akses = $listgrupf->akses;

        // Cek validitas akses
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil data surveytopik berdasarkan akses pengguna
        $list = ($akses == 1)
            ? $this->surveytopik->listsurveytopik()
            : $this->surveytopik->listsurveytopikauthor($id_user);

        // Ambil informasi folder admin yang aktif


        // Siapkan data untuk view
        $data = [
            'title' => 'Survei',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Buat respons JSON
        $msg = [
            'data' => view("backend/interaksi/surveytopik/list", $data),
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
                'title' => 'Tambah Topik',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            $msg = [
                'data' => view('backend/' . 'interaksi/surveytopik/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpansurveytopik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_survey' => [
                    'label' => 'Topik Survei',
                    'rules' => 'required|is_unique[survey_topik.nama_survey]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'ket_stb' => [
                    'label' => 'Keterangan stb',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_kb' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_b' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_sb' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_survey' => $validation->getError('nama_survey'),
                        'ket_stb' => $validation->getError('ket_stb'),
                        'ket_kb' => $validation->getError('ket_kb'),
                        'ket_b' => $validation->getError('ket_b'),
                        'ket_sb' => $validation->getError('ket_sb'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'nama_survey' => $this->request->getVar('nama_survey'),
                    'ket_stb' => $this->request->getVar('ket_stb'),
                    'ket_kb' => $this->request->getVar('ket_kb'),
                    'ket_b' => $this->request->getVar('ket_b'),
                    'ket_sb' => $this->request->getVar('ket_sb'),
                    // 'r1_stb'  => $this->request->getVar('r1_stb'),
                    // 'r2_stb'  => $this->request->getVar('r2_stb'),
                    // 'r1_kb'  => $this->request->getVar('r1_kb'),
                    // 'r2_kb'  => $this->request->getVar('r2_kb'),
                    // 'r1_b'  => $this->request->getVar('r1_b'),
                    // 'r2_b'  => $this->request->getVar('r2_b'),
                    // 'r1_sb'  => $this->request->getVar('r1_sb'),
                    // 'r2_sb'  => $this->request->getVar('r2_sb'),
                    'status' => '0',
                    'id' => session()->get('id')

                ];
                $this->surveytopik->insert($insertdata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
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

            $id = $this->request->getVar('survey_id');

            $this->surveytopik->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function resetnilai()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('survey_id');

            // cek responden
            $cekreponden = $this->responden->cekhapusresponden($id);

            if ($cekreponden) {
                foreach ($cekreponden as $data):
                    $idreponden = $data['responden_id'];
                    $this->responden->delete($idreponden);
                endforeach;
            }

            $updatedata = [
                'skor' => 0,
                'hits' => 0,
            ];
            $this->surveytopik->update($id, $updatedata);

            $msg = [
                'sukses' => 'Data Berhasil direset',
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

            $survey_id = $this->request->getVar('survey_id');
            $list = $this->surveytopik->find($survey_id);

            $jpertanyaan = $this->pertanyaan->where('survey_id', $survey_id)->get()->getNumRows();
            $r_awstb1 = $jpertanyaan * 1; // sangt tdk baik
            $r_awkb1 = $jpertanyaan * 2; //kurang baik
            $r_awb1 = $jpertanyaan * 3; //baik
            $r_awsb1 = $jpertanyaan * 4; //sangt baik

            if ($jpertanyaan != 0) {
                $r_akstb2 = $r_awkb1 - 1; //ra akhir sangat tdk baik
                $r_akb2 = $r_awb1 - 1; //ra akhir kurang baik
                $r_ab2 = $r_awsb1 - 1; //ra akhir baik
            } else {
                $r_akstb2 = 0;
                $r_akb2 = 0;
                $r_ab2 = 0;
            }

            $data = [
                'title' => 'Edit Topik',
                'survey_id' => $list['survey_id'],
                'nama_survey' => $list['nama_survey'],

                'ket_stb' => $list['ket_stb'],
                'ket_kb' => $list['ket_kb'],
                'ket_b' => $list['ket_b'],
                'ket_sb' => $list['ket_sb'],

                'r1_stb' => $r_awstb1,
                'r2_stb' => $r_akstb2,
                'r1_kb' => $r_awkb1,
                'r2_kb' => $r_akb2,
                'r1_b' => $r_awb1,
                'r2_b' => $r_ab2,
                'r1_sb' => $r_awsb1,
                // 'r2_sb'   => $list['r2_sb'],
                // 'r1_stb'   => $list['r1_stb'],
                // 'r2_stb'   => $list['r2_stb'],
                // 'r1_kb'   => $list['r1_kb'],
                // 'r2_kb'   => $list['r2_kb'],
                // 'r1_b'   => $list['r1_b'],
                // 'r2_b'   => $list['r2_b'],
                // 'r2_kb'   => $list['r2_kb'],
                // 'r1_sb'   => $list['r1_sb'],
                // 'r2_sb'   => $list['r2_sb'],

                'jumtanya' => $jpertanyaan,


            ];

            $msg = [
                'sukses' => view('backend/' . 'interaksi/surveytopik/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    public function updatetopik()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $survey_id = $this->request->getVar('survey_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama_survey' => [
                    'label' => 'Topik Survei',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_stb' => [
                    'label' => 'Keterangan stb',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_kb' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_b' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ket_sb' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_survey' => $validation->getError('nama_survey'),
                        'ket_stb' => $validation->getError('ket_stb'),
                        'ket_kb' => $validation->getError('ket_kb'),
                        'ket_b' => $validation->getError('ket_b'),
                        'ket_sb' => $validation->getError('ket_sb'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'nama_survey' => $this->request->getVar('nama_survey'),
                    'ket_stb' => $this->request->getVar('ket_stb'),
                    'ket_kb' => $this->request->getVar('ket_kb'),
                    'ket_b' => $this->request->getVar('ket_b'),
                    'ket_sb' => $this->request->getVar('ket_sb'),

                    // 'r1_stb'  => $this->request->getVar('r1_stb'),
                    // 'r2_stb'  => $this->request->getVar('r2_stb'),
                    // 'r1_kb'  => $this->request->getVar('r1_kb'),
                    // 'r2_kb'  => $this->request->getVar('r2_kb'),
                    // 'r1_b'  => $this->request->getVar('r1_b'),
                    // 'r2_b'  => $this->request->getVar('r2_b'),
                    // 'r1_sb'  => $this->request->getVar('r1_sb'),
                    // 'r2_sb'  => $this->request->getVar('r2_sb'),


                ];
                $this->surveytopik->update($survey_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
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
            $id = $this->request->getVar('survey_id');
            $jns = $this->request->getVar('jns');
            $cari = $this->surveytopik->find($id);
            if ($jns == 1) {
                # code...
                if ($cari['status'] == '1') {
                    $sts_show = 0;
                    $pesan = 'Berhasil Non aktifkan !';
                } else {
                    $sts_show = 1;
                    $pesan = 'Berhasil Aktifkan!';
                }
                $updatedata = [
                    'status' => $sts_show,
                ];
                $this->surveytopik->resetdata();
            } else {
                if ($cari['lockisi'] == '1') {
                    $lock = 0;
                    $pesan = 'Sukses Lock!';
                } else {
                    $lock = 1;
                    $pesan = 'Sukses Unlock!';
                }

                $updatedata = [
                    'lockisi' => $lock,
                ];
            }
            $this->surveytopik->update($id, $updatedata);

            $msg = [
                'sukses' => $pesan,
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // start RESPONDEn
    public function pesan($survey_id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($survey_id == '') {
            return redirect()->to(base_url('surveytopik/all'));
        }
        $list = $this->pertanyaan->listpertanyaan($survey_id);

        $data = [
            'title' => 'Responden',
            'subtitle' => 'Detail',
            'survey_id' => $survey_id,
            'list' => $list,


        ];
        return view('backend/' . 'interaksi/surveytopik/surveypesan/index', $data);
    }

    // get data pesan-------
    public function getpesan()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil data session
        $id_grup = session()->get('id_grup');
        $survey_id = $this->request->getVar('survey_id');

        // Redirect jika survey_id kosong
        if (empty($survey_id)) {
            return redirect()->to(base_url('survey/all'));
        }

        // Ambil grup akses dan cek akses
        $url = 'survey/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek apakah grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data berdasarkan akses grup
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;

        // Ambil data responden berdasarkan survey_id
        $list = $this->responden->listresponden($survey_id);

        // Ambil kontrol masterdata
        $nmbscontrol = $this->masterdata;

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Pesan',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'nmbscontrol' => $nmbscontrol,
        ];

        // Ambil folder admin untuk tampilan


        // Kirim data ke tampilan
        $msg = [
            'data' => view("backend/interaksi/surveytopik/surveypesan/list", $data),
        ];

        echo json_encode($msg);
    }

    public function hapusrespon()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('responden_id');
            $survey_id = $this->request->getVar('survey_id');
            $jpoin = $this->request->getVar('jpoin');
            $listtopik = $this->surveytopik->find($survey_id);

            $updatedata = [
                'skor' => $listtopik['skor'] - $jpoin,
            ];

            $this->surveytopik->update($survey_id, $updatedata);

            $this->responden->delete($id);
            $msg = [
                'sukses' => 'Data responden berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function formpesan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $survey_id = $this->request->getVar('survey_id');
            $list = $this->surveytopik->find($survey_id);

            $data = [
                'title' => 'Masukan Saran',
                'survey_id' => $list['survey_id'],
                'nama_survey' => $list['nama_survey'],
                'pesan' => $list['pesan'],
                'nohp' => $list['nohp'],
                'nama' => $list['nama'],

            ];
            $msg = [
                'sukses' => view('backend/' . 'interaksi/surveytopik/surveypesan/index', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // Detail pertayaan
    public function pertanyaan($survey_id = null)
    {
        if (!isset($survey_id))
            return redirect()->to('berita');
        if (session()->get('id') == '') {
            // return redirect()->to('');
            return redirect()->to(base_url(''));
        }
        if ($survey_id == '') {
            return redirect()->to(base_url('surveytopik/all'));
        }
        $list = $this->pertanyaan->listpertanyaan($survey_id);

        $data = [
            'title' => 'Pertanyaan',
            'subtitle' => 'Quisioner',
            'survey_id' => $survey_id,
            'list' => $list,

        ];
        return view('backend/' . 'interaksi/surveytopik/surveypertanyaan/index', $data);
    }

    // get data
    public function getpertanyaan()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil survey_id dari request
        $survey_id = $this->request->getVar('survey_id');

        // Redirect jika survey_id kosong
        if (empty($survey_id)) {
            return redirect()->to(base_url('survey/all'));
        }

        // Ambil data pertanyaan berdasarkan survey_id
        $list = $this->pertanyaan->listpertanyaan($survey_id);

        // Ambil data grup akses dan cek akses
        $id_grup = session()->get('id_grup');
        $url = 'survey/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek apakah grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses, hapus, ubah, tambah
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Managemen Pertanyaan',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Ambil folder admin untuk tampilan


        // Kirim data ke tampilan
        $msg = [
            'data' => view("backend/interaksi/surveytopik/surveypertanyaan/list", $data),
        ];

        echo json_encode($msg);
    }


    public function formtambahpertanyaan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Pertanyaan',
                'survey_id' => $this->request->getVar('survey_id'),
            ];
            $msg = [
                'data' => view('backend/' . 'interaksi/surveytopik/surveypertanyaan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanPertanyaan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'pertanyaan' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required|is_unique[survey_pertanyaan.pertanyaan]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pertanyaan' => $validation->getError('pertanyaan'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'survey_id' => $this->request->getVar('survey_id'),
                    'pertanyaan' => $this->request->getVar('pertanyaan'),
                    'status' => '1',
                ];

                $this->pertanyaan->insert($insertdata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            }
        }
    }

    public function formeditpertanyaan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $pertanyaan_id = $this->request->getVar('pertanyaan_id');

            $list = $this->pertanyaan->find($pertanyaan_id);

            $data = [
                'title' => 'Edit Pertanyaan',
                'pertanyaan_id' => $pertanyaan_id,
                'pertanyaan' => $list['pertanyaan'],
            ];
            $msg = [
                'sukses' => view('backend/' . 'interaksi/surveytopik/surveypertanyaan/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatepertanyaan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $pertanyaan_id = $this->request->getVar('pertanyaan_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'pertanyaan' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pertanyaan' => $validation->getError('pertanyaan'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'pertanyaan' => $this->request->getVar('pertanyaan'),

                ];
                $this->pertanyaan->update($pertanyaan_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    //Hapus

    public function hapuspertanyaan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('pertanyaan_id');
            //check
            $this->pertanyaan->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function hapusperall()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('pertanyaan_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {

                $this->pertanyaan->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // end tanya & Start Jawab=====================================================


    public function jawaban($pertanyaan_id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($pertanyaan_id == '') {

            return redirect()->to(base_url('survey/all'));
        }
        $list = $this->jawaban->listjawaban($pertanyaan_id);

        $data = [
            'title' => 'Survei',
            'subtitle' => 'Jawaban',
            'pertanyaan_id' => $pertanyaan_id,
            'list' => $list,


        ];
        return view('backend/' . 'interaksi/surveytopik/surveyjawaban/index', $data);
    }

    // get datajawaban
    public function getjawaban()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        // Ambil pertanyaan_id dari request
        $pertanyaan_id = $this->request->getVar('pertanyaan_id');

        // Redirect jika pertanyaan_id kosong
        if (empty($pertanyaan_id)) {
            return redirect()->to(base_url('survey/all'));
        }

        // Ambil data jawaban berdasarkan pertanyaan_id
        $list = $this->jawaban->listjawaban($pertanyaan_id);
        $jjawab = $this->jawaban->where('pertanyaan_id', $pertanyaan_id)->get()->getNumRows();

        // Ambil data grup akses dan cek akses
        $id_grup = session()->get('id_grup');
        $url = 'survey/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek apakah grup akses ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses, hapus, ubah, tambah
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;
        $tambah = $listgrupf->tambah;

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Management Jawaban',
            'list' => $list,
            'jum' => $jjawab,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Ambil folder admin untuk tampilan


        // Kirim data ke tampilan
        $msg = [
            'data' => view("backend/interaksi/surveytopik/surveyjawaban/list", $data),
        ];

        echo json_encode($msg);
    }

    public function formtambahjawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $pertanyaan_id = $this->request->getVar('pertanyaan_id');
            $jjawab = $this->jawaban->where('pertanyaan_id', $pertanyaan_id)->get()->getNumRows();
            $data = [
                'title' => 'Tambah Jawaban',
                'pertanyaan_id' => $pertanyaan_id,
                'jum' => $jjawab,
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            $msg = [
                'data' => view('backend/' . 'interaksi/surveytopik/surveyjawaban/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanjawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('pertanyaan_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'jawaban' => [
                    'label' => 'Jawaban',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'jawaban' => $validation->getError('jawaban'),

                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $insertdata = [
                    'pertanyaan_id' => $this->request->getVar('pertanyaan_id'),
                    'jawaban' => $this->request->getVar('jawaban'),
                    'nilai' => $this->request->getVar('nilai'),
                ];

                $this->jawaban->insert($insertdata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditjawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $jawaban_id = $this->request->getVar('jawaban_id');

            $list = $this->jawaban->find($jawaban_id);

            $data = [
                'title' => 'Edit Data',
                'jawaban_id' => $jawaban_id,
                'pertanyaan_id' => $list['pertanyaan_id'],
                'jawaban' => $list['jawaban'],
                'nilai' => $list['nilai'],
            ];
            $msg = [
                'csrf_tokencmsikasmedia' => csrf_hash(),
                'sukses' => view('backend/' . 'interaksi/surveytopik/surveyjawaban/edit', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function updatejawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $jawaban_id = $this->request->getVar('jawaban_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'jawaban' => [
                    'label' => 'Jawaban',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'jawaban' => $validation->getError('jawaban'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'jawaban' => $this->request->getVar('jawaban'),
                    // 'nilai'  => $this->request->getVar('nilai'),

                ];

                $this->jawaban->update($jawaban_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusjawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('jawaban_id');

            $this->jawaban->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function hapusjwball()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('jawaban_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check

                $this->jawaban->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // publik
    public function isisurvei()
    {
        if ($this->request->isAJAX()) {

            if (get_cookie("survei") != 'cossi') {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'jawaban_id' => [
                        'label' => 'Pilihan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                    'usia' => [
                        'label' => 'Umur',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ],
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'jawaban_id' => $validation->getError('jawaban_id'),
                            'nama' => $validation->getError('nama'),
                            'usia' => $validation->getError('usia'),
                        ],
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {


                    $survey_id = $this->request->getVar('survey_id');
                    $nilai = $this->request->getVar('totalnil');
                    $listtopik = $this->surveytopik->find($survey_id);
                    $lockisi = $listtopik['lockisi'];
                    $data = [
                        'skor' => $listtopik['skor'] + $nilai
                    ];
                    $this->surveytopik->update($survey_id, $data);

                    $updatedata = [
                        'hits' => $listtopik['hits'] + 1,
                    ];

                    $this->surveytopik->update($survey_id, $updatedata);
                    $insertdata = [
                        'survey_id' => $survey_id,
                        'saran' => $this->request->getVar('saran'),
                        'nohp' => $this->request->getVar('nohp'),
                        'nama' => $this->request->getVar('nama'),
                        'usia' => $this->request->getVar('usia'),
                        'jk' => $this->request->getVar('jk'),
                        'id_pendidikan' => $this->request->getVar('id_pendidikan'),
                        'id_pekerjaan' => $this->request->getVar('id_pekerjaan'),
                        'jpoin' => $nilai,
                        'tanggal' => date('Y-m-d'),
                    ];
                    $this->responden->insert($insertdata);

                    if ($lockisi == 0) {
                        set_cookie("survei", "cossi", 7000); //1 jam 56 menit
                    }

                    $msg = [
                        'sukses' => 'Terima kasih atas partisipasi Anda mengikuti survei kami.!',
                        'csrf_tokencmsikasmedia' => csrf_hash()
                    ];
                }

                // jika sudah isi
            } else {
                $msg = [
                    'gagal' => 'Anda telah berpartisipasi..!',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }
}





