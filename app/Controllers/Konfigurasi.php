<?php

namespace App\Controllers;

use Ifsnop\Mysqldump\Mysqldump;

class Konfigurasi extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin             = $this->template->tempadminaktif();
        $id_grup            = session()->get('id_grup');
        $url                = 'konfigurasi';
        $listgrupf          = $this->grupakses->viewgrupakses($id_grup, $url);
        $akses              = $listgrupf->akses;

        // jika temukan maka eksekusi
        if ($listgrupf) {
            # cek akses

            $fileName = date('Y-m-d') . '-backup.sql';

            $list       =  $this->konfigurasi->first();
            $template   = $this->template->tempaktif();
            if ($akses == '1') {
                $data = [
                    'title'             => 'Dashboard',
                    'subtitle'          => 'Konfigurasi',
                    'konfigurasi'       => $this->konfigurasi->list(),
                    'mkategori'         => $this->kategori->list(),
                    'id_setaplikasi'    => $list['id_setaplikasi'],
                    'nama'              => esc($list['nama']),
                    'alamat'            => esc($list['alamat']),
                    'no_telp'           => $list['no_telp'],
                    'google_map'        => $list['google_map'],
                    'login_alias'       => $list['kecamatan'], //url page login
                    'kabupaten'         => $list['kabupaten'],
                    'provinsi'          => $list['provinsi'],
                    'website'           => $list['website'],
                    'email'             => $list['email'],
                    'deskripsi'         => $list['deskripsi'],
                    'logo'              => $list['logo'],
                    'sts_sambutan'      => $list['sts_sambutan'],
                    'icon'              => $list['icon'],
                    'link_gmap'         => $list['link_gmap'],
                    'sosmed_fb'         => $list['sosmed_fb'],
                    'sosmed_instagram'  => $list['sosmed_instagram'],
                    'sosmed_twiter'     => $list['sosmed_twiter'],
                    'sosmed_youtube'    => $list['sosmed_youtube'],
                    'kategori_id'       => $list['kategori_id'],
                    'judul_section'     => $list['judul_section'],
                    'sts_section'       => $list['sts_section'],
                    'sts_modal'         => $list['sts_modal'],
                    'sts_rt'            => $list['sts_rt'],
                    'sts_count'         => $list['sts_count'],
                    'vercms'            => $list['vercms'],
                    'sts_regis'         => $list['sts_regis'],
                    'sts_web'           => $list['sts_web'],
                    'sts_posting'       => $list['sts_posting'],
                    'mail_host'         => $list['mail_host'],
                    'mail_user'     => $list['mail_user'],
                    'smtp_pass'     => $list['smtp_pass'],
                    'smtp_port'         => $list['smtp_port'],
                    'smtp_pengirim'     => $list['smtp_pengirim'],
                    'smtp_pesanbalas'   => $list['smtp_pesanbalas'],
                    'konek_opd'         => $list['konek_opd'],
                    'id_grup'           => $list['id_grup'],
                    'footer_cms'        => $list['footer_cms'],
                    'saveweb'           => session()->get('setweb'),
                    'listgrup'          => $this->grupuser->listgrups(),
                    'akses'             => $akses,
                    'katamutiara'       => $list['katamutiara'],
                    'wa_token'           => $list['wa_token'],
                    'wa_sender_number'      => $list['wa_sender_number'],
                    'wa_receiver'       => $list['wa_receiver'],
                    'namasingkat'       => $list['namasingkat'],
                    'urlserver'         => $list['urlserver'],
                    'google_secret'       => $list['google_secret'],
                    'g_sitekey'         => $list['g_sitekey'],
                    'is_maintenance'    => $list['is_maintenance'],
                    'otp_akses'         => $list['otp_akses'],
                    // 'multi_login'       => $list['multi_login'],
                    'verdb'             => $list['verdb'],
                    'folder'            => $tadmin['folder'],
                    'wllogo'            => $template['wllogo'],
                    'hplogo'            => $template['hplogo'],
                    'wlbanner'          => $template['wlbanner'],
                    'hpbanner'          => $template['hpbanner'],
                    'verbost'           => $template['verbost'],
                    'temaaktif'         => $template['nama'],
                    'fileName'          => $fileName,
                    'csrf_tokencmsikasmedia' => csrf_hash(),

                ];
                return view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/konfigurasi/index', $data);
            } else {
                return redirect()->to(base_url('dasboard'));
            }
        } else {
            return redirect()->to(base_url('dasboard'));
        }
    }

    public function simpankonfig()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama situs',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'no_telp' => [
                    'label' => 'no_telp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kabupaten' => [
                    'label' => 'kabupaten',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'login_alias' => [
                    'label' => 'Page URL Login',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'provinsi' => [
                    'label' => 'provinsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'website' => [
                    'label' => 'Alamat situs',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'google_map' => [
                    'label' => 'Google Map',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'link_gmap' => [
                    'label' => 'Link berbagi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sosmed_fb' => [
                    'label' => 'Facebook',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sosmed_instagram' => [
                    'label' => 'Instagram',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sosmed_twiter' => [
                    'label' => 'Twitter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'sosmed_youtube' => [
                    'label' => 'Youtube',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'judul_section' => [
                    'label' => 'Judul Section',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => $this->validator->getErrors(),
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $id_setaplikasi         = $this->request->getVar('id_setaplikasi');
                $smtp_pass              = $this->request->getVar('smtp_pass');

                $otp_akses = ($smtp_pass == 'xxxxx') ? 0 : $this->request->getVar('otp_akses');

                $simpandata = [
                    'nama'              => $this->request->getVar('nama'),
                    'alamat'            => $this->request->getVar('alamat'),
                    'no_telp'           => $this->request->getVar('no_telp'),
                    'kecamatan'         => mb_url_title($this->request->getVar('login_alias'), '-', TRUE),
                    'kabupaten'         => $this->request->getVar('kabupaten'),
                    'provinsi'          => $this->request->getVar('provinsi'),
                    'website'           => $this->request->getVar('website'),
                    'email'             => $this->request->getVar('email'),
                    'deskripsi'         => $this->request->getVar('deskripsi'),
                    'google_map'        => $this->request->getVar('google_map'),
                    'link_gmap'         => $this->request->getVar('link_gmap'),
                    'sosmed_fb'         => $this->request->getVar('sosmed_fb'),
                    'sosmed_instagram'  => $this->request->getVar('sosmed_instagram'),
                    'sosmed_twiter'     => $this->request->getVar('sosmed_twiter'),
                    'sosmed_youtube'    => $this->request->getVar('sosmed_youtube'),
                    'kategori_id'       => $this->request->getVar('kategori'),
                    'judul_section'     => $this->request->getVar('judul_section'),
                    'sts_section'       => $this->request->getVar('sts_section'),
                    'sts_modal'         => $this->request->getVar('sts_modal'),
                    'sts_rt'            => $this->request->getVar('sts_rt'),
                    'sts_count'         => $this->request->getVar('sts_count'),
                    'sts_regis'         => $this->request->getVar('sts_regis'),
                    'sts_posting'       => $this->request->getVar('sts_posting'),
                    'mail_host'         => $this->request->getVar('mail_host'),
                    'mail_user'         => $this->request->getVar('mail_user'),
                    'smtp_pass'         => $smtp_pass,
                    'smtp_port'         => $this->request->getVar('smtp_port'),
                    'smtp_pengirim'     => $this->request->getVar('smtp_pengirim'),
                    'smtp_pesanbalas'   => $this->request->getVar('smtp_pesanbalas'),
                    'konek_opd'         => $this->request->getVar('konek_opd'),
                    'id_grup'           => $this->request->getVar('id_grup'),
                    'footer_cms'        => $this->request->getVar('footer_cms'),
                    'katamutiara'       => $this->request->getVar('katamutiara'),
                    'wa_token'           => $this->request->getVar('wa_token'),
                    'wa_sender_number'      => $this->request->getVar('wa_sender_number'),
                    'wa_receiver'       => $this->request->getVar('wa_receiver'),
                    'namasingkat'       => $this->request->getVar('namasingkat'),
                    'urlserver'         => $this->request->getVar('urlserver'),
                    'google_secret'       => $this->request->getVar('google_secret'),
                    'g_sitekey'         => $this->request->getVar('g_sitekey'),
                    'otp_akses'         => $otp_akses,

                ];
                $this->konfigurasi->update($id_setaplikasi, $simpandata);

                $msg = [
                    'sukses'                => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formuploadlogo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $list =  $this->konfigurasi->orderBy('id_setaplikasi ')->first();
            $data = [
                'title'          => 'Ganti Logo Website',
                'logo'           => $list['logo'],
                'id_setaplikasi' => $list['id_setaplikasi']
            ];
            $msg = [
                'sukses'                => view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/konfigurasi/uploadlogo', $data),
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];
            echo json_encode($msg);
        }
    }

    public function douploadlogo()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'logo' => [
                    'label' => 'Upload Logo',
                    'rules' => 'uploaded[logo]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar logo',
                        'mime_in' => 'Harus gambar!'
                    ],

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'logo' => $validation->getError('logo'),

                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                $id_setaplikasi = $this->request->getVar('id_setaplikasi');
                // $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $template = $this->template->tempaktif();

                $lebar = $template['wllogo'];
                $panjang = $template['hplogo'];

                //check
                $cekdata = $this->konfigurasi->find($id_setaplikasi);
                $fotolama = $cekdata['logo'];
                if (
                    $fotolama != 'p1.png' || $fotolama != 'p2.png' || $fotolama != 'p3.png' || $fotolama != 'bs.png' || $fotolama != 'pnpt.png' || $fotolama != 'p4.png'
                    && file_exists('public/img/konfigurasi/logo/' . $fotolama)
                ) {
                    unlink('public/img/konfigurasi/logo/' . $fotolama);
                }

                $filegambar = $this->request->getFile('logo');
                $nama_file = $filegambar->getRandomName();
                $updatedata = [
                    'logo'             => $nama_file,
                ];

                $this->konfigurasi->update($id_setaplikasi, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->fit($lebar, $panjang, 'center')
                    ->save('public/img/konfigurasi/logo/' .  $nama_file);

                $msg = [
                    'sukses'                => 'Logo berhasil diupload!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formuploadicon()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_setaplikasi = $this->request->getVar('id_setaplikasi');
            $list = $this->konfigurasi->find($id_setaplikasi);
            $tadmin = $this->template->tempadminaktif();
            $data = [
                'title' => 'Upload Icon Website',
                'list'  => $list,
                'id_setaplikasi' => $list['id_setaplikasi']
            ];
            $msg = [
                'sukses'                => view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/konfigurasi/uploadicon', $data),
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];
            echo json_encode($msg);
        }
    }

    public function douploadicon()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {

            $id_setaplikasi = $this->request->getVar('id_setaplikasi');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'icon' => [
                    'label' => 'Upload Icon',
                    'rules' => 'uploaded[icon]|mime_in[icon,image/png,image/jpg,image/jpeg]|is_image[icon]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar',
                        'mime_in' => 'Harus gambar!'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'icon' => $validation->getError('icon')
                    ],

                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {

                //check
                $cekdata = $this->konfigurasi->find($id_setaplikasi);
                $fotolama = $cekdata['icon'];
                if ($fotolama != '' && file_exists('public/img/konfigurasi/icon/' . $fotolama)) {
                    unlink('public/img/konfigurasi/icon/' . $fotolama);
                }

                $filegambar = $this->request->getFile('icon');
                $nama_file = $filegambar->getRandomName();

                $updatedata = [
                    'icon' => $nama_file,
                ];

                $this->konfigurasi->update($id_setaplikasi, $updatedata);

                \Config\Services::image()
                    ->withFile($filegambar)
                    ->save('public/img/konfigurasi/icon/' .  $nama_file);

                $msg = [
                    'sukses'                => 'Icon berhasil diupload!',
                    'csrf_tokencmsikasmedia'  => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function doBackup()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();

            try {
                $tgl = date('dym');
                $pass = $db->password;
                $host = $db->hostname;
                $user = $db->username;
                $dbx = $db->database;
                $port = $db->port;
                $isi1 = 'mysql:host=' . $host . ';dbname=' . $dbx . ';port=' . $port;
                $dump = new Mysqldump($isi1, $user, $pass);
                $fileName = ROOTPATH . 'public/file/db/' . date('Y-m-d') . '-backup.sql';
                $dump->start($fileName);

                $msg = [
                    'sukses'                => 'DB berhasil dibackup!',
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                    'file'                  => $fileName,
                ];
            } catch (\Exception $e) {
                // echo 'mysqldump-php error: ' . $e->getMessage();
                $msg = [
                    'error'                 => 'mysqldump-php error:' . $e->getMessage(),
                    'csrf_tokencmsikasmedia'  => csrf_hash(),
                ];
            }
        }
        echo json_encode($msg);
    }

    public function hapusfile()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $filename      = $this->request->getVar('filename');

            if (file_exists('public/file/db/' . $filename)) {
                unlink('public/file/db/' . $filename);
            }

            $msg = [
                'sukses'                => 'file Berhasil Dihapus',
                'csrf_tokencmsikasmedia'  => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }

    public function maintanance()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $is_maintenance         = $this->request->getVar('is_maintenance');
            if ($is_maintenance == 1) {
                $data = [
                    'is_maintenance'        => false,
                ];
                $ketsukses = 'Berhasil nonaktifkan Mode Maintanance';
            } else {
                $data = [
                    'is_maintenance'        => true,
                ];
                $ketsukses = 'Berhasil aktifkan Mode Maintanance';
            }
            $this->konfigurasi->update(1, $data);

            $msg = [
                'sukses' => $ketsukses
            ];
            echo json_encode($msg);
        }
    }
}
