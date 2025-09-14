<?php

namespace App\Controllers;

class Bankdata extends BaseController
{
    public function index()
    {

        $konfigurasi        = $this->konfigurasi->vkonfig();
        $template           = $this->template->tempaktif();
        $bankdata                 = $this->bankdata->listbankdatapage();
        $data = [
            'title'         => 'Bank Data',
            'deskripsi'     => $konfigurasi->deskripsi,
            'url'           => $konfigurasi->website,
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            // new temp
            'bankdata'          => $bankdata->paginate(6, 'hal'),
            'pager'             => $bankdata->pager,
            'list'          => $this->bankdata->listbankdata(),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'kategori'      => $this->kategori->list(),
            'banner'        => $this->banner->list(),
            'infografis'    => $this->banner->listinfo(),
            'infografis1'   => $this->banner->listinfo1(),
            'agenda'        => $this->agenda->listagendapage()->paginate(4),
            'section'       => $this->section->list(),
            'linkterkaitall'    => $this->linkterkait->publishlinkall(),
            'infografis10'    => $this->banner->listinfopage()->paginate(10),
            'kategori'      => $this->kategori->list(),
            'grafisrandom'         => $this->banner->grafisrandom(),
            'terkini3'       => $this->berita->terkini3(),
            'folder'        => $template['folder'],

        ];
        if ($template['duatema'] == 1) {
            $agent = $this->request->getUserAgent();
            if ($agent->isMobile()) {
                return view('frontend/' . $template['folder'] . '/mobile/' . 'content/semua_bankdata', $data);
            } else {
                return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_bankdata', $data);
            }
        } else {
            return view('frontend/' . $template['folder'] . '/desktop/' . 'content/semua_bankdata', $data);
        }
    }

