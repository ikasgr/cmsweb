-- ============================================
-- Update Modul Pendaftaran - Redesign
-- Date: 2025-10-08
-- Description: Tambah tabel dan field untuk fitur dokumen & tracking
-- ============================================

-- ============================================
-- TABEL BARU
-- ============================================

-- Tabel Dokumen Pendaftaran
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_dokumen` (
  `dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL COMMENT 'Jenis pendaftaran',
  `pendaftaran_id` int(11) NOT NULL COMMENT 'ID pendaftaran terkait',
  `jenis_dokumen` varchar(100) NOT NULL COMMENT 'Nama jenis dokumen',
  `nama_file` varchar(255) NOT NULL COMMENT 'Nama file asli',
  `file_path` varchar(255) NOT NULL COMMENT 'Path file di server',
  `file_size` int(11) DEFAULT NULL COMMENT 'Ukuran file dalam bytes',
  `file_type` varchar(50) DEFAULT NULL COMMENT 'MIME type',
  `status_dokumen` enum('pending','valid','invalid','revisi') DEFAULT 'pending' COMMENT 'Status verifikasi',
  `keterangan` text DEFAULT NULL COMMENT 'Catatan admin',
  `uploaded_by` int(11) DEFAULT NULL COMMENT 'User yang upload',
  `tgl_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  `verified_by` int(11) DEFAULT NULL COMMENT 'Admin yang verifikasi',
  `tgl_verified` datetime DEFAULT NULL,
  PRIMARY KEY (`dokumen_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`),
  KEY `idx_status` (`status_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Dokumen pendukung pendaftaran';

-- Tabel Timeline/History Pendaftaran
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_timeline` (
  `timeline_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL COMMENT 'Status perubahan',
  `keterangan` text DEFAULT NULL COMMENT 'Deskripsi perubahan',
  `user_id` int(11) DEFAULT NULL COMMENT 'User yang update',
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timeline_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`),
  KEY `idx_tgl` (`tgl_update`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Timeline history pendaftaran';

-- Tabel Catatan Admin
CREATE TABLE IF NOT EXISTS `custome__pendaftaran_catatan` (
  `catatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `catatan` text NOT NULL COMMENT 'Isi catatan',
  `tipe` enum('internal','eksternal') DEFAULT 'internal' COMMENT 'internal=admin only, eksternal=visible to user',
  `user_id` int(11) NOT NULL COMMENT 'User yang buat catatan',
  `tgl_catatan` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catatan_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`),
  KEY `idx_tipe` (`tipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catatan admin untuk pendaftaran';

-- ============================================
-- UPDATE TABEL EXISTING
-- ============================================

-- Update tabel pendaftaran_sidi
ALTER TABLE `custome__pendaftaran_sidi` 
ADD COLUMN `kelengkapan_dokumen` int(11) DEFAULT 0 COMMENT 'Persentase kelengkapan dokumen (0-100)',
ADD COLUMN `tgl_disetujui` datetime DEFAULT NULL COMMENT 'Tanggal disetujui',
ADD COLUMN `tgl_ditolak` datetime DEFAULT NULL COMMENT 'Tanggal ditolak',
ADD COLUMN `approved_by` int(11) DEFAULT NULL COMMENT 'Admin yang approve',
ADD COLUMN `alasan_tolak` text DEFAULT NULL COMMENT 'Alasan penolakan',
ADD COLUMN `catatan_admin` text DEFAULT NULL COMMENT 'Catatan internal admin';

-- Update tabel pendaftaran_baptis
ALTER TABLE `custome__pendaftaran_baptis` 
ADD COLUMN `kelengkapan_dokumen` int(11) DEFAULT 0 COMMENT 'Persentase kelengkapan dokumen (0-100)',
ADD COLUMN `tgl_disetujui` datetime DEFAULT NULL COMMENT 'Tanggal disetujui',
ADD COLUMN `tgl_ditolak` datetime DEFAULT NULL COMMENT 'Tanggal ditolak',
ADD COLUMN `approved_by` int(11) DEFAULT NULL COMMENT 'Admin yang approve',
ADD COLUMN `alasan_tolak` text DEFAULT NULL COMMENT 'Alasan penolakan',
ADD COLUMN `catatan_admin` text DEFAULT NULL COMMENT 'Catatan internal admin';

-- Update tabel pendaftaran_nikah
ALTER TABLE `custome__pendaftaran_nikah` 
ADD COLUMN `kelengkapan_dokumen` int(11) DEFAULT 0 COMMENT 'Persentase kelengkapan dokumen (0-100)',
ADD COLUMN `tgl_disetujui` datetime DEFAULT NULL COMMENT 'Tanggal disetujui',
ADD COLUMN `tgl_ditolak` datetime DEFAULT NULL COMMENT 'Tanggal ditolak',
ADD COLUMN `approved_by` int(11) DEFAULT NULL COMMENT 'Admin yang approve',
ADD COLUMN `alasan_tolak` text DEFAULT NULL COMMENT 'Alasan penolakan',
ADD COLUMN `catatan_admin` text DEFAULT NULL COMMENT 'Catatan internal admin';

