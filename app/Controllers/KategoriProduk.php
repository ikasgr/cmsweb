<?php

namespace App\Controllers;

class KategoriProduk extends BaseController
{
    // Backend - List kategori
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Kategori Produk',
            'subtitle' => 'Manajemen Kategori',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/kategori_produk/index', $data);
    }

    // Backend - Get data
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'kategori-produk/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Kategori Produk',
                        'list' => $this->kategoriproduk->list(),
                        'akses' => $akses
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/kategori_produk/list', $data)
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

    // Backend - Form tambah
    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kategori'
            ];
            $msg = [
                'data' => view('backend/cmscust/kategori_produk/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan kategori
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori' => $validation->getError('nama_kategori')
                    ]
                ];
            } else {
                // Generate slug
                $slug = url_title($this->request->getVar('nama_kategori'), '-', true);

                $insertdata = [
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'slug_kategori' => $slug,
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'urutan' => $this->request->getVar('urutan'),
                    'status' => $this->request->getVar('status'),
                ];

                $this->kategoriproduk->insert($insertdata);

                $msg = [
                    'sukses' => 'Kategori berhasil ditambahkan!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $kategori_id = $this->request->getVar('kategori_id');
            $list = $this->kategoriproduk->find($kategori_id);

            $data = [
                'title' => 'Edit Kategori',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/kategori_produk/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update kategori
    public function update()
    {
        if ($this->request->isAJAX()) {
            $kategori_id = $this->request->getVar('kategori_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori' => $validation->getError('nama_kategori')
                    ]
                ];
            } else {
                // Generate slug
                $slug = url_title($this->request->getVar('nama_kategori'), '-', true);

                $updatedata = [
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'slug_kategori' => $slug,
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'urutan' => $this->request->getVar('urutan'),
                    'status' => $this->request->getVar('status'),
                ];

                $this->kategoriproduk->update($kategori_id, $updatedata);

                $msg = [
                    'sukses' => 'Kategori berhasil diupdate!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus kategori
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $kategori_id = $this->request->getVar('kategori_id');

            $this->kategoriproduk->delete($kategori_id);

            $msg = [
                'sukses' => 'Kategori berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple kategori
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $jmldata = count($id);

            foreach ($id as $i) {
                $this->kategoriproduk->delete($i);
            }

            $msg = [
                'sukses' => "$jmldata Kategori berhasil dihapus!"
            ];

            echo json_encode($msg);
        }
    }
}





