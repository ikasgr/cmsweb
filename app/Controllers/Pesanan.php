<?php

namespace App\Controllers;

class Pesanan extends BaseController
{
    // Backend - List pesanan
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $data = [
            'title' => 'Pesanan',
            'subtitle' => 'Manajemen Pesanan',
            'folder' => 'morvin',
        ];
        return view('backend/cmscust/pesanan/index', $data);
    }

    // Backend - Get data
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $url = 'pesanan/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;

            if ($listgrupf) {
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Pesanan',
                        'list' => $this->pesanan->list(),
                        'akses' => $akses
                    ];
                    $msg = [
                        'data' => view('backend/cmscust/pesanan/list', $data)
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

    // Backend - Detail pesanan
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id_pesanan = $this->request->getVar('id_pesanan');
            $pesanan = $this->pesanan->find($id_pesanan);

            // Get detail items
            $detail = $this->pesanandetail->where('id_pesanan', $id_pesanan)->findAll();

            $data = [
                'title' => 'Detail Pesanan',
                'pesanan' => $pesanan,
                'detail' => $detail
            ];

            $msg = [
                'sukses' => view('backend/cmscust/pesanan/detail', $data)
            ];
            echo json_encode($msg);
        }
    }

    // Backend - Update status pesanan
    public function updatestatus()
    {
        if ($this->request->isAJAX()) {
            $id_pesanan = $this->request->getVar('id_pesanan');
            $status = $this->request->getVar('status_pesanan');
            $resi = $this->request->getVar('resi_pengiriman');

            $updatedata = [
                'status_pesanan' => $status
            ];

            // Update tanggal sesuai status
            if ($status == 'Diproses') {
                // Status diproses, tidak perlu update tanggal
            } elseif ($status == 'Dikirim') {
                $updatedata['tgl_kirim'] = date('Y-m-d H:i:s');
                if ($resi) {
                    $updatedata['resi_pengiriman'] = $resi;
                }
            } elseif ($status == 'Selesai') {
                $updatedata['tgl_selesai'] = date('Y-m-d H:i:s');
            } elseif ($status == 'Dibatalkan') {
                // Status dibatalkan
            }

            $this->pesanan->update($id_pesanan, $updatedata);

            $msg = [
                'sukses' => 'Status pesanan berhasil diupdate!'
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Update status pembayaran
    public function updatepembayaran()
    {
        if ($this->request->isAJAX()) {
            $id_pesanan = $this->request->getVar('id_pesanan');
            $status = $this->request->getVar('status_pembayaran');

            $updatedata = [
                'status_pembayaran' => $status
            ];

            if ($status == 'Lunas') {
                $updatedata['tgl_bayar'] = date('Y-m-d H:i:s');
            }

            $this->pesanan->update($id_pesanan, $updatedata);

            $msg = [
                'sukses' => 'Status pembayaran berhasil diupdate!'
            ];

            echo json_encode($msg);
        }
    }
}





