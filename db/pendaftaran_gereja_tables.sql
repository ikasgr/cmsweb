-- ============================================
-- SQL untuk Modul Pendaftaran Gereja
-- Terdiri dari: Pendaftaran Sidi, Baptis, dan Nikah
-- ============================================

-- Tabel Pendaftaran Sidi
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_sidi` (
  `id_sidi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `tgl_baptis` date NOT NULL,
  `gereja_baptis` varchar(255) DEFAULT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_sidi` date DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Disetujui, 2=Ditolak',
  `keterangan` text DEFAULT NULL,
  `dok_ktp` varchar(255) DEFAULT NULL,
  `dok_kk` varchar(255) DEFAULT NULL,
  `dok_baptis` varchar(255) DEFAULT NULL,
  `dok_foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sidi`),
  KEY `idx_status` (`status`),
  KEY `idx_tgl_daftar` (`tgl_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Pendaftaran Baptis
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_baptis` (
  `id_baptis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `jenis_baptis` enum('Baptis Anak','Baptis Dewasa') NOT NULL,
  `nama_pendamping` varchar(255) DEFAULT NULL,
  `hubungan_pendamping` varchar(100) DEFAULT NULL COMMENT 'Orang Tua, Wali, dll',
  `tgl_daftar` date NOT NULL,
  `tgl_baptis` date DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Disetujui, 2=Ditolak',
  `keterangan` text DEFAULT NULL,
  `dok_ktp` varchar(255) DEFAULT NULL,
  `dok_kk` varchar(255) DEFAULT NULL,
  `dok_akta_lahir` varchar(255) DEFAULT NULL,
  `dok_foto` varchar(255) DEFAULT NULL,
  `dok_surat_nikah_ortu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_baptis`),
  KEY `idx_status` (`status`),
  KEY `idx_tgl_daftar` (`tgl_daftar`),
  KEY `idx_jenis_baptis` (`jenis_baptis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Pendaftaran Nikah
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_nikah` (
  `id_nikah` int(11) NOT NULL AUTO_INCREMENT,
  -- Data Calon Suami
  `nama_pria` varchar(255) NOT NULL,
  `tempat_lahir_pria` varchar(100) DEFAULT NULL,
  `tgl_lahir_pria` date NOT NULL,
  `alamat_pria` text DEFAULT NULL,
  `no_hp_pria` varchar(20) NOT NULL,
  `email_pria` varchar(100) NOT NULL,
  `pekerjaan_pria` varchar(100) DEFAULT NULL,
  `status_baptis_pria` enum('Sudah','Belum') DEFAULT 'Sudah',
  `gereja_baptis_pria` varchar(255) DEFAULT NULL,
  `nama_ayah_pria` varchar(255) DEFAULT NULL,
  `nama_ibu_pria` varchar(255) DEFAULT NULL,
  -- Data Calon Istri
  `nama_wanita` varchar(255) NOT NULL,
  `tempat_lahir_wanita` varchar(100) DEFAULT NULL,
  `tgl_lahir_wanita` date NOT NULL,
  `alamat_wanita` text DEFAULT NULL,
  `no_hp_wanita` varchar(20) NOT NULL,
  `email_wanita` varchar(100) NOT NULL,
  `pekerjaan_wanita` varchar(100) DEFAULT NULL,
  `status_baptis_wanita` enum('Sudah','Belum') DEFAULT 'Sudah',
  `gereja_baptis_wanita` varchar(255) DEFAULT NULL,
  `nama_ayah_wanita` varchar(255) DEFAULT NULL,
  `nama_ibu_wanita` varchar(255) DEFAULT NULL,
  -- Data Pernikahan
  `tgl_daftar` date NOT NULL,
  `tgl_nikah_diinginkan` date NOT NULL,
  `tempat_nikah` varchar(255) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Disetujui, 2=Ditolak',
  `keterangan` text DEFAULT NULL,
  -- Dokumen Pria
  `dok_ktp_pria` varchar(255) DEFAULT NULL,
  `dok_kk_pria` varchar(255) DEFAULT NULL,
  `dok_baptis_pria` varchar(255) DEFAULT NULL,
  `dok_sidi_pria` varchar(255) DEFAULT NULL,
  `dok_foto_pria` varchar(255) DEFAULT NULL,
  -- Dokumen Wanita
  `dok_ktp_wanita` varchar(255) DEFAULT NULL,
  `dok_kk_wanita` varchar(255) DEFAULT NULL,
  `dok_baptis_wanita` varchar(255) DEFAULT NULL,
  `dok_sidi_wanita` varchar(255) DEFAULT NULL,
  `dok_foto_wanita` varchar(255) DEFAULT NULL,
  -- Dokumen Tambahan
  `dok_surat_izin_ortu` varchar(255) DEFAULT NULL,
  `dok_surat_keterangan_gereja` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_nikah`),
  KEY `idx_status` (`status`),
  KEY `idx_tgl_daftar` (`tgl_daftar`),
  KEY `idx_tgl_nikah` (`tgl_nikah_diinginkan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Contoh Data Sample (Opsional)
-- ============================================

-- Sample Pendaftaran Sidi
INSERT INTO `custome__pendaftaran_sidi` 
(`nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, 
`nama_ayah`, `nama_ibu`, `tgl_baptis`, `gereja_baptis`, `tgl_daftar`, `status`) 
VALUES
('John Doe', 'Jakarta', '2005-05-15', 'Laki-laki', 'Jl. Contoh No. 123, Jakarta', 
'081234567890', 'john.doe@email.com', 'Bapak John', 'Ibu Jane', '2010-12-25', 
'GPIB Immanuel Jakarta', '2025-01-15', '0');

-- Sample Pendaftaran Baptis
INSERT INTO `custome__pendaftaran_baptis` 
(`nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `email`, 
`nama_ayah`, `nama_ibu`, `jenis_baptis`, `nama_pendamping`, `hubungan_pendamping`, 
`tgl_daftar`, `status`) 
VALUES
('Baby Smith', 'Bandung', '2024-03-20', 'Perempuan', 'Jl. Sample No. 456, Bandung', 
'082345678901', 'parent.smith@email.com', 'Mr. Smith', 'Mrs. Smith', 'Baptis Anak', 
'Mr. Smith', 'Orang Tua', '2025-01-15', '0');

-- Sample Pendaftaran Nikah
INSERT INTO `custome__pendaftaran_nikah` 
(`nama_pria`, `tempat_lahir_pria`, `tgl_lahir_pria`, `alamat_pria`, `no_hp_pria`, `email_pria`, 
`pekerjaan_pria`, `status_baptis_pria`, `gereja_baptis_pria`, `nama_ayah_pria`, `nama_ibu_pria`,
`nama_wanita`, `tempat_lahir_wanita`, `tgl_lahir_wanita`, `alamat_wanita`, `no_hp_wanita`, 
`email_wanita`, `pekerjaan_wanita`, `status_baptis_wanita`, `gereja_baptis_wanita`, 
`nama_ayah_wanita`, `nama_ibu_wanita`, `tgl_daftar`, `tgl_nikah_diinginkan`, `tempat_nikah`, `status`) 
VALUES
('Michael Anderson', 'Surabaya', '1995-08-10', 'Jl. Merdeka No. 789, Surabaya', 
'083456789012', 'michael.a@email.com', 'Karyawan Swasta', 'Sudah', 'GKI Surabaya', 
'Bapak Anderson', 'Ibu Anderson',
'Sarah Johnson', 'Surabaya', '1997-11-25', 'Jl. Pemuda No. 321, Surabaya', 
'084567890123', 'sarah.j@email.com', 'Guru', 'Sudah', 'GKI Surabaya', 
'Bapak Johnson', 'Ibu Johnson', '2025-01-15', '2025-06-15', 'GKI Surabaya', '0');
