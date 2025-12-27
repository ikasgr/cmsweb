<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class Kritiksaran extends BaseController
{

    //front end
    public function masukansaran()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $suaraanda = $this->kritiksaran->listsuaraanda();
        
        $data = [
            'title' => 'Masukan & Saran ' . esc($konfigurasi->nama),
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'suaraanda' => $suaraanda->paginate(4, 'hal'),
            'pager' => $suaraanda->pager,
            'jum' => $this->kritiksaran->totsuaraanda(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'kategori' => $this->kategori->list(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
            'beritapopuler' => $this->berita->populer()->paginate(4),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'sitekey' => $konfigurasi->g_sitekey,
            'infografis10' => $this->banner->listinfopage()->paginate(10),
            'grafisrandom' => $this->banner->grafisrandom(),
            
        ];
        if (0) {
            $agent = $this->request->getUserAgent();
            if ($agent->isMobile()) {
                return view('frontend/desktop/' . 'content/masukansaran', $data);
            } else {
                return view('frontend/desktop/' . 'content/masukansaran', $data);
            }
        } else {
            return view('frontend/desktop/' . 'content/masukansaran', $data);
        }
    }

    public function formkritik()
    {

        if ($this->request->isAJAX()) {
            $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
            $g_sitekey = $konfigurasi['g_sitekey'];
            
            $data = [
                'title' => 'Masukan Saran',
                'konfigurasi' => $konfigurasi,
                'sitekey' => $g_sitekey,

            ];
            $msg = [

                'csrf_tokencmsdatagoe' => csrf_hash(),
                'data' => view('backend/modal/kritiksaranmd', $data),

            ];
            echo json_encode($msg);
        }
    }

    //back end
    public function list()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        
        $data = [
            'title' => 'Masukan',
            'subtitle' => 'Saran',

        ];

        return view('backend/interaksi/kritiksaran/index', $data);
    }

    public function getdataAs()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');

            $url = 'kritiksaran/list';
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            $akses = $listgrupf->akses;
            $hapus = $listgrupf->hapus;
            $ubah = $listgrupf->ubah;
            $tambah = $listgrupf->tambah;
            // jika temukan maka eksekusi
            
            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Masukan Saran',
                        'list' => $this->kritiksaran->list(),
                        'akses' => $akses,
                        'hapus' => $hapus,
                        'ubah' => $ubah,
                        'tambah' => $tambah,
                    ];
                    $msg = [
                        'data' => view('backend/interaksi/kritiksaran/list', $data),

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

    public function getdata()
    {

        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'kritiksaran/list';

        // Ambil grup akses
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Jika grup akses tidak ditemukan, kirimkan pesan akses belum ada
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        // Ambil data akses dan cek akses
        $akses = $listgrupf->akses;

        // Tentukan list kritiksaran berdasarkan akses
        if ($akses != '1' && $akses != '2') {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk tampilan
        $data = [
            'title' => 'Masukan Saran',
            'list' => $this->kritiksaran->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        

        // Siapkan respons JSON dengan data tampilan
        $msg = [
            'data' => view('backend/interaksi/kritiksaran/list', $data)
        ];

        echo json_encode($msg);
    }

    public function getdatanew()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            
            $data = [
                'list' => $this->kritiksaran->listkritiknew(),
                'totkritik' => $this->kritiksaran->totkritik()
            ];
            $msg = [
                'data' => view('backend/interaksi/kritiksaran/vmenukritik', $data)
            ];
            echo json_encode($msg);
        }
    }

    # public
    public function simpanKritik()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],

                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                    ]
                ],
                'judul' => [
                    'label' => 'Topik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',

                    ]
                ],
                'isi_kritik' => [
                    'label' => 'Isi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'no_hpusr' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        // 'max_length' => '{field} maksimal 13 karakter!',
                        // 'min_length' => '{field} minimal 13 karakter!',
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'email' => $validation->getError('email'),
                        'no_hpusr' => $validation->getError('no_hpusr'),
                        'judul' => $validation->getError('judul'),
                        'isi_kritik' => $validation->getError('isi_kritik'),
                    ]
                ];
            } else {
                $email = $this->request->getVar('email');
                $hpuser = $this->request->getVar('no_hpusr');
                $nama = $this->request->getVar('nama');
                $isi_kritik = $this->request->getVar('isi_kritik');
                $nm = htmlspecialchars($nama, ENT_QUOTES);
                $isi = htmlspecialchars($isi_kritik, ENT_QUOTES);
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $apikey = $konfigurasi['wa_token'];
                $phone = $konfigurasi['wa_sender_number'];
                $secretkey = $konfigurasi['google_secret'];
                $g_sitekey = $konfigurasi['g_sitekey'];

                // gcaptcha
                $secret = $secretkey;

                if ($secretkey != '' && $g_sitekey != '') {
                    $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));

                    $credential = array(
                        'secret' => $secret,
                        'response' => $recaptchaResponse
                    );

                    $verify = curl_init();
                    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($verify, CURLOPT_POST, true);
                    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
                    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($verify);

                    $status = json_decode($response, true);

                    if ($status['success']) {

                        $insertdata = [
                            'nama' => $nm,
                            'email' => $email,
                            'judul' => $this->request->getVar('judul'),
                            'no_hpusr' => $hpuser,
                            'isi_kritik' => $isi,
                            'tanggal' => date('Y-m-d'),
                            'status' => '0'

                        ];
                        $this->kritiksaran->insert($insertdata);
                        // $isipesan = '*Pesan dari :* ' . $nama . ' *Isi Pesan :* ' . $isi_kritik . ' _Klik disini untuk balas_ ' . base_url('kritiksararan/list');
                        $isipesan = 'Pesan dari : *' . $nama . '* Isi Pesan : *' . $isi_kritik . '* _[Klik disini untuk balas](' . base_url('kritiksararan/list') . ')';

                        if ($apikey != '' and $phone != '') {
                            $this->kirimWA($isipesan);
                        }
                        $msg = [
                            'sukses' => 'Pesan Anda sukses terkirim..! Tanggapan akan dikirimkan ke Email Anda!'
                        ];
                    } else {
                        $msg = [
                            'gagal' => 'Gagal kirim pesan Silahkan periksa Kembali!'
                        ];
                    }
                } else {

                    $insertdata = [
                        'nama' => $nm,
                        'email' => $email,
                        'judul' => $this->request->getVar('judul'),
                        'no_hpusr' => $hpuser,
                        'isi_kritik' => $isi,
                        'tanggal' => date('Y-m-d'),
                        'status' => '0'

                    ];
                    $this->kritiksaran->insert($insertdata);

                    // $isipesan = '*Pesan dari :* ' . $nama . ' *Isi Pesan :* ' . $isi_kritik . ' _Klik disini untuk balas_ ' . base_url('kritiksararan/list');
                    $isipesan = 'Pesan dari : *' . $nama . '* Isi Pesan : *' . $isi_kritik . '* _[Klik disini untuk balas](' . base_url('kritiksararan/list') . ')';

                    if ($apikey != '' and $phone != '') {
                        $this->kirimWA($isipesan);
                    }
                    $msg = [
                        'sukses' => 'Pesan Anda sukses terkirim..! Tanggapan akan dikirimkan ke Email Anda!'
                    ];
                }

                // gunakan google
            }
            echo json_encode($msg);
        }
    }

    // form balas masukan saran
    public function formedit()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_grup = session()->get('id_grup');
            $kritiksaran_id = $this->request->getVar('kritiksaran_id');
            $list = $this->kritiksaran->find($kritiksaran_id);
            $url = 'kritiksaran/list';
            $listgrupf = $this->grupakses->listgrupakses($id_grup, $url);
            
            $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();

            foreach ($listgrupf as $data):
                $akses = $data['akses'];
            endforeach;
            // jika temukan maka eksekusi
            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Detail Kritik Saran',
                        'kritiksaran_id' => $list['kritiksaran_id'],
                        'nama' => $list['nama'],
                        'email' => $list['email'],
                        'judul' => $list['judul'],
                        'no_hpusr' => $list['no_hpusr'],
                        'isi_kritik' => $list['isi_kritik'],
                        'tanggal' => $list['tanggal'],
                        'status' => $list['status'],
                        'balas' => $list['balas'],
                        'pesanbalas' => esc($konfigurasi['smtp_pesanbalas']),
                        'akses' => $akses,

                    ];
                    $msg = [
                        'sukses' => view('backend/interaksi/kritiksaran/edit', $data),
                        'csrf_tokencmsdatagoe' => csrf_hash(),
                        // 'sukses' => view('admin/interaksi/kritiksaran/edit', $data)
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
        }
        echo json_encode($msg);
    }

    public function updatestatus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'balas' => [
                    'label' => 'Tanggapan/Balasan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'balas' => $validation->getError('balas'),
                    ],
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            } else {

                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $balasbuka = $konfigurasi['smtp_pesanbalas']; //email dinas penyamaran
                $apikey = $konfigurasi['wa_token'];
                $phone = $konfigurasi['wa_sender_number']; //nomor wa gateway

                $logoUrl = base_url('/public/img/konfigurasi/logo/' . $konfigurasi['logo']);
                $namaweb = esc($konfigurasi['nama']);
                $smtp_pass = esc($konfigurasi['smtp_pass']);
                $noHpSupport = ($konfigurasi['no_telp']);
                $kritiksaran_id = $this->request->getVar('kritiksaran_id');
                $emailusr = $this->request->getVar('email'); //email user
                $nama = $this->request->getVar('nama'); //nama user
                $no_hpusr = $this->request->getVar('no_hpusr');
                $isi_kritik = esc($this->request->getVar('isi_kritik'));
                $balas = strip_tags($this->request->getVar('balas')); // Menghapus tag HTML
                // $balas          = $this->request->getVar('balas'); //isi balasan
                $title = 'Balasan Masukan dan Saran'; //nama email

                # template new email 
                $pesanbalas = '
                <!DOCTYPE html>
                <html lang="id">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Balasan Masukan dan Saran</title>
                </head>
                <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
                    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                        <!-- Header Email dengan Logo -->
                        <div style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid #ddd;">
                            <img src="' . $logoUrl . '" alt="Logo ' . $namaweb . '" style="width: 45%; margin-bottom: 15px;">
                            <h1 style="color: #4CAF50; margin-bottom: 8px;">' . $namaweb . '</h1>
                           
                        </div>

                        <!-- Isi Balasan -->
                        <div style="padding: 20px 0;">
                            <p style="color: #555; line-height: 1.6;">
                               ' . $balasbuka . '
                            </p>
                         <blockquote style="
                                margin: 20px 0;
                                padding: 15px;
                                background-color: #fce8e8;
                                border-left: 5px solid #ad5a4c;
                                color: #333;
                                font-style: italic;">
                                ' . nl2br(htmlspecialchars($isi_kritik)) . '
                            </blockquote>
                            <blockquote style="
                                margin: 20px 0;
                                padding: 15px;
                                background-color: #f9f9f9;
                                border-left: 5px solid #4CAF50;
                                color: #333;
                                font-style: italic;">
                                ' . nl2br(htmlspecialchars($balas)) . '
                            </blockquote>
                            <p style="color: #555; line-height: 1.6;">
                                Kami sangat menghargai setiap masukan yang diberikan oleh pengguna kami. Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.
                            </p>
                        </div>

                        <!-- Tombol CTA -->
                        <div style="text-align: center; margin: 20px 0;">
                            <a href="' . base_url() . '" style="
                                background-color: #4CAF50;
                                color: white;
                                padding: 10px 25px;
                                text-decoration: none;
                                border-radius: 5px;
                                font-size: 16px;
                                display: inline-block;">
                                Kunjungi Website Kami
                            </a>
                        </div>

                        <!-- Footer -->
                        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                        <div style="padding: 10px 0; text-align: center;">
                            <p style="
                                color: #777;
                                font-size: 14px;
                                line-height: 1.6;
                                margin-bottom: 10px;">
                                Email ini dikirim secara otomatis. Harap tidak membalas email ini.
                            </p>
                            <p style="
                                color: #555;
                                font-size: 14px;
                                line-height: 1.6;">
                                &copy; ' . date("Y") . ' <strong>' . $namaweb . '</strong>. Semua Hak Dilindungi.
                            </p>
                            <p style="
                                color: #555;
                                font-size: 12px;
                                line-height: 1.4;">
                                <em>Jika Anda memerlukan bantuan lebih lanjut, hubungi support kami melalui WhatsApp di 
                                <a href="https://wa.me/' . str_replace('+', '', $noHpSupport) . '" style="color: #4CAF50;">' . $noHpSupport . '</a></em>
                            </p>
                        </div>
                    </div>
                </body>
                </html>';

                $isibalas = 'Hallo, *' . $nama . '*.. ' . $balasbuka . 'Berikut Jawaban kami.. *' . $balas . '* _Jangan balas pesan ini, karena otomatis dari Sistem_ ' . $konfigurasi['website'];

                $data = [
                    'status' => '1',
                    'balas' => $balas,
                    'isi_kritik' => $isi_kritik,
                    'tgl_bls' => date('Y-m-d'),
                ];

                $this->kritiksaran->update($kritiksaran_id, $data);

                if ($smtp_pass != 'xxxxx') {
                    sendEmail($emailusr, $title, $pesanbalas);
                    $pesan = 'Pesan sukses ditanggapi & Terkirim ke Email!';
                } else {
                    $pesan = 'Pesan sukses ditanggapi..!';
                }

                if ($apikey != '' and $phone != '') {
                    $this->kirimWA($isibalas, $no_hpusr);
                }

                $msg = [
                    'sukses' => $pesan,
                    'csrf_tokencmsdatagoe' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function kirimWA($isipesan, $no_hpusr = null)
    {
        $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
        $apikey = $konfigurasi['wa_token']; // API Key WhatsApp
        $phone = $konfigurasi['wa_sender_number']; // Nomor WA Gateway
        $urlserver = $konfigurasi['urlserver']; // Server Layanan

        // Jika nomor pengguna tidak disertakan, gunakan nomor admin dari konfigurasi
        $hpuser = $no_hpusr ?? $konfigurasi['wa_receiver'];

        $data = [
            'api_key' => $apikey,
            'sender' => $phone, // Dari WA gateway
            'number' => $hpuser, // Penerima WA (bisa admin atau pengguna)
            'message' => $isipesan
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $urlserver,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data)
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response; // Bisa dikembalikan jika perlu di-handle lebih lanjut
    }


    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $kritiksaran_id = $this->request->getVar('kritiksaran_id');
            $cari = $this->kritiksaran->find($kritiksaran_id);

            if (!$cari) {
                echo json_encode(['error' => 'Data tidak ditemukan!']);
                return;
            }

            $isAktif = $cari['status'] == '2';
            $list = $isAktif ? $this->kritiksaran->getaktif($kritiksaran_id) : $this->kritiksaran->getnonaktif($kritiksaran_id);
            $toggle = $list ? ($isAktif ? 1 : 2) : ($isAktif ? 2 : 1);

            $this->kritiksaran->update($kritiksaran_id, ['status' => $toggle]);

            $msg = [
                'sukses' => $isAktif ? 'Berhasil dinonaktifkan!' : 'Berhasil menampilkan ke publik!'
            ];

            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $kritiksaran_id = $this->request->getVar('kritiksaran_id');

            $this->kritiksaran->delete($kritiksaran_id);
            $msg = [
                'sukses' => 'Data berhasil dihapus!',
                'csrf_tokencmsdatagoe' => csrf_hash(),
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
            $kritiksaran_id = $this->request->getVar('kritiksaran_id');
            $jmldata = count($kritiksaran_id);
            for ($i = 0; $i < $jmldata; $i++) {

                $this->kritiksaran->delete($kritiksaran_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
