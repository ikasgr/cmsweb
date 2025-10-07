<?php

namespace App\Controllers;

class Toko extends BaseController
{
    // Halaman utama toko - List semua produk
    public function index()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        $produk = $this->produkumkm->listaktif();

        $data = [
            'title'         => 'Toko UMKM | ' . $konfigurasi->nama,
            'deskripsi'     => 'Belanja produk UMKM jemaat ' . $konfigurasi->nama,
            'url'           => base_url('toko'),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder'],
            'produk'        => $produk->paginate(12, 'produk'),
            'pager'         => $produk->pager,
            'kategori'      => $this->kategoriproduk->withcount(),
            'featured'      => $this->produkumkm->featured()->limit(4)->get()->getResultArray(),
            'terlaris'      => $this->produkumkm->terlaris()->limit(4)->get()->getResultArray(),
        ];

        return view('frontend/' . $template['folder'] . '/desktop/content/toko_index', $data);
    }

    // Detail produk
    public function detail($slug_produk = null)
    {
        if (!isset($slug_produk)) return redirect()->to('toko');

        $konfigurasi = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
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

        $data = [
            'title'         => $produk->nama_produk . ' | Toko UMKM',
            'deskripsi'     => strip_tags($produk->deskripsi),
            'url'           => base_url('toko/' . $slug_produk),
            'img'           => base_url('/public/img/produk/' . $produk->gambar),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder'],
            'produk'        => $produk,
            'terkait'       => $terkait,
        ];

        return view('frontend/' . $template['folder'] . '/desktop/content/toko_detail', $data);
    }

    // Produk by kategori
    public function kategori($slug_kategori = null)
    {
        if (!isset($slug_kategori)) return redirect()->to('toko');

        $konfigurasi = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        $kategori = $this->kategoriproduk->detail($slug_kategori);

        if (!$kategori) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $produk = $this->produkumkm->bykategori($kategori->kategori_id);

        $data = [
            'title'         => $kategori->nama_kategori . ' | Toko UMKM',
            'deskripsi'     => $kategori->deskripsi ?? 'Produk kategori ' . $kategori->nama_kategori,
            'url'           => base_url('toko/kategori/' . $slug_kategori),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder'],
            'kategori'      => $kategori,
            'produk'        => $produk->paginate(12, 'produk'),
            'pager'         => $produk->pager,
            'kategori_list' => $this->kategoriproduk->withcount(),
        ];

        return view('frontend/' . $template['folder'] . '/desktop/content/toko_kategori', $data);
    }

    // Search produk
    public function search()
    {
        $keyword = $this->request->getGet('q');
        
        $konfigurasi = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        $produk = $this->produkumkm->search($keyword);

        $data = [
            'title'         => 'Pencarian: ' . $keyword . ' | Toko UMKM',
            'deskripsi'     => 'Hasil pencarian produk: ' . $keyword,
            'url'           => base_url('toko/search?q=' . $keyword),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder'],
            'keyword'       => $keyword,
            'produk'        => $produk->paginate(12, 'produk'),
            'pager'         => $produk->pager,
            'kategori'      => $this->kategoriproduk->withcount(),
        ];

        return view('frontend/' . $template['folder'] . '/desktop/content/toko_search', $data);
    }

    // Keranjang belanja
    public function keranjang()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $template = $this->template->tempaktif();
        $session_id = session()->get('cart_session') ?? session()->session_id;

        $keranjang = $this->keranjang->bysession($session_id);
        $total = $this->keranjang->totalharga($session_id);

        $data = [
            'title'         => 'Keranjang Belanja | Toko UMKM',
            'deskripsi'     => 'Keranjang belanja Anda',
            'url'           => base_url('toko/keranjang'),
            'img'           => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'konfigurasi'   => $konfigurasi,
            'mainmenu'      => $this->menu->mainmenu(),
            'footer'        => $this->menu->footermenu(),
            'topmenu'       => $this->menu->topmenu(),
            'section'       => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),
            'folder'        => $template['folder'],
            'keranjang'     => $keranjang,
            'total'         => $total,
        ];

        return view('frontend/' . $template['folder'] . '/desktop/content/toko_keranjang', $data);
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
            $id_keranjang = $this->request->getVar('id_keranjang');
            $jumlah = $this->request->getVar('jumlah');

            $keranjang = $this->keranjang->find($id_keranjang);
            if (!$keranjang) {
                $msg = ['error' => 'Item tidak ditemukan!'];
                echo json_encode($msg);
                return;
            }

            // Cek stok
            $produk = $this->produkumkm->find($keranjang['id_produk']);
            if ($produk['stok'] < $jumlah) {
                $msg = ['error' => 'Stok tidak mencukupi! Stok tersedia: ' . $produk['stok']];
                echo json_encode($msg);
                return;
            }

            $subtotal = $keranjang['harga'] * $jumlah;

            $this->keranjang->update($id_keranjang, [
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ]);

            $session_id = session()->get('cart_session');
            $total = $this->keranjang->totalharga($session_id);

            $msg = [
                'sukses' => 'Keranjang berhasil diupdate!',
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'total' => number_format($total->subtotal, 0, ',', '.')
            ];
            echo json_encode($msg);
        }
    }

    // Remove from cart
    public function removecart()
    {
        if ($this->request->isAJAX()) {
            $id_keranjang = $this->request->getVar('id_keranjang');

            $this->keranjang->delete($id_keranjang);

            $session_id = session()->get('cart_session');
            $total_item = $this->keranjang->totalitem($session_id);
            $total = $this->keranjang->totalharga($session_id);

            $msg = [
                'sukses' => 'Item berhasil dihapus!',
                'total_item' => $total_item,
                'total' => $total->subtotal ?? 0
            ];
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
}
