<?php

namespace App\Controllers;

class Toko extends BaseController
{
    // Halaman utama toko - List semua produk
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $produk = $this->produkumkm->listaktif();

        $data = [
            'title' => 'Toko UMKM | ' . $konfigurasi->nama,
            'deskripsi' => 'Belanja produk UMKM jemaat ' . $konfigurasi->nama,
            'url' => base_url('toko'),
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'produk' => $produk->paginate(12, 'produk'),
            'pager' => $produk->pager,
            'kategori' => $this->kategoriproduk->withcount(),
            'featured' => $this->produkumkm->featured()->limit(4)->get()->getResultArray(),
            'terlaris' => $this->produkumkm->terlaris()->limit(4)->get()->getResultArray(),
        ];

        return view('frontend/content/toko_index', $data);
    }

    // Detail produk
    public function detail($slug_produk = null)
    {
        if (!isset($slug_produk))
            return redirect()->to('toko');

        $konfigurasi = $this->konfigurasi->vkonfig();

        $produk = $this->produkumkm->detail($slug_produk);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Update hits
        $this->produkumkm->update($produk->id_produk, [
            'hits' => $produk->hits + 1
        ]);

        // Produk terkait
        $terkait = $this->produkumkm->terkait($produk->kategori_id, $produk->id_produk);

        // Convert produk object to array and prepare data
        $productArray = (array) $produk;

        // Parse images from JSON if exists
        $images = !empty($productArray['gambar']) ? json_decode($productArray['gambar'], true) : [];
        if (!is_array($images)) {
            $images = [$productArray['gambar']];
        }

        $data = [
            'title' => $produk->nama_produk . ' | Toko UMKM',
            'deskripsi' => strip_tags($produk->deskripsi ?? ''),
            'url' => base_url('umkm/produk/' . $slug_produk),
            'img' => base_url('public/img/produk/' . (!empty($images) ? $images[0] : 'default.jpg')),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'product' => [
                'id' => $produk->id_produk ?? 0,
                'name' => $produk->nama_produk ?? '',
                'description' => $produk->deskripsi ?? '',
                'price' => $produk->harga ?? 0,
                'discount_price' => $produk->harga_diskon ?? null,
                'stock' => $produk->stok ?? 0,
                'category_name' => $produk->nama_kategori ?? 'Lainnya',
                'seller_name' => $produk->nama_pelapak ?? 'UMKM',
                'seller_phone' => $produk->telp_pelapak ?? '',
                'seller_email' => $produk->email_pelapak ?? '',
                'seller_address' => $produk->alamat_pelapak ?? '',
                'seller_id' => $produk->pelapak_id ?? 0,
                'sold_count' => $produk->terjual ?? 0,
                'rating' => $produk->rating ?? 0,
                'min_order' => $produk->min_order ?? 1,
                'unit' => $produk->satuan ?? 'pcs',
                'sku' => $produk->sku ?? '',
                'weight' => $produk->berat ?? 0,
            ],
            'images' => $images,
            'relatedProducts' => $terkait,
        ];

        return view('frontend/umkm/product_detail', $data);
    }

    // Produk by kategori
    public function kategori($slug_kategori = null)
    {
        if (!isset($slug_kategori))
            return redirect()->to('toko');

        $konfigurasi = $this->konfigurasi->vkonfig();

        $kategori = $this->kategoriproduk->detail($slug_kategori);

        if (!$kategori) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $produk = $this->produkumkm->bykategori($kategori->kategori_id);

        $data = [
            'title' => $kategori->nama_kategori . ' | Toko UMKM',
            'deskripsi' => $kategori->deskripsi ?? 'Produk kategori ' . $kategori->nama_kategori,
            'url' => base_url('toko/kategori/' . $slug_kategori),
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'kategori' => $kategori,
            'produk' => $produk->paginate(12, 'produk'),
            'pager' => $produk->pager,
            'kategori_list' => $this->kategoriproduk->withcount(),
        ];

        return view('frontend/content/toko_kategori', $data);
    }

    // Search produk
    public function search()
    {
        $keyword = $this->request->getGet('q');

        $konfigurasi = $this->konfigurasi->vkonfig();

        $produk = $this->produkumkm->search($keyword);

        $data = [
            'title' => 'Pencarian: ' . $keyword . ' | Toko UMKM',
            'deskripsi' => 'Hasil pencarian produk: ' . $keyword,
            'url' => base_url('toko/search?q=' . $keyword),
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'keyword' => $keyword,
            'produk' => $produk->paginate(12, 'produk'),
            'pager' => $produk->pager,
            'kategori' => $this->kategoriproduk->withcount(),
        ];

        return view('frontend/content/toko_search', $data);
    }

    // Keranjang belanja
    public function keranjang()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $session_id = session()->get('cart_session') ?? session()->session_id;

        $cart = $this->keranjang->bysession($session_id);
        $total_obj = $this->keranjang->totalharga($session_id);
        $total = $total_obj->subtotal ?? 0;

        $data = [
            'title' => 'Keranjang Belanja | Toko UMKM',
            'deskripsi' => 'Keranjang belanja Anda',
            'url' => base_url('toko/keranjang'),
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'cart' => $cart,
            'total' => $total,
        ];

        return view('frontend/content/toko_keranjang', $data);
    }

    // Add to cart
    public function addtocart()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $jumlah = $this->request->getVar('jumlah') ?? 1;

            // Cek produk
            $produk = $this->produkumkm->find($id_produk);
            if (!$produk) {
                $msg = ['error' => 'Produk tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Cek stok
            if ($produk['stok'] < $jumlah) {
                $msg = ['error' => 'Stok tidak mencukupi!'];
                echo json_encode($msg);
                return;
            }

            $session_id = session()->get('cart_session');
            if (!$session_id) {
                $session_id = session()->session_id;
                session()->set('cart_session', $session_id);
            }

            // Cek apakah produk sudah ada di keranjang
            $cek = $this->keranjang->cekproduk($session_id, $id_produk);

            $harga = !empty($produk['harga_promo']) ? $produk['harga_promo'] : $produk['harga'];

            if ($cek) {
                // Update quantity
                $jumlah_baru = $cek->jumlah + $jumlah;
                $subtotal = $harga * $jumlah_baru;

                $this->keranjang->update($cek->id_keranjang, [
                    'jumlah' => $jumlah_baru,
                    'subtotal' => $subtotal
                ]);
            } else {
                // Insert baru
                $subtotal = $harga * $jumlah;

                $this->keranjang->insert([
                    'session_id' => $session_id,
                    'user_id' => session()->get('id'),
                    'id_produk' => $id_produk,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);
            }

            $total_item = $this->keranjang->totalitem($session_id);

            $msg = [
                'sukses' => 'Produk berhasil ditambahkan ke keranjang!',
                'total_item' => $total_item
            ];
            echo json_encode($msg);
        }
    }

    // Update cart
    public function updatecart()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $jumlah = $this->request->getVar('jumlah');
            $session_id = session()->get('cart_session');

            // Cari item di keranjang berdasarkan id_produk dan session_id
            $keranjang = $this->keranjang->where('session_id', $session_id)
                ->where('id_produk', $id_produk)
                ->first();

            if (!$keranjang) {
                $msg = ['error' => 'Item tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Cek stok
            $produk = $this->produkumkm->find($id_produk);
            if ($produk['stok'] < $jumlah) {
                $msg = ['error' => 'Stok tidak mencukupi! Stok tersedia: ' . $produk['stok']];
                echo json_encode($msg);
                return;
            }

            $subtotal = $keranjang['harga'] * $jumlah;

            $this->keranjang->update($keranjang['id_keranjang'], [
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ]);

            $msg = ['sukses' => 'Keranjang berhasil diupdate!'];
            echo json_encode($msg);
        }
    }

    // Remove from cart
    public function removecart()
    {
        if ($this->request->isAJAX()) {
            $id_produk = $this->request->getVar('id_produk');
            $session_id = session()->get('cart_session');

            // Hapus berdasarkan id_produk dan session_id
            $this->keranjang->where('session_id', $session_id)
                ->where('id_produk', $id_produk)
                ->delete();

            $msg = ['sukses' => 'Item berhasil dihapus!'];
            echo json_encode($msg);
        }
    }

    // Get cart count (untuk badge)
    public function cartcount()
    {
        $session_id = session()->get('cart_session');
        if (!$session_id) {
            echo json_encode(['count' => 0]);
            return;
        }

        $count = $this->keranjang->totalitem($session_id);
        echo json_encode(['count' => $count]);
    }

    // Clear cart
    public function clearcart()
    {
        if ($this->request->isAJAX()) {
            $session_id = session()->get('cart_session');

            if ($session_id) {
                $this->keranjang->where('session_id', $session_id)->delete();
            }

            $msg = ['sukses' => 'Keranjang berhasil dikosongkan!'];
            echo json_encode($msg);
        }
    }

    // Checkout - Simpan pesanan ke database
    public function checkout()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'nama_pembeli' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama harus diisi']
                ],
                'no_hp' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'No. HP harus diisi',
                        'numeric' => 'No. HP harus berupa angka'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Alamat harus diisi']
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                $msg = ['error' => $validation->getErrors()];
                echo json_encode($msg);
                return;
            }

            $session_id = session()->get('cart_session');
            if (!$session_id) {
                $msg = ['error' => 'Keranjang kosong!'];
                echo json_encode($msg);
                return;
            }

            // Get cart items
            $cart = $this->keranjang->bysession($session_id);
            if (empty($cart)) {
                $msg = ['error' => 'Keranjang kosong!'];
                echo json_encode($msg);
                return;
            }

            // Calculate totals
            $total_item = count($cart);
            $total_qty = 0;
            $subtotal = 0;
            foreach ($cart as $item) {
                $total_qty += $item['jumlah'];
                $subtotal += $item['subtotal'];
            }

            // Generate kode pesanan
            $kode_pesanan = $this->pesanan->generateKodePesanan();

            // Insert pesanan
            $data_pesanan = [
                'kode_pesanan' => $kode_pesanan,
                'session_id' => $session_id,
                'user_id' => session()->get('id'),
                'nama_pembeli' => $this->request->getVar('nama_pembeli'),
                'no_hp' => $this->request->getVar('no_hp'),
                'alamat' => $this->request->getVar('alamat'),
                'email' => $this->request->getVar('email'),
                'catatan' => $this->request->getVar('catatan'),
                'total_item' => $total_item,
                'total_qty' => $total_qty,
                'subtotal' => $subtotal,
                'ongkir' => 0,
                'total_bayar' => $subtotal,
                'status_pesanan' => 'Pending',
                'tgl_pesanan' => date('Y-m-d H:i:s')
            ];

            $pesanan_id = $this->pesanan->insert($data_pesanan);

            if (!$pesanan_id) {
                $msg = ['error' => 'Gagal menyimpan pesanan!'];
                echo json_encode($msg);
                return;
            }

            // Insert detail pesanan
            $db = \Config\Database::connect();
            foreach ($cart as $item) {
                $data_detail = [
                    'pesanan_id' => $pesanan_id,
                    'id_produk' => $item['id_produk'],
                    'nama_produk' => $item['nama_produk'],
                    'harga' => $item['harga'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ];
                $db->table('custome__pesanan_detail')->insert($data_detail);
            }

            // Insert tracking
            $db->table('custome__pesanan_tracking')->insert([
                'pesanan_id' => $pesanan_id,
                'status' => 'Pending',
                'keterangan' => 'Pesanan dibuat',
                'user_id' => session()->get('id'),
                'tgl_update' => date('Y-m-d H:i:s')
            ]);

            // Clear cart
            $this->keranjang->where('session_id', $session_id)->delete();

            $msg = [
                'sukses' => 'Pesanan berhasil dibuat!',
                'kode_pesanan' => $kode_pesanan,
                'pesanan_id' => $pesanan_id
            ];
            echo json_encode($msg);
        }
    }

    // Invoice - Tampilkan invoice pesanan
    public function invoice($kode_pesanan)
    {
        $konfigurasi = $this->konfigurasi->vkonfig();


        $pesanan = $this->pesanan->getByKode($kode_pesanan);
        if (!$pesanan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get detail
        $db = \Config\Database::connect();
        $detail = $db->table('custome__pesanan_detail')
            ->where('pesanan_id', $pesanan['pesanan_id'])
            ->get()->getResultArray();

        $data = [
            'title' => 'Invoice #' . $kode_pesanan,
            'deskripsi' => 'Invoice Pesanan UMKM',
            'url' => base_url('toko/invoice/' . $kode_pesanan),
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'pesanan' => $pesanan,
            'detail' => $detail
        ];

        return view('frontend/content/toko_invoice', $data);
    }
}