    //list semua bankdata
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin = $this->template->tempadminaktif();
        $data = [
            'title'     => 'Informasi',
            'subtitle'  => 'Bank Data',
            'folder'    =>  $tadmin['folder'],

        ];
        return view('backend/' . $tadmin['folder'] . '/' . 'informasi/bankdata/index', $data);
    }

    public function getdata($id = null)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $id = session()->get('id');
            $url = 'bankdata/all';

            // Ambil akses grup
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            // Cek jika grup akses tidak ditemukan
            if (!$listgrupf) {
                echo json_encode(['blmakses' => []]);
                return;
            }

            $akses = $listgrupf->akses;

            // Tentukan daftar berdasarkan akses
            $list = ($akses == 1)
                ? $this->bankdata->listbankdata()
                : ($akses == 2 ? $this->bankdata->listbankdataauthor($id) : null);

            // Jika tidak ada akses yang valid
            if (!in_array($akses, [1, 2])) {
                echo json_encode(['noakses' => []]);
                return;
            }

            // Siapkan data untuk view
            $tadminFolder = $this->template->tempadminaktif()['folder'];
            $data = [
                'title' => 'Bank Data',
                'list' => $list,
                'akses' => $akses,
                'hapus' => $listgrupf->hapus,
                'ubah' => $listgrupf->ubah,
                'tambah' => $listgrupf->tambah,
            ];

            // Kirimkan data melalui respons JSON
            $msg = [
                'data' => view("backend/$tadminFolder/informasi/bankdata/list", $data)
            ];

            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title' => 'Tambah Bank Data',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            $msg = [
                'data' => view('backend/' . $tadmin['folder'] . '/' . 'informasi/bankdata/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanBankData()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $ukuran = 50000;
            $valid = $this->validate([
                'nama_bankdata' => [
                    'label' => 'Judul',
                    'rules' => 'required|is_unique[bankdata.nama_bankdata]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'fileupload' => [
                    'label' => 'file',
                    'rules' => [
                        'uploaded[fileupload]',
                        'mime_in[fileupload,image/jpg,image/jpeg,image/gif,image/png,application/pdf,application/doc,application/docx,application/xls,application/xlsx,application/ppt,application/pptx,text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                        'max_size[fileupload,' . $ukuran . ']',
                    ],
                    'errors' => [
                        'uploaded' => 'Silahkan Masukkan file',
                        'max_size' => 'Ukuran {field} Maksimal ' . $ukuran . ' KB..!!',
                        'mime_in' => 'Format {field} tidak valid..!!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bankdata'  => $validation->getError('nama_bankdata'),
                        'fileupload'     => $validation->getError('fileupload'),

                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $userid = session()->get('id');
                $dtfileupload = $this->request->getFile('fileupload');
                // $file = $this->request->getFile('file');
                $nama_file = $dtfileupload->getRandomName();
                $ext = $dtfileupload->getClientExtension();
                if ($ext == 'php' || $ext == 'js') {
                    $msg = [
                        'nofile' => 'File tidak diijinkan!'
                    ];
                } else {

                    if ($dtfileupload->isValid() && !$dtfileupload->hasMoved()) {

                        $dtfileupload->move(ROOTPATH . 'public/unduh/bankdata/', $nama_file); //folder gambar
                        $insertdata = [
                            'nama_bankdata' => $this->request->getVar('nama_bankdata'),
                            'slug_bank'     => mb_url_title($this->request->getVar('nama_bankdata'), '-', TRUE),
                            'fileupload'    => $nama_file,
                            'tgl_upload'    => date('Y-m-d'),
                            'id'            => $userid,
                            'hits'          => '0'
                        ];
                        $this->bankdata->insert($insertdata);
                    }

                    $msg = [
                        'sukses' => 'Bank data berhasil disimpan!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
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

            $id = $this->request->getVar('bankdata_id');
            //check
            $cekdata = $this->bankdata->find($id);
            $filelama = $cekdata['fileupload'];
            if ($filelama != '' && file_exists('public/unduh/bankdata/' . $filelama)) {
                unlink('public/unduh/bankdata/' . $filelama);
            }
            $this->bankdata->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),

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
            $id = $this->request->getVar('bankdata_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->bankdata->find($id[$i]);
                $filelama = $cekdata['fileupload'];
                if ($filelama != '' && file_exists('public/unduh/bankdata/' . $filelama)) {
                    unlink('public/unduh/bankdata/' . $filelama);
                }
                $this->bankdata->delete($id[$i]);
            }

            $msg = [
                'sukses'                => "$jmldata Data berhasil dihapus",
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

            $bankdata_id = $this->request->getVar('bankdata_id');
            $list =  $this->bankdata->find($bankdata_id);
            // $size_mb = $list['fileupload']->getSize('mb'); // 
            $tadmin = $this->template->tempadminaktif();

            $data = [
                'title'          => 'Edit Data',
                'bankdata_id'    => $list['bankdata_id'],
                'nama_bankdata'  => $list['nama_bankdata'],
                'ket'            => $list['ket'],

            ];
            $msg = [
                'sukses' => view('backend/' . $tadmin['folder'] . '/' . 'informasi/bankdata/edit', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),

            ];
            echo json_encode($msg);
        }
    }

    public function updatebankdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $bankdata_id = $this->request->getVar('bankdata_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama_bankdata' => [
                    'label' => 'Nama File',
                    'rules' => 'required[bankdata.nama_bankdata]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_bankdata'           => $validation->getError('nama_bankdata'),
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {

                $updatedata = [

                    'nama_bankdata' => $this->request->getVar('nama_bankdata'),
                    'slug_bank'     => mb_url_title($this->request->getVar('nama_bankdata'), '-', TRUE),

                ];

                $this->bankdata->update($bankdata_id, $updatedata);

                $msg = [
                    'sukses'                => 'Data berhasil diubah!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formuploadfile()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('bankdata_id');
            $list =  $this->bankdata->find($id);
            $tadmin = $this->template->tempadminaktif();

            $data = [
                'title'       => 'Upload File',
                'id'          => $list['bankdata_id'],
                'fileupload'   => $list['fileupload']

            ];
            $msg = [
                'sukses' => view('backend/' . $tadmin['folder'] . '/' . 'informasi/bankdata/gantifile', $data),
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    //simpan fileunduh
    public function douploadbankdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('bankdata_id');
            $validation = \Config\Services::validation();
            $ukuran = 50000;
            $valid = $this->validate([
                'fileupload' => [
                    'label' => 'File unduhan',
                    'rules' => [
                        'uploaded[fileupload]',
                        'mime_in[fileupload,image/jpg,image/jpeg,image/gif,image/png,application/pdf,application/doc,application/docx,application/xls,application/xlsx,application/ppt,application/pptx,text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                        'max_size[fileupload,' . $ukuran . ']',
                    ],
                    'errors' => [
                        'uploaded' => 'Silahkan Masukkan file',
                        'max_size' => 'Ukuran {field} Maksimal ' . $ukuran . ' KB..!!',
                        'mime_in' => 'Format {field} tidak valid..!! '
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'fileupload' => $validation->getError('fileupload')
                    ],
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {

                $fileunduhan = $this->request->getFile('fileupload');
                $nama_file = $fileunduhan->getRandomName();

                $ext = $fileunduhan->getClientExtension();
                if ($ext == 'php' || $ext == 'js') {
                    $msg = [
                        'nofile' => 'File tidak diijinkan!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                } else {

                    //check
                    $cekdata = $this->bankdata->find($id);
                    $filelama = $cekdata['fileupload'];

                    if ($filelama != '' && file_exists('public/unduh/bankdata/' . $filelama)) {
                        unlink('public/unduh/bankdata/' . $filelama);
                    }

                    if ($fileunduhan->isValid() && !$fileunduhan->hasMoved()) {

                        $fileunduhan->move(ROOTPATH . 'public/unduh/bankdata/', $nama_file); //folder gambar
                        $updatedata = [
                            'fileupload' => $nama_file
                        ];
                        $this->bankdata->update($id, $updatedata);
                    }

                    $msg = [
                        'sukses'                => 'File berhasil diupload!',
                        'csrf_tokencmsikasmedia'  => csrf_hash(),
                    ];
                }
            }
            echo json_encode($msg);
        }
    }


    //frontend
    public function getbankdata()
    {
        if ($this->request->isAJAX()) {

            $bankdata_id = $this->request->getVar('bankdata_id');
            $list =  $this->bankdata->find($bankdata_id);
            $data = [
                'hits'        => $list['hits'] + 1
            ];
            $this->bankdata->update($list['bankdata_id'], $data);
            $msg = [
                // 'data' => view('content/semua_bankdata', $data)
            ];
            echo json_encode($msg);
        }
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
}
