<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index()
    {
        $konfigurasi        = $this->konfigurasi->vkonfig();
        $layanan            = $this->layanan->listlayananpage();
        $template           = $this->template->tempaktif();

        $data = [
            'title'         => 'Layanan | ' . esc($konfigurasi->nama),
            'deskripsi'     => esc($konfigurasi->deskripsi),
            'url'           => esc($konfigurasi->website),
            'img'           => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'layanan'       => $layanan->paginate(6, 'hal'),
            'pager'         => $layanan->pager,
            'jum'           => $this->layanan->totlayanan(),
            'banner'        => $this->banner->list(),
            'infografis'    => $this->banner->listinfo(),
            'infografis10'    => $this->banner->listinfopage()->paginate(10),
            'infografis1'   => $this->banner->listinfo1(),
            'agenda'        => $this->agenda->listagendapage()->paginate(4),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'kategori'      => $this->kategori->list(),
            'section'       => $this->section->list(),
            'linkterkaitall'    => $this->linkterkait->publishlinkall(),
            'grafisrandom'         => $this->banner->grafisrandom(),
            'terkini3'       => $this->berita->terkini3(),
            'folder'        => $template['folder'],

        ];
        if ($template['duatema'] == 1) {
            $agent = $this->request->getUserAgent();
            if ($agent->isMobile()) {
                return view('frontend/' . $template['folder'] . '/mobile/' . 'content/semua_layanan', $data);
            } else {
                return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_layanan', $data);
            }
        } else {
            return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_layanan', $data);
        }
    }

    //list semua layanan
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'        => 'Informasi',
            'subtitle'    => 'Layanan',
            'folder'    =>  esc($tadmin['folder']),

        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/index', $data);
    }

    public function getdata($id = null)
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $id = session()->get('id');
        $url = 'layanan/all';

        // Ambil grup akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan, kirimkan pesan akses belum ada
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses dan cek akses
        $akses = $listgrupf->akses;

        if ($akses == '1') {
            $list = $this->layanan->listlayanan();
        } elseif ($akses == '2') {
            $list = $this->layanan->listlayananauthor($id);
        } else {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title' => 'Layanan',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
            'nmbscontrol' => $this->poling,
        ];

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/informasi/layanan/list', $data)
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
                'title'                 => 'Tambah Layanan',
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanLayanan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            // Validasi input
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Layanan',
                    'rules' => 'required|is_unique[informasi.nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'isi_informasi' => [
                    'label' => 'Deskripsi Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'gambar' => [
                    'label' => 'Cover layanan',
                    'rules' => 'max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, JPEG, JPG, atau GIF..!!'
                    ]
                ]
            ]);

            if (!$valid) {
                echo json_encode([
                    'error' => [
                        'nama'          => $validation->getError('nama'),
                        'isi_informasi' => $validation->getError('isi_informasi'),
                        'gambar'        => $validation->getError('gambar')
                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ]);
                return;
            }

            // Ambil data form
            $userid     = session()->get('id');
            $nama_file  = 'default.png';
            $filegambar = $this->request->getFile('gambar');

            // Jika ada gambar, proses upload
            if ($filegambar && $filegambar->isValid() && !$filegambar->hasMoved()) {
                $nama_file = $filegambar->getRandomName();
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/informasi/layanan/' . $nama_file, 70);
            }

            // Simpan data ke database
            $this->layanan->insert([
                'nama'              => $this->request->getVar('nama'),
                'slug_informasi'    => mb_url_title($this->request->getVar('nama'), '-', true),
                'isi_informasi'     => $this->request->getVar('isi_informasi'),
                'ket'               => $this->request->getVar('ket'),
                'tgl_informasi'     => date('Y-m-d'),
                'gambar'            => $nama_file,
                'id'                => $userid,
                'type'              => '0',
                'hits'              => '0'
            ]);

            echo json_encode([
                'sukses' => 'Layanan berhasil disimpan!',
                'csrf_tokencmsdatagoe' => csrf_hash(),
            ]);
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('informasi_id');
            //check
            $cekdata = $this->layanan->find($id);
            $fotolama = $cekdata['gambar'];
            $filelama = $cekdata['fileunduh'];

            if ($fotolama != 'default.png' && file_exists('public/img/informasi/layanan/' . $fotolama)) {
                unlink('public/img/informasi/layanan/' . $fotolama);
            }
            if ($filelama != '' && file_exists('public/unduh/layanan/' . $filelama)) {
                unlink('public/unduh/layanan/' . $filelama);
            }

            $this->layanan->delete($id);
            $msg = [
                'sukses' => 'Data Layanan Berhasil Dihapus',
                'csrf_tokencmsdatagoe'  => csrf_hash(),

            ];

            echo json_encode($msg);
        }
    }

    public function hapusfile()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('informasi_id');
            //check
            $cekdata = $this->layanan->find($id);
            $filelama = $cekdata['fileunduh'];

            if ($filelama != '' && file_exists('public/unduh/layanan/' . $filelama)) {
                unlink('public/unduh/layanan/' . $filelama);
            }

            $updatedata = [
                'fileunduh'           => ''
            ];

            $this->layanan->update($id, $updatedata);

            $msg = [
                'sukses'                => 'Data file yang disematkan sukses Dihapus',
                'csrf_tokencmsdatagoe'  => csrf_hash(),

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
            $id = $this->request->getVar('informasi_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check gbr
                $cekdata = $this->layanan->find($id[$i]);
                $fotolama = $cekdata['gambar'];
                $filelama = $cekdata['fileunduh'];

                if ($fotolama != 'default.png' && file_exists('public/img/informasi/layanan/' . $fotolama)) {
                    unlink('public/img/informasi/layanan/' . $fotolama);
                }
                if ($filelama != '' && file_exists('public/unduh/layanan/' . $filelama)) {
                    unlink('public/unduh/layanan/' . $filelama);
                }
                $this->layanan->delete($id[$i]);
            }

            $msg = [
                'sukses'                => "$jmldata Data layanan berhasil dihapus",
                'csrf_tokencmsdatagoe'  => csrf_hash(),

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

            $informasi_id = $this->request->getVar('informasi_id');
            $list =  $this->layanan->find($informasi_id);
            $tadmin = $this->template->tempadminaktif();

            $data = [
                'title'          => 'Edit Layanan',
                'informasi_id'   => $list['informasi_id'],
                'nama'           => $list['nama'],
                'isi_informasi'  => $list['isi_informasi'],


            ];
            $msg = [
                'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/edit', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    public function updatelayanan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $informasi_id = $this->request->getVar('informasi_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama' => [
                    'label' => 'Nama Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'isi_informasi' => [
                    'label' => 'Deskripsi Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'           => $validation->getError('nama'),
                        'isi_informasi'     => $validation->getError('isi_informasi'),
                    ],
                    'csrf_tokencmsdatagoe'  => csrf_hash(),

                ];
            } else {

                $updatedata = [

                    'nama'              => $this->request->getVar('nama'),
                    'slug_informasi'   => mb_url_title($this->request->getVar('nama'), '-', TRUE),
                    'isi_informasi'   => $this->request->getVar('isi_informasi'),
                ];
                $this->layanan->update($informasi_id, $updatedata);
                $msg = [
                    'sukses' => 'Data Layanan berhasil diubah!',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),

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
            $id = $this->request->getVar('informasi_id');
            $list =  $this->layanan->find($id);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'       => 'Ganti Cover',
                'id'          => $list['informasi_id'],
                'gambar'      => $list['gambar'],
            ];
            $msg = [
                'csrf_tokencmsdatagoe'  => csrf_hash(),
                'sukses'    => view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/gantifoto', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function douploadLayanan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('informasi_id');

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
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->layanan->find($id);
                $fotolama = $cekdata['gambar'];

                if ($fotolama != 'default.png' && file_exists('public/img/informasi/layanan/' . $fotolama)) {
                    unlink('public/img/informasi/layanan/' . $fotolama);
                }

                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();

                $updatedata = [
                    'gambar' => $nama_file
                ];

                $this->layanan->update($id, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/informasi/layanan/' . $nama_file, 70);
                $msg = [
                    'sukses' => 'Cover berhasil diganti!',
                ];
            }
            echo json_encode($msg);
        }
    }

    //Upload file
    public function formuploadfile()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('informasi_id');
            $list =  $this->layanan->find($id);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title'       => 'File Unduhan',
                'id'          => $list['informasi_id'],
                'gambar'      => $list['gambar'],
                'fileunduh'   => $list['fileunduh']
            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/uploadfile', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    //simpan fileunduh
    public function douploadFileUnduh()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('informasi_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'fileunduh' => [
                    'label' => 'File unduhan',
                    'rules' => [
                        'uploaded[fileunduh]',
                        'mime_in[fileunduh,image/jpg,image/jpeg,image/gif,image/png,application/pdf,application/doc,application/docx,application/xls,application/xlsx,application/ppt,application/pptx,text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                        'max_size[fileunduh,2096]',
                    ],
                    'errors' => [
                        'uploaded' => 'Silahkan Masukkan file',
                        'max_size' => 'Ukuran {field} Maksimal 2096 KB..!!',
                        'mime_in' => 'Format {field} tidak valid..!!'
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'fileunduh' => $validation->getError('fileunduh')
                    ],
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->layanan->find($id);
                $filelama = $cekdata['fileunduh'];

                if ($filelama != '' && file_exists('public/unduh/layanan/' . $filelama)) {
                    unlink('public/unduh/layanan/' . $filelama);
                }

                $fileunduhan = $this->request->getFile('fileunduh');
                $nama_file = $fileunduhan->getRandomName();

                // $updatedata = [
                //     'fileunduh' => $nama_file
                // ];

                // $this->layanan->update($id, $updatedata);
                // $fileunduhan->move('public/unduh/layanan/', $nama_file); //folder foto
                if ($fileunduhan->isValid() && !$fileunduhan->hasMoved()) {

                    $fileunduhan->move(ROOTPATH . 'public/unduh/layanan/', $nama_file); //folder gambar
                    $updatedata = [
                        'fileunduh' => $nama_file
                    ];
                    $this->layanan->update($id, $updatedata);
                }

                $msg = [
                    'sukses' => 'File berhasil diupload!',
                ];
            }
            echo json_encode($msg);
        }
    }

    //lihat detail layanan front end
    public function formlihatlayananAsx()
    {
        if ($this->request->isAJAX()) {
            $informasi_id   = $this->request->getVar('informasi_id');
            $list           = $this->layanan->find($informasi_id);
            $tadmin         = $this->template->tempadminaktif();
            $jenis          = $this->request->getVar('jns');
            $konfigurasi    = $this->konfigurasi->vkonfig();
            if ($jenis == '') {
                $folform = 'v_layanan';
            } else {
                $folform = 'v_layananfr';
            }
            // Update hits
            $data = [
                'hits'        => $list['hits'] + 1
            ];
            $this->layanan->update($list['informasi_id'], $data);

            $data = [
                'title'          => 'Detail Layanan',
                'informasi_id'   => $list['informasi_id'],
                'nama'           => $list['nama'],
                'isi_informasi'  => $list['isi_informasi'],
                'tgl_informasi'  => $list['tgl_informasi'],
                'gambar'         => $list['gambar'],
                'fileunduh'      => $list['fileunduh'],
                'webutama'       => $konfigurasi->website,

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'modal/' . $folform . '', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function formlihatlayanan()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $informasi_id = $this->request->getVar('informasi_id');
        $jenis = $this->request->getVar('jns');
        $list = $this->layanan->find($informasi_id);

        if (!$list) {
            return json_encode(['error' => 'Data tidak ditemukan']);
        }
        $template                 = $this->template->tempaktif();
        $tadmin = $this->template->tempadminaktif();
        $konfigurasi = $this->konfigurasi->vkonfig();
        $folform = $jenis === '' ? 'v_layanan' : 'v_layananfr';

        // Update hits
        $this->layanan->update($list['informasi_id'], ['hits' => $list['hits'] + 1]);

        // Data untuk dikirim ke view
        $data = [
            'title'         => 'Detail Layanan',
            'informasi_id'  => $list['informasi_id'],
            'nama'          => $list['nama'],
            'isi_informasi' => $list['isi_informasi'],
            'tgl_informasi' => $list['tgl_informasi'],
            'gambar'        => $list['gambar'],
            'fileunduh'     => $list['fileunduh'],
            'webutama'      => $konfigurasi->website,
            'folder'        => esc($template['folder']),
        ];

        $msg = [
            'sukses' => view('backend/' . esc($tadmin['folder']) . '/modal/' . $folform, $data),
            'csrf_tokencmsdatagoe' => csrf_hash(),
        ];

        return $this->response->setJSON($msg);
    }

    # onepage

    public function formlihatlayananfr()
    {
        if (!$this->request->isAJAX()) {
            return;
        }

        $informasi_id = $this->request->getVar('informasi_id');
        $list = $this->layanan->find($informasi_id);

        if (!$list) {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
        }

        $tadmin                   = $this->template->tempadminaktif();
        $template                 = $this->template->tempaktif();
        // Update hits
        $this->layanan->update($informasi_id, ['hits' => $list['hits'] + 1]);

        // Data untuk dikirim ke view
        $data = [
            'title'         => 'Detail Layanan',
            'informasi_id'  => $list['informasi_id'],
            'nama'          => esc($list['nama']),
            'isi_informasi' => $list['isi_informasi'],
            'tgl_informasi' => $list['tgl_informasi'],
            'gambar'        => esc($list['gambar']),
            'fileunduh'     => esc($list['fileunduh']),
            'folder'        => esc($template['folder']),

        ];

        $msg = [
            'sukses' => view('backend/' . esc($tadmin['folder']) . '/modal/v_layananfr', $data),
        ];

        return $this->response->setJSON($msg);
    }

    function download($fileupload)
    {

        $list =  $this->bankdata->downloadfile($fileupload);
        if ($list) {
            $datahits = [
                'hits'        => $list['hits'] + 1
            ];
            $this->bankdata->update($list['bankdata_id'], $datahits);
            return $this->response->download('public/unduh/bankdata/' . $list['fileupload'], null);
        } else {
            return redirect()->to('/');
        }
    }

    function download_layananlocal($fileupload)
    {
        $list =  $this->layanan->downloadfile($fileupload);
        if ($list) {
            // $datahits = [
            //     'hits'        => $list['hits'] + 1
            // ];
            // $this->layanan->update($list['informasi_id'], $datahits);
            return $this->response->download('public/unduh/layanan/' . $fileupload, null);
        } else {
            return redirect()->to('/');
        }
    }

    function download_layanan($fileupload)
    {
        $list = $this->layanan->downloadfile($fileupload);
        if ($list) {
            $konfigurasi = $this->konfigurasi->vkonfig();
            $webutama = $konfigurasi->website;
            $fileUrl = $webutama . 'public/unduh/layanan/' . $fileupload;

            // Ambil konten file dari URL
            $fileContent = @file_get_contents($fileUrl);

            if ($fileContent !== false) {
                // Tentukan MIME berdasarkan ekstensi file
                $fileExtension = pathinfo($fileupload, PATHINFO_EXTENSION);
                $mimeTypes = [
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'pdf' => 'application/pdf',
                    'doc' => 'application/msword',
                    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'xls' => 'application/vnd.ms-excel',
                    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'txt' => 'text/plain',
                ];
                $mimeType = $mimeTypes[$fileExtension] ?? 'application/octet-stream';

                // Kirim file sebagai respons download
                return $this->response
                    ->setHeader('Content-Type', $mimeType)
                    ->setHeader('Content-Disposition', 'attachment; filename="' . basename($fileupload) . '"')
                    ->setBody($fileContent);
            } else {
                // File tidak ditemukan atau tidak dapat diakses
                return redirect()->to('/')->with('error', 'File tidak dapat diakses.');
            }
        } else {
            return redirect()->to('/')->with('error', 'File tidak ditemukan.');
        }
    }


    //aktifkan untuk tampil di OnePage
    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('informasi_id');
            $cari   = $this->layanan->find($id);

            $sts    = $cari['utm'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan layanan Utama!' : 'Berhasil Non Aktifkan layanan Utama!';

            $this->layanan->update($id, ['utm' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ]);
        }
    }


    public function duplikasipoling()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $informasi_id      = $this->request->getVar('informasi_id');
            $nama              = $this->request->getVar('nama');
            $datapoling        = $this->poling->list();
            $userid            = session()->get('id');
            // jika data ditemukan maka tampilkan
            if ($datapoling) {
                foreach ($datapoling as $a) {

                    $type           = $a['type'];
                    if ($type == 'Pertanyaan') {
                        $isipil = 'Bagaimanakah menurut Anda tentang layanan ' . $nama;
                    } else {
                        $isipil = $a['pilihan'];
                    }

                    $data = array(
                        "pilihan"           => $isipil,
                        "type"              => $type,
                        "rating"            => 0,
                        "status"            => $a['status'],
                        "id"                => $userid,
                        'informasi_id'      => $informasi_id,
                    );
                    $this->poling->insert($data);
                }

                $msg = [
                    'sukses'                => 'Data berhasil di duplikasi!',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {
                $msg = [
                    'nodata'                => 'Data tidak ditemukan',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            }
            // }
            // }
            echo json_encode($msg);
        }
    }

    public function poling($informasi_id = null)
    {
        if (session()->get('id') == '' || $informasi_id == '') {
            return redirect()->to('');
        }
        $tadmin             = $this->template->tempadminaktif();

        $data = [
            'title'           => 'Interaksi',
            'subtitle'        => 'Jajak Pendapat',
            'informasi_id'    => $informasi_id,
            'folder'          => esc($tadmin['folder']),
        ];
        return view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/poling/index', $data);
    }

    public function getpoling()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $informasi_id = $this->request->getVar('informasi_id');
            $id_grup      = session()->get('id_grup');
            $url          = 'layanan/all';

            $list         = $this->layanan->find($informasi_id);
            $listgrupf    = $this->grupakses->viewgrupakses($id_grup, $url);

            // Jika data layanan atau akses grup tidak ditemukan
            if (!$list || !$listgrupf) {
                return $this->jsonResponse('blmakses');
            }

            $akses = $listgrupf->akses;
            if (!in_array($akses, ['1', '2'])) {
                return $this->jsonResponse('noakses');
            }

            // Bangun data respons
            $data = $this->buildPolingData($list, $informasi_id, $listgrupf);
            $tadmin = $this->template->tempadminaktif();
            $view   = view('backend/' . esc($tadmin['folder']) . '/informasi/layanan/poling/list', $data);

            return $this->jsonResponse('data', $view);
        }
    }

    private function buildPolingData($list, $informasi_id, $listgrupf)
    {
        return [
            'title'     => 'Jajak Pendapat',
            'list'      => $this->poling->listpolinglay($informasi_id),
            'jumpol'    => $this->poling->selectSum('rating')->where(['type' => 'Jawaban', 'status' => 'Y', 'informasi_id' => $informasi_id])->first()['rating'] ?? 0,
            'jjawab'    => $this->poling->selectCount('rating')
                ->where(['type' => 'Jawaban', 'informasi_id' => $informasi_id])
                ->first()['rating'] ?? 0,
            'poljawab'  => $this->poling->poljawablay($informasi_id),
            'nama'      => esc($list['nama']),
            'akses'     => $listgrupf->akses,
            'hapus'     => $listgrupf->hapus,
            'ubah'      => $listgrupf->ubah,
            'tambah'    => $listgrupf->tambah,
        ];
    }

    private function jsonResponse($type, $data = [])
    {
        return $this->response->setJSON([$type => $data]);
    }

    public function formtambahpol()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $informasi_id    = $this->request->getVar('informasi_id');
            $data = [
                'title'                 => 'Tambah Jawaban',
                'informasi_id'          => $informasi_id,
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            $tadmin             = $this->template->tempadminaktif();

            $msg = [
                'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'informasi/layanan/poling/tambah', $data)

            ];
            echo json_encode($msg);
        }
    }

    public function simpanpoling()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pilihan' => [
                    'label' => 'Jawaban',
                    'rules' => 'required|is_unique[poling.pilihan]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pilihan' => $validation->getError('pilihan'),

                    ],
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {
                $userid = session()->get('id');
                $simpandata = [
                    'pilihan'           => $this->request->getVar('pilihan'),
                    'informasi_id'      => $this->request->getVar('informasi_id'),
                    'type'              => 'Jawaban',
                    'id'                => $userid
                ];

                $this->poling->insert($simpandata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    #
    public function formisipolinglayanan()
    {
        if ($this->request->isAJAX()) {
            $informasi_id = $this->request->getVar('informasi_id');
            $list         = $this->layanan->find($informasi_id);
            $tadmin       = $this->template->tempadminaktif();

            // Cek apakah polling untuk layanan ini sudah diisi
            $existing_layid = get_cookie("layid");
            $layid_array = $existing_layid ? json_decode($existing_layid, true) : [];
            if (!is_array($layid_array)) {
                $layid_array = [];
            }

            // Cek apakah `informasi_id` sudah diisi
            $is_poling_closed = in_array($informasi_id, $layid_array);

            // Ambil data polling
            $poltanya = $this->poling->poltanyalay($informasi_id);
            $poljawab = $this->poling->poljawablay($informasi_id);
            $jumpol   = $this->poling->selectSum('rating')
                ->where('type', 'Jawaban')
                ->where('status', 'Y')
                ->where('informasi_id', $informasi_id)
                ->first();

            // Siapkan data untuk tampilan modal
            $data = [
                'title'          => 'Vote Layanan',
                'informasi_id'   => $list['informasi_id'],
                'nama'           => $list['nama'],
                'poltanya'       => $poltanya['pilihan'],
                'polsts'         => $poltanya['status'],
                'poljawab'       => $poljawab,
                'jumpol'         => $jumpol['rating'],
                'is_poling_closed' => $is_poling_closed, // Tambahkan variabel ke data
            ];

            // Kirim response ke AJAX
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'modal/poling_layanan', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }


    public function formisipolinglayananas()
    {

        if ($this->request->isAJAX()) {
            $informasi_id   = $this->request->getVar('informasi_id');
            $list           = $this->layanan->find($informasi_id);
            $tadmin         = $this->template->tempadminaktif();

            $poltanya       = $this->poling->poltanyalay($informasi_id);
            $poljawab       = $this->poling->poljawablay($informasi_id);
            $jumpol         = $this->poling->selectSum('rating')->where('type', 'Jawaban')->where('status', 'Y')->where('informasi_id', $informasi_id)->first();
            $data = [
                'title'          => 'Vote Layanan',
                'informasi_id'   => $list['informasi_id'],
                'nama'           => $list['nama'],
                'poltanya'       => $poltanya['pilihan'],
                'polsts'         => $poltanya['status'],
                'poljawab'       => $poljawab,
                'jumpol'         => $jumpol['rating'],

            ];
            $msg = [
                'sukses'                => view('backend/' . esc($tadmin['folder']) . '/' . 'modal/poling_layanan', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    // publik isi poling

    public function ubahpoling()
    {
        $existing_layid = get_cookie("layid");
        $informasi_id = $this->request->getVar('informasi_id');
        // Decode cookie menjadi array
        $layid_array = $existing_layid ? json_decode($existing_layid, true) : [];

        // Pastikan hasil decoding adalah array
        if (!is_array($layid_array)) {
            $layid_array = [];
        }

        // Cek apakah `informasi_id` sudah diisi
        if (in_array($informasi_id, $layid_array)) {
            $is_poling_closed = true; // Polling sudah diisi
        } else {
            $is_poling_closed = false; // Polling belum diisi
        }

        // Jika request adalah pengisian polling
        if ($this->request->isAJAX()) {
            if ($is_poling_closed) {
                $msg = [
                    'gagal'                 => 'Anda sudah berpartisipasi untuk layanan ini..!',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {
                // Tambahkan `informasi_id` ke array cookie
                $layid_array[] = $informasi_id;

                // Simpan kembali cookie
                // set_cookie("layid", json_encode($layid_array), 43200, "/", "", false, true);
                set_cookie("layid", json_encode($layid_array), 43200);
                // set_cookie("layid",  $informasi_id, 43200);
                // Update polling data
                $poling_id = $this->request->getVar('poling_id');
                $listpol = $this->poling->find($poling_id);

                $data = [
                    'rating' => $listpol['rating'] + 1,
                ];
                $this->poling->update($poling_id, $data);

                $msg = [
                    'sukses' => 'Terima kasih atas partisipasi Anda mengikuti polling layanan kami',
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        } else {
            // Jika bukan AJAX, render halaman dengan data polling
            $data['is_poling_closed'] = $is_poling_closed;
            return view('polling_view', $data);
        }
    }
}
