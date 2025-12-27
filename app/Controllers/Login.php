<?php

namespace App\Controllers;

use Config\Services;
use App\Models\ModelUser;

class Login extends BaseController
{

    public function __construct()
    {
        $this->session = Services::session();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (session('login')) {
            return redirect()->to(base_url('dashboard'));
        }
        $konfigurasi = $this->konfigurasi->vkonfig();


        $data = [
            'title' => 'Login',
            'konfigurasi' => $konfigurasi,

            'sitekey' => $konfigurasi->g_sitekey,
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $offkan = ['sts_on' => '0'];

        $builder->update($offkan, "sts_on != 'x'");

        return view('backend/auth/v_login_user', $data);
    }


    public function validasi()
    {
        if ($this->request->isAJAX()) {
            $username = esc($this->request->getVar('username'));
            $password_hash = esc($this->request->getVar('password_hash'));
            $otp_input = esc($this->request->getVar('otp')); // Input OTP
            $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            $session = session();
            $validation = \Config\Services::validation();
            $db = \Config\Database::connect();

            // Validasi input username dan password
            $isValidInput = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!'],
                ],
                'password_hash' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} wajib diisi!'],
                ],
            ]);

            if (!$isValidInput) {
                echo json_encode([
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password_hash' => $validation->getError('password_hash'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Konfigurasi reCAPTCHA
            $konfigurasi = $this->konfigurasi->vkonfig();
            $secretkey = esc($konfigurasi->google_secret);
            $g_sitekey = esc($konfigurasi->g_sitekey);

            // Validasi reCAPTCHA hanya jika belum ada OTP
            if ($secretkey && $g_sitekey && empty($otp_input)) {
                if (!$this->validateRecaptcha($recaptchaResponse, $secretkey)) {
                    echo json_encode([
                        'gagalcap' => 'Validasi reCAPTCHA gagal. Silakan coba lagi!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                    return;
                }
            }

            // Cari user berdasarkan username
            $user = $this->user->where('username', $username)->first();

            if (!$user) {
                echo json_encode([
                    'error' => ['username' => 'Username/Password salah!'],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            $builder = $db->table('cms__usersessions');
            $sessionData = $builder->where('user_id', $user['id'])->get()->getRow();

            if ($sessionData) {
                // Jika session ditemukan, berarti pengguna sudah login di lokasi lain
                echo json_encode([
                    'sumasuk' => 'Pengguna sudah login di lokasi lain!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Periksa status aktif
            if ($user['active'] != 1) {
                echo json_encode([
                    'nonactive' => 'Status akun Anda tidak aktif, silakan hubungi admin!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Konfigurasi OTP
            $otp_akses = esc($konfigurasi->otp_akses);
            $otpCode = rand(100000, 999999);
            $title = 'Kode OTP Login - ' . esc($konfigurasi->nama);

            // Validasi password jika OTP belum diinput
            if (empty($otp_input) && !password_verify($password_hash, $user['password_hash'])) {
                $loginAttempts = $user['login_attempts'] + 1;
                $this->user->update($user['id'], ['login_attempts' => $loginAttempts]);

                // Kirim OTP jika upaya login melebihi 3 kali
                if ($loginAttempts > 2) {
                    if ($otp_akses == 1 && empty($user['otp_code'])) {
                        $this->user->update($user['id'], ['otp_code' => $otpCode]);
                        $emailContent = $this->generateOtpEmail($otpCode, base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)), esc($konfigurasi->nama), esc($konfigurasi->no_telp));
                        if (sendEmail($user['email'], $title, $emailContent)) {
                            echo json_encode([
                                'otp_needed' => 'Kode OTP telah dikirim ke email Anda.',
                                'csrf_tokencmsikasmedia' => csrf_hash(),
                            ]);
                        } else {
                            echo json_encode([
                                'emailerr' => 'Gagal mengirim kode OTP ke email!',
                                'csrf_tokencmsikasmedia' => csrf_hash(),
                            ]);
                        }
                        return;
                    }

                    echo json_encode([
                        'usahalebih' => 'Terlalu banyak upaya login. Coba lagi nanti!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                    return;
                }

                echo json_encode([
                    'error' => ['password_hash' => 'Username/Password salah!'],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Validasi OTP jika diaktifkan
            if ($otp_akses == 1 && !empty($otp_input)) {
                if ($otp_input !== $user['otp_code']) {
                    echo json_encode([
                        'otpsalah' => 'Kode OTP salah!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                    return;
                }

                // Reset OTP dan login attempts
                $this->user->update($user['id'], ['otp_code' => '', 'login_attempts' => 0]);
            }

            // Proses login sukses
            $this->processSuccessfulLogin($user, $session);
        }
    }


    /**
     * Function untuk proses login sukses
     */
    private function processSuccessfulLogin($user, $session)
    {
        // Regenerate session ID untuk menghindari session fixation
        $session->regenerate();

        // Set session data setelah login
        $simpan_session = [
            'login' => true,
            'id' => $user['id'],
            'username' => $user['username'],
            'fullname' => esc($user['fullname']),
            'user_image' => esc($user['user_image']),
            'id_grup' => esc($user['id_grup']),
            'setweb' => 'https://cms.datagoe.com/',
            'session_id' => session_id(),
        ];
        $session->set($simpan_session);

        echo json_encode([
            'sukses' => ['csrf_tokencmsikasmedia' => csrf_hash()],
        ]);
    }


    public function validasiKonsep1()
    {
        if ($this->request->isAJAX()) {
            // Ambil data input
            $username = esc($this->request->getVar('username'));
            $password_hash = esc($this->request->getVar('password_hash'));
            $otp_input = esc($this->request->getVar('otp')); // Input OTP
            $session = session();
            $validation = \Config\Services::validation();
            $db = \Config\Database::connect();

            // Validasi input username dan password
            $isValidInput = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi!',
                    ],
                ],
                'password_hash' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi!',
                    ],
                ],
            ]);

            if (!$isValidInput) {
                echo json_encode([
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password_hash' => $validation->getError('password_hash'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Cari user berdasarkan username
            $user = $this->user->where('username', $username)->first();

            if (!$user) {
                echo json_encode([
                    'error' => [
                        'username' => 'Username/Password salah!',
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Cek apakah pengguna sudah login di lokasi lain
            $konfigurasi = $this->konfigurasi->vkonfig();
            $secretkey = esc($konfigurasi->google_secret);  // reCAPTCHA secret key
            $g_sitekey = esc($konfigurasi->g_sitekey);    // reCAPTCHA site key
            $otp_akses = esc($konfigurasi->otp_akses);    // Apakah OTP diaktifkan
            $img = base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo));
            $namaweb = esc($konfigurasi->nama);
            $noHpSupport = esc($konfigurasi->no_telp);
            $sessionId = session_id();
            $otpCode = rand(100000, 999999);
            $title = 'Kode OTP Login - ' . esc($konfigurasi->nama);
            $builder = $db->table('cms__usersessions');
            $sessionData = $builder->where('user_id', $user['id'])->get()->getRow();

            if ($sessionData) {
                // Jika session ditemukan, berarti pengguna sudah login di lokasi lain
                echo json_encode([
                    'sumasuk' => 'Pengguna sudah login di lokasi lain!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Validasi password
            if (!password_verify($password_hash, $user['password_hash'])) {
                $this->user->update($user['id'], ['login_attempts' => $user['login_attempts'] + 1]);
                if ($user['login_attempts'] >= 2) {
                    echo json_encode([
                        'usahalebih' => 'Terlalu banyak upaya login. Coba lagi nanti!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                } else {
                    echo json_encode([
                        'error' => [
                            'password_hash' => 'Username/Password salah!',
                        ],
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                }
                return;
            }

            // Reset login attempts jika password benar
            $this->user->update($user['id'], ['login_attempts' => 0]);

            // Periksa status aktif
            if ($user['active'] != 1) {
                echo json_encode([
                    'error' => [
                        'nonactive' => 'Status akun Anda tidak aktif, silakan hubungi admin!',
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Validasi OTP hanya jika OTP diaktifkan
            if ($otp_akses == 1) {

                // Cek apakah OTP sudah ada di database
                if (empty($user['otp_code'])) {

                    // Generate OTP dan simpan di database
                    $otpCode = rand(100000, 999999);
                    $this->user->update($user['id'], ['otp_code' => $otpCode]); // Menyimpan OTP ke database

                    $emailContent = $this->generateOtpEmail($otpCode, $img, $namaweb, $noHpSupport);

                    // Generate dan kirim OTP
                    $this->user->update($user['id'], ['otp_code' => $otpCode]);

                    // Kirim OTP via email
                    if (sendEmail($user['email'], $title, $emailContent)) {
                        echo json_encode([
                            'otp_needed' => 'Kode OTP telah dikirim ke email Anda. Masukkan kode OTP.',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ]);
                    } else {
                        echo json_encode([
                            'emailerr' => 'Gagal mengirim kode OTP ke email!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ]);
                    }
                    return; // Hentikan eksekusi jika OTP perlu diverifikasi
                }

                // Jika OTP telah ada, periksa input OTP pengguna
                if ($otp_input !== $user['otp_code']) {
                    echo json_encode([
                        'otpsalah' => 'Kode OTP salah!',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                    return;
                }
                // Reset OTP setelah berhasil diverifikasi
                $this->user->update($user['id'], ['otp_code' => '']);
            }

            // Validasi reCAPTCHA (jika diperlukan)
            if (!empty($secretkey)) {
                $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
                if (!$this->validateRecaptcha($recaptchaResponse, $secretkey)) {
                    echo json_encode([
                        'gagalcap' => 'Validasi reCAPTCHA gagal. Silakan coba lagi.',
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ]);
                    return;
                }
            }

            // Regenerate session ID untuk menghindari session fixation
            $session->regenerate();
            // Set session data setelah login
            $sessionId = session_id();
            $data = [
                'last_login' => date('Y-m-d H:i:s'),
                'sts_on' => '1',
                'login_attempts' => 0,
            ];
            $this->user->update($user['id'], $data); // Update data user di database

            // Simpan session data
            $simpan_session = [
                'login' => true,
                'id' => $user['id'],
                'username' => $username,
                'fullname' => esc($user['fullname']),
                'user_image' => esc($user['user_image']),
                'id_grup' => esc($user['id_grup']),
                'setweb' => 'https://cms.datagoe.com/',
                'session_id' => $sessionId,
            ];
            $session->set($simpan_session); // Menyimpan session data

            echo json_encode([
                'sukses' => ['csrf_tokencmsikasmedia' => csrf_hash()],
            ]);
        }
    }

    // Fungsi untuk memvalidasi reCAPTCHA
    private function validateRecaptcha($response, $secret)
    {
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query(['secret' => $secret, 'response' => $response]));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        $status = json_decode($response, true);

        return $status['success'] ?? false;
    }

    // Fungsi untuk menghasilkan konten email OTP
    public function generateOtpEmail($otpCode, $img, $namaweb, $noHpSupport)
    {

        $pesanbalas = '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kode OTP</title>
    </head>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div style="text-align: center; padding-bottom: 20px;">
                <img src="' . $img . '" alt="Logo ' . $namaweb . '" title="Logo ' . $namaweb . '" style="width: 45%; margin-bottom: 8px;">
                <h2 style="color: #333;">Kode OTP</h2>
            </div>
            <p style="color: #555; text-align: center; line-height: 1.6;">
                Untuk dapat mengakses dashboard, silakan masukkan kode OTP di bawah ini:
            </p>
            <div style="text-align: center; margin: 20px 0;">
                <span style="
                    display: inline-block;
                    background-color: #4CAF50;
                    color: white;
                    padding: 15px 30px;
                    font-size: 24px;
                    font-weight: bold;
                    text-decoration: none;
                    border-radius: 5px;">
                    ' . $otpCode . '
                </span>
            </div>
            
            <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
             <div style="padding: 10px 0; text-align: center;">
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
                    <em>Jika Anda memerlukan bantuan, hubungi kami melalui WhatsApp di <a href="https://wa.me/' . str_replace("+", "", $noHpSupport) . '" style="color: #4CAF50;">' . $noHpSupport . '</a></em>
                </p>
            </div>
        </div>
    </body>
    </html>';
        // Mengembalikan email yang dihasilkan
        return $pesanbalas;
    }

    public function logout()
    {
        if ($this->request->isAJAX()) {
            $id = session()->get('id');

            $offkan = ['sts_on' => '0'];
            $this->user->update($id, $offkan);

            $db = \Config\Database::connect();
            $builder = $db->table('cms__usersessions');
            $builder->where('user_id', $id)->delete();

            // $session->regenerate();
            session()->destroy();

            // Kirimkan respons JSON
            $data = [
                'respond' => 'success',
                'message' => 'Anda berhasil Keluar..!',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            return $this->response->setJSON($data);
        }
    }

    // FORGOT v_reset
    public function lupapassword()
    {
        if (session('login')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Lupa Password',

            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        return view('backend/auth/v_forgot', $data);
    }

    public function proseslupa()
    {
        if ($this->request->isAJAX()) {
            $email = htmlspecialchars($this->request->getVar('email'));
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'email' => $validation->getError('email'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $session = session();

                // Cek user berdasarkan email
                $user = $this->user->where('email', $email)->first();
                if ($user) {
                    $user_id = $user['id'];
                    if ($user['email'] == $email) {
                        // Cek apakah token reset masih berlaku
                        if (!empty($user['reset_expires']) && $user['reset_expires'] >= time()) {
                            $session->regenerate();
                            $msg = [
                                'resetexpair' => ['csrf_tokencmsikasmedia' => csrf_hash()],
                            ];
                        } else {
                            // Regenerasi sesi dan buat token reset baru
                            $session->regenerate();
                            helper('text');

                            $reshas = bin2hex(random_bytes(16)); // Menghasilkan string acak 32 karakter
                            $updatedata = [
                                'reset_hash' => $reshas,
                                'reset_expires' => time() + HOUR,
                            ];
                            $this->user->update($user_id, $updatedata);
                            $konfigurasi = $this->konfigurasi->vkonfig();
                            $img = base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo));
                            $namaweb = esc($konfigurasi->nama);
                            $noHpSupport = esc($konfigurasi->no_telp);
                            # Persiapkan isi email

                            # new template
                            $balas = base_url('resetpassword?token=' . $reshas);
                            $title = 'Reset Password Login -' . $namaweb;

                            $pesanbalas = '
                            <!DOCTYPE html>
                            <html lang="id">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Reset Password</title>
                            </head>
                            <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
                                <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                    <div style="text-align: center; padding-bottom: 20px;">
                                        <img src="' . $img . '" alt="Logo ' . $namaweb . '" title="Logo ' . $namaweb . '" style="width: 45%; margin-bottom: 8px;">
                                        <h2 style="color: #333;">Permintaan Reset Password</h2>
                                    </div>
                                    <p style="color: #555; line-height: 1.6;">
                                        Halo,
                                    </p>
                                    <p style="color: #555; line-height: 1.6;">
                                        Kami menerima permintaan untuk mereset password Anda. Jika Anda tidak melakukan permintaan ini, Anda dapat mengabaikan email ini dengan aman.
                                    </p>
                                    <p style="color: #555; line-height: 1.6;">
                                        Untuk mengubah password Anda, silakan klik tombol di bawah ini:
                                    </p>
                                    <div style="text-align: center; margin: 20px 0;">
                                        <a href="' . $balas . '" style="
                                            background-color: #4CAF50;
                                            color: white;
                                            padding: 10px 25px;
                                            text-decoration: none;
                                            border-radius: 5px;
                                            font-size: 16px;
                                            display: inline-block;">
                                            Reset Password
                                        </a>
                                    </div>
                                    <p style="color: #555; line-height: 1.6;">
                                        Atau Anda bisa mengunjungi link berikut secara manual:
                                        <br>
                                        <a href="' . $balas . '" style="color: #4CAF50; word-wrap: break-word;">' . $balas . '</a>
                                    </p>
                                    <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
                                    
                                    <!-- Bagian Footer yang Diperbarui -->
                                    <div style="padding: 10px 0; text-align: center;">
                                        <p style="
                                            color: #777;
                                            font-size: 14px;
                                            line-height: 1.6;
                                            margin-bottom: 10px;">
                                            Jika Anda tidak merasa melakukan permintaan reset password, abaikan pesan ini. Email ini dibuat secara otomatis, harap tidak membalas email ini.
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
                                            <em>Jika Anda memerlukan bantuan, hubungi kami melalui WhatsApp di <a href="https://wa.me/' . str_replace('+', '', $noHpSupport) . '" style="color: #4CAF50;">' . $noHpSupport . '</a></em>
                                        </p>
                                    </div>
                                </div>
                            </body>
                            </html>';

                            // Panggil helper sendEmail
                            if (sendEmail($email, $title, $pesanbalas)) {
                                $msg = ['sukses' => []];
                            } else {
                                $msg = [
                                    'error' => [
                                        'email' => 'Gagal mengirim email!',
                                        'csrf_tokencmsikasmedia' => csrf_hash(),
                                    ]
                                ];
                            }
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'password_hash' => 'Password salah!',
                                'csrf_tokencmsikasmedia' => csrf_hash(),
                            ]
                        ];
                    }
                } else {
                    $session->regenerate();
                    $msg = [
                        'wrongemail' => [
                            'wrongemail' => 'Email tidak ditemukan!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        }
    }


    public function resetpassword()
    {

        $users = new ModelUser();
        $token = $this->request->getGet('token');

        $user = $users->where('reset_hash', $token)
            ->where('reset_expires >', time())
            ->first();
        if (!$user) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'token' => $token,

        ];
        return view('backend/auth/v_reset', $data);
    }


    public function prosesgantipass()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[10]|max_length[20]|regex_match[/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'min_length' => 'Masukkan {field} minimal 10 Karakter!',
                        'max_length' => 'Masukkan {field} maksimal 20 Karakter!',
                        'regex_match' => '{field} sangat lemah ',
                    ]
                ],
                'password_confirm' => [
                    'label' => 'Password',
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => '{field} tidak sama!',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $users = new ModelUser();
                $session = session();

                $user = $users->where('reset_hash', $this->request->getVar('token'))
                    ->where('reset_expires >', time())->first();
                //cek user

                if (!$user) {
                    // Hapus semua data session
                    $session->regenerate();
                    return redirect()->to(base_url('login'));
                } else {
                    $session->regenerate();
                    $user_id = $user['id'];

                    $updatedata = [
                        'reset_hash' => null,
                        'reset_expires' => null,
                        'password_hash' => (password_hash($this->request->getVar('password_confirm'), PASSWORD_BCRYPT)),
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];

                    $this->user->update($user_id, $updatedata);
                    $msg = [
                        'sukses' => []
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    // Registrasi
    public function registrasi()
    {
        if (session('login')) {
            return redirect()->to(base_url('dashboard'));
        }
        $konfigurasi = $this->konfigurasi->vkonfig();
        $sts = $konfigurasi->sts_regis;
        $konopd = $konfigurasi->konek_opd;

        if ($konopd == 1) {
            $opd = $this->unitkerja->listopd();
        } else {
            $opd = '';
        }

        if ($sts == 0) {
            return redirect()->to(base_url('/'));
        }

        $data = [
            'title' => 'Registrasi Pengguna',
            'opd' => $opd,
            'konfigurasi' => $konfigurasi,
            'sitekey' => $konfigurasi->g_sitekey,
            'csrf_tokencmsikasmedia' => csrf_hash(),


        ];

        return view('backend/auth/v_registrasi', $data);
    }

    # proses simpan daftar akun

    public function daftarakun()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} tidak valid!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ],
                ],
                'fullname' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|max_length[15]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'max_length' => 'Masukkan {field} maksimal 15 Karakter!',
                    ],
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                        'is_unique' => '{field} tidak diijinkan, Silahkan ganti..!',
                    ],
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[10]|max_length[20]|regex_match[/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'min_length' => 'Masukkan {field} minimal 10 Karakter!',
                        'max_length' => 'Masukkan {field} maksimal 20 Karakter!',
                        'regex_match' => '{field} sangat lemah',
                    ],
                ],
                'password_confirm' => [
                    'label' => 'Password',
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => '{field} tidak sama!',
                    ],
                ],
                'user_image' => [
                    'label' => 'Foto Profil',
                    'rules' => 'max_size[user_image,1024]|mime_in[user_image,image/png,image/jpg,image/jpeg,image/gif]|is_image[user_image]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!',
                    ],
                ],
            ]);

            if (!$valid) {
                return $this->respondValidationError($validation);
            }

            // Konfigurasi
            $config = $this->konfigurasi->orderBy('id_setaplikasi')->first();
            $konopd = esc($config['konek_opd']);
            $id_grup = $config['id_grup'];
            $secretkey = esc($config['google_secret']);
            $g_sitekey = esc($config['g_sitekey']);

            // Data input
            $filegambar = $this->request->getFile('user_image');
            $nama_file = $filegambar->isValid() ? $filegambar->getRandomName() : 'default.png';
            $data = [
                'username' => htmlspecialchars($this->request->getVar('username')),
                'email' => htmlspecialchars($this->request->getVar('email')),
                'password_hash' => password_hash($this->request->getVar('password_confirm'), PASSWORD_BCRYPT),
                'fullname' => htmlspecialchars($this->request->getVar('fullname')),
                'opd_id' => ($konopd == 1) ? $this->request->getVar('opd_id') : 0,
                'id_grup' => $id_grup,
                'user_image' => $nama_file,
                'active' => 0,
                'login_attempts' => 0,
            ];

            // Validasi reCAPTCHA
            if ($secretkey && $g_sitekey) {
                $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
                if (!$this->validateRecaptcha($recaptchaResponse, $secretkey)) {
                    return $this->respondRecaptchaError();
                }
            }

            // Simpan data
            $this->user->insert($data);
            if ($filegambar->isValid()) {
                $filegambar->move('public/img/user/', $nama_file);
            }

            return $this->respondSuccess('Berhasil registrasi Akun pengguna!');
        }
    }

    private function respondValidationError($validation)
    {
        return json_encode([
            'error' => [
                'username' => $validation->getError('username'),
                'fullname' => $validation->getError('fullname'),
                'email' => $validation->getError('email'),
                'password' => $validation->getError('password'),
                'password_confirm' => $validation->getError('password_confirm'),
                'user_image' => $validation->getError('user_image'),
            ],
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    private function respondRecaptchaError()
    {
        return json_encode([
            'gagalcap' => 'Gagal Daftar Silahkan periksa Kembali!',
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    private function respondSuccess($message)
    {
        return json_encode(['sukses' => $message]);
    }
}
