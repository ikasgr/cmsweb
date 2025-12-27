<?php

namespace App\Controllers;

class ManajemenJemaat extends BaseController
{
    // Backend - List data jemaat
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Manajemen Jemaat',
            'subtitle' => 'Data Anggota Jemaat',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/manajemen_jemaat/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'manajemen-jemaat/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Manajemen Jemaat',
                        'list' => $this->jemaat->list(),
                        'akses' => $akses,
                        'statistik' => $this->jemaat->getStatistik()
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/manajemen_jemaat/list', $data)
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

    // Backend - Form lihat detail
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $id_jemaat = $this->request->getVar('id_jemaat');
            $list = $this->jemaat->find($id_jemaat);

            $data = [
                'title' => 'Detail Data Jemaat',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/manajemen_jemaat/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_jemaat = $this->request->getVar('id_jemaat');
            $list = $this->jemaat->find($id_jemaat);

            $data = [
                'title' => 'Edit Data Jemaat',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/manajemen_jemaat/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_jemaat = $this->request->getVar('id_jemaat');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_anggota' => [
                    'label' => 'Nomor Anggota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'alamat_lengkap' => [
                    'label' => 'Alamat Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_bergabung' => [
                    'label' => 'Tanggal Bergabung',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'no_anggota' => $validation->getError('no_anggota'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'alamat_lengkap' => $validation->getError('alamat_lengkap'),
                        'tgl_bergabung' => $validation->getError('tgl_bergabung'),
                    ]
                ];
            } else {
                // Cek nomor anggota duplikat
                if ($this->jemaat->isNoAnggotaExists($this->request->getVar('no_anggota'), $id_jemaat)) {
                    $msg = [
                        'error' => [
                            'no_anggota' => 'Nomor anggota sudah digunakan!'
                        ]
                    ];
                } else {
                    $updatedata = [
                        'no_anggota' => $this->request->getVar('no_anggota'),
                        'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                        'nama_panggilan' => $this->request->getVar('nama_panggilan'),
                        'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                        'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                        'alamat_lengkap' => $this->request->getVar('alamat_lengkap'),
                        'rt_rw' => $this->request->getVar('rt_rw'),
                        'kelurahan' => $this->request->getVar('kelurahan'),
                        'kecamatan' => $this->request->getVar('kecamatan'),
                        'kota' => $this->request->getVar('kota'),
                        'kode_pos' => $this->request->getVar('kode_pos'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'email' => $this->request->getVar('email'),
                        'pekerjaan' => $this->request->getVar('pekerjaan'),
                        'pendidikan' => $this->request->getVar('pendidikan'),
                        'status_pernikahan' => $this->request->getVar('status_pernikahan'),
                        'nama_ayah' => $this->request->getVar('nama_ayah'),
                        'nama_ibu' => $this->request->getVar('nama_ibu'),
                        'nama_pasangan' => $this->request->getVar('nama_pasangan'),
                        'tgl_baptis' => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                        'tempat_baptis' => $this->request->getVar('tempat_baptis'),
                        'pendeta_baptis' => $this->request->getVar('pendeta_baptis'),
                        'tgl_sidi' => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                        'tempat_sidi' => $this->request->getVar('tempat_sidi'),
                        'pendeta_sidi' => $this->request->getVar('pendeta_sidi'),
                        'tgl_nikah' => $this->request->getVar('tgl_nikah') ? date('Y-m-d', strtotime($this->request->getVar('tgl_nikah'))) : null,
                        'tempat_nikah' => $this->request->getVar('tempat_nikah'),
                        'pendeta_nikah' => $this->request->getVar('pendeta_nikah'),
                        'status_keanggotaan' => $this->request->getVar('status_keanggotaan'),
                        'tgl_bergabung' => date('Y-m-d', strtotime($this->request->getVar('tgl_bergabung'))),
                        'tgl_pindah' => $this->request->getVar('tgl_pindah') ? date('Y-m-d', strtotime($this->request->getVar('tgl_pindah'))) : null,
                        'tgl_meninggal' => $this->request->getVar('tgl_meninggal') ? date('Y-m-d', strtotime($this->request->getVar('tgl_meninggal'))) : null,
                        'gereja_asal' => $this->request->getVar('gereja_asal'),
                        'gereja_tujuan' => $this->request->getVar('gereja_tujuan'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];

                    $this->jemaat->update($id_jemaat, $updatedata);

                    $msg = [
                        'sukses' => 'Data jemaat berhasil diubah!'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    // Backend - Form tambah
    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Data Jemaat',
                'no_anggota_baru' => $this->jemaat->generateNoAnggota()
            ];
            $msg = [
                'data' => view('backend/cmscust/manajemen_jemaat/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan data baru
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_lengkap' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_anggota' => [
                    'label' => 'Nomor Anggota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'alamat_lengkap' => [
                    'label' => 'Alamat Lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tgl_bergabung' => [
                    'label' => 'Tanggal Bergabung',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_lengkap' => $validation->getError('nama_lengkap'),
                        'no_anggota' => $validation->getError('no_anggota'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'alamat_lengkap' => $validation->getError('alamat_lengkap'),
                        'tgl_bergabung' => $validation->getError('tgl_bergabung'),
                    ]
                ];
            } else {
                // Cek nomor anggota duplikat
                if ($this->jemaat->isNoAnggotaExists($this->request->getVar('no_anggota'))) {
                    $msg = [
                        'error' => [
                            'no_anggota' => 'Nomor anggota sudah digunakan!'
                        ]
                    ];
                } else {
                    $insertdata = [
                        'no_anggota' => $this->request->getVar('no_anggota'),
                        'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                        'nama_panggilan' => $this->request->getVar('nama_panggilan'),
                        'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                        'tgl_lahir' => date('Y-m-d', strtotime($this->request->getVar('tgl_lahir'))),
                        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                        'alamat_lengkap' => $this->request->getVar('alamat_lengkap'),
                        'rt_rw' => $this->request->getVar('rt_rw'),
                        'kelurahan' => $this->request->getVar('kelurahan'),
                        'kecamatan' => $this->request->getVar('kecamatan'),
                        'kota' => $this->request->getVar('kota'),
                        'kode_pos' => $this->request->getVar('kode_pos'),
                        'no_hp' => $this->request->getVar('no_hp'),
                        'email' => $this->request->getVar('email'),
                        'pekerjaan' => $this->request->getVar('pekerjaan'),
                        'pendidikan' => $this->request->getVar('pendidikan'),
                        'status_pernikahan' => $this->request->getVar('status_pernikahan'),
                        'nama_ayah' => $this->request->getVar('nama_ayah'),
                        'nama_ibu' => $this->request->getVar('nama_ibu'),
                        'nama_pasangan' => $this->request->getVar('nama_pasangan'),
                        'tgl_baptis' => $this->request->getVar('tgl_baptis') ? date('Y-m-d', strtotime($this->request->getVar('tgl_baptis'))) : null,
                        'tempat_baptis' => $this->request->getVar('tempat_baptis'),
                        'pendeta_baptis' => $this->request->getVar('pendeta_baptis'),
                        'tgl_sidi' => $this->request->getVar('tgl_sidi') ? date('Y-m-d', strtotime($this->request->getVar('tgl_sidi'))) : null,
                        'tempat_sidi' => $this->request->getVar('tempat_sidi'),
                        'pendeta_sidi' => $this->request->getVar('pendeta_sidi'),
                        'tgl_nikah' => $this->request->getVar('tgl_nikah') ? date('Y-m-d', strtotime($this->request->getVar('tgl_nikah'))) : null,
                        'tempat_nikah' => $this->request->getVar('tempat_nikah'),
                        'pendeta_nikah' => $this->request->getVar('pendeta_nikah'),
                        'status_keanggotaan' => $this->request->getVar('status_keanggotaan') ?: 'Aktif',
                        'tgl_bergabung' => date('Y-m-d', strtotime($this->request->getVar('tgl_bergabung'))),
                        'tgl_pindah' => $this->request->getVar('tgl_pindah') ? date('Y-m-d', strtotime($this->request->getVar('tgl_pindah'))) : null,
                        'tgl_meninggal' => $this->request->getVar('tgl_meninggal') ? date('Y-m-d', strtotime($this->request->getVar('tgl_meninggal'))) : null,
                        'gereja_asal' => $this->request->getVar('gereja_asal'),
                        'gereja_tujuan' => $this->request->getVar('gereja_tujuan'),
                        'keterangan' => $this->request->getVar('keterangan'),
                    ];

                    $this->jemaat->insert($insertdata);

                    $msg = [
                        'sukses' => 'Data jemaat berhasil disimpan!'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus data
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_jemaat = $this->request->getVar('id_jemaat');
            $cekdata = $this->jemaat->find($id_jemaat);

            // Hapus foto jika ada
            if (!empty($cekdata['foto']) && file_exists('public/file/foto/jemaat/' . $cekdata['foto'])) {
                unlink('public/file/foto/jemaat/' . $cekdata['foto']);
            }

            $this->jemaat->delete($id_jemaat);
            $msg = [
                'sukses' => 'Data jemaat berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple data
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_jemaat = $this->request->getVar('id_jemaat');
            $jmldata = count($id_jemaat);

            for ($i = 0; $i < $jmldata; $i++) {
                $cekdata = $this->jemaat->find($id_jemaat[$i]);

                // Hapus foto jika ada
                if (!empty($cekdata['foto']) && file_exists('public/file/foto/jemaat/' . $cekdata['foto'])) {
                    unlink('public/file/foto/jemaat/' . $cekdata['foto']);
                }

                $this->jemaat->delete($id_jemaat[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data jemaat berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Toggle status keanggotaan
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_jemaat');
            $status = $this->request->getVar('status');
            $tanggal = $this->request->getVar('tanggal');
            $keterangan = $this->request->getVar('keterangan');

            $this->jemaat->updateStatus($id, $status, $tanggal, $keterangan);

            $msg = [
                'sukses' => 'Status keanggotaan berhasil diubah menjadi: ' . $status
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Form upload foto
    public function formupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_jemaat');
            $list = $this->jemaat->find($id);

            $data = [
                'title' => 'Upload Foto Jemaat',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/manajemen_jemaat/upload', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan upload foto
    public function simpanupload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_jemaat');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'foto' => [
                    'label' => 'Foto',
                    'rules' => 'uploaded[foto]|max_size[foto,2048]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih foto',
                        'max_size' => 'Ukuran foto maksimal 2 MB',
                        'mime_in' => 'Format foto harus PNG, JPG, atau JPEG'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'foto' => $validation->getError('foto')
                    ]
                ];
            } else {
                $cekdata = $this->jemaat->find($id);
                $fotolama = $cekdata['foto'];

                // Hapus foto lama jika ada
                if ($fotolama != '' && file_exists('public/file/foto/jemaat/' . $fotolama)) {
                    unlink('public/file/foto/jemaat/' . $fotolama);
                }

                $file = $this->request->getFile('foto');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    'foto' => $nama_file
                ];

                $this->jemaat->update($id, $updatedata);
                $file->move('public/file/foto/jemaat/', $nama_file);

                $msg = [
                    'sukses' => 'Foto berhasil diupload!',
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus foto
    public function hapusfoto()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_jemaat');

            $cekdata = $this->jemaat->find($id);
            $foto = $cekdata['foto'];

            if ($foto != '' && file_exists('public/file/foto/jemaat/' . $foto)) {
                unlink('public/file/foto/jemaat/' . $foto);
            }

            $updatedata = [
                'foto' => ''
            ];

            $this->jemaat->update($id, $updatedata);

            $msg = [
                'sukses' => 'Foto berhasil dihapus'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Cari jemaat
    public function cari()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getVar('keyword');
            $hasil = $this->jemaat->cariJemaat($keyword);

            $data = [
                'title' => 'Hasil Pencarian: ' . $keyword,
                'list' => $hasil,
                'keyword' => $keyword
            ];
            $msg = [
                'data' => view('backend/cmscust/manajemen_jemaat/hasil_cari', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Dashboard statistik
    public function dashboard()
    {
        if ($this->request->isAJAX()) {
            $statistik = $this->jemaat->getStatistik();
            $jenisKelamin = $this->jemaat->getByJenisKelamin();
            $kelompokUmur = $this->jemaat->getByKelompokUmur();
            $ulangTahun = $this->jemaat->getUlangTahunBulanIni();
            $jemaatBaru = $this->jemaat->getJemaatBaru();

            $data = [
                'statistik' => $statistik,
                'jenis_kelamin' => $jenisKelamin,
                'kelompok_umur' => $kelompokUmur,
                'ulang_tahun' => $ulangTahun,
                'jemaat_baru' => $jemaatBaru
            ];
            $msg = [
                'data' => view('backend/cmscust/manajemen_jemaat/dashboard', $data)
            ];
            echo json_encode($msg);
        }
    }
}
