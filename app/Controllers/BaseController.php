<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


use App\Models\M_Ikasmedia_grupakses;
use App\Models\M_Ikasmedia_grupuser;
use App\Models\M_Ikasmedia_modul;
use App\Models\M_Ikasmedia_modulpublic;
use App\Models\M_Dokumen;
use App\Models\M_Dokumenkat;
use App\Models\M_Fasilitas;
use App\Models\M_FasilitasDetail;
use App\Models\M_Prj_master;
use App\Models\M_Prj_mohoninfo;

use App\Models\M_Unitkerja;
use App\Models\M_Unitkerjatipe;
use App\Models\M_PendaftaranSidi;
use App\Models\M_PendaftaranBaptis;
use App\Models\M_PendaftaranNikah;
use App\Models\M_PendaftaranDokumen;
use App\Models\M_PendaftaranTimeline;
use App\Models\M_PendaftaranCatatan;
use App\Models\M_MasterDokumen;
use App\Models\M_ProdukUmkm;
use App\Models\M_KategoriProduk;
use App\Models\M_Keranjang;
use App\Models\M_Pesanan;
use App\Models\M_PesananDetail;
use App\Models\M_JadwalPelayanan;
use App\Models\M_Jemaat;
use App\Models\M_JadwalIbadah;
use App\Models\M_JenisIbadah;
use App\Models\M_PelayanIbadah;
use App\Models\M_JabatanPelayanan;
use App\Models\M_MusikIbadah;
use App\Models\M_PengumumanIbadah;
use App\Models\M_KeuanganGereja;
use App\Models\M_KategoriKeuangan;
use App\Models\M_KasGereja;
use App\Models\M_MutasiKas;
use App\Models\M_InventarisGereja;
use App\Models\M_KategoriAset;
use App\Models\M_LokasiAset;
use App\Models\M_VendorMaintenance;
use App\Models\M_MaintenanceAset;
use App\Models\M_PerbaikanAset;
use App\Models\M_MajelisGereja;
use App\Models\M_JabatanMajelis;
use App\Models\M_MasaJabatanMajelis;
use App\Models\M_KomisiMajelis;


use App\Models\ModelAgenda;
use App\Models\ModelBankData;
use App\Models\ModelBanner;
use App\Models\ModelKonfigurasi;
use App\Models\ModelUser;
use App\Models\ModelBerita;
use App\Models\ModelBeritaKomen;
use App\Models\ModelBeritaTag;
use App\Models\ModelBtBidang;
use App\Models\ModelBukutamu;
use App\Models\ModelCounter;
use App\Models\ModelEbook;
use App\Models\ModelFaq_Jawab;
use App\Models\ModelFaq_Tanya;
use App\Models\ModelFoto;
use App\Models\ModelInformasi;
use App\Models\ModelKategori;
use App\Models\ModelKategoriEbook;
use App\Models\ModelKategoriFoto;
use App\Models\ModelKategoriVideo;
use App\Models\ModelKritikSaran;
use App\Models\ModelLinkTerkait;
use App\Models\ModelMenu;
use App\Models\ModelModalPop;
use App\Models\ModelPegawai;
use App\Models\ModelPoling;


use App\Models\ModelSection;
use App\Models\ModelSubMenu;
use App\Models\ModelSubsubMenu;
use App\Models\ModelSurveyJawaban;
use App\Models\ModelSurveyPertanyaan;
use App\Models\ModelSurveyResponden;
use App\Models\ModelSurveyTopik;
use App\Models\ModelTag;
use App\Models\ModelTransparan;
use App\Models\ModelTransparanDetail;
use App\Models\ModelVideo;




