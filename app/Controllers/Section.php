<?php

namespace App\Controllers;

class Section extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Setting',
            'subtitle' => 'Section',

        ];

        return view('backend/' . 'setkonten/section/index', $data);
    }

    public function getdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'section';


            // Ambil grup akses
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            // Cek jika grup akses tidak ditemukan
            if (!$listgrupf) {
                echo json_encode(['blmakses' => []]);
                return;
            }

            $akses = $listgrupf->akses;

            // Cek akses valid (1 atau 2)
            if (!in_array($akses, [1, 2])) {
                echo json_encode(['noakses' => []]);
                return;
            }

            // Ambil data section berdasarkan akses
            $list = $this->section->list();

            // Siapkan data untuk view
            $data = [
                'title' => 'Section',
                'list' => $list,
                'akses' => $akses,
                'hapus' => $listgrupf->hapus,
                'ubah' => $listgrupf->ubah,
                'tambah' => $listgrupf->tambah,
            ];

            // Kirimkan data melalui respons JSON
            $msg = [
                'data' => view("backend/setkonten/section/list", $data)
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

            $data = [
                'title' => 'Tambah Section',
                'kategoriberita' => $this->kategori->list(),
                'halaman' => $this->berita->listhalaman(),
                'modulpublic' => $this->modulpublic->listaktif(),
            ];
            $msg = [
                'data' => view('backend/' . 'setkonten/section/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function uploadfoto()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_section' => [
                    'label' => 'Nama Section',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'link' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'gambar' => [
                    'label' => 'Gambar section',
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
                        'nama_section' => $validation->getError('nama_section'),
                        'link' => $validation->getError('link'),
                        'gambar' => $validation->getError('gambar')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();
                $insertdata = [
                    'nama_section' => $this->request->getVar('nama_section'),
                    'link' => $this->request->getVar('link'),
                    'linksumber' => $this->request->getVar('linksumber'),
                    'gambar' => $nama_file,

                ];

                $this->section->insert($insertdata);
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit(300, 300, 'center')
                    ->save('public/img/section/' . $nama_file, 70);

                // $filegambar->move('public/img/section/', $nama_file); //folder gbr
                $msg = [
                    'sukses' => 'Gambar berhasil diupload!',
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
            $section_id = $this->request->getVar('section_id');
            $list = $this->section->find($section_id);

            $data = [
                'title' => 'Edit section',
                'section_id' => $list['section_id'],
                'nama_section' => esc($list['nama_section']),
                'link' => esc($list['link']),
                'linksumber' => $list['linksumber'],
                'gambar' => $list['gambar'],
                'kategoriberita' => $this->kategori->list(),
                'halaman' => $this->berita->listhalaman(),
                'modulpublic' => $this->modulpublic->listaktif(),
            ];
            $msg = [
                'sukses' => view('backend/' . 'setkonten/section/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function updatesection()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $section_id = $this->request->getVar('section_id');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_section' => [
                    'label' => 'Nama Section',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[gambar,2024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [

                        'max_size' => 'Ukuran {field} Maksimal 2024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ],
                'link' => [
                    'label' => 'Link',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'gambar' => $validation->getError('gambar'),
                        'link' => $validation->getError('link')

                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();
                //jika edit saja
                if ($filegambar->GetError() == 4) {
                    $data = [
                        'nama_section' => $this->request->getVar('nama_section'),
                        'link' => $this->request->getVar('link'),
                        'linksumber' => $this->request->getVar('linksumber'),
                    ];

                    $this->section->update($section_id, $data);
                    $msg = [
                        'sukses' => 'Data berhasil diubah!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {

                    //check
                    $cekdata = $this->section->find($section_id);
                    $fotolama = $cekdata['gambar'];
                    if ($fotolama != 'default.png' && file_exists('public/img/section/' . $fotolama)) {
                        unlink('public/img/section/' . $fotolama);
                    }

                    $updatedata = [
                        'nama_section' => $this->request->getVar('nama_section'),
                        'link' => $this->request->getVar('link'),
                        'linksumber' => $this->request->getVar('linksumber'),
                        'gambar' => $nama_file
                    ];

                    $this->section->update($section_id, $updatedata);

                    \Config\Services::image()
                        ->withFile($filegambar)
                        ->fit(300, 300, 'center')
                        ->save('public/img/section/' . $nama_file, 70);
                    // $filegambar->move('public/img/section/', $nama_file); //folder foto

                    $msg = [
                        'sukses' => 'section berhasil diganti!',
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

            $id = $this->request->getVar('section_id');
            //check
            $cekdata = $this->section->find($id);
            $fotolama = $cekdata['gambar'];
            if ($fotolama != 'default.png' && file_exists('public/img/section/' . $fotolama)) {
                unlink('public/img/section/' . $fotolama);
            }
            $this->section->delete($id);
            $msg = [
                'sukses' => 'Data Section berhasil dihapus.',
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
            $id = $this->request->getVar('section_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check gbr
                $cekdata = $this->section->find($id[$i]);
                $fotolama = $cekdata['gambar'];

                if ($fotolama != 'default.png' && file_exists('public/img/section/' . $fotolama)) {
                    unlink('public/img/section/' . $fotolama);
                }

                $this->section->delete($id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data section berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }
}
