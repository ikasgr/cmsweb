-- ============================================
-- SQL untuk Modul Penjualan Produk UMKM Gereja
-- ============================================

-- Tabel Kategori Produk
CREATE TABLE IF NOT EXISTS `custome__kategori_produk` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `slug_kategori` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Nonaktif, 1=Aktif',
  PRIMARY KEY (`kategori_id`),
  UNIQUE KEY `slug_kategori` (`slug_kategori`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Produk UMKM
CREATE TABLE IF NOT EXISTS `custome__produk_umkm` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `slug_produk` varchar(300) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(15,2) NOT NULL,
  `harga_promo` decimal(15,2) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `berat` int(11) DEFAULT NULL COMMENT 'Berat dalam gram',
  `satuan` varchar(50) DEFAULT 'pcs',
  `gambar` varchar(255) DEFAULT NULL,
  `galeri` text DEFAULT NULL COMMENT 'JSON array gambar tambahan',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Nonaktif, 1=Aktif',
  `featured` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Tidak, 1=Ya',
  `hits` int(11) DEFAULT 0,
  `tgl_input` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  UNIQUE KEY `slug_produk` (`slug_produk`),
  KEY `idx_kategori` (`kategori_id`),
  KEY `idx_status` (`status`),
  KEY `idx_featured` (`featured`),
  KEY `idx_hits` (`hits`),
  CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `custome__kategori_produk` (`kategori_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Keranjang Belanja
CREATE TABLE IF NOT EXISTS `custome__keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `tgl_input` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keranjang`),
  KEY `idx_session` (`session_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_produk` (`id_produk`),
  CONSTRAINT `fk_keranjang_produk` FOREIGN KEY (`id_produk`) REFERENCES `custome__produk_umkm` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Pesanan
CREATE TABLE IF NOT EXISTS `custome__pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `no_pesanan` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `ongkir` decimal(15,2) DEFAULT 0,
  `grand_total` decimal(15,2) NOT NULL,
  `metode_pembayaran` enum('transfer','cod','ewallet') DEFAULT 'transfer',
  `status_pembayaran` enum('unpaid','paid','failed') DEFAULT 'unpaid',
  `status_pesanan` enum('pending','diproses','dikirim','selesai','dibatalkan') DEFAULT 'pending',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT CURRENT_TIMESTAMP,
  `tgl_bayar` datetime DEFAULT NULL,
  `tgl_kirim` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `resi_pengiriman` varchar(100) DEFAULT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`),
  UNIQUE KEY `no_pesanan` (`no_pesanan`),
  KEY `idx_user` (`user_id`),
  KEY `idx_status_pembayaran` (`status_pembayaran`),
  KEY `idx_status_pesanan` (`status_pesanan`),
  KEY `idx_tgl_pesan` (`tgl_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel Detail Pesanan
CREATE TABLE IF NOT EXISTS `custome__pesanan_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `idx_pesanan` (`id_pesanan`),
  KEY `idx_produk` (`id_produk`),
  CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `custome__pesanan` (`id_pesanan`) ON DELETE CASCADE,
  CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `custome__produk_umkm` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================
-- Sample Data
-- ============================================

-- Sample Kategori
INSERT INTO `custome__kategori_produk` (`nama_kategori`, `slug_kategori`, `deskripsi`, `urutan`, `status`) VALUES
('Makanan & Minuman', 'makanan-minuman', 'Produk makanan dan minuman hasil UMKM jemaat', 1, '1'),
('Kerajinan Tangan', 'kerajinan-tangan', 'Kerajinan tangan dan souvenir', 2, '1'),
('Pakaian', 'pakaian', 'Pakaian dan aksesoris', 3, '1'),
('Buku & Literatur', 'buku-literatur', 'Buku rohani dan literatur Kristen', 4, '1'),
('Lainnya', 'lainnya', 'Produk lainnya', 5, '1');

-- Sample Produk
INSERT INTO `custome__produk_umkm` 
(`nama_produk`, `slug_produk`, `kategori_id`, `deskripsi`, `harga`, `harga_promo`, `stok`, `berat`, `satuan`, `status`, `featured`, `tgl_input`, `user_id`) 
VALUES
('Kue Kering Natal', 'kue-kering-natal', 1, 'Kue kering spesial Natal dengan berbagai varian rasa', 75000.00, 65000.00, 50, 500, 'box', '1', '1', NOW(), 1),
('Tas Rajut Handmade', 'tas-rajut-handmade', 2, 'Tas rajut buatan tangan dengan motif unik', 150000.00, NULL, 20, 300, 'pcs', '1', '1', NOW(), 1),
('Kaos Rohani', 'kaos-rohani', 3, 'Kaos dengan desain rohani berkualitas premium', 85000.00, 75000.00, 100, 200, 'pcs', '1', '0', NOW(), 1),
('Buku Renungan Harian', 'buku-renungan-harian', 4, 'Buku renungan harian untuk memperkuat iman', 50000.00, NULL, 30, 250, 'pcs', '1', '0', NOW(), 1),
('Madu Murni', 'madu-murni', 1, 'Madu murni 100% alami dari peternakan jemaat', 120000.00, 100000.00, 40, 600, 'botol', '1', '1', NOW(), 1);
