<?php

namespace App\Controllers;

class Video extends BaseController
{
    //list semua video
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $rawVideos = $this->video->listvideopage()->paginate(12, 'hal');

        $items = [];
        foreach ($rawVideos as $vid) {
            // Basic YT thumbnail logic
            $thumbnail = null;
            if (strpos($vid['video_link'], 'youtube.com') !== false || strpos($vid['video_link'], 'youtu.be') !== false) {
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $vid['video_link'], $match);
                if (isset($match[1])) {
                    $thumbnail = "https://img.youtube.com/vi/{$match[1]}/hqdefault.jpg";
                }
            }

            $items[] = [
                'id' => $vid['video_id'],
                'type' => 'video',
                'file_path' => $vid['video_link'],
                'title' => $vid['judul'],
                'category' => $vid['nama_kategori_video'],
                'event_date' => $vid['tanggal'],
                'description' => $vid['ket_video'],
                'views' => $vid['hits'],
                'thumbnail' => $thumbnail
            ];
        }

        $rawCats = $this->kategorivideo->findAll();
        $categories = [];
        foreach ($rawCats as $cat) {
            $categories[] = [
                'category' => $cat['nama_kategori_video'],
                'total' => $this->video->where('kategorivideo_id', $cat['kategorivideo_id'])->countAllResults()
            ];
        }

        $data = [
            'title' => 'Galeri Video | ' . esc($konfigurasi->nama),
            'konfigurasi' => $konfigurasi,
            'items' => $items,
            'filters' => ['type' => 'video', 'category' => null],
            'categories' => $categories,
            'pager' => $this->video->pager,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
        ];

        return view('frontend/gallery/index', $data);
    }

    //Detail front end
    public function detail($video_id = null)
    {
        if (!isset($video_id))
            return redirect()->to('/video');
        $konfigurasi = $this->konfigurasi->vkonfig();

        $video = $this->video->detail_video($video_id);

        if ($video) {
            // Update hits
            $this->video->update($video_id, ['hits' => $video->hits + 1]);

            $data = [
                'title' => esc($video->judul),
                'konfigurasi' => $konfigurasi,
                'item' => [
                    'id' => $video->video_id,
                    'type' => 'video',
                    'file_path' => $video->video_link,
                    'title' => $video->judul,
                    'description' => $video->ket_video,
                    'category' => $video->nama_kategori_video,
                    'event_date' => $video->tanggal,
                    'views' => $video->hits + 1
                ],
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
            ];

            return view('frontend/gallery/detail', $data);
        } else {
            return redirect()->to('/video');
        }
    }
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }


        $data = [
            'title' => 'Galeri',
            'subtitle' => 'Video',

        ];
        return view('backend/' . 'galeri/video/index', $data);
    }

    public function getdata($id = null)
    {
        // Pastikan ada session id dan request adalah AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        $id_grup = session()->get('id_grup');
        $id = session()->get('id');
        $url = 'video/all';


        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses ditemukan
        if ($listgrupf) {
            $akses = $listgrupf->akses;

            // Menentukan daftar video berdasarkan akses
            if ($akses == 1) {
                $list = $this->video->listvideo();
            } elseif ($akses == 2) {
                $list = $this->video->listvideoauthor($id);
            } else {
                $list = [];
            }

            // Jika akses sesuai, tampilkan data
            if (in_array($akses, [1, 2])) {
                $data = [
                    'title' => 'Galeri Video',
                    'list' => $list,
                    'akses' => $akses,
                    'hapus' => $listgrupf->hapus,
                    'ubah' => $listgrupf->ubah,
                    'tambah' => $listgrupf->tambah,
                ];

                // Siapkan respon data
                $msg = [
                    'data' => view('backend/galeri/video/list', $data),
                ];
            } else {
                // Jika tidak ada akses
                $msg = ['noakses' => []];
            }
        } else {
            // Jika grup akses tidak ditemukan
            $msg = ['blmakses' => []];
        }

        // Kirim respons JSON
        echo json_encode($msg);
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {


            $data = [
                'title' => 'Tambah Video',
                'kategori' => $this->kategorivideo->orderBy('kategorivideo_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('backend/' . 'galeri/video/tambah', $data),

            ];
            echo json_encode($msg);
        }
    }

    public function uploadvideo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Judul Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'video_link' => [
                    'label' => 'Link Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'kategorivideo_id' => [
                    'label' => 'Kategori Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'video_link' => $validation->getError('video_link'),
                        'kategorivideo_id' => $validation->getError('kategorivideo_id'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $userid = session()->get('id');
                // $level = session()->get('level');
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $ceksts = $konfigurasi['sts_posting'];

                // cek role video
                $id_grup = session()->get('id_grup');
                $urlget = 'video/all';
                $listgrupf = $this->grupakses->listgrupakses($id_grup, $urlget);

                foreach ($listgrupf as $data):
                    $akses = $data['akses'];
                endforeach;

                if ($listgrupf) {
                    if ($akses == '1') {
                        $stspos = 1;
                    } else {
                        if ($ceksts == 1) {
                            $stspos = 0;
                        } else {
                            $stspos = 1;
                        }
                    }
                }
                $insertdata = [
                    'judul' => $this->request->getVar('judul'),
                    'kategorivideo_id' => $this->request->getVar('kategorivideo_id'),
                    'video_link' => $this->request->getVar('video_link'),
                    'tanggal' => date('Y-m-d'),
                    'id' => $userid,
                    'sts_v' => $stspos,
                    'ket_video' => $this->request->getVar('ket_video'),
                ];

                $this->video->insert($insertdata);
                $msg = [
                    'sukses' => 'Video berhasil diupload!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $video_id = $this->request->getVar('video_id');
            $list = $this->video->find($video_id);


            $data = [
                'title' => 'Edit Galeri Video',
                'video_id' => $list['video_id'],
                'judul' => $list['judul'],
                'video_link' => $list['video_link'],
                'kategorivideo_id' => $list['kategorivideo_id'],
                'ket_video' => $list['ket_video'],
                'kategorivideo' => $this->kategorivideo->list(),

            ];
            $msg = [
                'sukses' => view('backend/' . 'galeri/video/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatevideo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $video_id = $this->request->getVar('video_id');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Judul Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'video_link' => [
                    'label' => 'Link Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'kategorivideo_id' => [
                    'label' => 'Kategori Video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'video_link' => $validation->getError('video_link'),
                        'kategorivideo_id' => $validation->getError('kategorivideo_id')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $updatedata = [
                    'judul' => $this->request->getVar('judul'),
                    'kategorivideo_id' => $this->request->getVar('kategorivideo_id'),
                    'video_link' => $this->request->getVar('video_link'),
                    'ket_video' => $this->request->getVar('ket_video'),
                ];
                $this->video->update($video_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    //tambah multi
    public function uploadvideomulti()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {


            $data = [
                'title' => 'Tambah Video',
                'kategori' => $this->kategorivideo->orderBy('kategorivideo_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('backend/' . 'galeri/video/formmultiadd', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpanmulti()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Keterangan Foto',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],

                'video_link' => [
                    'label' => 'Link video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'kategorivideo_id' => [
                    'label' => 'Kategori video',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'video_link' => $validation->getError('video_link'),
                        'kategorivideo_id' => $validation->getError('kategorivideo_id')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $judul = $this->request->getVar('judul');
                $video_link = $this->request->getVar('video_link');
                $ket_video = $this->request->getVar('ket_video');
                $kategorivideo_id = $this->request->getVar('kategorivideo_id');
                $userid = session()->get('id');
                $video_id = $this->request->getVar('video_id');

                // $level = session()->get('level');
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $ceksts = $konfigurasi['sts_posting'];

                // cek role video
                $id_grup = session()->get('id_grup');
                $urlget = 'video/all';
                $listgrupf = $this->grupakses->listgrupakses($id_grup, $urlget);

                foreach ($listgrupf as $data):
                    $akses = $data['akses'];
                endforeach;

                if ($listgrupf) {
                    if ($akses == '1') {
                        $stspos = 1;
                    } else {
                        if ($ceksts == 1) {
                            $stspos = 0;
                        } else {
                            $stspos = 1;
                        }
                    }
                }
                $jdata = count($video_id);
                for ($i = 0; $i < $jdata; $i++) {

                    $insertdata = [
                        'judul' => $judul[$i],
                        'video_link' => $video_link[$i],
                        'kategorivideo_id' => $kategorivideo_id[$i],
                        'tanggal' => date('Y-m-d'),
                        'id' => $userid,
                        'sts_v' => $stspos,
                        'ket_video' => $ket_video,
                    ];

                    $this->video->insert($insertdata);

                    $msg = [
                        'sukses' => "$jdata Video berhasil ditambahkan !",
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                }

                $msg = [
                    'sukses' => 'Data berhasil disimpan!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $video_id = $this->request->getVar('video_id');

            $this->video->delete($video_id);
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
            $video_id = $this->request->getVar('video_id');
            $jmldata = count($video_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $this->video->delete($video_id[$i]);
            }
            $msg = [
                'sukses' => "$jmldata video berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // aktif non aktifkan
    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('video_id');
            $cari = $this->video->find($id);

            $sts = $cari['sts_v'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->video->update($id, ['sts_v' => $sts]);

            echo json_encode([
                'sukses' => $stsket,
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
        }
    }

    //Start kategori (backend)
    public function kategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Galeri - Video',
            'subtitle' => 'Kategori',

        ];
        return view('backend/' . 'galeri/video/kategorivideo/index', $data);
    }

    public function getkategori()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        $id_grup = session()->get('id_grup');
        $url = 'video/all';


        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan
        if ($listgrupf) {
            $akses = $listgrupf->akses;

            // Cek apakah akses sesuai dan tampilkan data
            if (in_array($akses, [1, 2])) {
                $data = [
                    'title' => 'Galeri Video',
                    'list' => $this->kategorivideo->orderBy('kategorivideo_id', 'ASC')->findAll(),
                    'akses' => $akses,
                    'hapus' => $listgrupf->hapus,
                    'ubah' => $listgrupf->ubah,
                    'tambah' => $listgrupf->tambah,
                ];

                // Siapkan respons dengan data
                $msg = [
                    'data' => view('backend/galeri/video/kategorivideo/list', $data),
                ];
            } else {
                // Jika tidak ada akses yang sesuai
                $msg = ['noakses' => []];
            }
        } else {
            // Jika grup akses tidak ditemukan
            $msg = ['blmakses' => []];
        }

        // Kirim respons JSON
        echo json_encode($msg);
    }

    public function formkategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kategori',
                // 'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];


            $msg = [
                'data' => view('backend/' . 'galeri/video/kategorivideo/tambah', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    public function simpankategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori_video' => [
                    'label' => 'Kategori',
                    'rules' => 'required|is_unique[kategori_video.nama_kategori_video]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori_video' => $validation->getError('nama_kategori_video'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_kategori_video' => $this->request->getVar('nama_kategori_video'),
                    'slug_kategori_video' => $this->request->getVar('slug_kategori_video'),

                ];

                $this->kategorivideo->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditkategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $kategorivideo_id = $this->request->getVar('kategorivideo_id');
            $list = $this->kategorivideo->find($kategorivideo_id);

            $data = [
                'title' => 'Edit Kategori',
                'kategorivideo_id' => $list['kategorivideo_id'],
                'nama_kategori_video' => $list['nama_kategori_video'],

            ];
            $msg = [
                'sukses' => view('backend/' . 'galeri/video/kategorivideo/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatekategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori_video' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori_video' => $validation->getError('nama_kategori_video'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'nama_kategori_video' => $this->request->getVar('nama_kategori_video'),
                    'slug_kategori_video' => $this->request->getVar('slug_kategori_video'),
                ];

                $kategorivideo_id = $this->request->getVar('kategorivideo_id');
                $this->kategorivideo->update($kategorivideo_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuskategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $kategorivideo_id = $this->request->getVar('kategorivideo_id');

            $this->kategorivideo->delete($kategorivideo_id);
            $msg = [
                'sukses' => 'Kategori Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
    //end kategori


    // simpan Like posting Video

    public function likevideo($video_id = null)
    {
        if ($this->request->isAJAX()) {
            $video_id = $this->request->getVar('video_id');
            $cari = $this->video->find($video_id);
            $postlike = $cari['likevideo'];
            $data = [
                'likevideo' => $postlike + 1,
            ];
            $this->video->update($video_id, $data);

            $msg = [
                'sukses' => 'Anda menyukai video ini',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
}





