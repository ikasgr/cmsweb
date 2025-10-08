-- =============================================
-- Database Schema: Modul Jadwal Ibadah & Pelayanan
-- Dibuat: 8 Oktober 2025
-- Untuk: CMS Gereja - Sistem Informasi Lengkap
-- =============================================

-- Tabel jenis ibadah
CREATE TABLE `custome__jenis_ibadah` (
  `id_jenis_ibadah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `warna` varchar(7) DEFAULT '#007bff',
  `durasi_menit` int(11) DEFAULT 120,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jenis_ibadah`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel jadwal ibadah utama
CREATE TABLE `custome__jadwal_ibadah` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis_ibadah` int(11) NOT NULL,
  `judul_ibadah` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tempat` varchar(255) DEFAULT 'Gereja',
  `tema_ibadah` varchar(255) DEFAULT NULL,
  `ayat_tema` text DEFAULT NULL,
  `liturgi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `max_peserta` int(11) DEFAULT NULL,
  `is_recurring` tinyint(1) DEFAULT 0,
  `recurring_type` enum('Mingguan','Bulanan','Tahunan') DEFAULT NULL,
  `recurring_end` date DEFAULT NULL,
  `status` enum('Terjadwal','Berlangsung','Selesai','Dibatalkan') DEFAULT 'Terjadwal',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jadwal`),
  KEY `idx_tanggal` (`tanggal`),
  KEY `idx_jenis` (`id_jenis_ibadah`),
  KEY `idx_status` (`status`),
  KEY `fk_jenis_ibadah` (`id_jenis_ibadah`),
  CONSTRAINT `fk_jenis_ibadah` FOREIGN KEY (`id_jenis_ibadah`) REFERENCES `custome__jenis_ibadah` (`id_jenis_ibadah`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel jabatan pelayanan
CREATE TABLE `custome__jabatan_pelayanan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `warna` varchar(7) DEFAULT '#28a745',
  `urutan` int(11) DEFAULT 0,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jabatan`),
  KEY `idx_urutan` (`urutan`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel pelayan ibadah
CREATE TABLE `custome__pelayan_ibadah` (
  `id_pelayan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `id_jemaat` int(11) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_pelayan` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status_konfirmasi` enum('Pending','Dikonfirmasi','Ditolak') DEFAULT 'Pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pelayan`),
  KEY `fk_jadwal_pelayan` (`id_jadwal`),
  KEY `fk_jemaat_pelayan` (`id_jemaat`),
  KEY `fk_jabatan_pelayan` (`id_jabatan`),
  CONSTRAINT `fk_jadwal_pelayan` FOREIGN KEY (`id_jadwal`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE,
  CONSTRAINT `fk_jemaat_pelayan` FOREIGN KEY (`id_jemaat`) REFERENCES `custome__jemaat` (`id_jemaat`) ON DELETE SET NULL,
  CONSTRAINT `fk_jabatan_pelayan` FOREIGN KEY (`id_jabatan`) REFERENCES `custome__jabatan_pelayanan` (`id_jabatan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel lagu/musik ibadah
CREATE TABLE `custome__musik_ibadah` (
  `id_musik` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `judul_lagu` varchar(255) NOT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `nomor_kidung` varchar(20) DEFAULT NULL,
  `kategori` enum('Pembukaan','Pujian','Penyembahan','Persembahan','Penutup','Khusus') DEFAULT 'Pujian',
  `urutan` int(11) DEFAULT 0,
  `chord` text DEFAULT NULL,
  `lirik` text DEFAULT NULL,
  `audio_file` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_musik`),
  KEY `fk_jadwal_musik` (`id_jadwal`),
  KEY `idx_urutan` (`urutan`),
  CONSTRAINT `fk_jadwal_musik` FOREIGN KEY (`id_jadwal`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel pengumuman ibadah
CREATE TABLE `custome__pengumuman_ibadah` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `judul_pengumuman` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `is_penting` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pengumuman`),
  KEY `fk_jadwal_pengumuman` (`id_jadwal`),
  KEY `idx_urutan` (`urutan`),
  CONSTRAINT `fk_jadwal_pengumuman` FOREIGN KEY (`id_jadwal`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel kehadiran ibadah
CREATE TABLE `custome__kehadiran_ibadah` (
  `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `id_jemaat` int(11) DEFAULT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `jenis_kehadiran` enum('Jemaat','Tamu','Anak') DEFAULT 'Jemaat',
  `waktu_hadir` timestamp DEFAULT CURRENT_TIMESTAMP,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id_kehadiran`),
  KEY `fk_jadwal_kehadiran` (`id_jadwal`),
  KEY `fk_jemaat_kehadiran` (`id_jemaat`),
  CONSTRAINT `fk_jadwal_kehadiran` FOREIGN KEY (`id_jadwal`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE,
  CONSTRAINT `fk_jemaat_kehadiran` FOREIGN KEY (`id_jemaat`) REFERENCES `custome__jemaat` (`id_jemaat`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel persembahan ibadah
CREATE TABLE `custome__persembahan_ibadah` (
  `id_persembahan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `jenis_persembahan` enum('Persepuluhan','Persembahan Syukur','Persembahan Khusus','Kolekte','Lainnya') NOT NULL,
  `jumlah` decimal(15,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `dicatat_oleh` int(11) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_persembahan`),
  KEY `fk_jadwal_persembahan` (`id_jadwal`),
  CONSTRAINT `fk_jadwal_persembahan` FOREIGN KEY (`id_jadwal`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data sample jenis ibadah
INSERT INTO `custome__jenis_ibadah` (`nama_jenis`, `deskripsi`, `warna`, `durasi_menit`) VALUES
('Ibadah Minggu Pagi', 'Ibadah rutin hari Minggu pagi', '#007bff', 120),
('Ibadah Minggu Sore', 'Ibadah rutin hari Minggu sore', '#17a2b8', 90),
('Ibadah Rabu', 'Ibadah tengah minggu hari Rabu', '#28a745', 90),
('Ibadah Jumat', 'Ibadah doa dan pujian hari Jumat', '#ffc107', 60),
('Ibadah Natal', 'Ibadah perayaan Natal', '#dc3545', 150),
('Ibadah Paskah', 'Ibadah perayaan Paskah', '#fd7e14', 150),
('Ibadah Tahun Baru', 'Ibadah menyambut tahun baru', '#6f42c1', 120),
('Ibadah Khusus', 'Ibadah untuk acara khusus', '#6c757d', 90);

-- Insert data sample jabatan pelayanan
INSERT INTO `custome__jabatan_pelayanan` (`nama_jabatan`, `deskripsi`, `warna`, `urutan`) VALUES
('Pendeta/Pengkhotbah', 'Memimpin ibadah dan menyampaikan khotbah', '#dc3545', 1),
('Liturgis', 'Memimpin liturgi ibadah', '#007bff', 2),
('Organis/Pianis', 'Memainkan musik pengiring', '#28a745', 3),
('Pemimpin Pujian', 'Memimpin pujian dan penyembahan', '#17a2b8', 4),
('Koor/Paduan Suara', 'Menyanyikan lagu khusus', '#ffc107', 5),
('Lektor', 'Membaca firman Tuhan', '#fd7e14', 6),
('Kolektan', 'Mengumpulkan persembahan', '#6f42c1', 7),
('Usher/Penyambut', 'Menyambut dan mengarahkan jemaat', '#20c997', 8),
('Operator Sound', 'Mengoperasikan sistem audio', '#6c757d', 9),
('Operator Proyektor', 'Mengoperasikan proyektor/layar', '#e83e8c', 10);

-- Insert data sample jadwal ibadah
INSERT INTO `custome__jadwal_ibadah` (`id_jenis_ibadah`, `judul_ibadah`, `tanggal`, `jam_mulai`, `jam_selesai`, `tema_ibadah`, `ayat_tema`) VALUES
(1, 'Ibadah Minggu Pagi', '2025-10-12', '08:00:00', '10:00:00', 'Kasih yang Tidak Berkesudahan', 'Yohanes 3:16'),
(1, 'Ibadah Minggu Pagi', '2025-10-19', '08:00:00', '10:00:00', 'Pengharapan dalam Kristus', 'Roma 15:13'),
(2, 'Ibadah Minggu Sore', '2025-10-12', '17:00:00', '18:30:00', 'Bersyukur dalam Segala Hal', '1 Tesalonika 5:18'),
(3, 'Ibadah Rabu', '2025-10-16', '19:00:00', '20:30:00', 'Doa yang Berkuasa', 'Yakobus 5:16'),
(4, 'Ibadah Jumat', '2025-10-18', '19:00:00', '20:00:00', 'Memuji Tuhan Senantiasa', 'Mazmur 34:1');
