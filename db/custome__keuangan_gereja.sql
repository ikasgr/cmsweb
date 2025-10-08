-- =============================================
-- Database Schema: Modul Keuangan Gereja
-- Dibuat: 8 Oktober 2025
-- Untuk: CMS Gereja - Sistem Informasi Lengkap
-- =============================================

-- Tabel kategori keuangan
CREATE TABLE `custome__kategori_keuangan` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `warna` varchar(7) DEFAULT '#007bff',
  `is_default` tinyint(1) DEFAULT 0,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kategori`),
  KEY `idx_jenis` (`jenis`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel transaksi keuangan utama
CREATE TABLE `custome__transaksi_keuangan` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) NOT NULL UNIQUE,
  `id_kategori` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` enum('Pemasukan','Pengeluaran') NOT NULL,
  `jumlah` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `bukti_transaksi` varchar(255) DEFAULT NULL,
  `metode_pembayaran` enum('Tunai','Transfer','Cek','Kartu') DEFAULT 'Tunai',
  `no_referensi` varchar(100) DEFAULT NULL,
  `id_jadwal_ibadah` int(11) DEFAULT NULL,
  `status` enum('Pending','Disetujui','Ditolak','Dibatalkan') DEFAULT 'Pending',
  `disetujui_oleh` int(11) DEFAULT NULL,
  `tanggal_persetujuan` datetime DEFAULT NULL,
  `catatan_persetujuan` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaksi`),
  KEY `idx_kode` (`kode_transaksi`),
  KEY `idx_tanggal` (`tanggal_transaksi`),
  KEY `idx_jenis` (`jenis_transaksi`),
  KEY `idx_status` (`status`),
  KEY `fk_kategori_keuangan` (`id_kategori`),
  KEY `fk_jadwal_ibadah_keuangan` (`id_jadwal_ibadah`),
  CONSTRAINT `fk_kategori_keuangan` FOREIGN KEY (`id_kategori`) REFERENCES `custome__kategori_keuangan` (`id_kategori`) ON DELETE RESTRICT,
  CONSTRAINT `fk_jadwal_ibadah_keuangan` FOREIGN KEY (`id_jadwal_ibadah`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel persembahan detail
CREATE TABLE `custome__persembahan_detail` (
  `id_persembahan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_jadwal_ibadah` int(11) NOT NULL,
  `jenis_persembahan` enum('Persepuluhan','Persembahan Syukur','Persembahan Khusus','Kolekte','Misi','Diakonia','Lainnya') NOT NULL,
  `jumlah` decimal(15,2) NOT NULL DEFAULT 0.00,
  `mata_uang` varchar(3) DEFAULT 'IDR',
  `keterangan` text DEFAULT NULL,
  `dicatat_oleh` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_persembahan_detail`),
  KEY `fk_transaksi_persembahan` (`id_transaksi`),
  KEY `fk_jadwal_persembahan` (`id_jadwal_ibadah`),
  CONSTRAINT `fk_transaksi_persembahan` FOREIGN KEY (`id_transaksi`) REFERENCES `custome__transaksi_keuangan` (`id_transaksi`) ON DELETE CASCADE,
  CONSTRAINT `fk_jadwal_persembahan` FOREIGN KEY (`id_jadwal_ibadah`) REFERENCES `custome__jadwal_ibadah` (`id_jadwal`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel budget/anggaran
CREATE TABLE `custome__budget_gereja` (
  `id_budget` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` year NOT NULL,
  `bulan` tinyint(2) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah_budget` decimal(15,2) NOT NULL DEFAULT 0.00,
  `jumlah_realisasi` decimal(15,2) DEFAULT 0.00,
  `persentase_realisasi` decimal(5,2) DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `status` enum('Draft','Aktif','Selesai') DEFAULT 'Draft',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_budget`),
  KEY `idx_tahun_bulan` (`tahun`, `bulan`),
  KEY `fk_kategori_budget` (`id_kategori`),
  CONSTRAINT `fk_kategori_budget` FOREIGN KEY (`id_kategori`) REFERENCES `custome__kategori_keuangan` (`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel kas/saldo
CREATE TABLE `custome__kas_gereja` (
  `id_kas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kas` varchar(100) NOT NULL,
  `jenis_kas` enum('Kas Utama','Kas Khusus','Tabungan','Deposito') DEFAULT 'Kas Utama',
  `saldo_awal` decimal(15,2) DEFAULT 0.00,
  `saldo_akhir` decimal(15,2) DEFAULT 0.00,
  `bank` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kas`),
  KEY `idx_jenis` (`jenis_kas`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel mutasi kas
CREATE TABLE `custome__mutasi_kas` (
  `id_mutasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_kas` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tanggal_mutasi` datetime NOT NULL,
  `jenis_mutasi` enum('Masuk','Keluar') NOT NULL,
  `jumlah` decimal(15,2) NOT NULL DEFAULT 0.00,
  `saldo_sebelum` decimal(15,2) NOT NULL DEFAULT 0.00,
  `saldo_sesudah` decimal(15,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_mutasi`),
  KEY `idx_tanggal` (`tanggal_mutasi`),
  KEY `fk_kas_mutasi` (`id_kas`),
  KEY `fk_transaksi_mutasi` (`id_transaksi`),
  CONSTRAINT `fk_kas_mutasi` FOREIGN KEY (`id_kas`) REFERENCES `custome__kas_gereja` (`id_kas`) ON DELETE CASCADE,
  CONSTRAINT `fk_transaksi_mutasi` FOREIGN KEY (`id_transaksi`) REFERENCES `custome__transaksi_keuangan` (`id_transaksi`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel laporan keuangan
CREATE TABLE `custome__laporan_keuangan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_laporan` enum('Bulanan','Triwulan','Semester','Tahunan') NOT NULL,
  `periode_mulai` date NOT NULL,
  `periode_selesai` date NOT NULL,
  `total_pemasukan` decimal(15,2) DEFAULT 0.00,
  `total_pengeluaran` decimal(15,2) DEFAULT 0.00,
  `saldo_awal` decimal(15,2) DEFAULT 0.00,
  `saldo_akhir` decimal(15,2) DEFAULT 0.00,
  `file_laporan` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Final','Published') DEFAULT 'Draft',
  `dibuat_oleh` int(11) NOT NULL,
  `disetujui_oleh` int(11) DEFAULT NULL,
  `tanggal_persetujuan` datetime DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_laporan`),
  KEY `idx_periode` (`periode_mulai`, `periode_selesai`),
  KEY `idx_jenis` (`jenis_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data sample kategori keuangan
INSERT INTO `custome__kategori_keuangan` (`nama_kategori`, `jenis`, `deskripsi`, `warna`, `is_default`) VALUES
-- Pemasukan
('Persepuluhan', 'Pemasukan', 'Persepuluhan dari jemaat', '#28a745', 1),
('Persembahan Syukur', 'Pemasukan', 'Persembahan syukur dalam ibadah', '#17a2b8', 1),
('Persembahan Khusus', 'Pemasukan', 'Persembahan untuk keperluan khusus', '#ffc107', 0),
('Kolekte', 'Pemasukan', 'Kolekte dalam ibadah', '#6f42c1', 0),
('Donasi', 'Pemasukan', 'Donasi dari pihak luar', '#fd7e14', 0),
('Sewa Gedung', 'Pemasukan', 'Pendapatan dari sewa fasilitas gereja', '#20c997', 0),
('Bunga Bank', 'Pemasukan', 'Bunga dari tabungan/deposito', '#6c757d', 0),
-- Pengeluaran
('Gaji Pendeta', 'Pengeluaran', 'Gaji dan tunjangan pendeta', '#dc3545', 1),
('Gaji Pegawai', 'Pengeluaran', 'Gaji pegawai gereja', '#e83e8c', 1),
('Listrik & Air', 'Pengeluaran', 'Biaya listrik dan air', '#fd7e14', 1),
('Pemeliharaan Gedung', 'Pengeluaran', 'Biaya pemeliharaan dan perbaikan', '#6f42c1', 0),
('Konsumsi', 'Pengeluaran', 'Biaya konsumsi acara gereja', '#20c997', 0),
('ATK & Operasional', 'Pengeluaran', 'Alat tulis kantor dan operasional', '#6c757d', 0),
('Misi & Diakonia', 'Pengeluaran', 'Dana untuk misi dan pelayanan sosial', '#28a745', 0),
('Transportasi', 'Pengeluaran', 'Biaya transportasi kegiatan gereja', '#17a2b8', 0);

-- Insert data sample kas gereja
INSERT INTO `custome__kas_gereja` (`nama_kas`, `jenis_kas`, `saldo_awal`, `saldo_akhir`, `bank`, `no_rekening`, `atas_nama`) VALUES
('Kas Utama', 'Kas Utama', 10000000.00, 10000000.00, 'BCA', '1234567890', 'Gereja Kristen Indonesia'),
('Kas Persembahan', 'Kas Khusus', 5000000.00, 5000000.00, NULL, NULL, NULL),
('Tabungan Pembangunan', 'Tabungan', 50000000.00, 50000000.00, 'Mandiri', '0987654321', 'Gereja Kristen Indonesia'),
('Dana Misi', 'Kas Khusus', 2000000.00, 2000000.00, NULL, NULL, NULL);

-- Insert data sample transaksi
INSERT INTO `custome__transaksi_keuangan` (`kode_transaksi`, `id_kategori`, `tanggal_transaksi`, `jenis_transaksi`, `jumlah`, `sumber_dana`, `keterangan`, `status`, `created_by`) VALUES
('TRX001', 1, '2025-10-01', 'Pemasukan', 15000000.00, 'Jemaat', 'Persepuluhan bulan Oktober 2025', 'Disetujui', 1),
('TRX002', 2, '2025-10-06', 'Pemasukan', 8000000.00, 'Jemaat', 'Persembahan syukur ibadah Minggu', 'Disetujui', 1),
('TRX003', 8, '2025-10-01', 'Pengeluaran', 5000000.00, 'Kas Utama', 'Gaji pendeta bulan Oktober', 'Disetujui', 1),
('TRX004', 10, '2025-10-05', 'Pengeluaran', 1500000.00, 'Kas Utama', 'Bayar listrik dan air bulan September', 'Disetujui', 1),
('TRX005', 3, '2025-10-08', 'Pemasukan', 25000000.00, 'Jemaat', 'Persembahan khusus untuk renovasi gereja', 'Pending', 1);
