<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $data = [
            'title' => 'Hubungi Kami | ' . esc($konfigurasi->nama),
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'sitekey' => $konfigurasi->g_sitekey,
        ];

        return view('frontend/contact/index', $data);
    }

    public function send()
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
                        'valid_email' => 'Masukkan {field} yang valid!',
                    ]
                ],
                'nohp' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'subjek' => [
                    'label' => 'Subjek',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],
                'pesan' => [
                    'label' => 'Pesan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'email' => $validation->getError('email'),
                        'nohp' => $validation->getError('nohp'),
                        'subjek' => $validation->getError('subjek'),
                        'pesan' => $validation->getError('pesan'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $secretkey = $konfigurasi['google_secret'];
                $g_sitekey = $konfigurasi['g_sitekey'];

                // ReCAPTCHA verification
                if ($secretkey != '' && $g_sitekey != '') {
                    $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
                    $secret = $secretkey;

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

                    if (!$status['success']) {
                        $msg = [
                            'gagal' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi!',
                            'csrf_tokencmsikasmedia' => csrf_hash(),
                        ];
                        echo json_encode($msg);
                        return;
                    }
                }

                // Prepare data for email
                $nama = htmlspecialchars($this->request->getVar('nama'), ENT_QUOTES);
                $email = $this->request->getVar('email');
                $nohp = $this->request->getVar('nohp');
                $subjek = htmlspecialchars($this->request->getVar('subjek'), ENT_QUOTES);
                $pesan = htmlspecialchars($this->request->getVar('pesan'), ENT_QUOTES);

                // Send email to admin
                $emailAdmin = $konfigurasi['email'] ?? '';
                if ($emailAdmin && $konfigurasi['smtp_pass'] != 'xxxxx') {
                    $emailContent = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; line-height: 1.6; }
                            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                            .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
                            .content { padding: 20px; background: #f9f9f9; }
                            .footer { padding: 10px; text-align: center; color: #777; font-size: 12px; }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <div class="header">
                                <h2>Pesan Kontak Baru</h2>
                            </div>
                            <div class="content">
                                <p><strong>Dari:</strong> ' . $nama . '</p>
                                <p><strong>Email:</strong> ' . $email . '</p>
                                <p><strong>No HP:</strong> ' . $nohp . '</p>
                                <p><strong>Subjek:</strong> ' . $subjek . '</p>
                                <hr>
                                <p><strong>Pesan:</strong></p>
                                <p>' . nl2br($pesan) . '</p>
                            </div>
                            <div class="footer">
                                <p>Email ini dikirim dari form kontak website ' . $konfigurasi['nama'] . '</p>
                            </div>
                        </div>
                    </body>
                    </html>';

                    sendEmail($emailAdmin, 'Pesan Kontak: ' . $subjek, $emailContent);
                }

                // Send WhatsApp notification if configured
                $apikey = $konfigurasi['wa_token'] ?? '';
                $phone = $konfigurasi['wa_sender_number'] ?? '';

                if ($apikey != '' && $phone != '') {
                    $waMessage = "*Pesan Kontak Baru*\n\n";
                    $waMessage .= "Dari: *{$nama}*\n";
                    $waMessage .= "Email: {$email}\n";
                    $waMessage .= "No HP: {$nohp}\n";
                    $waMessage .= "Subjek: *{$subjek}*\n\n";
                    $waMessage .= "Pesan:\n{$pesan}";

                    // You can implement WA sending here if you have the method
                }

                $msg = [
                    'sukses' => 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }

            echo json_encode($msg);
        }
    }
}
