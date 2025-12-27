<?php

namespace App\Controllers;

class Masterdata extends BaseController
{
    public function index()
    {

        if (!session()->get('id')) {
            return redirect()->to('');
        }


        $uri = service('uri');
        $request = $uri->getSegment(1);

        // Array untuk konfigurasi berdasarkan $request
        $config = [
            'm-kategorifaq' => [
                'jns' => 1,
                'url' => 'm-kategorifaq',
                'jdl' => 'Kategori FAQ',
                'toltip' => 'Jumlah Kategori digunakan',
                'stsm' => 'kat_faq',
                'nmbscontrol' => 'faqtanya',
            ],
            'm-pekerjaan' => [
                'jns' => 2,
                'url' => 'm-pekerjaan',
                'jdl' => 'Pekerjaan',
                'toltip' => 'Jumlah Master pekerjaan digunakan',
                'stsm' => 'id_pekerjaan',
                'nmbscontrol' => 'responden',
            ],
            'm-pendidikan' => [
                'jns' => 3,
                'url' => 'm-pendidikan',
                'jdl' => 'Pendidikan',
                'toltip' => 'Jumlah Master pendidikan digunakan',
                'stsm' => 'id_pendidikan',
                'nmbscontrol' => 'responden',
            ],
        ];

        // Jika request tidak ditemukan dalam array, set default values
        $dataConfig = $config[$request] ?? [
            'jns' => null,
            'url' => '',
            'jdl' => '-',
            'toltip' => '',
            'stsm' => '',
            'nmbscontrol' => '-',
        ];

        // Menyusun data yang akan diteruskan ke view
        $data = [
            'title' => 'Data',
            'subtitle' => $dataConfig['jdl'],
            'reqs' => $request,
            'jns' => $dataConfig['jns'],
            'stsm' => $dataConfig['stsm'],
            'url' => $dataConfig['url'],
            'nmbscontrol' => $dataConfig['nmbscontrol'],
            'toltip' => $dataConfig['toltip'],

        ];

        // Menampilkan view dengan data yang telah diproses
        return view('backend/' . 'cmscust/master/index', $data);
    }

    public function getdata()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        // Ambil data dari request
        $request = $this->request->getVar('req');
        $jdl = $this->request->getVar('jdl');
        $jns = $this->request->getVar('jns');
        $url = $this->request->getVar('url');
        $toltip = $this->request->getVar('toltip');
        $stsm = $this->request->getVar('stsm');
        $nmbscontrol = $this->request->getVar('nmbscontrol');
        $id_grup = session()->get('id_grup');

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan dan cek akses
        if (!$listgrupf || !in_array($listgrupf->akses, ['1', '2'])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan
        $data = [
            'list' => $this->masterdata->listmaster($jns),
            'akses' => $listgrupf->akses,
            'tambah' => $listgrupf->tambah,
            'ubah' => $listgrupf->ubah,
            'hapus' => $listgrupf->hapus,
            'req' => $request,
            'jns' => $jns,
            'jdl' => $jdl,
            'stsm' => $stsm,
            'nmbscontrol' => $this->$nmbscontrol,  // Cek apakah ini valid
            'toltip' => $toltip,
        ];

        // Ambil template admin aktif


        $msg = [
            'data' => view('backend/cmscust/master/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if (!$this->request->isAJAX()) {
            return;
        }

        $data = [
            'title' => 'Tambah Data',
            'req' => $this->request->getVar('req'),
            'jns' => $this->request->getVar('jns'),
            'jdl' => $this->request->getVar('jdl'),
        ];

        echo json_encode([
            'data' => view('backend/cmscust/master/tambah', $data)
        ]);
    }


    public function simpandata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_master' => [
                    'label' => 'Nama',
                    'rules' => 'required|is_unique[custome__masterdata.nama_master]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_master' => $validation->getError('nama_master'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $jns = $this->request->getVar('jns_master');

                $simpandata = [
                    'nama_master' => $this->request->getVar('nama_master'),
                    'slug_master' => mb_url_title($this->request->getVar('nama_master'), '-', TRUE),
                    'jns_master' => $jns,
                    'sts_master' => 1,

                ];

                $this->masterdata->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
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

        // Proses jika request adalah AJAX
        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, langsung keluar
        }

        $id_masterdata = $this->request->getVar('id_masterdata');
        $request = $this->request->getVar('req');
        $list = $this->masterdata->find($id_masterdata);

        if (!$list) {
            return; // Jika data tidak ditemukan, langsung keluar
        }


        $data = [
            'title' => 'Edit Data',
            'id_masterdata' => $list['id_masterdata'],
            'nama_master' => $list['nama_master'],
            'req' => $request,
            'jdl' => $this->request->getVar('jdl'),
        ];

        echo json_encode([
            'sukses' => view('backend/cmscust/master/edit', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }


    public function updatedata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_master' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_master' => $validation->getError('nama_master'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $id_masterdata = $this->request->getVar('id_masterdata');

                $updatedata = [
                    'nama_master' => $this->request->getVar('nama_master'),
                    'slug_master' => mb_url_title($this->request->getVar('nama_master'), '-', TRUE),
                ];

                $this->masterdata->update($id_masterdata, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_masterdata = $this->request->getVar('id_masterdata');
            // cek
            $cekdata = $this->masterdata->find($id_masterdata);
            $filelama = esc($cekdata['image_master']);

            if ($filelama != '' && file_exists('public/img/master/' . $filelama)) {
                unlink('public/img/master/' . $filelama);
            }
            $this->masterdata->delete($id_masterdata);

            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    // upload image

    public function formuploadfoto()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, langsung keluar
        }

        $id = $this->request->getVar('id_masterdata');
        $list = $this->masterdata->find($id);

        if (!$list) {
            return; // Jika data tidak ditemukan, langsung keluar
        }


        $data = [
            'title' => 'Upload Foto',
            'id' => $id,
            'image_master' => $list['image_master'],
            'nama_master' => $list['nama_master'],
        ];

        echo json_encode([
            'sukses' => view('backend/cmscust/master/gantifile', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    public function douploadfoto()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'image_master' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[image_master]|max_size[image_master,1024]|mime_in[image_master,image/png,image/jpg,image/jpeg,image/gif]|is_image[image_master]',
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
                        'image_master' => $validation->getError('image_master')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                //check file lama
                $id = $this->request->getVar('id_masterdata');
                $cekdata = $this->masterdata->find($id);
                $filelama = $cekdata['image_master'];

                if ($filelama != '' && file_exists('public/img/master/' . $filelama)) {
                    unlink('public/img/master/' . $filelama);
                }
                $filefoto = $this->request->getFile('image_master');
                $nama_file = $filefoto->getRandomName();
                $updatedata = [
                    'image_master' => $nama_file
                ];

                $this->masterdata->update($id, $updatedata);
                \Config\Services::image()
                    ->withFile($filefoto)
                    // ->fit(215, 220, 'center')
                    ->save('public/img/master/' . $nama_file, 90);

                $msg = [
                    'sukses' => 'File berhasil diupload!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    //publish dan unpublish
    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, langsung keluar
        }
        $id = $this->request->getVar('id_masterdata');
        $cari = $this->masterdata->find($id);

        if (!$cari) {
            return;
        }
        $sts = ($cari['sts_master'] == '1') ? 0 : 1;
        $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';
        $this->masterdata->update($id, ['sts_master' => $sts]);
        echo json_encode([
            'sukses' => $stsket,
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }
}
