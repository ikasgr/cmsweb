-- ============================================
-- Tabel Keranjang Belanja Toko UMKM
-- Date: 2025-10-08
-- Description: Tabel untuk menyimpan keranjang belanja sementara
-- ============================================

CREATE TABLE IF NOT EXISTS `custome__keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL COMMENT 'Session ID pengunjung',
  `user_id` int(11) DEFAULT NULL COMMENT 'User ID jika login',
  `id_produk` int(11) NOT NULL COMMENT 'FK to custome__produk_umkm',
  `jumlah` int(11) NOT NULL DEFAULT 1 COMMENT 'Jumlah produk',
  `harga` decimal(15,2) NOT NULL COMMENT 'Harga saat ditambahkan',
  `subtotal` decimal(15,2) NOT NULL COMMENT 'Jumlah x Harga',
  `tgl_input` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keranjang`),
  KEY `idx_session` (`session_id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_produk` (`id_produk`),
  KEY `fk_keranjang_produk` (`id_produk`),
  CONSTRAINT `fk_keranjang_produk` FOREIGN KEY (`id_produk`) REFERENCES `custome__produk_umkm` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Keranjang belanja sementara';

-- ============================================
-- NOTES:
-- ============================================
-- 1. Session ID untuk tracking keranjang guest user
-- 2. User ID untuk tracking keranjang logged in user
-- 3. Harga disimpan saat add to cart (freeze price)
-- 4. Auto delete jika produk dihapus (CASCADE)
-- 5. Bisa tambahkan expired_at untuk auto cleanup
-- ============================================

-- Optional: Auto cleanup keranjang lama (> 7 hari)
-- CREATE EVENT IF NOT EXISTS cleanup_old_cart
-- ON SCHEDULE EVERY 1 DAY
-- DO
--   DELETE FROM custome__keranjang WHERE tgl_input < DATE_SUB(NOW(), INTERVAL 7 DAY);
