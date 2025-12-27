<?php

namespace App\Controllers;

class JadwalPelayanan extends BaseController
{
    // Backend - List jadwal
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Jadwal Pelayanan',
            'subtitle' => 'Manajemen Jadwal',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/jadwal_pelayanan/index', $data);
    }

    // Backend - Get data
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'jadwal-pelayanan/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Jadwal Pelayanan',
                        'list' => $this->jadwalpelayanan->list(),
                        'akses' => $akses
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/jadwal_pelayanan/list', $data)
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
                'title' => 'Tambah Jadwal Pelayanan',
            ];
            $msg = [
                'data' => view('backend/cmscust/jadwal_pelayanan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Simpan jadwal
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul_jadwal' => [
                    'label' => 'Judul Jadwal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jenis_pelayanan' => [
                    'label' => 'Jenis Pelayanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'waktu_mulai' => [
                    'label' => 'Waktu Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_jadwal' => $validation->getError('judul_jadwal'),
                        'jenis_pelayanan' => $validation->getError('jenis_pelayanan'),
                        'tanggal' => $validation->getError('tanggal'),
                        'waktu_mulai' => $validation->getError('waktu_mulai'),
                    ]
                ];
            } else {
                $insertdata = [
                    'judul_jadwal' => $this->request->getVar('judul_jadwal'),
                    'jenis_pelayanan' => $this->request->getVar('jenis_pelayanan'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'waktu_mulai' => $this->request->getVar('waktu_mulai'),
                    'waktu_selesai' => $this->request->getVar('waktu_selesai'),
                    'tempat' => $this->request->getVar('tempat'),
                    'pengkhotbah' => $this->request->getVar('pengkhotbah'),
                    'liturgis' => $this->request->getVar('liturgis'),
                    'singer' => $this->request->getVar('singer'),
                    'pemusik' => $this->request->getVar('pemusik'),
                    'multimedia' => $this->request->getVar('multimedia'),
                    'usher' => $this->request->getVar('usher'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'status' => $this->request->getVar('status'),
                    'warna' => $this->request->getVar('warna') ?? '#007bff',
                    'user_id' => session()->get('id'),
                    'tgl_input' => date('Y-m-d H:i:s'),
                ];

                $this->jadwalpelayanan->insert($insertdata);

                $msg = [
                    'sukses' => 'Jadwal berhasil ditambahkan!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $list = $this->jadwalpelayanan->find($id_jadwal);

            $data = [
                'title' => 'Edit Jadwal Pelayanan',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/jadwal_pelayanan/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update jadwal
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'judul_jadwal' => [
                    'label' => 'Judul Jadwal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_jadwal' => $validation->getError('judul_jadwal'),
                        'tanggal' => $validation->getError('tanggal'),
                    ]
                ];
            } else {
                $updatedata = [
                    'judul_jadwal' => $this->request->getVar('judul_jadwal'),
                    'jenis_pelayanan' => $this->request->getVar('jenis_pelayanan'),
                    'tanggal' => $this->request->getVar('tanggal'),
                    'waktu_mulai' => $this->request->getVar('waktu_mulai'),
                    'waktu_selesai' => $this->request->getVar('waktu_selesai'),
                    'tempat' => $this->request->getVar('tempat'),
                    'pengkhotbah' => $this->request->getVar('pengkhotbah'),
                    'liturgis' => $this->request->getVar('liturgis'),
                    'singer' => $this->request->getVar('singer'),
                    'pemusik' => $this->request->getVar('pemusik'),
                    'multimedia' => $this->request->getVar('multimedia'),
                    'usher' => $this->request->getVar('usher'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'status' => $this->request->getVar('status'),
                    'warna' => $this->request->getVar('warna'),
                ];

                $this->jadwalpelayanan->update($id_jadwal, $updatedata);

                $msg = [
                    'sukses' => 'Jadwal berhasil diupdate!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus jadwal
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');

            $this->jadwalpelayanan->delete($id_jadwal);
            $msg = [
                'sukses' => 'Jadwal berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $jmldata = count($id_jadwal);

            for ($i = 0; $i < $jmldata; $i++) {
                $this->jadwalpelayanan->delete($id_jadwal[$i]);
            }

            $msg = [
                'sukses' => "$jmldata jadwal berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Toggle status
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_jadwal');
            $status = $this->request->getVar('status');

            $updatedata = [
                'status' => $status,
            ];
            $this->jadwalpelayanan->update($id, $updatedata);

            $msg = [
                'sukses' => 'Status berhasil diubah!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Get events for calendar
    public function getcalendar()
    {
        if ($this->request->isAJAX()) {
            $start = $this->request->getVar('start');
            $end = $this->request->getVar('end');

            $events = $this->jadwalpelayanan->forcalendar($start, $end);

            echo json_encode($events);
        }
    }

    // Backend - Form lihat detail
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $list = $this->jadwalpelayanan->find($id_jadwal);

            $data = [
                'title' => 'Detail Jadwal Pelayanan',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/jadwal_pelayanan/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }
}
