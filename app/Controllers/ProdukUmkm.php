<?php

namespace App\Controllers;

class ProdukUmkm extends BaseController
{
    // Backend - List produk
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title'     => 'Produk UMKM',
            'subtitle'  => 'Manajemen Produk',
        ];
        return view('backend/morvin/cmscust/produk_umkm/index', $data);
    }

    // Backend - Get data
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'produk-umkm/list';
            $listgrupf =  $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data) :
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title'     => 'Produk UMKM',
                        'list'      => $this->produkumkm->list(),
                        'akses'     => $akses
                    ];
                    $msg = [
                        'data' => view('backend/morvin/cmscust/produk_umkm/list', $data)
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
                'title' => 'Tambah Produk',
                'kategori' => $this->kategoriproduk->listaktif()
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/produk_umkm/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan produk
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_produk' => [
                    'label' => 'Nama Produk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'kategori_id' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'harga' => [
                    'label' => 'Harga',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'numeric' => '{field} harus berupa angka!',
                    ]
                ],
                'stok' => [
                    'label' => 'Stok',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'numeric' => '{field} harus berupa angka!',
                    ]
                ],
                'gambar' => [
                    'label' => 'Gambar Produk',
                    'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih {field}',
                        'max_size' => 'Ukuran {field} maksimal 2 MB',
                        'mime_in' => 'Format {field} harus PNG, JPG, atau JPEG'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_produk'   => $validation->getError('nama_produk'),
                        'kategori_id'   => $validation->getError('kategori_id'),
                        'harga'         => $validation->getError('harga'),
                        'stok'          => $validation->getError('stok'),
                        'gambar'        => $validation->getError('gambar'),
                    ]
                ];
            } else {
                $file = $this->request->getFile('gambar');
                $nama_file = $file->getRandomName();

                // Generate slug
                $slug = url_title($this->request->getVar('nama_produk'), '-', true);

                $insertdata = [
                    'nama_produk'   => $this->request->getVar('nama_produk'),
                    'slug_produk'   => $slug,
                    'kategori_id'   => $this->request->getVar('kategori_id'),
                    'deskripsi'     => $this->request->getVar('deskripsi'),
                    'harga'         => $this->request->getVar('harga'),
                    'harga_promo'   => $this->request->getVar('harga_promo'),
                    'stok'          => $this->request->getVar('stok'),
                    'berat'         => $this->request->getVar('berat'),
                    'satuan'        => $this->request->getVar('satuan'),
                    'gambar'        => $nama_file,
                    'status'        => $this->request->getVar('status'),
                    'featured'      => $this->request->getVar('featured'),
                    'tgl_input'     => date('Y-m-d H:i:s'),
                    'user_id'       => session()->get('id'),
                ];

                $this->produkumkm->insert($insertdata);
                
                // Upload gambar
                \Config\Services::image()
                    ->withFile($file)
                    ->resize(800, 800, true, 'height')
                    ->save('public/img/produk/' . $nama_file, 80);

                $msg = [
                    'sukses' => 'Produk berhasil ditambahkan!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $list =  $this->produkumkm->find($id_produk);

            $data = [
                'title' => 'Edit Produk',
                'data'  => $list,
                'kategori' => $this->kategoriproduk->listaktif()
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/produk_umkm/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update produk
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_produk' => [
                    'label' => 'Nama Produk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'harga' => [
                    'label' => 'Harga',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'numeric' => '{field} harus berupa angka!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_produk'   => $validation->getError('nama_produk'),
                        'harga'         => $validation->getError('harga'),
                    ]
                ];
            } else {
                // Generate slug
                $slug = url_title($this->request->getVar('nama_produk'), '-', true);

                $updatedata = [
                    'nama_produk'   => $this->request->getVar('nama_produk'),
                    'slug_produk'   => $slug,
                    'kategori_id'   => $this->request->getVar('kategori_id'),
                    'deskripsi'     => $this->request->getVar('deskripsi'),
                    'harga'         => $this->request->getVar('harga'),
                    'harga_promo'   => $this->request->getVar('harga_promo'),
                    'stok'          => $this->request->getVar('stok'),
                    'berat'         => $this->request->getVar('berat'),
                    'satuan'        => $this->request->getVar('satuan'),
                    'status'        => $this->request->getVar('status'),
                    'featured'      => $this->request->getVar('featured'),
                ];

                $this->produkumkm->update($id_produk, $updatedata);

                $msg = [
                    'sukses' => 'Produk berhasil diupdate!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus produk
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $cekdata = $this->produkumkm->find($id_produk);

            // Hapus gambar
            if (!empty($cekdata['gambar']) && file_exists('public/img/produk/' . $cekdata['gambar'])) {
                unlink('public/img/produk/' . $cekdata['gambar']);
            }

            $this->produkumkm->delete($id_produk);
            $msg = [
                'sukses' => 'Produk berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Ganti gambar
    public function gantigambar()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'uploaded[gambar]|max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih {field}',
                        'max_size' => 'Ukuran {field} maksimal 2 MB',
                        'mime_in' => 'Format {field} harus PNG, JPG, atau JPEG'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'gambar' => $validation->getError('gambar')
                    ]
                ];
            } else {
                $cekdata = $this->produkumkm->find($id_produk);
                $filelama = $cekdata['gambar'];

                // Hapus gambar lama
                if ($filelama != '' && file_exists('public/img/produk/' . $filelama)) {
                    unlink('public/img/produk/' . $filelama);
                }

                $file = $this->request->getFile('gambar');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    'gambar' => $nama_file
                ];

                $this->produkumkm->update($id_produk, $updatedata);
                
                // Upload gambar baru
                \Config\Services::image()
                    ->withFile($file)
                    ->resize(800, 800, true, 'height')
                    ->save('public/img/produk/' . $nama_file, 80);

                $msg = [
                    'sukses' => 'Gambar berhasil diupdate!',
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Toggle status
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_produk');
            $status = $this->request->getVar('status');

            $updatedata = [
                'status' => $status,
            ];
            $this->produkumkm->update($id, $updatedata);
            
            $msg = [
                'sukses' => 'Status berhasil diubah!'
            ];

            echo json_encode($msg);
        }
    }
}
