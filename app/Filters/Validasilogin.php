<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\ModelKonfigurasi;
use App\Models\M_Dge_grupakses;

class Validasilogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db                 = \Config\Database::connect();
        $builder            = $db->table('cms__usersessions');
        $builkonfig         = $db->table('tbl_setaplikasi');
        $session            = session();
        $userId             = $session->get('id'); // ID pengguna dari sesi
        $sessionId          = session_id();        // ID sesi PHP
        $uri                = service('uri');
        $currentSegment     = $uri->getSegment(1);
        $this->grupakses    = new M_Dge_grupakses();
        $id_grup            = $session->get('id_grup');
        $listgrupf          = $this->grupakses->viewgrupakses($id_grup, 'konfigurasi');
        $maintenanceStatus  = $builkonfig->select('kecamatan,is_maintenance')->get()->getRow();
        $hallogin           = $maintenanceStatus->kecamatan;

        // Langkah 1: Cek halaman login (Pastikan login diperbolehkan meskipun dalam mode maintenance)
        if ($currentSegment === $hallogin) {
            $this->checkExpiredSessions();
            return; // Izinkan login berjalan meskipun dalam mode maintenance
        }

        // Langkah 2: Cek apakah request ini adalah request login (POST atau AJAX)
        if (($currentSegment === $hallogin && $request->getMethod() === 'post') || $request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest') {
            return; // Izinkan login proses meskipun dalam mode maintenance
        }

        // Langkah 3: Jika situs dalam mode maintenance dan bukan halaman login
        if ($maintenanceStatus && $maintenanceStatus->is_maintenance) {
            // Langkah 4: Jika pengguna belum login, blokir akses selain login
            if (!$userId) {
                echo view('maintenance'); // Menampilkan halaman maintenance
                exit; // Blokir akses ke halaman lain jika situs dalam mode maintenance
            } else {
                // Langkah 5: Periksa apakah pengguna adalah superadmin atau memiliki akses khusus
                $akses = isset($listgrupf->akses) ? $listgrupf->akses : 0;
                if ($akses != 1) { // Jika bukan superadmin
                    echo view('maintenance'); // Menampilkan halaman maintenance
                    exit; // Blokir akses ke halaman lain jika bukan superadmin
                }
            }
        }

        // Langkah 6: Jika pengguna sudah login, validasi sesi
        if ($userId) {
            $sessionData = $builder->select('session_id, session_hash')
                ->where('user_id', $userId)->get()->getRow();

            if ($sessionData) {
                // Langkah 7: Validasi sesi
                if ($sessionData->session_id !== $sessionId || !$this->isValidSessionHash($sessionId, $userId, $sessionData->session_hash)) {

                    $builder->where('user_id', $userId)->delete();
                    $session->destroy();
                    return redirect()->to($hallogin)->with('error', 'Sesi tidak valid. Silakan login kembali.');
                }
                // Pembaruan sesi
                $updated = $builder->where('user_id', $userId)
                    ->update(['updated_at' => date('Y-m-d H:i:s')]);

                if (!$updated) {
                    // log_message('error', "Failed to update session for user_id: {$userId}");
                    $builder->where('id', $userId)->delete();
                    $session->destroy();
                    return redirect()->to($hallogin)->with('error', 'Gagal memperbarui sesi. Silakan login kembali.');
                }
            } else {
                // Jika sesi tidak ditemukan, buat sesi baru
                $inserted = $builder->insert([
                    'user_id'      => $userId,
                    'session_id'   => $sessionId,
                    'session_hash' => $this->generateSessionHash($sessionId, $userId),
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s')
                ]);
                if (!$inserted) {
                    // log_message('error', "Failed to insert session for user_id: {$userId}");
                    $session->destroy();
                    return redirect()->to($hallogin)->with('error', 'Gagal menyimpan sesi. Silakan login kembali.');
                }
            }

            // Langkah 8: Periksa akses grup, blokir jika bukan superadmin
            $akses = is_object($listgrupf) && isset($listgrupf->akses) ? $listgrupf->akses : 0;

            if ($maintenanceStatus->is_maintenance && $akses != 1) {
                echo view('maintenance');
                exit; // Blokir akses ke halaman lain jika tidak superadmin
            }
        }
        return null; // Jangan lanjutkan proses jika sudah di-handle
    }


    /**
     * Membuat hash sesi menggunakan kombinasi session_id dan user_id.
     */
    private function generateSessionHash(string $sessionId, string $userId): string
    {
        $secretKey = 'dat@goeSoftware';
        return hash_hmac('sha256', $sessionId . $userId, $secretKey);
    }

    /**
     * Validasi apakah hash sesi sesuai.
     */
    private function isValidSessionHash(string $sessionId, string $userId, string $sessionHash): bool
    {
        $expectedHash = $this->generateSessionHash($sessionId, $userId);
        return hash_equals($expectedHash, $sessionHash);
    }

    public function checkExpiredSessions()
    {
        // $expiredTime            = time() - (1800); // Expired time 30 mnt
        // $expiredTime            = time() - (7200); // Expired time 2jm
        $expiredTime = time() - 3600; // 1 jam
        $expiredTimeFormatted   = date('Y-m-d H:i:s', $expiredTime);
        $db                     = \Config\Database::connect();
        $builder                = $db->table('cms__usersessions');
        $builder->where('created_at <', $expiredTimeFormatted)->delete();
        $db->query("ALTER TABLE cms__usersessions AUTO_INCREMENT = 1");
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
