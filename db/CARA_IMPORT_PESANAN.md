# 📋 Cara Import Database Pesanan UMKM

## ⚠️ Error yang Mungkin Terjadi

**Error:**
```
Can't create table `web`.`custome__pesanan_tracking` (errno: 150 "Foreign key constraint is incorrectly formed")
```

**Penyebab:**
- Foreign key dibuat sebelum tabel referensi ada
- Tabel `custome__produk_umkm` belum ada

---

## ✅ Solusi 1: Gunakan File SAFE (Recommended)

**File:** `custome__pesanan_umkm_safe.sql`

File ini sudah diperbaiki dengan:
- Foreign key dibuat SETELAH semua tabel
- Tidak ada FK ke tabel eksternal (produk)
- Urutan yang benar

**Cara Import:**
```bash
mysql -u username -p database_name < custome__pesanan_umkm_safe.sql
```

Atau via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database
3. Tab "Import"
4. Choose file: `custome__pesanan_umkm_safe.sql`
5. Click "Go"

---

## ✅ Solusi 2: Import Manual Bertahap

Jika tetap error, import satu per satu:

### Step 1: Buat Tabel Master
```sql
CREATE TABLE IF NOT EXISTS `custome__pesanan` (
  `pesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(50) NOT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
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
  `whatsapp_sent` tinyint(1) DEFAULT 0,
  `tgl_whatsapp` datetime DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`pesanan_id`),
  UNIQUE KEY `kode_pesanan` (`kode_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Step 2: Buat Tabel Detail
```sql
CREATE TABLE IF NOT EXISTS `custome__pesanan_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `catatan_item` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `idx_pesanan` (`pesanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Step 3: Buat Tabel Tracking
```sql
CREATE TABLE IF NOT EXISTS `custome__pesanan_tracking` (
  `tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `pesanan_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tracking_id`),
  KEY `idx_pesanan` (`pesanan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Step 4: Tambahkan Foreign Keys
```sql
-- FK detail ke pesanan
ALTER TABLE `custome__pesanan_detail`
  ADD CONSTRAINT `fk_detail_pesanan` 
  FOREIGN KEY (`pesanan_id`) REFERENCES `custome__pesanan` (`pesanan_id`) 
  ON DELETE CASCADE;

-- FK tracking ke pesanan
ALTER TABLE `custome__pesanan_tracking`
  ADD CONSTRAINT `fk_tracking_pesanan` 
  FOREIGN KEY (`pesanan_id`) REFERENCES `custome__pesanan` (`pesanan_id`) 
  ON DELETE CASCADE;
```

---

## ✅ Solusi 3: Drop & Recreate

Jika tabel sudah ada tapi error:

```sql
-- Drop existing tables (hati-hati, data akan hilang!)
DROP TABLE IF EXISTS `custome__pesanan_tracking`;
DROP TABLE IF EXISTS `custome__pesanan_detail`;
DROP TABLE IF EXISTS `custome__pesanan`;

-- Lalu import ulang dengan file SAFE
```

---

## 🔍 Verifikasi Import Berhasil

```sql
-- Cek tabel sudah ada
SHOW TABLES LIKE 'custome__pesanan%';

-- Cek struktur tabel
DESCRIBE custome__pesanan;
DESCRIBE custome__pesanan_detail;
DESCRIBE custome__pesanan_tracking;

-- Cek foreign keys
SELECT 
  TABLE_NAME,
  CONSTRAINT_NAME,
  REFERENCED_TABLE_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'your_database_name'
  AND TABLE_NAME LIKE 'custome__pesanan%'
  AND REFERENCED_TABLE_NAME IS NOT NULL;
```

---

## 📊 Test Insert Data

```sql
-- Test insert pesanan
INSERT INTO custome__pesanan 
(kode_pesanan, nama_pembeli, no_hp, alamat, total_item, total_qty, subtotal, total_bayar, status_pesanan) 
VALUES 
('PO-20251008-0001', 'Test User', '081234567890', 'Jl. Test No. 123', 1, 2, 100000, 100000, 'Pending');

-- Test insert detail
INSERT INTO custome__pesanan_detail 
(pesanan_id, id_produk, nama_produk, harga, jumlah, subtotal) 
VALUES 
(1, 1, 'Produk Test', 50000, 2, 100000);

-- Test insert tracking
INSERT INTO custome__pesanan_tracking 
(pesanan_id, status, keterangan) 
VALUES 
(1, 'Pending', 'Pesanan dibuat');

-- Cek hasil
SELECT * FROM custome__pesanan;
SELECT * FROM custome__pesanan_detail;
SELECT * FROM custome__pesanan_tracking;
```

---

## 🚨 Troubleshooting

### Error: Table already exists
```sql
-- Drop dulu
DROP TABLE IF EXISTS custome__pesanan_tracking;
DROP TABLE IF EXISTS custome__pesanan_detail;
DROP TABLE IF EXISTS custome__pesanan;
```

### Error: Cannot add foreign key
```sql
-- Cek apakah tabel referensi ada
SELECT TABLE_NAME FROM information_schema.TABLES 
WHERE TABLE_SCHEMA = 'your_database' 
  AND TABLE_NAME = 'custome__pesanan';

-- Cek tipe data kolom sama
DESCRIBE custome__pesanan;
DESCRIBE custome__pesanan_detail;
```

### Error: Access denied
```sql
-- Pastikan user punya privilege
GRANT ALL PRIVILEGES ON database_name.* TO 'username'@'localhost';
FLUSH PRIVILEGES;
```

---

## ✅ Checklist Import

- [ ] Backup database dulu (jika ada data penting)
- [ ] Gunakan file `custome__pesanan_umkm_safe.sql`
- [ ] Import via phpMyAdmin atau mysql command
- [ ] Verifikasi 3 tabel berhasil dibuat
- [ ] Verifikasi foreign keys ada
- [ ] Test insert data
- [ ] Test aplikasi checkout

---

## 📞 Support

Jika masih error:
1. Screenshot error lengkap
2. Cek versi MySQL: `SELECT VERSION();`
3. Cek engine: `SHOW ENGINES;`
4. Pastikan InnoDB aktif

---

**File yang Digunakan:**
- ✅ `custome__pesanan_umkm_safe.sql` - Recommended
- ⚠️ `custome__pesanan_umkm.sql` - Sudah diperbaiki tapi mungkin masih error

**Status:** READY TO IMPORT
**Last Updated:** 2025-10-08
