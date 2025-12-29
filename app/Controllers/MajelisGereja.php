<?php

namespace App\Controllers;

class MajelisGereja extends BaseController
{
    // Backend - List data majelis
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Majelis Gereja',
            'subtitle' => 'Data Majelis & Pelayan Gereja',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/majelis_gereja/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'majelis-gereja/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Majelis Gereja',
                        'list' => $this->majelisgereja->list(),
                        'akses' => $akses,
                        'statistik' => $this->majelisgereja->getStatistics()
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/majelis_gereja/list', $data)
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
                'title' => 'Tambah Data Majelis',
                'jabatan_list' => $this->jabatanmajelis->listAktif(),
                'komisi_list' => $this->komisimajelis->listAktif()
            ];
            $msg = [
                'data' => view('backend/cmscust/majelis_gereja/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan data
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'jenis_jabatan' => [
                    'label' => 'Jenis Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'status_jabatan' => [
                    'label' => 'Status Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'gambar' => [
                    'label' => 'Foto',
                    'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => '{field} maksimal 2 MB',
                        'is_image' => 'File harus berupa gambar',
                        'mime_in' => 'Format file harus JPG, JPEG, atau PNG'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'jenis_jabatan' => $validation->getError('jenis_jabatan'),
                        'status_jabatan' => $validation->getError('status_jabatan'),
                        'gambar' => $validation->getError('gambar')
                    ]
                ];
            } else {
                // Upload foto
                $foto = $this->request->getFile('gambar');
                $nama_foto = '';

                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    $nama_foto = $foto->getRandomName();
                    $foto->move('public/img/informasi/majelis/', $nama_foto);
                }

                // Upload file SK
                $file_sk = $this->request->getFile('file_sk_pengangkatan');
                $nama_sk = '';

                if ($file_sk && $file_sk->isValid() && !$file_sk->hasMoved()) {
                    $nama_sk = $file_sk->getRandomName();
                    $file_sk->move('public/img/informasi/majelis/', $nama_sk);
                }

                // Upload file sertifikat
                $file_sertifikat = $this->request->getFile('file_sertifikat');
                $nama_sertifikat = '';

                if ($file_sertifikat && $file_sertifikat->isValid() && !$file_sertifikat->hasMoved()) {
                    $nama_sertifikat = $file_sertifikat->getRandomName();
                    $file_sertifikat->move('public/img/informasi/majelis/', $nama_sertifikat);
                }

                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'nip' => $this->request->getVar('nip'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jk' => $this->request->getVar('jk'),
                    'agama' => $this->request->getVar('agama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'jenis_jabatan' => $this->request->getVar('jenis_jabatan'),
                    'jabatan_id' => $this->request->getVar('jabatan_id'),
                    'tanggal_penahbisan' => $this->request->getVar('tanggal_penahbisan'),
                    'tanggal_pelantikan' => $this->request->getVar('tanggal_pelantikan'),
                    'tanggal_akhir_jabatan' => $this->request->getVar('tanggal_akhir_jabatan'),
                    'status_jabatan' => $this->request->getVar('status_jabatan'),
                    'gereja_asal' => $this->request->getVar('gereja_asal'),
                    'pendidikan_teologi' => $this->request->getVar('pendidikan_teologi'),
                    'sertifikasi' => $this->request->getVar('sertifikasi'),
                    'komisi' => $this->request->getVar('komisi'),
                    'gambar' => $nama_foto,
                    'file_sk_pengangkatan' => $nama_sk,
                    'file_sertifikat' => $nama_sertifikat
                ];

                $this->majelisgereja->insert($data);

                $msg = [
                    'sukses' => 'Data berhasil disimpan!'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Backend - Form lihat detail
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $list = $this->majelisgereja->getMajelisWithDetails($majelis_id);

            $data = [
                'title' => 'Detail Data Majelis',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/majelis_gereja/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $list = $this->majelisgereja->find($majelis_id);

            $data = [
                'title' => 'Edit Data Majelis',
                'data' => $list,
                'jabatan_list' => $this->jabatanmajelis->listAktif(),
                'komisi_list' => $this->komisimajelis->listAktif()
            ];
            $msg = [
                'sukses' => view('backend/cmscust/majelis_gereja/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'jenis_jabatan' => [
                    'label' => 'Jenis Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'gambar' => [
                    'label' => 'Foto',
                    'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => '{field} maksimal 2 MB',
                        'is_image' => 'File harus berupa gambar',
                        'mime_in' => 'Format file harus JPG, JPEG, atau PNG'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'jenis_jabatan' => $validation->getError('jenis_jabatan'),
                        'gambar' => $validation->getError('gambar')
                    ]
                ];
            } else {
                $majelis = $this->majelisgereja->find($majelis_id);

                // Upload foto baru
                $foto = $this->request->getFile('gambar');
                $nama_foto = $majelis['gambar'];

                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    // Hapus foto lama
                    if ($majelis['gambar'] && file_exists('public/img/informasi/majelis/' . $majelis['gambar'])) {
                        unlink('public/img/informasi/majelis/' . $majelis['gambar']);
                    }
                    $nama_foto = $foto->getRandomName();
                    $foto->move('public/img/informasi/majelis/', $nama_foto);
                }

                // Upload file SK baru
                $file_sk = $this->request->getFile('file_sk_pengangkatan');
                $nama_sk = $majelis['file_sk_pengangkatan'];

                if ($file_sk && $file_sk->isValid() && !$file_sk->hasMoved()) {
                    // Hapus file lama
                    if ($majelis['file_sk_pengangkatan'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan'])) {
                        unlink('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan']);
                    }
                    $nama_sk = $file_sk->getRandomName();
                    $file_sk->move('public/img/informasi/majelis/', $nama_sk);
                }

                // Upload file sertifikat baru
                $file_sertifikat = $this->request->getFile('file_sertifikat');
                $nama_sertifikat = $majelis['file_sertifikat'];

                if ($file_sertifikat && $file_sertifikat->isValid() && !$file_sertifikat->hasMoved()) {
                    // Hapus file lama
                    if ($majelis['file_sertifikat'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sertifikat'])) {
                        unlink('public/img/informasi/majelis/' . $majelis['file_sertifikat']);
                    }
                    $nama_sertifikat = $file_sertifikat->getRandomName();
                    $file_sertifikat->move('public/img/informasi/majelis/', $nama_sertifikat);
                }

                $data = [
                    'nama' => $this->request->getVar('nama'),
                    'nip' => $this->request->getVar('nip'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jk' => $this->request->getVar('jk'),
                    'agama' => $this->request->getVar('agama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'email' => $this->request->getVar('email'),
                    'jenis_jabatan' => $this->request->getVar('jenis_jabatan'),
                    'jabatan_id' => $this->request->getVar('jabatan_id'),
                    'tanggal_penahbisan' => $this->request->getVar('tanggal_penahbisan'),
                    'tanggal_pelantikan' => $this->request->getVar('tanggal_pelantikan'),
                    'tanggal_akhir_jabatan' => $this->request->getVar('tanggal_akhir_jabatan'),
                    'status_jabatan' => $this->request->getVar('status_jabatan'),
                    'gereja_asal' => $this->request->getVar('gereja_asal'),
                    'pendidikan_teologi' => $this->request->getVar('pendidikan_teologi'),
                    'sertifikasi' => $this->request->getVar('sertifikasi'),
                    'komisi' => $this->request->getVar('komisi'),
                    'gambar' => $nama_foto,
                    'file_sk_pengangkatan' => $nama_sk,
                    'file_sertifikat' => $nama_sertifikat
                ];

                $this->majelisgereja->update($majelis_id, $data);

                $msg = [
                    'sukses' => 'Data berhasil diupdate!'
                ];
            }

            echo json_encode($msg);
        }
    }

    // Backend - Hapus data
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $majelis = $this->majelisgereja->find($majelis_id);

            // Hapus file foto
            if ($majelis['gambar'] && file_exists('public/img/informasi/majelis/' . $majelis['gambar'])) {
                unlink('public/img/informasi/majelis/' . $majelis['gambar']);
            }

            // Hapus file SK
            if ($majelis['file_sk_pengangkatan'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan'])) {
                unlink('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan']);
            }

            // Hapus file sertifikat
            if ($majelis['file_sertifikat'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sertifikat'])) {
                unlink('public/img/informasi/majelis/' . $majelis['file_sertifikat']);
            }

            $this->majelisgereja->delete($majelis_id);

            $msg = [
                'sukses' => 'Data berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $jmldata = count($majelis_id);

            for ($i = 0; $i < $jmldata; $i++) {
                $majelis = $this->majelisgereja->find($majelis_id[$i]);

                // Hapus file foto
                if ($majelis['gambar'] && file_exists('public/img/informasi/majelis/' . $majelis['gambar'])) {
                    unlink('public/img/informasi/majelis/' . $majelis['gambar']);
                }

                // Hapus file SK
                if ($majelis['file_sk_pengangkatan'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan'])) {
                    unlink('public/img/informasi/majelis/' . $majelis['file_sk_pengangkatan']);
                }

                // Hapus file sertifikat
                if ($majelis['file_sertifikat'] && file_exists('public/img/informasi/majelis/' . $majelis['file_sertifikat'])) {
                    unlink('public/img/informasi/majelis/' . $majelis['file_sertifikat']);
                }

                $this->majelisgereja->delete($majelis_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus!"
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Toggle status
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $majelis_id = $this->request->getVar('majelis_id');
            $status = $this->request->getVar('status');

            $this->majelisgereja->updateStatus($majelis_id, $status);

            $msg = [
                'sukses' => 'Status berhasil diubah!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Dashboard
    public function dashboard()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $stats = $this->majelisgereja->getStatistics();
        $expiring = $this->majelisgereja->getExpiringTerms(30);
        $anniversary = $this->majelisgereja->getUpcomingAnniversary(30);

        $data = [
            'title' => 'Dashboard Majelis Gereja',
            'subtitle' => 'Statistik & Informasi',
            'folder' => 'morvin',
            'stats' => $stats,
            'expiring' => $expiring,
            'anniversary' => $anniversary
        ];

        return view('backend/cmscust/majelis_gereja/dashboard', $data);
    }

    // ============================================
    // FRONTEND METHODS
    // ============================================

    // Frontend - List all majelis
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();


        $data = [
            'title' => 'Majelis Gereja - ' . esc($konfigurasi->nama),
            'deskripsi' => 'Daftar Majelis dan Pelayan Gereja ' . esc($konfigurasi->nama),
            'url' => base_url('majelis-gereja'),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listgrafis(),
            'infografis1' => $this->banner->listinfo1(),
            'infografis2' => $this->banner->listinfo(),
            'infografis3' => $this->banner->listinfo3(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            // 'foto1'         => $this->galeri->fototerbaru(),


            // Data Majelis
            'majelis' => $this->majelisgereja->listMajelisPage()->paginate(12, 'majelis'),
            'pager' => $this->majelisgereja->pager,
            'jabatan' => $this->jabatanmajelis->listAktif(),
        ];

        return view('frontend/' . esc($template['folder']) . '/desktop/content/v_majelis', $data);
    }

    // Frontend - Detail majelis
    public function detail($majelis_id)
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $majelis = $this->majelisgereja->find($majelis_id);

        if (!$majelis) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => esc($majelis['nama']) . ' - Majelis Gereja',
            'deskripsi' => 'Profil ' . esc($majelis['nama']) . ' - ' . esc($majelis['jenis_jabatan']),
            'url' => base_url('majelis-gereja/detail/' . $majelis_id),
            'img' => base_url('/public/img/informasi/majelis/' . esc($majelis['gambar'])),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listgrafis(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),


            // Data Majelis
            'majelis' => $majelis,
            'terkait' => $this->majelisgereja->where('status_jabatan', 'Aktif')
                ->where('majelis_id !=', $majelis_id)
                ->limit(4)
                ->findAll(),
        ];

        return view('frontend/' . esc($template['folder']) . '/desktop/content/v_majelis_detail', $data);
    }
}





