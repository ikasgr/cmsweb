<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function index()
	{
		$konfigurasi = $this->konfigurasi->vkonfig();
		$kategori_id = $konfigurasi->kategori_id;

		// Poling Data
		$poltanya = $this->poling->poltanya();
		$poljawab = $this->poling->poljawab();
		$jumpol = $this->poling->selectSum('rating')->where('type', 'Jawaban')->where('status', 'Y')->where('informasi_id', 0)->first();

		// Church Data
		$majelis = $this->majelisgereja->listaktif();
		$jadwal_upcoming = $this->jadwalpelayanan->upcoming(4);
		$produk_featured = $this->produkumkm->featured()->limit(12)->get()->getResultArray();

		$data = [
			// Config
			'title' => esc($konfigurasi->nama),
			'deskripsi' => esc($konfigurasi->deskripsi),
			'url' => esc($konfigurasi->website),
			'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
			'konfigurasi' => $konfigurasi,

			// Menu
			'mainmenu' => $this->menu->mainmenu(),
			'footer' => $this->menu->footermenu(),
			'topmenu' => $this->menu->topmenu(),
			'linkterkaitall' => $this->linkterkait->publishlinkall(), // Footer links

			// Homepage Content
			'banner' => $this->banner->list(),
			'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(6),
			'section' => $this->section->list(), // Ministries/Layanan Sections

			// News & Articles
			'beritautama' => $this->berita->headlineall(), // Slider News
			'berita4' => $this->berita->listberitapage()->paginate(4), // Latest News

			// Widgets
			'counter' => $this->counter->listfront(),
			'majelis' => $majelis,
			'iklantengah' => $this->banner->listiklantengahran(),
			'agenda2' => $this->agenda->listagendapage()->paginate(2), // Upcoming events widget

			// Poling
			'poltanya' => esc($poltanya['pilihan']),
			'polsts' => $poltanya['status'],
			'poljawab' => $poljawab,
			'jumpol' => $jumpol['rating'],

			// New Data for Church Features
			'jadwal_upcoming' => $jadwal_upcoming,
			'produk_featured' => $produk_featured,
		];

		return view('frontend/desktop/v_home', $data);
	}


	public function showberita()
	{
		if ($this->request->isAJAX()) {

			$client = \Config\Services::curlrequest();

			// URL dari API berita
			$apiUrl = 'https://dinaspendidikan.surakarta.go.id/post-cms'; // Ganti dengan URL API Anda

			try {
				// Request ke API
				$response = $client->get($apiUrl);

				// Ambil status kode dari response
				$statusCode = $response->getStatusCode();

				// Cek apakah respons berhasil (status 200)
				if ($statusCode == 200) {
					// Ambil response body dan decode dari JSON ke array
					$data = [
						'news' => json_decode($response->getBody(), true),
					];

					$msg = [
						'data' => view('backend/berita/data-api', $data),
						'csrf_tokencmsikasmediaon' => csrf_hash(),
					];
				} else {
					// Jika status code bukan 200, tampilkan pesan error
					$msg = [
						'gagalkonek' => 'Gagal mengambil data dari API. Kode status: ' . $statusCode,
					];
				}
			} catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
				// Tangkap pengecualian HTTP khusus
				$msg = [
					'gagalkonek' => 'Terjadi kesalahan HTTP: ' . $e->getMessage(),
				];
			} catch (\Exception $e) {
				// Tangkap semua pengecualian lain seperti gagal menghubungkan ke host
				if (strpos($e->getMessage(), 'Could not resolve host') !== false) {
					$msg = [
						'gagalkonek' => 'Gagal menghubungi server API. Pastikan koneksi internet Anda stabil dan URL API benar.',
					];
				} else {
					$msg = [
						'gagalkonek' => 'Terjadi kesalahan: ' . $e->getMessage(),
					];
				}
			}

			echo json_encode($msg);
		}
	}

	public function cekpengunjung()
	{
		if ($this->request->isAJAX()) {

			$data = [
				'kunjungan' => $this->user->kunjungan(),
				'pengunjungon' => $this->user->totonline(),
			];
			$msg = [
				'data' => view('admin/modal/onpengunjung', $data),
				'csrf_tokencmsikasmediaon' => csrf_hash(),

			];

			echo json_encode($msg);
		}
	}

	//nonaktifpenawaran front end
	public function nonaktiftawaran()
	{
		if ($this->request->isAJAX()) {
			$msg = [
				'csrf_tokencmsikasmedia' => csrf_hash(),
				set_cookie("penawaran", "isi", 5500),
			];
			echo json_encode($msg);
		}
	}

	public function penawaran22()
	{
		if ($this->request->isAJAX()) {

			if (get_cookie("penawaran") != 'isi') {

				$data = [
					'konfigurasi' => $this->konfigurasi->vkonfig(),
					'list' => $this->modalpopup->orderBy('modalpopup_id')->first(),
				];
				$msg = [
					'csrf_tokencmsikasmedia' => csrf_hash(),
					'data' => view('backend/modal/penawaran', $data),

				];
			} else {
				$msg = [
					'csrf_tokencmsikasmedia' => csrf_hash(),
				];
			}
			echo json_encode($msg);
		}
	}

	public function indexkonsep()
	{
		$konfigurasi = $this->konfigurasi->vkonfig();
		$kategori_id = $konfigurasi->kategori_id;

		// Konfigurasi data umum
		$data = [
			'title' => esc($konfigurasi->nama),
			'deskripsi' => esc($konfigurasi->deskripsi),
			'url' => esc($konfigurasi->website),
			'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
			'konfigurasi' => $konfigurasi,
		];

		// Konfigurasi elemen tema (Defaulting to desktop view)
		$theme_config = [
			'beritakate' => $this->berita->listkategori($kategori_id),
			'beritakate6' => $this->berita->listkategori6($kategori_id),
			'terkini' => $this->berita->terkini(),
		];

		$data = array_merge($data, $theme_config);

		return view("frontend/desktop/v_home", $data);
	}
}
