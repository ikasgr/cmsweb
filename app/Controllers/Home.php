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

		// News & Articles
		$rawLatestNews = $this->berita->listberitapage()->paginate(3);
		$latestNews = [];
		foreach ($rawLatestNews as $news) {
			$latestNews[] = [
				'slug' => $news['slug_berita'],
				'title' => $news['judul_berita'],
				'category' => $news['slug_kategori'],
				'featured_image' => $news['gambar'],
				'published_at' => $news['tgl_berita'],
				'views' => $news['hits'],
			];
		}

		// Categories Mapping
		$rawCategories = $this->kategori->findAll();
		$newsCategories = [];
		foreach ($rawCategories as $cat) {
			$newsCategories[$cat['slug_kategori'] ?? ''] = $cat['nama_kategori'] ?? '';
		}

		// Majelis Mapping
		$majelisList = [];
		if (!empty($majelis)) {
			foreach ($majelis as $member) {
				$majelisList[] = [
					'name' => $member['nama'],
					'position' => $member['nama_jabatan'] ?? ($member['jenis_jabatan'] ?? ''),
					'photo' => $member['file_foto'] ?? ($member['gambar'] ?? ''),
				];
			}
		}

		// Products Mapping
		$latestProducts = [];
		if (!empty($produk_featured)) {
			foreach ($produk_featured as $product) {
				$latestProducts[] = [
					'id' => $product['id_produk'],
					'name' => $product['nama_produk'],
					'slug' => $product['slug_produk'],
					'price' => $product['harga'],
					'discount_price' => $product['harga_promo'],
					'images' => json_encode([$product['gambar']]),
					'seller_name' => $product['fullname'] ?? $konfigurasi->nama,
					'seller_id' => $product['user_id'],
					'category_name' => $product['nama_kategori'],
				];
			}
		}

		// Jadwal Upcoming Mapping
		$jadwalList = [];
		if (!empty($jadwal_upcoming)) {
			foreach ($jadwal_upcoming as $jadwal) {
				$jadwalList[] = [
					'nama_kegiatan' => $jadwal['judul_jadwal'],
					'tanggal' => $jadwal['tanggal'],
					'jam' => $jadwal['waktu_mulai'],
					'keterangan' => $jadwal['keterangan'],
				];
			}
		}

		// Pengumuman Mapping
		$rawPengumuman = $this->pengumuman->listpengumumanpage()->paginate(6);
		$pengumumanList = [];
		foreach ($rawPengumuman as $p) {
			$pengumumanList[] = [
				'tgl_pengumuman' => $p['tgl_informasi'],
				'judul_pengumuman' => $p['nama'],
				'slug_pengumuman' => $p['slug_informasi'],
				'isi_pengumuman' => $p['isi_informasi'],
				'gambar' => $p['gambar'],
			];
		}

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
			'pengumuman' => $pengumumanList,
			'section' => $this->section->list(), // Ministries/Layanan Sections

			// News & Articles
			'beritautama' => $this->berita->headlineall(), // Slider News
			'latestNews' => $latestNews,
			'newsCategories' => $newsCategories,

			// Widgets
			'counter' => $this->counter->listfront(),
			'majelis' => $majelisList,
			'iklantengah' => $this->banner->listiklantengahran(),
			'agenda2' => $this->agenda->listagendapage()->paginate(2), // Upcoming events widget

			// Poling
			'poltanya' => esc($poltanya['pilihan'] ?? '-'),
			'polsts' => $poltanya['status'] ?? 'N',
			'poljawab' => $poljawab,
			'jumpol' => $jumpol['rating'] ?? 0,

			// New Data for Church Features
			'jadwal_upcoming' => $jadwalList,
			'latestProducts' => $latestProducts,
			'photos' => $this->foto->orderBy('foto_id', 'DESC')->limit(6)->get()->getResultArray(),
		];

		return view('frontend/home', $data);
	}


	public function showberita()
	{
		if ($this->request->isAJAX()) {

			$client = \Config\Services::curlrequest();

			// URL dari API berita
			$apiUrl = 'https://dinaspendidikan.surakarta.go.id/post-cms'; // Ganti dengan URL API Anda

			try {
				// Request ke API
				$response = $client->request('GET', $apiUrl, [
					'headers' => [
						'Accept' => 'application/json',
					],
				]);

				// Ambil body response
				$data = json_decode($response->getBody(), true);

				// Kirim data ke view atau sebagai JSON response
				return $this->response->setJSON($data);
			} catch (\Exception $e) {
				// Error handling
				return $this->response->setJSON(['error' => $e->getMessage()]);
			}
		}
	}

	public function totalkunjungan()
	{
		if ($this->request->isAJAX()) {

			$data = [
				'counter' => $this->counter->listfront(),
			];
			$msg = [
				'data' => view('frontend/content/counter', $data),
			];
			echo json_encode($msg);
		}
	}
}
