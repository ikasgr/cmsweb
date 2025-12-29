<?php

namespace App\Controllers;

class Pengumuman extends BaseController
{
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $pengumuman = $this->pengumuman->listpengumumanpage();

        $data = [
            'title' => 'Pengumuman | ' . $konfigurasi->nama,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'pengumuman' => $pengumuman->paginate(6, 'hal'),
            'pager' => $pengumuman->pager,
            'jum' => $this->pengumuman->totpengumuman(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'infografis10' => $this->banner->listinfopage()->paginate(10),
            'kategori' => $this->kategori->list(),
            'grafisrandom' => $this->banner->grafisrandom(),
            'terkini3' => $this->berita->terkini3(),
        ];

        return view('frontend/pengumuman/index', $data);
    }

    //list semua pengumuman
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Informasi',
            'subtitle' => 'Pengumuman',


        ];
        return view('backend/' . 'informasi/pengumuman/index', $data);
    }

    public function getdata()
    {
        // Cek session dan request AJAX hanya sekali
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $id_user = session()->get('id');
        $url = 'pengumuman/all';

        // Ambil grup akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan atau akses tidak sesuai
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses
        $akses = $listgrupf->akses;

        // Tentukan list pengumuman berdasarkan akses
        if ($akses == 1) {
            $list = $this->pengumuman->listpengumuman();
        } elseif ($akses == 2) {
            $list = $this->pengumuman->listpengumumanauthor($id_user);
        } else {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan

        $data = [
            'title' => 'Pengumuman',
            'list' => $list,
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/informasi/pengumuman/list', $data)
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
                'title' => 'Tambah Pengumuman',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            $msg = [
                'data' => view('backend/' . 'informasi/pengumuman/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanPengumuman()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Pengumuman',
                    'rules' => 'required|is_unique[informasi.nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

                'isi_informasi' => [
                    'label' => 'Deskripsi Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'gambar' => [
                    'label' => 'cover pengumuman',
                    'rules' => 'max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [
                        // 'uploaded' => 'Silahkan Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'isi_informasi' => $validation->getError('isi_informasi'),
                        'gambar' => $validation->getError('gambar')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $userid = session()->get('id');
                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();

                //jika gambar tidak ada
                if ($filegambar->GetError() == 4) {

                    $insertdata = [
                        'nama' => $this->request->getVar('nama'),
                        'slug_informasi' => mb_url_title($this->request->getVar('nama'), '-', TRUE),
                        'isi_informasi' => $this->request->getVar('isi_informasi'),
                        'tgl_informasi' => date('Y-m-d'),
                        'gambar' => 'default.png',
                        'id' => $userid,
                        'type' => '1',
                        'hits' => '0'
                    ];
                    $this->pengumuman->insert($insertdata);
                    $msg = [
                        'sukses' => 'Pengumuman berhasil disimpan!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {

                    $insertdata = [
                        'nama' => $this->request->getVar('nama'),
                        'slug_informasi' => mb_url_title($this->request->getVar('nama'), '-', TRUE),
                        'isi_informasi' => $this->request->getVar('isi_informasi'),
                        'tgl_informasi' => date('Y-m-d'),
                        'gambar' => $nama_file,
                        'id' => $userid,
                        'type' => '1',
                        'hits' => '0'
                    ];

                    $this->pengumuman->insert($insertdata);
                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->save('public/img/informasi/pengumuman/' . $nama_file, 70);


                    $msg = [
                        'sukses' => 'Pengumuman berhasil disimpan!',
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

            $id = $this->request->getVar('informasi_id');
            //check
            $cekdata = $this->pengumuman->find($id);
            $fotolama = $cekdata['gambar'];
            $filelama = $cekdata['fileunduh'];

            if ($fotolama != 'default.png' && file_exists('public/img/informasi/pengumuman/' . $fotolama)) {
                unlink('public/img/informasi/pengumuman/' . $fotolama);
            }
            if ($filelama != '' && file_exists('public/unduh/pengumuman/' . $filelama)) {
                unlink('public/unduh/pengumuman/' . $filelama);
            }

            $this->pengumuman->delete($id);
            $msg = [
                'sukses' => 'Data Pengumuman Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusfile()
    {
        if (!session()->get('id')) {
            return redirect()->to('/');
        }

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('informasi_id');
            $cekdata = $this->pengumuman->find($id);

            if (!$cekdata) {
                $msg = [
                    'error' => 'Data tidak ditemukan.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
                return;
            }

            $filelama = $cekdata['fileunduh'];
            $filepath = FCPATH . 'public/unduh/pengumuman/' . $filelama;

            if (!empty($filelama) && file_exists($filepath)) {
                if (!unlink($filepath)) {
                    $msg = [
                        'error' => 'Gagal menghapus file. Silakan coba lagi.',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                    echo json_encode($msg);
                    return;
                }
            }

            $updatedata = ['fileunduh' => ''];

            if ($this->pengumuman->update($id, $updatedata)) {
                $msg = [
                    'sukses' => 'File berhasil dihapus.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $msg = [
                    'error' => 'Gagal memperbarui data file.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }

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
                $cekdata = $this->pengumuman->find($id[$i]);
                $fotolama = $cekdata['gambar'];
                $filelama = $cekdata['fileunduh'];

                if ($fotolama != 'default.png' && file_exists('public/img/informasi/pengumuman/' . $fotolama)) {
                    unlink('public/img/informasi/pengumuman/' . $fotolama);
                }
                if ($filelama != '' && file_exists('public/unduh/pengumuman/' . $filelama)) {
                    unlink('public/unduh/pengumuman/' . $filelama);
                }

                $this->pengumuman->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data pengumuman berhasil dihapus",
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

            $informasi_id = $this->request->getVar('informasi_id');
            $list = $this->pengumuman->find($informasi_id);

            $data = [
                'title' => 'Edit Pengumuman',
                'informasi_id' => $list['informasi_id'],
                'nama' => $list['nama'],
                'isi_informasi' => $list['isi_informasi']

            ];
            $msg = [
                'sukses' => view('backend/' . 'informasi/pengumuman/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatepengumuman()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $informasi_id = $this->request->getVar('informasi_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama' => [
                    'label' => 'Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],

                'isi_informasi' => [
                    'label' => 'Deskripsi Pengumuman',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'isi_informasi' => $validation->getError('isi_informasi'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $updatedata = [

                    'nama' => $this->request->getVar('nama'),
                    'slug_informasi' => mb_url_title($this->request->getVar('nama'), '-', TRUE),
                    'isi_informasi' => $this->request->getVar('isi_informasi'),
                ];
                $this->pengumuman->update($informasi_id, $updatedata);
                $msg = [
                    'sukses' => 'Data pengumuman berhasil diubah!',
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
            $id = $this->request->getVar('informasi_id');
            $list = $this->pengumuman->find($id);

            $data = [
                'title' => 'Ganti Cover',
                'id' => $list['informasi_id'],
                'gambar' => $list['gambar']
            ];
            $msg = [
                'sukses' => view('backend/' . 'informasi/pengumuman/gantifoto', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function douploadPengumuman()
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
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->pengumuman->find($id);
                $fotolama = $cekdata['gambar'];

                if ($fotolama != 'default.png' && file_exists('public/img/informasi/pengumuman/' . $fotolama)) {
                    unlink('public/img/informasi/pengumuman/' . $fotolama);
                }


                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();

                $updatedata = [
                    'gambar' => $nama_file
                ];

                $this->pengumuman->update($id, $updatedata);
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/informasi/pengumuman/' . $nama_file, 70);

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
            $list = $this->pengumuman->find($id);

            $data = [
                'title' => 'File Unduhan',
                'id' => $list['informasi_id'],
                'gambar' => $list['gambar'],
                'fileunduh' => $list['fileunduh']
            ];
            $msg = [
                'sukses' => view('backend/' . 'informasi/pengumuman/uploadfile', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
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
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                //check
                $cekdata = $this->pengumuman->find($id);
                $filelama = $cekdata['fileunduh'];

                if ($filelama != '' && file_exists('public/unduh/pengumuman/' . $filelama)) {
                    unlink('public/unduh/pengumuman/' . $filelama);
                }

                $fileunduhan = $this->request->getFile('fileunduh');
                $nama_file = $fileunduhan->getRandomName();

                if ($fileunduhan->isValid() && !$fileunduhan->hasMoved()) {

                    $fileunduhan->move(ROOTPATH . 'public/unduh/pengumuman/', $nama_file);
                    $updatedata = [
                        'fileunduh' => $nama_file
                    ];
                    $this->pengumuman->update($id, $updatedata);
                }

                $msg = [
                    'sukses' => 'File berhasil diupload!',
                ];
            }
            echo json_encode($msg);
        }
    }

    //lihat detail pengumuman front end
    public function formlihatpengumuman()
    {
        if ($this->request->isAJAX()) {
            $informasi_id = $this->request->getVar('informasi_id');
            $list = $this->pengumuman->find($informasi_id);

            // Update hits
            $data = [
                'hits' => $list['hits'] + 1
            ];
            $this->pengumuman->update($list['informasi_id'], $data);

            $data = [
                'title' => 'Detail Pengumuman',
                'informasi_id' => $list['informasi_id'],
                'nama' => $list['nama'],
                'isi_informasi' => $list['isi_informasi'],
                'tgl_informasi' => $list['tgl_informasi'],
                'gambar' => $list['gambar'],
                'fileunduh' => $list['fileunduh'],
                // 'folder'          => $template['folder']
            ];
            $msg = [
                'sukses' => view('backend/' . 'modal/v_pengumuman', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    # detail front
    public function bacapengumuman($informasi_id = null)
    {
        if (!isset($informasi_id))
            return redirect()->to('/');

        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->detail_halaman($informasi_id);
        $list = $this->pengumuman->detailpengumuman($informasi_id);

        $kategori = $this->kategori->list();
        if ($list) {

            // Update hits
            $datahit = [
                'hits' => $list->hits + 1
            ];
            // $informasi
            $this->pengumuman->update($informasi_id, $datahit);

            $judulpengumuman = esc($list->nama);
            $isi_informasi = $list->isi_informasi;
            $tgl_informasi = date_indo($list->tgl_informasi);
            $gambar = $list->gambar;
            $fileunduh = $list->fileunduh;
            $fullname = $list->fullname;
            $hits = $list->hits;

            $data = [
                'title' => ($judulpengumuman),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => base_url('baca-pengumuman/' . $informasi_id),
                'img' => base_url('/public/img/informasi/pengumuman/' . $gambar),

                'konfigurasi' => $konfigurasi,
                'berita' => $berita,
                'informasi_id' => $informasi_id,
                'nama' => $judulpengumuman,
                'isi_informasi' => $isi_informasi,
                'tgl_informasi' => $tgl_informasi,
                'fileunduh' => $fileunduh,
                'fullname' => $fullname,
                'hits' => $hits,

                'beritapopuler' => $this->berita->populer()->paginate(8),
                'populer3' => $this->berita->populer()->paginate(3),
                'terkini3' => $this->berita->terkini3(),

                'pengumumanlain' => $this->pengumuman->pengumumanlain($informasi_id),
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),
                'iklankanan1' => $this->banner->listiklankanan1(),
            ];

            return view('frontend/pengumuman/detail', $data);
        } else {
            return redirect()->to('/');
        }
    }
}





