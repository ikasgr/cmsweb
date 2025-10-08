-- ============================================
-- Tabel Pesanan UMKM
-- Date: 2025-10-08
-- Description: Sistem pemesanan produk UMKM dengan invoice
-- ============================================

-- Tabel Master Pesanan
CREATE TABLE IF NOT EXISTS `custome__pesanan` (
  `pesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(50) NOT NULL COMMENT 'Format: PO-YYYYMMDD-XXXX',
  `session_id` varchar(100) DEFAULT NULL COMMENT 'Session ID guest',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID jika login',
  `nama_pembeli` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL COMMENT 'Catatan pesanan',
  `total_item` int(11) NOT NULL DEFAULT 0,
  `total_qty` int(11) NOT NULL DEFAULT 0,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ongkir` decimal(15,2) DEFAULT 0.00,
  `total_bayar` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status_pesanan` enum('Pending','Diproses','Dikirim','Selesai','Dibatalkan') NOT NULL DEFAULT 'Pending',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `tgl_pesanan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_diproses` datetime DEFAULT NULL,
  `tgl_dikirim` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `whatsapp_sent` tinyint(1) DEFAULT 0 COMMENT '0=belum, 1=sudah kirim WA',
  `tgl_whatsapp` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT 'Admin yang proses',
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`pesanan_id`),
  UNIQUE KEY `kode_pesanan` (`kode_pesanan`),
  KEY `idx_session` (`session_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_status` (`status_pesanan`),
  KEY `idx_tgl` (`tgl_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel master pesanan';

-- Tabel Detail Pesanan
CREATE TABLE IF NOT EXISTS `custome__pesanan_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL COMMENT 'Snapshot nama produk',
  `harga` decimal(15,2) NOT NULL COMMENT 'Snapshot harga saat pesan',
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `catatan_item` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `idx_pesanan` (`pesanan_id`),
  KEY `idx_produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Detail item pesanan';

-- Add foreign keys setelah semua tabel dibuat
ALTER TABLE `custome__pesanan_detail`
  ADD CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `custome__pesanan` (`pesanan_id`) ON DELETE CASCADE;

-- Optional: Uncomment jika tabel custome__produk_umkm sudah ada
-- ALTER TABLE `custome__pesanan_detail`
--   ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `custome__produk_umkm` (`id_produk`) ON DELETE RESTRICT;

-- Tabel Tracking Status Pesanan
CREATE TABLE IF NOT EXISTS `custome__pesanan_tracking` (
  `tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'User yang update status',
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tracking_id`),
  KEY `idx_pesanan` (`pesanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tracking history status pesanan';

-- Add foreign key setelah semua tabel dibuat
ALTER TABLE `custome__pesanan_tracking`
  ADD CONSTRAINT `fk_tracking_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `custome__pesanan` (`pesanan_id`) ON DELETE CASCADE;

-- ============================================
-- Insert Sample Data (Optional)
-- ============================================

-- Sample pesanan
-- INSERT INTO custome__pesanan (kode_pesanan, nama_pembeli, no_hp, alamat, total_item, total_qty, subtotal, total_bayar, status_pesanan) 
-- VALUES ('PO-20251008-0001', 'John Doe', '081234567890', 'Jl. Contoh No. 123', 2, 3, 150000, 150000, 'Pending');

-- ============================================
-- NOTES:
-- ============================================
-- 1. Kode pesanan auto-generate: PO-YYYYMMDD-XXXX
-- 2. Status flow: Pending → Diproses → Dikirim → Selesai
-- 3. Bisa dibatalkan di status Pending/Diproses
-- 4. Snapshot nama & harga produk untuk history
-- 5. Tracking untuk audit trail
-- 6. WhatsApp sent flag untuk tracking notifikasi
-- ============================================
