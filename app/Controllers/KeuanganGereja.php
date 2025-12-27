<?php

namespace App\Controllers;

class KeuanganGereja extends BaseController
{
    // Backend - List data keuangan
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Keuangan Gereja',
            'subtitle' => 'Manajemen Keuangan',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/keuangan_gereja/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'keuangan-gereja/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Keuangan Gereja',
                        'list' => $this->keuangangereja->list(),
                        'akses' => $akses,
                        'statistik' => $this->keuangangereja->getStatistik(),
                        'statistik_status' => $this->keuangangereja->getStatistikStatus(),
                        'total_saldo' => $this->kasgereja->getTotalSaldo()
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/keuangan_gereja/list', $data)
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
            $id_transaksi = $this->request->getVar('id_transaksi');
            $list = $this->keuangangereja->select('
                custome__transaksi_keuangan.*,
                custome__kategori_keuangan.nama_kategori,
                custome__kategori_keuangan.warna
            ')
                ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
                ->find($id_transaksi);

            $data = [
                'title' => 'Detail Transaksi Keuangan',
                'data' => $list
            ];
            $msg = [
                'sukses' => view('backend/cmscust/keuangan_gereja/lihat', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Form edit
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');
            $list = $this->keuangangereja->find($id_transaksi);

            $data = [
                'title' => 'Edit Transaksi Keuangan',
                'data' => $list,
                'kategori_pemasukan' => $this->kategorikeuangan->listByJenis('Pemasukan'),
                'kategori_pengeluaran' => $this->kategorikeuangan->listByJenis('Pengeluaran'),
                'kas_list' => $this->kasgereja->listAktif()
            ];
            $msg = [
                'sukses' => view('backend/cmscust/keuangan_gereja/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update data
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'tanggal_transaksi' => [
                    'label' => 'Tanggal Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jumlah' => [
                    'label' => 'Jumlah',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'numeric' => '{field} harus berupa angka!',
                        'greater_than' => '{field} harus lebih dari 0!',
                    ]
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_kategori' => $validation->getError('id_kategori'),
                        'tanggal_transaksi' => $validation->getError('tanggal_transaksi'),
                        'jumlah' => $validation->getError('jumlah'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {
                $updatedata = [
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
                    'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
                    'jumlah' => str_replace(',', '', $this->request->getVar('jumlah')),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'penerima' => $this->request->getVar('penerima'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'metode_pembayaran' => $this->request->getVar('metode_pembayaran'),
                    'no_referensi' => $this->request->getVar('no_referensi'),
                ];

                $this->keuangangereja->update($id_transaksi, $updatedata);

                $msg = [
                    'sukses' => 'Transaksi keuangan berhasil diubah!'
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
                'title' => 'Tambah Transaksi Keuangan',
                'kode_transaksi_baru' => $this->keuangangereja->generateKodeTransaksi(),
                'kategori_pemasukan' => $this->kategorikeuangan->listByJenis('Pemasukan'),
                'kategori_pengeluaran' => $this->kategorikeuangan->listByJenis('Pengeluaran'),
                'kas_list' => $this->kasgereja->listAktif()
            ];
            $msg = [
                'data' => view('backend/cmscust/keuangan_gereja/tambah', $data)
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
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih {field}!',
                    ]
                ],
                'tanggal_transaksi' => [
                    'label' => 'Tanggal Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'jumlah' => [
                    'label' => 'Jumlah',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'numeric' => '{field} harus berupa angka!',
                        'greater_than' => '{field} harus lebih dari 0!',
                    ]
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_kategori' => $validation->getError('id_kategori'),
                        'tanggal_transaksi' => $validation->getError('tanggal_transaksi'),
                        'jumlah' => $validation->getError('jumlah'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {
                $insertdata = [
                    'kode_transaksi' => $this->keuangangereja->generateKodeTransaksi(),
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
                    'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
                    'jumlah' => str_replace(',', '', $this->request->getVar('jumlah')),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'penerima' => $this->request->getVar('penerima'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'metode_pembayaran' => $this->request->getVar('metode_pembayaran') ?: 'Tunai',
                    'no_referensi' => $this->request->getVar('no_referensi'),
                    'status' => 'Pending',
                    'created_by' => session()->get('id'),
                ];

                $this->keuangangereja->insert($insertdata);

                $msg = [
                    'sukses' => 'Transaksi keuangan berhasil disimpan!'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Backend - Hapus data
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');

            // Hapus mutasi kas jika ada
            $this->mutasikas->hapusMutasi($id_transaksi);

            // Hapus transaksi
            $this->keuangangereja->delete($id_transaksi);

            $msg = [
                'sukses' => 'Transaksi keuangan berhasil dihapus!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple data
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');
            $jmldata = count($id_transaksi);

            for ($i = 0; $i < $jmldata; $i++) {
                // Hapus mutasi kas jika ada
                $this->mutasikas->hapusMutasi($id_transaksi[$i]);

                // Hapus transaksi
                $this->keuangangereja->delete($id_transaksi[$i]);
            }

            $msg = [
                'sukses' => "$jmldata transaksi keuangan berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Approve/Reject transaksi
    public function approve()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');
            $status = $this->request->getVar('status');
            $catatan = $this->request->getVar('catatan');
            $id_kas = $this->request->getVar('id_kas');

            $transaksi = $this->keuangangereja->find($id_transaksi);
            if (!$transaksi) {
                $msg = ['error' => 'Transaksi tidak ditemukan'];
            } else {
                // Update status transaksi
                $this->keuangangereja->updateStatus($id_transaksi, $status, session()->get('id'), $catatan);

                // Jika disetujui, catat mutasi kas
                if ($status == 'Disetujui' && $id_kas) {
                    $jenis_mutasi = ($transaksi['jenis_transaksi'] == 'Pemasukan') ? 'Masuk' : 'Keluar';
                    $this->mutasikas->catatMutasi($id_kas, $id_transaksi, $jenis_mutasi, $transaksi['jumlah'], $transaksi['keterangan']);
                }

                $msg = [
                    'sukses' => 'Status transaksi berhasil diubah menjadi: ' . $status
                ];
            }

            echo json_encode($msg);
        }
    }

    // Backend - Form approve
    public function formapprove()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');
            $transaksi = $this->keuangangereja->select('
                custome__transaksi_keuangan.*,
                custome__kategori_keuangan.nama_kategori,
                custome__kategori_keuangan.warna
            ')
                ->join('custome__kategori_keuangan', 'custome__kategori_keuangan.id_kategori = custome__transaksi_keuangan.id_kategori')
                ->find($id_transaksi);

            $data = [
                'title' => 'Approve Transaksi',
                'data' => $transaksi,
                'kas_list' => $this->kasgereja->listAktif()
            ];
            $msg = [
                'sukses' => view('backend/cmscust/keuangan_gereja/approve', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Dashboard keuangan
    public function dashboard()
    {
        if ($this->request->isAJAX()) {
            $statistik = $this->keuangangereja->getStatistik();
            $statistik_status = $this->keuangangereja->getStatistikStatus();
            $grafik_bulanan = $this->keuangangereja->getGrafikBulanan();
            $top_pemasukan = $this->keuangangereja->getTopKategoriPemasukan();
            $top_pengeluaran = $this->keuangangereja->getTopKategoriPengeluaran();
            $pending_approval = $this->keuangangereja->getPendingApproval();
            $total_saldo = $this->kasgereja->getTotalSaldo();
            $saldo_per_jenis = $this->kasgereja->getSaldoPerJenis();

            $data = [
                'statistik' => $statistik,
                'statistik_status' => $statistik_status,
                'grafik_bulanan' => $grafik_bulanan,
                'top_pemasukan' => $top_pemasukan,
                'top_pengeluaran' => $top_pengeluaran,
                'pending_approval' => $pending_approval,
                'total_saldo' => $total_saldo,
                'saldo_per_jenis' => $saldo_per_jenis
            ];
            $msg = [
                'data' => view('backend/cmscust/keuangan_gereja/dashboard', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Search transaksi
    public function search()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getVar('keyword');
            $hasil = $this->keuangangereja->searchTransaksi($keyword);

            $data = [
                'title' => 'Hasil Pencarian: ' . $keyword,
                'list' => $hasil,
                'keyword' => $keyword
            ];
            $msg = [
                'data' => view('backend/cmscust/keuangan_gereja/hasil_cari', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Filter by periode
    public function filterbyperiode()
    {
        if ($this->request->isAJAX()) {
            $tanggal_mulai = $this->request->getVar('tanggal_mulai');
            $tanggal_selesai = $this->request->getVar('tanggal_selesai');

            $hasil = $this->keuangangereja->listByPeriode($tanggal_mulai, $tanggal_selesai);

            $data = [
                'title' => 'Transaksi ' . date('d/m/Y', strtotime($tanggal_mulai)) . ' - ' . date('d/m/Y', strtotime($tanggal_selesai)),
                'list' => $hasil,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai
            ];
            $msg = [
                'data' => view('backend/cmscust/keuangan_gereja/hasil_filter', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Laporan keuangan
    public function laporan()
    {
        if ($this->request->isAJAX()) {
            $tanggal_mulai = $this->request->getVar('tanggal_mulai');
            $tanggal_selesai = $this->request->getVar('tanggal_selesai');

            $laporan = $this->keuangangereja->getLaporanPeriode($tanggal_mulai, $tanggal_selesai);

            $data = [
                'title' => 'Laporan Keuangan',
                'periode_mulai' => $tanggal_mulai,
                'periode_selesai' => $tanggal_selesai,
                'laporan' => $laporan
            ];
            $msg = [
                'data' => view('backend/cmscust/keuangan_gereja/laporan', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Upload bukti transaksi
    public function uploadbukti()
    {
        if ($this->request->isAJAX()) {
            $id_transaksi = $this->request->getVar('id_transaksi');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'bukti_transaksi' => [
                    'label' => 'Bukti Transaksi',
                    'rules' => 'uploaded[bukti_transaksi]|max_size[bukti_transaksi,2048]|mime_in[bukti_transaksi,image/png,image/jpg,image/jpeg,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih file bukti transaksi',
                        'max_size' => 'Ukuran file maksimal 2 MB',
                        'mime_in' => 'Format file harus PNG, JPG, JPEG, atau PDF'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'bukti_transaksi' => $validation->getError('bukti_transaksi')
                    ]
                ];
            } else {
                $file = $this->request->getFile('bukti_transaksi');
                $nama_file = $file->getRandomName();

                $updatedata = [
                    'bukti_transaksi' => $nama_file
                ];

                $this->keuangangereja->update($id_transaksi, $updatedata);
                $file->move('public/file/bukti_transaksi/', $nama_file);

                $msg = [
                    'sukses' => 'Bukti transaksi berhasil diupload!',
                ];
            }
            echo json_encode($msg);
        }
    }
}
