-- ============================================
-- SQL untuk Modul Jadwal Pelayanan Gereja
-- ============================================

-- Tabel Jadwal Pelayanan
CREATE TABLE IF NOT EXISTS `custome__jadwal_pelayanan` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `judul_jadwal` varchar(255) NOT NULL,
  `jenis_pelayanan` enum('Ibadah Minggu','Ibadah Pemuda','Ibadah Anak','Persekutuan Doa','Komsel','Kebaktian Khusus','Acara Gereja','Lainnya') NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `tempat` varchar(255) DEFAULT 'Gedung Gereja',
  `pengkhotbah` varchar(255) DEFAULT NULL,
  `liturgis` varchar(255) DEFAULT NULL,
  `singer` text DEFAULT NULL COMMENT 'Nama-nama singer, dipisah koma',
  `pemusik` text DEFAULT NULL COMMENT 'Nama-nama pemusik, dipisah koma',
  `multimedia` varchar(255) DEFAULT NULL,
  `usher` text DEFAULT NULL COMMENT 'Nama-nama usher, dipisah koma',
  `keterangan` text DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Draft, 1=Published',
  `warna` varchar(7) DEFAULT '#007bff' COMMENT 'Warna untuk calendar',
  `user_id` int(11) DEFAULT NULL,
  `tgl_input` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jadwal`),
  KEY `idx_tanggal` (`tanggal`),
  KEY `idx_jenis` (`jenis_pelayanan`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Sample Data
-- ============================================

-- Jadwal Ibadah Minggu
INSERT INTO `custome__jadwal_pelayanan` 
(`judul_jadwal`, `jenis_pelayanan`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `tempat`, `pengkhotbah`, `liturgis`, `singer`, `pemusik`, `multimedia`, `usher`, `keterangan`, `status`, `warna`, `user_id`) 
VALUES
-- Minggu ini
('Ibadah Minggu I', 'Ibadah Minggu', DATE_ADD(CURDATE(), INTERVAL (7 - WEEKDAY(CURDATE())) DAY), '07:00:00', '09:00:00', 'Gedung Gereja Utama', 'Pdt. John Doe', 'Maria Susanti', 'Tim Worship A', 'Tim Band A', 'David Chen', 'Tim Usher A', 'Ibadah Minggu Pertama', '1', '#007bff', 1),

('Ibadah Minggu II', 'Ibadah Minggu', DATE_ADD(CURDATE(), INTERVAL (7 - WEEKDAY(CURDATE())) DAY), '10:00:00', '12:00:00', 'Gedung Gereja Utama', 'Pdt. Jane Smith', 'Robert Tan', 'Tim Worship B', 'Tim Band B', 'Sarah Lee', 'Tim Usher B', 'Ibadah Minggu Kedua', '1', '#007bff', 1),

-- Minggu depan
('Ibadah Minggu I', 'Ibadah Minggu', DATE_ADD(CURDATE(), INTERVAL (14 - WEEKDAY(CURDATE())) DAY), '07:00:00', '09:00:00', 'Gedung Gereja Utama', 'Pdt. Michael Wong', 'Linda Wijaya', 'Tim Worship C', 'Tim Band C', 'David Chen', 'Tim Usher C', 'Ibadah Minggu Pertama', '1', '#007bff', 1),

('Ibadah Minggu II', 'Ibadah Minggu', DATE_ADD(CURDATE(), INTERVAL (14 - WEEKDAY(CURDATE())) DAY), '10:00:00', '12:00:00', 'Gedung Gereja Utama', 'Pdt. Sarah Johnson', 'Kevin Lim', 'Tim Worship A', 'Tim Band A', 'Sarah Lee', 'Tim Usher A', 'Ibadah Minggu Kedua', '1', '#007bff', 1),

-- Ibadah Pemuda (Sabtu)
('Ibadah Pemuda', 'Ibadah Pemuda', DATE_ADD(CURDATE(), INTERVAL (6 - WEEKDAY(CURDATE())) DAY), '18:00:00', '20:00:00', 'Aula Gereja', 'Pdt. Youth Leader', 'Youth Team', 'Youth Worship Team', 'Youth Band', 'Youth Multimedia', 'Youth Usher', 'Ibadah khusus pemuda', '1', '#28a745', 1),

-- Persekutuan Doa (Rabu)
('Persekutuan Doa', 'Persekutuan Doa', DATE_ADD(CURDATE(), INTERVAL (3 - WEEKDAY(CURDATE())) DAY), '19:00:00', '21:00:00', 'Ruang Doa', 'Pdt. Prayer Leader', NULL, NULL, NULL, NULL, NULL, 'Persekutuan doa rutin', '1', '#ffc107', 1),

-- Ibadah Anak (Minggu)
('Sekolah Minggu', 'Ibadah Anak', DATE_ADD(CURDATE(), INTERVAL (7 - WEEKDAY(CURDATE())) DAY), '09:00:00', '11:00:00', 'Ruang Anak', 'Guru Sekolah Minggu', NULL, NULL, NULL, NULL, NULL, 'Sekolah Minggu untuk anak-anak', '1', '#17a2b8', 1),

-- Komsel (Jumat)
('Komsel Wilayah A', 'Komsel', DATE_ADD(CURDATE(), INTERVAL (5 - WEEKDAY(CURDATE())) DAY), '19:00:00', '21:00:00', 'Rumah Jemaat A', 'Ketua Komsel A', NULL, NULL, NULL, NULL, NULL, 'Komsel wilayah A', '1', '#6f42c1', 1),

('Komsel Wilayah B', 'Komsel', DATE_ADD(CURDATE(), INTERVAL (5 - WEEKDAY(CURDATE())) DAY), '19:00:00', '21:00:00', 'Rumah Jemaat B', 'Ketua Komsel B', NULL, NULL, NULL, NULL, NULL, 'Komsel wilayah B', '1', '#6f42c1', 1);

-- ============================================
-- Index untuk performa
-- ============================================

-- Index untuk pencarian berdasarkan tanggal dan status
CREATE INDEX idx_tanggal_status ON custome__jadwal_pelayanan(tanggal, status);

-- Index untuk pencarian berdasarkan jenis dan tanggal
CREATE INDEX idx_jenis_tanggal ON custome__jadwal_pelayanan(jenis_pelayanan, tanggal);
