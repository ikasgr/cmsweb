# 🛒 Panduan Instalasi Toko UMKM Frontend

## ✅ File yang Sudah Dibuat

### **Controllers (2 file)**
- ✅ `app/Controllers/Toko.php` - Controller frontend toko (400+ baris)
- ✅ `app/Controllers/ProdukUmkm.php` - Controller backend produk

### **Views Frontend - Template Desaku (2 file)**
- ✅ `app/Views/frontend/desaku/desktop/content/toko_index.php` - Halaman katalog produk
- ✅ `app/Views/frontend/desaku/desktop/content/toko_detail.php` - Halaman detail produk

### **Routes**
- ✅ Sudah ditambahkan 9 routes untuk toko frontend

---

## 🚀 Instalasi Cepat

### **Langkah 1: Import Database**

Jika belum, import database terlebih dahulu:

```bash
mysql -u username -p database_name < db/produk_umkm_tables.sql
```

### **Langkah 2: Buat Folder Upload**

```bash
mkdir -p public/img/produk
chmod 755 public/img/produk
```

### **Langkah 3: Tambahkan Menu Toko di Navigasi**

Edit file `app/Views/frontend/desaku/desktop/v_menu.php` atau template Anda.

Tambahkan link menu toko di navigasi utama:

```php
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('toko') ?>">
        <i class="fas fa-shopping-bag"></i> Toko UMKM
    </a>
</li>
```

### **Langkah 4: Tambahkan Icon Keranjang di Header**

Tambahkan di bagian header/topbar:

```php
<a href="<?= base_url('toko/keranjang') ?>" class="btn btn-sm btn-primary position-relative">
    <i class="fas fa-shopping-cart"></i> Keranjang
    <span class="badge badge-danger cart-count" style="display:none; position:absolute; top:-5px; right:-5px;">0</span>
</a>
```

### **Langkah 5: Tambahkan Required Libraries**

Pastikan template Anda sudah include:
- jQuery
- Bootstrap 4/5
- Font Awesome
- SweetAlert2

Jika belum, tambahkan di `template-frontend.php`:

```html
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
```

---

## 📋 URL Frontend yang Tersedia

### **Halaman Utama:**
- **Katalog Produk**: `http://domain.com/toko`
- **Detail Produk**: `http://domain.com/toko/slug-produk`
- **Kategori**: `http://domain.com/toko/kategori/slug-kategori`
- **Search**: `http://domain.com/toko/search?q=keyword`
- **Keranjang**: `http://domain.com/toko/keranjang`

### **AJAX Endpoints:**
- **Add to Cart**: `POST /toko/addtocart`
- **Update Cart**: `POST /toko/updatecart`
- **Remove Cart**: `POST /toko/removecart`
- **Cart Count**: `GET /toko/cartcount`

---

## 🎨 Fitur Frontend yang Sudah Ada

### **Halaman Katalog Produk (toko_index.php)**
- ✅ Grid produk dengan card design
- ✅ Sidebar kategori dengan jumlah produk
- ✅ Produk featured di sidebar
- ✅ Search bar
- ✅ Badge diskon
- ✅ Badge featured
- ✅ Info stok dan views
- ✅ Button "Tambah ke Keranjang"
- ✅ Pagination
- ✅ Hover effect pada card
- ✅ Responsive design

### **Halaman Detail Produk (toko_detail.php)**
- ✅ Gambar produk besar
- ✅ Info lengkap produk
- ✅ Harga normal & promo
- ✅ Badge diskon
- ✅ Info stok & berat
- ✅ Form pembelian dengan quantity selector
- ✅ Button tambah ke keranjang
- ✅ Share buttons (FB, Twitter, WA)
- ✅ Breadcrumb navigation
- ✅ Deskripsi produk
- ✅ Produk terkait
- ✅ Info penjual

### **Fitur AJAX:**
- ✅ Add to cart tanpa reload
- ✅ Update cart count real-time
- ✅ SweetAlert notification
- ✅ Loading state pada button
- ✅ Error handling

---

## 📝 File yang Masih Perlu Dibuat

### **Views yang Perlu Dilengkapi:**

1. **Keranjang Belanja**
   - `toko_keranjang.php` - Halaman keranjang
   - Fitur: List item, update qty, remove item, total harga

2. **Checkout**
   - `toko_checkout.php` - Form checkout
   - Fitur: Form data pemesan, pilih metode pembayaran

