<?php

namespace App\Controllers;

class Cari extends BaseController
{

    // cari Artikel 2 kondisi
    public function index()
    {

        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->published();
        $keywordcari = esc($this->request->getVar('keyword'));
        $kategori = esc($this->request->getVar('kategori'));


        if ($keywordcari || $kategori) {

            if ($kategori == '') {
                $list = $this->berita->cari($keywordcari, $kategori);
            } else if ($kategori && $keywordcari != '') {
                $list = $this->berita->carikatkey($keywordcari, $kategori);
            } else {
                $list = $this->berita->carikat($keywordcari, $kategori);
            }

            $data = [
                'title' => 'Hasil Pencarian keyword - ' . esc($keywordcari),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),
                'konfigurasi' => $konfigurasi,

                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                // 'berita'         => $list,
                'berita' => $list->paginate(6, 'hal'),
                'pager' => $list->pager,
                'keyword' => ($keywordcari),
                'keykategori' => $kategori,
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
                'section' => $this->section->list(),
                'kategori' => $this->kategori->list(),
                'infografis10' => $this->banner->listinfopage()->paginate(10),
                'grafisrandom' => $this->banner->grafisrandom(),


                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            // Menuju ke web front end;
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcari', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcari', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcari', $data);
            }
        } else {

            $berita = $this->berita->listberitapage();
            $data = [
                'title' => 'Berita | ' . esc($konfigurasi->nama),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'konfigurasi' => $konfigurasi,
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'berita' => $berita->paginate(9, 'hal'),
                'pager' => $berita->pager,
                'kategori' => $this->kategori->list(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'section' => $this->section->list(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),

            ];
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_berita', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_berita', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_berita', $data);
            }
        }
    }

    // cari video
    public function video()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $keywordcari = esc($this->request->getVar('keyword'));
        $kategori = esc($this->request->getVar('kategori'));


        if ($keywordcari || $kategori) {

            if ($kategori == '') {
                $list = $this->video->cari($keywordcari, $kategori);
            } else if ($kategori && $keywordcari != '') {
                $list = $this->video->carikatkey($keywordcari, $kategori);
            } else {
                $list = $this->video->carikat($keywordcari, $kategori);
            }
            $data = [
                'title' => 'Hasil Pencarian keyword - ' . esc($keywordcari),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),

                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),
                'konfigurasi' => $konfigurasi,
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'video' => $list,
                'keyword' => $keywordcari,
                'keykategori' => $kategori,
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
                'section' => $this->section->list(),
                'kategori_video' => $this->kategorivideo->orderBy('kategorivideo_id', 'ASC')->findAll(),

            ];
            // Menuju ke web front end;
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcarivideo', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcarivideo', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcarivideo', $data);
            }
        } else {

            $video = $this->video->listvideopage();

            $data = [
                'title' => 'Galeri Video | ' . esc($konfigurasi->nama),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'konfigurasi' => $konfigurasi,
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'video' => $video->paginate(6, 'hal'),
                'pager' => $video->pager,
                'kategori_video' => $this->kategorivideo->orderBy('kategorivideo_id', 'ASC')->findAll(),
                'jum' => $this->video->totvideo(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'foto' => $this->foto->listfotopage()->paginate(6),
                'section' => $this->section->list(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),


            ];
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_video', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_video', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_video', $data);
            }
        }
    }
    // cari buku
    public function buku()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $keywordcari = esc($this->request->getVar('keyword'));
        $kategori = esc($this->request->getVar('kategori'));


        if ($keywordcari || $kategori) {

            if ($kategori == '') {
                $list = $this->ebook->cari($keywordcari, $kategori);
            } else if ($kategori && $keywordcari != '') {
                $list = $this->ebook->carikatkey($keywordcari, $kategori);
            } else {
                $list = $this->ebook->carikat($keywordcari, $kategori);
            }

            $data = [
                'title' => 'Hasil Pencarian keyword - ' . esc($keywordcari),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),
                'konfigurasi' => $konfigurasi,
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                // 'ebook'         => $list,
                'ebook' => $list->paginate(6, 'hal'),
                'pager' => $list->pager,
                'keyword' => $keywordcari,
                'keykategori' => $kategori,
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'section' => $this->section->list(),
                'kategori' => $this->kategoriebook->orderBy('kategoriebook_id', 'ASC')->findAll(),
                'beritaterkini' => $this->berita->terkini(),

            ];
            // Menuju ke web front end;
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcaribuku', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcaribuku', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/v_hasilcaribuku', $data);
            }
        } else {

            $ebook = $this->ebook->listebookpage();

            $data = [
                'title' => 'E-Book | ' . esc($konfigurasi->nama),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'konfigurasi' => $konfigurasi,
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'ebook' => $ebook->paginate(6, 'hal'),
                'pager' => $ebook->pager,
                'jum' => $this->ebook->totebook(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'section' => $this->section->list(),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),
                'beritaterkini' => $this->berita->terkini(),
                'kategori' => $this->kategoriebook->orderBy('kategoriebook_id', 'ASC')->findAll(),

            ];
            if (0) {
                $agent = $this->request->getUserAgent();
                if ($agent->isMobile()) {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_ebook', $data);
                } else {
                    return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_ebook', $data);
                }
            } else {
                return view('frontend/' . esc($template['folder']) . '/' . 'content/semua_ebook', $data);
            }
        }
    }

    // cari data all modul

    public function berita()
    {
        $konfigurasi = $this->konfigurasi->vkonfig();

        $keywordcari = esc($this->request->getVar('keyword'));
        $keywordjudul = esc($this->request->getVar('keywordjudul'));
        $kategori = esc($this->request->getVar('kategori'));
        $jenis = $this->request->getVar('jenis');

        // Mapping jenis pencarian ke model dan view terkait
        $jenisMapping = [
            'berita' => [$this->berita, 'cari1', 'v_hasilcari', 6],
            'layanan' => [$this->layanan, 'cari', 'v_hasilcarilayanan', 6],
            'agenda' => [$this->agenda, 'cari', 'v_hasilcariagenda', 6],
            'bankdata' => [$this->bankdata, 'cari', 'v_hasilcaribankdata', 6],
            'pengumuman' => [$this->layanan, 'caripengumuman', 'v_hasilcaripengumuman', 6],
            'produkhukum' => [$this->produkhukum, 'cari', 'v_hasilcariprohukum', 6],
            'infografis' => [$this->banner, 'cari', 'v_hasilcariinfografis', 6],
            'albumfoto' => [$this->kategorifoto, 'cari', 'v_hasilfoto', 12],
            'video' => [$this->video, 'cari', 'v_hasilcarivideo', 6],
            'ebook' => [$this->ebook, 'carigeneral', 'v_hasilcaribuku', 6]
        ];

        if ($keywordcari && isset($jenisMapping[$jenis])) {
            list(
                $model,
                $method,
                $nmfile,
                $pno
            ) = $jenisMapping[$jenis];

            // Handle pemanggilan method dengan parameter tambahan untuk ebook
            $list = ($jenis === 'ebook')
                ? $model->$method($keywordcari, $keywordjudul, $kategori)
                : $model->$method($keywordcari);

            $data = [
                'title' => 'Hasil Pencarian keyword - ' . esc($keywordcari),
                'deskripsi' => esc($konfigurasi->deskripsi),
                'url' => esc($konfigurasi->website),
                'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
                'hasil' => $list->paginate($pno, 'hal'),
                'pager' => $list->pager,
                'keyword' => $keywordcari,
                'konfigurasi' => $konfigurasi,
                'kategori' => $this->kategori->list(),
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
                'section' => $this->section->list(),

            ];

            // Tambahkan data khusus ebook
            if ($jenis === 'ebook') {
                $data['kategoribook'] = $this->kategoriebook->orderBy('kategoriebook_id', 'ASC')->findAll();
                $data['keykategori'] = $kategori;
                $data['beritaterkini'] = $this->berita->terkini();
            }

            // Menyesuaikan tampilan berdasarkan perangkat
            $viewPath = 'frontend/' . esc($template['folder']) . '/';
            $viewPath .= ($template['duatema'] == 1 && $this->request->getUserAgent()->isMobile())
                ? 'mobile/'
                : 'desktop/';

            return view($viewPath . 'content/' . $nmfile, $data);
        }
    }
}





