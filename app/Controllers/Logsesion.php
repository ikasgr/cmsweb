<?php

namespace App\Controllers;

class Logsesion extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin         = $this->template->tempadminaktif();

        $data = [
            'title'       => 'Log Session',
            'subtitle'    => 'Login - User',
            'folder'      => $tadmin['folder'],
        ];
        return view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/logsession/index', $data);
    }

    public function getdata()
    {
        // Cek apakah session ID ada dan request AJAX
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return;
        }

        // Ambil data session dan setup koneksi database
        $id_grup = session()->get('id_grup');
        $url = 'konfigurasi';
        $tadmin = $this->template->tempadminaktif();

        // Ambil grup akses berdasarkan id_grup dan url
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Pastikan grup akses ditemukan dan cek akses
        if (!$listgrupf || $listgrupf->akses !== '1') {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Koneksi ke database dan ambil data dari tabel 'cms__usersessions'
        $db = \Config\Database::connect();
        $builder = $db->table('cms__usersessions');
        $sessions = $builder->get()->getResultArray();

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Logsesion',
            'list' => $sessions,
            'akses' => $listgrupf->akses,
            'hapus' => $listgrupf->hapus,
            'nmbscontrol' => $this->user,
        ];

        // Siapkan respons JSON dengan data dan CSRF token
        $msg = [
            'data' => view('backend/' . esc($tadmin['folder']) . '/pengaturan/logsession/list', $data),
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        echo json_encode($msg);
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_sesi = $this->request->getVar('id_sesi');
            $builder = $this->db->table('cms__usersessions');

            $builder->where('id', $id_sesi)->delete();

            $msg = [
                'sukses'                => 'Data berhasil dihapus!',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
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
            // Mendapatkan ID sesi yang dikirim melalui AJAX
            $id_sesi = $this->request->getVar('id_sesi');

            if (!is_array($id_sesi) || empty($id_sesi)) {
                // Jika $id_sesi kosong atau bukan array
                $msg = [
                    'error'                 => 'Tidak ada data yang dipilih untuk dihapus.',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
                echo json_encode($msg);
                return;
            }

            // Query Builder untuk tabel cms__usersessions
            $builder = $this->db->table('cms__usersessions');

            // Menghapus semua ID sesi yang dikirim
            $builder->whereIn('id', $id_sesi)->delete();

            // Memastikan apakah data terhapus
            if ($this->db->affectedRows() > 0) {
                $msg = [
                    'sukses'                => count($id_sesi) . " data berhasil dihapus.",
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            } else {
                $msg = [
                    'error'                 => 'Gagal menghapus data. Silakan coba lagi.',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }

            echo json_encode($msg);
        }
    }
}
