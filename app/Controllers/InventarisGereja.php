<?php

namespace App\Controllers;

class InventarisGereja extends BaseController
{
    // Backend - List data aset
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Inventaris Gereja',
            'subtitle' => 'Manajemen Aset & Inventaris',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/inventaris_gereja/index', $data);
    }

    // Backend - Get data untuk datatables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'inventaris-gereja/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            if (!$listgrupf) {
                $url = 'inventaris_gereja/list';
                $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
            }

            if (!$listgrupf) {
                $url = 'inventaris-gereja/all';
                $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
            }

            if (!$listgrupf) {
                $url = 'inventaris_gereja/all';
                $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
            }

            $akses = 0;
            if ($listgrupf) {
                foreach ($listgrupf as $data):
                    $akses = $data['akses'];
                endforeach;
            }

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Inventaris Gereja',
                        'list' => $this->inventarisgereja->list(),
                        'akses' => $akses,
                        'statistik' => $this->inventarisgereja->getStatistik()
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/inventaris_gereja/list', $data)
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

    // Form tambah aset
    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Aset Baru',
                'kode_aset_baru' => $this->inventarisgereja->generateKodeAset(),
                'kategori_list' => $this->kategoriaset->listAktif(),
                'lokasi_list' => $this->lokasiaset->listAktif(),
                'vendor_list' => $this->vendormaintenance->getByJenis('Supplier')
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Simpan aset baru
    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_aset' => [
                    'label' => 'Nama Aset',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 3 karakter'
                    ]
                ],
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ],
                'id_lokasi' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ],
                'tanggal_pembelian' => [
                    'label' => 'Tanggal Pembelian',
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'valid_date' => '{field} harus berformat tanggal yang valid'
                    ]
                ],
                'harga_perolehan' => [
                    'label' => 'Harga Perolehan',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka',
                        'greater_than' => '{field} harus lebih besar dari 0'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_aset' => $validation->getError('nama_aset'),
                        'id_kategori' => $validation->getError('id_kategori'),
                        'id_lokasi' => $validation->getError('id_lokasi'),
                        'tanggal_pembelian' => $validation->getError('tanggal_pembelian'),
                        'harga_perolehan' => $validation->getError('harga_perolehan')
                    ]
                ];
            } else {
                // Check duplicate kode aset
                $kode_aset = $this->request->getVar('kode_aset');
                if ($this->inventarisgereja->checkDuplicateKode($kode_aset)) {
                    $kode_aset = $this->inventarisgereja->generateKodeAset();
                }

                // Check duplicate serial number
                $serial_number = $this->request->getVar('serial_number');
                if ($serial_number && $this->inventarisgereja->checkDuplicateSerial($serial_number)) {
                    $msg = [
                        'error' => [
                            'serial_number' => 'Serial number sudah digunakan'
                        ]
                    ];
                    echo json_encode($msg);
                    return;
                }

                // Generate QR Code
                $qr_code = $this->inventarisgereja->generateQRCode($kode_aset);

                // Get kategori untuk default depreciation
                $kategori = $this->kategoriaset->find($this->request->getVar('id_kategori'));
                $masa_pakai = $this->request->getVar('masa_pakai') ?: $kategori['masa_pakai'];
                $metode_depreciation = $this->request->getVar('metode_depreciation') ?: $kategori['metode_depreciation'];

                // Calculate nilai buku awal
                $harga_perolehan = (float) $this->request->getVar('harga_perolehan');
                $nilai_residu = (float) $this->request->getVar('nilai_residu') ?: 0;
                $nilai_buku = $harga_perolehan; // Initial book value

                $simpandata = [
                    'kode_aset' => $kode_aset,
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'id_lokasi' => $this->request->getVar('id_lokasi'),
                    'merk' => $this->request->getVar('merk'),
                    'model' => $this->request->getVar('model'),
                    'serial_number' => $serial_number,
                    'tahun_pembuatan' => $this->request->getVar('tahun_pembuatan'),
                    'tanggal_pembelian' => $this->request->getVar('tanggal_pembelian'),
                    'harga_perolehan' => $harga_perolehan,
                    'nilai_residu' => $nilai_residu,
                    'masa_pakai' => $masa_pakai,
                    'metode_depreciation' => $metode_depreciation,
                    'nilai_buku' => $nilai_buku,
                    'akumulasi_depreciation' => 0,
                    'supplier' => $this->request->getVar('supplier'),
                    'no_faktur' => $this->request->getVar('no_faktur'),
                    'warranty_start' => $this->request->getVar('warranty_start'),
                    'warranty_end' => $this->request->getVar('warranty_end'),
                    'insurance_company' => $this->request->getVar('insurance_company'),
                    'insurance_policy' => $this->request->getVar('insurance_policy'),
                    'insurance_value' => $this->request->getVar('insurance_value') ?: 0,
                    'kondisi' => $this->request->getVar('kondisi') ?: 'Baik',
                    'status' => 'Aktif',
                    'qr_code' => $qr_code,
                    'spesifikasi' => $this->request->getVar('spesifikasi'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'created_by' => session()->get('id')
                ];

                $this->inventarisgereja->insert($simpandata);

                $msg = [
                    'sukses' => 'Aset berhasil ditambahkan dengan kode: ' . $kode_aset
                ];
            }
            echo json_encode($msg);
        }
    }

    // Form lihat detail aset
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');
            $aset = $this->inventarisgereja->getAsetById($id_aset);

            if ($aset) {
                // Get riwayat maintenance
                $riwayat_maintenance = $this->maintenanceaset->getByAset($id_aset);

                // Get riwayat perbaikan
                $riwayat_perbaikan = $this->perbaikanaset->getByAset($id_aset);

                // Convert to object for view compatibility
                $aset = (object) $aset;
                $riwayat_maintenance = array_map(function ($item) {
                    return (object) $item; }, $riwayat_maintenance);
                $riwayat_perbaikan = array_map(function ($item) {
                    return (object) $item; }, $riwayat_perbaikan);

                $data = [
                    'title' => 'Detail Aset',
                    'aset' => $aset,
                    'riwayat_maintenance' => $riwayat_maintenance,
                    'riwayat_perbaikan' => $riwayat_perbaikan
                ];
                $msg = [
                    'sukses' => view('backend/cmscust/inventaris_gereja/lihat', $data)
                ];
            } else {
                $msg = [
                    'error' => 'Data aset tidak ditemukan'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Form edit aset
    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');
            $aset = $this->inventarisgereja->find($id_aset);

            if ($aset) {
                $data = [
                    'title' => 'Edit Aset',
                    'aset' => $aset,
                    'kategori_list' => $this->kategoriaset->listAktif(),
                    'lokasi_list' => $this->lokasiaset->listAktif(),
                    'vendor_list' => $this->vendormaintenance->getByJenis('Supplier')
                ];
                $msg = [
                    'sukses' => view('backend/cmscust/inventaris_gereja/edit', $data)
                ];
            } else {
                $msg = [
                    'error' => 'Data aset tidak ditemukan'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Update aset
    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_aset' => [
                    'label' => 'Nama Aset',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 3 karakter'
                    ]
                ],
                'id_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ],
                'id_lokasi' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_aset' => $validation->getError('nama_aset'),
                        'id_kategori' => $validation->getError('id_kategori'),
                        'id_lokasi' => $validation->getError('id_lokasi')
                    ]
                ];
            } else {
                $id_aset = $this->request->getVar('id_aset');

                // Check duplicate serial number
                $serial_number = $this->request->getVar('serial_number');
                if ($serial_number && $this->inventarisgereja->checkDuplicateSerial($serial_number, $id_aset)) {
                    $msg = [
                        'error' => [
                            'serial_number' => 'Serial number sudah digunakan'
                        ]
                    ];
                    echo json_encode($msg);
                    return;
                }

                $updatedata = [
                    'nama_aset' => $this->request->getVar('nama_aset'),
                    'id_kategori' => $this->request->getVar('id_kategori'),
                    'id_lokasi' => $this->request->getVar('id_lokasi'),
                    'merk' => $this->request->getVar('merk'),
                    'model' => $this->request->getVar('model'),
                    'serial_number' => $serial_number,
                    'tahun_pembuatan' => $this->request->getVar('tahun_pembuatan'),
                    'supplier' => $this->request->getVar('supplier'),
                    'no_faktur' => $this->request->getVar('no_faktur'),
                    'warranty_start' => $this->request->getVar('warranty_start'),
                    'warranty_end' => $this->request->getVar('warranty_end'),
                    'insurance_company' => $this->request->getVar('insurance_company'),
                    'insurance_policy' => $this->request->getVar('insurance_policy'),
                    'insurance_value' => $this->request->getVar('insurance_value') ?: 0,
                    'kondisi' => $this->request->getVar('kondisi'),
                    'spesifikasi' => $this->request->getVar('spesifikasi'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'updated_by' => session()->get('id')
                ];

                $this->inventarisgereja->update($id_aset, $updatedata);

                $msg = [
                    'sukses' => 'Data aset berhasil diperbarui'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Hapus aset
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');

            // Check apakah aset memiliki riwayat maintenance/perbaikan
            $maintenance_count = $this->maintenanceaset->where('id_aset', $id_aset)->countAllResults();
            $perbaikan_count = $this->perbaikanaset->where('id_aset', $id_aset)->countAllResults();

            if ($maintenance_count > 0 || $perbaikan_count > 0) {
                $msg = [
                    'error' => 'Aset tidak dapat dihapus karena memiliki riwayat maintenance atau perbaikan'
                ];
            } else {
                $this->inventarisgereja->delete($id_aset);
                $msg = [
                    'sukses' => 'Aset berhasil dihapus'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Hapus multiple aset
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');
            $jmldata = count($id_aset);

            foreach ($id_aset as $id) {
                // Check riwayat untuk setiap aset
                $maintenance_count = $this->maintenanceaset->where('id_aset', $id)->countAllResults();
                $perbaikan_count = $this->perbaikanaset->where('id_aset', $id)->countAllResults();

                if ($maintenance_count == 0 && $perbaikan_count == 0) {
                    $this->inventarisgereja->delete($id);
                }
            }

            $msg = [
                'sukses' => "$jmldata aset berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    // Toggle status aset
    public function toggle()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');
            $status = $this->request->getVar('status');

            $this->inventarisgereja->toggleStatus($id_aset, $status);

            $msg = [
                'sukses' => 'Status aset berhasil diubah'
            ];
            echo json_encode($msg);
        }
    }

    // Dashboard inventaris
    public function dashboard()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Dashboard Inventaris',
                'statistik' => $this->inventarisgereja->getStatistik(),
                'aset_per_kategori' => $this->inventarisgereja->getAsetPerKategori(),
                'aset_per_lokasi' => $this->inventarisgereja->getAsetPerLokasi(),
                'aset_perlu_maintenance' => $this->inventarisgereja->getAsetPerluMaintenance(),
                'warranty_expiring' => $this->inventarisgereja->getWarrantyExpiringSoon(),
                'top_aset_by_value' => $this->inventarisgereja->getTopAsetByValue(5)
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/dashboard', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Search aset
    public function search()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getVar('keyword');
            $data = [
                'title' => 'Hasil Pencarian: ' . $keyword,
                'list' => $this->inventarisgereja->searchAset($keyword),
                'akses' => '1'
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Filter berdasarkan kategori
    public function filterByKategori()
    {
        if ($this->request->isAJAX()) {
            $id_kategori = $this->request->getVar('id_kategori');
            $kategori = $this->kategoriaset->find($id_kategori);

            $data = [
                'title' => 'Filter Kategori: ' . $kategori['nama_kategori'],
                'list' => $this->inventarisgereja->filterByKategori($id_kategori),
                'akses' => '1'
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Filter berdasarkan lokasi
    public function filterByLokasi()
    {
        if ($this->request->isAJAX()) {
            $id_lokasi = $this->request->getVar('id_lokasi');
            $lokasi = $this->lokasiaset->find($id_lokasi);

            $data = [
                'title' => 'Filter Lokasi: ' . $lokasi['nama_lokasi'],
                'list' => $this->inventarisgereja->filterByLokasi($id_lokasi),
                'akses' => '1'
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Filter berdasarkan status
    public function filterByStatus()
    {
        if ($this->request->isAJAX()) {
            $status = $this->request->getVar('status');

            $data = [
                'title' => 'Filter Status: ' . $status,
                'list' => $this->inventarisgereja->filterByStatus($status),
                'akses' => '1'
            ];
            $msg = [
                'data' => view('backend/cmscust/inventaris_gereja/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Get aset by QR Code
    public function getByQRCode()
    {
        if ($this->request->isAJAX()) {
            $qr_code = $this->request->getVar('qr_code');
            $aset = $this->inventarisgereja->getByQRCode($qr_code);

            if ($aset) {
                $msg = [
                    'sukses' => $aset
                ];
            } else {
                $msg = [
                    'error' => 'Aset dengan QR Code tersebut tidak ditemukan'
                ];
            }
            echo json_encode($msg);
        }
    }

    // Export Excel
    public function export()
    {
        $filters = $this->request->getGet();
        $data = [];

        // Apply filters if provided
        if (!empty($filters['kategori'])) {
            $data = $this->inventarisgereja->filterByKategori($filters['kategori']);
        } elseif (!empty($filters['lokasi'])) {
            $data = $this->inventarisgereja->filterByLokasi($filters['lokasi']);
        } elseif (!empty($filters['status'])) {
            $data = $this->inventarisgereja->filterByStatus($filters['status']);
        } elseif (!empty($filters['search'])) {
            $data = $this->inventarisgereja->searchAset($filters['search']);
        } else {
            $data = $this->inventarisgereja->list();
        }

        // Generate Excel file
        $filename = 'inventaris_gereja_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Simple CSV format for now (can be enhanced with PHPExcel)
        $output = fopen('php://output', 'w');

        // Headers
        fputcsv($output, [
            'Kode Aset',
            'Nama Aset',
            'Kategori',
            'Lokasi',
            'Merk',
            'Model',
            'Serial Number',
            'Tanggal Pembelian',
            'Harga Perolehan',
            'Nilai Buku',
            'Status',
            'Kondisi',
            'Supplier'
        ]);

        // Data
        foreach ($data as $row) {
            fputcsv($output, [
                $row->kode_aset,
                $row->nama_aset,
                $row->nama_kategori,
                $row->nama_lokasi,
                $row->merk,
                $row->model,
                $row->serial_number,
                $row->tanggal_pembelian,
                $row->harga_perolehan,
                $row->nilai_buku,
                $row->status,
                $row->kondisi,
                $row->supplier
            ]);
        }

        fclose($output);
        exit;
    }

    // Print report
    public function print()
    {
        $filters = $this->request->getGet();
        $data = [];

        // Apply filters if provided
        if (!empty($filters['kategori'])) {
            $data = $this->inventarisgereja->filterByKategori($filters['kategori']);
        } elseif (!empty($filters['lokasi'])) {
            $data = $this->inventarisgereja->filterByLokasi($filters['lokasi']);
        } elseif (!empty($filters['status'])) {
            $data = $this->inventarisgereja->filterByStatus($filters['status']);
        } elseif (!empty($filters['search'])) {
            $data = $this->inventarisgereja->searchAset($filters['search']);
        } else {
            $data = $this->inventarisgereja->list();
        }

        $printData = [
            'title' => 'Laporan Inventaris Gereja',
            'subtitle' => 'Dicetak pada: ' . date('d F Y H:i'),
            'data' => $data,
            'statistik' => $this->inventarisgereja->getStatistik()
        ];

        return view('backend/cmscust/inventaris_gereja/print', $printData);
    }

    // Print QR Code
    public function printqr($id_aset = null)
    {
        if ($id_aset) {
            $aset = $this->inventarisgereja->getAsetById($id_aset);
            if ($aset) {
                $data = [
                    'aset' => $aset,
                    'qr_code' => $aset->qr_code ?: 'QR' . $aset->kode_aset . time()
                ];
                return view('backend/cmscust/inventaris_gereja/print_qr', $data);
            }
        }
        return redirect()->back();
    }

    // Generate new QR Code
    public function generateqr()
    {
        if ($this->request->isAJAX()) {
            $id_aset = $this->request->getVar('id_aset');
            $aset = $this->inventarisgereja->find($id_aset);

            if ($aset) {
                $new_qr = $this->inventarisgereja->generateQRCode($aset->kode_aset);
                $this->inventarisgereja->update($id_aset, ['qr_code' => $new_qr]);

                $msg = [
                    'sukses' => 'QR Code baru berhasil di-generate'
                ];
            } else {
                $msg = [
                    'error' => 'Aset tidak ditemukan'
                ];
            }
            echo json_encode($msg);
        }
    }
}





