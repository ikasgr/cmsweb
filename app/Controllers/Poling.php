<?php

namespace App\Controllers;

class Poling extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }


        $data = [
            'title' => 'Interaksi',
            'subtitle' => 'Jajak Pendapat',

        ];
        return view('backend/' . 'interaksi/poling/index', $data);
    }

    public function getdata()
    {
        // Cek apakah session dan request AJAX valid
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'poling';

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

        // Cek akses yang valid
        if ($akses != 1 && $akses != 2) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Ambil total rating untuk jenis 'Jawaban' dengan status 'Y'
        $jumpol = $this->poling->selectSum('rating')->where('type', 'Jawaban')->where('status', 'Y')->where('informasi_id', 0)->first();

        // Ambil template admin aktif


        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Jajak Pendapat',
            'list' => $this->poling->list(),
            'jumpol' => $jumpol['rating'] ?? 0, // Pastikan rating tersedia
            'poljawab' => $this->poling->poljawab(),
            'akses' => $akses,
            'hapus' => $hapus,
            'ubah' => $ubah,
            'tambah' => $tambah,
        ];

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/interaksi/poling/list', $data)
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
                'title' => 'Tambah Jawaban',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];


            $msg = [
                'data' => view('backend/' . 'interaksi/poling/tambah', $data)

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
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $userid = session()->get('id');
                $simpandata = [
                    'pilihan' => $this->request->getVar('pilihan'),
                    'type' => 'Jawaban',
                    'id' => $userid
                ];

                $this->poling->insert($simpandata);
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
        if ($this->request->isAJAX()) {
            $poling_id = $this->request->getVar('poling_id');
            $list = $this->poling->find($poling_id);


            $data = [
                'title' => 'Edit Data',
                'poling_id' => $list['poling_id'],
                'pilihan' => $list['pilihan'],
                'jenis' => $list['type'],
                'rating' => $list['rating']
            ];
            $msg = [
                'sukses' => view('backend/' . 'interaksi/poling/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatepoling()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pilihan' => [
                    'label' => 'Pilihan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pilihan' => $validation->getError('pilihan'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $updatedata = [
                    'pilihan' => $this->request->getVar('pilihan'),
                    'rating' => $this->request->getVar('rating'),
                ];

                $poling_id = $this->request->getVar('poling_id');
                $this->poling->update($poling_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function ubahpoling()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $poling_id = $this->request->getVar('poling_id');
            $listpol = $this->poling->find($poling_id);

            if (get_cookie("poling") != 'isipoling') {
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'poling_id' => [
                        'label' => 'Pilihan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
                ]);
                if (!$valid) {
                    $msg = [
                        'error' => [
                            'poling_id' => $validation->getError('poling_id'),
                        ],
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {

                    $data = [
                        'rating' => $listpol['rating'] + 1
                    ];
                    $this->poling->update($poling_id, $data);

                    // set_cookie("poling", "isipoling", 86400); 1 hari
                    set_cookie("poling", "isipoling", 43200);

                    $msg = [
                        'sukses' => 'Terima kasih atas partisipasi anda mengikuti polling kami',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                }
            } else {
                $msg = [
                    'gagal' => 'Anda sudah berpartisipasi..!',
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

            $poling_id = $this->request->getVar('poling_id');

            $this->poling->delete($poling_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function lihatpoling()
    {
        if ($this->request->isAJAX()) {

            $jumpol = $this->poling->selectSum('rating')->where('type', 'Jawaban')->where('status', 'Y')->where('informasi_id', 0)->first();



            $data = [
                'title' => 'Hasil Jajak Pendapat',
                'poljawab' => $this->poling->list(),
                'jumpol' => $jumpol['rating'],

            ];
            $msg = [
                'data' => view('backend/' . 'modal/lihatpoling', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $cari = $this->poling->find($id);

            $sts = $cari['status'] == 'Y' ? 'N' : 'Y';
            $stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

            $this->poling->update($id, ['status' => $sts]);

            echo json_encode([
                'sukses' => $stsket,
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
        }
    }
}





