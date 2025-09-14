-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2025 at 04:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsikasmedia_460`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int NOT NULL,
  `tema` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_tema` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_agenda` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tempat` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengirim` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  `jam` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `tema`, `slug_tema`, `gambar`, `isi_agenda`, `tempat`, `pengirim`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `jam`, `hits`, `id`, `sts`) VALUES
(2, 'Bimtek Pengelolaan Website Dinas Versi terbaru', 'bimtek-pengelolaan-website-dinas-versi-terbaru', '1627956974_0377753d26438dc3142d.png', '  <p>Bimtek ini bertujuan untuk memberikan pelatihan agar Administrator OPD dapat memanfaatkan semua fitur secara optimal.</p>', 'Kantor Dinas Pemuda dan Olahraga', 'ikasmedia Software', '2021-09-09', '2021-09-10', '2021-08-03', '09.00 - selesai', 82, 1, NULL),
(3, 'Pembahasan Verifikasi Usulan Rencana Kerja dan Anggaran TA 2021', 'pembahasan-verifikasi-usulan-rencana-kerja-dan-anggaran-ta-2021', 'default.png', '<p>Rapat penting yang berfungsi untuk membahas berbagai isu strategis dengan ribu ratu Lembata, terkhusus di bidang pemuda olahraga dan kebudayaan.</p>', 'Kantor Dinas BKD Keuangan Kab. Lembata', 'Dinas BKD Keuangan', '2021-09-12', '2021-09-13', '2021-06-02', '09.00 - selesai', 90, 1, NULL),
(4, 'Gelar Rapat Persiapan Pengadaan Barang dan Jasa TA 2021', 'gelar-rapat-persiapan-pengadaan-barang-dan-jasa-ta-2021', 'default.png', '<p>Mempersiapkan data-data penunjang kinerja setiap instansi yang merupakan hal penting dalam pengolaan pengadaan barang dan jasa yang profesional dan akuntabel.</p>', 'Kantor Dinas Pemuda dan Olahraga', 'Dinas Kominfo Kab. Lembata', '2021-09-11', '2021-09-11', '2021-06-02', '09.00 - selesai', 112, 1, NULL),
(5, 'Rapat Tindak Lanjuti PP Nomor 49 Tahun 2020', 'rapat-tindak-lanjuti-pp-nomor-49-tahun-2020', 'default.png', ' <p>Mengingat Peraturan Perundangan yang belum maksimal dilaksanakan, maka akan dilaksanan rapat konsolidasi setiap OPD yang ada di Pemerintahan daerah Kabupaten Lembata.</p>', 'Kantor Dinas Pemuda dan Olahraga', 'Dinas Kominfo Kabupaten Lembata', '2021-10-01', '2021-10-01', '2021-06-03', '08.00 - selesai', 127, 1, NULL),
(8, 'Rilies Update CMS Versi 3.0.2', 'rilies-update-cms-versi-302', 'default.png', '  Untuk meningkatkan kenyamanan dalam penggunaan CMS maka akan segera dibuka workshop CMS ikasmedia', 'Lembata - NTT', 'ikasmedia Software', '2022-04-25', '2022-04-26', '2022-04-23', '08 sampai selesai', 60, 1, NULL),
(9, 'El Tari Memorial Cup Ke-31 Tahun 2022', 'el-tari-memorial-cup-ke-31-tahun-2022', 'default.png', ' <p><span style=\"color: rgb(34, 34, 34); font-family: Poppins; font-size: 15px; letter-spacing: 0.32px;\">Kompetisi sepak bola liga III zona Nusa Tenggara Timur, El Tari Memorial Cup (ETMC) ke – 31 tahun 2022 akan digelar di Kabupaten Lembata NTTx</span><br></p>', 'Gelora 99 Kabupaten Lembata', 'Disporabud', '2022-07-01', '2022-07-31', '2023-07-19', '14.00 - Selesai', 84, 1, NULL),
(16, 'Rilis CMS ikasmedia Ver. 4.0', 'rilis-cms-ikasmedia-ver-40', 'default.png', '<p style=\"line-height: 1.8;\"><span style=\"font-size: 18px;\">Berbagai perbaikan dan penyempurnaan CMS ikasmedia terus dilakukan agar Lembaga, atau Instansi yang sudah mempercayakan situs resmi nya menggunakan CMS anak kampung ini, mendapatkan layanan yang maksimal. Untuk itu CMS yang awalnya dikembangkan tahun 2021 ini, terus berbenah. Hal ini ditandai dengan dirilesnya CMS Versi 4.0 pada tanggal 17 Agustus 2023 mendatang.&nbsp;</span></p>', 'Lembata - NTT', 'ikasmedia Software', '2023-08-02', '2023-08-17', '2023-08-02', '08.00 - Selesai', 40, 1, NULL),
(17, 'Launching CMS versi baru', 'launching-cms-versi-baru', 'default.png', '  <p>Akan dilakukan launching cms terbaru dengan tema admin versi baru</p>', 'Lembata - NTT', 'ikasmedia', '2023-10-29', '2023-10-29', '2024-06-23', '08', 29, 1, NULL),
(19, 'Launching Template Admin CMS ikasmedia', 'launching-template-admin-cms-ikasmedia', 'default.png', '     <p>Pembaruan tampilan tema admin yang disesuaikan dengan tren terkini, serta penyajian informasi situs yang lebih elegan dan komprehensif.</p>', 'Waikomo', 'ikasmedia Software', '2025-02-06', '2025-02-06', '2025-02-05', '08.00 WITA - Selesai', 24, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bankdata`
--

