<?php

namespace App\Controllers;

class Unitkerja extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Kelola Data',
            'subtitle' => 'Unit Kerja',


        ];
        return view('backend/' . 'setkonten/unitkerja/index', $data);
    }

    public function getdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_grup = session()->get('id_grup');
            $url = 'unitkerja';

            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            $akses = $listgrupf->akses;
            $hapus = $listgrupf->hapus;
            $ubah = $listgrupf->ubah;
            $tambah = $listgrupf->tambah;
            // jika temukan maka eksekusi
            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Unit Kerja',
                        'list' => $this->unitkerja->listopd(),
                        'akses' => $akses,
                        'hapus' => $hapus,
                        'ubah' => $ubah,
                        'tambah' => $tambah,
                    ];
                    $msg = [
                        'data' => view('backend/' . 'setkonten/unitkerja/list', $data)
                    ];
                } else {
                    $msg = [
                        'noakses' => []
                    ];
                }
            } else {

                $msg = [
                    'blmakses' => []
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Unit Kerja',
                'tipe' => $this->unitkerjatipe->list()
            ];
            $msg = [
                'data' => view('backend/' . 'setkonten/unitkerja/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_opd' => [
                    'label' => 'Nama Unit Kerja',
                    'rules' => 'required|is_unique[custome__opd.nama_opd]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],

                'tipe_id' => [
                    'label' => 'Tipe Unit Kerja ',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}',
                    ]
                ],
                'deskripsi_opd' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'singkatan_opd' => [
                    'label' => 'Singkatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_opd' => $validation->getError('nama_opd'),
                        'tipe_id' => $validation->getError('tipe_id'),
                        'singkatan_opd' => $validation->getError('singkatan_opd'),
                        'alamat' => $validation->getError('alamat'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
            } else {

                $insertdata = [
                    'nama_opd' => $this->request->getVar('nama_opd'),
                    'deskripsi_opd' => $this->request->getVar('deskripsi_opd'),
                    'tipe_id' => $this->request->getVar('tipe_id'),
                    'singkatan_opd' => $this->request->getVar('singkatan_opd'),
                    'alamat' => $this->request->getVar('alamat'),

                ];
                $this->unitkerja->insert($insertdata);
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

            $id = $this->request->getVar('opd_id');

            $this->unitkerja->delete($id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
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
            $id = $this->request->getVar('opd_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {

                $this->unitkerja->delete($id[$i]);
            }
            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus",
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

            $opd_id = $this->request->getVar('opd_id');
            $list = $this->unitkerja->find($opd_id);

            $data = [
                'title' => 'Edit Unit Kerja',
                'opd_id' => $list['opd_id'],
                'nama_opd' => $list['nama_opd'],
                'deskripsi_opd' => $list['deskripsi_opd'],
                'tipe_id' => $list['tipe_id'],
                'singkatan_opd' => $list['singkatan_opd'],
                'alamat' => $list['alamat'],
                'tipe' => $this->unitkerjatipe->list(),
            ];
            $msg = [
                'sukses' => view('backend/' . 'setkonten/unitkerja/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatepenerbit()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $opd_id = $this->request->getVar('opd_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([

                'nama_opd' => [
                    'label' => 'Nama Unit Kerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        // 'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'deskripsi_opd' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'singkatan_opd' => [
                    'label' => 'Singkatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_opd' => $validation->getError('nama_opd'),
                        'deskripsi_opd' => $validation->getError('deskripsi_opd'),
                        'tipe_id' => $validation->getError('tipe_id'),
                        'singkatan_opd' => $validation->getError('singkatan_opd'),
                        'alamat' => $validation->getError('alamat'),

                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $updatedata = [

                    'nama_opd' => $this->request->getVar('nama_opd'),
                    'deskripsi_opd' => $this->request->getVar('deskripsi_opd'),
                    'tipe_id' => $this->request->getVar('tipe_id'),
                    'singkatan_opd' => $this->request->getVar('singkatan_opd'),
                    'alamat' => $this->request->getVar('alamat'),

                ];
                $this->unitkerja->update($opd_id, $updatedata);
                $msg = [
                    'sukses' => 'Data penerbit berhasil diubah!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    //Start tipe (backend)
    public function tipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Kelola Data',
            'subtitle' => 'Tipe',

        ];
        return view('backend/' . 'setkonten/unitkerja/tipe/index', $data);
    }

    public function gettipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'unitkerja';

            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            $akses = $listgrupf->akses;
            $hapus = $listgrupf->hapus;
            $ubah = $listgrupf->ubah;
            $tambah = $listgrupf->tambah;
            // jika temukan maka eksekusi
            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Unit Kerja',
                        'list' => $this->unitkerjatipe->list(),
                        'akses' => $akses,
                        'hapus' => $hapus,
                        'ubah' => $ubah,
                        'tambah' => $tambah,
                    ];
                    $msg = [
                        'data' => view('backend/' . 'setkonten/unitkerja/tipe/list', $data)
                    ];
                } else {
                    $msg = [
                        'noakses' => []
                    ];
                }
            } else {

                $msg = [
                    'blmakses' => []
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formtipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $data = [
                'title' => 'Tambah Tipe'
            ];
            $msg = [
                'data' => view('backend/' . 'setkonten/unitkerja/tipe/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpantipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tipe' => [
                    'label' => 'Tipe',
                    'rules' => 'required|is_unique[custome__opdtipe.nama_tipe]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tipe' => $validation->getError('nama_tipe'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nama_tipe' => $this->request->getVar('nama_tipe'),
                ];

                $this->unitkerjatipe->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedittipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tipe_id = $this->request->getVar('tipe_id');
            $list = $this->unitkerjatipe->find($tipe_id);

            $data = [
                'title' => 'Edit Tipe',
                'tipe_id' => $list['tipe_id'],
                'nama_tipe' => esc($list['nama_tipe']),
            ];
            $msg = [
                'sukses' => view('backend/' . 'setkonten/unitkerja/tipe/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatetipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tipe' => [
                    'label' => 'Jenjang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tipe' => $validation->getError('nama_tipe'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'nama_tipe' => $this->request->getVar('nama_tipe'),
                ];

                $tipe_id = $this->request->getVar('tipe_id');
                $this->unitkerjatipe->update($tipe_id, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapustipe()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tipe_id = $this->request->getVar('tipe_id');
            $this->unitkerjatipe->delete($tipe_id);
            $msg = [
                'sukses' => 'Tipe Penerbit Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
}
