-- ============================================
-- Update Produk UMKM - WhatsApp Integration
-- Date: 2025-10-08
-- Description: Menambahkan field untuk integrasi WhatsApp
-- ============================================

-- Tambah field nomor WhatsApp untuk kontak pembelian
ALTER TABLE `custome__produk_umkm` 
ADD COLUMN `whatsapp_admin` varchar(20) DEFAULT NULL COMMENT 'Nomor WhatsApp untuk pembelian' AFTER `user_id`;

-- Tambah field pesan template WhatsApp
ALTER TABLE `custome__produk_umkm` 
ADD COLUMN `whatsapp_template` text DEFAULT NULL COMMENT 'Template pesan WhatsApp' AFTER `whatsapp_admin`;

-- Update konfigurasi global untuk nomor WhatsApp default
-- Buat tabel konfigurasi jika belum ada
CREATE TABLE IF NOT EXISTS `custome__konfigurasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_key` varchar(100) NOT NULL,
  `nilai` text DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`nama_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Konfigurasi sistem';

-- Insert konfigurasi WhatsApp default
INSERT INTO `custome__konfigurasi` (`nama_key`, `nilai`, `deskripsi`) VALUES
('whatsapp_admin', '6281234567890', 'Nomor WhatsApp Admin untuk pembelian produk (format: 62xxx)'),
('whatsapp_template', 'Halo, saya tertarik dengan produk:\n\n*{nama_produk}*\nHarga: Rp {harga}\n\nApakah produk ini masih tersedia?', 'Template pesan WhatsApp default')
ON DUPLICATE KEY UPDATE nilai = VALUES(nilai);

-- Tambah field untuk tracking klik WhatsApp
ALTER TABLE `custome__produk_umkm` 
ADD COLUMN `whatsapp_clicks` int(11) DEFAULT 0 COMMENT 'Jumlah klik tombol WhatsApp' AFTER `hits`;

-- ============================================
-- NOTES:
-- ============================================
-- 1. Nomor WhatsApp harus dalam format internasional (62xxx)
-- 2. Template pesan bisa menggunakan placeholder:
--    {nama_produk}, {harga}, {kategori}, {link}
-- 3. Tracking klik WhatsApp untuk analytics
-- ============================================