CREATE TABLE `bankdata` (
  `bankdata_id` int NOT NULL,
  `nama_bankdata` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fileupload` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_upload` date DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bankdata`
--

INSERT INTO `bankdata` (`bankdata_id`, `nama_bankdata`, `fileupload`, `slug_bank`, `tgl_upload`, `hits`, `id`, `sts`, `ket`) VALUES
(1, 'Rencana dan program kerja pembinaan organisasi kepemudaan', '1624787922_9110c06de6b051bd2a4a.txt', 'rencana-dan-program-kerja-pembinaan-organisasi-kepemudaan', '2021-06-04', 18, 1, NULL, NULL),
(2, 'Rumusan kebijakan teknis bidang keolahragaan', '1629372547_de2ea6f345b7e33bb086.png', 'rumusan-kebijakan-teknis-bidang-keolahragaan', '2021-06-04', 25, 1, NULL, NULL),
(3, 'Laporan hasil pelaksanaan rencana strategis dan rencana kerja Dinas', '1689768228_d346a58433ac8b0c0d4a.xlsx', 'laporan-hasil-pelaksanaan-rencana-strategis-dan-rencana-kerja-dinas', '2021-06-04', 26, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_id` int NOT NULL,
  `judul_berita` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_berita` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ringkasan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gambar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_berita` date DEFAULT NULL,
  `status` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori_id` int DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `jenis_berita` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `likepost` int DEFAULT '0',
  `headline` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket_foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filepdf` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_komen` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `pilihan` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(1, 'Literasi Digital Bergulir ke Seluruh Negeri', 'literasi-digital-bergulir-ke-seluruh-negeri', '     Tantangan di ruang digital di tanah air saat ini semakin besar. Konten-konten negatif terus bermunculan, kejahatan di ruang digital terus meningkat. Hoaks, penipuan daring, perjudian, eksploitasi seksual pada anak, perundungan siber, ujaran kebencian, dan radikalisme berbasis digital perlu terus diwaspadai karena mengancam persatuan dan kesatuan bangsa.', '      <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Tantangan di ruang digital di tanah air saat ini semakin besar. Konten-konten negatif terus bermunculan, kejahatan di ruang digital terus meningkat. Hoaks, penipuan daring, perjudian, eksploitasi seksual pada anak, perundungan siber, ujaran kebencian, dan radikalisme berbasis digital perlu terus diwaspadai karena mengancam persatuan dan kesatuan bangsa.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Hal tersebut diungkapkan Presiden Joko Widodo saat membuka program nasional <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">”Indonesia Makin Cakap Digital”</em> secara virtual, Kamis (20/05/2021). Peluncuran program yang bertepatan dengan Peringatan 113 Tahun Hari Kebangkitan Nasional tersebut merupakan bagian dari Gerakan Nasional Literasi Digital Siberkreasi dan dilaksanakan serentak di 34 provinsi dan 514 kabupaten/kota.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">\"Kewajiban kita bersama untuk terus meminimalkan konten negatif, membanjiri ruang digital dengan konten-konten positif. Banjiri terus, isi terus dengan konten-konten positif. Kita harus tingkatkan kecakapan digital masyarakat agar mampu menciptakan lebih banyak konten-konten kreatif yang mendidik, yang menyejukkan, yang menyerukan perdamaian,\" ujar Kepala Negara.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Tidak hanya itu, menurut Presiden Jokowi, aplikasi internet juga harus mampu meningkatkan produktivitas masyarakat supaya UMKM bisa naik kelas. Sudah saatnya, memperbanyak UMKM <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">onboarding</em> ke platform <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">e-commerce</em>, sehingga internet bisa memberi nilai tambah ekonomi bagi seluruh lapisan masyarakat.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">\"Saya harap gerakan ini menggelinding dan terus membesar, bisa mendorong berbagai inisiatif di tempat lain, melakukan kerja-kerja konkret di tengah masyarakat agar makin cakap memanfaatkan internet untuk kegiatan edukatif dan produktif,\" kata Presiden.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Menteri Komunikasi dan Informatika (Kominfo) Johnny G Plate menambahkan, setelah peluncuran tersebut, selama enam bulan ke depan, Kemenkominfo akan menyelenggarakan kelas-kelas webinar yang mengupas berbagai hal seputar literasi digital dan terbuka untuk seluruh warga masyarakat.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Untuk diketahui, Program Literasi Digital Nasional ditujukan untuk menciptakan ruang digital yang seru, namun tetap aman, beretika, dan produktif.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Terkait Gerakan Nasional Literasi Digital Siberkreasi, sebelumnya pada 16 April, Kemenkominfo telah lebih dulu meluncurkan empat modul literasi digital di Surabaya, Jawa Timur. Keempat modul literasi tersebut meliputi Budaya Bermedia Digital, Aman Bermedia Digital, Etis Bermedia Digital, dan Cakap Bermedia Digital.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Modul-modul tersebut disusun berdasarkan empat pilar literasi digital yang utama, yakni <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">digital culture</em>, <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">digital safety</em>, <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">digital ethics</em>, dan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">digital skills</em>. Modul ini merupakan manifestasi kolaborasi dari Gerakan Nasional Literasi Digital (GNLD) Siberkreasi, Jaringan Penggiat Literasi Digital (Japelidi), dan Kementerian Kominfo.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Pada 2021, Kementerian Kominfo mencanangkan gerakan literasi bagi 12,4 juta rakyat Indonesia di 34 provinsi dan 514 kabupaten/kota. Dan keempat modul tersebut akan diterapkan dalam program literasi tingkat <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">basic digital skills</em> dan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">intermediate digital skills</em>.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">\"Jadi, ini gerakan besar dan masif yang dilakukan secara nasional. Perlu kerja kolaboratif seluruh kementerian,\" ucap Johnny.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Kementerian Kominfo berharap, dari gerakan ini dalam tiga tahun mendatang bakal ada 30 juta dari 64 juta UMKM yang ada dapat memanfaatkan ruang-ruang digital sebagai <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">marketplace</em>. Setidaknya bisa memberdayakan 100 juta orang.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Menyangkut infrastruktur digital, Kementerian Kominfo bersama dengan ekosistem terkait sedang mempercepat pembangunan infrastruktur telekomunikasi untuk menjangkau daerah-daerah yang belum memiliki akses internet memadai.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Pembangunan infrastruktur telekomunikasi juga dibarengi dengan kesiapan sumber daya manusia (SDM) yang akan memanfaatkan layanan internet tersebut. Tanpa kesiapan SDM, ruang digital justru berpotensi digunakan untuk tujuan penyebaran konten negatif seperti penipuan daring, perjudian, prostitusi <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">online</em>, disinformasi atau hoaks, pencurian data pribadi, perundungan siber (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">cyberbullying</em>), ujaran kebencian (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">hate speech</em>), penyebaran paham radikalisme/terorisme di ruang digital, dan sebagainya.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Berdasarkan temuan survei Katadata Insight Center (KIC) yang bekerja sama dengan Kementerian Komunikasi dan Informatika serta Siberkreasi tahun 2020, setidaknya 30% sampai hampir 60% orang Indonesia terpapar hoaks saat mengakses dan berkomunikasi melalui dunia maya. Sementara itu, hanya 21% sampai 36% yang mampu mengenali hoaks. Kebanyakan hoaks yang ditemukan terkait isu politik, kesehatan, dan agama.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Menurut survei tersebut, selain kemampuan mengenali hoaks masih rendah, tingkat literasi digital orang Indonesia juga masih belum cukup tinggi. Dalam survei yang mengukur status literasi digital di 34 provinsi Indonesia ditemukan, indeks literasi digital secara nasional belum sampai level baik. Dari skor tertinggi adalah 5 dan terendah adalah 1, maka indeks literasi digital nasional baru 3,47.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Dari hasil survei itu, ada indikasi bahwa akses internet yang semakin tersebar dan terjangkau belum diiringi dengan meningkatnya kemampuan masyarakat dalam mengolah informasi dan berpikir kritis.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Adapun Indonesia diprediksi memiliki potensi ekonomi digital yang amat besar di dunia tahun 2025 yakni sebesar USD133 miliar. Sedangkan potensi ekonomi digital di negara-negara ASEAN mencapai USD300 miliar. Potensi ekonomi itu menunjukkan hampir setengah potensi ekonomi digital ASEAN ada di Indonesia.</span></p>', '1649428698_148958c068e84178b93c.jpg', '2021-05-24', '1', 2, 1, 'Berita', 301, 0, '1', '   Literasi digital Sumber foto :unslpash.com', NULL, '1', NULL),
(2, 'Politik Digital Anak Muda', 'politik-digital-anak-muda', 'Kehidupan berdemokrasi di suatu negara salah satunya ditentukan oleh seberapa besar partisipasi politik dari masyarakatnya. Partisipasi itu akan tampak ketika masyarakat ikut terlibat secara aktif dalam kehidupan berpolitik. Contohnya, ketika pemilihan presiden, kepala daerah, atau saat memilih wakil-wakil mereka yang akan duduk di kursi parlemen, baik di pusat maupun di daerah.', '   <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Kehidupan berdemokrasi di suatu negara salah satunya ditentukan oleh seberapa besar partisipasi politik dari masyarakatnya. Partisipasi itu akan tampak ketika masyarakat ikut terlibat secara aktif dalam kehidupan berpolitik. Contohnya, ketika pemilihan presiden, kepala daerah, atau saat memilih wakil-wakil mereka yang akan duduk di kursi parlemen, baik di pusat maupun di daerah.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Menurut pakar ilmu politik, mendiang Miriam Budiardjo dalam bukunya <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Partisipasi dan Partai Politik</em>, tinggi atau rendahnya partisipasi politik di masyarakat menjadi indikator penting bagaimana perkembangan berdemokrasi di negara tersebut. Semakin tinggi tingkat partisipasi politik masyarakatnya, maka itu menunjukkan bahwa mereka peduli terhadap perkembangan politik di negara mereka. Sebaliknya, semakin rendah angka partisipasi politik masyarakat di suatu negara menjadi pertanda kurang baik.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Dalam proses berdemokrasi tadi, terdapat kelompok-kelompok di masyarakat yang akan ikut mempengaruhi tinggi-rendahnya tingkat partisipasi politik. Salah satunya adalah anak-anak muda. Mereka adalah kelompok masyarakat yang menurut Pasal 1 Undang-Undang nomor 40 tahun 2009 tentang Kepemudaan didefinisikan sebagai warga negara Indonesia dalam rentang usia 16 hingga 30 tahun.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Dalam perkembangannya, mereka kemudian disebut sebagai Generasi Z dan Generasi Milenial. Badan Pusat Statistik mendefinisikan Generasi Z sebagai penduduk Indonesia yang lahir dalam rentang tahun 1997-2012 dan Generasi Milenial adalah mereka yang lahir antara 1981 hingga 1996.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Berdasarkan hasil Sensus Penduduk 2020, dari 270,2 juta jiwa populasi Indonesia saat ini, sebanyak 53,81 persen di antaranya merupakan gabungan dari kedua generasi di atas tadi. Rinciannya sebanyak 27,94 persen diisi oleh Generasi Z dan 25,87 persen lainnya masuk dalam kategori Generasi Milenial. “Kedua generasi ini termasuk dalam usia produktif yang dapat menjadi peluang untuk mempercepat pertumbuhan ekonomi,” kata Kepala BPS Kecuk Suhariyanto, ketika memberikan keterangan pers mengenai hasil Sensus Penduduk 2020 di Jakarta, (21/1/2021).</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Menurut Hasanuddin Ali dari Alvara Research, tipikal Generasi Z menuntut kehadiran internet nyaris di sepanjang kesehariannya. Ketergantungan mereka terhadap internet bahkan menyentuh angka 93,9 persen atau biasa disebut sebagai <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">mobile generation</em>. Generasi ini kehidupannya lebih banyak diwarnai dengan keceriaan (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">cheerful</em>).</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Sedangkan Generasi Milenial memiliki ketergantungan dengan internet sekitar 88,4 persen dan dalam kehidupannya masih berjuang untuk meniti karier. Demikian diungkapnya saat menjadi pembicara dalam diskusi daring bertema “Politik Digital, Pendidikan Politik, dan Partisipasi Politik Bagi Generasi Muda\" yang digelar Kementerian Komunikasi dan Informasi di Jakarta, Sabtu (17/4/2021).</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Dalam dunia politik, kata Hasanuddin, anak-anak muda tadi merupakan aset berharga dan menjadi incaran partai-partai politik. Ini lantaran Generasi Z dan Generasi Milenial merupakan kekuatan tersendiri yang harus direbut suaranya di dalam kontestasi pemilihan, baik pemilihan pemimpin negara, kepala daerah, atau saat memilih wakil rakyat.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: large; line-height: inherit; font-family: arial, helvetica, sans-serif; vertical-align: baseline; text-size-adjust: none;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 18px; line-height: 20.7px; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Pengaruh Media Sosial</span></span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Penetrasi internet di Indonesia saat ini telah menjangkau 196,7 juta penduduk berdasarkan survei Asosiasi Penyelenggara Jasa Internet Indonesia (APJII). Kondisi ini membuat partai-partai politik berlomba-lomba menceburkan diri membangun kekuatan baru di ranah digital. Mereka kemudian masuk ke berbagai <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">platform</em> media sosial yang ada demi mendapatkan simpati anak-anak muda melek teknologi.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Pemanfaatan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">platform</em> media sosial untuk kepentingan politik telah dirasakan manfaatnya oleh Hillary Brigitta Lasut. Anggota DPR RI termuda ini memakai berbagai <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">platform </em>media sosial sebagai wadah berkampanye dalam Pemilihan Legislatif 2019. Selain lebih murah, kehadiran media sosial, menurut wakil rakyat daerah pemilihan Sulawesi Utara itu, mampu menjangkau jauh lebih banyak pemilih muda.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Ia sendiri saat itu mampu meraup 70.345 suara untuk mengantarkannya ke Senayan. \"Saya merasakan benar pengaruh media sosial ketika berkampanye. Melalui media sosial pula saya bisa berinteraksi secara cepat dengan masyarakat, termasuk para konstituen saya. Kita bisa langsung mengetahui persoalan yang terjadi pada daerah pemilihan di Sulawesi Utara,\" kata wakil rakyat yang lahir 22 Mei 1996 tersebut.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Brigitta juga mengakui pada saat pandemi seperti sekarang keberadaan media sosial pun sangat diperlukan untuk berinteraksi dengan banyak orang, bahkan dalam sekali waktu. Teknologi digital juga telah memudahkan partai politik dalam menjangkau para kader-kadernya di seluruh negeri. \"Di partai kami, nyaris semua urusan kepartaian bisa dilakukan dengan teknologi digital, termasuk mengurus dan mencetak kartu anggota partai secara <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">online</em>. Sehingga orang-orang tidak perlu mendatangi kantor partai setiap saat hanya untuk mengurusnya,\" katanya dalam forum yang sama.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Di mata Komisioner KPI Pusat Yuliandre Darwis, kehadiran media sosial untuk meraih suara anak-anak muda untuk ikut berpartisipasi di dunia politik merupakan hal yang wajar di era teknologi digital. Doktor bidang komunikasi massa ini menyebutkan, ada yang harus diperhatikan oleh anak-anak muda saat ingin menyampaikan aspirasi politiknya di media sosial.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Belajar dari kasus bertebarannya informasi berupa berita bohong (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">hoaks</em>) dalam Pemilihan Umum 2019, Yuliandre menyebut, sangat diperlukan kehati-hatian dan langkah bijak dari Generasi Z dan Milenial. \"Banyak bertebaran informasi tak benar ketika Pemilu 2019, mulai dari berita bohong, hasutan, ujaran kebencian, dan lainnya. Diperlukan kesantunan di dalam berpolitik di media sosial terutama bagi anak-anak muda. Saring dulu sebelum <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">sharing</em> dan lakukan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">tabbayun</em>, mengecek terlebih dulu kebenaran suatu informasi,\" katanya.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Oleh karena itu, kendalikan jempolmu sebelum menyebarkan suatu informasi ke media sosial.</span></p>', '1649428373_279a0b9ae3cd1ac3d5d0.jpg', '2021-05-24', '1', 2, 1, 'Berita', 112, 2, '0', '', NULL, '0', NULL);
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(3, 'Cerdas Terima Informasi, Masyarakat Perlu Diedukasi', 'cerdas-terima-informasi-masyarakat-perlu-diedukasi', '    Kemajuan teknologi informasi, khususnya melalui platform digital, terjadi sangat pesat belakangan ini. Banyak hal positif yang dapat diambil, namun tidak sedikit juga sisi negatif yang dapat terjadi akibat disrupsi informasi yang ditimbulkan, seperti menyebarnya kabar bohong/hoax, fitnah, atau adu domba. ', '     <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">Jakarta, Kominfo</span> – Kemajuan teknologi informasi, khususnya melalui platform digital, terjadi sangat pesat belakangan ini. Banyak hal positif yang dapat diambil, namun tidak sedikit juga sisi negatif yang dapat terjadi akibat disrupsi informasi yang ditimbulkan, seperti menyebarnya kabar bohong/hoax, fitnah, atau adu domba. Oleh karena itu, untuk memperkecil sisi negatif yang terjadi dari kemajuan teknologi informasi, diperlukan edukasi kepada masyarakat agar dapat mengolah informasi yang diterima dengan baik.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Ya, makanya itu kita harus mengedukasi masyarakat supaya masyarakat itu cerdas, tidak menerima semua informasi yang diperoleh. Seperti tadi kita katakan, bahwa informasi ini ada yang positif, ada yang negatif, ada fitnah, ada kabar bohong, ada hoax ada berbagai macam hal. Ada yang destruktif, ada yang konstruktif. Nah, ini memang kita harus mengedukasi masyarakat untuk tidak menerima apa yang diterimanya,” tegas Wakil Presiden (Wapres) K. H. Ma’ruf Amin ketika diwawancara secara virtual dari Kediaman Resmi Wapres, Jl. Diponegoro No. 2 Jakarta, yang di muat oleh Harian Kompas, Sabtu (26/06/2021).</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Dalam wawancara yang dipandu oleh Pemimpin Redaksi Harian Kompas, Sutta Dharmasaputra ini, lebih lanjut Wapres menyampaikan bahwa bagi umat Islam, perintah untuk melakukan pengecekan ulang informasi sudah tertera di dalam Al-Quran.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Kalau di dalam Islam itu kan memang sudah ada, sudah ada ayatnya ya. Kalau ada berita, itu harus di-tabayyun dulu, dicek dulu. Jangan langsung diterima ya. Sebab mungkin sekali berita itu tidak benar, sehingga kamu membuat pandangan, pendapat, keputusan yang kamu sebenarnya tidak tahu persis, sehingga merugikan orang lain dan nanti kamu akhirnya akan menyesal,” ungkapnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Wapres pun kemudian menjelaskan, bahwa disrupsi informasi tidak hanya terjadi di Indonesia saja, tetapi juga secara global. Untuk itu, diperlukan upaya-upaya edukasi yang bersifat global untuk meredam terjadinya penyebaran informasi yang tidak bertanggung jawab.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Oleh karena itu, memang ada upaya-upaya yang sifatnya nasional, regional, bahkan juga global,” urai Wapres.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Ini memang harus ada strategi yang betul-betul yang tepat untuk menghadapi itu dan diperlukan adanya kewaspadaan dan kesiapan kita,” tambahnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Di sisi lain, Wapres juga menekankan tentang pentingnya penguatan empat bingkai kerukunan agar masyarakat tidak mudah terpecah belah akibat informasi yang menyesatkan, khususnya di Indonesia yang merupakan negara majemuk dengan beragam suku bangsa, agama, dan budaya. Keempat bingkai kerukunan tersebut adalah bingkai politis, bingkai teologis, bingkai sosiologis, dan bingkai yuridis.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menurut Wapres, bingkai politis berarti kerukunan yang dibangun sesuai dengan kesepakatan nasional (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">al mitsaq al wathani</em>), yang diperkuat dengan konsep Pancasila, Undang-Undang Dasar 1945, Negara Kesatuan Republik Indonesia, dan Bhinneka Tunggal Ika.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Sementara, bingkai teologis, Wapres mengatakan, kerukunan yang dibangun sesuai dengan ajaran agama, sehingga jika ada perbedaan, yang dibangun adalah kerukunan bukan narasi konflik.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Narasi-narasi yang dalam menyampaikan dakwah, penyiaran agamanya itu harus menghindarkan narasi konflik ini. Ini yang harus kita jaga betul pemahaman ini. Nah ini harus kita upayakan,” tegas Wapres.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Terkait bingkai sosiologis, lanjutnya, kerukunan yang diciptakan sesuai dengan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">local wisdom</em>, yaitu kearifan lokal, seperti di Batak ada <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">dalihan natolu,</em> di Ambon ada <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">pela gandong</em>, dan di Kalimantan ada rumah betang.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Jadi, ini semua sebenarnya di daerah itu ada kearifan lokal yang menjaga kerukunan, dia harus kita hidupkan dan kita bangun, sehingga mereka, masing-masing daerah itu kembali kepada kearifan lokalnya,” imbaunya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Yang terakhir, bingkai yuridis, Wapres menuturkan, kerukunan dibentuk sesuai dengan aturan-aturan sehingga tidak terjadi konflik nasional. Baik kerukunan antar pemeluk agama, antar sesama bangsa, etnis dan lain sebagainya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menutup wawancara, Wapres pun mengimbau kepada para pihak terkait yang memiliki otoritas dalam mengawasi peredaran informasi agar terus bekerja keras untuk dapat mengantisipasi dampak buruk dari disrupsi informasi dan mengedukasi masyarakat untuk dapat menerima serta mencerna informasi dengan baik.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Maka itu kita ingin supaya Kominfo (Kementerian Komunikasi dan Informatika), kemudian juga dari kalangan baik intelijen maupun cyber kita itu siap menghadapi setiap [disrupsi informasi yang terjadi], sehingga tidak terjadi penyebaran yang masif. Begitu muncul itu harus sudah bisa diantisipasi, dideteksi. Barangkali memang ini butuh kerja keras, kerja tidak mudah, ya dan kesadaran tinggi,” pungkasnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Selain Pemimpin Redaksi Harian Kompas, hadir secara virtual dalam wawancara ini beberapa wartawan Kompas yang bertugas di lingkungan Istana Wakil Presiden diantaranya Suhartono, Antony Lee, Cyprianus Anto Saptowalyono, Mawar Kusuma, dan Nina Susilo.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Sementara Wapres didampingi oleh Kepala Sekretariat Wapres Mohamad Oemar serta para Staf Khusus Wapres Bambang Widianto dan Masduki Baidlowi.</p>', '1649428328_0800129f4db890c8ea22.jpeg', '2021-05-24', '1', 1, 1, 'Berita', 76, 0, '0', ' Ilustrasi', NULL, '0', '0'),
(4, 'Pemerintah Dorong Pemanfaatan 5G untuk Industri Dalam Negeri', 'pemerintah-dorong-pemanfaatan-5g-untuk-industri-dalam-negeri', '  Pemerintah mendorong pemanfaatan teknologi telekomunikasi 5G untuk industri dalam negeri. Direktur Jenderal Industri Logam, Mesin, Alat Transportasi dan Elektronika Kementerian Perindustrian, Taufiek Bawazier menyatakan Kementerian Perindustrian mendorong industri dalam negeri memproduksi perangkat pendukung base station 5G.', '   <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\"><span style=\"margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">Jakarta, Kominfo -</span> Pemerintah mendorong pemanfaatan teknologi telekomunikasi 5G untuk industri dalam negeri. Direktur Jenderal Industri Logam, Mesin, Alat Transportasi dan Elektronika Kementerian Perindustrian, Taufiek Bawazier menyatakan Kementerian Perindustrian mendorong industri dalam negeri memproduksi perangkat pendukung <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">base station</em> 5G.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">\"H<span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">al ini sejalan dengan pesan Presiden Joko Widodo, khususnya untuk menunjang produksi industri manufaktur yang menggunakan teknologi IoT. </span><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Pengembangan R&D teknologi 5G, akan diarahkan ke Technopark binaan Kemenperin, hasil kerja sama dengan vendor-vendor dalam negeri,\" ujarnya dalam Webinar “5G dan Peran Insinyur Elektro dalam Pengembangan Transformasi Digital Indonesia” dari Jakarta, Sabtu (26/06/2021).</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Pemerintah telah meluncurkan “Peta Jalan Making Indonesia 4.0” pada 4 April 2018 lalu sebagai inisiatif untuk percepatan pembangunan industri memasuki era industri 4.0 dengan sasaran utama menjadikan Indonesia sebagai 10 negara ekonomi terbesar dunia berdasarkan PDB pada tahun 2030. </p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menurut Dirjen Taufiek, Kemenperin tengah menyiapkan industri dalam negeri dalam penyediaan perangkat pendukung base station 5G maupun aplikasinya. Sedangkan untuk tahap awal nilai persentase ambang batas minimum TKDN perangkat pengguna (User Equipment) 5G, dapat mengikuti nilai yang berlaku saat ini pada perangkat dengan teknologi 4G/LTE.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Pemerintah telah menetapkan 10 (sepuluh) program prioritas nasional, diantaranya dengan membangun Infrastruktur Digital, dan infrastruktur 5G termasuk di dalamnya untuk dapat mempercepat transformasi digital. Untuk itu dibutuhkan revitalisasi industri manufaktur guna mendukung program tersebut,” jelasnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Dirjen Ilmate menyatakan <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">teknologi 5G memiliki kombinasi antara konektivitas berkecepatan tinggi, latensi yang rendah, dan cakupan yang luas untuk dioptimalkan bagi penerapan industri 4.0. </span><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">“Sehingga sensor dan penganalisaan data akan menjadi </span><em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">real time</em><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\"> dan tanpa jeda,” tuturnya.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Selain itu, 5G juga membuat pengguna bisa mengontrol lebih banyak perangkat secara remote. Bahkan, 5G dapat membuka lebih banyak ragam <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">use case</em>, peluang bisnis, dan kebermanfaatan bagi masyarakat.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">“Di mana kinerja jaringan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">real-time</em> sangat kritis, seperti pada<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\"> remote control</em> alat berat di lingkungan berbahaya, sehingga dapat meningkatkan faktor keselamatan pekerja, dan banyak lainnya,” ungkap Dirjen Taufiek.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Direktur Jenderal Ilmate berharap dengan adanya webinar yang dilaksanakan BKE PII dan IEEE Indonesia Section dapat memberikan wawasan kepada Insinyur Elektro Indonesia untuk bisa memanfaatkan peluang teknologi 5G dalam menunjang Industri 4.0, membangun SDM dan ekosistem untuk mengakomodasi transformasi digital Indonesia.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Webinar yang diselenggarakan Persatuan Insinyur Indonesia) dan IEEE (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Institute of Electrical and Electronics Engineers</em>) Indonesia <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Section</em> khususnya bidang <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Government Relation Chapter</em>, diharapkan dapat menjadi wadah bagi para akademisi untuk bersinergi dalam membangun solusi teknologi berbasis 5G.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Selain Dirjen Ilmate Kementerian Perindustrian, webinar juga diisi dengan pembicara Kepala Badan Riset dan Inovasi Nasional, LT. Handoko dan Dirjen SDPPI Kementerian Kominfo, Ismail. Hadir pula perwakilan ekosistem 5G antara lain dari Telkomsel, PT. Tata Sarana Mandiri (TSM); ShintaVR; Asosiasi Internet of Things Indonesia (ASIOTI); serta <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Schneider Electric</em>. (hm.ys)</span></p>', '1649428444_dc2c821f6881c5bbddec.jpeg', '2021-05-24', '1', 1, 1, 'Berita', 54, 0, '0', '', NULL, '0', NULL),
(5, 'Menpora: Persiapan PON XX Berjalan sesuai Rencana', 'menpora-persiapan-pon-xx-berjalan-sesuai-rencana', '   Menteri Pemuda dan Olahraga, Zainudin Amali mengatakan bahwa persiapan fisik dalam penyelenggaraan PON XX, khususnya yang menjadi tanggung jawab Kemenpora telah berjalan sesuai dengan yang direncanakan.', '      <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">Jakarta, Kominfo</span> - Menteri Pemuda dan Olahraga, Zainudin Amali mengatakan bahwa persiapan fisik dalam penyelenggaraan PON XX, khususnya yang menjadi tanggung jawab Kemenpora telah berjalan sesuai dengan yang direncanakan.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">\"Persiapan venue, persiapan tempat penginapan, kemudian transportasi dan berbagai hal itu saya kira sudah berjalan. Mana yang menjadi tanggung jawab pemerintah pusat melalui pendanaan APBN, baik di Kemenpora maupun Kementerian PUPR, Kemkominfo, kemudian Kementerian Perhubungan dan lain-lain, saya kira itu sudah teralokasi,\" kata Zainudin Amali dalam diskusi Forum Merdeka Barat 9 (FMB9) yang mengangkat tema \"Mengintip Kesiapan PON XX Papua\" dari Jakarta, Kamis (24/06/2021).</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menurut Menpora, hal yang menjadi tanggung jawab pemerintah daerah, baik provinsi maupun kabupaten dan kota juga sudah siap. Secara keseluruhan, dalam rapat terbatas pada 15 Maret 2021 yang juga dihariri Gubernur Papua, Kemenpora telah memaparkan persiapan PON XX.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">\"Setelah kami memaparkan persiapan, kemudian Bapak Presiden bertanya kepada Gubernur Papua. Pak Gubernur bagaimana, sangat singkat jawaban Pak Gubernur waktu itu bahwa Papua siap menyelenggarakan PON 2021,\" ujar Menpora.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menurutnya, kalau ditanya apakah persiapan di lapangannya seperti apa tentu kami berkoordinasi terus. \"Kami bahkan dari Kemenpora menempatkan orang di sana secara bergiliran, kita tugaskan untuk memantau di empat klaster tersebut,\" katanya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menpora memaparkan, pada umumnya untuk pembangunan fisik dalam rangka persiapan PON XX sudah tidak menjadi masalah, termasuk apa yang menjadi tanggung jawab Kemenpora yakni pengadaan beberapa peralatan cabang olahraga (cabor).</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">\"Untuk pengadaan peralatan cabor tentunya tidak semuanya ada di Kemenpora, ada juga di provinsi. Kemudian, juga terkait penyelenggaraan, saya yakin akan berjalan sesuai jadwal,\" tegasnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menteri Zainudin Amali juga mengingatkan penting persiapan PON XX yang bersifat non fisik. Menurutnya, persiapan-persiapan non fisik seperti juga penting disamping mempersiapkan hal-hal yang bersifat fisik.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Menurut Menpora, pemain utama dari penyelenggaraan PON ini ini adalah Panitia Besar Pekan Olahraga Nasional (PB PON) yang Ketuanya adalah Gubernur Papua. Kemudian ada sub-sub dari PB PON, ada empat klaster, yakni di Kota Jayapura, Kabupaten Jayapura, Kabupaten Timika, dan Kabupaten Merauke.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">\"Tentu ini harus bisa terkoordinasi dengan baik supaya hajatan besar, hajatan olahraga nasional yang menjadi agenda empat tahunan ini bisa berlangsung dengan baik. sebab kalau tidak terjadi sinkronisasi gerak atau komunikasi ada yang terputus-putus baik antara pemerintah pusat dengan pemerintah propinsi, atau pemerintah provinsi dengan pemerintah kabupaten/kota. Apabila tidak sinkron pasti akan menggangu persiapan. Itu yang paling penting bagi kami. Jadi persiapan-persiapan non fisik seperti ini juga penting disamping kita mempersiapkan hal-hal yang bersifat fisik,\" ujar Menpora.</p>', '1649428277_530c62a6d47d3ede979f.jpeg', '2021-05-25', '1', 1, 1, 'Berita', 41, 0, '1', ' ', NULL, '0', NULL),
(6, 'Visi dan Misi', 'visi-dan-misi', NULL, '               <p class=\"MsoNormal\" style=\"line-height:150%\"><b><span style=\"font-size:12.0pt;line-height:150%;font-family:\" arial\",\"sans-serif\";=\"\" mso-fareast-language:in\"=\"\">VISI PEMERINTAH DAERAH KABUPATEN LEMBATA</span></b><span style=\"font-size:12.0pt;line-height:150%;font-family:\" arial\",\"sans-serif\";=\"\" mso-fareast-language:in\"=\"\"> :<span style=\"color:#777777\"><o:p></o:p></span></span></p><p class=\"MsoNormal\" style=\"line-height:150%\"><span style=\"font-size:12.0pt;\r\nline-height:150%;font-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Meneguhkan\r\nKabupaten Lembata Sebagai Kota Nyaman Huni&nbsp;dan Pusat Pelayanan Jasa yang\r\nBerdaya Saing Kuat&nbsp;untuk Keberdayaan Masyarakat dengan Berpijak pada Nilai\r\nKeistimewaan</span></p><p class=\"MsoNormal\" style=\"line-height:150%\"><b><span style=\"font-size:12.0pt;line-height:150%;font-family:\" arial\",\"sans-serif\";=\"\" mso-fareast-language:in\"=\"\">MISI PEMERINTAH&nbsp;DAERAH KABUPATEN LEMBATA</span></b><span arial\",\"sans-serif\";=\"\" mso-fareast-language:in\"=\"\" style=\"font-size: 12pt; line-height: 150%;\">&nbsp;:</span><br></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Meningkatkan\r\nkesejahteraan dan keberdayaan masyarakat<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Memperkuat ekonomi\r\nkerakyatan dan daya saing Kabupaten Lembata<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Memperkuat moral,\r\netika dan budaya masyarakat Kabupaten Lembata<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Meningkatkan kualitas\r\npendidikan, kesehatan, sosial dan budaya<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Memperkuat tata kota\r\ndan kelestarian lingkungan<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Membangun sarana\r\nprasarana publik dan permukiman<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent: -18pt; line-height: 150%; margin-left: 50px;\"><!--[if !supportLists]--><span style=\"font-size: 12pt; line-height: 150%; font-family: Symbol;\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span style=\"font-size:12.0pt;line-height:150%;\r\nfont-family:\" arial\",\"sans-serif\";mso-fareast-language:in\"=\"\">Meningkatkan\r\ntatakelola pemerintah yang baik dan bersih</span></p>', '1649391138_5a957340d4671f1969a2.png', '2021-05-25', '1', 2, 1, 'Halaman', 634, 1, NULL, '', '', '0', NULL),
(7, 'Struktur Organisasi', 'struktur-organisasi', NULL, '   <p><i>Struktur Organisasi Dinas</i></p>', '1660095373_bca7e20fe5a426b3f313.png', '2021-05-28', '1', 0, 1, 'Halaman', 324, 1, NULL, '', NULL, '0', NULL),
(8, 'Tugas Pokok dan Fungsi', 'tugas-pokok-dan-fungsi', NULL, ' <p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\"><strong style=\"font-weight: bold;\">Tugas</strong><span style=\"color: rgb(51, 102, 255);\"><strong style=\"font-weight: bold;\"><br></strong></span>Dinas Kelautan dan Perikanan Provinsi Jawa Timur mempunyai tugas membantu Gubernur melaksanakan urusan pemerintahan yang menjadi kewenangan Pemerintah Provinsi di bidang kelautan dan perikanan dan tugas pembantuan.</p><p style=\"font-family: Verdana, Geneva, sans-serif; font-size: 15px; line-height: 26px; margin-bottom: 26px; overflow-wrap: break-word; color: rgb(34, 34, 34);\"><strong style=\"font-weight: bold;\">Fungsi</strong><span style=\"color: rgb(51, 102, 255);\"><strong style=\"font-weight: bold;\"><br></strong></span>Dalam melaksanakan tugas tersebut, Dinas Kelautan dan Perikanan Provinsi Jawa Timur menyelenggarakan fungsi :</p><ul style=\"padding: 0px; color: rgb(34, 34, 34); font-family: Verdana, Geneva, sans-serif; font-size: 15px;\"><li style=\"line-height: 26px; margin-left: 21px;\">perumusan kebijakan di bidang kelautan dan perikanan;</li><li style=\"line-height: 26px; margin-left: 21px;\">pelaksanaan kebijakan di bidang kelautan dan perikanan;</li><li style=\"line-height: 26px; margin-left: 21px;\">pelaksanaan evaluasi dan pelaporan di bidang kelautan dan perikanan;</li><li style=\"line-height: 26px; margin-left: 21px;\">pelaksanaan administrasi dinas di bidang kelautan dan perikanan;</li><li style=\"line-height: 26px; margin-left: 21px;\">pelaksanaan fungsi lain yang diberikan oleh Gubernur terkait dengan tugas dan fungsinya.</li></ul>', '1629285661_d1882cee2ead2c2b4418.jpg', '2021-05-28', '1', 0, 1, 'Halaman', 324, 1, NULL, 'Ini adalah keterangan gambar', NULL, '0', NULL),
(9, 'Menpora Puji Ketum FPTI Yenny Wahid atas Prestasi Dua Atlet Panjat Tebing Indonesia', 'menpora-puji-ketum-fpti-yenny-wahid-atas-prestasi-dua-atlet-panjat-tebing-indonesia', ' Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali memuji Ketua Umum Federasi Panjat Tebing Indonesia (FPTI) Zannuba Ariffah Chafsoh atau lebih dikenal dengan Yenny Wahid atas kesukesan atlet Indonesia meraih medali emas dan memecahkan rekor pada dalam ajang Piala Dunia Panjat Tebing 2021 atau IFSC Worldcup yang digelar di Salt Lake City, USA pada 20 – 30 Mei 2021', '  <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali memuji Ketua Umum Federasi Panjat Tebing Indonesia (FPTI) Zannuba Ariffah Chafsoh atau lebih dikenal dengan Yenny Wahid atas kesukesan atlet Indonesia meraih medali emas dan memecahkan rekor pada dalam ajang Piala Dunia Panjat Tebing 2021 atau IFSC Worldcup yang digelar di Salt Lake City, USA pada 20 – 30 Mei 2021.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Saya mengapresiasi usaha keras mbak Yenny Wahid dalam memimpin cabang olahraga panjat tebing. Sehingga para atletnya dapat mengharumkan nama bangsa di kancah internasional,” kata Menpora Amali di Jakarta, Minggu (30/5).</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Menpora Amali mengungkapkan cabang olahraga panjat tebing merupakan salah satu cabang olahraga unggulan dalam Grand Design Olahraga Nasional yang ditargetkan untuk meraih prestasi di setiap olimpiade.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Tangan dingin mbak Yenny sebagai Ketum PB FPTI sudah membuktikan pembinaan atlet yang terencana dan berkesinambungan. Sebagai Menpora Saya sangat terbantu dan berterimakasih kepada beliau,” ujar Menpora Amali.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Sebelumnya, dua atlet panjat tebing tanah air yakni Veddriq Leonardo dan Kiromal Katibin memecahkan record dunia untuk kategori nomor speed 15 meter pada ajang Piala Dunia Panjat Tebing 2021 atau IFSC Worldcup yang digelar di Salt Lake City, USA, Sabtu (29/5). </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Veddriq sendiri meraih medali emas usai berhasil mengalahkan Kiromal Katibin pada laga final. Pada final Veddriq Leonardo mencatatkan waktu 5,20 detik.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Tidak hanya itu, record sebelumnya tercipta sejak pada babak penyisihan, Veddriq Leonardo mematahkan rekor sebelumnya yang dibuat atlet Iran, Reza Alipour, pada Piala Dunia 2017 di Nanjing, China. Kala itu catatan terbaik adalah 5,48 detik.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Veddriq Leonardo lalu memecahkannya dengan catatan 5,37 detik. Namun kemudian Kiromal Katibin langsung melangkahi rekannya tersebut dengan membuat torehan 5,25 detik. Namun pada final, Veddriq Leonardo membuat catatan apik dengan waktu 5,20 detik.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Veddriq yang keluar sebagai pemenang dan berhasil membawa pulang medali emas dari Kejuaraan Dunia Panjang Tebing tersebut. Catatan waktunya yang menyentuh 5,20 detik itu lantas membuatnya menjadi pemegang rekor dunia sebagai yang tercepat menyelesaikan wall 15 meter di nomor speed putra tersebut.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Mereka (Veddriq dan Kiromal) melakukannya lagi. Veddric Leonardo mengalahkan rekan senegaranya Kiromal Katibin dan mencatatan lagi rekor dunia di nomor speed putra di Salt Lake City, 5,208 detik,” bunyi keterangan yang dikutip dari akun instagram @ifscclimbing, Sabtu (29/5).(dok)</p>', '1649428155_00e0f38eb04f08218555.jpg', '2021-05-31', '1', 4, 1, 'Berita', 53, 1, NULL, '', NULL, '0', NULL);
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(10, 'Terinspirasi dari Sang Ibu, Lody Lontoh Jadi Master Aerobik Indonesia', 'terinspirasi-dari-sang-ibu-lody-lontoh-jadi-master-aerobik-indonesia', 'Perjalannannya dimulai saat ia masih berusia anak-anak, tepatnya diusia 7 tahun. Diusia itu ia akrab dengan senam aerobik ini. Lody menyampaikan, ketertarikannya untuk lebih mendalami aerobik berasal dari ibu kandungnya, yang merupakan seorang instruktur senam.\"Saya belajar langsung dari mama, saat masih remaja dan hingga sekarang tetap jadi atlet senam aerobik,\" tutur pemuda kelahiran Jakarta ini.', '  <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Nama Lody Lontoh mungkin sudah tak asing lagi di telinga para penggemar dan pecinta senam aerobik di Indonesia. Ia adalah master aerobiknya Indonesia saat ini. Tapi mungkin tidak semua pecinta olahraga senam ini mengetahui sang master.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Perjalannannya dimulai saat ia masih berusia anak-anak, tepatnya diusia 7 tahun. Diusia itu ia akrab dengan senam aerobik ini. Lody menyampaikan, ketertarikannya untuk lebih mendalami aerobik berasal dari ibu kandungnya, yang merupakan seorang instruktur senam.\"Saya belajar langsung dari mama, saat masih remaja dan hingga sekarang tetap jadi atlet senam aerobik,\" tutur pemuda kelahiran Jakarta ini.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Motivasinya menjadi atlet terbaik mewakili Indonesia di kancah dunia, bahkan sebelum olahraga ini memiliki tempat di hati pecinta aerobik di tanah air. \"Awalnya saya engga mau, tapi mama bilang nanti bisa ikut PON dan SEA Games. Akhirnya, ucapannya seorang ibu adalah doa, dan itu terbukti untuk saya,\" kenangnya.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Pria yang lahir pada 19 Agustus 1980 ini berhasil mewujudkan mimpinya dan berhasil membawa nama harum Indonesia di berbagai pentas kejuaraan aerobik internasional, segudang prestasipun telah berhasil ia raih.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Ia sangat bangga dan bahagia saat Sang Saka Merah-Putih berkibar dan lagu kebangsaan Indonesia Raya berkumandang di negeri orang berkat dirinya dan senam aerobik.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Semangat itulah yang menjadikannya belasan tahun terus menggeluti olahraga rekreasi yang menyehatkan ini. \"Saya hampir tak pernah merasa ada duka selama menekuni senam aerobik ini,\" ujar atlet DKI yang turun pertama kali pada PON tahun 2000 lalu.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Hingga saat ini kiprah sang master terus berlanjut. Hasilnya pemerintah telah mengapresiasinya dengan menjadinya ASN pelatih di Kementerian Pemuda dan Olahraga (Kemenpora RI). \"Bagi saya menjalani profesi sebagai pesenam aerobik adalah masa paling menyenangkan,\" kata dia.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Ia tak pernah berhenti dan terus berupaya berbagi pengalaman untuk lebih mengenalkan senam aerobik ke semua kalangan masyarakat Indonesia dengan menjadi pelatih nasional senam aerobik.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Senam aerobik sendiri bisa diartikan, serangkaian gerakan yang dilakukan beriringan dengan irama musik dalam durasi waktu tertentu. Secara umum, senam aerobik adalah olahraga yang bisa meningkatkan fungsi jantung dan pernapasan. Jadi, senam aerobik sangat bermanfaat untuk kesehatan jantung, otak, paru-paru, tubuh, dan pikiran kita. Senam aerobik juga bisa dilakukan untuk menurunkan berat badan. Hal-hal di atas yang membuat senam aerobik banyak digemari dari berbagai kalangan. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Lody berharap, kegiatan senam ini bisa bermanfaat bagi masyarakat secara luas. “Saya salut dan bangga. Senam benar-benar sangat bermanfaat, apalagi ditengah situasi pandemi. Mari kita tetap berolahraga dan patuhi protokol kesehatan. Sehat selalu semuanya,” jelasnya.(ben)</p>', '1649427751_26586f3cfb36478bd9c1.jpg', '2021-05-31', '1', 5, 1, 'Berita', 85, 0, '1', '', NULL, '0', NULL),
(11, 'Jalani Vaksinasi, Pebulutangkis Melati Oktavianti: Rasanya Seperti Digigit Semut', 'jalani-vaksinasi-pebulutangkis-melati-oktavianti-rasanya-seperti-digigit-semut', 'Melati Daeva Oktavianti menjadi salah satu atlet yang menjalani vaksinasi di Istora Senayan, Jakarta, Jumat (26/2). Pebulutangkis andalan Indonesia ini pun meyakinkan kepada masyarakat secara luas untuk tidak takut divaksin.', '  <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Melati Daeva Oktavianti menjadi salah satu atlet yang menjalani vaksinasi di Istora Senayan, Jakarta, Jumat (26/2). Pebulutangkis andalan Indonesia ini pun meyakinkan kepada masyarakat secara luas untuk tidak takut divaksin. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Proses vaksinasi yang dia lakukan ini berjalan dengan lancar. Tidak ada rasa takut. Melati pun menceritakan pengalamannya usai disuntik vaksin. \"Prosesnya menjalani protokol kesehatan. Terus dicek suhu dan lain-lain. Setelahnya disuntik vaksin. Rasanya ketika divaksin seperti digigit semut,\" kata Melati. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Setelah itu, dia merasakan sedikit pegal usai disuntik. Meski begitu, Melati tidak merasakan sakit sama sekali. Dia pun merasa tambah percaya diri usai divaksin. \"Vaksin ini yang pasti bagus ya. Ini penting untuk mencegah. Jangan takut untuk divaksin. Harapan setelah divaksin tentu tambah percaya diri. Merasa lebih sehat, dan siap untuk bertanding,\" jelas Melati. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Sebelumnya, Wakil Presiden RI Ma\'ruf Amin yang meninjau langsung pelaksanaan vaksinasi Covid-19 kepada atlet, pelatih, hingga tenaga pendukung menyebut, pelaksanaan vaksinasi untuk para atlet ini diprioritaskan bagi mereka yang akan bertanding dalam kompetisi pada level nasional maupun internasional.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Vaksinasi atlet ini penting, termasuk juga prioritas, terutama mereka yang akan mengikuti beberapa event. Maka, mereka harus kita siapkan supaya fisik mereka baik,\" kata Wapres usai peninjauannya. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Sementara itu, Menpora Zainudin Amali menjelaskan vaksinasi bagi atlet, pelatih dan tenaga pendukung ini adalah tahap pertama. Ini merupakan hasil kerja sama Kemenpora, Kemenkes, KONI, pimpinan cabang olahraga, hingga stakeholder terkait lainnya </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Kita berharap kegiatan ini dapat berjalan dengan baik dan lancar. Untuk selanjutnya yang didaerah, tentu akan berkoordinasi dengan dinas kesehatan setempat,\" ujarnya.(jef)</p>', '1649428092_e00c8a5aadb80a30893c.jpg', '2021-05-31', '1', 5, 1, 'Berita', 80, 0, '0', '', NULL, '0', NULL),
(12, 'Raih WTP Untuk Kelima Kalinya, Presiden: Kita Ingin Gunakan Uang Rakyat dengan Baik', 'raih-wtp-untuk-kelima-kalinya-presiden-kita-ingin-gunakan-uang-rakyat-dengan-baik', 'Presiden Joko Widodo menerima Laporan Hasil Pemeriksaan (LHP) atas Laporan Keuangan Pemerintah Pusat (LKPP) tahun 2020 dari Badan Pemeriksa Keuangan (BPK). BPK memberikan opini Wajar Tanpa Pengecualian (WTP). Raihan WTP ini merupakan yang kelima didapat secara berturut-turut.', ' <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Presiden Joko Widodo menerima Laporan Hasil Pemeriksaan (LHP) atas Laporan Keuangan Pemerintah Pusat (LKPP) tahun 2020 dari Badan Pemeriksa Keuangan (BPK). BPK memberikan opini Wajar Tanpa Pengecualian (WTP). Raihan WTP ini merupakan yang kelima didapat secara berturut-turut.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Alhamdulillah opininya wajar tanpa pengecualian. WTP merupakan pencapaian yang baik di tahun yang berat, dan ini WTP yang kelima yang diraih pemerintah berturut-turut sejak tahun 2016,” kata Presiden dalam acara LHP atas LKPP tahun 2020 dan Ikhtisar Hasil Pemeriksaan (IHPS) II tahun 2020, serta penyerahan LHP semester II tahun 2020 di Istana Negara, Jakarta, Jumat (25/6). </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Dalam kesempatan ini, Presiden juga mengapresiasi kinerja BPK dengan berbagai keterbatasan aktivitas dan mobilitas ditengah situasi yang sulit akibat pandemi Covid-19. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Predikat WTP bukanlah tujuan akhir karena kita ingin mempergunakan uang rakyat dengan sebaik-baiknya, dikelola dengan transparan dan akuntabel, kualitas belanja semakin baik, makin tepat sasaran, memastikan setiap rupiah yang dibelanjakan betul-betul dirasakan manfaatnya oleh masyarakat, oleh rakyat,\" jelas Presiden.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Oleh karenanya, Presiden menegaskan bahwa pemerintah akan sangat memperhatikan rekomendasi-rekomendasi BPK dalam mengelola pembiayaan Anggaran Pendapatan dan Belanja Negara (APBN). </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Saya minta kepada para menteri, para kepala lembaga, dan kepala daerah agar semua rekomendasi pemeriksaan BPK segera ditindaklanjuti dan diselesaikan,\" imbuhnya.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Dalam kesempatan yang sama, Presiden juga mengingatkan semua pihak bahwa pandemi Covid-19 belum berakhir seutuhnya. Seluruh lapisan masyarakat diminta harus tetap waspada.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Situasi luar biasa yang dihadapi bangsa harus direspons dengan kebijakan yang cepat dan tepat, yang membutuhkan kesamaan frekuensi oleh semua pihak, baik di semua tataran lembaga negara dan di seluruh jajaran pemerintah pusat sampai pemerintah daerah.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Sejak pandemi muncul di tahun 2020, kita sudah melakukan langkah-langkah extraordinary, termasuk dengan perubahan APBN kita. Refocusing dan realokasi anggaran di seluruh jenjang pemerintahan dan memberi ruang relaksasi defisit APBN dapat diperlebar diatas 3 persen selama tiga tahun,” pungkas Presiden. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Ikut hadir mendampingi Presiden Joko Widodo yaitu, Wakil Presiden K.H. Ma’ruf Amin dan Ketua BPK Agung Firman Sampurna. Sementara hadir secara virtual Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali serta jajaran para menteri di Kabinet Indonesia Maju. (jef)</p>', '1649428033_c1799af41cd8ab447195.jpeg', '2021-06-25', '1', 1, 1, 'Berita', 37, 0, '1', '', NULL, '0', NULL),
(13, 'LKPP 2020 Raih WTP, Ini Harapan Presiden Jokowi kepada Pimpinan Kementerian/Lembaga', 'lkpp-2020-raih-wtp-ini-harapan-presiden-jokowi-kepada-pimpinan-kementerianlembaga', 'Presiden Republik Indonesia Joko Widodo (Jokowi) menyampaikan apresiasi dan penghargaan kepada Badan Pemeriksa Keuangan BPK-RI yang telah memberikan opini Wajar Tanpa Pengecualian (WTP) atas Laporan Keuangan Pemerintah Pusat (LKPP) Tahun 2020', ' <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Presiden Republik Indonesia Joko Widodo (Jokowi) menyampaikan apresiasi dan penghargaan kepada Badan Pemeriksa Keuangan BPK-RI yang telah memberikan opini Wajar Tanpa Pengecualian (WTP) atas Laporan Keuangan Pemerintah Pusat (LKPP) Tahun 2020. BPK menilai LKPP pemerintah telah disajikan secara wajar dalam semua hal yang material sesuai Standar Akuntansi Pemerintahan.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Saya memberikan apresiasi dan penghargaan kepada BPK yang di tengah berbagai keterbatasan aktivitas dan mobilitas di masa pandemi telah melaksanakan pemeriksaan atas LKPP tahun 2020 dengan tepat waktu,” kata Presiden Jokowi dalam sambutannya saat penyerahan LHP LKPP Tahun 2020 dan Ikhtisar Hasil Pemeriksaan Semester (IHPS) II Tahun 2020 dari BPK kepada Presiden Jokowi di Istana Negara, Jumat (25/6) pagi. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">LHP LKPP dan IHPS II Tahun 2020 dihadiri oleh Wakil Presiden Ma’ruf Amin, para menteri koordinator dan pimpinan kementerian termasuk Menteri Pemuda dan Olahraga Zainudin Amali yang hadir secara virtual.“Alhamdulillah opininya adalah Wajar Tanpa Pengecualian (WTP). Ini merupakan pencapaian yang baik di tahun yang berat ini,” tegas Jokowi. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Menurut Presiden Jokowi, WTP yang diraih saat ini merupakan yang ke-5 diraih pemerintah secara berturut-turut sejak tahun 2016. Namun presdien menegaskan bahwa predikat WTP bukanlah tujuan akhir.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Karena kita ingin mempergunakan uang rakyat dengan sebaik-baiknya, dikelola dengan transparan dan akuntabel. Kualitas belanja semakin baik, makin tepat sasaran, memastikan setiap rupiah yang dibelanjakan betul-betul dirasakan manfaatnya oleh masyarakat, oleh rakyat,” harapnya.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Presiden Jokowi memastikan bahwa pemerintah akan sangat memperhatikan rekomendasi-rekomendasi BPK dalam mengelola pembiayaan APBN. Sehingga dengann defisit anggaran saat ini, Presiden berharap menteri dan kepala lembaga memanfaatkan sumber-sumber pembiayaan yang aman dan dilaksanakan secara responsif mendukung kebijakan Counter-cyclical dan akselerasi pemulihan sosial ekonomi secara hati-hati dan terukur.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Kepada para menteri, para kepala lembaga dan kepala daerah agar semua rekomendasi pemeriksaan BPK segera ditindaklanjuti dan diselesaikan,” pinta Presiden Jokowi.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Selain itu, Presiden juga mengingatkan bahwa pandemi belum berakhir dan semua harus tetap waspada. “Situasi yang kita hadapi masih dalam situasi extra ordinary yang harus direspon dengan kebijakan yang cepat dan tepat. Membutuhkan kesamaan frekuensi oleh kita semuanya baik di semua tataran lembaga negara dan di seluruh jajaran pemerintah pusat sampai pemerintah daerah,” ujar Jokowi mengingatkan.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Sebelumnya, Ketua BPK Agung Firman Sampurna menyampaikan bahwa pihaknya memberikan opini Wajar Tanpa Pengecualian (WTP) atas Laporan Keuangan Pemerintah Pusat (LKPP) Tahun 2020.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Menurut Agung Firman, pemberian opini WTP didukung oleh pemeriksaan BPK atas 86 Laporan Keuangan Kementerian/Lembaga (LKKL) dan satu Laporan Keuangan Bendahara Umum Negara (LKBUN), termasuk pemeriksaan pada tingkat Kuasa Pengguna Anggaran BUN dan badan usaha operator belanja subsidi. “84 LKKL dan LKBUN mendapat opini WTP, dan 2 KL mendapat opini Wajar Dengan Pengecualian (WDP),\" kata Agung Firman Sampurna.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Sementara itu, pada pemeriksaan LKPP Tahun 2020, BPK melakukan serangkaian prosedur pemeriksaan terkait pertanggungjawaban pemerintah atas pelaksanaan kebijakan keuangan negara dan langkah-langkah yang diambil pemerintah dalam menangani Covid-19. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Hasil pemeriksaan atas LKPP Tahun 2020 mengungkap antara lain mekanisme pelaporan kebijakan keuangan negara dalam penanganan dampak pandemi Covid-19 pada LKPP belum disusun; realisasi insentif dan fasilitas perpajakan dalam penanganan Covid19 dan Pemulihan Ekonomi Nasional (PC-PEN) Tahun 2020 minimal Rp1,69 triliun tidak sesuai ketentuan; pengendalian pelaksanaan belanja program PC-PEN Rp9 triliun pada 10 K/L belum memadai; serta realisasi pengeluaran pembiayaan tahun 2020 Rp28,75 triliun dalam rangka PC-PEN tidak dilakukan bertahap.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Dalam IHPS II Tahun 2020 yang juga diserahkan oleh BPK pada hari ini, memuat ringkasan dari 559 laporan hasil pemeriksaan (LHP) termasuk hasil pemeriksaan atas PC-PEN.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">\"Pemeriksaan atas PC-PEN merupakan respon BPK yang menunjukkan kepedulian BPK, atau BPK hadir dan berperan aktif dalam mengawal pengelolaan dan tanggung jawab keuangan negara yang transparan, akuntabel, dan efektif,\" jelas Ketua BPK.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">IHPS II Tahun 2020 memuat ringkasan dari 28 LHP Keuangan, 254 LHP Kinerja, dan 277 LHP Dengan Tujuan Tertentu (DTT). Dari LHP Kinerja dan DTT tersebut, sebanyak 241 (43%) LHP merupakan hasil pemeriksaan tematik terkait PC-PEN. Alokasi anggaran PC-PEN pada pemerintah pusat, pemda, BI, OJK, LPS, BUMN, BUMD, dan dana hibah Tahun 2020 yang teridentifikasi oleh BPK sebesar Rp933,33 triliun, dengan realisasi Rp597,06 triliun (64%).</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">BPK mengapresiasi upaya pemerintah dalam PC-PEN seperti pembentukan Gugus Tugas Penanganan Covid-19, penyusunan regulasi, pelaksanaan refocusing kegiatan dan realokasi anggaran, serta kegiatan pengawasan atas pelaksanaan PC-PEN.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Tanpa mengurangi apresiasi atas upaya keras pemerintah itu, BPK menyimpulkan bahwa efektivitas, transparansi, akuntabilitas dan kepatuhan pengelolaan dan tanggung jawab keuangan negara dalam kondisi darurat pandemi covid-19 belum sepenuhnya dapat tercapai. Karena alokasi anggaran dalam APBN belum teridentifikasi dan kodifikasi secara menyeluruh serta realisasi anggaran PC PEN belum sepenuhnya disalurkan sesuai dengan yang direncanakan,” pungkasnya.(ded)</p>', '1649427954_de93dccf8d3260bef391.jpeg', '2021-06-25', '1', 1, 1, 'Berita', 99, 0, '1', '', NULL, '0', NULL),
(14, 'Menpora Amali Hadiri Penyampaian LHP LKPP 2020 Secara Virtual', 'menpora-amali-hadiri-penyampaian-lhp-lkpp-2020-secara-virtual', ' Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali menghadiri Laporan Hasil Pemeriksaan atas Laporan Keuangan Pemerintah Pusat (LHP LKPP) dan Ikhtisar Hasil Pemeriksaan Pusat (IHPS) II serta penyerahan LHP Semester II Tahun 2020 secara virtual dari Kantor Kemenpora', ' <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali menghadiri Laporan Hasil Pemeriksaan atas Laporan Keuangan Pemerintah Pusat (LHP LKPP) dan Ikhtisar Hasil Pemeriksaan Pusat (IHPS) II serta penyerahan LHP Semester II Tahun 2020 secara virtual dari Kantor Kemenpora, Jumat (25/6). Laporan ini dibacakan oleh Ketua Badan Pemeriksa Keuangan (BPK) Agung Firman Sampurna. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Agung menyampaikan,  LHP LKPP dan IHPS II 2020 dilaksanakan dengan semangat akuntabilitas untuk semua. Semangat ini dilandaskan pada komitmen untuk melaksanakan segala sesuatunya dengan cara-cara yang dapat dipertanggung jawabkan. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Kami apresiasi dan terima kasih yang sebesar-besarnya kepada presiden, wakil presiden, para pimpinan kementerian/lembaga serta seluruh jajaran atas kerja samanya sehingga pemeriksaan atas pertanggung jawaban pelaksanaan APBN dapat terlaksana dengan baik. Kami juga mohon maaf apabila dalam pemeriksaan ada hal-hal yang kurang berkenan,” katanya. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Setelah itu, Presiden Joko Widodo memberikan pengarahan langsung dari Istana Negara, Kompleks Istana Kepresidenan, Jakarta. Dalam sambutannya, Presiden mengatakan, pemerintah tetap berkomitmen untuk mempertahankan dan meningkatkan kualitas LKPP. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Alhamdulillah opininya wajar tanpa pengecualian (WTP). WTP merupakan pencapaian yang baik di tahun yang berat dan ini WTP yang ke lima yang diraih pemerintah berturut turut. Saya memberikan apresiasi dan penghargaan kepada BPK yang ditengah keterbatasan aktivitas dan mobilitas ditengah pandemi telah melaksanaan pemeriksaan atas LKPP tahun 2020 dengan tepat waktu,” ujar Presiden. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Kepala Negara menerangkan, raihan WTP bukanlah tujuan akhir, karena pemerintah ingin mempergunakan uang rakyat dengan sebaik-baiknya, dikelola dengan transaparan, makin tepat sasaran, serta memastikan setiap rupiah yang dibelanjakan betul-betul dirasakan manfaatnya oleh masyarakat. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Karena itu pemerintah sangat memperhatikan rekomendasi-rekomendasi BPK dalam pengelolaan pembiayaan APBN. Saya minta kepada para menteri, para kepala lembaga, dan kepala daerah agar semua rekomendasi pemeriksaan BPK segera ditindak lanjuti dan diselesaikan,” pesan Presiden. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Dalam kesempatan ini, Presiden Joko Widodo mengingatkan semua pihak bahwa pandemi Covid-19 belum berakhir seutuhnya. Seluruh lapisan masyarakat diminta harus tetap waspada. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Saya ingin mengingatkan kita semuanya bahwa pandemi belum berakhir, kita harus tetap waspada dan situasi yang kita hadapi masih dalam situasi extraordinary,” terang Presiden. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Untuk itu, Presiden menekankan agar situasi ini harus direspons dengan kebijakan yang cepat dan tepat. Diperlukan adanya kesamaan frekuensi, baik disemua lembaga negara, jajaran pemerintah pusat sampai pemerintah daerah. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Sejak pandemi muncul, kita sudah melakukan langkah-langkah extraordinary termasuk dengan perubahan APBN kita. Refocusing dan realokasi anggaran diseluruh jenjang pemerintahan dan memberi ruang relaksasi APBN dapat diperlebar diatas 3 persen selama tiga tahun,” tegas Presiden. (jef)</p>', '1649428562_63cd1f00021540e3b0eb.jpeg', '2021-06-25', '1', 1, 1, 'Berita', 158, 0, '1', '', NULL, '0', NULL),
(15, 'Buka Peluang Ekonomi Kreatif dengan Infrastuktur dan Talenta Digital', 'buka-peluang-ekonomi-kreatif-dengan-infrastuktur-dan-talenta-digital', ' Kepala Badan Riset dan Inovasi Nasional LT. Handoko menilai kehadiran infrastruktur 5G dapat membuka peluang ekonomi kreatif berbasis inovasi digital. Menurutnya hal itu bisa diwujudkan dengan memperkuat infrastruktur dan talenta digital.', '  <p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Jakarta, Kominfo - Kepala Badan Riset dan Inovasi Nasional LT. Handoko menilai kehadiran infrastruktur 5G dapat membuka peluang ekonomi kreatif berbasis inovasi digital. Menurutnya hal itu bisa diwujudkan dengan memperkuat infrastruktur dan talenta digital.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">“Ekonomi kreatif merupakan proses nilai tambah bersumber dari kreativitas individu yang memiliki pengetahuan, teknologi dan seni-budaya sebagai penghasil barang, jasa, atau karya seni. Jadi, dalam mengantisipasi tantangan dari persaingan ekonomi kreatif yang mengglobal perlu kiranya disiapkan sejumlah strategi. Selain penguatan infrastruktur digital, yang tidak kalah penting adalah penguatan di sisi SDM talenta digital,” ungkapnya dalam Webinar “5G dan Peran Insinyur Elektro dalam Pengembangan Transformasi Digital Indonesia”, dari Jakarta, Sabtu (26/06/2021).</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Kepala BRIN menyatakan dalam era ekonomi digital terdapat banyak peluang bisa dihasilkan dan ada sejumlah tantangan yang harus dituntaskan bersama oleh seluruh pemangku kepentingan.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">“Beberapa hal yang harus diperhatikan, yaitu; penggunaan sumber daya yang lebih efisien, mendorong transparansi finansial, meningkatkan kesejahteraan masyarakat, dan mendorong adanya jejak digital (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">digital footprint</em>),” paparnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Meski demikian, menurut Handoko ekonomi digital dan teknologi digital bukan merupakan tujuan melainkan perubahan perilaku dan efisiensi proses bisnis yang diharapkan memberikan manfaat besar bagi masyarakat serta pelaku usaha.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\">Oleh karena itu, Kepala BRIN mengingatkan di dalam era ekonomi digital semua orang akan memiliki kesempatan yang lebih merata dalam perannya terlibat dalam perekonomian. “idak seperti di era ekonomi konvensional. Ekonomi digital dan inovasi digital membuka peluang bagi penciptaan dan juga peningkatan ekonomi kreatif Indonesia secara besar-besaran,” jelasnya.</p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Salah satu yang disiapkan pemerintah, menurut Handoko dengan memperkuat industri TIK dalam negeri serta adopsi teknologi mutakhir seperti <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Artificial Intelligence</em> (AI), <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Big Data Analytics</em>, dan <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Internet of Things</em> (IoT). Hal tersebut dilakukan melalui penyelenggaraan tata kelola SDM unggul sehingga inovasi digital dan ekonomi kreatif dapat terus bertumbuh.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">“Inovasi digital harus terus berjalan paralel seiring perkembangan hadirnya layanan 5G di Indonesia agar use case 5G dapat bernilai manfaat maksimal khususnya bagi masyarakat dan bangsa Indonesia,” tutur Kepala BRIN.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Webinar yang diselenggarakan Persatuan Insinyur Indonesia) dan IEEE (<em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Institute of Electrical and Electronics Engineers)</em> Indonesia <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Section</em> khususnya bidang <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Government Relation Chapter</em>, diharapkan dapat menjadi wadah bagi para akademisi untuk bersinergi dalam membangun solusi teknologi berbasis 5G.</span></p><p style=\"margin-right: 0px; margin-bottom: -15px; margin-left: 0px; padding: 1em 0px; border: 0px; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: \"Open Sans\", sans-serif; vertical-align: baseline; text-size-adjust: none; position: relative; color: rgb(51, 51, 51) !important;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none;\">Selain Kepala Badan Riset dan Inovasi Nasional, LT. Handoko, hadir sebagai pembicara antara lain Dirjen SDPPI Kominfo, Ismail; Dirjen Ilmate (Industri Logam, Mesin, Alat Transportasi dan Elektronika) Kementerian Perindustrian, Taufiek Bawazier. Hadir pula perwakilan ekosistem 5G antara lain dari Telkomsel, PT. Tata Sarana Mandiri (TSM); ShintaVR; Asosiasi Internet of Things Indonesia (ASIOTI); serta <em style=\"margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">Schneider Electric</em>.(hm.ys)</span></p>', '1649428629_ebe3cbb1ca13030c101c.jpeg', '2021-06-28', '1', 1, 1, 'Berita', 302, 0, '0', ' ', NULL, '1', NULL);
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(16, 'Lantik Karo Perencanaan dan Organisasi, Ini Pesan Menpora Amali', 'lantik-karo-perencanaan-dan-organisasi-ini-pesan-menpora-amali', ' Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali melantik Kepala Biro (Karo) Perencanaan dan Organisasi Kemenpora, Sri Wahyuni secara virtual dari Kemenpora, Jumat (16/7). Sejumlah pesan dan harapan disampaikan Menpora Amali agar kinerja Kemenpora terus baik dalam pelantikan yang berjalan khidmat ini.', '        <p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Jakarta: Menteri Pemuda dan Olahraga Republik Indonesia (Menpora RI) Zainudin Amali melantik Kepala Biro (Karo) Perencanaan dan Organisasi Kemenpora, Sri Wahyuni secara virtual dari Kemenpora, Jumat (16/7). Sejumlah pesan dan harapan disampaikan Menpora Amali agar kinerja Kemenpora terus baik dalam pelantikan yang berjalan khidmat ini. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Hari ini saya secara resmi melantik saudari dalam jabatan baru. Saya percaya saudari mampu melaksanakan tugas dengan baik dan sesuai tanggung jawab yang diberikan. Suasana ini mengharuskan kita melakukan kegiatan dengan baru. Ada yang hadir langsung di Wisma Kemenpora dan saya hadir virtual dari Lantai 10 Kemenpora,” kata Menpora Amali. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Menpora Amali mengatakan, pelantikan merupakan hal yang biasa dan lumrah pada lingkungan birokrasi. Kemudian, Menpora Amali meminta agar Sri Wahyuni dapat segera beradaptasi dan konsentrasi dalam menjalankan tugasnya. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Ada program prioritas, saya minta betul perencanaan dan pelaksanaannya dilakukan dengan baik. Segera koordinasi dengan pimpinan satuan kerja yang ada. Tidak boleh perencanaan merencanakan sendiri tanpa diskusi dengan pimpinan satuan kerja, begitu juga sebaliknya,” ujarnya. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Lebih lanjut, Menpora Amali yakin Sri Wahyuni mampu mengemban tugas baru ini. Melihat kemampuannya, Menpora Amali yakin dan berharap hal yang baik telah dicapai bisa ditingkatkan. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">“Kalau lihat pengalamannya, cukup lumayan daya tahan fisiknya. Jaga terus kesehatannya. Sekali lagi selamat kepada Bu Sri Wahyuni atas amanah ini. Mudah-mudahan kerja di Kemenpora dapat terus baik dan optimal,” jelas Menpora Amali. </p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 16px; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Hadir sebagai saksi dalam pelantikan yaitu Sesmenpora Gatot S. Dewa Broto dan Deputi Pengembangan Pemuda Kemenpora Asrorun Ni’am Sholeh. Seperti diketahui, Sri Wahyuni sebelumnya menjabat sebagai Asisten Deputi Industri dan Promosi Olahraga pada Deputi Bidang Peningkatan Prestasi Olahraga.(jef)</p>', '1649427829_79b53cb35750dfca57cd.jpg', '2021-07-17', '1', 1, 1, 'Berita', 449, 3, '1', 'Pelantikan Karo Perencanaan', NULL, '0', NULL),
(17, 'Pengaruh Kemajuan Teknologi Komunikasi dan Informasi Terhadap Karakter Anak', 'pengaruh-kemajuan-teknologi-komunikasi-dan-informasi-terhadap-karakter-anak', '            Kehidupan manusia yang bermula dari kesederhanaan kini menjadi kehidupan yang bisa dikategorikan sangat modern. Di jaman yang semakin canggihnya teknologi informasi dan komunikasi yang berkembang  saat sekarang, segala sesuatu dapat diselesaikan dengan cara-cara yang praktis.', '             <p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Kehidupan manusia yang bermula dari kesederhanaan kini menjadi kehidupan yang bisa dikategorikan sangat modern. Di jaman yang semakin canggihnya teknologi informasi dan komunikasi yang berkembang &nbsp;saat sekarang, segala sesuatu dapat diselesaikan dengan cara-cara yang praktis. Teknologi informasi dan komunikasi adalah sesuatu yang bermanfaat untuk mempermudah semua aspek kehidupan manusia. Dunia informasi saat ini seakan tidak bisa terlepas dari teknologi. Penggunaan teknologi informasi dan komunikasi oleh masyarakat menjadikan dunia teknologi semakin lama semakin canggih.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Dunia informasi saat ini seakan tidak bisa terlepas dari teknologi. Penggunaan teknologi oleh masyarakat menjadikan dunia teknologi semakin lama semakin canggih. Komunikasi yang dulunya memerlukan waktu yang lama dalam penyampaiannya, kini dengan teknologi segalanya menjadi sangat cepat dan seakan tanpa jarak.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Dengan kemajuan teknologi yang begitu pesat ini, pepatah yang menyatakan bahwa“Dunia tak selebar daun kelor” sepantasnya berubah menjadi “Dunia seakan selebar daun kelor”. Hal ini disebabkan karena semakin cepatnya akses informasi dalam kehidupan sehari-hari. Kita bisa mengetahui peristiwa yang sedang terjadi di daerah lain atau bahkan di negara lain, misalnya Amerika Serikat walaupun kita berada di Indonesia.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Salah satunya dalam bidang teknologi komunikasi seperti adanya smartphone dan internet, membuat manusia semakin meningkatkan cara komunikasinya. Berbagai macam media untuk berkomunikasi pun hadir untuk memudahkan manusia berinteraksi. Seiring dengan perkembangan zaman, teknologi internet sudah menjadi kebutuhan bagi masyarakat, hal inilah yang melahirkan media sosial. Media sosial merupakan media online, yaitu media yang hanya ada dengan menggunakan internet dimana para penggunanya bisa menuangkan ide, mengekspresikan diri, dan menggunakan sesuai dengan kebutuhannya. Kehadiran media sosial memberikan kemudahan bagi manusia untuk berkomunikasi dan bersosialisasi.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Menurut penelitian Center of Innovation Policy and Governance (CIPG) yang dirilis pekan lalu, saat ini laju penetrasi internet Indonesia merupakan yang tertinggi di Asia yang kini sudah mencapai 51%.&nbsp;Angka yang lebih fenomenal terlihat dari jumlah pengguna seluler. Di tahun 2016, diprediksi ada sekitar 371,4 juta nomor seluler yang aktif di Indonesia. Jumlah tersebut bahkan lebih besar dari pada proyeksi jumlah penduduk Indonesia yakni 261,89 juta penduduk.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Salah satu aplikasi di media sosial yang saat ini sedang booming dikalangan anak-anak, remaja bahkan orang dewasa yaitu&nbsp;</span><a href=\"https://www.kompasiana.com/tag/tiktok\" style=\"box-sizing: inherit;\">TikTok</a><span style=\"font-size: 16px;\">. TikTok adalah aplikasi buatan dari negeri Tirai Bambu lebih tepatnya Tiongkok, aplikasi yang platformnya khusus video, musik dan Foto, spesifik pada perusahaan ByteDance. Ketenaran dari Tik Tok sendiri telah terbukti dengan bergabung Rich Chigga dalam acara Official Warm Up Party yang diadakan dalam rangka Djakarta Warehouse Project (DWP) ditahun sebelumnya, dengan jumlah penonton yang luar biasa.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Aplikasi ini hampir dengan aplikasi lain, layaknya Musical.ly, Selain itu, bukti boomingnya aplikasi tiktok dilihat dari nilai reviewnya yang sangat tinggi di Play Store maupun App Store yaitu 4,6. Rating yang hampir sempurna, memadukan Artificial Intelligence dan Image Capture. di Google Play atau Play Store rata-rata yang mengomentari aplikasi tiktok ini adalah kaum hawa dan remaja-remaja di bawah umur.</span></font></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Dari penjelasan di atas,saya tidak akan membahas mengenai fitur yang terdapat dalam aplikasi tiktok sendiri, tapi saya akan membahas dampak- dampak yang di hasilkan dari aplikasi tiktok kepada remaja, khusunya dampak teknologi informasi dan komunikasi dari segi positif maupun segi negatif . Dari segi positif sendiri aplikasi tiktok memiliki beberapa manfaat untuk remaja salah satunya yaitu:</span></font></p><ol style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.75em; margin-left: 24px; padding: 0px; list-style-position: initial; list-style-image: initial; font-size: 15px;\"><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Sebagai salah satu aplikasi yang dapat mendorong kreativitas seseroang dalam membuat suatu karya.</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Aplikasi untuk mengekspresikan kreativitas khusunya dalam pembuatan video, Aplikasi Tik Tok sendiri merupakan platform untuk membuat video dengan efek spesial dan unik dengan mudah. Tik Tok juga menyuguhkan berbagai macam musik untuk latar video, sehingga penggunanya dapat menciptakan video yang lebih menarik.</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Aplikasi tiktok ini juga berbasis video dan musik, dan dapat melati diri remaja atau anak anak untuk mengasah skill editing video, untuk konten-konten yang lebih bermanfaat.</span></font></li></ol><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Tetapi dari beberapa point positif dari tik tok sendiri, terdapat banyak dampak negatif untuk remaja, sudah banyak artikel yang membahas tentang dampak negatif dari tiktok sendiri sampai kominfo harus memblokir aplikasi tiktok di indonesia, salah satunya segi negatif dari tiktok sendiri adalah</span></font></p><ol style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 1.75em; margin-left: 24px; padding: 0px; list-style-position: initial; list-style-image: initial; font-size: 15px;\"><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Secara tidak langsung, tiktok menjadi penyebab generasi remaja untuk suka bergoyang ria, Apabila anda termasuk seseorang yang sering aktif di Instagram, pastinya anda akan menjumpai beberapa netizen dengan berbagai video yang dibuat dengan menggunakan aplikasi tiktok ini. Ada yang biasa saja, dan ada yang Luar Biasa, luar biasa keterlaluan. Bahkan ada beberapa remaja dan anak-anak bergoyang ria yang tidak wajar.&nbsp;</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Membuat video yang tidak sewajarnya, bahkan tidak hanya remaja saja mereka melibatkan anak-anak kecil dalam pembuatan video tiktok demi respon yang banyak dari netizen , berani bernyanyi lagu dan berakting orang dewasa.&nbsp;</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Apabila ini dianggap sebagai media hiburan, maka Youtube lebih baik. Memang benar, tujuan aplikasi ini plure untuk hiburan, tapi hiburan yang berlebihan juga tidaklah benar. Kita mungkin sudah akrab dengan berbagai berita viral, yang mengheboh alias miris melibatkan aplikasi ini. Sebenarnya kita dapat mengasah kemampuan menjadi video creator langsung dengan aplikasi-aplikasi yang lebih memadai</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Terdapat banyak video yang tidak pantas menjadi contoh yang tidak baik bagi perilaku remaja dan anak jaman sekarang. Mungkin kita juga sudah sama-sama tahu banyaknya video dengan aksi-aksi yang tidak pantas dilakukan penggunanya yang meleceng kepada penistaan agama seperti membuat video berjoged bersama saat melaksanakan sholat. Ironisnya banyak akun yang mengunggah video sejenis tanpa mereka bisa menyadari bahwa video yang mereka tiru itu bukanlah hal yang pantas untuk di tiru yang dapat membuat kenakalan anak jaman sekarang&nbsp;semakin beragam. Dalam hal ini diperlukan peran keluarga dan peran orang tua dalam mendidik anak-anaknya dengan memberikan pengarahan pada anak yang kecanduan tik tok. Belum lagi adanya kasus-kasus lain yang memberikan dampak negatif&nbsp;pada penggunanya karena melakukan aksi yang kurang baik yang pada akhirnya merugikan diri sendiri.</span></font></li><li style=\"box-sizing: inherit; line-height: 1.8;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">Seseorang menjadi terlalu kreatif demi video yang lucu dan menarik sehingga tidak mampu menilai mana yang pantas dan mana yang tidak. Banyak remaja yang memang kreatif dalam membuat video agar bisa mendapat banyak respon dari orang lain. Tapi mereka menjadi seperti tidak berpikir dahulu sebelum merekam apa yang mereka lakukan. Mungkin mereka hanya berpikir bagaimana cara membuat video yang ok, bagus, menarik dan banyak respon dari penonton tanpa peduli dengan apa yang mereka tampilkan itu baik atau buruk untuk orang lain maupun dirinya sendiri.</span></font></li></ol><p style=\"box-sizing: inherit; line-height: 1.8;\"><span style=\"color: rgb(0, 0, 0); font-size: 16px;\">Dari penjelasan di atas kita sudah membahas tentang dampak positif maupun negatif dari aplikasi yang sedang fenomena di indonesia ini yaitu tiktok, meskipun masyarakat berpikir lebih banyak sisi negatifnya dibandingnya positif, tapi kita tidak bisa menyalahkan perkembangan dari teknologi ini. Kembali lagi kepada diri kita sendiri untuk menggunakan teknologi lebih baik dan bijak serta arahan dari orang tua sangatlah amat penting bagi remaja jaman sekarang ini serta penanaman pendidikan agama dan karakter yang baik agar generasi muda Indonesia menjadi generasi yang cerdas dan sehat serta memiliki karakter yang baik</span><font color=\"#000000\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"line-height: 1.8;\"></p><p style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; font-size: 15px; line-height: 1.8;\"></p><p style=\"line-height: 1.8;\"></p><p style=\"box-sizing: inherit; margin: 0px 0px 20px; font-family: Roboto, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; line-height: 1.6;\"><font color=\"#000000\"><span style=\"font-size: 16px;\">.</span></font></p>', '1690274601_e67e70d3ccacdc0c476b.png', '2021-07-19', '1', 2, 1, 'Berita', 639, 0, '1', 'Pengaruh Kemajuan Teknologi Komunikasi dan Informasi Terhadap Karakter Anak', NULL, '1', '0'),
(18, 'Syarat dan Kondisi', 'syarat-dan-kondisi', NULL, '  <h3 style=\"margin-top: 0px; margin-bottom: 15px; font-weight: inherit; line-height: inherit; font-size: 16px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\">Portal Dinas Kepemudaan, Olahraga dan Kebudayaan&nbsp;</h3><h3 style=\"margin-top: 0px; margin-bottom: 15px; font-weight: inherit; line-height: inherit; font-size: 16px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: OpenSansReg, Arial, Helvetica, sans-serif; vertical-align: baseline; color: rgb(45, 45, 45);\"><p style=\"margin-right: 0px; margin-bottom: 6px; margin-left: 0px; line-height: 1.5em; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; vertical-align: baseline;\">Dengan menggunakan portal ini, maka anda telah mengerti dan menyetujui seluruh syarat dan kondisi yang berlaku dalam penggunaan Portal&nbsp;<span style=\"font-size: 16px; font-weight: inherit;\">Dinas Kepemudaan, Olahraga dan Kebudayaan, sebagaimana tercantum di bawah ini:</span></p><ul style=\"margin: 10px 15px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; vertical-align: baseline; list-style-position: initial; list-style-image: initial;\"><li style=\"margin: 0px 0px 7px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">Informasi yang diperoleh atau di-download oleh pengguna akan dipergunakan oleh sang pengguna secara bertanggung-jawab. Pengutipan atas sebagian atau seluruh isi portal ini diijinkan dengan menyebutkan sumber-sumber secara lengkap.</li><li style=\"margin: 0px 0px 7px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">Situs web ini dimaksudkan semata-mata untuk keperluan komunikasi publik, serta mendukung penyampaian informasi Dinas Pemuda dan Olahraga. Tidak ada satu bagian pun dalam portal ini yang bertujuan promosi atau merekomendasikan suatu kegiatan dari lembaga atau perorangan lain, kecuali jika kegiatan tersebut berhubungan dengan pelaksanaan tugas Menteri Pemuda dan Olahraga Republik Indonesia.</li><li style=\"margin: 0px 0px 7px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">Setiap isi portal ini dikelola dan diperbaharui oleh Dinas Kepemudaan, Olahraga dan Kebudayaan, atas nama Dinas Pemuda dan Olahraga Kabupaten Lembata. Untuk itu, Dinas Pemuda dan Olahraga Republik Indonesia adalah satu-satunya lembaga yang memiliki hak penuh untuk menambah, mengubah dan mengurangi materi web site sewaktu-waktu sesuai dengan kebutuhan.</li><li style=\"margin: 0px 0px 7px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">Dinas Pemuda dan Olahraga tidak bertanggung-jawab atas materi situs web lembaga-lembaga lain yang di-<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">link</span>&nbsp;oleh Portal kami.&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Link</span>&nbsp;tersebut hanya disediakan untuk mempermudah pengguna memperoleh tambahan informasi dari lembaga-lembaga lain yang punya kaitan dengan dinas kami.</li></ul><p style=\"margin-right: 0px; margin-bottom: 6px; margin-left: 0px; line-height: 1.5em; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; vertical-align: baseline;\">Jika anda ingin menyampaikan pertanyaan, kritik, saran dan masukan lainnya agar menghubungi</p><p style=\"margin-right: 0px; margin-bottom: 6px; margin-left: 0px; line-height: 1.5em; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; vertical-align: baseline;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">kami di&nbsp;</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\"><span style=\"font-weight: bolder;\">form&nbsp;</span></span><span style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\"><span style=\"font-weight: bolder;\">Kritik Saran</span></span><span style=\"margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline;\">&nbsp;yang telah disediakan di Portal kami.&nbsp;</span></p></h3>', 'default.png', '2021-07-28', '1', 0, 1, 'Halaman', 53, 0, NULL, NULL, NULL, '0', NULL),
(19, 'Redaksi', 'redaksi', NULL, '    <main class=\"maincontent\" style=\"margin-right: 20px; width: 860px; min-width: 0px;\"><div class=\"widsection\" style=\"margin: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\"><div class=\"gen-section\" style=\"font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;\"><div class=\"gen-content\" style=\"margin: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5; font-family: inherit; vertical-align: baseline;\"><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">Portal Dinas Pemuda dan Olahraga ini dikelola oleh&nbsp;</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><strong style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">Dinas Pemuda dan Olahraga Kabupaten Lembata.</strong></p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">&nbsp;</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><strong style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">Penanggung Jawab</strong></p><p style=\"margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><i>Kepala Dinas</i><span style=\"font-style: inherit;\"> : Domi Juang, S.H.</span></p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">&nbsp;</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><strong style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">Penasehat Redaksi</strong></p><p style=\"margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><span style=\"font-style: inherit;\">- </span><i>Sekertaris</i><span style=\"font-style: inherit;\">&nbsp;: Desi Gili</span></p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Staf Khusus Bidang Pengembangan dan Prestasi Olahraga</span>&nbsp;: Vian Taum</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Kepala Biro Humas dan Hukum</span>&nbsp;: Deril Taum</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">&nbsp;</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\"><strong style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: bold; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">Dewan Redaksi</strong><br>-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Pemimpin Redaksi</span>&nbsp;: Erel</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Wakil Pimpinan Redaksi</span>&nbsp;: Devi</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Redaktur Pelaksana</span>&nbsp;: Vania</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Reporter</span>&nbsp;: Ega, Hosea, Renata</p><p style=\"font-style: inherit; margin-right: 0px; margin-bottom: 6px; margin-left: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: 1.5em; font-family: inherit; vertical-align: baseline;\">-&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: oblique; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Fotografer</span>&nbsp;: Blakataduk, Kim Kom</p></div></div></div></main>', 'default.png', '2021-07-31', '1', 0, 1, 'Halaman', 32, 0, NULL, '', '', '0', NULL),
(21, 'Rencana Strategis', 'rencana-strategis', NULL, '                <p style=\"text-align: center;\"><b>RENCANA STRATEGIS DINAS TAHUN 2019 - 2022</b></p><p style=\"text-align: left;\"><span arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:in\"=\"\" style=\"font-size: 12pt;\">Contoh halaman yang disematkan dengan file pdf.</span><br></p><p class=\"MsoListParagraph\" style=\"margin-bottom: 0.0001pt; text-indent: -18pt; line-height: 18.9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 25px;\"><!--[if !supportLists]--><span style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" arial;color:#333333;mso-fareast-language:in\"=\"\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp; </span></span><!--[endif]--><b><span style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:in\"=\"\">Langkah 1 : Tambahkan halaman seperti biasa. </span></b><span style=\"font-size: 12pt;\">Silahkan masukan&nbsp; judul dan isi seperti biasa, dan simpan halaman.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"margin-bottom: 0.0001pt; text-indent: -18pt; line-height: 18.9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 25px;\"><!--[if !supportLists]--><span style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" arial;color:#333333;mso-fareast-language:in\"=\"\">2.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: \" times=\"\" new=\"\" roman\";\"=\"\">&nbsp;&nbsp; </span></span><!--[endif]--><b><span style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:in\"=\"\">Langkah </span></b><b><span lang=\"EN-US\" style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-ansi-language:en-us;mso-fareast-language:=\"\" in\"=\"\">2</span></b><b><span style=\"font-size:13.5pt;font-family:\" arial\",\"sans-serif\";=\"\" mso-fareast-font-family:\"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:=\"\" in\"=\"\"> : Sematkan file pdf pada judul halaman dengan icon putih.</span></b></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom: 0.0001pt; line-height: 18.9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 25px;\"><span style=\"font-size:12.0pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:in\"=\"\">Pada halaman yang hendak disematkan klik disamping judul untuk menambahkan file PDF.</span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-bottom: 0.0001pt; line-height: 18.9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-left: 25px;\"><span style=\"font-size:12.0pt;font-family:\" arial\",\"sans-serif\";mso-fareast-font-family:=\"\" \"times=\"\" new=\"\" roman\";color:#333333;mso-fareast-language:in\"=\"\"><br></span></p><p style=\"margin-left: 25px;\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<span style=\"font-size:12.0pt;line-height:115%;font-family:\" arial\",\"sans-serif\";=\"\" mso-fareast-font-family:\"times=\"\" new=\"\" roman\";color:#333333;mso-ansi-language:in;=\"\" mso-fareast-language:in;mso-bidi-language:ar-sa\"=\"\">Halaman yang berhasil disematkan file PDF, iconnya akan berubah menjadi file pdf.</span></p>', 'default.png', '2021-08-18', '1', 0, 1, 'Halaman', 173, 0, NULL, '', '1630684760_0cedb3658bbf674bc524.pdf', '0', NULL);
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(28, 'Soroti Tubuh Politik Bupati Sunur, Ini Yang DiKatakan Aktivis ARBL', 'soroti-tubuh-politik-bupati-sunur-ini-yang-dikatakan-aktivis-arbl', 'Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque arcu leo, facilisis in fringilla id, luctus in tortor. Nunc vestibulum est quis orci varius viverra. Curabitur dictum volutpat massa vulputate molestie. In at felis ac velit maximus convallis.', '                 <h4 class=\"mt-0 font-16\"><b>This Week\'s Top Stories</b></h4><p>Dear Lorem Ipsum,</p><p>Praesent dui ex, dapibus eget mauris ut, finibus vestibulum enim. Quisque arcu leo, facilisis in fringilla id, luctus in tortor. Nunc vestibulum est quis orci varius viverra. Curabitur dictum volutpat massa vulputate molestie. In at felis ac velit maximus convallis.</p><p>Berguna jika Anda perlu melakukan operasi tambahan atau logika spesifik, sed porttitor eros commodo. Nam eu venenatis tortor, id lacinia diam. Sed aliquam in dui et porta. Sed bibendum orci non tincidunt ultrices. Vivamus fringilla, mi lacinia dapibus condimentum, ipsum urna lacinia lacus, vel tincidunt mi nibh sit amet lorem.</p><p>Sincerly, berikut kodenya:</p><p></p><pre class=\"prettyprint\"><p></p><p>&lt;style&gt;\r\n          .pointer {\r\n              cursor: pointer;\r\n          }\r\n      &lt;/style&gt;</p><p>&lt;div class=\"modal-body\"&gt;\r\n                &lt;div class=\"form-group row\"&gt;\r\n                    &lt;img id=\'img_load\' width=\'100%\' src=\'&lt;?= base_url(\'public/img/galeri/foto/\' . $gambar) ?&gt;\'&gt;\r\n                &lt;/div&gt;\r\n                &lt;table class=\"table table-bordered table-hover table-striped\"&gt;\r\n                    &lt;tbody&gt;\r\n                        &lt;tr&gt;\r\n                            &lt;td colspan=\"2\"&gt;&lt;strong&gt;&lt;?= $kategorifoto ?&gt; | &lt;?= $judul ?&gt;&lt;/strong&gt;&lt;/td&gt;\r\n                        &lt;/tr&gt;\r\n                    &lt;/tbody&gt;\r\n                &lt;/table&gt;\r\n            &lt;/div&gt;<br></p><p></p></pre><p></p><div class=\"line number1 index0 alt2\" style=\"font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\"><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\">&lt;</code><code class=\"html keyword\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-weight: 700 !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 102,=\"\" 153)=\"\" !important;\"=\"\">pre</code> <code class=\"html color1\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" grey=\"\" !important;\"=\"\">class</code><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\">=</code><code class=\"html string\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 255)=\"\" !important;\"=\"\">\"prettyprint\"</code><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\">&gt;</code></div><div class=\"line number1 index0 alt2\" style=\"font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\"><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\"><br></code></div><div class=\"line number2 index1 alt1\" style=\"font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\"><div class=\"line number2 index1 alt1\" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\"><style></div><div class=\"line number2 index1 alt1\" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\">          .pointer {</div><div class=\"line number2 index1 alt1\" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\">              cursor: pointer;</div><div class=\"line number2 index1 alt1\" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\">          }</div><div class=\"line number2 index1 alt1\" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\">      </style></div></div><div class=\"line number3 index2 alt2\" style=\"font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace;=\"\" font-size:=\"\" 14px;=\"\" color:=\"\" rgb(137,=\"\" 137,=\"\" 140);=\"\" box-sizing:=\"\" content-box=\"\" !important;=\"\" border-radius:=\"\" 0px=\"\" background:=\"\" none=\"\" rgb(245,=\"\" 247,=\"\" 248)=\"\" border:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" line-height:=\"\" normal=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" padding:=\"\" 1em=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" font-variant-numeric:=\"\" font-variant-east-asian:=\"\" font-stretch:=\"\" white-space:=\"\" pre=\"\" !important;\"=\"\"><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\"><!--</code--><code class=\"html keyword\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-weight: 700 !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 102,=\"\" 153)=\"\" !important;\"=\"\">pre</code><code class=\"html plain\" style=\"box-sizing: content-box !important; font-variant-numeric: normal !important; font-variant-east-asian: normal !important; font-stretch: normal !important; font-size: 14px !important; line-height: normal !important; font-family: \" source=\"\" code=\"\" pro\",=\"\" monaco,=\"\" monospace=\"\" !important;=\"\" border:=\"\" 0px=\"\" padding:=\"\" 5px=\"\" background:=\"\" none=\"\" border-radius:=\"\" inset:=\"\" auto=\"\" float:=\"\" height:=\"\" margin:=\"\" outline:=\"\" overflow:=\"\" visible=\"\" position:=\"\" static=\"\" vertical-align:=\"\" baseline=\"\" width:=\"\" min-height:=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0)=\"\" !important;\"=\"\">&gt;</code></code></div>', '1649378212_1331633ba5612595f0b6.png', '2021-12-04', '1', 1, 1, 'Berita', 572, 1, '1', 'Kunjungan Mentri Kominfo', NULL, '1', '0');
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(29, 'Pemerintah Terbitkan Perpres tentang Stranas Percepatan Pembangunan Daerah Tertinggal', 'pemerintah-terbitkan-perpres-tentang-stranas-percepatan-pembangunan-daerah-tertinggal', '    “Strategi Nasional Percepatan Pembangunan Daerah Tertinggal yang selanjutnya disingkat Stranas-PPDT adalah dokumen perencanaan pembangunan daerah tertinggal untuk periode lima tahun yang merupakan penjabaran dari rencana pembangunan jangka menengah nasional,” didefinisikan pada Pasal 1 ayat (1).', '           <p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">Jakarta Pusat, Kominfo -</strong><span>&nbsp;</span>Presiden RI Joko Widodo (Jokowi) telah menandatangani Peraturan Presiden Republik Indonesia (Perpres) Nomor 105 Tahun 2021 tentang Strategi Nasional Percepatan Pembangunan Daerah Tertinggal Tahun 2020-2024 pada tanggal 10 Desember 2021.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Peraturan yang dapat diakses pada laman&nbsp;<a href=\"https://jdih.setkab.go.id/\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; background-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none; cursor: pointer; text-decoration: none; color: rgb(37, 40, 42);\">JDIH Sekretariat Kabinet</a>&nbsp;ini menindaklanjuti ketentuan Pasal 10 ayat (1)&nbsp;<a href=\"https://jdih.setkab.go.id/PUUdoc/174302/PP0782014.pdf\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; background-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none; cursor: pointer; text-decoration: none; color: rgb(37, 40, 42);\">Peraturan Pemerintah (PP) Nomor 78 Tahun 2014</a>&nbsp;tentang Pembangunan Daerah Tertinggal.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">“Strategi Nasional Percepatan Pembangunan Daerah Tertinggal yang selanjutnya disingkat Stranas-PPDT adalah dokumen perencanaan pembangunan daerah tertinggal untuk periode lima tahun yang merupakan penjabaran dari rencana pembangunan jangka menengah nasional,” didefinisikan pada Pasal 1 ayat (1).</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Stranas PPDT yang ditetapkan dalam rangka percepatan pembangunan daerah tertinggal secara nasional ini memuat: (1) isu, kebijakan, dan sasaran PPDT; (2) strategi PPDT; (3) program-kegiatan strategis PPDT; dan (4) strategi pembinaan daerah tertinggal terentaskan.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">“Penyusunan Stranas-PPDT Tahun 2020-2024 dimaksudkan untuk mendorong upaya percepatan pembangunan daerah tertinggal menjadi daerah tertinggal entas, secara khusus, terencana, sistematis, dan berkelanjutan,” disebutkan dalam Stranas yang tercantum dalam lampiran Perpres.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Stranas-PPDT Tahun 2020-2024 memiliki empat tujuan. Pertama, mempercepat pengurangan kesenjangan antardaerah dalam menjamin terwujudnya pemerataan dan keadilan pembangunan nasional. Kedua, mempercepat terpenuhinya kebutuhan dasar serta sarana-prasarana dasar daerah tertinggal. Ketiga, meningkatkan koordinasi, integrasi, dan sinkronisasi antara pusat dan daerah dalam perencanaan, pendanaan dan pembiayaan, pelaksanaan, pengendalian, dan evaluasi. Keempat, menjamin terselenggaranya operasionalisasi kebijakan PPDT.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><img src=\"data:image/png;base64,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RERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LZEAAAGIgBERERERPS2RAAABiIARERERET0tkQAAAYiAERERERE9LaTFgGc/e77FW/5pz346E23/upnt9x98x33zZ7/zEebtnWHw2aMa+LrhjMZq9bv2VdpuqP09fdv/KgoKzu3+YcLppdFZdWhxJ6CjL/7s89lVuKmzZ/opeofGPiwYKvu6dSeQ/Gne1yDpE/ihMF/bPnu3PfDw8PqneJxzkFGO3nq/waHhsywKHpdZIYyW93nwKEj9lROpb8eIXESSIQIABERERERve0kRABS+kqpf9Nt06TyT/Sue+fUf33ajDp+/llVLTN5aO6TbW0dppeF1NK3/+IhUV6YXiMjPT29Ty5+7eb/vv/jrSWml0WoO/zU86/f+9CCpSuzxQdmLZz+8KIfWi46K/lHnnheFvXPK96W13YE8GbGmvtmPK5H0OoIQN5o0eLXZBLdc97C5//r9l9LhZ+YAjjn8OjvXrj5jvsef/qlCxcvmcEWsgp33jPr7vvnnmk8q/vYEcAfX8+49ecPyF/daUcAiZNAIkQAiIiIiIjobSchApDi/P6ZTzjLfpfLMrPNqOPnn1XVUkL/+qEF/6quMb0sct/Pv++3j90zfb4zAjj+1cnZ85/5+0dFUp9LlW76joxsLd7lDBFC3eGFz7zy1tq/6k7NB/mbXVMJUsCLpsOBjgBkEtM9MlK2r/KXv5n3zdlzpjuKaw4/trXLW//+hTTnG8m6LFn61stpy50z1Mja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bjgjZf/qdbnyOulsBWd/qe1ffWOlzFmsPlL73Ms+WcILFy/pMTVEAJMOEQAiIiIiInrbSYgA3lr716eef33+ohc/3lriigA2bf7kid+/PG/h88+99OY1RwCajsude8u/mLfwD1LGf1V/Svo4a3IbVwTws1vutr35jvv8f92ob+mnF88edNNt05YsfUs38j91ulHmUHeyQc3OgfPtpLa3pxUXLX6t6fwPejQbIoBJhwgAERERERG97SREAH95+12pgV9ZsqK84oArAigtK5cy+Je/eWTewud/YgSgcd63z1mT27gigGkPPiolvXS2tXXo4l8jU90zff7B6qP6TL6+WkHTcblzxiNPb43e+c+msurQ/TOfuNiqbnxol/fDw8Pv/i344OzfJV6nQAQw6RABICIiIiKit/VUBNDX17dk6Vuu2+y9k/vBU8+/3tvbZ92McN6uPbEr8KUgX5/zd/umfc44wEXS+EAjM1m9Lnfewj9c7uwyvaJPE1iWma1vfOgs76X4f3D271wLKRABTDpEAIiIiIiI6G0nNALo6+8vKCo+XPPlVSOAfZ9XFW37tNNRVI+RjzZtu+Pu30qdH7GQF9Kpr+fXtbq8y6e79/X09HZc7vz7R0WyAHYocG0RgPBDy8XpDy+a89jif3/5lUx+6nTjcy/7pI/01yO4ynup/3/5m3lN3zebbgsigEmHCAAREREREb3thEYAGim/R48A7pk+/3xzix55vEjZ/2HB1lt//oC+6l5eSKf01EP7+vuD/9hiD/3FfXPK9lUORx/md80RgPBjW/trb2bedNs0ma38feHV9OYfLphhCeV9W3vHzHlP67sJml5EAFMAIgBERERERPS2kxAB6LPxN99x3++efdUVAcxf9KL8lUpYPynwmhkcGpIyW5QXppcDPbTjcqezAr8uRCIRmbOdOMB/FkQAiIiIiIjobSchAhCkwv90976HFzw745Gn9ZPzm87/8PjTL0mfjzZt6w6rK/MBJhgiAERERERE9LaTEwEATEGIABARERER0dsSAQAYiAAQEREREdHbEgEAGIgAEBERERHR2xIBABiIABARERER0dsSAQAYiAAQEREREdHbEgEAGIgAEBERERHR2xIBABiIABARERER0dsSAQAYiAAQEREREdHbEgEAGIgAEBERERHR2xIBABiIABARERER0dsSAQAYiAAQ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\" data-filename=\"Counter.png\" style=\"width: 100%;\"><br></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Adapun operasionalisasi kebijakan percepatan pembangunan daerah tertinggal yang dimaksud meliputi tiga hal. Pertama, memberikan pedoman tentang upaya-upaya strategis dan afirmasi yang perlu dilakukan oleh kementerian, lembaga, pemerintah daerah provinsi dan pemerintah daerah kabupaten serta pemangku kepentingan lain dalam menyusun program dan kegiatan PPDT yang berorientasi pada hasil (<em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">outcome</em>) dan dampak (<em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">impact</em>) bukan hanya keluaran kegiatan (<em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">output</em>) dengan capaian yang terukur. Kedua, memberikan acuan bagi pemerintah daerah provinsi dan pemerintah daerah kabupaten dalam menyusun Strategi Daerah (Strada)-PPDT Provinsi dan Strada-PPDT Kabupaten. Terakhir, memberikan acuan bagi pemerintah daerah provinsi dan pemerintah daerah kabupaten dalam menyusun Rencana Aksi Daerah Percepatan Pembangunan Daerah Tertinggal (RAD-PPDT) Provinsi dan Kabupaten.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Strategi PPDT yang tercantum dalam BAB III Stranas meliputi integrasi PPDT serta strategi yang disusun berdasarkan wilayah, yaitu Papua, Maluku, Nusa Tenggara, Sulawesi, dan Sumatra. Sedangkan program-kegiatan strategis PPDT yang tercantum dalam BAB IV meliputi program-kegiatan strategis kementerian/lembaga mendukung PPDT serta program-kegiatan strategis untuk masing-masing wilayah, yaitu Papua, Maluku, Nusa Tenggara, Sulawesi, dan Sumatra.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Sebagaimana ditegaskan pada Perpres 105/2021, Stranas-PPDT dilaksanakan oleh menteri yang menyelenggarakan urusan pemerintahan di bidang pembangunan daerah tertinggal (PDT), menteri/pimpinan lembaga, gubernur, dan bupati sesuai dengan kewenangannya serta dikoordinasikan oleh menteri yang menyelenggarakan urusan pemerintahan di bidang PDT.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">“Pelaksanaan Stranas-PPDT sebagaimana dimaksud didukung oleh pelaku usaha, masyarakat, dan pemangku kepentingan lainnya,” ditegaskan pada Pasal 3 ayat (2).</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Selanjutnya, ditegaskan pada Pasal 4, para kepala daerah menetapkan Strada-PPDT dengan ketentuan gubernur menetapkan Strada-PPDT Provinsi yang merupakan penjabaran dari rencana pembangunan jangka menengah daerah (RPJMD) provinsi dan memperhatikan Stranas-PPDT. Sedangkan, bupati menetapkan Strada-PPDT Kabupaten yang merupakan penjabaran dari RPJMD kabupaten dan memperhatikan Strada-PPDT Provinsi dan Stranas-PPDT.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Pemantauan dan evaluasi terhadap tingkat capaian Strada dan Stranas-PPDT dilaksanakan oleh bupati, gubernur, dan menteri sesuai dengan ketentuan peraturan peraturan perundang-undangan dan hasilnya dilaporkan kepada Presiden.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">“Berdasarkan hasil pemantauan dan evaluasi, terhadap daerah tertinggal yang telah terentaskan dari status daerah tertinggal diberikan pembinaan oleh menteri (yang menyelenggarakan urusan pemerintahan di bidang pembangunan daerah tertinggal) paling lama selama tiga tahun setelah terentaskan,” bunyi Pasal 6 ayat (1).</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Adapun ketentuan lebih lanjut mengenai pembinaan daerah tertinggal yang telah terentaskan diatur dengan peraturan menteri.</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">Berikut daftar kabupaten tertinggal tahun 2020-2024 yang tercantum Stranas PPDT 2020-204:</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">A. Wilayah Papua (Sebanyak 30 Kabupaten)</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Papua Barat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">1. Kabupaten Teluk Wondama<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">2. Kabupaten Teluk Bintuni<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">3. Kabupaten Sorong Selatan<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">4. Kabupaten Sorong<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">5. Kabupaten Tambrauw<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">6. Kabupaten Maybrat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">7. Kabupaten Manokwari Selatan<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">8. Kabupaten Pegunungan Arfak</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Papua<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">9. Kabupaten Jayawijaya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">10. Kabupaten Nabire<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">11. Kabupaten Paniai<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">12. Kabupaten Puncak Jaya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">13. Kabupaten Boven Digoel<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">14. Kabupaten Mappi<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">15. Kabupaten Asmat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">16. Kabupaten Yahukimo<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">17. Kabupaten Pegunungan Bintang<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">18. Kabupaten Tolikara<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">19. Kabupaten Keerom<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">20. Kabupaten Waropen<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">21. Kabupaten Supiori<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">22. Kabupaten Mamberamo Raya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">23. Kabupaten Nduga<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">24. Kabupaten Lanny Jaya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">25. Kabupaten Mamberamo Tengah<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">26. Kabupaten Yalimo<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">27. Kabupaten Puncak<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">28. Kabupaten Dogiyai<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">29. Kabupaten Intan Jaya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">30. Kabupaten Deiyai<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\"><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">B. Wilayah Maluku (Sebanyak 8 Kabupaten)</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Maluku<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">1. Kabupaten Kepulauan Tanimbar<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">2. Kabupaten Kepulauan Aru<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">3. Kabupaten Seram Bagian Barat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">4. Kabupaten Seram Bagian Timur<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">5. Kabupaten Maluku Barat Daya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">6. Kabupaten Buru Selatan</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Maluku Utara<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">7. Kabupaten Kepulauan Sula<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">8. Kabupaten Pulau Taliabu</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">C. Wilayah Nusa Tenggara (Sebanyak 14 Kabupaten)</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Nusa Tenggara Barat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">1. Kabupaten Lombok Utara</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Nusa Tenggara Timur<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">2. Kabupaten Sumba Barat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">3. Kabupaten Sumba Timur<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">4. Kabupaten Kupang<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">5. Kabupaten Timor Tengah Selatan<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">6. Kabupaten Belu<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">7. Kabupaten Alor<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">8. Kabupaten Lembata<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">9. Kabupaten Rote Ndao<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">10. Kabupaten Sumba Tengah<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">11. Kabupaten Sumba Barat Daya<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">12. Kabupaten Manggarai Timur<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">13. Kabupaten Sabu Raijua<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">14. Kabupaten Malaka</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">D. Wilayah Sulawesi (Sebanyak 3 Kabupaten)</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Sulawesi Tengah<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">1. Kabupaten Donggala<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">2. Kabupaten Tojo Una-una<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">3. Kabupaten Sigi</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><strong style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; font-weight: 700; text-size-adjust: none; color: rgb(0, 0, 0);\">E. Wilayah Sumatra (Sebanyak 7 Kabupaten)</strong></p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Sumatra Utara<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">1. Kabupaten Nias<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">2. Kabupaten Nias Selatan<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">3. Kabupaten Nias Utara<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">4. Kabupaten Nias Barat</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Sumatra Barat<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">5. Kabupaten Kepulauan Mentawai</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Sumatra Selatan<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">6. Kabupaten Musi Rawas Utara</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Provinsi Lampung<br style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: none; outline: 0px; text-size-adjust: none;\">7. Kabupaten Pesisir Barat</p><p style=\"box-sizing: border-box; margin: 0px 0px -15px; padding: 1em 0px; border: 0px; outline: 0px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-weight: 400; font-stretch: inherit; font-size: 15px; line-height: 1.6; font-family: &quot;Open Sans&quot;, sans-serif; vertical-align: baseline; text-size-adjust: none; color: rgb(51, 51, 51) !important; position: relative; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><a href=\"https://jdih.setkab.go.id/PUUdoc/176582/Salinan_Perpres_Nomor_105_Tahun_2021.pdf\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; background-color: transparent; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: inherit; vertical-align: baseline; text-size-adjust: none; cursor: pointer; text-decoration: none; color: rgb(37, 40, 42);\">Perpres 105/2021</a>&nbsp;ini mulai berlaku sejak tanggal diundangkan oleh Menteri Hukum dan Hak Asasi Manusia Yasonna H. Laoly&nbsp; tanggal 10 Desember 2021.</p>', '1733213159_f2e71e0d16d0f2a6ca30.png', '2022-07-08', '1', 1, 16, 'Berita', 379, 0, '0', 'Keterangan', NULL, '1', '0');
INSERT INTO `berita` (`berita_id`, `judul_berita`, `slug_berita`, `ringkasan`, `isi`, `gambar`, `tgl_berita`, `status`, `kategori_id`, `id`, `jenis_berita`, `hits`, `likepost`, `headline`, `ket_foto`, `filepdf`, `sts_komen`, `pilihan`) VALUES
(30, 'Sejarah', 'sejarah', NULL, '<p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\"><span style=\"font-weight: bolder;\"><u style=\"color: var(--colour-primary);\">SEJARAH BERDIRINYA&nbsp;DINAS</u></span></p><p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Dinas Pendidikan Kota Yogyakarta berdiri pada tanggal 19 September 1983. Awalnya diberi nama Kantor Departemen Pendidikan dan Kebudayaan Kotamadya Yogyakarta, dipimpin oleh seorang Kepala.</p><p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Pada saat itu Kantor Departemen Pendidikan dan Kebudayaan Kotamadya Yogyakarta dibawah koordinasi Kantor Wilayah Departemen Pendidikan dan Kebudayaan Propinsi DIY, mempunyai tugas dan fungsi sebagai pengelola dan pembina pendidikan jenjang TK, SD, SMP, se-Kotamadya Yogyakarta.</p><p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Pada tahun 1997 nama Kantor Departemen Pendidikan dan Kebudayaan Kotamadya Yogyakarta diganti namanya menjadi Kantor Departemen Pendidikan Nasional, dengan Kepala Kantor masih dijabat oleh Ir. Markus Sugiharjo.</p><p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Sejak tanggal 21 Mei 2001, sesuai Undang undang Nomor 22 Tahun 1999 Tentang Pemerintahan Daerah, setelah otonomi daerah, tugas dan fungsi Kantor Departemen Pendidikan Nasional bertambah sebagai pengelola dan pembina pendidikan jenjang TK, SD, SMP, SMA, dan SMK. Pengelolaan pendidikan untuk jenjang pendidikan dasar dan menengah di kota Yogyakarta sejak tanggal tersebut secara penuh diserahkan dari Pemerintah Pusat (Departemen Pendidikan Nasional) kepada Pemerintah Kota Yogyakarta, dan diganti nama menjadi Dinas Pendidikan dan Pengajaran Kota Yogyakarta, dibawah wewenang Pemerintah Daerah Kota Yogyakarta. Hal ini ditandai dengan pelantikan Kepala Dinas Pendidikan dan Pengajaran Kota Yogyakarta, Drs. Sugito, M.Si. diikuti oleh seluruh pejabat struktural di lingkungan instansi tersebut. Sejak saat itu dimulailah otonomi daerah di seluruh wilayah Indonesia untuk hampir semua sektor penyelenggaraan negara.</p><p style=\"margin-bottom: 10px; color: rgb(119, 119, 119); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Sebelum otonomi daerah dilaksanakan, penyelenggaraan pendidikan di kota Yogyakarta hampir semuanya dikelola oleh Pemerintah Pusat melalui Kantor Departemen Pendidikan dan Kebudayaan Kotamadya Yogyakarta yang berdiri melalui Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia Tahun 1983. Sebagai Kepala Kandepdikbud Kotamadya Yogyakarta yang pertama adalah Drs. Sukirno (Tahun 1983 sd tahun 1989), setelah pensiun. dilanjutkan secara berturut-turut oleh Drs. Soehardjo (Tahun 1989 sd 1992 ), setelah pension dilanjutkan Drs. Koesdarto Pramono (Tahun 1992 sd 1995 ), kemudian pada tahun1995 beliau dipromosi ke Kantor Wilayah Departemen Pendidikan dan Kebudayaan Provinsi DIY, dilanjutkan oleh Ir. Markus Sugiharjo (Tahun 1995 sd 1998 ). Pada tahun1998 Ir Markus Sugiharjo di promosikan ke Kantor Wilayah Departemen Pendidikan Nasional Provinsi DIY. Pada tahun 1998 dilantik Drs. Bambang Haryanto, M.M sebagai Kepala Kantor Departemen Pendidikan Nasional (Tahun 1998 sd 2000). Pada tahun 2000 dilantik Drs. Sugito, M.Si (Tahun 2000 sd 2004).</p>', '1701407841_de1a7abcc5956d9aad3a.png', '2022-10-31', '1', 0, 1, 'Halaman', 2, 0, NULL, '', NULL, '0', NULL),
(31, 'RPJPD', 'rpjpd', NULL, '   <p style=\"line-height: 1.8;\"><span style=\"color: rgb(39, 48, 68); font-size: 16px;\" open=\"\" sans\";=\"\" font-size:=\"\" 14px;\"=\"\">RPJPD adalah dokumen perencanaan pembangunan daerah periode 20 (dua</span><span style=\"color: rgb(39, 48, 68); font-size: 16px;\" open=\"\" sans\";=\"\" font-size:=\"\" 14px;\"=\"\">puluh) tahun terhitung sejak tahun 2005 sampai dengan tahun 2025, ditetapkan dengan maksud sebagai arah dan acuan pelaku pembangunan daerah untuk mewujudkan cita-cita dan tujuan pembangunan di daerah yang sesuai dengan visi, misi dan arah pembangunan daerah yang lebih efektif, efisien, terpadu, berkesinambungan dan saling melengkapi dalam pola sikap dan tindak bagi pelaku pembangunan.</span></p><p style=\"line-height: 1.8;\"><span style=\"color: rgb(39, 48, 68); font-family: \" open=\"\" sans\";=\"\" font-size:=\"\" 14px;\"=\"\"><span style=\"font-size: 16px;\">(Upload RPJPD)</span></span><br></p>', '1690626462_9e5642544491d95c09f8.jpg', '2022-10-31', '1', 0, 1, 'Halaman', 57, 0, NULL, '', '', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita_komen`
--

CREATE TABLE `berita_komen` (
  `beritakomen_id` int NOT NULL,
  `berita_id` int DEFAULT NULL,
  `nama_komen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hp_komen` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_komen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tanggal_komen` datetime DEFAULT NULL,
  `balas_komen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id` int UNSIGNED DEFAULT NULL,
  `sts_komen` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_komen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_balas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita_komen`
--

INSERT INTO `berita_komen` (`beritakomen_id`, `berita_id`, `nama_komen`, `hp_komen`, `isi_komen`, `tanggal_komen`, `balas_komen`, `id`, `sts_komen`, `email_komen`, `tgl_balas`) VALUES
(1, 28, 'Devi Taum', '819121', 'Ini Komentar di soroti tubuh', '2021-12-10 00:00:00', '@Devi Taum, Terima kasih atas atensinya.', 1, '1', 'devi@yahoo.com', '2021-12-15 09:21:07'),
(2, 17, 'Andreas Juang', '081981203121', 'Semoga teknologi memudahkan manusia, dan bukannya menyusahkan.', '2021-12-10 21:53:09', 'Teknologi hakekatnya memudahkan dan semestinya dimanfaatkan untuk kepentingan yang lebih.', 1, '1', 'andreas@juang.com', '2024-07-11 21:10:01'),
(3, 17, 'Tukang Iris', '081353967028', 'Semoga teknologi tidak membuat anak melupakan budaya lokal.', '2021-12-11 08:05:04', '@Tukang Iris, Semoga', 1, '1', 'tukang@iris.com', '2022-09-18 13:06:20'),
(10, 29, 'Vian', '0028222', 'Semoga dengan perpres ini, daerah kami dapat merasakan pembangunan.', '2024-07-10 12:05:34', '@Vian, amin', 1, '1', 'ikasmedia@gmail.com', '2024-11-27 07:26:33'),
(13, 17, 'Komen gen 5', '232323sds', 'sss', '2024-12-02 15:39:02', NULL, NULL, '0', 'Tes@tes.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita_tag`
--

CREATE TABLE `berita_tag` (
  `beritatag_id` int NOT NULL,
  `berita_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita_tag`
--

INSERT INTO `berita_tag` (`beritatag_id`, `berita_id`, `tag_id`) VALUES
(1, 5, 1),
(4, 15, 1),
(20, 1, 1),
(21, 1, 3),
(33, 3, 6),
(59, 17, 6),
(67, 28, 1),
(70, 29, 1),
(71, 29, 6);

-- --------------------------------------------------------

--
-- Table structure for table `bt_bidang`
--

CREATE TABLE `bt_bidang` (
  `bidang_id` int NOT NULL,
  `nama_bidang` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bt_bidang`
--

INSERT INTO `bt_bidang` (`bidang_id`, `nama_bidang`) VALUES
(4, 'Infrastruktur dan Telematika'),
(6, 'Persandian');

-- --------------------------------------------------------

--
-- Table structure for table `bt_bukutamu`
--

CREATE TABLE `bt_bukutamu` (
  `bukutamu_id` int NOT NULL,
  `bidang_id` int DEFAULT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instansi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keperluan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms__grupakses`
--

CREATE TABLE `cms__grupakses` (
  `id_grupakses` int NOT NULL,
  `id_grup` int NOT NULL,
  `id_modul` int NOT NULL,
  `akses` tinyint DEFAULT '0',
  `aksesmenu` int DEFAULT '0',
  `tambah` tinyint NOT NULL DEFAULT '0',
  `ubah` tinyint NOT NULL DEFAULT '0',
  `hapus` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms__grupakses`
--

INSERT INTO `cms__grupakses` (`id_grupakses`, `id_grup`, `id_modul`, `akses`, `aksesmenu`, `tambah`, `ubah`, `hapus`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0),
(2, 1, 2, 1, 0, 1, 1, 1),
(3, 1, 3, 1, 0, 1, 1, 1),
(4, 1, 4, 1, 0, 1, 1, 1),
(5, 1, 5, 1, 0, 1, 1, 1),
(6, 1, 6, 1, 0, 1, 1, 1),
(7, 1, 7, 1, 0, 1, 1, 1),
(8, 1, 8, 1, 0, 1, 1, 1),
(9, 1, 9, 1, 0, 1, 1, 1),
(10, 1, 10, 1, 0, 0, 0, 0),
(11, 1, 11, 1, 0, 1, 1, 1),
(12, 1, 12, 1, 0, 1, 1, 1),
(13, 1, 13, 1, 0, 1, 1, 1),
(15, 1, 15, 1, 0, 1, 1, 1),
(16, 1, 16, 1, 0, 1, 1, 1),
(18, 1, 18, 1, 0, 1, 1, 1),
(20, 1, 20, 1, 0, 1, 1, 1),
(21, 1, 21, 1, 0, 1, 1, 1),
(22, 1, 22, 1, 0, 1, 1, 1),
(23, 1, 23, 1, 0, 1, 1, 1),
(27, 1, 27, 1, 0, 1, 1, 1),
(28, 1, 28, 1, 0, 1, 1, 1),
(29, 1, 29, 1, 0, 0, 0, 0),
(30, 1, 30, 1, 0, 1, 1, 1),
(31, 1, 31, 1, 0, 1, 1, 1),
(33, 1, 33, 1, 0, 1, 1, 1),
(34, 1, 34, 1, 0, 1, 1, 1),
(35, 1, 35, 1, 0, 1, 1, 1),
(36, 1, 36, 1, 0, 1, 1, 1),
(37, 1, 37, 1, 0, 1, 1, 1),
(38, 1, 38, 1, 0, 0, 0, 0),
(39, 1, 39, 1, 0, 1, 1, 1),
(41, 1, 41, 1, 0, 1, 1, 1),
(45, 1, 45, 1, 1, 0, 0, 0),
(46, 1, 46, 1, 1, 0, 0, 0),
(47, 1, 47, 0, 1, 0, 0, 0),
(48, 1, 48, 0, 1, 0, 0, 0),
(51, 1, 49, 0, 1, 0, 0, 0),
(52, 1, 50, 0, 1, 0, 0, 0),
(53, 1, 51, 0, 1, 0, 0, 0),
(54, 1, 52, 1, 0, 0, 0, 0),
(55, 1, 53, 0, 1, 0, 0, 0),
(56, 1, 54, 0, 1, 0, 0, 0),
(57, 2, 2, 1, 0, 1, 1, 1),
(58, 2, 3, 1, 0, 1, 1, 1),
(59, 2, 4, 1, 0, 1, 1, 1),
(62, 2, 5, 1, 0, 1, 1, 1),
(63, 2, 6, 1, 0, 1, 1, 1),
(64, 2, 7, 1, 0, 1, 1, 1),
(65, 2, 8, 1, 0, 1, 1, 1),
(66, 2, 9, 1, 0, 1, 1, 1),
(67, 2, 10, 1, 0, 1, 1, 1),
(68, 2, 11, 1, 0, 1, 1, 1),
(69, 2, 12, 1, 0, 1, 1, 1),
(70, 2, 13, 1, 0, 1, 1, 1),
(71, 2, 15, 1, 0, 1, 1, 1),
(72, 2, 16, 1, 0, 1, 1, 1),
(74, 2, 18, 1, 0, 1, 1, 1),
(76, 2, 20, 1, 0, 1, 1, 1),
(77, 2, 21, 1, 0, 1, 1, 1),
(78, 2, 22, 1, 0, 1, 1, 1),
(80, 2, 23, 1, 0, 1, 1, 1),
(82, 2, 27, 1, 0, 1, 1, 1),
(83, 2, 28, 1, 0, 1, 1, 1),
(84, 2, 29, 3, 0, 0, 0, 0),
(85, 2, 31, 3, 0, 0, 0, 0),
(87, 2, 39, 3, 0, 0, 0, 0),
(89, 2, 30, 3, 0, 0, 0, 0),
(90, 2, 52, 3, 0, 0, 0, 0),
(91, 2, 33, 1, 0, 1, 1, 1),
(92, 2, 34, 1, 0, 1, 1, 1),
(93, 2, 35, 3, 0, 0, 0, 0),
(94, 2, 36, 3, 0, 0, 0, 0),
(95, 2, 37, 3, 0, 0, 0, 0),
(96, 2, 38, 3, 0, 0, 0, 0),
(97, 2, 41, 1, 0, 1, 1, 1),
(110, 3, 2, 2, 0, 1, 1, 1),
(111, 3, 3, 3, 0, 0, 0, 0),
(112, 3, 4, 3, 0, 0, 0, 0),
(115, 3, 5, 2, 0, 1, 1, 1),
(116, 3, 6, 2, 0, 1, 1, 1),
(117, 3, 7, 2, 0, 1, 1, 1),
(118, 3, 8, 2, 0, 1, 1, 1),
(119, 3, 9, 3, 0, 0, 0, 0),
(120, 3, 10, 3, 0, 0, 0, 0),
(121, 3, 11, 3, 0, 0, 0, 0),
(122, 3, 12, 3, 0, 0, 0, 0),
(123, 3, 13, 3, 0, 0, 0, 0),
(124, 3, 15, 3, 0, 0, 0, 0),
(125, 3, 16, 2, 0, 1, 1, 1),
(127, 3, 18, 2, 0, 1, 1, 1),
(129, 3, 20, 3, 0, 0, 0, 0),
(130, 3, 21, 3, 0, 0, 0, 0),
(131, 3, 22, 3, 0, 0, 0, 0),
(133, 3, 23, 3, 0, 0, 0, 0),
(135, 3, 27, 2, 0, 1, 1, 1),
(136, 3, 28, 3, 0, 0, 0, 0),
(137, 3, 29, 3, 0, 0, 0, 0),
(138, 3, 31, 3, 0, 0, 0, 0),
(140, 3, 39, 3, 0, 0, 0, 0),
(142, 3, 30, 3, 0, 0, 0, 0),
(143, 3, 52, 3, 0, 0, 0, 0),
(144, 3, 33, 3, 0, 0, 0, 0),
(145, 3, 34, 3, 0, 0, 0, 0),
(146, 3, 35, 3, 0, 0, 0, 0),
(147, 3, 36, 3, 0, 0, 0, 0),
(148, 3, 37, 3, 0, 0, 0, 0),
(149, 3, 38, 3, 0, 0, 0, 0),
(150, 3, 41, 3, 0, 0, 0, 0),
(154, 3, 45, 0, 1, 0, 0, 0),
(155, 3, 46, 0, 1, 0, 0, 0),
(156, 3, 47, 0, 0, 0, 0, 0),
(157, 3, 48, 0, 1, 0, 0, 0),
(158, 3, 49, 0, 0, 0, 0, 0),
(159, 3, 50, 0, 1, 0, 0, 0),
(160, 3, 54, 0, 0, 0, 0, 0),
(161, 3, 51, 0, 0, 0, 0, 0),
(162, 3, 53, 0, 0, 0, 0, 0),
(163, 1, 55, 1, 0, 1, 1, 1),
(164, 2, 55, 3, 0, 0, 0, 0),
(165, 3, 55, 3, 0, 0, 0, 0),
(166, 1, 57, 1, 0, 1, 1, 1),
(167, 1, 58, 1, 0, 1, 1, 1),
(259, 1, 62, 1, 0, 1, 1, 1),
(262, 1, 66, 1, 0, 1, 1, 1),
(272, 2, 62, 1, 0, 1, 1, 1),
(273, 1, 67, 1, 0, 1, 1, 1),
(274, 1, 68, 1, 0, 1, 1, 1),
(275, 1, 56, 1, 0, 1, 1, 1),
(276, 2, 45, 0, 1, 0, 0, 0),
(277, 2, 46, 0, 1, 0, 0, 0),
(278, 2, 47, 0, 1, 0, 0, 0),
(279, 2, 48, 0, 1, 0, 0, 0),
(280, 2, 49, 0, 1, 0, 0, 0),
(281, 2, 50, 0, 1, 0, 0, 0),
(282, 2, 51, 0, 0, 0, 0, 0),
(283, 2, 53, 0, 1, 0, 0, 0),
(284, 2, 54, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms__modpublic`
--

CREATE TABLE `cms__modpublic` (
  `id_modpublic` int NOT NULL,
  `modpublic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stsmod` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms__modpublic`
--

INSERT INTO `cms__modpublic` (`id_modpublic`, `modpublic`, `link`, `stsmod`) VALUES
(1, 'Berita', 'berita', 1),
(2, 'Data Pegawai', 'pegawai', 1),
(3, 'Layanan', 'layanan', 1),
(4, 'Pengumuman', 'pengumuman', 1),
(5, 'Agenda Kegiatan', 'agenda', 1),
(6, 'Bank Data', 'bankdata', 1),
(7, 'Produk Hukum', 'produkhukum', 1),
(8, 'Info Grafis', 'infografis', 1),
(9, 'Transparansi', 'transparansi', 1),
(10, 'Galeri Foto', 'foto', 1),
(11, 'Galeri Video', 'video', 1),
(12, 'Survei', 'survey', 1),
(13, 'Buku Tamu', 'bukutamu', 1),
(15, 'Masukan dan Saran', 'masukansaran', 1),
(16, 'E-Book', 'ebook', 1),
(17, 'Peta Situs', 'petasitus', 1),
(18, 'Fasilitas', 'fasilitas', 1),
(20, 'Permohonan Informasi', 'permohonan-informasi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms__modul`
--

CREATE TABLE `cms__modul` (
  `id_modul` int NOT NULL,
  `modul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '0',
  `urut` int DEFAULT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `gm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipemn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urlmenu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ikonmn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms__modul`
--

INSERT INTO `cms__modul` (`id_modul`, `modul`, `aktif`, `urut`, `level`, `hidden`, `gm`, `tipemn`, `urlmenu`, `ikonmn`) VALUES
(1, 'Dashboard', 1, 0, 1, 1, '-', NULL, NULL, '-'),
(2, 'Data Berita', 1, 1, 0, 0, 'Berita', 'sm', 'berita/all', 'mdi mdi-newspaper'),
(3, 'Kategori Berita', 1, 2, 1, 0, 'Berita', 'sm', 'berita/allkategori', 'mdi mdi-window-restore'),
(4, 'Tagar Berita', 1, 3, 1, 0, 'Berita', 'sm', 'berita/alltag', 'mdi mdi-tag-multiple'),
(5, 'Data Layanan', 1, 1, 1, 0, 'Informasi', 'sm', 'layanan/all', 'mdi mdi-teach'),
(6, 'Data Agenda', 1, 2, 1, 0, 'Informasi', 'sm', 'agenda/all', 'mdi mdi-timetable'),
(7, 'Bank Data', 1, 3, 1, 0, 'Informasi', 'sm', 'bankdata/all', 'mdi mdi-file-multiple'),
(8, 'Pengumuman', 1, 4, 1, 0, 'Informasi', 'sm', 'pengumuman/all', 'mdi mdi-bullhorn'),
(9, 'Produk Hukum', 1, 5, 1, 0, 'Informasi', 'sm', 'produkhukum/all', 'mdi mdi-scale-balance'),
(10, 'Sambutan Kepala', 1, 1, 1, 0, 'Lembaga', 'sm', 'sambutan', 'mdi mdi-voice'),
(11, 'Data Pegawai', 1, 2, 1, 0, 'Lembaga', 'sm', 'pegawai/all', 'mdi mdi-folder-account'),
(12, 'Transparansi', 1, 3, 1, 0, 'Lembaga', 'sm', 'transparansi/list', 'mdi mdi-chart-arc'),
(13, 'Fasilitas', 1, 4, 1, 0, 'Lembaga', 'sm', 'fasilitas/list', 'mdi mdi-folder-star'),
(15, 'Counter', 1, 5, 1, 0, 'Lembaga', 'sm', 'counter', 'mdi mdi-chart-timeline'),
(16, 'Data Foto', 1, 1, 1, 0, 'Galeri', 'sm', 'foto/all', 'mdi mdi-folder-multiple-image'),
(18, 'Data Video', 1, 2, 1, 0, 'Galeri', 'sm', 'video/all', 'mdi mdi-youtube'),
(20, 'Survei', 1, 1, 1, 0, 'Interaksi', 'sm', 'survey/all', 'far fa-check-square'),
(21, 'Jajak Pendapat', 1, 2, 1, 0, 'Interaksi', 'sm', 'poling', 'mdi mdi-chart-bar-stacked'),
(22, 'Buku Tamu', 1, 4, 1, 0, 'Interaksi', 'sm', 'bukutamu/list', 'far fa-comment-dots'),
(23, 'Masukan Saran', 1, 3, 1, 0, 'Interaksi', 'sm', 'kritiksaran/list', 'far fa-comments'),
(27, 'Ebook', 1, 1, 1, 0, 'Ebook', 'sm', 'ebook/all', 'mdi mdi-library'),
(28, 'Kategori Ebook', 1, 2, 1, 0, 'Ebook', 'sm', 'ebook/kategori', 'mdi mdi-layers'),
(29, 'Pengaturan', 1, 1, 1, 0, 'Pengaturan', 'sm', 'konfigurasi', 'mdi mdi-wrench'),
(30, 'Template', 1, 4, 1, 0, 'Pengaturan', 'sm', 'template', 'mdi mdi-palette'),
(31, 'Pengguna', 1, 2, 1, 0, 'Pengaturan', 'sm', 'user', 'mdi mdi-account-settings-variant'),
(33, 'Halaman', 1, 1, 1, 0, 'Setkonten', 'sm', 'halaman', 'mdi mdi mdi-book-open-page-variant'),
(34, 'Banner', 1, 2, 1, 0, 'Setkonten', 'sm', 'banner', 'mdi mdi-image-multiple'),
(35, 'Infografis', 1, 3, 1, 0, 'Setkonten', 'sm', 'infografis/all', 'mdi mdi-folder-multiple-image mdi-2x'),
(36, 'Section', 1, 4, 1, 0, 'Setkonten', 'sm', 'section', 'mdi mdi-vector-arrange-below'),
(37, 'Link Terkait', 1, 5, 1, 0, 'Setkonten', 'sm', 'linkterkait', 'mdi mdi-link-variant'),
(38, 'Modal Popup', 1, 6, 1, 0, 'Setkonten', 'sm', 'penawaran', 'mdi mdi-camera-metering-center'),
(39, 'Menu', 1, 3, 1, 0, 'Pengaturan', 'sm', 'menu', 'mdi mdi-sitemap'),
(41, 'Unit Kerja', 1, 1, 1, 0, 'Master', 'sm', 'unitkerja', 'mdi mdi-file-multiple mdi-2x'),
(45, 'BLOG', 1, 1, 2, 1, 'Berita', 'utm', NULL, 'dripicons-feed'),
(46, 'INFORMASI', 1, 2, 2, 1, 'Informasi', 'utm', NULL, 'dripicons-wallet'),
(47, 'LEMBAGA', 1, 3, 2, 1, 'Lembaga', 'utm', NULL, 'dripicons-archive'),
(48, 'GALERI', 1, 4, 2, 1, 'Galeri', 'utm', NULL, 'dripicons-photo'),
(49, 'INTERAKSI', 1, 5, 2, 1, 'Interaksi', 'utm', NULL, 'dripicons-message'),
(50, 'E-BOOK', 1, 6, 2, 1, 'Ebook', 'utm', NULL, 'dripicons-to-do'),
(51, 'KONFIGURASI', 1, 7, 2, 1, 'Pengaturan', 'utm', NULL, 'dripicons-gear'),
(52, 'Modul CMS', 1, 5, 1, 0, 'Pengaturan', 'sm', 'modul', 'mdi mdi-compare'),
(53, 'KELOLA KONTEN', 1, 8, 2, 1, 'Setkonten', 'utm', NULL, 'dripicons-copy'),
(54, 'MASTER DATA', 1, 9, 3, 1, 'Master', 'utm', NULL, 'mdi mdi-database'),
(55, 'Iklan', 1, 8, 3, 0, 'Setkonten', 'sm', 'iklan', 'mdi mdi-camera-burst'),
(56, 'Upgrade CMS', 1, 6, 3, 0, 'Pengaturan', 'sm', 'cms-update', 'fas fa-code'),
(57, 'Tanya Jawab', 1, 9, 3, 0, 'Setkonten', 'sm', 'tanyajawab/list', 'mdi mdi-comment-question-outline'),
(58, 'Permintaan Informasi', 0, 5, 3, 0, 'Interaksi', 'sm', 'permintaan-info/list', 'fab fa-slideshare'),
(62, 'Kategori FAQ', 1, 2, 3, 0, 'Master', 'sm', 'm-kategorifaq', 'mdi mdi-checkbox-multiple-blank-circle-outline'),
(66, 'Section Script', 1, 10, 3, 0, 'Setkonten', 'sm', 'section-script', 'mdi mdi-console'),
(67, 'Pendidikan', 1, 3, 3, 0, 'Master', 'sm', 'm-pendidikan', 'mdi mdi-checkbox-multiple-blank-circle-outline'),
(68, 'Pekerjaan', 1, 4, 3, 0, 'Master', 'sm', 'm-pekerjaan', 'mdi mdi-checkbox-multiple-blank-circle-outline');

-- --------------------------------------------------------

--
-- Table structure for table `cms__usergrup`
--

CREATE TABLE `cms__usergrup` (
  `id_grup` int NOT NULL,
  `nama_grup` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` tinyint NOT NULL DEFAULT '1',
  `ketgrup` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `sts_menu` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms__usergrup`
--

INSERT INTO `cms__usergrup` (`id_grup`, `nama_grup`, `jenis`, `ketgrup`, `created_at`, `created_by`, `updated_at`, `updated_by`, `sts_menu`) VALUES
(1, 'Global Administrator', 1, 'Super User (Akses semua Modul dan Menu)', '2021-04-30 17:45:38', NULL, '2021-04-30 17:45:38', 0, 1),
(2, 'Editor', 2, 'Wewenang Pengguna untuk Editor (Akses semua Menu Kecuali Pengaturan)', '2022-03-16 09:34:03', NULL, '2022-03-16 09:34:03', 0, 1),
(3, 'Author', 2, 'Wewenang untuk Author, Hanya Mengolah Datanya sendiri.  Menu aktif Berita, Informasi, Galeri & E-book', '2022-03-17 00:59:24', NULL, '2022-03-17 00:59:24', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms__usersessions`
--

CREATE TABLE `cms__usersessions` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `session_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id_counter` int NOT NULL,
  `nm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jm` int DEFAULT NULL,
  `ic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `bgc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '#2f79b6'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id_counter`, `nm`, `jm`, `ic`, `sumber`, `link`, `sts`, `bgc`) VALUES
(1, 'SEKOLAH DASAR', 49090, 'fa fa-university', 'Sekretariat', '#', '1', '#00a7e1'),
(2, 'SLTP', 564, 'fas fa-chalkboard-teacher', 'Sekretariat', '#', '1', '#3ddc97'),
(3, 'PAUD', 331, 'fas fa-child', 'Sekretariat', '#', '1', '#e4cc37'),
(4, 'PKBM', 4312, 'fas fa-boxes', 'Sekretariat', '#', '1', '#f06543');

-- --------------------------------------------------------

--
-- Table structure for table `custome__anggota`
--

CREATE TABLE `custome__anggota` (
  `anggota_id` int NOT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tgl_daftar` date NOT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` varchar(17) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kab` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kec` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rtrw` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pekerjaan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dok_ktp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custome__masterdata`
--

CREATE TABLE `custome__masterdata` (
  `id_masterdata` int UNSIGNED NOT NULL,
  `nama_master` varchar(200) DEFAULT NULL,
  `jns_master` varchar(1) DEFAULT NULL,
  `sts_master` varchar(1) DEFAULT NULL,
  `slug_master` varchar(150) DEFAULT NULL,
  `image_master` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ket_master` varchar(200) DEFAULT NULL,
  `hits_master` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custome__masterdata`
--

INSERT INTO `custome__masterdata` (`id_masterdata`, `nama_master`, `jns_master`, `sts_master`, `slug_master`, `image_master`, `ket_master`, `hits_master`) VALUES
(1, 'CMS', '1', '1', 'cms', NULL, NULL, 0),
(2, 'Umum', '1', '1', 'umum', NULL, NULL, 0),
(4, 'Tidak / Belum Sekolah', '3', '1', 'tidak-belum-sekolah', NULL, NULL, 0),
(5, 'Belum Tamat SD/Sederajat', '3', '1', 'belum-tamat-sdsederajat', NULL, NULL, 0),
(6, 'Tamat SD/Sederajat', '3', '1', 'tamat-sdsederajat', NULL, NULL, 0),
(7, 'SLTP/Sederajat', '3', '1', 'sltpsederajat', NULL, NULL, 0),
(8, 'Diploma I/II', '3', '1', 'diploma-iii', NULL, NULL, 0),
(9, 'Akademi/Diploma III/Sarjana Muda', '3', '1', 'akademidiploma-iiisarjana-muda', NULL, NULL, 0),
(10, 'Diploma IV/Strata I', '3', '1', 'diploma-ivstrata-i', NULL, NULL, 0),
(11, 'Strata II', '3', '1', 'strata-ii', NULL, NULL, 0),
(12, 'Strata III', '3', '1', 'strata-iii', NULL, NULL, 0),
(13, 'Belum / Tidak Bekerja', '2', '1', 'belum-tidak-bekerja', NULL, NULL, 0),
(14, 'Mengurus Rumah Tangga', '2', '1', 'mengurus-rumah-tangga', NULL, NULL, 0),
(15, 'Pelajar / Mahasiswa', '2', '1', 'pelajar-mahasiswa', NULL, NULL, 0),
(16, 'Pensiunan', '2', '1', 'pensiunan', NULL, NULL, 0),
(17, 'Pegawai Negeri Sipil (PNS)', '2', '1', 'pegawai-negeri-sipil-pns', NULL, NULL, 0),
(18, 'Tentara Nasional Indonesia (TNI)', '2', '1', 'tentara-nasional-indonesia-tni', NULL, NULL, 0),
(19, 'Kepolisian RI (POLRI)', '2', '1', 'kepolisian-ri-polri', NULL, NULL, 0),
(20, 'Perdagangan', '2', '1', 'perdagangan', NULL, NULL, 0),
(21, 'Petani / Pekebun', '2', '1', 'petani-pekebun', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `custome__mohoninfo`
--

CREATE TABLE `custome__mohoninfo` (
  `id_mohoninfo` int UNSIGNED NOT NULL,
  `nama_pemohon` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_pemohon` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pek_pemohon` int NOT NULL,
  `hp_pemohon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_pemohon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `info_ygdibutuhkan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tujuan_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_ktp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cara_perolehinfo` int NOT NULL,
  `cara_dapatkaninfo` int NOT NULL,
  `tgl_ajuan` datetime NOT NULL,
  `tgl_respon` datetime DEFAULT NULL,
  `respon_balas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id` int UNSIGNED DEFAULT NULL,
  `sts_info` tinyint(1) NOT NULL,
  `sts_public` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custome__opd`
--

CREATE TABLE `custome__opd` (
  `opd_id` int NOT NULL,
  `nama_opd` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_opd` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `singkatan_opd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_id` int DEFAULT NULL,
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custome__opd`
--

INSERT INTO `custome__opd` (`opd_id`, `nama_opd`, `deskripsi_opd`, `singkatan_opd`, `alamat`, `tipe_id`, `sts`) VALUES
(0, 'ALL', '-', '-', '-', 1, '1'),
(1, 'DINAS PENDIDIKAN', ' Sebuah OPD di Lingkup Pemerintah Daerah Kabupaten Lembata yang Bentuk Berdasarkan SK Bupati Tahun 2002', 'DIKBUD', 'Jl. Ahmad Yani No.11, Nubatukan, Kabupaten Lembata, NTT', 1, '1'),
(2, 'DINAS LINGKUNGAN HIDUP', ' Dinas Lingkungan HIdup', 'DLH', 'Jalan Bukit Halimun, Luwuk, Banggai, Sulawesi Tengah', 1, '1'),
(3, 'DINAS SOSIAL', '    Dinas Sosial Kabupaten Lembata', 'DINSOS', 'Jl. Urip Sumoharjo No.15, Karaton, Kabupaten Lembata, NTT 94711', 1, '1'),
(4, 'DINAS KOMUNIKASI DAN INFORMATIKA ', ' Dinas Komunikasi dan Informatika', 'DISKOMINFO', 'Jl. Urip Sumoharjo No.15, Nubatukan, Kabupaten Lembata, NTT', 1, '1'),
(5, 'DINAS PERHUBUNGAN', 'Dinas Perhubungan atau biasa disingkat Dishub ', 'DISHUB', 'Jalan MT Haryono, Luwuk, Banggai, Sulawesi Tengah', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `custome__opdtipe`
--

CREATE TABLE `custome__opdtipe` (
  `tipe_id` int NOT NULL,
  `nama_tipe` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custome__opdtipe`
--

INSERT INTO `custome__opdtipe` (`tipe_id`, `nama_tipe`) VALUES
(1, 'DINAS'),
(2, 'BADAN'),
(3, 'INSPEKTORAT'),
(4, 'INSTANSI VERTIKAL');

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `ebook_id` int NOT NULL,
  `kategoriebook_id` int DEFAULT NULL,
  `judul` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fileebook` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penulis` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `j_hal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`ebook_id`, `kategoriebook_id`, `judul`, `gambar`, `fileebook`, `penulis`, `j_hal`, `tanggal`, `hits`, `status`, `id`) VALUES
(2, 1, 'Digital Marketing melalui Aplikasi', '1639361861_351b4e0a65f86a8c0ba3.jpg', '1634212422_40a889d196d4391a76d4.pdf', 'Usman Camdani', '190', '2021-10-14', 41, '1', 1),
(5, 1, 'Mengelola Kualitas Layanan di bidang Telekomunikasi', '1639578966_3427d41502e76bb7fb11.jpg', '1634288761_8dbbb2854600cb088a00.pdf', 'Ikatan Bankir Indonesia  ', '124', '2021-10-15', 19, '1', 1),
(6, 3, 'Legenda Putri Duyung', '1639579019_ea6360db0359f7106061.jpg', '1634358817_58dd7a7fdb1651781f28.pdf', 'Dian K ', '102', '2021-10-16', 28, '1', 1),
(7, 1, 'Internet Marketing', '1639361251_8c7e8af5a81339c63bf9.png', '1639361251_5298acf8cc7605860af8.pdf', 'James Murdor', '122', '2021-12-13', 25, '1', 1),
(8, 1, 'Ebook Author', '1639400811_8036ce709ce1978cbe3d.png', '1639400811_c09db5abd955a1bf3bc5.pdf', 'Vian Taum     ', '233', '2021-12-13', 27, '1', 14);

-- --------------------------------------------------------

--
-- Table structure for table `faq_jawab`
--

CREATE TABLE `faq_jawab` (
  `faq_jawabid` int NOT NULL,
  `faq_tanyaid` int DEFAULT NULL,
  `faq_jawaban` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `sts_jwb` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_jawab`
--

INSERT INTO `faq_jawab` (`faq_jawabid`, `faq_tanyaid`, `faq_jawaban`, `sts_jwb`) VALUES
(1, 1, ' <p> <font color=\"#333333\" face=\"AmazonEmber, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 14px;\">CMS ikasmedia adalah sebuah sistem manajemen konten yang dirancang untuk membantu pengguna dalam membuat, mengelola, dan mengatur konten di situs web atau aplikasi. ikasmedia memiliki fitur-fitur yang dirancang khusus untuk pengelolaan data, termasuk pengumpulan, penyimpanan, dan analisis data secara efisien.</span></font></p>', NULL),
(3, 3, '<div>Untuk menginstal CMS ikasmedia, Anda perlu mengunduh paket instalasi dari sumber yang terpercaya. Setelah unduhan selesai, ikuti panduan instalasi yang disediakan. Setelah terinstal, Anda dapat mengakses CMS ikasmedia melalui browser web dengan menggunakan URL atau alamat yang ditentukan saat instalasi.</div><div><br></div><div>Setelah masuk ke CMS ikasmedia, Anda dapat mulai mengelola konten dan data dengan antarmuka yang telah disediakan. Biasanya, terdapat menu atau panel pengaturan yang memungkinkan Anda untuk membuat, mengedit, dan menghapus konten, serta mengatur pengaturan lainnya sesuai kebutuhan.</div>', NULL),
(7, 2, ' <ol><li>Manajemen konten yang intuitif: ikasmedia menyediakan antarmuka pengguna yang mudah digunakan untuk mengelola konten di situs web atau aplikasi.</li><li>Pengelolaan data: CMS ini memungkinkan pengguna untuk mengumpulkan, menyimpan, dan mengatur data dengan mudah. ikasmedia juga dilengkapi dengan fitur pencarian yang canggih untuk membantu menemukan data yang dibutuhkan.<br></li><li>Keamanan: Keamanan data merupakan prioritas utama dalam CMS ikasmedia. Sistem ini menyediakan lapisan keamanan yang kuat untuk melindungi data dari akses yang tidak sah.<br></li><li>Responsif dan SEO-friendly: CMS ikasmedia didesain untuk memberikan tampilan yang responsif di berbagai perangkat dan juga memiliki fitur yang mendukung optimasi mesin pencari (SEO).<br></li></ol>', NULL),
(8, 4, ' <p>CMS ikasmedia bersifat Open source dengan syarat dan ketentuan berlaku</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faq_tanya`
--

CREATE TABLE `faq_tanya` (
  `faq_tanyaid` int NOT NULL,
  `faqtanya` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_faqtanya` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kat_faq` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq_tanya`
--

INSERT INTO `faq_tanya` (`faq_tanyaid`, `faqtanya`, `sts_faqtanya`, `kat_faq`) VALUES
(1, 'Apa itu CMS ikasmedia?', '1', 1),
(2, 'Apa saja fitur-fitur utama yang dimiliki oleh CMS ikasmedia?', '1', 1),
(3, 'Bagaimana cara menginstal dan menggunakan CMS ikasmedia?', '1', 1),
(4, 'Apakah CMS ikasmedia bersifat open source?', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `fasilitas_id` int NOT NULL,
  `fasilitas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cover_foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `tipe_fas` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`fasilitas_id`, `fasilitas`, `cover_foto`, `ket`, `lokasi`, `sts`, `tipe_fas`) VALUES
(1, 'Stadion Utama', '1642839353_c1596bffeec6d82ca89f.jpg', 'Berikut data foto stadion besar', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.1369737286846!2d123.4043691143332!3d-8.388185886927594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dab73867f9b5147%3A0xcd1190d849e57905!2sikasmedia%20Software!5e0!3m2!1sid!2sid!4v1623407918344!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', '1', 0),
(2, 'Stadion Mini', '1689911260_78109ed7ec38ccca789f.png', '<p>Stadion mini yang telah selesai dipugar</p>', '', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_detail`
--

CREATE TABLE `fasilitas_detail` (
  `fasilitasdetail_id` int NOT NULL,
  `fasilitas_id` int DEFAULT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas_detail`
--

INSERT INTO `fasilitas_detail` (`fasilitasdetail_id`, `fasilitas_id`, `gambar`, `deskripsi`) VALUES
(1, 1, '1666793399_e5c458ce0d0acdb50ee2.jpg', 'Tampak Belakang'),
(2, 1, '1682519094_4ae2ee1d647f08c1fea2.jpg', 'Tampak depan'),
(5, 2, '1696732987_3432fe52ba628d85518f.png', 'Mini 1');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int NOT NULL,
  `kategorifoto_id` int DEFAULT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `hits` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `kategorifoto_id`, `judul`, `tanggal`, `gambar`, `id`, `hits`) VALUES
(44, 1, 'Wisma Atlet Kemayoran dan Rusunawa Raih Penghargaan Inovasi Pelayanan Publik Penanganan Covid-19', '2021-06-14', '1623601134_a4755ab7a88523662a5d.jpg', 1, 1),
(46, 1, 'CMS ikasmedia New Versi', '2021-06-14', '1623816361_35910235c35789e18949.jpg', 1, 1),
(47, 2, 'Demo Foto', '2021-06-16', '1650116579_1b9dd22e99989cd76e14.jpg', 1, 1),
(50, 1, 'Demo Foto 4', '2021-06-16', '1650115911_30b8d2e45c439caba8da.jpg', 1, 1),
(51, 1, 'Demo Foto 2', '2021-06-16', '1650115989_656fa50360a1157aeddf.jpg', 1, 1),
(52, 2, 'Demo Foto 2', '2021-06-16', '1623816515_25de364958d48be7a6ad.jpg', 1, 1),
(57, 6, 'Expect Nothing', '2021-06-16', '1623816679_7fb1cfd80ab799fdafe9.png', 1, 1),
(58, 7, 'Tampilan Baru CMS', '2022-04-16', '1650116664_2e68aa0d5bf747c2b424.jpg', 1, NULL),
(59, 7, 'Konfigurasi CMS', '2022-04-16', '1650115295_3bd00ce6766779ebb32b.jpg', 1, NULL),
(60, 1, 'Lembata', '2023-04-25', '1682428273_b663e3fd2f73b2634414.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `informasi_id` int NOT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_informasi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_informasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gambar` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_informasi` date DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `type` int DEFAULT NULL COMMENT '0=Layanan\r\n1=Pengumuman',
  `id` int UNSIGNED DEFAULT NULL,
  `fileunduh` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_aktif` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `utm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`informasi_id`, `nama`, `slug_informasi`, `isi_informasi`, `gambar`, `tgl_informasi`, `hits`, `type`, `id`, `fileunduh`, `sts_aktif`, `ket`, `utm`) VALUES
(2, 'Asesmen ABK pada Kegiatan PPDB', 'asesmen-abk-pada-kegiatan-ppdb', '<p><span style=\"font-weight: bolder;\">Persyaratan<span style=\"white-space: pre;\">	</span>:</span><span style=\"white-space: pre;\">	</span></p><ol><li><font color=\"#000000\">Sudah mendapatkan jadwal untuk dilakukan program Pelayanan Asesmen ABK oleh admin</font></li></ol><p><span style=\"font-weight: 700;\">Sistem Mekanisme</span><span style=\"font-weight: 700; white-space: pre;\">	</span><span style=\"font-weight: 700;\">:</span></p><ol><li>Mendapatkan rekomendasi program pelayanan Asesmen ABK beserta jadwal.</li><li>Melakukan asesmen dan observasi Asesmen ABK selama 4 kali pertemuan atau 1 bulan.</li><li>Melakukan intervensi layanan program Asesmen ABK.</li><li>Melakukan evaluasi program layanan Asesmen ABK</li><li>Membuat laporan hasil evaluasi program Asesmen ABK</li><li>Melakukan re-assesment ABK.</li><li>Menyerahkan laporan perkembangan keterapian dan konsultasi</li><li>Mengarsipkan seluruh laporan keterapian (<i>softfile</i>&nbsp;dan&nbsp;<i>hardfile)</i></li></ol><p><span style=\"font-weight: 700;\">Jangka Waktu Pelayanan</span><span style=\"font-weight: 700; white-space: pre;\">	</span><span style=\"font-weight: 700;\">:</span>&nbsp;8 Jam</p><p><span style=\"font-weight: 700;\">Biaya/Tarif :&nbsp;</span>Gratis</p><p><span style=\"font-weight: 700;\">Produk Layanan :&nbsp;</span>Asesmen ABK pada Kegaiatan PPDB</p><p><span style=\"font-weight: 700;\">Penanganan Pengaduan :</span><br></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41);\">&nbsp; &nbsp;Website&nbsp; &nbsp;(&nbsp;&nbsp;<a href=\"https://ikasmedia.net/\" target=\"_blank\">ikasmedia</a>&nbsp;)</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\"></p>', '1622784809_6fd7ee491a1ba50ed3aa.jpg', '2021-06-02', 163, 0, 1, NULL, NULL, NULL, 1),
(5, 'Fasilitasi Izin Penelitian', 'fasilitasi-izin-penelitian', '  <p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><span style=\"font-weight: bolder;\">Persyaratan&nbsp; &nbsp; :&nbsp; &nbsp;</span><br></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\">&nbsp; &nbsp;</font><font color=\"#212529\" face=\"Open Sans, sans-serif\">1.<span style=\"white-space: pre;\">	</span>Surat izin penelitian dari Balitbangda</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">&nbsp; &nbsp; 2. Surat Permohonan Penelitian dari Kampus</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">&nbsp; &nbsp; 3. Proposal penelitian</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">&nbsp; &nbsp; 4. Fc KTP / Kartu Tanda Mahasiswa</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><span style=\"font-weight: bolder;\">Mekanisme&nbsp; &nbsp; :&nbsp; &nbsp;</span><br></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">1.<span style=\"white-space: pre;\">	</span>Menerima Persyaratan lengkap</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">2.&nbsp; &nbsp; &nbsp;Mengagendakan dan memasukkan surat ke Sekretaris Dinas</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">3.&nbsp; &nbsp; &nbsp;Sekretaris Dinas Mendisposisi surat kepada Analis SDM Aparatur Muda</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">4.&nbsp; &nbsp; &nbsp;Membuatkan surat izin penelitian yang ditujukan kepada Lokus Penelitian</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">5.&nbsp; &nbsp; &nbsp;Penandatanganan surat oleh Skretaris Dinas</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><font color=\"#212529\" face=\"Open Sans, sans-serif\">6.&nbsp; &nbsp; &nbsp;Menyampaikan surat izin penelitian kepada pemohon&nbsp;</font></p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">&nbsp;<span style=\"font-weight: bolder;\">Produk&nbsp; &nbsp; :</span>&nbsp; Fasilitasi Izin Penelitian</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><span style=\"font-weight: bolder;\">Waktu Pelayanan<span style=\"white-space: pre;\">	</span>:&nbsp;</span>2&nbsp; Hari (Jika lengkap dan pejabat yang berwenang ditempat)</p><p open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\" style=\"color: rgb(33, 37, 41); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\"><span style=\"font-weight: bolder;\">Biaya/Tarif<span style=\"white-space: pre;\">	</span>:</span>&nbsp;Gratis</p>', 'default.png', '2021-06-02', 155, 0, 1, '', NULL, NULL, 1),
(6, 'IKU DISPORABUD Tahun 2021', 'iku-disporabud-tahun-2021', '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">Indikator kinerja utama atau&nbsp;</span><b style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">IKU</b><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 16px;\">&nbsp;adalah ukuran atau indikator kinerja suatu instansi, utamanya dalam mencapai tujuan dan sasaran tertentu. Setiap lembaga atau instansi pemerintah wajib merumuskan indikator kinerja utama, dan menjadikan hal itu sebagai prioritas utama.</span><br></p>', 'default.png', '2021-06-02', 231, 0, 1, '1622707876_b0c0282580f4b6491c83.pdf', NULL, NULL, 1),
(8, 'Surat Edaran Penyelenggaran Latihan di Masa Pandemi Covid 19', 'surat-edaran-penyelenggaran-latihan-di-masa-pandemi-covid-19', '  <p>Di informasikan untuk setiap pengurus cabang olahraga, untuk tetap mematuhi protokol kesehatan di masa covid 19. Surat lengkap dapat di unduh dibawah.<br></p>', '1649395987_d7a90790767459ee4818.jpg', '2021-06-04', 110, 1, 1, '', NULL, NULL, NULL),
(9, 'Sebaran Data Quisioner Online', 'sebaran-data-quisioner-online', '<p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: &quot;Titillium Web&quot;, Arial, sans-serif; vertical-align: baseline; text-align: justify; color: rgb(102, 102, 102);\">Sesuai surat dari DISPORABUD Kabupaten Lembata Nomor : 556/1737 tanggal 04 Juni 2021 perihal permintaan sebaran data Quisioner&nbsp; Online, dimohon kepada pengunjung Website DINPORAPAR Kabupaten Purbalingga untuk membantu&nbsp; proses penyebaran dan pengisian Quisioner online melalui Media sosial. Adapun tautan dari quisioner yang akan disebarkan :&nbsp;<span style=\"margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 600; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">bit/ly/siapberbagiwisatalagi.</span></p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 18px; line-height: inherit; font-family: &quot;Titillium Web&quot;, Arial, sans-serif; vertical-align: baseline; text-align: justify; color: rgb(102, 102, 102);\">atas kerjasama dari pengunjung website kami sampaikan terima kasih</p>', '1649395640_44f0761ca182d8e9a585.jpeg', '2021-06-04', 122, 1, 1, '', NULL, NULL, NULL),
(16, '7 Arahan Presiden', '7-arahan-presiden', '<p>Arahan Presiden</p>', '1701867407_6ceb278eb3b3f7f277fe.jpeg', '2023-12-06', 19, 1, 1, NULL, NULL, NULL, NULL),
(17, 'Ajakan Kibarkan Bendera', 'ajakan-kibarkan-bendera', '<p>Ayo Kibarkan Bendera<br></p>', '1701868341_ba40cc926a8cf305a8a3.jpeg', '2023-12-06', 32, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`, `slug_kategori`) VALUES
(0, 'Hal', 'Hal'),
(1, 'Berita Dinas', 'berita-dinas'),
(2, 'Artikel', 'artikel'),
(4, 'Olahraga', 'olahraga'),
(5, 'Inspirasi', 'inspirasi'),
(13, 'Internasional', 'internasional'),
(15, 'Teknologi Informasi', 'teknologi-informasi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_ebook`
--

CREATE TABLE `kategori_ebook` (
  `kategoriebook_id` int NOT NULL,
  `kategoriebook_nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategoriebook_slug` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_ebook`
--

INSERT INTO `kategori_ebook` (`kategoriebook_id`, `kategoriebook_nama`, `kategoriebook_slug`) VALUES
(1, 'Informasi Publik', 'Informasi-Publik'),
(3, 'Cerita Rakyat', 'Cerita-Rakyat');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_foto`
--

CREATE TABLE `kategori_foto` (
  `kategorifoto_id` int NOT NULL,
  `nama_kategori_foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_kategori_foto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cover_foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tgl_album` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_foto`
--

INSERT INTO `kategori_foto` (`kategorifoto_id`, `nama_kategori_foto`, `slug_kategori_foto`, `cover_foto`, `ket`, `tgl_album`) VALUES
(1, 'Kegiatan Rutin', 'kegiatan-rutin', '1642839147_51201b1afce8001fa5b4.jpg', 'Kegiatan rutin sehari-hari', '2021-05-13'),
(2, 'Bidang Pembangunan', 'bidang-pembangunan', '1642839500_bdf1ff9c580c1419927f.png', 'Kegiatan pembangunan', '2021-11-20'),
(6, 'Sistem Informasi Administrasi Desa (SIAD)', 'sistem-informasi-administrasi-desa-siad', '1639713786_09acbc84296386269b5e.png', 'Sistem informasi yang digunakan untuk membantu mengelola data penduduk, umum, pemerintahan, surat menyurat secara profesional.', '2021-11-12'),
(7, 'CMS ikasmedia', 'cms-ikasmedia', '1642820285_05c4c220a8cac10b434c.jpg', 'Berikut ini Content Management System CMS ikasmedia', '2022-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_video`
--

CREATE TABLE `kategori_video` (
  `kategorivideo_id` int NOT NULL,
  `nama_kategori_video` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_kategori_video` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_video`
--

INSERT INTO `kategori_video` (`kategorivideo_id`, `nama_kategori_video`, `slug_kategori_video`) VALUES
(1, 'Tutorial SIAD', 'Tutorial-SIAD'),
(9, 'Hiburan', 'Hiburan'),
(10, 'CMS ikasmedia', 'CMS-ikasmedia');

-- --------------------------------------------------------

--
-- Table structure for table `kritiksaran`
--

CREATE TABLE `kritiksaran` (
  `kritiksaran_id` int NOT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_kritik` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tanggal` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  `no_hpusr` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tgl_bls` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kritiksaran`
--

INSERT INTO `kritiksaran` (`kritiksaran_id`, `nama`, `email`, `judul`, `isi_kritik`, `tanggal`, `status`, `no_hpusr`, `balas`, `tgl_bls`) VALUES
(1, 'Vian Taum', 'viantaum17@gmail.com', 'Permintaan Informasi', 'Kapan akan dilakukan asistensi untuk semua perangkat desa?', '2022-07-21', 1, '6281353967028', 'Tangal 17 Agustus mendatang pak', '2025-03-08'),
(2, 'Desi Gili', 'disporabudkablembata@gmail.com', 'Pengaduan', 'Pelayanan kurang baik untuk beberapa perangkat. Mohon ditingkatkan pelayanannya.', '2022-07-21', 2, '0813538909821', 'Baik. Akan kami tindak lanjuti. Mohon maaf atas ketidaknyamanan nya klik disini untuk ke web cms ikasmedia', '2025-03-08'),
(6, 'Deril Taum', 'blakataduk@yahoo.co.id', 'Aspirasi', 'Mohon selalu update informasi data dinas ini, agar publik dapat mengikuti secara utuh perkembangan dinas ini terima kasih', '2024-07-09', 2, '081353967028', 'Baik terima kasih akan kami perhatikan.', '2025-03-08'),
(7, 'Fournet Juang', 'fournet@yahoo.co.id', 'Permintaan Informasi', 'Perhatikan layanannya', '2024-07-13', 2, '081353967028', 'xs', '2025-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `link_terkait`
--

CREATE TABLE `link_terkait` (
  `id_link` int NOT NULL,
  `nama_link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `utm` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link_terkait`
--

INSERT INTO `link_terkait` (`id_link`, `nama_link`, `url`, `gambar`, `status`, `utm`) VALUES
(1, 'ikasmedia Software', 'https://ikasmedia.net', '1695893274_a4d1a50db5a4c2839baa.png', 0, 1),
(2, 'OSS ', 'https://oss.go.id/', '1682579463_a43db32ae5ae81fc0a2f.png', 1, 1),
(3, 'PojokNesia', 'https://pojoknesia.com', '1658449167_7423522e5db112c0f0b3.png', 0, 1),
(5, 'Sicantik Cloud', 'https://sicantik.go.id/', '1682599955_a81d39f9d1c298801b4b.jpg', 0, 1),
(6, 'Kominfo', 'https://www.kominfo.go.id/', '1624851972_da31dfea25f48c80a51d.png', 1, 1),
(7, 'LAPOR.GO.ID', 'https://lapor.go.id', '1681902947_870056369b988232f4ff.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int NOT NULL,
  `nama_menu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `target` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `posisi` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `linkexternal` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stsmenu` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `nama_menu`, `menu_link`, `parent`, `icon`, `urutan`, `target`, `posisi`, `linkexternal`, `stsmenu`) VALUES
(1, 'HOME', '/', 'N', 'fas fa-home', 0, '_parent', '0', 'Y', 1),
(2, 'PROFIL', '#', 'Y', '', 1, '_parent', '0', '', 1),
(3, 'BERITA', 'berita', 'N', '', 2, '_parent', '0', 'N', 1),
(5, 'GALERI', '#', 'Y', '', 4, '_parent', '0', '', 1),
(6, 'INFORMASI', '#', 'Y', '', 3, '_parent', '0', '', 1),
(13, 'Redaksi', 'page/redaksi', NULL, '', 1, '_parent', '2', 'N', 1),
(14, 'Syarat & Kondisi', 'page/syarat-dan-kondisi', NULL, '', 2, '_parent', '2', 'N', 1),
(15, 'Peta Situs', 'petasitus', NULL, '', 3, '_parent', '2', 'N', 1),
(19, 'E-BOOK', 'ebook', 'N', 'mdi mdi-book-open-page-variant', 6, '_parent', '0', 'N', 1),
(21, 'INTERAKSI', '#', 'Y', 'fas fa-hands-helping', 5, '_parent', '0', 'N', 1),
(22, 'BERANDA', '/', NULL, 'fas fa-home', 1, '_parent', '1', 'Y', 1),
(23, 'PEGAWAI', 'pegawai', 'N', '', 2, '_parent', '1', 'N', 1),
(24, 'PROFIL DINAS', 'page/sejarah', 'N', '', 3, '_parent', '1', 'N', 1),
(25, 'TRANSPARANSI ANGGARAN', 'transparansi', NULL, '', 4, '_parent', '1', 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1613099987, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modalpopup`
--

CREATE TABLE `modalpopup` (
  `modalpopup_id` int NOT NULL,
  `judultawaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isitawaran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gbrtawaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linktawaran` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namatombol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_tombol` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modalpopup`
--

INSERT INTO `modalpopup` (`modalpopup_id`, `judultawaran`, `isitawaran`, `gbrtawaran`, `linktawaran`, `namatombol`, `sts_tombol`) VALUES
(1, 'CMS ikasmedia INFO', ' <div class=\"table-responsive\">\r\n    <table class=\"table table-bordered table-hover table-striped align-middle\">\r\n        <thead class=\"table-primary\">\r\n            <tr>\r\n                <th style=\"width: 120px;\">Versi</th>\r\n                <th>Catatan Pembaruan</th>\r\n            </tr>\r\n        </thead>\r\n        <tbody>\r\n            <tr>\r\n                <td><strong>5.2.0</strong> <span class=\"badge bg-success\">New</span></td>\r\n                <td>\r\n                    <ul class=\"mb-0\">\r\n                        <li>Kompresi gambar &amp; watermark otomatis di modul Berita untuk performa &amp; perlindungan konten.</li>\r\n                        <li>Penyesuaian nama field konfigurasi untuk hindari deteksi sebagai skrip berbahaya.</li>\r\n                        <li>Perbaikan bug pada modul Kritik &amp; Saran agar status publikasi tampil benar.</li>\r\n                        <li>Penambahan gaya font pada Tambah/Ubah Berita.</li>\r\n                        <li>Penyempurnaan modul UpdateCMS untuk kompatibilitas hosting.</li>\r\n                        <li>Bug fix &amp; optimalisasi untuk stabilitas dan pengalaman pengguna.</li>\r\n                    </ul>\r\n                </td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>5.1.0</strong></td>\r\n                <td>\r\n                    <ul class=\"mb-0\">\r\n                        <li>Penambahan fitur duplikasi konten halaman secara otomatis.</li>\r\n                        <li>Peningkatan keamanan inputan pengguna di form publik.</li>\r\n                        <li>Perbaikan minor pada tampilan dashboard responsif.</li>\r\n                    </ul>\r\n                </td>\r\n            </tr>\r\n            <tr>\r\n                <td><strong>5.0.0</strong></td>\r\n                <td>\r\n                    <ul class=\"mb-0\">\r\n                        <li>CMS full bundle menggunakan CodeIgniter 4.6.0.</li>\r\n                        <li>Peningkatan keamanan.</li>\r\n                        <li>Pembaruan Session ID saat login.</li>\r\n                        <li>URL login dapat diubah dinamis.</li>\r\n                        <li>Cegah kata sandi lemah.</li>\r\n                        <li>Akun hanya bisa login di satu perangkat.</li>\r\n                        <li>Statistik jumlah postingan.</li>\r\n                        <li>Login dengan OTP.</li>\r\n                        <li>Tampilan email lebih elegan.</li>\r\n                        <li>Tampilan form konfigurasi lebih menarik.</li>\r\n                        <li>Penambahan Field responden pada survei.</li>\r\n                        <li>Kunci pengisian survei (berulang/batas waktu).</li>\r\n                        <li>Update CMS otomatis (beta).</li>\r\n                        <li>Fix duplikasi kunjungan.</li>\r\n                        <li>Perubahan slug berita: <code>detail/judul-berita</code> → <code>judul-berita</code>.</li>\r\n                    </ul>\r\n                </td>\r\n            </tr>\r\n            <tr>\r\n                <td colspan=\"2\" class=\"text-center bg-light\">\r\n                    <strong class=\"text-primary\">ANDA DAPAT MENCOBA TEMA LAINNYA YANG TERSEDIA SESUAI SELERA</strong><br>\r\n                    <a href=\"https://ikasmedia.net/post/menerapkan-tema-pada-cms-ikasmedia\" class=\"btn btn-sm btn-outline-primary mt-2\">Klik di sini untuk panduannya</a><br><br>\r\n                    <span class=\"text-muted\">Informasi lengkap? Silakan hubungi kami melalui WhatsApp</span><br>\r\n                    <a href=\"https://wa.me/6281353967028\" target=\"_blank\" class=\"btn btn-sm btn-success mt-1\">\r\n                        <i class=\"bi bi-whatsapp\"></i> 081 353 967 028\r\n                    </a>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n</div>\r\n', '1690984941_bcf3035dfd026ccca23a.png', 'https://ikasmedia.net/kategori/cms-ikasmedia', 'Lihat Tema CMS ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int NOT NULL,
  `nip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `agama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pangkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `filetupoksi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `publikasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `penelitian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `pengabdian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `asal_s1` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asal_s2` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asal_s3` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang_pakar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio_singkat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `nip`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pangkat`, `jabatan`, `gambar`, `filetupoksi`, `publikasi`, `penelitian`, `pengabdian`, `asal_s1`, `asal_s2`, `asal_s3`, `bidang_pakar`, `bio_singkat`) VALUES
(67, '0912212', 'Budiman', 'Waikomo', '1985-03-20', 'L', 'Islam', 'II A', 'Kepala Bagian Hukum', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, '9912012', 'Wahyu Jatmiko', 'London', '1985-03-21', 'L', 'Islam', 'IIC', 'Kepala Bagian Komunikasi', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, '1929411', 'Vian Taum', 'Bukit', '1985-03-22', 'L', 'Katolik', 'III D', 'Staf', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, '8812012', 'Fournet Juang', 'Waikomo', '1985-03-23', 'P', 'Katolik', 'IV A', 'Staf', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, '2323232', 'Desi gili', 'Kupang', '1992-10-10', 'P', 'Katolik', 'IIA', 'Staf', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, '99230', 'Deril Taum', 'Lembata', '2011-05-16', 'L', 'Katolik', 'IIIA', 'Kepala Programmer', 'default.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poling`
--

CREATE TABLE `poling` (
  `poling_id` int NOT NULL,
  `pilihan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` int DEFAULT '0',
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Y',
  `id` int UNSIGNED DEFAULT NULL,
  `informasi_id` int UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poling`
--

INSERT INTO `poling` (`poling_id`, `pilihan`, `type`, `rating`, `status`, `id`, `informasi_id`) VALUES
(1, 'Bagaimanakah menurut Anda dengan Pelayanan dan Kinerja CMS ikasmedia ?', 'Pertanyaan', NULL, 'Y', 1, 0),
(2, 'Sangat Baik', 'Jawaban', 32, 'Y', 1, 0),
(3, 'Baik', 'Jawaban', 13, 'Y', 1, 0),
(4, 'Cukup Baik', 'Jawaban', 9, 'Y', 1, 0),
(6, 'Belum Tahu', 'Jawaban', 3, 'Y', 1, 0),
(25, 'Bagaimanakah menurut Anda tentang layanan IKU DISPORABUD Tahun 2021', 'Pertanyaan', 0, 'Y', 1, 6),
(26, 'Sangat Baik', 'Jawaban', 0, 'Y', 1, 6),
(27, 'Baik', 'Jawaban', 0, 'Y', 1, 6),
(28, 'Cukup Baik', 'Jawaban', 0, 'Y', 1, 6),
(29, 'Belum Tahu', 'Jawaban', 0, 'Y', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `produk_hukum`
--

CREATE TABLE `produk_hukum` (
  `produk_id` int NOT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_hukum`
--

INSERT INTO `produk_hukum` (`produk_id`, `id`, `nama_produk`) VALUES
(8, 1, 'UNDANG-UNDANG'),
(9, 1, 'PERATURAN GUBERNUR'),
(10, 1, 'PERATURAN DAERAH');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kathukum`
--

CREATE TABLE `produk_kathukum` (
  `kathukum_id` int NOT NULL,
  `produk_id` int DEFAULT NULL,
  `nama_kathukum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_kathukum` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_kathukum` date DEFAULT NULL,
  `status_kathukum` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '0=tidak aktif 1=aktif',
  `skathukum` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '1=lanjut, 0=tidaklanjut',
  `hits` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_kathukum`
--

INSERT INTO `produk_kathukum` (`kathukum_id`, `produk_id`, `nama_kathukum`, `file_kathukum`, `tanggal_kathukum`, `status_kathukum`, `skathukum`, `hits`) VALUES
(22, 8, 'UNDANG-UNDANG KEARSIPAN', '-', '2022-01-26', '1', '1', 0),
(23, 9, 'Pergub Perpustakaan 13 Tahun 2019', '1643183596_597406ee73d127728042.pdf', '2022-01-26', '1', '0', 0),
(24, 8, 'UNDANG-UNDANG KOMUNIKASI', '-', '2022-01-26', '1', '1', 0),
(25, 10, 'Perda Perpustakaan 12 Tahun 2019', '1643185291_d7fc0936dcfa6805ea8b.txt', '2022-01-26', '1', '0', 0),
(26, 10, 'Perda Kearsipan 2021', '1643185324_ad098a596cdf6315a73d.txt', '2022-01-26', '1', '0', 0),
(27, 10, 'Perda 2', NULL, '2023-06-05', '1', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_subkathukum`
--

CREATE TABLE `produk_subkathukum` (
  `subkathukum_id` int NOT NULL,
  `kathukum_id` int DEFAULT NULL,
  `nama_subkathukum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_subkathukum` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_subkathukum` date DEFAULT NULL,
  `status_subkathukum` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hits` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_subkathukum`
--

INSERT INTO `produk_subkathukum` (`subkathukum_id`, `kathukum_id`, `nama_subkathukum`, `file_subkathukum`, `tanggal_subkathukum`, `status_subkathukum`, `hits`) VALUES
(15, 22, 'Undang-undang kearsipan no 22', '1643162886_fd2dc6ea89a708c17fc3.pdf', '2022-01-26', '1', NULL),
(16, 22, 'Undang -Undang No 30', '1643184229_2f4a6da77bc16aa72b22.txt', '2022-01-26', '1', NULL),
(17, 22, 'Undang-undang no 50', '1643184306_278b6dfaa0d49f5ae9d8.txt', '2022-01-26', '1', NULL),
(18, 24, 'Undang-undang Komunikasi no 1', '1643184455_f6f959e514f55a33607e.txt', '2022-01-26', '1', NULL),
(19, 27, 'Isi Perda 2', '1719237341_2bf55e07f806e7c37f84.png', '2023-06-05', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int NOT NULL,
  `nama_section` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linksumber` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jns` tinyint DEFAULT '0',
  `template_id` int DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `isi_script` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `nama_section`, `gambar`, `link`, `linksumber`, `jns`, `template_id`, `urutan`, `isi_script`, `deskripsi`) VALUES
(1, 'LAYANAN', '1655792214_70107ab76c42da98cef0.png', 'layanan', 'N', 0, NULL, NULL, NULL, NULL),
(2, 'SURVEI', '1655792202_eca61b1640dcdda50be4.png', 'survey', 'N', 0, NULL, NULL, NULL, NULL),
(3, 'AGENDA', '1655791207_4c583efb71366983ae12.png', 'agenda', 'N', 0, NULL, NULL, NULL, NULL),
(4, 'BANK DATA', '1655791375_bed701f9e766b52f59ac.png', 'bankdata', 'N', 0, NULL, NULL, NULL, NULL),
(5, 'PEGAWAI', '1655791791_3724d6d86a2f9576a145.png', 'pegawai', 'N', 0, NULL, NULL, NULL, NULL),
(6, 'STRUKTUR', '1655791700_3a9c6901c6da15da8cb0.png', 'page/struktur-organisasi', 'N', 0, NULL, NULL, NULL, NULL),
(7, 'VISI MISI', '1655791541_d700245f9a864657be9d.png', 'page/visi-dan-misi', 'N', 0, NULL, NULL, NULL, NULL),
(8, 'ikasmedia', '1655791598_484fe526227a4618c477.png', 'https://ikasmedia.net', 'Y', 0, NULL, NULL, NULL, NULL),
(17, 'Visi dan Misi', '1721050317_f9a529d7df21b8333d9f.png', NULL, NULL, 1, 14, 1, '   <h3>Visi Layanan</h3>\r\n                        <p class=\"fst-italic\">\r\n                            Terwujudnya layanan Pendidikan yang bermutu.\r\n                        </p>\r\n\r\n                        <h3>Misi Layanan</h3>\r\n                        <ul>\r\n                            <li><i class=\"bi bi-check-circle-fill\"></i> Meningkatkan keterjangkauan dan perluasan Layanan Pendidikan yang bermutu dan paripurna.</li>\r\n                            <li><i class=\"bi bi-check-circle-fill\"></i> Meningkatkan keterjangkauan dan perluasan Layanan Pendidikan yang paripurna.</li>\r\n                            <li><i class=\"bi bi-check-circle-fill\"></i> Meningkatkan Sumber Daya Aparatur yang membidangi pelayanan.</li>\r\n                        </ul>\r\n', 0),
(18, 'Survei Kepuasan', '1721051608_d45ce46c72da0e53e1f5.jpg', NULL, NULL, 1, 14, 3, '     <h3>Survei <em>Kepuasan</em> Masyarakat</h3>\r\n                            <p> Isi survei kepuasan masyarakat terkait pandangan Anda, terhadap pelayanan di lingkungan <!--?= $konfigurasi--->Dinas Kami&nbsp;<em>cukup 2 menit</em> melalui tombol dibawah.</p>\r\n                          \r\n                            <div class=\"vid-youtube align-self-start mt-1 pb-3\">\r\n                                <div class=\"text-center text-lg d-inline-flex align-items-center justify-content-center align-self-center\">\r\n                                    <a href=\"survey\" target=\"_blank\" class=\"btn-read-more d-inline-flex align-items-center justify-content-center align-self-center\">\r\n                                        <span>Klik untuk menuju survei</span>\r\n                                        <i class=\"bi bi-arrow-right\"></i>\r\n                                    </a>\r\n                                </div>\r\n                            </div>', 0),
(19, 'Moto Pelayanan', NULL, NULL, NULL, 1, 14, 2, '    <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>C</h4>\r\n                        </div>\r\n                        <p>Cermat, Cepat dan Tepat</p>\r\n\r\n                        <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>E</h4>\r\n                        </div>\r\n                        <p>Efektif dan Efisien</p>\r\n\r\n                        <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>R</h4>\r\n                        </div>\r\n                        <p>Ramah</p>\r\n\r\n                        <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>D</h4>\r\n                        </div>\r\n                        <p>Dedikasi Tinggi</p>\r\n\r\n                        <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>A</h4>\r\n                        </div>\r\n                        <p>Amanah</p>\r\n\r\n                        <div class=\"d-flex align-items-center mt-4\">\r\n                            <i class=\"bi bi-check2\"></i>\r\n                            <h4>S</h4>\r\n                        </div>\r\n                        <p>Senyum, Salam, Sapa, Sopan dan Santun</p>', 0),
(20, 'Jadwal Kerja', NULL, NULL, NULL, 1, 14, 4, ' <div class=\"p-2 mt-3 d-flex justify-content-between rounded jadwalkerja\">\r\n                                <div class=\"d-flex flex-column\"> <span class=\"followers\">Senin - Kamis</span> <span class=\"number1\">07.30 - 16.20</span> </div>\r\n                                <div class=\"d-flex flex-column\"> <span class=\"followers\">Jumad</span> <span class=\"number2\">07.00 - 14.30</span> </div>\r\n                            </div>', 0),
(21, 'Beranda 1 - Perhitungan', NULL, NULL, NULL, 1, 5, 1, ' <div class=\"col-lg-2 col-12 p-1\">\r\n                <div class=\"counter purple\">\r\n                    <div class=\"counter-icon\">\r\n                        <i class=\"fas fa-user-friends \"></i>\r\n                    </div>\r\n                    <div class=\"counter-content\">\r\n                        <h3>Total Jiwa</h3>\r\n                        <span class=\"counter-value\">1223</span>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-2 col-12 p-1\">\r\n                <div class=\"counter red\">\r\n                    <div class=\"counter-icon\">\r\n                        <i class=\"fas fa-users\"></i>\r\n                    </div>\r\n                    <div class=\"counter-content\">\r\n                        <h3>Jumlah KK </h3>\r\n                        <span class=\"counter-value\">679</span>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-2 col-12 p-1\">\r\n                <div class=\"counter blue\">\r\n                    <div class=\"counter-icon\">\r\n                        <i class=\"fas fa-map-signs \"></i>\r\n                    </div>\r\n                    <div class=\"counter-content\">\r\n                        <h3>Jml Desa</h3>\r\n                        <span class=\"counter-value\">120</span></div>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-2 col-12 p-1\">\r\n                <div class=\"counter grey\">\r\n                    <div class=\"counter-icon\">\r\n                        <i class=\"fas fa-map \"></i>\r\n                    </div>\r\n                    <div class=\"counter-content\">\r\n                        <h3>Luas Wilayah</h3>\r\n                        <span class=\"counter-value\">2256 </span><small> Km2</small>\r\n                    </div>\r\n                </div>\r\n            </div>', 0),
(22, 'Jadwal Kerja', NULL, NULL, NULL, 1, 5, 2, ' <div class=\"d-flex flex-column\"> <span class=\"articles\">Buka</span> <span class=\"number1\">08.30</span> </div>\r\n                                    <div class=\"d-flex flex-column\"> <span class=\"followers\">Tutup</span> <span class=\"number2\">15.30 </span> </div>\r\n                                    <div class=\"d-flex flex-column\"> <span class=\"rating\">Libur</span> <span class=\"number3\"><small><font color=\"#ff0000\">Sabtu-Minggu</font></small></span> </div>', 0),
(23, 'Jadwal Kerja', NULL, NULL, NULL, 1, 4, 1, '<div class=\"jadwal-doa__tanggal\">\r\n                        <span>Jadwal</span>\r\n                        <small>Kerja</small>\r\n                    </div>\r\n                    <div class=\"jadwal-doa__waktu\">\r\n                        <small>Masuk </small>\r\n                        <span class=\"fajr\">08.00</span>\r\n                    </div>\r\n                    <div class=\"jadwal-doa__waktu\">\r\n                        <small>Tutup</small>\r\n                        <span class=\"dhuhr\">13.00</span>\r\n                    </div>\r\n                    <div class=\"jadwal-doa__waktu\">\r\n                        <small>Libur</small>\r\n                        <span class=\"asr\"><font color=\"#ff0000\">Minggu </font></span>\r\n                    </div>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `submenu_id` int NOT NULL,
  `menu_id` int DEFAULT NULL,
  `nama_submenu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_submenu` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iconsm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urutansm` int DEFAULT NULL,
  `targetsm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkexternalsm` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stssubmenu` int NOT NULL DEFAULT '1',
  `parentsm` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `menu_id`, `nama_submenu`, `link_submenu`, `iconsm`, `urutansm`, `targetsm`, `linkexternalsm`, `stssubmenu`, `parentsm`) VALUES
(1, 2, 'Visi dan Misi', 'page/visi-dan-misi', 'far fa-clone', 0, '_parent', 'N', 1, 'N'),
(2, 2, 'Struktur Organisasi', 'page/struktur-organisasi', 'fa fa-users', 1, '_parent', 'N', 1, 'N'),
(3, 2, 'Data Pegawai', 'pegawai', 'fas fa-user-tie', 3, '_parent', 'N', 1, 'N'),
(4, 5, 'Foto', 'foto', 'far fa-image', 1, '_parent', 'N', 1, 'N'),
(5, 5, 'Video', 'video', 'fas fa-video', 2, '_parent', 'N', 1, 'N'),
(6, 6, 'Layanan', 'layanan', 'fas fa-chalkboard-teacher', 1, '_parent', 'N', 1, 'N'),
(7, 6, 'Pengumuman', 'pengumuman', 'fas fa-bullhorn', 2, '_parent', 'N', 1, 'N'),
(8, 6, 'Agenda', 'agenda', 'far fa-calendar-check', 3, '_parent', 'N', 1, 'N'),
(9, 6, 'Bank Data', 'bankdata', 'fas fa-database', 4, '_parent', 'N', 1, 'N'),
(10, 2, 'Tugas Pokok dan Fungsi', 'page/tugas-pokok-dan-fungsi', 'far fa-list-alt', 2, '_parent', 'N', 1, 'N'),
(13, 6, 'Produk Hukum', 'produkhukum', 'fa fa-balance-scale', 5, '_parent', 'N', 1, 'N'),
(14, 6, 'Infografis', 'infografis', 'far fa-images', 6, '_parent', 'N', 1, 'N'),
(16, 21, 'Survei', 'survey', 'far fa-check-square', 1, '_parent', 'N', 1, 'N'),
(17, 21, 'Buku Tamu', 'bukutamu', 'far fa-comment-alt', 3, '_parent', 'N', 1, 'N'),
(19, 6, 'Transparansi Anggaran', 'transparansi', 'fas fa-chart-pie', 7, '_parent', 'N', 1, 'N'),
(20, 21, 'Masukan Saran', 'masukansaran', 'far fa-comments', 2, '_parent', 'N', 1, 'N'),
(21, 6, 'Informasi Berkala', '#', 'fas fa-expand', 8, '_parent', 'Y', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `subsubmenu`
--

CREATE TABLE `subsubmenu` (
  `subsubmenu_id` int NOT NULL,
  `submenu_id` int DEFAULT NULL,
  `nama_subsubmenu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_subsubmenu` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iconssm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urutanssm` int DEFAULT NULL,
  `targetssm` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkexternalssm` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stsssm` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subsubmenu`
--

INSERT INTO `subsubmenu` (`subsubmenu_id`, `submenu_id`, `nama_subsubmenu`, `link_subsubmenu`, `iconssm`, `urutanssm`, `targetssm`, `linkexternalssm`, `stsssm`) VALUES
(1, 21, 'Daftar Informasi Publik', 'page/rpjpd', 'fas fa-sticky-note', 1, '_parent', 'N', '1'),
(2, 21, 'Rencana Strategis', 'page/rencana-strategis', 'far fa-sticky-note', 2, '_parent', 'N', '1');

-- --------------------------------------------------------

--
-- Table structure for table `survey_jawaban`
--

CREATE TABLE `survey_jawaban` (
  `jawaban_id` int NOT NULL,
  `pertanyaan_id` int DEFAULT NULL,
  `jawaban` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nilai` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_jawaban`
--

INSERT INTO `survey_jawaban` (`jawaban_id`, `pertanyaan_id`, `jawaban`, `nilai`) VALUES
(1, 3, 'Tidak sesuai', 1),
(2, 3, 'Kurang sesuai', 2),
(3, 3, 'Sesuai', 3),
(6, 3, 'Sangat Sesuai', 4),
(7, 4, 'Tidak Mudah', 1),
(8, 4, 'Kurang Mudah', 2),
(9, 4, 'Mudah', 3),
(10, 4, 'Sangat Mudah', 4),
(11, 5, 'Tidak Tepat Waktu', 1),
(12, 5, 'Kadang Tepat waktu', 2),
(13, 5, 'Banyak Tepat Waktu', 3),
(14, 5, 'Selalu Tepat Waktu', 4),
(15, 6, 'Sangat Mahal', 1),
(16, 6, 'Cukup Mahal', 2),
(17, 6, 'Murah', 3),
(18, 6, 'Gratis', 4),
(19, 7, 'Tidak Sesuai', 1),
(20, 7, 'Kadang Sesuai', 2),
(21, 7, 'Sesuai', 3),
(22, 7, 'Sangat Sesuai', 4),
(23, 8, 'Tidak Mampu', 1),
(24, 8, 'Kurang Mampu', 2),
(25, 8, 'Mampu', 3),
(26, 8, 'Sangat Mampu', 4),
(27, 9, 'Tidak Baik', 1),
(28, 9, 'Kurang Baik', 2),
(29, 9, 'Baik', 3),
(30, 9, 'Sangat Baik', 4),
(31, 10, 'Tidak Sesuai', 1),
(32, 10, 'Kurang Sesuai', 2),
(33, 10, 'Sesuai', 3),
(34, 10, 'Sangat Sesuai', 4),
(35, 11, 'Tidak Sopan dan Ramah', 1),
(36, 11, 'Kurang Sopan dan Ramah', 2),
(37, 11, 'Sopan dan Ramah', 3),
(38, 11, 'Sangat Sopan dan Ramah', 4);

-- --------------------------------------------------------

--
-- Table structure for table `survey_pertanyaan`
--

CREATE TABLE `survey_pertanyaan` (
  `pertanyaan_id` int NOT NULL,
  `survey_id` int DEFAULT NULL,
  `pertanyaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_pertanyaan`
--

INSERT INTO `survey_pertanyaan` (`pertanyaan_id`, `survey_id`, `pertanyaan`, `status`) VALUES
(3, 1, 'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya', '1'),
(4, 1, 'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini.', '1'),
(5, 1, 'Bagaimana pendapat saudara tentang kecepatan pelayanan di unit ini', '1'),
(6, 1, 'Bagaimana pendapat saudara tentang kewajaran biaya / tarif dalam pelayanan', '1'),
(7, 1, 'Bagaimana pendapat saudara tentang kesesuaian hasil pelayanan yang diberikan dan diterima dengan waktu yang ditetapkan', '1'),
(8, 1, 'Bagaimana pendapat saudara tentang kemampuan petugas dalam memberi pelayanan', '1'),
(9, 1, 'Bagaimana pendapat saudara tentang penanganan pengaduan,saran dan masukan pelayanan yang diberikan', '1'),
(10, 1, 'Bagaimana pendapat saudara tentang sarana dan prasarana yang digunakan dalam pelayanan', '1'),
(11, 1, 'Bagaimana pendapat saudara tentang perilaku petugas dalam pelayanan terkait kesopanan dan keramahan', '1');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responden`
--

CREATE TABLE `survey_responden` (
  `responden_id` int NOT NULL,
  `survey_id` int DEFAULT NULL,
  `nohp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tanggal` date DEFAULT NULL,
  `jpoin` int NOT NULL DEFAULT '0',
  `usia` int DEFAULT NULL,
  `jk` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_pendidikan` int DEFAULT NULL,
  `id_pekerjaan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_responden`
--

INSERT INTO `survey_responden` (`responden_id`, `survey_id`, `nohp`, `nama`, `saran`, `tanggal`, `jpoin`, `usia`, `jk`, `id_pendidikan`, `id_pekerjaan`) VALUES
(10, 1, '08328732', 'Deril 1', 'Ini jawab 1', '2024-11-22', 28, 4, 'L', 10, 18),
(11, 1, '08328732', 'Deril 2', 'Tes kedua', '2024-11-22', 29, 7, 'L', 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `survey_topik`
--

CREATE TABLE `survey_topik` (
  `survey_id` int NOT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `nama_survey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hits` int DEFAULT '0',
  `skor` int DEFAULT '0',
  `r1_stb` int DEFAULT '0',
  `r2_stb` int DEFAULT '0',
  `r1_kb` int DEFAULT '0',
  `r2_kb` int DEFAULT '0',
  `r1_b` int DEFAULT '0',
  `r2_b` int DEFAULT '0',
  `r1_sb` int DEFAULT '0',
  `r2_sb` int DEFAULT '0',
  `ket_stb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket_kb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket_b` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket_sb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lockisi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_topik`
--

INSERT INTO `survey_topik` (`survey_id`, `id`, `nama_survey`, `status`, `hits`, `skor`, `r1_stb`, `r2_stb`, `r1_kb`, `r2_kb`, `r1_b`, `r2_b`, `r1_sb`, `r2_sb`, `ket_stb`, `ket_kb`, `ket_b`, `ket_sb`, `lockisi`) VALUES
(1, 1, 'Quisioner Survei Kepuasan Pelayanan Masyarakat', '1', 12, 57, 9, 17, 18, 26, 27, 35, 36, 100, 'Sangat Tidak Baik', 'Kurang Baik', 'Baik', 'Sangat Baik', 0),
(3, 1, 'Bagaimana dengan layanan yang diberikan oleh dinas kami', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Sangat kurang', 'Kurang Baik', 'Baik', 'Sangat baik', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int NOT NULL,
  `nama_tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug_tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `nama_tag`, `slug_tag`) VALUES
(1, 'Olahraga', 'olahraga'),
(2, 'Atlet', 'atlet'),
(3, 'Lembata', 'lembata'),
(5, 'Taekwondo', 'taekwondo'),
(6, 'Teknologi', 'teknologi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id_banner` int NOT NULL,
  `banner_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `posisi` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id_banner`, `banner_image`, `ket`, `type`, `link`, `posisi`) VALUES
(1, '1638761650_69a7e858b593cba59fb4.jpg', 'Pesan Presiden RI Jokowi, saat pembukaan HAORNAS ke- 37 pada 9 September lalu', 1, NULL, NULL),
(2, '1638761743_e37a26ddd2b4a5be19c4.jpeg', 'Kembangkan Sistem dan big data analytic', 1, NULL, NULL),
(3, '1638761689_1ee8af85c9b1b4f8ee5b.jpeg', 'Olahraga bukan hanya urusan individu', 1, NULL, NULL),
(4, '1638761583_c0d10721fde79e3224a5.jpg', 'Olahraga adalah ibadah', 1, NULL, NULL),
(5, '1638761953_37739d0da03652bb60cd.png', 'Ekonomi Digital Untuk Indonesia Lebih Sejahtera', 1, NULL, NULL),
(6, '1638761531_e0124927df005023b977.jpeg', 'Tumbuh Kembang Anak Media Digital', 1, NULL, NULL),
(7, '1666836763_7199eae813fcf44003c1.jpg', 'Manfaat Teknologi Digital bagi Pendidikan Anak', 1, NULL, NULL),
(8, '1649471939_1b1b743dd4ff22cebac8.jpg', 'Dapatkan full source code', 0, 'transparansi', NULL),
(9, '1666836591_a7f275b099bba1f337dc.png', 'Efek Negatif Teknologi Digital pada Anak', 1, NULL, NULL),
(10, '1649379662_4130ce3d17b3e0031b50.jpg', 'CMS ikasmedia', 0, 'detail/lantik-karo-perencanaan-dan-organisasi-ini-pesan-menpora-amali', NULL),
(11, '1649471872_526b659c1c96104221d0.jpg', 'Banner New', 0, 'survey', NULL),
(14, '1658642029_3da19d397e07fd8c975c.jpeg', 'Tetap Terapkan Protokol Kesehatan', 2, 'http://cms.ikasmedia.net', '1'),
(15, '1698764589_70f99285a1d3b4b0a43a.jpg', 'Selamat Hari Pancasila Tahun 2022', 2, '#', '1'),
(16, '1721109208_fe1fb80eb76970227f87.jpg', 'Maklumat Layanan', 2, 'http://cms.ikasmedia.net', '2'),
(17, '1666587280_0cef4b8a5570755da611.jpg', 'Stop Gratifikasi', 2, 'http://cms.ikasmedia.net', '3'),
(31, '1698764451_47333064c15c2e7399c1.jpg', 'Ads Google', 2, 'https://cms.ikasmedia.net', '3'),
(34, '1705375012_f17a4a2afdd39b320be1.jpg', 'Bagian Kanan', 2, 'https://cms.ikasmedia.net', '4'),
(35, '1705378348_0d28d5432e9530b5c467.jpg', 'Portal layanan 2', 2, 'https://ikasmedia.net', '4'),
(36, '1725855336_f5ebdac3ce4c9b56ffe4.jpeg', 'Iklan Kiri', 2, 'https://cms.ikasmedia.net', '2'),
(38, '1741002043_5041ef0b3ef4c49aa65d.jpg', 'Dapatkan full source code Asli ', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setaplikasi`
--

CREATE TABLE `tbl_setaplikasi` (
  `id_setaplikasi` int NOT NULL,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_telp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kecamatan` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kabupaten` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `logo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_sambutan` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `nama_pimpinan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_pimpinan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sambutan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gbr_sambutan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_gmap` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sosmed_fb` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sosmed_instagram` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sosmed_twiter` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sosmed_youtube` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori_id` int DEFAULT NULL,
  `judul_section` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_section` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_modal` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ck` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_count` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_rt` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_regis` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_web` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sts_posting` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '0=langsung aktif\r\n1=verifikasi admin',
  `mail_host` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mail_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_pass` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `smtp_port` int DEFAULT NULL,
  `smtp_pengirim` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtp_pesanbalas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `g_sitekey` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `vercms` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verdb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `konek_opd` tinyint(1) DEFAULT '0',
  `id_grup` int DEFAULT '3',
  `footer_cms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ukuran_upload` int DEFAULT NULL,
  `wa_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `wa_sender_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `wa_receiver` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `katamutiara` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `namasingkat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urlserver` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_maintenance` tinyint(1) DEFAULT '0',
  `otp_akses` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_setaplikasi`
--

INSERT INTO `tbl_setaplikasi` (`id_setaplikasi`, `nama`, `alamat`, `no_telp`, `kecamatan`, `kabupaten`, `provinsi`, `website`, `email`, `deskripsi`, `logo`, `sts_sambutan`, `icon`, `google_map`, `nama_pimpinan`, `jabatan_pimpinan`, `sambutan`, `gbr_sambutan`, `link_gmap`, `sosmed_fb`, `sosmed_instagram`, `sosmed_twiter`, `sosmed_youtube`, `kategori_id`, `judul_section`, `sts_section`, `sts_modal`, `ck`, `sts_count`, `sts_rt`, `sts_regis`, `sts_web`, `sts_posting`, `mail_host`, `mail_user`, `smtp_pass`, `smtp_port`, `smtp_pengirim`, `smtp_pesanbalas`, `g_sitekey`, `google_secret`, `vercms`, `verdb`, `konek_opd`, `id_grup`, `footer_cms`, `ukuran_upload`, `wa_token`, `wa_sender_number`, `wa_receiver`, `katamutiara`, `namasingkat`, `urlserver`, `is_maintenance`, `otp_akses`) VALUES
(1, 'Content Management System (CMS) ikasmedia', 'Jln. RS Bukit - Lembata Waikomo', '+6281353967028', 'cms-login', 'Lembata', 'Nusa Tenggara Timur', 'https://cms.ikasmedia.net/', 'layanan@ikasmedia.net', 'Content Management System (CMS) ikasmedia dibuat khusus untuk situs pemerintahan, yayasan, sekolah, company profile dan lain-lain. CMS ini dibangun dengan Framework Codeigniter Versi 4.5.5 dan akan terus diupdate.', 'p2.png', '1', '1695875015_e24e1d3978f1bd000b20.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31577.350186403717!2d123.3909895718859!3d-8.38505492086326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dab731d6607bd57%3A0xe9072c1a3368c33b!2sikasmedia!5e0!3m2!1sid!2sid!4v1681788486436!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Deri Taum, S.Kom', 'Kepala Dinas', '                              <p class=\"MsoNormal\"><span open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14.56px;=\"\" text-align:=\"\" center;\"=\"\" style=\"color: rgb(80, 93, 105); font-family: Nunito, sans-serif; font-size: 14.56px;\">Selamat datang di Website kami Dinas Pemuda Olahraga dan Kebudayaan Kabupaten Lembata, Website ini dimaksudkan sebagai sarana publikasi untuk memberikan Informasi dan gambaran Dinas Pemuda Olahraga dan Kebudayaan Kabupaten Lembata dalam Hal Publikasi kepada masyarakat. Melalui keberadaan website ini kiranya masyarakat dapat mengetahui seluruh informasi tentang Kebijakan Pemerintah Kabupaten Lembata pengelolaan sektor Kepemudaan dan Keolahragaan di wilayah Pemerintahan Kabupaten Lembata.&nbsp;</span><span open=\"\" \",=\"\" sans-serif;=\"\" font-size:=\"\" 14.56px;=\"\" text-align:=\"\" \"=\"\" sans\",=\"\" center;\"=\"\" style=\"color: rgb(80, 93, 105); font-family: Nunito, sans-serif; font-size: 14.56px; border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235);\">Diharapkan website ini bisa dijadikan sebagai salah satu media komunikasi yang efektif, dapat memberi</span><span style=\"font-size: 16px;\">﻿</span><span open=\"\" \",=\"\" sans-serif;=\"\" font-size:=\"\" 14.56px;=\"\" text-align:=\"\" \"=\"\" sans\",=\"\" center;\"=\"\" style=\"color: rgb(80, 93, 105); font-family: Nunito, sans-serif; font-size: 14.56px; border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235);\">kan informasi, layanan yang akurat dan akuntabel untuk membangun&nbsp;<span lang=\"EN-US\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235);\">olahraga</span>&nbsp;di Kabupaten&nbsp;<span lang=\"EN-US\" style=\"border-width: 0px; border-style: solid; border-color: rgb(229, 231, 235);\">Lembata</span>.&nbsp;</span></p><p class=\"MsoNormal\"><span open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 14.56px;=\"\" text-align:=\"\" center;\"=\"\" style=\"color: rgb(80, 93, 105); font-family: Nunito, sans-serif; font-size: 14.56px;\">Dan sebagai wujud rasa tanggungjawab kami dalam rangka meningkatkan pelayanan kepada masyarakat, maka kami adakan website dinas ini. Kritik dan saran terhadap kekurangan dan kesalahan yang ada sangat kami harapkan guna penyempurnaan Website ini dimasa akan datang. Semoga Website ini memberikan manfaat bagi kita semua. Terima Kasih..!x</span></p>', '1666974119_e6c4ee83f9e5204955fe.png', 'https://goo.gl/maps/QVtSNqKmgkHTBUCN8', 'https://www.facebook.com/ikasmedia', 'https://instagram.com/ikasmedia', 'http://twitter.com/ikasmedia', 'https://www.youtube.com/c/ikasmedia', 1, 'INFORMASI INSTANSI', '1', '1', '1', '1', '1', '1', '1', '1', 'smtp.hostinger.com', 'layanan@ikasmedia.net', 'xxxxx', 465, 'CMS ikasmedia', 'Terima Kasih telah menghubungi kami..!', '', '', '5.2.0', '2.2', 1, 3, 'Dikembangkan Oleh <a href=\"https://ikasmedia.net\" target=\"_blank\"> ikasmedia Software </a>', NULL, '', '', '', '“Mewujudkan Kabupaten Lembata sebagai <i style=\"color:#AC0C0C;\">kota budaya</i> yang Modern, Tangguh, Gesit, Kreatif dan Sejahtera” ', 'CMS ikasmedia', 'https://waysender-v2.ridped.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `template_id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pembuat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `folder` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `id` int UNSIGNED NOT NULL,
  `ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jtema` int NOT NULL DEFAULT '1',
  `hplogo` int NOT NULL,
  `wllogo` int NOT NULL,
  `hpbanner` int NOT NULL,
  `wlbanner` int NOT NULL,
  `verbost` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `duatema` int NOT NULL DEFAULT '0',
  `warna_topbar` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '2378b4',
  `sidebar_mode` int DEFAULT '0',
  `video_bag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`template_id`, `nama`, `pembuat`, `folder`, `status`, `id`, `ket`, `img`, `jtema`, `hplogo`, `wllogo`, `hpbanner`, `wlbanner`, `verbost`, `duatema`, `warna_topbar`, `sidebar_mode`, `video_bag`) VALUES
(1, 'Web PLUS 1', 'ikasmedia', 'plus1', 0, 1, 'Tema PLUS 1', '1664432678_54cd12a3ae164bb4b421.jpg', 1, 121, 112, 600, 1800, '0', 0, '-', 0, NULL),
(2, 'Web PLUS 2', 'ikasmedia', 'plus2', 0, 1, 'Ukuran logo : Tinggi 90px Lebar 375px', '1664432530_bf187694af6636360050.jpg', 1, 90, 375, 600, 1800, '0', 0, '-', 0, NULL),
(3, 'PLUS 3', 'ikasmedia', 'plus3', 0, 1, 'Template Dengan Konsep Plus 2', '1667354397_77e368dcd334194f9b45.jpg', 1, 90, 375, 600, 1800, '0', 0, '-', 0, NULL),
(4, 'YASBIN', 'ikasmedia', 'yayasan', 0, 1, 'Template Yayasan Binawirawan Lembata', '1664434780_4d872cf84036ae0d7c68.jpg', 1, 121, 112, 600, 1800, '0', 0, '-', 0, NULL),
(5, 'Tema Desa', 'ikasmedia', 'desaku', 1, 1, 'Template Web Desa', '1664449596_014062b9dfa62802af5d.jpg', 1, 90, 375, 600, 1800, '1', 0, '-', 0, NULL),
(6, 'Company Profile', 'ikasmedia', 'company', 0, 1, 'Template Company', '1664435795_ae53f2bd19069129b9a7.jpg', 1, 90, 375, 600, 1800, '1', 0, '-', 0, NULL),
(7, 'Web Perijinan', 'ikasmedia', 'perijinan', 0, 1, 'Tema dengan Satu Halaman', 'default.png', 1, 60, 309, 600, 1800, '1', 0, '-', 0, NULL),
(9, 'Web BASIC', 'ikasmedia', 'basic', 0, 1, 'Ukuran logo : Tinggi 55px Lebar 255px', '1664433609_1aaa4f7447ef765011be.jpg', 1, 55, 255, 600, 1800, '0', 0, '-', 0, NULL),
(10, 'Template P4', 'ikasmedia', 'plus4', 0, 1, 'Tema Plus 4', 'default.png', 1, 45, 255, 1080, 1920, '1', 0, '-', 0, NULL),
(11, 'Dashboard Standar', 'ikasmedia', 'standar', 0, 1, 'Tema Admin Standar CMS ikasmedia', 'default.png', 0, 0, 0, 0, 0, '0', 0, '#365d93', 0, NULL),
(14, 'HeroBiz', 'Template Hero', 'herobiz', 0, 1, 'Web Perpustakaan', 'default.png', 1, 55, 255, 600, 1800, '1', 0, '-', 0, NULL),
(15, 'PLN', 'ikasmedia', 'pln', 0, 1, '', 'default.png', 1, 67, 280, 1112, 3840, '0', 0, '-', 0, NULL),
(16, 'Morvin', 'Themesdesign', 'morvin', 1, 1, '', 'default.png', 0, 0, 0, 0, 0, '0', 0, '#ffffff', 0, NULL),
(17, 'One Page', 'ikasmedia', 'onepage', 0, 1, 'Template One Page (PRO)', 'default.png', 1, 121, 112, 600, 1800, '1', 0, '-', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transparan`
--

CREATE TABLE `transparan` (
  `transparan_id` int NOT NULL,
  `id` int UNSIGNED NOT NULL DEFAULT '1',
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '0=Pendapatan\r\n1=Pengeluaran',
  `sts` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vawal` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transparan`
--

INSERT INTO `transparan` (`transparan_id`, `id`, `judul`, `tahun`, `jenis`, `sts`, `vawal`) VALUES
(1, 1, 'Realisasi Pendapatan Tahun Anggaran 2015', '2015', '0', '1', '0'),
(2, 1, 'Realisasi Belanja Tahun Anggaran 2015', '2015', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `transparan_detail`
--

CREATE TABLE `transparan_detail` (
  `transparandetail_id` int NOT NULL,
  `transparan_id` int DEFAULT NULL,
  `transparan_nama` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transparan_jumlah` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transparan_detail`
--

INSERT INTO `transparan_detail` (`transparandetail_id`, `transparan_id`, `transparan_nama`, `transparan_jumlah`) VALUES
(1, 1, 'Pembentukan Dana Cadangan', 11500),
(2, 1, 'Penyertaan Modal', 3307),
(3, 1, 'Retribusi', 379),
(4, 1, 'Pajak Daerah', 240),
(8, 2, 'Belanja Pegawai', 1208),
(9, 2, 'Belanja Hibah', 2126),
(10, 2, 'Belanja Bantuan Sosial', 342),
(11, 2, 'Belanja Bagi Hasil kepada kepada Provinsi', 200),
(12, 2, 'Belanja tidak terduga', 1007);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opd_id` int DEFAULT '0',
  `id_grup` int DEFAULT '1',
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'avatar.PNG',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `level` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activate_hash` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_hash` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_expires` bigint DEFAULT NULL,
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sts_on` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login_attempts` tinyint(1) DEFAULT NULL,
  `nomor_wa` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otp_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `opd_id`, `id_grup`, `fullname`, `user_image`, `password_hash`, `active`, `level`, `new_email`, `activate_hash`, `reset_hash`, `reset_expires`, `created_at`, `updated_at`, `last_login`, `sts_on`, `login_attempts`, `nomor_wa`, `otp_code`) VALUES
(1, 'admin@ikasmedia.net', 'admin', 0, 1, 'Vian Taum', '1649394521_dd7f9ba3dc6b70c44beb.png', '$2y$10$OK3J43fimOZZ9UrZnu6nTe7EDlbKSM0qK/qvCAPNFZzafExRz710y', 1, 'admin', NULL, NULL, NULL, NULL, NULL, '2021-10-14 10:05:30', '2025-05-23 03:45:04', '1', 1, '081353967028', NULL),
(12, 'blakataduk@yahoo.co.id', 'Desi', NULL, 2, 'Desi Gili', '1633952653_0ab591eeeb6f2420bfbf.png', '$2y$10$DWvmVLrlnn/8uzXFdKJ5ZeEzLa3fagNVMHU3E73Kop83J0yAuyEum', 1, 'autor', NULL, NULL, NULL, NULL, NULL, '1634011822', '2024-10-30 05:28:57', '0', 0, NULL, NULL),
(14, 'fournet@yahoo.co.id', 'fournet321', 0, 3, 'Fournet Juang', '1679377778_ac07bf58bf3001a93adf.png', '$2y$10$DiZ8Mf4/btnseYMgtCzUPOz25GsVbvGvhnks0xdh9tt3wu5LY1Pni', 1, 'autor', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-21 05:54:41', '0', 0, NULL, NULL),
(16, 'deril@yahoo.com', 'deril', 4, 3, 'Ama Deril Taum', '1649394870_0472d0a15867201a4cdc.png', '$2y$10$Hef1vCmkBCUCnjVDjw4aOOxNCKEQwsMl/VPBbUITdS6U0UP.OwGr6', 1, 'autor', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-30 12:06:25', '0', 0, NULL, ''),
(30, 'viory31@gmail.com', 'lwbbarat', 1, 3, 'coba no image', 'default.png', '$2y$10$pDtxdrFC3KKowXj7GzT43OkRtKA1uTNZFjg0prkR4p.0lSIR45rm6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int NOT NULL,
  `kategorivideo_id` int DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_link` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id` int UNSIGNED DEFAULT NULL,
  `sts_v` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ket_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `hits` int DEFAULT NULL,
  `likevideo` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `kategorivideo_id`, `judul`, `video_link`, `tanggal`, `id`, `sts_v`, `ket_video`, `hits`, `likevideo`) VALUES
(1, 1, 'Tambah Kelompok dan Program Bantuan pada SIAD ikasmedia', 'X_fh-xVmto0', '2021-06-08', 1, '1', NULL, 34, NULL),
(2, 1, 'Ganti Logo Sesuai ukuran standar Aplikasi', 'ln-UEyLx_qU', '2021-06-08', 1, '1', NULL, 19, 1),
(5, 1, 'Tambah Dusun dan Reset Database', '3i3jwdi33NA', '2021-06-08', 1, '1', '', 38, NULL),
(6, 1, 'Tambah Jenis Surat Baru ', 'e3Ul4b-nYko', '2021-06-08', 1, '1', '', 15, 1),
(7, 10, 'Update CMS ikasmedia To Versi 3.0.2', 'cANQuJMptcc', '2023-05-10', 1, '1', 'Update CMS ikasmedia To Versi 3.0.2', 24, 0),
(10, 1, 'MEMBUAT SPT DAN SPPD (SURAT PERINTAH PERJALANAN DINAS)', '3uEhPCVlJIo', '2024-01-15', 1, '1', 'Dengan aplikasi desa ini, surat perintah perjalanan dinas dengan mudah dibuat dan dapat digunakan sebagai alat bantu administrasi dokumentasi perjalanan dinas pada sebuah instansi pemerintah desa.', NULL, 0),
(11, 1, 'UPGRADE APLIKASI DAN SETTING MENU', 'sP74CR0SKNc', '2024-01-15', 1, '1', 'Setelah anda sukses instal update terbaru, database anda harus diupgrade terlebih dahulu sebelum digunakan. Disini anda akan dipandu bagaimana cara upgrade database lama anda. Untuk dapatkan update dan aplikasi desa ini, silahkan kunjungi website kami https://ikasmedia.net. Terima kasih', 5, 0),
(12, 10, 'UPDATE DAN IMPORT DATA PEGAWAI PADA CMS ikasmedia', 'sw5L2tXC2Rg', '2024-01-15', 1, '1', 'Pada Video kali ini akan menunjukkan bagaimana Cara Update dan menggunakan fitur IMPORT DATA pada CMS ikasmedia. Fitur ini akan memudahkan pengguna yang memiliki banyak pegawai, dan sudah terdata di file excel, untuk diupdate ke dalam Websitenya. ', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `hits` int DEFAULT NULL,
  `online` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`ip`, `tgl`, `hits`, `online`, `time`) VALUES
('::1', '2025-03-23', 5, '1742725658', '2025-03-23 18:27:38'),
('::1', '2025-03-24', 5, '1742793710', '2025-03-24 13:21:50'),
('::1', '2025-03-25', 8, '1742870164', '2025-03-25 10:36:04'),
('::1', '2025-03-27', 70, '1743073351', '2025-03-27 19:02:31'),
('::1', '2025-03-28', 8, '1743140532', '2025-03-28 13:42:12'),
('::1', '2025-03-31', 1, '1743413656', '2025-03-31 17:34:16'),
('::1', '2025-04-07', 44, '1744035397', '2025-04-07 22:16:37'),
('::1', '2025-04-10', 44, '1744270318', '2025-04-10 15:31:58'),
('::1', '2025-04-11', 225, '1744382067', '2025-04-11 22:34:27'),
('::1', '2025-04-22', 17, '1745322168', '2025-04-22 19:42:48'),
('::1', '2025-04-23', 34, '1745388800', '2025-04-23 14:13:20'),
('::1', '2025-04-24', 233, '1745475346', '2025-04-24 14:15:46'),
('::1', '2025-04-25', 28, '1745559095', '2025-04-25 13:31:35'),
('::1', '2025-04-26', 106, '1745646121', '2025-04-26 13:42:01'),
('::1', '2025-04-28', 41, '1745836963', '2025-04-28 18:42:43'),
('::1', '2025-04-29', 10, '1745905451', '2025-04-29 13:44:11'),
('::1', '2025-04-30', 140, '1746020351', '2025-04-30 21:39:11'),
('::1', '2025-05-02', 179, '1746193249', '2025-05-02 21:40:49'),
('::1', '2025-05-03', 26, '1746276932', '2025-05-03 20:55:32'),
('::1', '2025-05-04', 16, '1746349381', '2025-05-04 17:03:01'),
('::1', '2025-05-05', 6, '1746427528', '2025-05-05 14:45:28'),
('::1', '2025-05-09', 149, '1746804165', '2025-05-09 23:22:45'),
('::1', '2025-05-11', 42, '1746973554', '2025-05-11 22:25:54'),
('::1', '2025-05-12', 16, '1747018985', '2025-05-12 11:03:05'),
('::1', '2025-05-13', 3, '1747116492', '2025-05-13 14:08:12'),
('::1', '2025-05-18', 16, '1747570876', '2025-05-18 20:21:16'),
('::1', '2025-05-19', 1, '1747649121', '2025-05-19 18:05:21'),
('::1', '2025-05-21', 50, '1747822321', '2025-05-21 18:12:01'),
('::1', '2025-05-23', 84, '1747975335', '2025-05-23 12:42:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `bankdata`
--
ALTER TABLE `bankdata`
  ADD PRIMARY KEY (`bankdata_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_id`),
  ADD KEY `id` (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `berita_komen`
--
ALTER TABLE `berita_komen`
  ADD PRIMARY KEY (`beritakomen_id`),
  ADD KEY `id` (`id`),
  ADD KEY `berita_id` (`berita_id`);

--
-- Indexes for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD PRIMARY KEY (`beritatag_id`),
  ADD KEY `berita_id` (`berita_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `bt_bidang`
--
ALTER TABLE `bt_bidang`
  ADD PRIMARY KEY (`bidang_id`);

--
-- Indexes for table `bt_bukutamu`
--
ALTER TABLE `bt_bukutamu`
  ADD PRIMARY KEY (`bukutamu_id`),
  ADD KEY `bidang_id` (`bidang_id`);

--
-- Indexes for table `cms__grupakses`
--
ALTER TABLE `cms__grupakses`
  ADD PRIMARY KEY (`id_grupakses`),
  ADD KEY `id_grup` (`id_grup`),
  ADD KEY `id_modul` (`id_modul`);

--
-- Indexes for table `cms__modpublic`
--
ALTER TABLE `cms__modpublic`
  ADD PRIMARY KEY (`id_modpublic`);

--
-- Indexes for table `cms__modul`
--
ALTER TABLE `cms__modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `cms__usergrup`
--
ALTER TABLE `cms__usergrup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `cms__usersessions`
--
ALTER TABLE `cms__usersessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id_counter`);

--
-- Indexes for table `custome__anggota`
--
ALTER TABLE `custome__anggota`
  ADD PRIMARY KEY (`anggota_id`);

--
-- Indexes for table `custome__masterdata`
--
ALTER TABLE `custome__masterdata`
  ADD PRIMARY KEY (`id_masterdata`);

--
-- Indexes for table `custome__mohoninfo`
--
ALTER TABLE `custome__mohoninfo`
  ADD PRIMARY KEY (`id_mohoninfo`),
  ADD KEY `id` (`id`),
  ADD KEY `cara_dapatkaninfo` (`cara_dapatkaninfo`),
  ADD KEY `cara_perolehinfo` (`cara_perolehinfo`),
  ADD KEY `pek_pemohon` (`pek_pemohon`);

--
-- Indexes for table `custome__opd`
--
ALTER TABLE `custome__opd`
  ADD PRIMARY KEY (`opd_id`),
  ADD KEY `tipe_id` (`tipe_id`);

--
-- Indexes for table `custome__opdtipe`
--
ALTER TABLE `custome__opdtipe`
  ADD PRIMARY KEY (`tipe_id`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`ebook_id`),
  ADD KEY `kategoriebook_id` (`kategoriebook_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `faq_jawab`
--
ALTER TABLE `faq_jawab`
  ADD PRIMARY KEY (`faq_jawabid`),
  ADD KEY `faq_tanyaid` (`faq_tanyaid`);

--
-- Indexes for table `faq_tanya`
--
ALTER TABLE `faq_tanya`
  ADD PRIMARY KEY (`faq_tanyaid`),
  ADD KEY `kat_faq` (`kat_faq`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`fasilitas_id`);

--
-- Indexes for table `fasilitas_detail`
--
ALTER TABLE `fasilitas_detail`
  ADD PRIMARY KEY (`fasilitasdetail_id`),
  ADD KEY `fasilitas_id` (`fasilitas_id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `id` (`id`),
  ADD KEY `kategorifoto_id` (`kategorifoto_id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`informasi_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kategori_ebook`
--
ALTER TABLE `kategori_ebook`
  ADD PRIMARY KEY (`kategoriebook_id`);

--
-- Indexes for table `kategori_foto`
--
ALTER TABLE `kategori_foto`
  ADD PRIMARY KEY (`kategorifoto_id`);

--
-- Indexes for table `kategori_video`
--
ALTER TABLE `kategori_video`
  ADD PRIMARY KEY (`kategorivideo_id`);

--
-- Indexes for table `kritiksaran`
--
ALTER TABLE `kritiksaran`
  ADD PRIMARY KEY (`kritiksaran_id`);

--
-- Indexes for table `link_terkait`
--
ALTER TABLE `link_terkait`
  ADD PRIMARY KEY (`id_link`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modalpopup`
--
ALTER TABLE `modalpopup`
  ADD PRIMARY KEY (`modalpopup_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indexes for table `poling`
--
ALTER TABLE `poling`
  ADD PRIMARY KEY (`poling_id`),
  ADD KEY `id` (`id`),
  ADD KEY `informasi_id` (`informasi_id`);

--
-- Indexes for table `produk_hukum`
--
ALTER TABLE `produk_hukum`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `produk_kathukum`
--
ALTER TABLE `produk_kathukum`
  ADD PRIMARY KEY (`kathukum_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `produk_subkathukum`
--
ALTER TABLE `produk_subkathukum`
  ADD PRIMARY KEY (`subkathukum_id`),
  ADD KEY `kathukum_id` (`kathukum_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenu_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `subsubmenu`
--
ALTER TABLE `subsubmenu`
  ADD PRIMARY KEY (`subsubmenu_id`),
  ADD KEY `submenu_id` (`submenu_id`);

--
-- Indexes for table `survey_jawaban`
--
ALTER TABLE `survey_jawaban`
  ADD PRIMARY KEY (`jawaban_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `survey_pertanyaan`
--
ALTER TABLE `survey_pertanyaan`
  ADD PRIMARY KEY (`pertanyaan_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `survey_responden`
--
ALTER TABLE `survey_responden`
  ADD PRIMARY KEY (`responden_id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `survey_topik`
--
ALTER TABLE `survey_topik`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `tbl_setaplikasi`
--
ALTER TABLE `tbl_setaplikasi`
  ADD PRIMARY KEY (`id_setaplikasi`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `id_grup` (`id_grup`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `transparan`
--
ALTER TABLE `transparan`
  ADD PRIMARY KEY (`transparan_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `transparan_detail`
--
ALTER TABLE `transparan_detail`
  ADD PRIMARY KEY (`transparandetail_id`),
  ADD KEY `transparan_id` (`transparan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_2` (`username`),
  ADD KEY `username_3` (`username`),
  ADD KEY `opd_id` (`opd_id`),
  ADD KEY `id_grup` (`id_grup`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `id` (`id`),
  ADD KEY `kategorivideo_id` (`kategorivideo_id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD UNIQUE KEY `unique_ip_tgl` (`ip`,`tgl`),
  ADD KEY `idx_ip` (`ip`),
  ADD KEY `idx_tgl` (`tgl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `bankdata`
--
ALTER TABLE `bankdata`
  MODIFY `bankdata_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `berita_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `berita_komen`
--
ALTER TABLE `berita_komen`
  MODIFY `beritakomen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `berita_tag`
--
ALTER TABLE `berita_tag`
  MODIFY `beritatag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `bt_bidang`
--
ALTER TABLE `bt_bidang`
  MODIFY `bidang_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bt_bukutamu`
--
ALTER TABLE `bt_bukutamu`
  MODIFY `bukutamu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms__grupakses`
--
ALTER TABLE `cms__grupakses`
  MODIFY `id_grupakses` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `cms__modpublic`
--
ALTER TABLE `cms__modpublic`
  MODIFY `id_modpublic` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cms__modul`
--
ALTER TABLE `cms__modul`
  MODIFY `id_modul` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `cms__usergrup`
--
ALTER TABLE `cms__usergrup`
  MODIFY `id_grup` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms__usersessions`
--
ALTER TABLE `cms__usersessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id_counter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `custome__anggota`
--
ALTER TABLE `custome__anggota`
  MODIFY `anggota_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custome__masterdata`
--
ALTER TABLE `custome__masterdata`
  MODIFY `id_masterdata` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `custome__mohoninfo`
--
ALTER TABLE `custome__mohoninfo`
  MODIFY `id_mohoninfo` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custome__opd`
--
ALTER TABLE `custome__opd`
  MODIFY `opd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `custome__opdtipe`
--
ALTER TABLE `custome__opdtipe`
  MODIFY `tipe_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `ebook_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faq_jawab`
--
ALTER TABLE `faq_jawab`
  MODIFY `faq_jawabid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faq_tanya`
--
ALTER TABLE `faq_tanya`
  MODIFY `faq_tanyaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `fasilitas_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas_detail`
--
ALTER TABLE `fasilitas_detail`
  MODIFY `fasilitasdetail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `informasi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kategori_ebook`
--
ALTER TABLE `kategori_ebook`
  MODIFY `kategoriebook_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_foto`
--
ALTER TABLE `kategori_foto`
  MODIFY `kategorifoto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_video`
--
ALTER TABLE `kategori_video`
  MODIFY `kategorivideo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kritiksaran`
--
ALTER TABLE `kritiksaran`
  MODIFY `kritiksaran_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `link_terkait`
--
ALTER TABLE `link_terkait`
  MODIFY `id_link` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modalpopup`
--
ALTER TABLE `modalpopup`
  MODIFY `modalpopup_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `poling`
--
ALTER TABLE `poling`
  MODIFY `poling_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `produk_hukum`
--
ALTER TABLE `produk_hukum`
  MODIFY `produk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk_kathukum`
--
ALTER TABLE `produk_kathukum`
  MODIFY `kathukum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `produk_subkathukum`
--
ALTER TABLE `produk_subkathukum`
  MODIFY `subkathukum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subsubmenu`
--
ALTER TABLE `subsubmenu`
  MODIFY `subsubmenu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `survey_jawaban`
--
ALTER TABLE `survey_jawaban`
  MODIFY `jawaban_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `survey_pertanyaan`
--
ALTER TABLE `survey_pertanyaan`
  MODIFY `pertanyaan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `survey_responden`
--
ALTER TABLE `survey_responden`
  MODIFY `responden_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `survey_topik`
--
ALTER TABLE `survey_topik`
  MODIFY `survey_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_setaplikasi`
--
ALTER TABLE `tbl_setaplikasi`
  MODIFY `id_setaplikasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2212;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `template_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transparan`
--
ALTER TABLE `transparan`
  MODIFY `transparan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transparan_detail`
--
ALTER TABLE `transparan_detail`
  MODIFY `transparandetail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `bankdata`
--
ALTER TABLE `bankdata`
  ADD CONSTRAINT `bankdata_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `berita_tag`
--
ALTER TABLE `berita_tag`
  ADD CONSTRAINT `berita_tag_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON UPDATE CASCADE;

--
-- Constraints for table `bt_bukutamu`
--
ALTER TABLE `bt_bukutamu`
  ADD CONSTRAINT `bt_bukutamu_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `bt_bidang` (`bidang_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cms__grupakses`
--
ALTER TABLE `cms__grupakses`
  ADD CONSTRAINT `cms__grupakses_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `cms__modul` (`id_modul`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cms__grupakses_ibfk_3` FOREIGN KEY (`id_grup`) REFERENCES `cms__usergrup` (`id_grup`) ON DELETE CASCADE;

--
-- Constraints for table `cms__usersessions`
--
ALTER TABLE `cms__usersessions`
  ADD CONSTRAINT `cms__usersessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custome__opd`
--
ALTER TABLE `custome__opd`
  ADD CONSTRAINT `custome__opd_ibfk_1` FOREIGN KEY (`tipe_id`) REFERENCES `custome__opdtipe` (`tipe_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ebook`
--
ALTER TABLE `ebook`
  ADD CONSTRAINT `ebook_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ebook_ibfk_2` FOREIGN KEY (`kategoriebook_id`) REFERENCES `kategori_ebook` (`kategoriebook_id`) ON UPDATE CASCADE;

--
-- Constraints for table `faq_jawab`
--
ALTER TABLE `faq_jawab`
  ADD CONSTRAINT `faq_jawab_ibfk_1` FOREIGN KEY (`faq_tanyaid`) REFERENCES `faq_tanya` (`faq_tanyaid`) ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_detail`
--
ALTER TABLE `fasilitas_detail`
  ADD CONSTRAINT `fasilitas_detail_ibfk_1` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`fasilitas_id`) ON UPDATE CASCADE;

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`kategorifoto_id`) REFERENCES `kategori_foto` (`kategorifoto_id`) ON UPDATE CASCADE;

--
-- Constraints for table `informasi`
--
ALTER TABLE `informasi`
  ADD CONSTRAINT `informasi_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `poling`
--
ALTER TABLE `poling`
  ADD CONSTRAINT `poling_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `produk_hukum`
--
ALTER TABLE `produk_hukum`
  ADD CONSTRAINT `produk_hukum_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `produk_kathukum`
--
ALTER TABLE `produk_kathukum`
  ADD CONSTRAINT `produk_kathukum_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk_hukum` (`produk_id`) ON UPDATE CASCADE;

--
-- Constraints for table `produk_subkathukum`
--
ALTER TABLE `produk_subkathukum`
  ADD CONSTRAINT `produk_subkathukum_ibfk_1` FOREIGN KEY (`kathukum_id`) REFERENCES `produk_kathukum` (`kathukum_id`) ON UPDATE CASCADE;

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `subsubmenu`
--
ALTER TABLE `subsubmenu`
  ADD CONSTRAINT `subsubmenu_ibfk_1` FOREIGN KEY (`submenu_id`) REFERENCES `submenu` (`submenu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `survey_jawaban`
--
ALTER TABLE `survey_jawaban`
  ADD CONSTRAINT `survey_jawaban_ibfk_1` FOREIGN KEY (`pertanyaan_id`) REFERENCES `survey_pertanyaan` (`pertanyaan_id`) ON UPDATE CASCADE;

--
-- Constraints for table `survey_pertanyaan`
--
ALTER TABLE `survey_pertanyaan`
  ADD CONSTRAINT `survey_pertanyaan_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey_topik` (`survey_id`) ON UPDATE CASCADE;

--
-- Constraints for table `survey_responden`
--
ALTER TABLE `survey_responden`
  ADD CONSTRAINT `survey_responden_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `survey_topik` (`survey_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
