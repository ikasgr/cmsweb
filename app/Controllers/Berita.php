<?php

namespace App\Controllers;

class Berita extends BaseController
{
    public $db;

    public function index()
    {


        $konfigurasi = $this->konfigurasi->vkonfig();
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
            'berita' => $berita->paginate(8, 'hal'),
            'pager' => $berita->pager,
            'kategori' => $this->kategori->list(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),


            'terkini' => $this->berita->terkini(),
            'foto' => $this->foto->listfotopage()->paginate(6),
            'tagall' => $this->tag->listtag(),
            'headline' => $this->berita->headline(),
            'utama' => $this->berita->utama(),
            'headline2' => $this->berita->headline2(),
            'beritapopuler' => $this->berita->populer()->paginate(5),
            'iklanatas' => $this->banner->listiklanatas(),
            'iklantengah' => $this->banner->listiklantengah(),
            'iklankanan1' => $this->banner->listiklankanan1(),
            'iklankanan2' => $this->banner->listiklankanan2(),
            'iklankanan3' => $this->banner->listiklankanan3(),
            'stikkiri' => $this->banner->iklanstikkiri(),
            'stikkanan' => $this->banner->iklanstikkanan(),
            'grafisrandom' => $this->banner->grafisrandom(),
        ];
        return view('frontend/content/semua_berita', $data);
    }

    //Detail berita front end
    public function detail($slug_berita = null)
    {
        if (!isset($slug_berita))
            return redirect()->to('/');
        $konfigurasi = $this->konfigurasi->vkonfig();

        $berita = $this->berita->detail_berita($slug_berita);
        $kategori = $this->kategori->list();
        if ($berita) {
            $list = $this->user->find($berita->id);

            // Update hits
            $data = [
                'hits' => $berita->hits + 1
            ];
            $this->berita->update($berita->berita_id, $data);

            $beritalain = $this->berita->beritalain($berita->berita_id);
            $kategorilain = $this->berita->kategorilain13($berita->berita_id, $berita->kategori_id);
            $kategorilain2 = $this->berita->kategorilain23($berita->berita_id, $berita->kategori_id);
            $poltanya = $this->poling->poltanya();
            $poljawab = $this->poling->poljawab();
            $jumpol = $this->poling->selectSum('rating')->where('type', 'Jawaban')->where('status', 'Y')->where('informasi_id', 0)->first();


            $data = [

                'title' => esc($berita->judul_berita),
                'deskripsi' => esc($berita->ringkasan),
                'url' => base_url($berita->slug_berita),
                'img' => base_url('/public/img/informasi/berita/' . esc($berita->gambar)),
                'konfigurasi' => $konfigurasi,
                'berita' => $berita,
                'beritapopuler' => $this->berita->populer()->paginate(8),
                'beritapopuler5' => $this->berita->populer()->paginate(5),
                'terkini3' => $this->berita->terkini(),
                'kategori' => $kategori,
                'beritalain' => $beritalain,
                'kategorilain' => $kategorilain,
                'kategorilain2' => $kategorilain2,
                'ebook' => $this->ebook->listebookpage()->paginate(3),
                'ebook4' => $this->ebook->listebookpage()->paginate(4),
                'mainmenu' => $this->menu->mainmenu(),
                'footer' => $this->menu->footermenu(),
                'topmenu' => $this->menu->topmenu(),
                'banner' => $this->banner->list(),
                'infografis' => $this->banner->listinfo(),
                'infografis1' => $this->banner->listinfo1(),
                'agenda' => $this->agenda->listagendapage()->paginate(4),
                'pengumuman' => $this->pengumuman->listpengumumanpage()->paginate(10),
                'linkterkaitall' => $this->linkterkait->publishlinkall(),

                'tag' => $this->beritatag->listberitatag($berita->berita_id),
                // 'tag'            => $listtag,
                'komen' => $this->beritakomen->listberitakomen($berita->berita_id),
                'jkomen' => $this->beritakomen->totkomenbyid($berita->berita_id),

                'sitekey' => $konfigurasi->g_sitekey,
                'role' => $this->grupuser->listbyid($list['id_grup']),
                'deskripsiweb' => $konfigurasi->deskripsi,

                'iklanatas' => $this->banner->listiklanatas(),
                'iklantengah' => $this->banner->listiklantengah(),
                'iklankanan1' => $this->banner->listiklankanan1(),
                'iklankanan2' => $this->banner->listiklankanan2(),
                'iklankanan3' => $this->banner->listiklankanan3(),
                'stikkiri' => $this->banner->iklanstikkiri(),
                'stikkanan' => $this->banner->iklanstikkanan(),
                'tagall' => $this->tag->listtag(),
                'foto' => $this->foto->listfotopage()->paginate(6),
                'poltanya' => $poltanya['pilihan'],
                'polsts' => $poltanya['status'],
                'poljawab' => $poljawab,
                'jumpol' => $jumpol['rating'],
                'grafisrandom' => $this->banner->grafisrandom(),
                // mob
                'beritapopuler6' => $this->berita->populer()->paginate(6),
            ];
            return view('frontend/content/detailberita', $data);
        } else {
            return redirect()->to('/berita');
        }
    }

    //list per kategori FRONTEND
    public function kategori($slug_kategori = null)
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->kategori($slug_kategori);


        $data = [
            'title' => 'Kategori ' . $slug_kategori,
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'subtitle' => $slug_kategori,
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),

            'jum' => $this->db->query("SELECT b.kategori_id  
                               FROM berita AS b JOIN kategori AS k ON b.kategori_id = k.kategori_id 
                               WHERE k.slug_kategori='" . $slug_kategori . "'")->getNumRows(),

            'berita' => $berita->paginate(6, 'hal'),
            'pager' => $berita->pager,
            'kategori' => $this->kategori->list(),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'beritautama' => $this->berita->headlineall(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'terkini' => $this->berita->terkini(),
            'headline' => $this->berita->utamabykategori($slug_kategori),
            'iklanatas' => $this->banner->listiklanatas(),
            'iklantengah' => $this->banner->listiklantengah(),
            'iklankanan1' => $this->banner->listiklankanan1(),
            'iklankanan2' => $this->banner->listiklankanan2(),
            'iklankanan3' => $this->banner->listiklankanan3(),
            'stikkiri' => $this->banner->iklanstikkiri(),
            'stikkanan' => $this->banner->iklanstikkanan(),
            // PERIJINAN
            'grafisrandom' => $this->banner->grafisrandom(),
        ];
        return view('frontend/content/semua_kategori', $data);
    }

    //list per tag FRONTEND
    public function tag($tag_id)
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->tag($tag_id);


        // $berita             =  $this->berita->newsbytag($idk);
        $cari = $this->tag->find($tag_id);
        if ($cari) {
            $nm = esc($cari['nama_tag']);
        } else {
            $nm = '-';
        }
        $data = [
            'title' => 'Tagar ' . $nm,
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),
            'subtitle' => $nm,
            // 'tag_pilih'      => ($j),
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            // 'berita'        => $berita,
            'berita' => $berita->paginate(6, 'hal'),
            'pager' => $berita->pager,
            'beritautama' => $this->berita->headlineall(),
            'kategori' => $this->kategori->list(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),


            'terkini' => $this->berita->terkini(),
            'foto' => $this->foto->listfotopage()->paginate(6),
            'tagall' => $this->tag->listtag(),
            'headline' => $this->berita->utamabytag($tag_id),
            'utama' => $this->berita->utama(),
            'headline2' => $this->berita->headline2(),
            'beritapopuler' => $this->berita->populer()->paginate(5),
            'iklanatas' => $this->banner->listiklanatas(),
            'iklantengah' => $this->banner->listiklantengah(),
            'iklankanan1' => $this->banner->listiklankanan1(),
            'iklankanan2' => $this->banner->listiklankanan2(),
            'iklankanan3' => $this->banner->listiklankanan3(),
            'stikkiri' => $this->banner->iklanstikkiri(),
            'stikkanan' => $this->banner->iklanstikkanan(),
            'grafisrandom' => $this->banner->grafisrandom(),
        ];
        return view('frontend/content/semua_tag', $data);
    }

    //list per users FRONTEND
    public function author($id, $nm)
    {

        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->listberitabyuserpg($id);

        $list = $this->user->find($id);

        $data = [
            'title' => 'Berita By ' . $nm,
            'deskripsi' => esc($konfigurasi->deskripsi),
            'url' => esc($konfigurasi->website),
            'img' => base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)),

            'subtitle' => $nm,
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            'role' => $this->grupuser->listbyid($list['id_grup']),
            'berita' => $berita->paginate(6, 'hal'),
            'pager' => $berita->pager,
            'jum' => $this->berita->totberitabyid($id),
            'kategori' => $this->kategori->list(),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'beritautama' => $this->berita->headlineall(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),


            'terkini' => $this->berita->terkini(),
            'foto' => $this->foto->listfotopage()->paginate(6),
            'tagall' => $this->tag->listtag(),
            'headline' => $this->berita->headline(),
            'utama' => $this->berita->utama(),
            'headline2' => $this->berita->headline2(),
            'beritapopuler' => $this->berita->populer()->paginate(5),
            'iklanatas' => $this->banner->listiklanatas(),
            'iklantengah' => $this->banner->listiklantengah(),
            'iklankanan1' => $this->banner->listiklankanan1(),
            'iklankanan2' => $this->banner->listiklankanan2(),
            'iklankanan3' => $this->banner->listiklankanan3(),
            'stikkiri' => $this->banner->iklanstikkiri(),
            'stikkanan' => $this->banner->iklanstikkanan(),
            'grafisrandom' => $this->banner->grafisrandom(),
        ];
        return view('frontend/content/berita_author', $data);
    }

    //list per opd FRONTEND
    public function opd($opd_id, $nm)
    {
        $konfigurasi = $this->konfigurasi->vkonfig();
        $berita = $this->berita->listberitabyopdpg($opd_id);

        // $list               =  $this->user->find($id);

        $data = [
            'title' => 'Berita Dari ' . $nm,
            'deskripsi' => $konfigurasi->deskripsi,
            'url' => $konfigurasi->website,
            'img' => base_url('/public/img/konfigurasi/logo/' . $konfigurasi->logo),
            'subtitle' => $nm,
            'konfigurasi' => $konfigurasi,
            'mainmenu' => $this->menu->mainmenu(),
            'footer' => $this->menu->footermenu(),
            'topmenu' => $this->menu->topmenu(),
            // 'role'          => $this->grupuser->listbyid($list['id_grup']),
            'berita' => $berita->paginate(6, 'hal'),
            'pager' => $berita->pager,
            'jum' => $this->berita->totberitabyopd($opd_id),
            'kategori' => $this->kategori->list(),
            'beritapopuler' => $this->berita->populer()->paginate(8),
            'beritautama' => $this->berita->headlineall(),
            'banner' => $this->banner->list(),
            'infografis' => $this->banner->listinfo(),
            'infografis1' => $this->banner->listinfo1(),
            'agenda' => $this->agenda->listagendapage()->paginate(4),
            'section' => $this->section->list(),
            'linkterkaitall' => $this->linkterkait->publishlinkall(),

            'grafisrandom' => $this->banner->grafisrandom(),
        ];
        return view('frontend/content/berita_opd', $data);
    }


    // simpan Like posting Berita
    public function likeposting($berita_id = null)
    {
        if ($this->request->isAJAX()) {
            $berita_id = $this->request->getVar('berita_id');
            $cari = $this->berita->find($berita_id);
            $postlike = $cari['likepost'];
            $data = [
                'likepost' => $postlike + 1,
            ];
            $this->berita->update($berita_id, $data);

            $msg = [
                'sukses' => 'Anda menyukai postingan ini'
            ];

            echo json_encode($msg);
        }
    }

    //list backend
    public function all()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }


        $id_grup = session()->get('id_grup');
        $urlget = 'berita/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $urlget);

        $data = [
            'title' => 'Informasi',
            'subtitle' => 'Berita',
            'tambah' => $listgrupf->tambah,
            'hapus' => $listgrupf->hapus,


            'csrf_tokencmsikasmedia' => csrf_hash()
        ];

        return view('backend/berita/index', $data);
    }

    // Start Serverside
    public function listdata2()
    {
        $request = \Config\Services::request();
        $id = session()->get('id');
        $id_grup = session()->get('id_grup');
        $urlget = 'berita/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $urlget);
        $akses = $listgrupf->akses;
        $hapus = $listgrupf->hapus;
        $ubah = $listgrupf->ubah;

        // Tentukan kondisi where berdasarkan akses
        $where = ($akses == '1') ? ['jenis_berita' => 'Berita'] : ['jenis_berita' => 'Berita', 'berita.id' => $id];

        // Hitung total berita tanpa filter pencarian
        $totalcount = (int) $this->berita->where($where)->countAllResults(false);

        // Ambil kata kunci pencarian
        $search = $request->getPost("search")["value"] ?? '';

        // Buat Query Berita dengan Filter Akses
        $beritaQuery = $this->berita->where($where);

        // Jika ada pencarian, tambahkan kondisi pencarian
        if (!empty($search)) {
            $beritaQuery->groupStart()
                ->like('judul_berita', $search)
                ->orLike('tgl_berita', $search)
                ->groupEnd();

            // Hitung ulang jumlah hasil pencarian
            $recordsFiltered = $beritaQuery->countAllResults(false);
        } else {
            // Jika tidak ada pencarian, gunakan jumlah total sesuai akses
            $recordsFiltered = $totalcount;
        }

        // Inisialisasi parameter untuk query DataTables
        $column_order = [null, null, 'berita.judul_berita', null, 'berita.tgl_berita', null, null];
        $column_search = ['berita.judul_berita', 'berita.tgl_berita'];
        $order = ['berita.berita_id' => 'DESC'];

        // Ambil data berita
        $lists = $this->berita->get_datatables('berita', $column_order, $column_search, $order, $where);

        // Menyusun hasil ke dalam array DataTables
        $data = [];
        $no = $request->getPost("start") ?? 0;

        foreach ($lists as $list) {
            $no++;

            // Nama OPD jika ada, jika tidak tampilkan nama user saja
            $useropd = esc($list->fullname);
            if (!empty($list->singkatan_opd)) {
                $useropd .= '<br>' . esc($list->singkatan_opd);
            }

            // Status berita utama
            $utama = '<a class="pointer" onclick="toggleutm(' . $list->berita_id . ')" title="'
                . ($list->headline == '1' ? 'Berita Utama' : 'Jadikan Berita Utama')
                . '" style="font-size:12px"><i class="far fa-star '
                . ($list->headline == '1' ? 'text-danger' : 'text-secondary')
                . '"></i></a> ' . mediumdate_indo($list->tgl_berita);

            // Status tombol
            $sts = '<button type="button" class="btn btn-light btn-sm p-1" '
                . ($akses == '1' ? 'onclick="toggle(' . $list->berita_id . ')" ' : '')
                . 'title="' . ($list->status == '1' ? 'Klik untuk Nonaktifkan' : 'Klik untuk Terbitkan') . '">'
                . '<i class="' . ($list->status == '1' ? 'fas fa-check-circle text-success' : 'far fa-eye-slash text-danger') . '"></i></button>';

            // Judul berita dengan link jika sudah diterbitkan
            $judulberita = ($list->status == '1')
                ? '<a class="text-primary" href="' . base_url($list->slug_berita) . '" target="_blank">' . esc($list->judul_berita) . '</a>'
                : '<a class="text-warning">' . esc($list->judul_berita) . '</a>';
            $judulberita .= '<span class="text-danger" title="Telah dilihat" style="font-size:13px"> (' . $list->hits . ') </span>';

            // Gambar berita
            $gambar = '<img src="' . base_url() . '/public/img/informasi/berita/' . esc($list->gambar) . '" class="img-circle elevation-2 pointer" width="60px" onclick="gantifoto(' . $list->berita_id . ')" />';

            // Tombol Edit
            $tedit = '<a href="' . ($ubah == '1' ? base_url('ubah/' . $list->berita_id) : '#') . '" target="_self">'
                . '<button type="button" class="btn btn-light btn-sm p-1">'
                . '<i class="fa fa-edit ' . ($ubah == '1' ? 'text-primary' : 'text-secondary') . '"></i></button></a>';

            // Tombol Hapus
            $thapus = '<button type="button" class="btn btn-light btn-sm p-1" '
                . ($hapus == '1' ? 'onclick="hapus(' . $list->berita_id . ')"' : '') . '>'
                . '<i class="far fa-trash-alt ' . ($hapus == '1' ? 'text-danger' : 'text-secondary') . '"></i></button>';

            // Data dalam bentuk array untuk DataTables
            $row = [
                "<input type=\"checkbox\" name=\"berita_id[]\" class=\"centangBeritaid\" value=\"$list->berita_id\">",
                $gambar,
                $judulberita,
                esc($list->nama_kategori),
                $utama,
                $useropd,
                $sts . " " . $tedit . " " . $thapus
            ];
            $data[] = $row;
        }

        // Output JSON untuk DataTables
        return $this->response->setJSON([
            "draw" => $request->getPost("draw"),
            "recordsTotal" => $totalcount,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        ]);
    }

    public function toggle()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, langsung keluar
        }
        $id = $this->request->getVar('id');
        $cari = $this->berita->find($id);

        if (!$cari) {
            return;
        }
        $sts = ($cari['status'] == '1') ? 0 : 1;
        $stsket = $sts ? 'Berhasil menerbitkan postingan!' : 'Berhasil nonaktifkan postingan!';
        $this->berita->update($id, ['status' => $sts]);
        echo json_encode([
            'sukses' => $stsket,
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    public function toggleutm()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if (!$this->request->isAJAX()) {
            return; // Jika bukan AJAX, langsung keluar
        }
        $id = $this->request->getVar('id');
        $cari = $this->berita->find($id);

        if (!$cari) {
            return;
        }
        $sts = ($cari['headline'] == '1') ? 0 : 1;
        $stsket = $sts ? 'Berhasil jadi berita utama!' : 'Berhasil batalkan berita utama!';
        $this->berita->update($id, ['headline' => $sts]);
        echo json_encode([
            'sukses' => $stsket,
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ]);
    }

    // form tambah simpan
    public function tambahbaru()
    {
        // Pastikan sesi aktif
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $urlget = 'berita/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $urlget);

        // Jika akses ditemukan dan valid
        if ($listgrupf && ($listgrupf->akses == '1' || $listgrupf->akses == '2')) {
            $id = session()->get('id');


            // Menyusun data untuk view
            $konfigurasi = $this->konfigurasi->vkonfig();
            $data = [
                'title' => 'Berita',
                'subtitle' => 'Tambah Baru',
                'namasingkat' => $konfigurasi->namasingkat,
                'kategori' => $this->kategori->list(),
                'tag' => $this->tag->list(),
                'user' => $this->user->listaddnews($id),
                'akses' => $listgrupf->akses,
                'id' => $id,
                'csrf_tokencmsikasmedia' => csrf_hash(),

            ];

            return view('backend/berita/formadd', $data);
        }

        // Redirect jika akses tidak valid atau tidak ditemukan
        return redirect()->to(base_url('/'));
    }


    public function simpanBerita()
    {
        if (session()->get('id') == '') {
            exit('Akses Ilegal');
        }

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            // Aturan validasi
            $valid = $this->validate([
                'judul_berita' => [
                    'label' => 'Judul berita',
                    'rules' => 'required|is_unique[berita.judul_berita]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]
                ],
                'kategori_id' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tag_id' => [
                    'label' => 'Tag Berita',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'ringkasan' => [
                    'label' => 'Ringkasan Berita',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'isi' => [
                    'label' => 'Isi Berita',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'gambar' => [
                    'label' => 'Gambar Berita',
                    'rules' => 'uploaded[gambar]|max_size[gambar,1024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [
                        'uploaded' => 'Silahkan Masukkan gambar',
                        'max_size' => 'Ukuran {field} Maksimal 1024 KB..!!',
                        'mime_in' => 'Format file {field} PNG, Jpeg, Jpg, atau Gif..!!'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => $validation->getErrors(),
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                // Persiapkan data
                $tag_id = $this->request->getVar('tag_id');
                $userid = $this->request->getVar('id') ?: session()->get('id');
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $ceksts = $konfigurasi['sts_posting'];

                // Mendapatkan akses grup dan menentukan status
                $id_grup = session()->get('id_grup');
                $urlget = 'berita/all';
                $listgrupf = $this->grupakses->viewgrupakses($id_grup, $urlget);
                $stspos = ($listgrupf && $listgrupf->akses == '1') ? 1 : ($ceksts == 1 ? 0 : 1);

                // Menangani upload gambar
                $filegambar = $this->request->getFile('gambar');
                $nama_file = $filegambar->getRandomName();

                // Insert data berita
                $insertdata = [
                    'judul_berita' => $this->request->getVar('judul_berita'),
                    'slug_berita' => mb_url_title($this->request->getVar('judul_berita'), '-', TRUE),
                    'kategori_id' => $this->request->getVar('kategori_id'),
                    'ringkasan' => $this->request->getVar('ringkasan'),
                    'isi' => $this->request->getVar('isi'),
                    'status' => $stspos,
                    'gambar' => $nama_file,
                    'tgl_berita' => date('Y-m-d', strtotime($this->request->getVar('tgl_berita'))),
                    'id' => $userid,
                    'jenis_berita' => 'Berita',
                    'hits' => '0',
                    'headline' => $this->request->getVar('headline'),
                    'ket_foto' => $this->request->getVar('ket_foto'),
                    'sts_komen' => $this->request->getVar('sts_komen'),
                    'pilihan' => $this->request->getVar('pilihan'),
                ];

                // Insert berita dan simpan gambar dengan watermark
                $this->berita->insert($insertdata);
                \Config\Services::image()
                    ->withFile($filegambar)
                    ->text(
                        strtoupper($konfigurasi['nama']),
                        ['color' => '#fff', 'opacity' => 0.7, 'hAlign' => 'center', 'vAlign' => 'middle', 'fontSize' => 20]
                    )
                    ->save('public/img/informasi/berita/' . $nama_file, 65);

                $berita_id = $this->berita->getInsertID();

                // Insert data tag
                $tag_data = array_map(function ($tag) use ($berita_id) {
                    return ['berita_id' => $berita_id, 'tag_id' => $tag];
                }, $tag_id);

                $this->beritatag->insertBatch($tag_data);

                // Mengirimkan pesan sukses
                $msg = [
                    'sukses' => 'Berita berhasil disimpan!',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Akses Ilegal');
        }
    }

    public function hapus()
    {
        if (!session()->get('id')) {
            exit('Akses Ilegal');
        }

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('berita_id');

            // Ambil data berita berdasarkan ID
            $cekdata = $this->berita->find($id);

            if (!$cekdata) {
                $msg = [
                    'error' => 'Data berita tidak ditemukan!',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
                echo json_encode($msg);
                return;
            }

            // Hapus gambar jika ada
            $fotolama = $cekdata['gambar'];
            $pathGambar = 'public/img/informasi/berita/' . $fotolama;
            if (!empty($fotolama) && file_exists($pathGambar)) {
                unlink($pathGambar);
            }

            // Hapus tag terkait berita secara batch
            $listtag = $this->beritatag->where('berita_id', $id)->findAll();
            if (!empty($listtag)) {
                $tagIds = array_column($listtag, 'beritatag_id');
                $this->beritatag->whereIn('beritatag_id', $tagIds)->delete();
            }

            // Hapus komentar terkait berita secara batch
            $listkomen = $this->beritakomen->where('berita_id', $id)->findAll();
            if (!empty($listkomen)) {
                $komenIds = array_column($listkomen, 'beritakomen_id');
                $this->beritakomen->whereIn('beritakomen_id', $komenIds)->delete();
            }

            // Hapus data berita
            $this->berita->delete($id);

            $msg = [
                'sukses' => 'Data Berita Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if (!session()->get('id')) {
            exit('Akses Ilegal');
        }

        if ($this->request->isAJAX()) {
            $ids = $this->request->getVar('berita_id');
            $jmldata = count($ids);

            if ($jmldata > 0) {
                // Ambil semua data berita berdasarkan ID
                $beritas = $this->berita->whereIn('berita_id', $ids)->findAll();

                // Ambil semua tag dan komentar terkait berita yang akan dihapus
                $listtag = $this->beritatag->whereIn('berita_id', $ids)->findAll();
                $listkomen = $this->beritakomen->whereIn('berita_id', $ids)->findAll();

                // Hapus gambar terkait jika ada
                foreach ($beritas as $berita) {
                    $gambar = $berita['gambar'];
                    $pathGambar = 'public/img/informasi/berita/' . $gambar;

                    if (!empty($gambar) && file_exists($pathGambar)) {
                        unlink($pathGambar);
                    }
                }

                // Hapus data berita
                $this->berita->whereIn('berita_id', $ids)->delete();

                // Hapus data tag secara batch
                if (!empty($listtag)) {
                    $tagIds = array_column($listtag, 'beritatag_id');
                    $this->beritatag->whereIn('beritatag_id', $tagIds)->delete();
                }

                // Hapus data komentar secara batch
                if (!empty($listkomen)) {
                    $komenIds = array_column($listkomen, 'beritakomen_id');
                    $this->beritakomen->whereIn('beritakomen_id', $komenIds)->delete();
                }
            }

            // Kirim respon
            $msg = [
                'csrf_tokencmsikasmedia' => csrf_hash(),
                'sukses' => "$jmldata Data berita berhasil dihapus",
            ];
            echo json_encode($msg);
        }
    }

    // edit berita 
    public function editberita($berita_id)
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $urlget = 'berita/all';
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $urlget);

        if (!$listgrupf || !in_array($listgrupf->akses, ['1', '2'])) {
            return redirect()->to(base_url('/'));
        }

        // Ambil data berita
        $list = $this->berita->find($berita_id);
        if (!$list) {
            return redirect()->to(base_url('/'))->with('error', 'Berita tidak ditemukan.');
        }

        // Ambil data tambahan
        $listtag = $this->beritatag->listtag($berita_id);

        $konfigurasi = $this->konfigurasi->vkonfig();
        // Siapkan data untuk view
        $data = [
            'title' => 'Berita',
            'subtitle' => 'Edit',
            'berita_id' => $list['berita_id'],
            'judul_berita' => $list['judul_berita'],
            'ringkasan' => $list['ringkasan'],
            'isi' => $list['isi'],
            'headline' => $list['headline'],
            'ket_foto' => $list['ket_foto'],
            'sts_komen' => $list['sts_komen'],
            'kategori_id' => $list['kategori_id'],
            'pilihan' => $list['pilihan'],
            'kategori' => $this->kategori->list(),
            'tgl_berita' => $list['tgl_berita'],
            'id' => $list['id'],
            'tag' => $this->tag->list(),
            'tag_id' => $listtag,
            'akses' => $listgrupf->akses,

            'user' => $this->user->listaddnews(session()->get('id')),
            'namasingkat' => $konfigurasi->namasingkat,
            'csrf_tokencmsikasmedia' => csrf_hash(),
        ];

        return view('backend/berita/formedit', $data);
    }

    public function updateberita()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'judul_berita' => [
                    'label' => 'Judul berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'kategori_id' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'isi' => [
                    'label' => 'Isi Berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'ringkasan' => [
                    'label' => 'Ringkasan Berita',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_berita' => [
                    'label' => 'Tanggal Posting',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tag_id' => [
                    'label' => 'Tag',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_berita' => $validation->getError('judul_berita'),
                        'kategori_id' => $validation->getError('kategori_id'),
                        'tag_id' => $validation->getError('tag_id'),
                        'ringkasan' => $validation->getError('ringkasan'),
                        'isi' => $validation->getError('isi'),
                        'tgl_berita' => $validation->getError('tgl_berita'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
                echo json_encode($msg);
                return;
            }

            // Siapkan data update
            $berita_id = $this->request->getVar('berita_id');
            $tag_id = $this->request->getVar('tag_id');
            $userid = $this->request->getVar('id') ?: session()->get('id');

            $updatedata = [
                'judul_berita' => $this->request->getVar('judul_berita'),
                'slug_berita' => mb_url_title($this->request->getVar('judul_berita'), '-', true),
                'kategori_id' => $this->request->getVar('kategori_id'),
                'ringkasan' => $this->request->getVar('ringkasan'),
                'isi' => $this->request->getVar('isi'),
                'headline' => $this->request->getVar('headline'),
                'tgl_berita' => date('Y-m-d', strtotime($this->request->getVar('tgl_berita'))),
                'sts_komen' => $this->request->getVar('sts_komen'),
                'pilihan' => $this->request->getVar('pilihan'),
                'id' => $userid,
            ];

            // Update berita
            $this->berita->update($berita_id, $updatedata);

            // Hapus tag lama
            $this->beritatag->where('berita_id', $berita_id)->delete();

            // Tambahkan tag baru
            $tagData = [];
            foreach ($tag_id as $tag) {
                $tagData[] = [
                    'berita_id' => $berita_id,
                    'tag_id' => $tag,
                ];
            }
            if (!empty($tagData)) {
                $this->beritatag->insertBatch($tagData);
            }

            $msg = [
                'sukses' => 'Data berita berhasil diubah!',
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];
            echo json_encode($msg);
        }
    }


    public function formgantifoto()
    {
        // Pastikan sesi aktif
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        // Hanya tangani permintaan AJAX
        if ($this->request->isAJAX()) {
            // Ambil ID berita
            $berita_id = $this->request->getVar('berita_id');
            if (empty($berita_id)) {
                echo json_encode([
                    'error' => 'ID berita tidak valid.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Ambil data berita berdasarkan ID
            $berita = $this->berita->find($berita_id);
            if (!$berita) {
                echo json_encode([
                    'error' => 'Data berita tidak ditemukan.',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            // Data yang akan dikirim ke tampilan
            $data = [
                'title' => 'Ganti Sampul Berita',
                'id' => $berita['berita_id'],
                'gambar' => $berita['gambar'],
                'ket_foto' => $berita['ket_foto'],
            ];

            // Template admin aktif


            // Kirimkan pesan sukses beserta tampilan
            $msg = [
                'sukses' => view('backend/berita/gantifoto', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function douploadBerita()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        if ($this->request->isAJAX()) {
            $berita_id = $this->request->getVar('berita_id');
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'gambar' => [
                    'label' => 'Sampul Berita',
                    'rules' => 'max_size[gambar,2024]|mime_in[gambar,image/png,image/jpg,image/jpeg,image/gif]|is_image[gambar]',
                    'errors' => [
                        'uploaded' => 'Masukkan gambar',
                        'max_size' => 'Ukuran {field} maksimal 2024 KB!',
                        'mime_in' => 'Format file {field} hanya PNG, JPEG, JPG, atau GIF!',
                    ]
                ]
            ]);

            if (!$valid) {
                echo json_encode([
                    'error' => [
                        'gambar' => $validation->getError('gambar')
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ]);
                return;
            }

            $fileGambar = $this->request->getFile('gambar');
            $updateData = [
                'ket_foto' => $this->request->getVar('ket_foto')
            ];

            if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                $namaFileBaru = $fileGambar->getRandomName();

                // Hapus file lama jika ada
                $berita = $this->berita->find($berita_id);
                if ($berita && !empty($berita['gambar']) && file_exists('public/img/informasi/berita/' . $berita['gambar'])) {
                    unlink('public/img/informasi/berita/' . $berita['gambar']);
                }

                // Simpan file baru dengan watermark
                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();
                $namaAplikasi = strtoupper($konfigurasi['nama'] ?? 'APP');

                \Config\Services::image()
                    ->withFile($fileGambar)
                    ->text(
                        $namaAplikasi,
                        [
                            'color' => '#fff',
                            'opacity' => 0.7,
                            'hAlign' => 'center',
                            'vAlign' => 'middle',
                            'fontSize' => 20
                        ]
                    )
                    ->save('public/img/informasi/berita/' . $namaFileBaru, 65);

                // Tambahkan nama file baru ke data yang akan diperbarui
                $updateData['gambar'] = $namaFileBaru;
            }

            // Update data berita
            $this->berita->update($berita_id, $updateData);

            echo json_encode([
                'sukses' => $fileGambar && $fileGambar->isValid() ? 'Cover Berita berhasil diganti!' : 'Data berhasil diubah!',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ]);
        }
    }

    // Balas Komentar Berita----------------------------------------------------------

    public function simpankomen()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_komen' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],

                'email_komen' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                        'valid_email' => 'Masukkan {field} dengan benar!',
                    ]
                ],
                'hp_komen' => [
                    'label' => 'No HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',

                    ]
                ],
                'isi_komen' => [
                    'label' => 'Isi Komentar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong!',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_komen' => $validation->getError('nama_komen'),
                        'email_komen' => $validation->getError('email_komen'),
                        'hp_komen' => $validation->getError('hp_komen'),
                        'isi_komen' => $validation->getError('isi_komen'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {

                $konfigurasi = $this->konfigurasi->orderBy('id_setaplikasi')->first();

                $secretkey = $konfigurasi['google_secret'];
                $g_sitekey = $konfigurasi['g_sitekey'];
                $nama = $this->request->getVar('nama_komen');
                $isi_komen = $this->request->getVar('isi_komen');

                $nm = htmlspecialchars($nama, ENT_QUOTES);
                $isi = htmlspecialchars($isi_komen, ENT_QUOTES);

                // gcaptcha
                $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
                $secret = $secretkey;
                if ($secretkey != '' && $g_sitekey != '') {

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
                    if ($status['success']) {

                        $insertdata = [
                            'berita_id' => $this->request->getVar('berita_id'),
                            'nama_komen' => htmlspecialchars($this->request->getVar('nama_komen'), ENT_QUOTES),
                            'isi_komen' => htmlspecialchars($this->request->getVar('isi_komen'), ENT_QUOTES),
                            'hp_komen' => $this->request->getVar('hp_komen'),
                            'email_komen' => $this->request->getVar('email_komen'),
                            'tanggal_komen' => date('Y-m-d H:i:s'),
                            'sts_komen' => '0'

                        ];

                        $this->beritakomen->insert($insertdata);

                        $msg = [
                            'sukses' => 'Komentar anda telah berhasil dikirim dan perlu dimoderasi untuk ditampilkan.'
                        ];
                    } else {
                        $msg = [
                            'gagal' => 'Gagal kirim Komentar Silahkan periksa Kembali!'
                        ];
                    }
                } else {
                    $insertdata = [
                        'berita_id' => $this->request->getVar('berita_id'),
                        'hp_komen' => $this->request->getVar('hp_komen'),
                        'nama_komen' => $nm,
                        'isi_komen' => $isi,
                        'email_komen' => $this->request->getVar('email_komen'),
                        'tanggal_komen' => date('Y-m-d H:i:s'),
                        'sts_komen' => '0'

                    ];

                    $this->beritakomen->insert($insertdata);
                    $msg = [
                        'sukses' => 'Komentar anda telah berhasil dikirim dan perlu dimoderasi untuk ditampilkan.'
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function getkomennew()
    {

        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }
        $data = [
            'list' => $this->beritakomen->listkomennew(),
            'totkomen' => $this->beritakomen->totkomen(),
        ];
        $msg = [
            'data' => view("backend/berita/berita_komen/vmenukomen", $data),
        ];
        echo json_encode($msg);
    }

    // form Baca & balas Komentar
    public function formkomenback()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $id_grup = session()->get('id_grup');
            $beritakomen_id = $this->request->getVar('beritakomen_id');
            $list = $this->beritakomen->find($beritakomen_id);

            $url = 'berita/all';
            $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);
            $akses = $listgrupf->akses;

            // jika temukan maka eksekusi
            if ($listgrupf) {
                # cek akses
                if ($akses == '1' || $akses == '2') {
                    $data = [
                        'title' => 'Tanggapi Komentar',
                        'nama_komen' => $list['nama_komen'],
                        'hp_komen' => $list['hp_komen'],
                        'isi_komen' => $list['isi_komen'],
                        'tanggal_komen' => $list['tanggal_komen'],
                        'email_komen' => $list['email_komen'],
                        'sts_komen' => $list['sts_komen'],
                        'beritakomen_id' => $list['beritakomen_id'],
                        'balas_komen' => $list['balas_komen'],
                        'akses' => $akses
                    ];

                    $msg = [
                        'sukses' => view('backend/berita/berita_komen/edit', $data),
                        'csrf_tokencmsikasmedia' => csrf_hash(),
                    ];
                } else {
                    $msg = [
                        'noakses' => []
                    ];
                }
            } else {

                $msg = [
                    'blmakses' => []
                ];
            }


            echo json_encode($msg);
        }
    }

    // Update Balasan Komentar berita
    public function updatekomentar()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'isi_komen' => [
                    'label' => 'Isi Komentar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'isi_komen' => $validation->getError('isi_komen'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            } else {

                $beritakomen_id = $this->request->getVar('beritakomen_id');
                $balas_komen = $this->request->getVar('balas_komen'); //isi balasan
                $isi_komen = $this->request->getVar('isi_komen'); //isi balasan
                $nama_komen = $this->request->getVar('nama_komen'); //isi balasan


                $isi = htmlspecialchars($isi_komen, ENT_QUOTES);
                $bls = htmlspecialchars($balas_komen, ENT_QUOTES);
                $nm = htmlspecialchars($nama_komen, ENT_QUOTES);
                $userid = session()->get('id');
                $data = [
                    'nama_komen' => $nm,
                    'isi_komen' => $isi,
                    'sts_komen' => $this->request->getVar('sts_komen'),
                    'balas_komen' => $bls,
                    'id' => $userid,
                    'tgl_balas' => date('Y-m-d H:i:s'),
                ];

                $this->beritakomen->update($beritakomen_id, $data);

                $msg = [
                    'sukses' => 'Berhasil update Data !',
                    'csrf_tokencmsikasmedia' => csrf_hash(),
                ];
            }
            echo json_encode($msg);
        }
    }

    // form list Komentar
    public function listkomen()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Komentar',
            'subtitle' => 'Berita',

        ];
        return view('backend/berita/berita_komen/index', $data);
    }

    // Ambil data Komentar
    public function getdatakomen()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'berita/all';

        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek jika grup akses tidak ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        $akses = $listgrupf->akses;

        // Cek akses valid (1 atau 2)
        if (!in_array($akses, [1])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk view
        $data = [
            'title' => 'Komentar Berita',
            'list' => $this->beritakomen->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
        ];
        $msg = [
            'data' => view("backend/berita/berita_komen/list", $data),
        ];

        echo json_encode($msg);
    }

    // hapus Komentar Berita
    public function hapuskomen()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $beritakomen_id = $this->request->getVar('beritakomen_id');
            $this->beritakomen->delete($beritakomen_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];

            echo json_encode($msg);
        }
    }
    // hapus multi Komen
    public function hapuskomenall()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $beritakomen_id = $this->request->getVar('beritakomen_id');
            $jmldata = count($beritakomen_id);
            for ($i = 0; $i < $jmldata; $i++) {

                $this->beritakomen->delete($beritakomen_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil dihapus",
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    //Start TAG (backend)----------------------

    public function alltag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [

            'title' => 'Informasi - Berita',
            'subtitle' => 'Tag',

        ];
        return view('backend/berita/tag/index', $data);
    }


    public function gettag()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }

        $id_grup = session()->get('id_grup');
        $url = 'berita/alltag';

        // Ambil grup akses berdasarkan ID grup dan URL
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek jika grup akses tidak ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        $akses = $listgrupf->akses;

        // Cek akses valid (1 atau 2)
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }
        // Siapkan data untuk view
        $data = [
            'title' => 'Tag - Berita',
            'list' => $this->tag->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Buat respon JSON
        $msg = [
            'data' => view("backend/berita/tag/list", $data),
        ];

        echo json_encode($msg);
    }

    public function formtag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Tag'
            ];

            $msg = [
                'data' => view('backend/berita/tag/tambah', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpantag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tag' => [
                    'label' => 'Tag',
                    'rules' => 'required|is_unique[tag.nama_tag]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tag' => $validation->getError('nama_tag'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                $simpandata = [
                    'nama_tag' => $this->request->getVar('nama_tag'),
                    'slug_tag' => mb_url_title($this->request->getVar('nama_tag'), '-', TRUE),
                ];

                $this->tag->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedittag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tag_id = $this->request->getVar('tag_id');
            $list = $this->tag->find($tag_id);

            $data = [
                'title' => 'Edit Tag',
                'tag_id' => $list['tag_id'],
                'nama_tag' => $list['nama_tag'],
            ];
            $msg = [
                'sukses' => view('backend/berita/tag/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash()

            ];
            echo json_encode($msg);
        }
    }

    public function updatetag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_tag' => [
                    'label' => 'Nama Tag',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_tag' => $validation->getError('nama_tag'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                $updatedata = [
                    'nama_tag' => $this->request->getVar('nama_tag'),
                    'slug_tag' => mb_url_title($this->request->getVar('nama_tag'), '-', TRUE),
                ];

                $tag_id = $this->request->getVar('tag_id');
                $this->tag->update($tag_id, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapustag()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $tag_id = $this->request->getVar('tag_id');
            $this->tag->delete($tag_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];

            echo json_encode($msg);
        }
    }

    //end TAG------------------------------------

    //Start kategori (backend)----------------------
    public function allkategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }

        $data = [
            'title' => 'Informasi - Berita',
            'subtitle' => 'Kategori',
            'csrf_tokencmsikasmedia' => csrf_hash(),

        ];
        return view('backend/berita/kategori/index', $data);
    }


    public function getkategori()
    {
        if (!session()->get('id') || !$this->request->isAJAX()) {
            return redirect()->to('');
        }
        $id_grup = session()->get('id_grup');
        $url = 'berita/allkategori';

        // Ambil grup akses berdasarkan ID grup dan URL
        $listgrupf = $this->grupakses->viewgrupakses($id_grup, $url);

        // Cek jika grup akses tidak ditemukan
        if (!$listgrupf) {
            echo json_encode(['blmakses' => []]);
            return;
        }

        $akses = $listgrupf->akses;

        // Cek akses valid (1 atau 2)
        if (!in_array($akses, [1, 2])) {
            echo json_encode(['noakses' => []]);
            return;
        }

        // Siapkan data untuk view
        $data = [
            'title' => 'Kategori - Berita',
            'list' => $this->kategori->list(),
            'akses' => $akses,
            'hapus' => $listgrupf->hapus,
            'ubah' => $listgrupf->ubah,
            'tambah' => $listgrupf->tambah,
        ];

        // Buat respon JSON
        echo json_encode([
            'data' => view("backend/berita/kategori/list", $data),
        ]);
    }

    public function formkategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {


            $data = [
                'title' => 'Tambah Kategori'
            ];
            $msg = [
                'data' => view('backend/berita/kategori/tambah', $data),
                'csrf_tokencmsikasmedia' => csrf_hash(),
            ];
            echo json_encode($msg);
        }
    }

    public function simpankategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required|is_unique[kategori.nama_kategori]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori' => $validation->getError('nama_kategori'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()

                ];
            } else {
                $simpandata = [
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'slug_kategori' => mb_url_title($this->request->getVar('nama_kategori'), '-', TRUE),
                ];

                $this->kategori->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditkategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $kategori_id = $this->request->getVar('kategori_id');
            $list = $this->kategori->find($kategori_id);
            $data = [
                'title' => 'Edit Kategori',
                'kategori_id' => $list['kategori_id'],
                'nama_kategori' => $list['nama_kategori'],
            ];

            $msg = [
                'sukses' => view('backend/berita/kategori/edit', $data),
                'csrf_tokencmsikasmedia' => csrf_hash()

            ];
            echo json_encode($msg);
        }
    }

    public function updatekategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kategori' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kategori' => $validation->getError('nama_kategori'),
                    ],
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            } else {
                $updatedata = [
                    'nama_kategori' => $this->request->getVar('nama_kategori'),
                    'slug_kategori' => mb_url_title($this->request->getVar('nama_kategori'), '-', TRUE),

                ];

                $kategori_id = $this->request->getVar('kategori_id');
                $this->kategori->update($kategori_id, $updatedata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                    'csrf_tokencmsikasmedia' => csrf_hash()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuskategori()
    {
        if (!session()->get('id')) {
            return redirect()->to('');
        }
        if ($this->request->isAJAX()) {
            $kategori_id = $this->request->getVar('kategori_id');
            $this->kategori->delete($kategori_id);
            $msg = [
                'sukses' => 'Kategori Berhasil Dihapus',
                'csrf_tokencmsikasmedia' => csrf_hash()
            ];

            echo json_encode($msg);
        }
    }
}
