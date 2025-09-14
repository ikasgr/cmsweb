<?php

namespace App\Controllers;

/**
 * CMS ikasmedia!
 *
 * Selamat datang bro ^_^ terima kasih sudah menggunakan CMS ini sebagai Core situs atau Aplikasi Anda. 
 * agar tetap terlihat berwibawa dan berkelas, mohon tetap menghargai karya cipta,
 * dengan tidak mengubah atau menghapus semua baris script ini (apalagi identitas CMS ikasmedia).
 *
 * Mari kita sama-sama saling menghormati dan menghargai hasil keringat dengan Elegan.
 *
 * @author			Vian Taum <viantaum17@gmail.com>
 * @phone			081353967028
 * @website			www.ikasmedia.net
 * @copyright		(c) 2024 ikasmedia Software
 * -------------------------------------------------------------------
 * Salam share CMS Anak kampung WKC untuk Indonesia :)
 * -------------------------------------------------------------------
 */


use App\Controllers\BaseController;

class Updatecms extends BaseController
{

    public function index()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        $tadmin     = $this->template->tempadminaktif();
        $id_grup    = session()->get('id_grup');
        $url        = 'konfigurasi';
        $listgrupf  = $this->grupakses->viewgrupakses($id_grup, $url);
        $akses      = $listgrupf->akses;
        $list       = $this->konfigurasi->select('sts_regis, sts_posting, verdb,vercms')->first();
        if ($akses == 1) {
            $data = [
                'title'             => 'Konfigurasi',
                'subtitle'          => 'Upgrade CMS',
                'folder'            => $tadmin['folder'],
                'akses'             => $akses,
                'verdb'             => $list['verdb'],
                'vercms'            => $list['vercms'],
            ];
            return view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/database/index', $data);
        } else {
            return redirect()->to(base_url(''));
        }
    }


    public function getdata()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $tadmin = $this->template->tempadminaktif();
            $id_grup = session()->get('id_grup');
            $url = 'konfigurasi';
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

            if ($listgrupf) {
                $akses = $listgrupf->akses;
                if ($akses == '1') {
                    $list               = $this->konfigurasi->select('id_setaplikasi, sts_regis, sts_posting, verdb')->first();
                    $fileakses          = $this->request->getPost('fileUrl') ?: 'https://ikasmedia.net/';
                    $serverkonek        = dataKoneksi();
                    $fileUrl            = $serverkonek . $fileakses . '.txt';

                    $dbnewonline        = "errkoneksi";
                    $cmsnewonline       = "errkoneksi";
                    $cmsurldbline       = "errkoneksi";
                    $cmsurlfileline     = "errkoneksi";
                    $isValidUrl         = false;
                    $error_message      = null;

                    // if (checkInternetConnection()) {
                    $fileContent = $this->fetchFileContent($fileUrl);
                    if ($fileContent !== false) {

                        $tempFilePath           = WRITEPATH . 'uploads/fileUpgrade.txt';
                        file_put_contents($tempFilePath, $fileContent);
                        $kodeakses              = aksesServer();
                        $FilePath               = WRITEPATH . 'uploads/fileUpgrade.txt';
                        bukaFiles($tempFilePath, $kodeakses, $FilePath);

                        $tampilContent          = bukaFiles($FilePath, $kodeakses);

                        $lines = explode("\n", $tampilContent);
                        if (count($lines) == 4) {
                            $dbnewonline    = isset($lines[0]) ? htmlspecialchars(trim($lines[0])) : "errkoneksi";
                            $cmsnewonline   = isset($lines[1]) ? htmlspecialchars(trim($lines[1])) : "errkoneksi";
                            $cmsurldbline   = isset($lines[2]) ? htmlspecialchars(trim($lines[2])) : "errkoneksi";
                            $cmsurlfileline = isset($lines[3]) ? htmlspecialchars(trim($lines[3])) : "errkoneksi";
                            $data = [
                                'title'             => 'Konfigurasi',
                                'subtitle'          => 'Upgrade CMS',
                                'id_setaplikasi'    => $list['id_setaplikasi'],
                                'sts_regis'         => $list['sts_regis'],
                                'sts_posting'       => $list['sts_posting'],
                                'verdb'             => $list['verdb'],
                                'folder'            => $tadmin['folder'],
                                'isValidUrl'        => true,
                                'error_message'     => null, // Tidak ada error
                                'dbnewonline'       => $dbnewonline,
                                'cmsnew_on'         => $cmsnewonline,
                                'cmsurldb_on'       => $cmsurldbline,
                                'fileUrl'           => $fileUrl,
                                'cmsurlfile_on'     => $cmsurlfileline,
                                'akses'             => $akses,
                            ];

                            $msg = [
                                'data' => view('backend/' . $tadmin['folder'] . '/pengaturan/database/list', $data)
                            ];
                        } else {
                            $error_message = "Akses ke Server tidak valid.";
                        }
                        // Hapus file sementara setelah proses selesai
                        // unlink($tempFilePath);
                        // unlink($FilePath);
                    } else {
                        $error_message = "File tidak dapat diakses.";
                    }
                    // } else {
                    //     $error_message = "Tidak ada koneksi internet.";
                    // }

                    // Jika ada error, kirim pesan error
                    if ($error_message) {
                        $msg = [
                            'error_message' => $error_message // Kirim pesan error
                        ];
                    }

                    // Kembalikan response
                    echo json_encode($msg);
                } else {
                    // Tidak ada akses
                    $msg = ['noakses' => []];
                    echo json_encode($msg);
                }
            } else {
                // Tidak ada akses grup
                $msg = ['blmakses' => []];
                echo json_encode($msg);
            }
        }
    }


    function fetchFileContent($url)
    {
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Mengikuti redirect jika ada
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set waktu timeout
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'); // Simulasi browser

        // Menjalankan cURL dan mendapatkan hasil
        $fileContent = curl_exec($ch);

        // Mengecek apakah ada error dalam cURL
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            curl_close($ch);
            return false;
        }

        // Menutup cURL
        curl_close($ch);

        return $fileContent;
    }

    # update file khusus db\
    public function Startupdatedb()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $uploadDir = WRITEPATH . 'uploads/';
        $tempFile  = $uploadDir . 'fileupdate.zip';

        // 1. Cek apakah folder bisa ditulis, jika tidak ubah permission sementara
        $originalPermission = fileperms($uploadDir) & 0777; // Simpan izin asli
        if (!is_writable($uploadDir)) {
            chmod($uploadDir, 0777); // Beri izin penuh sementara
        }

        // 2. Lanjutkan proses update
        try {
            // Proses download dan ekstraksi file
            $url = $this->request->getPost('urlupdatedb');
            if (empty($url)) {
                throw new Exception('No URL provided.');
            }

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new Exception('Invalid URL format.');
            }

            // Unduh file
            $this->downloadFileWithProgress($url, $tempFile);

            if (!file_exists($tempFile)) {
                throw new Exception('File ZIP tidak ditemukan setelah diunduh.');
            }

            // Ekstrak ZIP
            $zip = new \ZipArchive();
            if ($zip->open($tempFile) === true) {
                $zip->extractTo(ROOTPATH);
                $zip->close();
            } else {
                throw new Exception('Gagal membuka file ZIP.');
            }

            // Hapus file ZIP setelah ekstraksi
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }

            // 3. Kembalikan izin folder ke nilai aslinya
            chmod($uploadDir, $originalPermission);

            return $this->response->setJSON([
                'status'    => 'success',
                'message'   => 'Tahap (1) sukses. Proses dilanjutkan.'
            ]);
        } catch (\Throwable $e) {
            // 4. Jika terjadi error, tetap kembalikan izin folder
            chmod($uploadDir, $originalPermission);

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    # update file all
    public function startUpdate()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Tentukan direktori yang akan diubah izinnya
        $uploadDir   = WRITEPATH . 'uploads/';
        $extractPath = ROOTPATH;

        // Simpan izin asli direktori (hanya 4 digit permission)
        $originalPermissionUpload = fileperms($uploadDir) & 0777;
        $originalPermissionExtract = fileperms($extractPath) & 0777;

        try {
            // URL file ZIP yang akan diunduh
            $url = $this->request->getPost('urlupdate');
            if (empty($url)) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'No URL provided.'
                ]);
            }
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Invalid URL format.'
                ]);
            }

            // Ubah permission direktori sementara jika tidak writable
            if (!is_writable($uploadDir)) {
                if (!chmod($uploadDir, 0777)) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'Gagal mengubah permission folder uploads.'
                    ]);
                }
            }
            // Jika perlu, pastikan folder ekstrak juga writable.
            if (!is_writable($extractPath)) {
                if (!chmod($extractPath, 0777)) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'Gagal mengubah permission folder ekstrak.'
                    ]);
                }
            }

            $tempFile = $uploadDir . 'fileupdate.zip';

            // 1. Unduh file ZIP
            $this->downloadFileWithProgress($url, $tempFile);

            // 2. Pastikan file ZIP ada
            if (!file_exists($tempFile)) {
                // Kembalikan izin sebelum exit
                chmod($uploadDir, $originalPermissionUpload);
                chmod($extractPath, $originalPermissionExtract);

                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'File ZIP tidak ditemukan setelah diunduh.'
                ]);
            }

            // 3. Ekstrak file ZIP
            $zip = new \ZipArchive();
            if ($zip->open($tempFile) === true) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                // Kembalikan izin sebelum exit
                chmod($uploadDir, $originalPermissionUpload);
                chmod($extractPath, $originalPermissionExtract);

                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Gagal membuka file ZIP.'
                ]);
            }

            // 4. Hapus file ZIP setelah ekstraksi
            if (file_exists($tempFile)) {
                if (!unlink($tempFile)) {
                    // Kembalikan izin sebelum exit
                    chmod($uploadDir, $originalPermissionUpload);
                    chmod($extractPath, $originalPermissionExtract);

                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'Gagal menghapus file ZIP setelah ekstraksi.'
                    ]);
                }
            }

            // 5. Kembalikan permission direktori ke nilai aslinya
            chmod($uploadDir, $originalPermissionUpload);
            chmod($extractPath, $originalPermissionExtract);

            // 6. Respons sukses
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Proses upgrade CMS berhasil!'
            ]);
        } catch (\Throwable $e) {
            // Kembalikan permission direktori jika terjadi error
            chmod($uploadDir, $originalPermissionUpload);
            chmod($extractPath, $originalPermissionExtract);

            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    private function downloadFileWithProgress($url, $saveTo)
    {
        // Buka koneksi ke URL
        $ch = curl_init($url);
        $fp = fopen($saveTo, 'wb');

        if (!$fp) {
            throw new \Exception('Unable to create temporary file for download.');
        }

        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300); // Timeout 5 menit
        curl_setopt($ch, CURLOPT_NOPROGRESS, false); // Aktifkan progres
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($downloadSize, $downloaded, $uploadSize, $uploaded) {
            if ($downloadSize > 0) {
                $progress = round(($downloaded / $downloadSize) * 100, 2);
                echo "Progress: $progress%\r";
                ob_flush();
                flush();
            }
        });

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Download error: ' . curl_error($ch));
        }

        curl_close($ch);
        fclose($fp);

        if (!$result) {
            throw new \Exception('Download failed.');
        }
    }

    # update script SQL database
    public function runupDb()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $id_setaplikasi = $this->request->getVar('id_setaplikasi');
        $cmsnew         = $this->request->getVar('cmsnew_on');
        $verdb          = $this->request->getVar('verdb');
        $versinew       = $this->request->getVar('versinew');

        $verdbold       = empty($verdb) ? '1.0' : $verdb;
        $db             = \Config\Database::connect();

        if (!$db) {
            return json_encode(['error' => 'Koneksi ke database gagal.']);
        }

        // Array untuk menampung query yang akan dijalankan
        $queries = [];

        // **Update versi database jika berbeda**
        if ($versinew != $verdbold) {
            $queries[] = "UPDATE `tbl_setaplikasi` SET `verdb` = '" . $versinew . "' WHERE `id_setaplikasi` = " . intval($id_setaplikasi);
            $queries[] = "UPDATE `tbl_setaplikasi` SET `vercms` = '" . $cmsnew . "' WHERE `id_setaplikasi` = " . intval($id_setaplikasi);
        }

        $cekTbl = $db->query("SHOW TABLES LIKE 'tbl_setaplikasi'")->getRow();
        if ($cekTbl) {
            $cekTblSetaplikasi = $db->query("SHOW COLUMNS FROM `tbl_setaplikasi` LIKE 'smtp_pass'")->getRow();
            if (!$cekTblSetaplikasi) {
                $queries[] = "ALTER TABLE tbl_setaplikasi 
                        CHANGE COLUMN `smtp_password` `smtp_pass` VARCHAR(50) NOT NULL, 
                        CHANGE COLUMN `tokenwa` `wa_token` VARCHAR(255) NOT NULL, 
                        CHANGE COLUMN `g_secretkey` `google_secret` VARCHAR(255) NOT NULL, 
                        CHANGE COLUMN `smtp_host` `mail_host` VARCHAR(255) NOT NULL, 
                        CHANGE COLUMN `smtp_username` `mail_user` VARCHAR(255) NOT NULL, 
                        CHANGE COLUMN `no_waysender` `wa_sender_number` VARCHAR(50) NOT NULL, 
                        CHANGE COLUMN `wa_penerima` `wa_receiver` VARCHAR(50) NOT NULL;";
            }
        } else {
            return json_encode(['error' => 'Tabel target tidak ditemukan.']);
        }

        // 🔍 **Cek & Update `users` Jika Belum Berubah**
        $cekUsers = $db->query("SHOW COLUMNS FROM `users` LIKE 'last_login'")->getRow();
        if (!$cekUsers || strpos($cekUsers->Type, 'timestamp') === false) {
            $queries[] = "ALTER TABLE `users` CHANGE `last_login` `last_login` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;";
        }

        // 🔹 **Jalankan semua query jika ada perubahan**
        if (!empty($queries)) {
            try {
                foreach ($queries as $query) {
                    $db->query($query);
                }
                return $this->response->setJSON([
                    'sukses'    => 'Berhasil upgrade database.',
                    'nextStep'  => true // Lanjut ke update CMS
                ]);
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'error' => 'Gagal upgrade database: ' . $e->getMessage(),
                    'nextStep' => false
                ]);
            }
        }

        // Jika tidak ada perubahan, tetap lanjut update CMS
        return $this->response->setJSON([
            'info'      => 'Tidak ada perubahan yang diperlukan.',
            'nextStep'  => true // Tetap lanjut update CMS meski tidak ada perubahan
        ]);
    }
}