-- ============================================
-- MASTER DATA JENIS DOKUMEN
-- ============================================

-- Tabel master jenis dokumen per pendaftaran
CREATE TABLE IF NOT EXISTS `custome__master_dokumen_pendaftaran` (
  `master_dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `nama_dokumen` varchar(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `wajib` tinyint(1) DEFAULT 1 COMMENT '1=wajib, 0=opsional',
  `urutan` int(11) DEFAULT 0,
  `aktif` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`master_dokumen_id`),
  KEY `idx_jenis` (`jenis_pendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Master jenis dokumen per pendaftaran';

-- Insert master dokumen untuk SIDI
INSERT INTO `custome__master_dokumen_pendaftaran` (`jenis_pendaftaran`, `nama_dokumen`, `keterangan`, `wajib`, `urutan`) VALUES
('sidi', 'KTP', 'Kartu Tanda Penduduk', 1, 1),
('sidi', 'Kartu Keluarga', 'KK', 1, 2),
('sidi', 'Sertifikat Baptis', 'Surat Baptis dari gereja', 1, 3),
('sidi', 'Foto', 'Pas foto 3x4', 1, 4),
('sidi', 'Surat Rekomendasi', 'Dari gereja asal (jika pindahan)', 0, 5),
('sidi', 'Sertifikat Katekisasi', 'Bukti mengikuti katekisasi', 1, 6);

-- Insert master dokumen untuk BAPTIS
INSERT INTO `custome__master_dokumen_pendaftaran` (`jenis_pendaftaran`, `nama_dokumen`, `keterangan`, `wajib`, `urutan`) VALUES
('baptis', 'KTP', 'Kartu Tanda Penduduk', 1, 1),
('baptis', 'Kartu Keluarga', 'KK', 1, 2),
('baptis', 'Akta Lahir', 'Akta kelahiran', 1, 3),
('baptis', 'Foto', 'Pas foto 3x4', 1, 4),
('baptis', 'Surat Nikah Orang Tua', 'Untuk baptis anak', 0, 5),
('baptis', 'Surat Pernyataan Orang Tua', 'Persetujuan orang tua', 0, 6),
('baptis', 'Sertifikat Katekisasi', 'Untuk baptis dewasa', 0, 7);

-- Insert master dokumen untuk NIKAH
INSERT INTO `custome__master_dokumen_pendaftaran` (`jenis_pendaftaran`, `nama_dokumen`, `keterangan`, `wajib`, `urutan`) VALUES
('nikah', 'KTP Calon Suami', 'KTP calon suami', 1, 1),
('nikah', 'KTP Calon Istri', 'KTP calon istri', 1, 2),
('nikah', 'KK Calon Suami', 'Kartu Keluarga calon suami', 1, 3),
('nikah', 'KK Calon Istri', 'Kartu Keluarga calon istri', 1, 4),
('nikah', 'Surat Baptis Calon Suami', 'Sertifikat baptis', 1, 5),
('nikah', 'Surat Baptis Calon Istri', 'Sertifikat baptis', 1, 6),
('nikah', 'Surat Sidi Calon Suami', 'Sertifikat sidi', 1, 7),
('nikah', 'Surat Sidi Calon Istri', 'Sertifikat sidi', 1, 8),
('nikah', 'Surat Keterangan Belum Menikah', 'Dari kelurahan', 1, 9),
('nikah', 'Surat Izin Orang Tua', 'Jika usia < 21 tahun', 0, 10),
('nikah', 'Sertifikat Konseling Pranikah', 'Bukti mengikuti konseling', 1, 11),
('nikah', 'Foto Calon Suami', 'Pas foto 4x6', 1, 12),
('nikah', 'Foto Calon Istri', 'Pas foto 4x6', 1, 13);

-- ============================================
-- INDEXES untuk Performance
-- ============================================

-- Index untuk pencarian cepat
CREATE INDEX idx_dokumen_search ON custome__pendaftaran_dokumen(jenis_pendaftaran, pendaftaran_id, status_dokumen);
CREATE INDEX idx_timeline_search ON custome__pendaftaran_timeline(jenis_pendaftaran, pendaftaran_id, tgl_update DESC);
CREATE INDEX idx_catatan_search ON custome__pendaftaran_catatan(jenis_pendaftaran, pendaftaran_id, tipe);

-- ============================================
-- NOTES
-- ============================================
-- 1. Backup data sebelum menjalankan script ini
-- 2. Field baru di tabel existing tidak akan mengganggu data lama
-- 3. Master dokumen bisa disesuaikan dengan kebutuhan gereja
-- 4. Status dokumen: pending (baru upload), valid (terverifikasi), invalid (ditolak), revisi (perlu diperbaiki)
-- 5. Tipe catatan: internal (hanya admin), eksternal (visible ke user)
-- ============================================
