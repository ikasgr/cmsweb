# 🛒 Dokumentasi Toko UMKM - Integrasi WhatsApp

## 📋 Overview

Modul Toko UMKM dengan fitur keranjang belanja dan integrasi WhatsApp untuk pemesanan langsung ke penjual.

---

## 🗂️ Database Schema

### Tabel: `custome__keranjang`
```sql
- id_keranjang (PK)
- session_id (untuk guest user)
- user_id (untuk logged in user)
- id_produk (FK to custome__produk_umkm)
- jumlah
- harga (freeze price saat add to cart)
- subtotal (jumlah x harga)
- tgl_input
```

### Tabel: `custome__produk_umkm` (Updated)
```sql
- whatsapp_admin (nomor WA per produk)
- whatsapp_template (template pesan per produk)
- whatsapp_clicks (tracking klik)
```

---

## 🎯 Fitur Utama

### 1. Keranjang Belanja
- ✅ **Add to Cart** - Tambah produk ke keranjang
- ✅ **Update Quantity** - Tombol +/- untuk ubah jumlah
- ✅ **Remove Item** - Hapus produk dari keranjang
- ✅ **Clear Cart** - Kosongkan semua keranjang
- ✅ **Real-time Calculation** - Total otomatis update
- ✅ **Stock Validation** - Cek ketersediaan stok
- ✅ **Session Based** - Keranjang tersimpan per session

### 2. Integrasi WhatsApp
- ✅ **Form Data Pembeli**:
  - Nama pembeli
  - No. HP/WhatsApp
  - Alamat pengiriman
- ✅ **Auto Generate Pesan**:
  - Data pembeli
  - Detail pesanan (nama, harga, jumlah, subtotal)
  - Total harga
  - Format rapi dengan markdown
- ✅ **Direct Link** - Buka WhatsApp dengan pesan terisi
- ✅ **Validation** - Cek kelengkapan data sebelum kirim

---

## 📱 Format Pesan WhatsApp

```
*PESANAN PRODUK UMKM*

*Data Pembeli:*
Nama: John Doe
No. HP: 081234567890
Alamat: Jl. Contoh No. 123, Jakarta

*Detail Pesanan:*
─────────────────
1. *Produk A*
   Harga: Rp 50.000
   Jumlah: 2 pcs
   Subtotal: Rp 100.000

2. *Produk B*
   Harga: Rp 75.000
   Jumlah: 1 pcs
   Subtotal: Rp 75.000

─────────────────
*TOTAL: Rp 175.000*

Mohon konfirmasi ketersediaan produk dan ongkos kirim. Terima kasih!
```

---

## 🔧 Komponen yang Diupdate

### 1. Controller
**File**: `app/Controllers/Toko.php`

**Methods:**
```php
- index()           // List produk
- detail($slug)     // Detail produk
- kategori($slug)   // Produk by kategori
- search()          // Pencarian produk
- keranjang()       // Halaman keranjang ✅ UPDATED
- addtocart()       // Tambah ke keranjang
- updatecart()      // Update jumlah ✅ UPDATED
- removecart()      // Hapus item ✅ UPDATED
- clearcart()       // Kosongkan keranjang ✅ NEW
- cartcount()       // Count badge
```

### 2. Model
**File**: `app/Models/M_Keranjang.php`

**Methods:**
```php
- bysession($session_id)    // Get cart by session ✅ UPDATED
- byuser($user_id)          // Get cart by user
- totalitem($session_id)    // Count items
- totalharga($session_id)   // Sum subtotal
- cekproduk($session_id, $id_produk) // Check if exists
- hapusbysession($session_id) // Clear cart
```

### 3. Views
**File**: `app/Views/frontend/desaku/desktop/content/toko_keranjang.php`

**Fitur:**
- ✅ Tabel daftar produk dengan gambar
- ✅ Tombol +/- untuk update quantity
- ✅ Tombol hapus per item
- ✅ Tombol kosongkan keranjang
- ✅ Ringkasan belanja (total item, qty, harga)
- ✅ **Form data pembeli** (nama, HP, alamat) ✅ NEW
- ✅ **Tombol "Pesan via WhatsApp"** ✅ NEW
- ✅ Validasi form sebelum kirim
- ✅ Auto-generate pesan WhatsApp
- ✅ Responsive design

### 4. Routes
**File**: `app/Config/Routes.php`

```php
$routes->get('toko', 'Toko::index');
$routes->get('toko/keranjang', 'Toko::keranjang');
$routes->post('toko/addtocart', 'Toko::addtocart');
$routes->post('toko/updatecart', 'Toko::updatecart');
$routes->post('toko/removecart', 'Toko::removecart');
$routes->post('toko/clearcart', 'Toko::clearcart'); ✅ NEW
$routes->get('toko/cartcount', 'Toko::cartcount');
$routes->get('toko/(:segment)', 'Toko::detail/$1');
```

---

## 🚀 Cara Penggunaan

### Customer Flow:

1. **Browse Produk**
   - Kunjungi `/toko`
   - Lihat produk yang tersedia
   - Filter by kategori atau search

2. **Add to Cart**
   - Klik tombol "Tambah ke Keranjang"
   - Produk masuk ke keranjang
   - Badge counter update

3. **Lihat Keranjang**
   - Klik icon keranjang atau `/toko/keranjang`
   - Lihat daftar produk
   - Update jumlah dengan tombol +/-
   - Hapus item jika perlu

4. **Checkout via WhatsApp**
   - Isi form data pembeli:
     - Nama lengkap
     - No. HP/WhatsApp
     - Alamat pengiriman
   - Klik "Pesan via WhatsApp"
   - WhatsApp terbuka dengan pesan terisi
   - Kirim pesan ke admin/penjual

