<?php

namespace App\Controllers;

class PesananUmkm extends BaseController
{
    // Backend - List pesanan
    public function list()
    {
        if (session()->get('id') == '') {
            return redirect()->to('/login');
        }



        $data = [
            'title' => 'Kelola Pesanan UMKM',
            'subtitle' => 'Manajemen Pesanan Produk UMKM',

        ];

        return view('backend/cmscust/pesanan_umkm/list', $data);
    }

    // Backend - Get data untuk DataTables
    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();

            $builder = $db->table('custome__pesanan')
                ->select('custome__pesanan.*, COUNT(custome__pesanan_detail.detail_id) as jml_item')
                ->join('custome__pesanan_detail', 'custome__pesanan_detail.pesanan_id = custome__pesanan.pesanan_id', 'left')
                ->groupBy('custome__pesanan.pesanan_id')
                ->orderBy('custome__pesanan.pesanan_id', 'DESC');

            // Filter by status
            if ($request->getVar('status') && $request->getVar('status') != '') {
                $builder->where('custome__pesanan.status_pesanan', $request->getVar('status'));
            }

            // Search
            if ($request->getVar('search')['value']) {
                $search = $request->getVar('search')['value'];
                $builder->groupStart()
                    ->like('kode_pesanan', $search)
                    ->orLike('nama_pembeli', $search)
                    ->orLike('no_hp', $search)
                    ->groupEnd();
            }

            $recordsTotal = $builder->countAllResults(false);

            // Pagination
            $start = $request->getVar('start') ?? 0;
            $length = $request->getVar('length') ?? 10;

            $data = $builder->limit($length, $start)->get()->getResultArray();

