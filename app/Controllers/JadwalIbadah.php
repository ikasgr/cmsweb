<?php

namespace App\Controllers;

class JadwalIbadah extends BaseController
{
    // Backend - List data jadwal ibadah
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title'     => 'Jadwal Ibadah & Pelayanan',
            'subtitle'  => 'Manajemen Jadwal Ibadah',
            'folder'    => 'morvin',
        ];
        return view('backend/morvin/cmscust/jadwal_ibadah/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'jadwal-ibadah/list';
            $listgrupf =  $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data) :
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title'     => 'Jadwal Ibadah & Pelayanan',
                        'list'      => $this->jadwalibadah->list(),
                        'akses'     => $akses,
                        'statistik' => $this->jadwalibadah->getStatistik(),
                        'statistik_status' => $this->jadwalibadah->getStatistikStatus()
                    ];
                    $msg = [
                        'data' => view('backend/morvin/cmscust/jadwal_ibadah/list', $data)
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
            $id_jadwal = $this->request->getVar('id_jadwal');
            $detail = $this->jadwalibadah->getDetailLengkap($id_jadwal);

            $data = [
                'title' => 'Detail Jadwal Ibadah',
                'data'  => $detail
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/jadwal_ibadah/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $list = $this->jadwalibadah->find($id_jadwal);

            $data = [
                'title' => 'Edit Jadwal Ibadah',
                'data'  => $list,
                'jenis_ibadah' => $this->jenisibadah->listAktif()
            ];
            $msg = [
                'sukses' => view('backend/morvin/cmscust/jadwal_ibadah/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'id_jenis_ibadah' => [
                    'label' => 'Jenis Ibadah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'judul_ibadah' => [
                    'label' => 'Judul Ibadah',
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
                'jam_mulai' => [
                    'label' => 'Jam Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_jenis_ibadah'   => $validation->getError('id_jenis_ibadah'),
                        'judul_ibadah'      => $validation->getError('judul_ibadah'),
                        'tanggal'           => $validation->getError('tanggal'),
                        'jam_mulai'         => $validation->getError('jam_mulai'),
                    ]
                ];
            } else {
                // Cek konflik jadwal
                $tanggal = $this->request->getVar('tanggal');
                $jam_mulai = $this->request->getVar('jam_mulai');
                $jam_selesai = $this->request->getVar('jam_selesai') ?: '23:59:59';
                
                $konflik = $this->jadwalibadah->cekKonflik($tanggal, $jam_mulai, $jam_selesai, $id_jadwal);
                
                if ($konflik) {
                    $msg = [
                        'error' => [
                            'tanggal' => 'Jadwal bentrok dengan: ' . $konflik['judul_ibadah']
                        ]
                    ];
                } else {
                    $updatedata = [
                        'id_jenis_ibadah'   => $this->request->getVar('id_jenis_ibadah'),
                        'judul_ibadah'      => $this->request->getVar('judul_ibadah'),
                        'tanggal'           => $this->request->getVar('tanggal'),
                        'jam_mulai'         => $this->request->getVar('jam_mulai'),
                        'jam_selesai'       => $this->request->getVar('jam_selesai'),
                        'tempat'            => $this->request->getVar('tempat'),
                        'tema_ibadah'       => $this->request->getVar('tema_ibadah'),
                        'ayat_tema'         => $this->request->getVar('ayat_tema'),
                        'liturgi'           => $this->request->getVar('liturgi'),
                        'keterangan'        => $this->request->getVar('keterangan'),
                        'max_peserta'       => $this->request->getVar('max_peserta'),
                        'status'            => $this->request->getVar('status'),
                        'is_recurring'      => $this->request->getVar('is_recurring') ? 1 : 0,
                        'recurring_type'    => $this->request->getVar('recurring_type'),
                        'recurring_end'     => $this->request->getVar('recurring_end'),
                    ];

                    $this->jadwalibadah->update($id_jadwal, $updatedata);

                    $msg = [
                        'sukses' => 'Jadwal ibadah berhasil diubah!'
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
                'title' => 'Tambah Jadwal Ibadah',
                'jenis_ibadah' => $this->jenisibadah->listAktif()
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/jadwal_ibadah/tambah', $data)
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
                'id_jenis_ibadah' => [
                    'label' => 'Jenis Ibadah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'judul_ibadah' => [
                    'label' => 'Judul Ibadah',
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
                'jam_mulai' => [
                    'label' => 'Jam Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_jenis_ibadah'   => $validation->getError('id_jenis_ibadah'),
                        'judul_ibadah'      => $validation->getError('judul_ibadah'),
                        'tanggal'           => $validation->getError('tanggal'),
                        'jam_mulai'         => $validation->getError('jam_mulai'),
                    ]
                ];
            } else {
                // Cek konflik jadwal
                $tanggal = $this->request->getVar('tanggal');
                $jam_mulai = $this->request->getVar('jam_mulai');
                $jam_selesai = $this->request->getVar('jam_selesai') ?: '23:59:59';
                
                $konflik = $this->jadwalibadah->cekKonflik($tanggal, $jam_mulai, $jam_selesai);
                
                if ($konflik) {
                    $msg = [
                        'error' => [
                            'tanggal' => 'Jadwal bentrok dengan: ' . $konflik['judul_ibadah']
                        ]
                    ];
                } else {
                    $insertdata = [
                        'id_jenis_ibadah'   => $this->request->getVar('id_jenis_ibadah'),
                        'judul_ibadah'      => $this->request->getVar('judul_ibadah'),
                        'tanggal'           => $this->request->getVar('tanggal'),
                        'jam_mulai'         => $this->request->getVar('jam_mulai'),
                        'jam_selesai'       => $this->request->getVar('jam_selesai'),
                        'tempat'            => $this->request->getVar('tempat') ?: 'Gereja',
                        'tema_ibadah'       => $this->request->getVar('tema_ibadah'),
                        'ayat_tema'         => $this->request->getVar('ayat_tema'),
                        'liturgi'           => $this->request->getVar('liturgi'),
                        'keterangan'        => $this->request->getVar('keterangan'),
                        'max_peserta'       => $this->request->getVar('max_peserta'),
                        'status'            => $this->request->getVar('status') ?: 'Terjadwal',
                        'is_recurring'      => $this->request->getVar('is_recurring') ? 1 : 0,
                        'recurring_type'    => $this->request->getVar('recurring_type'),
                        'recurring_end'     => $this->request->getVar('recurring_end'),
                        'created_by'        => session()->get('id'),
                    ];

                    $id_jadwal = $this->jadwalibadah->insert($insertdata);

                    // Generate recurring jika diperlukan
                    if ($this->request->getVar('is_recurring') && $this->request->getVar('recurring_end')) {
                        $generated = $this->jadwalibadah->generateRecurring($id_jadwal);
                        $msg = [
                            'sukses' => 'Jadwal ibadah berhasil disimpan! ' . count($generated) . ' jadwal recurring dibuat.'
                        ];
                    } else {
                        $msg = [
                            'sukses' => 'Jadwal ibadah berhasil disimpan!'
                        ];
                    }
                }
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus data
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            
            $this->jadwalibadah->delete($id_jadwal);
            $msg = [
                'sukses' => 'Jadwal ibadah berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple data
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $jmldata = count($id_jadwal);
            
            for ($i = 0; $i < $jmldata; $i++) {
                $this->jadwalibadah->delete($id_jadwal[$i]);
            }

            $msg = [
                'sukses' => "$jmldata jadwal ibadah berhasil dihapus"
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

            $this->jadwalibadah->updateStatus($id, $status);
            
            $msg = [
                'sukses' => 'Status jadwal berhasil diubah menjadi: ' . $status
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Get calendar events
    public function getcalendar()
    {
        if ($this->request->isAJAX()) {
            $start = $this->request->getVar('start');
            $end = $this->request->getVar('end');
            
            $events = $this->jadwalibadah->getCalendarEvents($start, $end);
            
            echo json_encode($events);
        }
    }

    // Backend - Copy jadwal
    public function copy()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $tanggal_baru = $this->request->getVar('tanggal_baru');
            
            $jadwal = $this->jadwalibadah->find($id_jadwal);
            if (!$jadwal) {
                $msg = ['error' => 'Jadwal tidak ditemukan'];
            } else {
                // Copy jadwal utama
                unset($jadwal['id_jadwal']);
                $jadwal['tanggal'] = $tanggal_baru;
                $jadwal['status'] = 'Terjadwal';
                $jadwal['is_recurring'] = 0;
                $jadwal['created_by'] = session()->get('id');
                
                $id_jadwal_baru = $this->jadwalibadah->insert($jadwal);
                
                // Copy pelayan
                $pelayan_copied = $this->pelayanibadah->copyFromJadwal($id_jadwal, $id_jadwal_baru);
                
                // Copy musik
                $musik_copied = $this->musikibadah->copyFromJadwal($id_jadwal, $id_jadwal_baru);
                
                // Copy pengumuman
                $pengumuman_copied = $this->pengumumanibadah->copyFromJadwal($id_jadwal, $id_jadwal_baru);
                
                $msg = [
                    'sukses' => "Jadwal berhasil dicopy! ($pelayan_copied pelayan, $musik_copied musik, $pengumuman_copied pengumuman)"
                ];
            }
            
            echo json_encode($msg);
        }
    }

    // Backend - Dashboard calendar
    public function dashboard()
    {
        if ($this->request->isAJAX()) {
            $statistik = $this->jadwalibadah->getStatistik();
            $statistik_status = $this->jadwalibadah->getStatistikStatus();
            $jadwal_hari_ini = $this->jadwalibadah->listToday();
            $jadwal_minggu_ini = $this->jadwalibadah->listThisWeek();
            $jadwal_mendatang = $this->jadwalibadah->listUpcoming(7);

            $data = [
                'statistik' => $statistik,
                'statistik_status' => $statistik_status,
                'jadwal_hari_ini' => $jadwal_hari_ini,
                'jadwal_minggu_ini' => $jadwal_minggu_ini,
                'jadwal_mendatang' => $jadwal_mendatang
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/jadwal_ibadah/dashboard', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Search jadwal
    public function search()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getVar('keyword');
            $hasil = $this->jadwalibadah->searchJadwal($keyword);

            $data = [
                'title' => 'Hasil Pencarian: ' . $keyword,
                'list'  => $hasil,
                'keyword' => $keyword
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/jadwal_ibadah/hasil_cari', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Filter by month
    public function filterbymonth()
    {
        if ($this->request->isAJAX()) {
            $bulan = $this->request->getVar('bulan');
            $tahun = $this->request->getVar('tahun');
            
            $hasil = $this->jadwalibadah->listByMonth($bulan, $tahun);
            $nama_bulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];

            $data = [
                'title' => 'Jadwal ' . $nama_bulan[$bulan] . ' ' . $tahun,
                'list'  => $hasil,
                'bulan' => $bulan,
                'tahun' => $tahun
            ];
            $msg = [
                'data' => view('backend/morvin/cmscust/jadwal_ibadah/hasil_filter', $data)
            ];
            echo json_encode($msg);
        }
    }
}