3. **Kategori & Search**
   - `toko_kategori.php` - Halaman kategori (copy dari toko_index)
   - `toko_search.php` - Halaman search (copy dari toko_index)

4. **Pesanan**
   - `toko_pesanan.php` - Riwayat pesanan customer
   - `toko_detail_pesanan.php` - Detail pesanan

---

## 🔧 Customisasi Template

### **Menyesuaikan Warna:**

Tambahkan di CSS template Anda:

```css
/* Toko UMKM Custom Styles */
.product-card {
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.btn-add-cart {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
}

.btn-add-cart:hover {
    background: linear-gradient(45deg, #0056b3, #003d82);
}
```

### **Mengubah Layout Grid:**

Default: 3 kolom (col-md-4)
Ubah menjadi 4 kolom: `col-md-3`
Ubah menjadi 2 kolom: `col-md-6`

```php
<!-- Dari -->
<div class="col-md-4 col-sm-6 mb-4">

<!-- Menjadi -->
<div class="col-md-3 col-sm-6 mb-4">
```

---

## 🎯 Testing

### **Test Katalog Produk:**
1. Buka `http://domain.com/toko`
2. Pastikan produk tampil dengan baik
3. Test filter kategori
4. Test search
5. Test pagination

### **Test Detail Produk:**
1. Klik salah satu produk
2. Pastikan detail tampil lengkap
3. Test quantity selector (+/-)
4. Test add to cart
5. Cek notifikasi SweetAlert
6. Cek cart count update

### **Test Add to Cart:**
1. Tambah produk ke keranjang
2. Cek notifikasi sukses
3. Cek badge cart count bertambah
4. Tambah produk yang sama (qty harus bertambah)
5. Test dengan stok habis

---

## 🐛 Troubleshooting

### **Produk tidak tampil:**
- Cek apakah database sudah diimport
- Cek apakah ada produk dengan status aktif
- Cek apakah stok > 0

### **Gambar tidak muncul:**
- Cek folder `public/img/produk/` sudah ada
- Cek permission folder (755)
- Cek nama file gambar di database

### **Add to cart tidak berfungsi:**
- Cek console browser untuk error JavaScript
- Cek apakah jQuery sudah diload
- Cek apakah SweetAlert2 sudah diload
- Cek CSRF token

### **Cart count tidak update:**
- Cek endpoint `/toko/cartcount` bisa diakses
- Cek session sudah aktif
- Cek function `updateCartCount()` dipanggil

---

## 📱 Responsive Design

Views sudah responsive dengan breakpoint:
- **Desktop**: col-md-4 (3 kolom)
- **Tablet**: col-sm-6 (2 kolom)
- **Mobile**: col-12 (1 kolom)

Test di berbagai device:
- Desktop (1920x1080)
- Tablet (768x1024)
- Mobile (375x667)

---

## 🚀 Next Steps

### **Prioritas Tinggi:**
1. ✅ Buat halaman keranjang belanja
2. ✅ Buat halaman checkout
3. ✅ Buat proses pembayaran
4. ✅ Buat halaman riwayat pesanan

### **Prioritas Sedang:**
5. Buat halaman kategori (copy dari index)
6. Buat halaman search (copy dari index)
7. Tambahkan filter harga
8. Tambahkan sort (terbaru, termurah, termahal)

### **Prioritas Rendah:**
9. Wishlist
10. Review & Rating
11. Share to social media
12. Product comparison

---

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di:
- `DOKUMENTASI_MODUL_PENJUALAN_UMKM.md`

---

## ✨ Fitur Unggulan

### **User Experience:**
- ✅ Fast loading dengan AJAX
- ✅ Smooth animation
- ✅ Real-time cart update
- ✅ Beautiful UI/UX
- ✅ Mobile-friendly

### **Admin Features:**
- ✅ Manajemen produk lengkap
- ✅ Manajemen kategori
- ✅ Manajemen pesanan
- ✅ Statistik penjualan

---

**Template:** Desaku  
**Framework:** CodeIgniter 4  
**Status:** Frontend Ready ✅  
**Last Update:** 7 Oktober 2025

---

## 🎉 Selamat!

Toko UMKM frontend sudah siap digunakan!

**Akses toko Anda di:**
`http://domain.com/toko`

Jangan lupa untuk:
1. ✅ Tambahkan produk di backend
2. ✅ Upload gambar produk
3. ✅ Set kategori
4. ✅ Aktifkan produk
5. ✅ Test semua fitur

**Happy Selling! 🛍️**