5. **Konfirmasi**
   - Admin terima pesan di WhatsApp
   - Admin konfirmasi ketersediaan & ongkir
   - Proses transaksi via WhatsApp

---

## ⚙️ Konfigurasi

### 1. Nomor WhatsApp Admin

**Global Setting** (di tabel `custome__konfigurasi`):
```sql
INSERT INTO custome__konfigurasi (nama_key, nilai, deskripsi) VALUES
('whatsapp', '6281234567890', 'Nomor WhatsApp untuk pemesanan produk');
```

**Per Produk** (di tabel `custome__produk_umkm`):
- Field `whatsapp_admin` - Override nomor global
- Field `whatsapp_template` - Custom template pesan

### 2. Format Nomor WhatsApp
```
✅ Benar: 6281234567890
❌ Salah: +6281234567890
❌ Salah: 081234567890
```

---

## 📊 Database Tables

### custome__keranjang
```sql
CREATE TABLE custome__keranjang (
  id_keranjang INT PRIMARY KEY AUTO_INCREMENT,
  session_id VARCHAR(100) NOT NULL,
  user_id INT NULL,
  id_produk INT NOT NULL,
  jumlah INT DEFAULT 1,
  harga DECIMAL(15,2) NOT NULL,
  subtotal DECIMAL(15,2) NOT NULL,
  tgl_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_produk) REFERENCES custome__produk_umkm(id_produk) ON DELETE CASCADE
);
```

### custome__produk_umkm (Fields Tambahan)
```sql
ALTER TABLE custome__produk_umkm 
ADD COLUMN whatsapp_admin VARCHAR(20) NULL,
ADD COLUMN whatsapp_template TEXT NULL,
ADD COLUMN whatsapp_clicks INT DEFAULT 0;
```

---

## 🎨 UI/UX Features

### Keranjang Belanja
- ✅ Tabel responsive dengan gambar produk
- ✅ Input quantity dengan validasi stok
- ✅ Tombol +/- untuk update cepat
- ✅ Subtotal per item
- ✅ Total keseluruhan
- ✅ Sticky sidebar untuk ringkasan
- ✅ Empty state jika keranjang kosong

### Form Pemesanan
- ✅ Input nama pembeli
- ✅ Input no HP/WhatsApp
- ✅ Textarea alamat pengiriman
- ✅ Validasi required fields
- ✅ Button WhatsApp dengan icon

### WhatsApp Integration
- ✅ Auto-format pesan dengan markdown
- ✅ Detail lengkap per produk
- ✅ Total harga jelas
- ✅ Open in new tab
- ✅ Success notification

---

## 🔐 Security & Validation

### Backend Validation
- ✅ Cek ketersediaan produk
- ✅ Validasi stok sebelum add/update
- ✅ Session-based cart (prevent manipulation)
- ✅ AJAX request only
- ✅ CSRF protection

### Frontend Validation
- ✅ Validasi form data pembeli
- ✅ Validasi quantity (min 1, max stok)
- ✅ Confirmation dialog untuk hapus
- ✅ Error handling dengan SweetAlert2

---

## 📱 Mobile Responsive

- ✅ Tabel scroll horizontal di mobile
- ✅ Button group responsive
- ✅ Form stack di mobile
- ✅ Touch-friendly buttons
- ✅ WhatsApp app auto-open di mobile

---

## 🧪 Testing Checklist

### Keranjang Belanja
- [ ] Add produk ke keranjang
- [ ] Update quantity dengan tombol +/-
- [ ] Hapus item dari keranjang
- [ ] Kosongkan semua keranjang
- [ ] Cek validasi stok
- [ ] Cek total harga update real-time

### WhatsApp Integration
- [ ] Isi form data pembeli
- [ ] Klik "Pesan via WhatsApp"
- [ ] Cek pesan terformat dengan benar
- [ ] Cek WhatsApp terbuka
- [ ] Test di mobile (app WhatsApp)
- [ ] Test di desktop (WhatsApp Web)

### Edge Cases
- [ ] Keranjang kosong
- [ ] Stok habis saat checkout
- [ ] Session expired
- [ ] Nomor WhatsApp tidak valid
- [ ] Form tidak lengkap

---

## 🔄 User Flow Diagram

```
Customer Browse Produk
    ↓
Klik "Tambah ke Keranjang"
    ↓
Produk masuk keranjang (session-based)
    ↓
Customer lihat keranjang
    ↓
Update quantity / Hapus item (optional)
    ↓
Isi form data pembeli
    ↓
Klik "Pesan via WhatsApp"
    ↓
WhatsApp terbuka dengan pesan terisi
    ↓
Customer kirim pesan
    ↓
Admin terima pesanan di WhatsApp
    ↓
Admin konfirmasi & proses pesanan
```

---

## 📞 Support

Untuk pertanyaan atau issue, hubungi developer atau buka issue di repository.

---

## 📝 Changelog

### Version 1.0 (2025-10-08)
- ✅ Implementasi keranjang belanja
- ✅ Integrasi WhatsApp untuk pemesanan
- ✅ Form data pembeli
- ✅ Auto-generate pesan WhatsApp
- ✅ Validasi lengkap
- ✅ Responsive design

---

## 🎯 Future Enhancements

- [ ] Login user untuk save cart
- [ ] History pesanan
- [ ] Payment gateway integration
- [ ] Tracking pengiriman
- [ ] Rating & review produk
- [ ] Wishlist feature
- [ ] Promo & voucher
- [ ] Multiple address
- [ ] Order notification
- [ ] Admin dashboard pesanan

---

**Status**: ✅ READY TO USE
**Last Updated**: 2025-10-08
