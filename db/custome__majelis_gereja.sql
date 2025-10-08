-- ============================================
-- Database Schema: Modul Majelis Gereja
-- Version: 1.0.0
-- Date: 2025-10-08
-- Description: Complete database schema for Church Leadership Management
-- ============================================

-- Drop existing tables if exists (for clean installation)
DROP TABLE IF EXISTS custome__absensi_majelis;
DROP TABLE IF EXISTS custome__majelis_komisi;
DROP TABLE IF EXISTS custome__penahbisan_majelis;
DROP TABLE IF EXISTS custome__masa_jabatan_majelis;
DROP TABLE IF EXISTS custome__komisi_majelis;
DROP TABLE IF EXISTS custome__majelis_gereja;
DROP TABLE IF EXISTS custome__jabatan_majelis;

-- ============================================
-- 1. MASTER TABLE: Jabatan Majelis
-- ============================================
CREATE TABLE `custome__jabatan_majelis` (
  `jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tingkatan` enum('Nasional','Daerah','Lokal') DEFAULT 'Lokal',
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`jabatan_id`),
  UNIQUE KEY `unique_jabatan` (`nama_jabatan`),
  KEY `idx_status` (`status`),
  KEY `idx_tingkatan` (`tingkatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Master data jabatan dalam majelis gereja';

-- Insert default jabatan data
INSERT INTO custome__jabatan_majelis (nama_jabatan, deskripsi, tingkatan) VALUES
('Ketua Majelis', 'Ketua Majelis Gereja', 'Lokal'),
('Wakil Ketua Majelis', 'Wakil Ketua Majelis Gereja', 'Lokal'),
('Sekretaris Majelis', 'Sekretaris Majelis Gereja', 'Lokal'),
('Bendahara Majelis', 'Bendahara Majelis Gereja', 'Lokal'),
('Anggota Majelis', 'Anggota Majelis Gereja', 'Lokal'),
('Pendeta', 'Pendeta Jemaat', 'Lokal'),
('Pendeta Pembantu', 'Pendeta Pembantu', 'Lokal'),
('Diakon', 'Diakon Gereja', 'Lokal'),
('Pelayan Firman', 'Pelayan Firman', 'Lokal'),
('Pemusik', 'Pemusik Gereja', 'Lokal'),
('Pelayan Multimedia', 'Pelayan Multimedia', 'Lokal');

-- ============================================
-- 2. MAIN TABLE: Majelis Gereja
-- ============================================
CREATE TABLE `custome__majelis_gereja` (
  `majelis_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(50) DEFAULT NULL COMMENT 'Employee ID if applicable',
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,

  -- Church Leadership specific fields
  `jabatan_id` int(11) DEFAULT NULL COMMENT 'FK to custome__jabatan_majelis',
  `jenis_jabatan` enum('Ketua Majelis','Wakil Ketua','Sekretaris','Bendahara','Anggota Majelis','Pendeta','Diakon','Pelayan Firman','Pemusik','Pelayan Multimedia') NOT NULL,
  `tanggal_penahbisan` date DEFAULT NULL COMMENT 'Date of ordination/consecration',
  `tanggal_pelantikan` date DEFAULT NULL COMMENT 'Date of appointment',
  `tanggal_akhir_jabatan` date DEFAULT NULL COMMENT 'End of term date',
  `status_jabatan` enum('Aktif','Non-Aktif','Masa Percobaan','Habis Masa Jabatan') DEFAULT 'Aktif',
  `gereja_asal` varchar(255) DEFAULT NULL COMMENT 'Home church',
  `pendidikan_teologi` text DEFAULT NULL COMMENT 'Theological education background',
  `sertifikasi` text DEFAULT NULL COMMENT 'Certifications/credentials',
  `komisi` varchar(255) DEFAULT NULL COMMENT 'Commission/Committee assignment (comma separated IDs)',

  -- File uploads
  `gambar` varchar(255) DEFAULT NULL COMMENT 'Profile photo',
  `file_sk_pengangkatan` varchar(255) DEFAULT NULL COMMENT 'Appointment decree file',
  `file_sertifikat` varchar(255) DEFAULT NULL COMMENT 'Certificate file',
  `file_foto` varchar(255) DEFAULT NULL COMMENT 'Additional photo file',

  -- System fields
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,

  PRIMARY KEY (`majelis_id`),
  UNIQUE KEY `unique_nip` (`nip`),
  KEY `idx_nama` (`nama`),
  KEY `idx_email` (`email`),
  KEY `idx_jenis_jabatan` (`jenis_jabatan`),
  KEY `idx_status_jabatan` (`status_jabatan`),
  KEY `idx_tanggal_pelantikan` (`tanggal_pelantikan`),
  KEY `idx_tanggal_akhir_jabatan` (`tanggal_akhir_jabatan`),
  KEY `idx_jabatan_id` (`jabatan_id`),
  CONSTRAINT `fk_majelis_jabatan` FOREIGN KEY (`jabatan_id`) REFERENCES `custome__jabatan_majelis` (`jabatan_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel utama data majelis gereja';

-- ============================================
-- 3. TABLE: Masa Jabatan Majelis
-- ============================================
CREATE TABLE `custome__masa_jabatan_majelis` (
  `masa_jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `majelis_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('Aktif','Selesai','Diperpanjang','Dibatalkan') DEFAULT 'Aktif',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`masa_jabatan_id`),
  KEY `idx_majelis_id` (`majelis_id`),
  KEY `idx_jabatan_id` (`jabatan_id`),
  KEY `idx_tanggal_mulai` (`tanggal_mulai`),
  KEY `idx_tanggal_selesai` (`tanggal_selesai`),
  KEY `idx_status` (`status`),
  CONSTRAINT `fk_masa_jabatan_majelis` FOREIGN KEY (`majelis_id`) REFERENCES `custome__majelis_gereja` (`majelis_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_masa_jabatan_jabatan` FOREIGN KEY (`jabatan_id`) REFERENCES `custome__jabatan_majelis` (`jabatan_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Riwayat masa jabatan majelis';

-- ============================================
-- 4. TABLE: Penahbisan Majelis
-- ============================================
CREATE TABLE `custome__penahbisan_majelis` (
  `penahbisan_id` int(11) NOT NULL AUTO_INCREMENT,
  `majelis_id` int(11) NOT NULL,
  `jenis_penahbisan` enum('Pendeta','Diakon','Pelayan Firman','Pemusik','Majelis') NOT NULL,
  `tanggal_penahbisan` date NOT NULL,
  `tempat_penahbisan` varchar(255) DEFAULT NULL,
  `oleh_siapa` varchar(255) DEFAULT NULL COMMENT 'Who performed the ordination',
  `gereja_penahbis` varchar(255) DEFAULT NULL COMMENT 'Ordaining church',
  `nomor_sk` varchar(100) DEFAULT NULL COMMENT 'Decree number',
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`penahbisan_id`),
  KEY `idx_majelis_id` (`majelis_id`),
  KEY `idx_jenis_penahbisan` (`jenis_penahbisan`),
  KEY `idx_tanggal_penahbisan` (`tanggal_penahbisan`),
  CONSTRAINT `fk_penahbisan_majelis` FOREIGN KEY (`majelis_id`) REFERENCES `custome__majelis_gereja` (`majelis_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Rekord penahbisan/tahbisan majelis';

-- ============================================
-- 5. MASTER TABLE: Komisi Majelis
-- ============================================
CREATE TABLE `custome__komisi_majelis` (
  `komisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_komisi` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `ketua_komisi` int(11) DEFAULT NULL,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`komisi_id`),
  KEY `idx_ketua_komisi` (`ketua_komisi`),
  CONSTRAINT `fk_komisi_ketua` FOREIGN KEY (`ketua_komisi`) REFERENCES `custome__majelis_gereja` (`majelis_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Master data komisi/panitia gereja';

-- Insert default komisi data
INSERT INTO custome__komisi_majelis (nama_komisi, deskripsi) VALUES
('Komisi Pembangunan', 'Komisi yang menangani pembangunan dan pemeliharaan gedung gereja'),
('Komisi Diakonia', 'Komisi yang menangani pelayanan sosial dan kemasyarakatan'),
('Komisi Musik', 'Komisi yang menangani musik dan pujian'),
('Komisi Pendidikan', 'Komisi yang menangani pendidikan dan pelatihan jemaat'),
('Komisi Pemuda', 'Komisi yang menangani pelayanan pemuda'),
('Komisi Wanita', 'Komisi yang menangani pelayanan wanita');

-- ============================================
-- 6. JUNCTION TABLE: Majelis-Komisi
-- ============================================
CREATE TABLE `custome__majelis_komisi` (
  `majelis_komisi_id` int(11) NOT NULL AUTO_INCREMENT,
  `majelis_id` int(11) NOT NULL,
  `komisi_id` int(11) NOT NULL,
  `jabatan_dalam_komisi` varchar(100) DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',

  PRIMARY KEY (`majelis_komisi_id`),
  UNIQUE KEY `unique_majelis_komisi` (`majelis_id`, `komisi_id`, `tanggal_bergabung`),
  KEY `idx_komisi_id` (`komisi_id`),
  KEY `idx_status` (`status`),
  CONSTRAINT `fk_majelis_komisi_majelis` FOREIGN KEY (`majelis_id`) REFERENCES `custome__majelis_gereja` (`majelis_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_majelis_komisi_komisi` FOREIGN KEY (`komisi_id`) REFERENCES `custome__komisi_majelis` (`komisi_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Relasi many-to-many majelis dan komisi';

-- ============================================
-- 7. TABLE: Absensi Majelis
-- ============================================
CREATE TABLE `custome__absensi_majelis` (
  `absensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `majelis_id` int(11) NOT NULL,
  `tanggal_rapat` date NOT NULL,
  `jenis_rapat` enum('Sidang Majelis','Rapat Komisi','Rapat Khusus','Sinode') NOT NULL,
  `status_kehadiran` enum('Hadir','Tidak Hadir','Izin','Sakit') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`absensi_id`),
  KEY `idx_majelis_id` (`majelis_id`),
  KEY `idx_tanggal_rapat` (`tanggal_rapat`),
  KEY `idx_jenis_rapat` (`jenis_rapat`),
  KEY `idx_status_kehadiran` (`status_kehadiran`),
  CONSTRAINT `fk_absensi_majelis` FOREIGN KEY (`majelis_id`) REFERENCES `custome__majelis_gereja` (`majelis_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Kehadiran majelis dalam rapat';

-- ============================================
-- SAMPLE DATA (Optional - for testing)
-- ============================================

-- Sample Majelis Data
INSERT INTO custome__majelis_gereja (
  nama, tempat_lahir, tgl_lahir, jk, agama, alamat, no_hp, email,
  jabatan_id, jenis_jabatan, status_jabatan, gereja_asal, 
  tanggal_penahbisan, tanggal_pelantikan
) VALUES
(
  'Pendeta Dr. John Doe', 
  'Jakarta', 
  '1975-03-15', 
  'Laki-laki', 
  'Kristen Protestan', 
  'Jl. Gereja No. 1', 
  '08123456789', 
  'john.doe@gereja.org',
  6, -- Pendeta
  'Pendeta', 
  'Aktif', 
  'Gereja Bethel',
  '2010-05-15',
  '2020-01-10'
),
(
  'Ibu Mary Smith', 
  'Bandung', 
  '1980-07-22', 
  'Perempuan', 
  'Kristen Protestan', 
  'Jl. Majelis No. 5', 
  '08198765432', 
  'mary.smith@gereja.org',
  1, -- Ketua Majelis
  'Ketua Majelis', 
  'Aktif', 
  'Gereja Immanuel',
  NULL,
  '2023-01-15'
);

-- Sample Masa Jabatan
INSERT INTO custome__masa_jabatan_majelis (majelis_id, jabatan_id, tanggal_mulai, tanggal_selesai, status) VALUES
(1, 6, '2020-01-10', '2025-01-10', 'Aktif'),
(2, 1, '2023-01-15', '2026-01-15', 'Aktif');

-- ============================================
-- NOTES & DOCUMENTATION
-- ============================================
-- 
-- Database Schema for Church Leadership Management (Majelis Gereja)
-- 
-- Tables Created:
-- 1. custome__jabatan_majelis - Master data for church positions
-- 2. custome__majelis_gereja - Main table for church leaders
-- 3. custome__masa_jabatan_majelis - Term periods tracking
-- 4. custome__penahbisan_majelis - Ordination records
-- 5. custome__komisi_majelis - Commission/Committee master data
-- 6. custome__majelis_komisi - Junction table for majelis-commission relationships
-- 7. custome__absensi_majelis - Meeting attendance records
--
-- Features:
-- - Complete CRUD operations support
-- - File upload support (photo, SK, certificates)
-- - Term period tracking with history
-- - Ordination/consecration records
-- - Commission/committee assignments
-- - Meeting attendance tracking
-- - Foreign key constraints for data integrity
-- - Indexed fields for better query performance
--
-- Version: 1.0.0
-- Last Updated: 2025-10-08
-- ============================================
