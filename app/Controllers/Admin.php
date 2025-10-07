<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{

	public function index()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		$id_grup 	 = session()->get('id_grup');
		$id 		 = session()->get('id');
		// berita
		$urlgetberita 		= 'berita/all';
		$listgrupfberita  	= $this->grupakses->listgrupakses($id_grup, $urlgetberita);
		$aksesberita 		= isset($listgrupfberita[0]['akses']) ? $listgrupfberita[0]['akses'] : null;

		if ($aksesberita == '1') {
			$populer 			= $this->berita->populer()->paginate(8);
			$hitsberita 		= $this->berita->selectSum('hits')->where('jenis_berita', 'Berita')->first();
			$komentarberita 	= $this->berita->selectCount('berita.berita_id')->join('berita_komen', 'berita_komen.berita_id = berita.berita_id')->where('jenis_berita', 'Berita')->first();
			$beritapublish 		= $this->berita->selectCount('berita_id')->where('jenis_berita', 'Berita')->where('status', 1)->first();
			$beritaunpublish 	= $this->berita->selectCount('berita_id')->where('jenis_berita', 'Berita')->where('status', 0)->first();
		} else {
			$populer 			= $this->berita->populerbyid($id)->paginate(8);
			$hitsberita 		= $this->berita->selectSum('hits')->where('jenis_berita', 'Berita')->where('id', $id)->first();
			$komentarberita 	= $this->berita->selectCount('berita.berita_id')->join('berita_komen', 'berita_komen.berita_id = berita.berita_id')->where('jenis_berita', 'Berita')->where('berita.id', $id)->first();
			$beritapublish 		= $this->berita->selectCount('berita_id')->where('jenis_berita', 'Berita')->where('id', $id)->where('status', 1)->first();
			$beritaunpublish 	= $this->berita->selectCount('berita_id')->where('jenis_berita', 'Berita')->where('id', $id)->where('status', 0)->first();
		}

		$beritaall 				= $this->getDataCountByAkses($id_grup, 'berita/all', 'berita', 'berita_id', $id, 'jenis_berita', 'Berita');
		// Untuk menghitung jumlah kritik dengan status 0 (baru) untuk kritiksaran
		$kritiknew 				= $this->getDataCountByAkses(null, '', 'kritiksaran', 'kritiksaran_id', null, 'status', 0);
		$kritikunpublish 		= $this->getDataCountByAkses(null, '', 'kritiksaran', 'kritiksaran_id', null, 'status', '1');
		$kritikpublish 			= $this->getDataCountByAkses(null, '', 'kritiksaran', 'kritiksaran_id', null, 'status', '2');
		// Untuk menghitung jumlah semua kritik (tanpa filter)
		$kritikall 				= $this->getDataCountByAkses(null, '', 'kritiksaran', 'kritiksaran_id');

		# -------------------------------------------------------id_grup,   url_akses,     namamodel,    kolom_id, id_login
		$bank 						= $this->getDataCountByAkses($id_grup, 'bankdata/all', 'bankdata', 'bankdata_id', $id);
		# -------------------------------------------------------id_grup,   url_akses,     namamodel,  kolom_id, id_login, type, nilainya
		$layanan 					= $this->getDataCountByAkses($id_grup, 'layanan/all', 'layanan', 'informasi_id', $id, 'type', '0');
		$pengumuman 				= $this->getDataCountByAkses($id_grup, 'pengumuman/all', 'pengumuman', 'informasi_id', $id, 'type', '1');
		$gm							= 'Pengaturan';
		$konfigurasi 				= $this->konfigurasi->vkonfig();
		$grupakses   				= $this->grupakses->grupaksessubmenu($id_grup, $gm);
		$tadmin 					= $this->template->tempadminaktif();

		$data = [
			'title'					=> 'Dashboard',
			'subtitle'				=> $konfigurasi->nama,
			'beritapopuler' 		=> $populer,
			// 'berita'				=> $berita,
			'tagar' 				=> $this->getDataCountByAkses(null, '', 'tag', 'tag_id'),
			'kategori' 				=> $this->getDataCountByAkses(null, '', 'kategori', 'kategori_id', null, 'kategori_id !=', 0),
			'totlayanan' 			=> $layanan,
			'totpengumuman' 		=> $pengumuman,
			'bankdata' 				=> $bank,
			'agenda'      			=> $this->agenda->listagendapage()->paginate(1),
			'grupakses'     		=> $grupakses,
			'csrf_tokencmsdatagoe' 	=> csrf_hash(),
			'folder'                => $tadmin['folder'],
			'warna_topbar'          => $tadmin['warna_topbar'],
			'sidebar_mode'          => $tadmin['sidebar_mode'],
			# new tema
			'agenda5'      			=> $this->agenda->listagendapage()->paginate(5),
			'suaraanda'     		=> $this->kritiksaran->listsuaraandaall()->paginate(6),
			'beritaall'             => $beritaall,
			'beritapublish'         => $beritapublish['berita_id'],
			'beritaunpublish'       => $beritaunpublish['berita_id'],
			'komentarberita'        => $komentarberita['berita_id'],
			'hitsberita'            => $hitsberita['hits'],
			'kritiknew'             => $kritiknew,
			'kritikunpublish'       => $kritikunpublish,
			'kritikpublish'       	=> $kritikpublish,
			'kritikall'       		=> $kritikall,
		];
		return view('backend/' . $tadmin['folder'] . '/' . 'v_dashboard', $data);
	}

	function TampilkanGrafik()
	{

		$db = \Config\Database::connect();
		$query = $db->query("SELECT count(*) as jumlah, tgl FROM visitor GROUP BY tgl ORDER BY tgl DESC LIMIT 14")->getResult();
		$tadmin 			= $this->template->tempadminaktif();
		$data = [
			'grafik' 				=> $query,
			'pengunjungon' 	   		=> $this->user->totonline(),
			'pengunjungblnini' 		=> $this->user->pengunjungblnini(),
			'totkunjungan'     		=> $this->db->query("SELECT hits FROM visitor")->getNumRows(),

			'csrf_tokencmsdatagoe' 	=> csrf_hash()
		];

		$dgrafik = [
			'data'   				=> view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/user/vgrafik', $data),
			'csrf_tokencmsdatagoe' 	=> csrf_hash()
		];

		echo json_encode($dgrafik, true);
	}

	// menu Dashboard user online
	public function getonline()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		$id = session()->get('id');
		$konfigurasi         = $this->konfigurasi->vkonfig();
		if ($this->request->isAJAX()) {
			$tadmin = $this->template->tempadminaktif();
			$cari =  $this->user->find($id);
			if ($cari['sts_on'] == '0') {

				$onsts = [
					'sts_on'      => '1',
				];

				$this->user->update($id, $onsts);
			}
			$dirSessions = "./writable/session/";
			$dirLogs = "./writable/logs/";

			$sessionFilesCount = $this->getFilesCount($dirSessions, 1);
			$logFilesCount = $this->getFilesCount($dirLogs, 1);

			$data = [
				'user'	     	   	=> $this->user->getaktif5(),
				'useron'	   	   	=> $this->user->getonline5($id),
				'template'		   	=> $this->template->tempaktif(),
				'pengunjungon' 	   	=> $this->user->totonline(),
				'pengunjungblnini' 	=> $this->user->pengunjungblnini(),
				'totkunjungan'     	=> $this->db->query("SELECT hits FROM visitor")->getNumRows(),
				'sessionFilesCount' => $sessionFilesCount, // Tambahkan jumlah file sesi
				'logFilesCount' 	=> $logFilesCount, // Tambahkan jumlah file log
				'vercms' 		   	=> $konfigurasi->vercms
			];

			$msg = [
				'data'   				=> view('backend/' . $tadmin['folder'] . '/' . 'pengaturan/user/vonline', $data),
				'csrf_tokencmsdatagoe' 	=> csrf_hash()
			];

			echo json_encode($msg);
		}
	}

	private function getFilesCount($dir, $timeLimit = 0)
	{
		if (!is_dir($dir)) {
			return 0;
		}

		$files = array_diff(scandir($dir), ['.', '..']);
		$currentTime = time();
		$count = 0;

		foreach ($files as $file) {
			$filePath = $dir . DIRECTORY_SEPARATOR . $file;

			if ($file === 'index.html' || !is_file($filePath)) {
				continue;
			}

			$lastModified = filemtime($filePath);
			$timeDiff = abs($currentTime - $lastModified) / (60 * 60); // dalam jam

			if ($timeDiff >= $timeLimit) {
				$count++;
			}
		}

		return $count;
	}

	public function hapusfile()
	{
		if ($this->request->isAJAX()) {
			$namaDir 	= $this->request->getPost('dir');
			$timeLimit = $this->request->getPost('timeLimit') ?? 1;

			if (!$namaDir || !$this->isValidDir($namaDir)) {
				return $this->response->setJSON([
					'status' => 'error',
					'message' => 'Direktori tidak valid atau tidak diterima: ' . $namaDir
				]);
			}

			$files = glob($namaDir . '*');
			// $log = []; // Untuk menampung info debug
			$deletedFiles = 0;
			$currentTime = time();

			foreach ($files as $file) {
				$perm = substr(sprintf('%o', fileperms($file)), -4);
				$lastModifiedTime = filemtime($file);
				$timeDiff = abs($currentTime - $lastModifiedTime) / (60 * 60);

				// $log[] = [
				// 	'file' => $file,
				// 	'perm' => $perm,
				// 	'writable' => is_writable($file) ? 'Yes' : 'No',
				// 	'timeDiff' => round($timeDiff, 2),
				// 	'deleted' => 'Skipped'
				// ];

				if (is_file($file) && basename($file) !== 'index.html' && $timeDiff > $timeLimit) {
					@chmod($file, 0666); // paksa ubah permission
					if (@unlink($file)) {
						$deletedFiles++;
						// $log[count($log) - 1]['deleted'] = 'Yes';
					} else {
						// $log[count($log) - 1]['deleted'] = 'Failed';
					}
				}
			}

			return $this->response->setJSON([
				'status' => 'success',
				'message' => "$deletedFiles file telah dihapus dari $namaDir.",
				// 'debug' => $log, // Kirim log untuk dilihat di JS (bisa tampilkan di console)
			]);
		}

		return $this->response->setJSON([
			'status' => 'error',
			'message' => 'Hanya dapat diakses melalui AJAX.'
		]);
	}

	private function isValidDir($path)
	{
		return file_exists($path) && is_dir($path);
	}


	private function getDataCountByAkses($id_grup, $url, $model, $column_id_count, $id_login = null, $typeColumn = null, $filterValue = null)
	{

		if (in_array($model, ['kritiksaran', 'tag', 'kategori'])) {
			// Menangani penghitungan data dalam array hanya menghitung data tanpa mempertimbangkan id_grup dan url
			$query = $this->$model->selectCount($column_id_count);

			if ($typeColumn !== null && $filterValue !== null) {
				$query->where($typeColumn, $filterValue);
			}

			return $query->first();
		}

		// Ambil akses grup dari list akses
		$listgrup = $this->grupakses->listgrupakses($id_grup, $url);
		$akses = $listgrup[0]['akses'] ?? 0;

		// Jika akses adalah '1', hitung data tanpa filter id dan type (untuk model tanpa filter khusus)
		if ($akses == '1') {
			// Untuk model yang membutuhkan filter berdasarkan type atau status
			if ($typeColumn !== null && $filterValue !== null) {
				return $this->$model->selectCount($column_id_count)->where($typeColumn, $filterValue)->first();
			}
			// Jika tidak ada filter khusus (misal, kritik)
			return $this->$model->selectCount($column_id_count)->first();
		}

		// Jika akses bukan '1', hitung data dengan filter id dan type atau status
		if ($id_login !== null) {
			if ($typeColumn !== null && $filterValue !== null) {
				return $this->$model->selectCount($column_id_count)->where($typeColumn, $filterValue)->where('id', $id_login)->first();
			}
			// Jika tidak ada filter type, hanya menggunakan id_login
			return $this->$model->selectCount($column_id_count)->where('id', $id_login)->first();
		}
		// Default jika tidak ada akses yang sesuai
		return 0;
	}


	public function offuser()
	{
		if ($this->request->isAJAX()) {
			// Eksekusi fungsi reset status pada model user
			$this->user->resetstatus();

			// Kirimkan respons JSON sebagai feedback ke klien
			return $this->response->setJSON([
				'status' 	=> 'success',
				'message' 	=> 'Status user berhasil direset.'
			]);
		}

		return $this->response->setJSON([
			'status' 	=> 'error',
			'message' 	=> 'Permintaan hanya dapat dilakukan melalui AJAX.'
		]);
	}




	public function hapusfilex()
	{
		if ($this->request->isAJAX()) {
			$namaDir 	= $this->request->getPost('dir');
			$timeLimit = $this->request->getPost('timeLimit') ?? 10; // Default: 10 jam

			// log_message('debug', 'Nama Direktori: ' . $namaDir);
			// log_message('debug', 'Time Limit: ' . $timeLimit);

			if (!$namaDir) {
				return $this->response->setJSON([
					'status' => 'error',
					'message' => 'Nama direktori tidak diterima.'
				]);
			}

			if (!$this->isValidDir($namaDir)) {
				return $this->response->setJSON([
					'status' => 'error',
					'message' => 'Direktori tidak valid atau tidak ditemukan: ' . $namaDir
				]);
			}
			// Lanjutkan proses hapus jika direktori valid
			$files = glob($namaDir . '*');
			$deletedFiles = 0;
			$currentTime = time();

			foreach ($files as $file) {
				$lastModifiedTime = filemtime($file);
				$timeDiff = abs($currentTime - $lastModifiedTime) / (60 * 60); // dalam jam

				if (is_file($file) && basename($file) !== 'index.html' && $timeDiff > $timeLimit) {
					unlink($file);
					$deletedFiles++;
				}
			}

			return $this->response->setJSON([
				'status' => 'success',
				'message' => "$deletedFiles file telah dihapus dari $namaDir.",
			]);
		}

		return $this->response->setJSON([
			'status' => 'error',
			'message' => 'Hanya dapat diakses melalui AJAX.'
		]);
	}

	// upload image tinymce (blm running)
	public function uploadgambar()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		$validated = $this->validate([
			'file' => [
				'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/png,image/gif]',
				'max_size[file,1024]',
			],
		]);

		if ($validated) {
			$file 		= $this->request->getFile('file');
			$newName 	= $file->getRandomName();
			$file->move(ROOTPATH . 'public/img/galeri/', $newName);

			$response = [
				'location' => base_url('public/img/galeri/' . $newName),
			];

			return $this->response->setJSON($response);
		} else {
			return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
				->setJSON(['error' => 'Invalid file upload']);
		}
	}
}
