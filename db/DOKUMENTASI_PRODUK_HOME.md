# 📦 Dokumentasi Tampilan Produk di Homepage

## 🎯 Overview

Menampilkan lebih banyak produk di homepage dengan layout responsive dan modern.

---

## 📋 Perubahan yang Dilakukan

### 1. **Slider Produk Featured** (Sudah Ada)
- ✅ Menampilkan 12 produk featured (sebelumnya 8)
- ✅ Slider dengan 4 kolom di desktop
- ✅ Responsive: 3 kolom (tablet), 2 kolom (mobile), 1 kolom (small mobile)
- ✅ Auto-play dengan navigation controls

### 2. **Grid Produk Terbaru** (Baru)
- ✅ Menampilkan 8 produk terbaru
- ✅ Grid layout 4 kolom di desktop
- ✅ Responsive: 3 kolom (tablet), 2 kolom (mobile)
- ✅ Card design dengan hover effect
- ✅ Badge diskon dan stok
- ✅ Tombol "Lihat Semua Produk"

---

## 🔧 Cara Implementasi

### Opsi 1: Include File (Recommended)

Tambahkan di `v_home.php` setelah section slider produk (sekitar baris 742):

```php
<!-- End Produk UMKM Section -->

<?php 
// Include section produk grid
include(APPPATH . 'Views/frontend/desaku/desktop/content/v_produk_home.php');
?>

<div class="container bg-light-blue ">
```

### Opsi 2: Copy-Paste Manual

1. Buka file: `app/Views/frontend/desaku/desktop/content/v_produk_home.php`
2. Copy semua isi file
3. Paste di `v_home.php` setelah baris:
   ```php
   <!-- End Produk UMKM Section -->
   ```
4. Sebelum baris:
   ```php
   <div class="container bg-light-blue ">
   ```

---

## 🎨 Fitur Tampilan

### Card Design
- ✅ Shadow effect
- ✅ Hover animation (lift up)
- ✅ Image zoom on hover
- ✅ Responsive image height

### Badge System
- 🔴 **Badge Diskon** - Merah, pojok kanan atas
- ⚫ **Badge Habis** - Abu-abu, pojok kiri atas (jika stok = 0)
- 🟡 **Badge Stok Terbatas** - Kuning, pojok kiri atas (jika stok ≤ 5)

### Price Display
- ✅ Harga coret jika ada promo
- ✅ Harga promo/normal dengan font besar
- ✅ Format Rupiah dengan separator

### Button & Links
- ✅ Tombol "Detail" per produk
- ✅ Tombol "Lihat Semua Produk" di bawah
- ✅ Link ke halaman toko

---

## 📱 Responsive Breakpoints

### Desktop (≥ 992px)
- Slider: 4 produk per slide
- Grid: 4 kolom (col-lg-3)
- Image height: 200px

### Tablet (768px - 991px)
- Slider: 3 produk per slide
- Grid: 3 kolom (col-md-4)
- Image height: 200px

### Mobile (576px - 767px)
- Slider: 2 produk per slide
- Grid: 2 kolom (col-sm-6)
- Image height: 180px

### Small Mobile (< 576px)
- Slider: 1 produk per slide
- Grid: 1 kolom (full width)
- Image height: 160px

---

## 🎯 Total Produk Ditampilkan

**Sebelum:**
- Slider: 8 produk featured
- **Total: 8 produk**

**Sesudah:**
- Slider: 12 produk featured
- Grid: 8 produk terbaru
- **Total: 20 produk** ✨

---

## 🔄 Query Database

### Slider (Featured Products)
```php
$produk_featured = $produk_model->featured()->limit(12)->get()->getResultArray();
```

### Grid (Latest Products)
```php
$produk_all = $produk_model->where('status', 'Publish')
                          ->orderBy('tgl_input', 'DESC')
                          ->limit(8)
                          ->get()
                          ->getResultArray();
```

---

## 🎨 CSS Styling

File sudah include CSS inline untuk:
- ✅ Card hover effects
- ✅ Image zoom animation
- ✅ Responsive image heights
- ✅ Text truncation (2 lines max)
- ✅ Mobile optimizations

---

## 🚀 Testing Checklist

- [ ] Slider menampilkan 12 produk
- [ ] Grid menampilkan 8 produk terbaru
- [ ] Badge diskon muncul jika ada promo
- [ ] Badge stok muncul sesuai kondisi
- [ ] Hover effect berfungsi
- [ ] Responsive di semua device
- [ ] Link ke detail produk bekerja
- [ ] Tombol "Lihat Semua" redirect ke /toko
- [ ] Image loading dengan benar
- [ ] Price format Rupiah benar

---

## 📂 File Structure

```
app/Views/frontend/desaku/desktop/
├── v_home.php (file utama - edit di sini)
└── content/
    └── v_produk_home.php (section produk grid - file baru)
```

---

## 🔍 Troubleshooting

### Produk tidak muncul
- Cek tabel `custome__produk_umkm` ada data
- Cek field `status` = 'Publish'
- Cek field `featured` = 1 untuk slider
- Cek path gambar di `public/img/produk/`

### Layout berantakan
- Pastikan Bootstrap CSS loaded
- Cek console browser untuk error CSS
- Pastikan tidak ada conflict dengan CSS lain

### Image tidak muncul
- Cek folder `public/img/produk/` exists
- Cek permission folder (755)
- Cek nama file gambar di database match dengan file fisik

---

## 💡 Tips Optimasi

1. **Lazy Loading Images**
   ```html
   <img loading="lazy" src="...">
   ```

2. **Cache Query**
   ```php
   $produk_all = cache()->remember('home_products', 3600, function() use ($produk_model) {
       return $produk_model->where('status', 'Publish')->limit(8)->get()->getResultArray();
   });
   ```

3. **Image Optimization**
   - Compress images sebelum upload
   - Gunakan WebP format
   - Set max width/height saat upload

---

## 📊 Performance

**Before:**
- 8 produk loaded
- 1 query database

**After:**
- 20 produk loaded
- 2 query database
- Minimal impact (queries optimized)

---

## 🎉 Hasil Akhir

**Homepage sekarang menampilkan:**
1. ✅ 12 produk featured dalam slider (auto-play)
2. ✅ 8 produk terbaru dalam grid layout
3. ✅ Total 20 produk visible
4. ✅ Fully responsive
5. ✅ Modern card design
6. ✅ Smooth animations
7. ✅ Badge system informatif
8. ✅ Easy navigation ke toko

---

**Status**: ✅ READY TO IMPLEMENT
**Last Updated**: 2025-10-08