/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @property \CodeIgniter\Database\BaseConnection $db
 * @property \App\Models\ModelKategori $kategori
 * @property \App\Models\ModelKonfigurasi $konfigurasi
 * @property \App\Models\ModelMenu $menu
 * @property \App\Models\ModelAgenda $agenda
 * @property \App\Models\ModelBerita $berita
 * @property \App\Models\ModelBanner $banner
 * @property \App\Models\ModelFaq_Tanya $faqtanya
 * @property \App\Models\ModelEbook $ebook
 * @property \App\Models\ModelVideo $video
 * @property \App\Models\ModelFoto $foto
 * @property \App\Models\ModelLinkterkait $linkterkait
 * @property \App\Models\ModelSection $section
 * @property \App\Models\ModelCounter $counter
 * @property \App\Models\ModelPoling $poling
 * @property \App\Models\ModelUser $user
 * @property \App\Models\ModelInformasi $pengumuman
 * @property \App\Models\M_MajelisGereja $majelisgereja
 * @property \App\Models\M_JadwalPelayanan $jadwalpelayanan
 * @property \App\Models\M_ProdukUmkm $produkumkm
 * @property \App\Models\ModelInformasi $layanan
 * @property \App\Models\ModelModalPop $modalpopup
 * @property \App\Models\ModelBankData $bankdata
 * @property \App\Models\ModelTransparan $transparan
 * @property \App\Models\ModelTransparanDetail $transparandetail
 * @property \App\Models\ModelKategoriFoto $kategorifoto
 * @property \App\Models\ModelKritikSaran $kritiksaran
 * @property \App\Models\M_Ikasmedia_grupakses $grupakses
 * @property \App\Models\ModelKategoriVideo $kategorivideo
 * @property \App\Models\M_Ikasmedia_modulpublic $modulpublic
 * @property \App\Models\ModelTag $tag
 * @property \App\Models\ModelBeritaTag $beritatag
 * @property \App\Models\ModelBeritaKomen $beritakomen
 * @property \App\Models\M_Ikasmedia_grupuser $grupuser
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'Tgl_indo', 'cookie', 'dge', 'text'];
    protected $session;


    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Custome module

        $this->masterdata = new M_Prj_master();
        $this->permohonaninfo = new M_Prj_mohoninfo();

        $this->unitkerja = new M_Unitkerja();

        $this->unitkerjatipe = new M_Unitkerjatipe();
        $this->dokumen = new M_Dokumen();
        $this->dokumenkat = new M_Dokumenkat();
        // pengaturan hak akses
        $this->modulecms = new M_Ikasmedia_modul();
        $this->grupuser = new M_Ikasmedia_grupuser();
        $this->grupakses = new M_Ikasmedia_grupakses();
        $this->modulpublic = new M_Ikasmedia_modulpublic();

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->konfigurasi = new ModelKonfigurasi();
        $this->email = \Config\Services::email();
        $this->banner = new ModelBanner();
        $this->user = new ModelUser();
        $this->berita = new ModelBerita();
        $this->kategori = new ModelKategori();
        $this->infografis = new ModelBanner();
        $this->profil = new ModelBerita();
        $this->pegawai = new ModelPegawai();
        $this->linkterkait = new ModelLinkTerkait();
        $this->agenda = new ModelAgenda();
        $this->layanan = new ModelInformasi();
        $this->pengumuman = new ModelInformasi();
        $this->bankdata = new ModelBankData();
        $this->kategorifoto = new ModelKategoriFoto();
        $this->foto = new ModelFoto();
        $this->video = new ModelVideo();
        $this->kritiksaran = new ModelKritikSaran();

        $this->poling = new ModelPoling();
        $this->menu = new ModelMenu();
        $this->submenu = new ModelSubMenu();
        $this->subsubmenu = new ModelSubsubMenu();
        $this->section = new ModelSection();
        $this->ebook = new ModelEbook();
        $this->kategoriebook = new ModelKategoriEbook();


        $this->surveytopik = new ModelSurveyTopik();
        $this->pertanyaan = new ModelSurveyPertanyaan();
        $this->jawaban = new ModelSurveyJawaban();
        $this->responden = new ModelSurveyResponden();
        // buku tamu
        $this->bidang = new ModelBtBidang();
        $this->bukutamu = new ModelBukutamu();
        $this->bukutamu = new ModelBukutamu();
        $this->counter = new ModelCounter();
        $this->kategorivideo = new ModelKategoriVideo();
        $this->tag = new ModelTag();
        $this->beritatag = new ModelBeritaTag();
        $this->beritakomen = new ModelBeritaKomen();
        $this->faqtanya = new ModelFaq_Tanya();
        $this->faqjawab = new ModelFaq_Jawab();
        $this->modalpopup = new ModelModalPop();
        $this->transparandetail = new ModelTransparanDetail();
        $this->transparan = new ModelTransparan();
        $this->fasilitas = new M_Fasilitas();
        $this->fasilitasdetail = new M_FasilitasDetail();
        $this->pendaftaransidi = new M_PendaftaranSidi();
        $this->pendaftaranbaptis = new M_PendaftaranBaptis();
        $this->pendaftarannikah = new M_PendaftaranNikah();
        $this->pendaftarandokumen = new M_PendaftaranDokumen();
        $this->pendaftarantimeline = new M_PendaftaranTimeline();
        $this->pendaftarancatatan = new M_PendaftaranCatatan();
        $this->masterdokumen = new M_MasterDokumen();
        $this->produkumkm = new M_ProdukUmkm();
        $this->kategoriproduk = new M_KategoriProduk();
        $this->keranjang = new M_Keranjang();
        $this->pesanan = new M_Pesanan();
        $this->pesanandetail = new M_PesananDetail();
        $this->jadwalpelayanan = new M_JadwalPelayanan();
        $this->jemaat = new M_Jemaat();
        $this->jadwalibadah = new M_JadwalIbadah();
        $this->jenisibadah = new M_JenisIbadah();
        $this->pelayanibadah = new M_PelayanIbadah();
        $this->jabatanpelayanan = new M_JabatanPelayanan();
        $this->musikibadah = new M_MusikIbadah();
        $this->pengumumanibadah = new M_PengumumanIbadah();
        $this->keuangangereja = new M_KeuanganGereja();
        $this->kategorikeuangan = new M_KategoriKeuangan();
        $this->kasgereja = new M_KasGereja();
        $this->mutasikas = new M_MutasiKas();
        $this->inventarisgereja = new M_InventarisGereja();
        $this->kategoriaset = new M_KategoriAset();
        $this->lokasiaset = new M_LokasiAset();
        $this->vendormaintenance = new M_VendorMaintenance();
        $this->maintenanceaset = new M_MaintenanceAset();
        $this->perbaikanaset = new M_PerbaikanAset();
        $this->majelisgereja = new M_MajelisGereja();
        $this->jabatanmajelis = new M_JabatanMajelis();
        $this->masajabatanmajelis = new M_MasaJabatanMajelis();
        $this->komisimajelis = new M_KomisiMajelis();

        $this->user->kunjungan();
    }
}
