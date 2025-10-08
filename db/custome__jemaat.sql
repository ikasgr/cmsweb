-- =============================================
-- Database Schema: Modul Manajemen Jemaat
-- Dibuat: 8 Oktober 2025
-- Untuk: CMS Gereja - Sistem Informasi Lengkap
-- =============================================

-- Tabel utama jemaat
CREATE TABLE `custome__jemaat` (
  `id_jemaat` int(11) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(20) NOT NULL UNIQUE,
  `nama_lengkap` varchar(255) NOT NULL,
  `nama_panggilan` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `rt_rw` varchar(20) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `pendidikan` enum('SD','SMP','SMA','D3','S1','S2','S3','Lainnya') DEFAULT NULL,
  `status_pernikahan` enum('Belum Menikah','Menikah','Janda','Duda') DEFAULT 'Belum Menikah',
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_pasangan` varchar(255) DEFAULT NULL,
  `tgl_baptis` date DEFAULT NULL,
  `tempat_baptis` varchar(255) DEFAULT NULL,
  `pendeta_baptis` varchar(255) DEFAULT NULL,
  `tgl_sidi` date DEFAULT NULL,
  `tempat_sidi` varchar(255) DEFAULT NULL,
  `pendeta_sidi` varchar(255) DEFAULT NULL,
  `tgl_nikah` date DEFAULT NULL,
  `tempat_nikah` varchar(255) DEFAULT NULL,
  `pendeta_nikah` varchar(255) DEFAULT NULL,
  `status_keanggotaan` enum('Aktif','Pindah','Meninggal','Non-Aktif') DEFAULT 'Aktif',
  `tgl_bergabung` date NOT NULL,
  `tgl_pindah` date DEFAULT NULL,
  `tgl_meninggal` date DEFAULT NULL,
  `gereja_asal` varchar(255) DEFAULT NULL,
  `gereja_tujuan` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jemaat`),
  KEY `idx_no_anggota` (`no_anggota`),
  KEY `idx_nama` (`nama_lengkap`),
  KEY `idx_status` (`status_keanggotaan`),
  KEY `idx_tgl_lahir` (`tgl_lahir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel keluarga jemaat
CREATE TABLE `custome__keluarga_jemaat` (
  `id_keluarga` int(11) NOT NULL AUTO_INCREMENT,
  `no_keluarga` varchar(20) NOT NULL UNIQUE,
  `nama_kepala_keluarga` varchar(255) NOT NULL,
  `id_kepala_keluarga` int(11) NOT NULL,
  `alamat_keluarga` text NOT NULL,
  `status_keluarga` enum('Aktif','Pindah','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keluarga`),
  KEY `idx_no_keluarga` (`no_keluarga`),
  KEY `fk_kepala_keluarga` (`id_kepala_keluarga`),
  CONSTRAINT `fk_kepala_keluarga` FOREIGN KEY (`id_kepala_keluarga`) REFERENCES `custome__jemaat` (`id_jemaat`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel relasi anggota keluarga
CREATE TABLE `custome__anggota_keluarga` (
  `id_anggota_keluarga` int(11) NOT NULL AUTO_INCREMENT,
  `id_keluarga` int(11) NOT NULL,
  `id_jemaat` int(11) NOT NULL,
  `hubungan` enum('Kepala Keluarga','Istri','Anak','Menantu','Cucu','Orang Tua','Saudara','Lainnya') NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anggota_keluarga`),
  KEY `fk_keluarga` (`id_keluarga`),
  KEY `fk_jemaat` (`id_jemaat`),
  CONSTRAINT `fk_keluarga` FOREIGN KEY (`id_keluarga`) REFERENCES `custome__keluarga_jemaat` (`id_keluarga`) ON DELETE CASCADE,
  CONSTRAINT `fk_jemaat` FOREIGN KEY (`id_jemaat`) REFERENCES `custome__jemaat` (`id_jemaat`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel riwayat pelayanan jemaat
CREATE TABLE `custome__riwayat_pelayanan` (
  `id_riwayat` int(11) NOT NULL AUTO_INCREMENT,
  `id_jemaat` int(11) NOT NULL,
  `jenis_pelayanan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Aktif','Selesai') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_riwayat`),
  KEY `fk_jemaat_riwayat` (`id_jemaat`),
  CONSTRAINT `fk_jemaat_riwayat` FOREIGN KEY (`id_jemaat`) REFERENCES `custome__jemaat` (`id_jemaat`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data sample
INSERT INTO `custome__jemaat` (`no_anggota`, `nama_lengkap`, `nama_panggilan`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat_lengkap`, `no_hp`, `email`, `pekerjaan`, `status_keanggotaan`, `tgl_bergabung`) VALUES
('JMT001', 'Budi Santoso', 'Budi', 'Jakarta', '1980-05-15', 'L', 'Jl. Merdeka No. 123, Jakarta', '081234567890', 'budi@email.com', 'Karyawan Swasta', 'Aktif', '2020-01-01'),
('JMT002', 'Siti Rahayu', 'Siti', 'Bandung', '1985-08-20', 'P', 'Jl. Sudirman No. 456, Bandung', '081234567891', 'siti@email.com', 'Guru', 'Aktif', '2020-02-15'),
('JMT003', 'Ahmad Wijaya', 'Ahmad', 'Surabaya', '1975-12-10', 'L', 'Jl. Pahlawan No. 789, Surabaya', '081234567892', 'ahmad@email.com', 'Wiraswasta', 'Aktif', '2019-06-01');
