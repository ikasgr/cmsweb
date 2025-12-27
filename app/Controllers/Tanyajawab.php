<?php

namespace App\Controllers;

class Tanyajawab extends BaseController
{
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $kategori = $this->kategori->list();
        $agenda = $this->agenda->listagendapage();
        $surveytopik = $this->surveytopik->listsurveytopikpg();
        $pengumuman = $this->pengumuman->listpengumumanpage();
        
        $data = [
            'title' => 'Tanya Jawab | ' . esc($konfigurasi->nama),
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi' => $konfigurasi,
            'surveytopik' => $surveytopik->paginate(1, 'hal'),
            'pager' => $surveytopik->pager,
            'jum' => $this->surveytopik->totsurvey(),
            'beritapopuler' => $this->berita->populer()->paginate(4),
            'kategori' => $kategori,
            'kategorifaq' => $this->masterdata->listmasterpublik(1),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'pengumuman' => $pengumuman->paginate(2),
            'agenda' => $agenda->paginate(4),
            'infografis1' => $this->banner->listinfo1(),
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'faq' => $this->faqtanya->listpublish(),

            

        ];
        if (0) {
            $agent = $this->request->getUserAgent();
            if ($agent->isMobile()) {
                return view('frontend/' . esc($template['folder']) . '/mobile/' . 'content/tanyajawab', $data);
            } else {
                return view('frontend/' . esc($template['folder']) . '/desktop/' . 'content/tanyajawab', $data);
            }
        } else {
            return view('frontend/' . esc($template['folder']) . '/desktop/' . 'content/tanyajawab', $data);
        }
    }


    public function detail()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $kategori = $this->kategori->list();
        $agenda = $this->agenda->listagendapage();
        $surveytopik = $this->surveytopik->listsurveytopikpg();
        $pengumuman = $this->pengumuman->listpengumumanpage();
        
        $data = [
            'title' => 'Bantuan | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
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
            'faq' => $this->faqtanya->listpublish(),
            

        ];
        return view('' . esc($template['folder']) . '/' . 'content/detailtiket', $data);
    }

    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        
        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();

        $data = [
            'title' => 'Tanya Jawab ',
            'subtitle' => $konfigurasi['nama'],

        ];
        return view('backend/setkonten/faqtanya/index', $data);
    }


    public function getdata()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return; // Tidak perlu lanjutkan jika bukan AJAX
        }

        // Ambil id grup dan set URL
        $id_grup = session()->get('id_grup');
        $url = 'tanyajawab/list';

        // Ambil akses grup
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Ambil data akses
        $akses = $listgrupf->akses ?? null; // Jika $listgrupf tidak ada, akses menjadi null

        // Cek apakah akses valid (akses 1 atau 2)
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil data yang dibutuhkan
        $data = [
            'title' => 'Tanya Jawab',
            'list' => $this->faqtanya->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Ambil template admin aktif
        // Kirim data ke tampilan dan respon JSON
        echo json_encode([
            'data' => view("backend/setkonten/faqtanya/list", $data)
        ]);
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            
            $data = [
                'title' => 'Tambah Pertanyaan',
                'kategori' => $this->masterdata->listmaster(1),
            ];
            $msg = [
                'data' => view('backend/setkonten/faqtanya/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanfaqtanya()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'faqtanya' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required|is_unique[faq_tanya.faqtanya]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'kat_faq' => [
                    'label' => 'Kategori ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'faqtanya' => $validation->getError('faqtanya'),
                        'kat_faq' => $validation->getError('kat_faq'),

                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'faqtanya' => $this->request->getVar('faqtanya'),
                    'sts_faqtanya' => '1',
                    'kat_faq' => $this->request->getVar('kat_faq'),
                    // 'id'           => session()->get('id')

                ];
                $this->faqtanya->insert($insertdata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsdatagoe' => csrf_hash(),
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

            $id = $this->request->getVar('faq_tanyaid');

            $this->faqtanya->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsdatagoe' => csrf_hash(),
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
            $id = $this->request->getVar('faq_tanyaid');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check

                $this->faqtanya->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
                'csrf_tokencmsdatagoe' => csrf_hash(),
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

            $faq_tanyaid = $this->request->getVar('faq_tanyaid');
            $list = $this->faqtanya->find($faq_tanyaid);
            
            $data = [
                'title' => 'Edit Pertanyaan',
                'faq_tanyaid' => $list['faq_tanyaid'],
                'faqtanya' => $list['faqtanya'],
                'kat_faq' => $list['kat_faq'],
                'kategori' => $this->masterdata->listmaster(1),
            ];
            $msg = [
                'sukses' => view('backend/setkonten/faqtanya/edit', $data),
                'csrf_tokencmsdatagoe' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatefaqtanya()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $faq_tanyaid = $this->request->getVar('faq_tanyaid');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'faqtanya' => [
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
                        'faqtanya' => $validation->getError('faqtanya'),

                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'faqtanya' => $this->request->getVar('faqtanya'),
                    'kat_faq' => $this->request->getVar('kat_faq'),
                ];
                $this->faqtanya->update($faq_tanyaid, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // end tanya & Start Jawab=====================================================

    public function jawaban($faq_tanyaid = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($faq_tanyaid == '') {
            return redirect()->to(base_url('tanyajawab'));
        }
        $list = $this->faqjawab->listjawaban($faq_tanyaid);
        
        $data = [
            'title' => 'Tanya Jawab',
            'subtitle' => 'Jawaban',
            'faq_tanyaid' => $faq_tanyaid,
            'list' => $list,


        ];
        return view('backend/setkonten/faqtanya/faqjawab/index', $data);
    }

    // get datajawaban
    public function getjawaban()
    {
        // Cek apakah pengguna sudah login
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return redirect()->to(base_url('dashboard')); // Redirect jika bukan AJAX
        }

        // Ambil nilai faq_tanyaid dan validasi
        $faq_tanyaid = $this->request->getVar('faq_tanyaid');
        if (empty($faq_tanyaid)) {
            return redirect()->to(base_url('tanyajawab')); // Redirect jika faq_tanyaid kosong
        }

        // Ambil data jawaban berdasarkan faq_tanyaid
        $list = $this->faqjawab->listjawaban($faq_tanyaid);

        // Ambil data grup dan akses
        $id_grup = session()->get('id_grup');
        $url = 'tanyajawab/list';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup tidak ditemukan, kirimkan respons noakses
        if (!$listgrupf) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil data akses dan hak
        $akses = $listgrupf->akses ?? null;
        $hapus = $listgrupf->hapus ?? null;
        $ubah = $listgrupf->ubah ?? null;
        $tambah = $listgrupf->tambah ?? null;

        // Cek akses sebelum melanjutkan
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Management Jawaban',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Ambil template admin aktif
        

        // Kirimkan data ke tampilan dan respons JSON
        echo json_encode([
            'data' => view('backend/setkonten/faqtanya/faqjawab/list', $data)
        ]);
    }

    public function formtambahjawaban()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            
            $data = [
                'title' => 'Tambah Jawaban',
                'faq_tanyaid' => $this->request->getVar('faq_tanyaid'),
            ];
            $msg = [
                'data' => view('backend/setkonten/faqtanya/faqjawab/tambah', $data)
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

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'faq_jawaban' => [
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
                        'faq_jawaban' => $validation->getError('faq_jawaban'),

                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            } else {

                $insertdata = [
                    'faq_tanyaid' => $this->request->getVar('faq_tanyaid'),
                    'faq_jawaban' => $this->request->getVar('faq_jawaban'),
                    'sts_jwb' => '1',
                ];

                $this->faqjawab->insert($insertdata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsdatagoe' => csrf_hash(),
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

            $faq_jawabid = $this->request->getVar('faq_jawabid');
            $list = $this->faqjawab->find($faq_jawabid);
            
            $data = [
                'title' => 'Edit Data',
                'faq_jawabid' => $faq_jawabid,
                'faq_tanyaid' => $list['faq_tanyaid'],
                'faq_jawaban' => $list['faq_jawaban'],

            ];
            $msg = [
                'sukses' => view('backend/setkonten/faqtanya/faqjawab/edit', $data),
                'csrf_tokencmsdatagoe' => csrf_hash(),
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
            $faq_jawabid = $this->request->getVar('faq_jawabid');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'faq_jawaban' => [
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
                        'faq_jawaban' => $validation->getError('faq_jawaban'),
                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            } else {

                //check
                $updatedata = [
                    'faq_jawaban' => $this->request->getVar('faq_jawaban'),
                ];

                $this->faqjawab->update($faq_jawabid, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsdatagoe' => csrf_hash(),
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
            $id = $this->request->getVar('faq_jawabid');

            $this->faqjawab->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsdatagoe' => csrf_hash(),
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
            $id = $this->request->getVar('faq_jawabid');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $this->faqjawab->delete($id[$i]);
            }
            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
                'csrf_tokencmsdatagoe' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }
}
