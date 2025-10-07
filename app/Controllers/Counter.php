<?php

namespace App\Controllers;

class Counter extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin             = $this->template->tempadminaktif();
        $data = [
            'title'         => 'Counter',
            'subtitle'      => 'Data',
            'folder'      => $tadmin['folder'],
        ];
        return view('backend/' . $tadmin['folder'] . '/' . 'setkonten/counter/index', $data);
    }

    public function getdata()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'counter';

        // Ambil grup akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan, kirimkan pesan akses belum ada
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses dan cek akses
        $akses = $listgrupf->akses;

        // Jika akses tidak sesuai, kirimkan pesan noakses
        if ($akses != 1 && $akses != 2) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Counter Data',
            'list' => $this->counter->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Ambil template admin aktif
        $tadmin = $this->template->tempadminaktif();

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/setkonten/counter/list', $data)
        ];

        echo json_encode($msg);
    }

    // add menu
    public function formtambah()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title'             => 'Tambah Counter',
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            $tadmin             = $this->template->tempadminaktif();
            $msg = [
                'data' => view('backend/' . $tadmin['folder'] . '/' . 'setkonten/counter/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nm' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jm' => [
                    'label' => 'Jumlah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ic' => [
                    'label' => 'Icon',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nm' => $validation->getError('nm'),
                        'ic' => $validation->getError('ic'),
                        'jm'    => $validation->getError('jm'),
                    ],
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {
                $simpandata = [
                    'nm'     => $this->request->getVar('nm'),
                    'jm'     => $this->request->getVar('jm'),
                    'ic'     => $this->request->getVar('ic'),
                    'sumber'  => $this->request->getVar('sumber'),
                    'link'   => $this->request->getVar('link'),
                    'bgc'   => $this->request->getVar('bgc'),

                ];

                $this->counter->insert($simpandata);
                $msg = [
                    'sukses'                => 'Data berhasil disimpan',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
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
            $id_counter = $this->request->getVar('id_counter');
            $list       =  $this->counter->find($id_counter);
            $tadmin             = $this->template->tempadminaktif();

            $data = [
                'title'             => 'Edit Counter',
                'id_counter'        => $id_counter,
                'nm'                => $list['nm'],
                'jm'                => $list['jm'],
                'ic'                => $list['ic'],
                'sumber'            => $list['sumber'],
                'link'              => $list['link'],
                'bgc'               => $list['bgc'],

            ];
            $msg = [

                'sukses'                => view('backend/' . $tadmin['folder'] . '/' . 'setkonten/counter/edit', $data),
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nm' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'jm' => [
                    'label' => 'Jumlah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'ic' => [
                    'label' => 'Icon',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nm' => $validation->getError('nm'),
                        'ic' => $validation->getError('ic'),
                        'jm'    => $validation->getError('jm'),
                    ],
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
                ];
            } else {
                $updatedata = [

                    'nm'     => $this->request->getVar('nm'),
                    'jm'     => $this->request->getVar('jm'),
                    'ic'     => $this->request->getVar('ic'),
                    'sumber'  => $this->request->getVar('sumber'),
                    'link'   => $this->request->getVar('link'),
                    'bgc'   => $this->request->getVar('bgc'),


                ];

                $id_counter = $this->request->getVar('id_counter');
                $this->counter->update($id_counter, $updatedata);
                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsdatagoe'  => csrf_hash(),
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

            $id_counter = $this->request->getVar('id_counter');

            $this->counter->delete($id_counter);
            $msg = [
                'sukses'                => 'Data Berhasil Dihapus',
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    //publish dan unpublish
    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id     = $this->request->getVar('id_counter');
            $cari   = $this->counter->find($id);

            $sts    = $cari['sts'] == '1' ? 0 : 1;
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->counter->update($id, ['sts' => $sts]);

            echo json_encode([
                'sukses'                => $stsket,
                'csrf_tokencmsdatagoe'  => csrf_hash(),
            ]);
        }
    }
}
