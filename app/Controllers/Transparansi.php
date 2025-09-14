<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Transparansi extends BaseController
{
	public function index()
	{
		$konfigurasi        = $this->konfigurasi->vkonfig();
		$template 			= $this->template->tempaktif();

		$data = [
			'title'			=> 'Transparansi',
			'deskripsi'     => esc($konfigurasi->deskripsi),
			'url'           => esc($konfigurasi->website),
			'img'           => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),

			'konfigurasi'   => $konfigurasi,
			'mainmenu'      => $this->menu->mainmenu(),
			'footer'        => $this->menu->footermenu(),
			'topmenu'       => $this->menu->topmenu(),
			'list'          => $this->bankdata->listbankdata(),
			'beritapopuler' => $this->berita->populer()->paginate(8),
			'kategori'      => $this->kategori->list(),
			'banner'        => $this->banner->list(),
			'infografis'    => $this->banner->listinfo(),
			'infografis1'   => $this->banner->listinfo1(),
			'agenda'        => $this->agenda->listagendapage()->paginate(4),
			'section'       => $this->section->list(),
			'linkterkaitall'    => $this->linkterkait->publishlinkall(),
			'folder'        => esc($template['folder']),
			'infografis10'    => $this->banner->listinfopage()->paginate(10),
			'kategori'      => $this->kategori->list(),
			'listopsi' 		=> $this->transparan->listopsi(),
			'grafisrandom'         => $this->banner->grafisrandom(),
			'terkini3'       => $this->berita->terkini3(),

		];
		if ($template['duatema'] == 1) {
			$agent = $this->request->getUserAgent();
			if ($agent->isMobile()) {
				return view('frontend/' . esc($template['folder']) . '/mobile/' . 'content/transparansi', $data);
			} else {
				return view('frontend/' . esc($template['folder']) . '/desktop/' . 'content/transparansi', $data);
			}
		} else {
			return view('frontend/' . esc($template['folder']) . '/desktop/' . 'content/transparansi', $data);
		}
	}

	function TampilkanGrafik()
	{

		$tahun = $this->request->getPost('tahun');
		$judul = $this->request->getPost('judul');
		$tadmin 			= $this->template->tempadminaktif();
		$data = [
			'transparan' 	=> $this->transparandetail->grafikpendapatan($tahun, $judul),
		];

		$dgrafik = [
			'data'                => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/vgrafik', $data),
			'csrf_tokencmsikasmedia'  => csrf_hash(),
		];

		echo json_encode($dgrafik);
	}

	// pilihan
	function TampilkanGrafikAll()
	{

		$tadmin 			= $this->template->tempadminaktif();
		$data = [
			'transparan' 	=> $this->transparandetail->grafikawal(),
			'folder'        => esc($tadmin['folder']),
		];
		$dgrafik = [
			'data'   				=> view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/vgrafik', $data),
			'csrf_tokencmsikasmedia'  => csrf_hash(),
		];

		echo json_encode($dgrafik);
	}

	public function list()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		$tadmin 			= $this->template->tempadminaktif();
		$data = [
			'title'       => 'Transparansi',
			'subtitle'    => 'Keuangan',
			'folder'      => esc($tadmin['folder']),

		];
		return view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/index', $data);
	}

	public function getdata()
	{
		// Cek apakah session ID ada
		if (!session()->get('id')) {
			return redirect()->to('');
		}

		// Cek apakah request AJAX
		if (!$this->request->isAJAX()) {
			return;
		}

		$id_grup = session()->get('id_grup');
		$id = session()->get('id');
		$url = 'transparansi/list';
		$tadmin = $this->template->tempadminaktif();

		// Ambil grup akses
		$listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

		// Cek apakah grup akses ditemukan
		if (!$listgrupf) {
			echo json_encode(['blmakses' => []]);
			return;
		}

		// Dapatkan akses dan cek apakah valid
		$akses = $listgrupf->akses;
		if (!in_array($akses, [1, 2])) {
			echo json_encode(['noakses' => []]);
			return;
		}

		// Dapatkan data sesuai dengan level akses
		$list = ($akses == 1) ? $this->transparan->list() : $this->transparan->listtransauthor($id);

		// Siapkan data untuk view
		$data = [
			'title' => 'Transparansi',
			'list' => $list,
			'akses' => $akses,
			'hapus' => $listgrupf->hapus,
			'ubah' => $listgrupf->ubah,
			'tambah' => $listgrupf->tambah,
		];

		// Kirim respons dengan view
		echo json_encode([
			'data' => view('backend/' . esc($tadmin['folder']) . '/lembaga/transparansi/list', $data),
		]);
	}

	public function formtambah()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$tadmin 			= $this->template->tempadminaktif();

			$data = [
				'title' 				=> 'Tambah Data',
			];
			$msg = [
				'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/tambah', $data)

			];
			echo json_encode($msg);
		}
	}

	public function simpantransparansi()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'judul' => [
					'label' => 'Nama transparansi',
					'rules' => 'required|is_unique[transparan.judul]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} tidak boleh sama'

					]
				],
				'tahun' => [
					'label' => 'Tahun',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],

			]);
			if (!$valid) {
				$msg = [
					'error' => [
						'judul'           => $validation->getError('judul'),
						'tahun'           => $validation->getError('tahun'),
					],
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
				echo json_encode($msg);
			} else {
				$userid = session()->get('id');
				$insertdata = [
					'judul'  	 => $this->request->getVar('judul'),
					'tahun'  	 => $this->request->getVar('tahun'),
					'jenis'		 => $this->request->getVar('jenis'),
					'sts'		 => '1',
					'id'         => $userid,
				];
				$this->transparan->insert($insertdata);
				$msg = [
					'sukses' 				=> 'Data berhasil disimpan!',
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
				echo json_encode($msg);
			}
		}
	}

	public function hapus()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {

			$id = $this->request->getVar('transparan_id');

			$this->transparan->delete($id);
			$msg = [
				'sukses' 				=> 'Data Berhasil Dihapus',
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			];

			echo json_encode($msg);
		}
	}

	public function formedit()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {

			$transparan_id = $this->request->getVar('transparan_id');
			$list =  $this->transparan->find($transparan_id);
			$tadmin = $this->template->tempadminaktif();
			$data = [
				'title'        	=> 'Edit Data',
				'transparan_id' => $list['transparan_id'],
				'judul'   		=> $list['judul'],
				'tahun'   		=> $list['tahun'],
				'jenis'   		=> $list['jenis'],

			];
			$msg = [
				'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/edit', $data),
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			];
			echo json_encode($msg);
		}
	}


	public function updatedata()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$transparan_id = $this->request->getVar('transparan_id');
			$validation = \Config\Services::validation();

			$valid = $this->validate([

				'judul' => [
					'label' => 'Nama Transparansi',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],
				'tahun' => [
					'label' => 'Tahun',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],
			]);
			if (!$valid) {
				$msg = [
					'error' => [
						'judul'           => $validation->getError('judul'),
						'tahun'           => $validation->getError('tahun'),
					],
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
			} else {

				$updatedata = [
					'judul'  => $this->request->getVar('judul'),
					'tahun'  => $this->request->getVar('tahun'),
					'jenis'  => $this->request->getVar('jenis'),

				];
				$this->transparan->update($transparan_id, $updatedata);
				$msg = [
					'sukses'			    => 'Data berhasil diubah!',
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
			}
			echo json_encode($msg);
		}
	}

	//publish dan unpublish transparansi

	public function toggle()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$id     = $this->request->getVar('transparan_id');
			$cari   = $this->transparan->find($id);

			$sts    = $cari['sts'] == '1' ? 0 : 1;
			$stsket = $sts ? 'Berhasil Aktifkan!' : 'Berhasil Non Aktifkan!';

			$this->transparan->update($id, ['sts' => $sts]);

			echo json_encode([
				'sukses'                => $stsket,
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			]);
		}
	}
	// default tampilan front
	public function toggledef()
	{
		// Cek apakah session ID ada
		if (!session()->get('id')) {
			return redirect()->to('');
		}

		// Cek apakah request AJAX
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('transparan_id');
			$cari = $this->transparan->find($id);

			// Tentukan toggle status dan pesan
			$sts = $cari['vawal'] == '1' ? 0 : 1;
			$stsket = $sts ? 'Berhasil dijadikan default!' : 'Berhasil Non Aktifkan Default!';

			// Reset status jika aktif dan ubah status
			if ($sts == 1) {
				$this->transparan->resetstatus();
			}

			// Update status transparansi
			$this->transparan->update($id, ['vawal' => $sts]);

			// Kirim respons JSON
			echo json_encode([
				'sukses'                => $stsket,
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			]);
		}
	}

	// Detail transparansi
	public function detail($transparan_id = null)
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($transparan_id == '') {
			return redirect()->to(base_url('transparansi/list'));
		}
		$tadmin 		= $this->template->tempadminaktif();
		$list 			= $this->transparandetail->list($transparan_id);
		$namajudul 		= $this->transparan->find($transparan_id);
		$data = [
			'title'     	=> 'Transparansi',
			'subtitle'  	=> 'Detail',
			'transparan_id' => $transparan_id,
			'list' 			=> $list,
			'nama' 			=> $namajudul['judul'],
			'folder'    	=>  esc($tadmin['folder']),

		];
		return view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/detail/index', $data);
	}

	// get data

	public function detailajx()
	{
		// Cek apakah session ID ada
		if (!session()->get('id')) {
			return redirect()->to('');
		}

		// Cek apakah request AJAX
		if ($this->request->isAJAX()) {
			$transparan_id = $this->request->getVar('transparansi');
			$id_grup = session()->get('id_grup');
			$url = 'transparansi/list';

			// Ambil grup akses berdasarkan id_grup dan url
			$listgrupf = $this->grupakses->listgrupakses($id_grup, $url);

			// Pastikan list grup akses ditemukan
			if ($listgrupf) {
				$akses = $listgrupf[0]['akses']; // Ambil akses dari data pertama jika ada

				// Cek apakah transparan_id valid
				if (empty($transparan_id)) {
					return redirect()->to(base_url('transparansi/list'));
				}

				// Periksa akses terlebih dahulu sebelum mengambil data transparansi
				if ($akses == '1' || $akses == '2') {
					// Ambil data transparansi berdasarkan id
					$list = $this->transparandetail->list($transparan_id);

					// Ambil data template admin sekali untuk digunakan
					$tadminFolder = esc($this->template->tempadminaktif()['folder']);

					// Set data untuk ditampilkan
					$data = [
						'title' => 'Detail Transparansi',
						'list' => $list,
						'akses' => $akses,
					];

					$msg = [
						'data' => view('backend/' . $tadminFolder . '/lembaga/transparansi/detail/list', $data),
					];
				} else {
					// Jika akses tidak sesuai
					$msg = [
						'noakses' => [],
					];
				}
			} else {
				// Jika grup akses tidak ditemukan
				$msg = [
					'blmakses' => [],
				];
			}

			// Kirim respons JSON
			echo json_encode($msg);
		}
	}


	public function formtambahsubproduk()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$tadmin = $this->template->tempadminaktif();
			$data = [
				'title' 				=> 'Tambah Item',
				'transparan_id'			=> $this->request->getVar('transparan_id'),

			];
			$msg = [
				'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/detail/tambah', $data)

			];
			echo json_encode($msg);
		}
	}

	public function simpanDetail()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {

			$validation = \Config\Services::validation();

			$valid = $this->validate([
				'transparan_nama' => [
					'label' => 'Judul Item',
					'rules' => 'required|is_unique[transparan_detail.transparan_nama]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} tidak boleh sama'
					]
				],
				'transparan_jumlah' => [
					'label' => 'Jumlah',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],

			]);
			if (!$valid) {
				$msg = [
					'error' => [
						'transparan_nama' 	 => $validation->getError('transparan_nama'),
						'transparan_jumlah'  => $validation->getError('transparan_jumlah'),
					],
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
				// echo json_encode($msg);
			} else {

				$insertdata = [
					'transparan_id'      => $this->request->getVar('transparan_id'),
					'transparan_nama'    => $this->request->getVar('transparan_nama'),
					'transparan_jumlah'  => $this->request->getVar('transparan_jumlah'),
				];

				$this->transparandetail->insert($insertdata);

				$msg = [
					'sukses' => 'Data berhasil disimpan!',
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
			}
			echo json_encode($msg);
		}
	}

	public function formtambahsubprodukx()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$tadmin = $this->template->tempadminaktif();
			$data = [
				'title' 				=> 'Tambah Item',
				'transparan_id'			=> $this->request->getVar('transparan_id'),

			];
			$msg = [
				'data' => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/detail/tambah', $data)

			];
			echo json_encode($msg);
		}
	}

	public function formeditdetail()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$tadmin = $this->template->tempadminaktif();
			$transparandetail_id = $this->request->getVar('transparandetail_id');

			$list =  $this->transparandetail->find($transparandetail_id);

			$data = [
				'title'         => 'Edit Detail Transparansi',
				'transparandetail_id'   => $transparandetail_id,
				'transparan_id'     => $list['transparan_id'],
				'transparan_nama' => $list['transparan_nama'],
				'transparan_jumlah'     => $list['transparan_jumlah'],
			];
			$msg = [
				'sukses' => view('backend/' . esc($tadmin['folder']) . '/' . 'lembaga/transparansi/detail/edit', $data),
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			];
			echo json_encode($msg);
		}
	}

	public function updatedetail()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$transparandetail_id = $this->request->getVar('transparandetail_id');
			$validation = \Config\Services::validation();

			$valid = $this->validate([

				'transparan_nama' => [
					'label' => 'Nama Item',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],
				'transparan_jumlah' => [
					'label' => 'Jumlah Item',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong',

					]
				],
			]);
			if (!$valid) {
				$msg = [
					'error' => [
						'transparan_nama' => $validation->getError('transparan_nama'),
						'transparan_jumlah' => $validation->getError('transparan_jumlah'),
					],
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
			} else {
				$updatedata = [
					'transparan_nama'     => $this->request->getVar('transparan_nama'),
					'transparan_jumlah'   => $this->request->getVar('transparan_jumlah'),

				];
				$this->transparandetail->update($transparandetail_id, $updatedata);
				$msg = [
					'sukses' 				=> 'Data berhasil diubah!',
					'csrf_tokencmsikasmedia'  => csrf_hash(),
				];
			}
			echo json_encode($msg);
		}
	}

	public function hapusdetail()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {

			$id = $this->request->getVar('transparandetail_id');

			$this->transparandetail->delete($id);
			$msg = [
				'sukses' 				=> 'Data Berhasil Dihapus',
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			];

			echo json_encode($msg);
		}
	}

	public function hapusdetailall()
	{
		if (!session()->get('id')) {
			return redirect()->to('');
		}
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('transparandetail_id');
			$jmldata = count($id);
			for ($i = 0; $i < $jmldata; $i++) {

				$this->transparandetail->delete($id[$i]);
			}

			$msg = [
				'sukses' 				=> "$jmldata Data berhasil dihapus",
				'csrf_tokencmsikasmedia'  => csrf_hash(),
			];
			echo json_encode($msg);
		}
	}
}