            $output = [
                'draw' => $request->getVar('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsTotal,
                'data' => $data
            ];

            echo json_encode($output);
        }
    }

    // Backend - Lihat detail pesanan
    public function formlihat()
    {
        if ($this->request->isAJAX()) {
            $pesanan_id = $this->request->getVar('pesanan_id');
            $pesanan = $this->pesanan->find($pesanan_id);

            if (!$pesanan) {
                $msg = ['error' => 'Data tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Get detail
            $db = \Config\Database::connect();
            $detail = $db->table('custome__pesanan_detail')
                ->where('pesanan_id', $pesanan_id)
                ->get()->getResultArray();

            // Get tracking
            $tracking = $db->table('custome__pesanan_tracking')
                ->select('custome__pesanan_tracking.*, users.fullname')
                ->join('users', 'users.id = custome__pesanan_tracking.user_id', 'left')
                ->where('pesanan_id', $pesanan_id)
                ->orderBy('tgl_update', 'DESC')
                ->get()->getResultArray();



            $data = [
                'title' => 'Detail Pesanan',
                'pesanan' => $pesanan,
                'detail' => $detail,
                'tracking' => $tracking
            ];

            $msg = [
                'sukses' => view('backend/cmscust/pesanan_umkm/lihat', $data)
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Update status pesanan
    public function updatestatus()
    {
        if ($this->request->isAJAX()) {
            $pesanan_id = $this->request->getVar('pesanan_id');
            $status = $this->request->getVar('status');
            $keterangan = $this->request->getVar('keterangan');

            $pesanan = $this->pesanan->find($pesanan_id);
            if (!$pesanan) {
                $msg = ['error' => 'Data tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Update status
            $data_update = [
                'status_pesanan' => $status,
                'admin_id' => session()->get('id')
            ];

            // Set tanggal sesuai status
            if ($status == 'Diproses') {
                $data_update['tgl_diproses'] = date('Y-m-d H:i:s');
            } elseif ($status == 'Dikirim') {
                $data_update['tgl_dikirim'] = date('Y-m-d H:i:s');
            } elseif ($status == 'Selesai') {
                $data_update['tgl_selesai'] = date('Y-m-d H:i:s');
            }

            $this->pesanan->update($pesanan_id, $data_update);

            // Insert tracking
            $db = \Config\Database::connect();
            $db->table('custome__pesanan_tracking')->insert([
                'pesanan_id' => $pesanan_id,
                'status' => $status,
                'keterangan' => $keterangan,
                'user_id' => session()->get('id'),
                'tgl_update' => date('Y-m-d H:i:s')
            ]);

            $msg = [
                'sukses' => 'Status pesanan berhasil diupdate!',
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus pesanan
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $pesanan_id = $this->request->getVar('pesanan_id');

            $pesanan = $this->pesanan->find($pesanan_id);
            if (!$pesanan) {
                $msg = ['error' => 'Data tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Hapus (akan cascade ke detail dan tracking)
            $this->pesanan->delete($pesanan_id);

            $msg = [
                'sukses' => 'Pesanan berhasil dihapus!',
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Hapus multiple
    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $pesanan_id = $this->request->getVar('pesanan_id');
            $jmldata = count($pesanan_id);

            foreach ($pesanan_id as $id) {
                $this->pesanan->delete($id);
            }

            $msg = [
                'sukses' => "$jmldata pesanan berhasil dihapus!",
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];

            echo json_encode($msg);
        }
    }

    // Backend - Print invoice
    public function print($pesanan_id)
    {
        if (session()->get('id') == '') {
            return redirect()->to('/login');
        }

        $pesanan = $this->pesanan->find($pesanan_id);
        if (!$pesanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get detail
        $db = \Config\Database::connect();
        $detail = $db->table('custome__pesanan_detail')
            ->where('pesanan_id', $pesanan_id)
            ->get()->getResultArray();

        $konfigurasi = $this->konfigurasi->vkonfig();


        $data = [
            'title' => 'Print Invoice',
            'pesanan' => $pesanan,
            'detail' => $detail,
            'konfigurasi' => $konfigurasi
        ];

        return view('backend/cmscust/pesanan_umkm/print', $data);
    }

    // Backend - Export Excel
    public function export()
    {
        if (session()->get('id') == '') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $pesanan = $db->table('custome__pesanan')
            ->orderBy('pesanan_id', 'DESC')
            ->get()->getResultArray();

        $data = [
            'title' => 'Export Pesanan',
            'pesanan' => $pesanan
        ];


        return view('backend/cmscust/pesanan_umkm/export', $data);
    }

    // Backend - Dashboard/Statistik
    public function dashboard()
    {
        if (session()->get('id') == '') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        // Count by status
        $pending = $db->table('custome__pesanan')->where('status_pesanan', 'Pending')->countAllResults();
        $diproses = $db->table('custome__pesanan')->where('status_pesanan', 'Diproses')->countAllResults();
        $dikirim = $db->table('custome__pesanan')->where('status_pesanan', 'Dikirim')->countAllResults();
        $selesai = $db->table('custome__pesanan')->where('status_pesanan', 'Selesai')->countAllResults();
        $dibatalkan = $db->table('custome__pesanan')->where('status_pesanan', 'Dibatalkan')->countAllResults();

        // Total pendapatan
        $pendapatan = $db->table('custome__pesanan')
            ->selectSum('total_bayar')
            ->where('status_pesanan', 'Selesai')
            ->get()->getRow();

        // Pesanan terbaru
        $terbaru = $db->table('custome__pesanan')
            ->orderBy('pesanan_id', 'DESC')
            ->limit(10)
            ->get()->getResultArray();



        $data = [
            'title' => 'Dashboard Pesanan UMKM',
            'subtitle' => 'Statistik & Monitoring Pesanan',

            'pending' => $pending,
            'diproses' => $diproses,
            'dikirim' => $dikirim,
            'selesai' => $selesai,
            'dibatalkan' => $dibatalkan,
            'pendapatan' => $pendapatan->total_bayar ?? 0,
            'terbaru' => $terbaru
        ];

        return view('backend/cmscust/pesanan_umkm/dashboard', $data);
    }
}





