# 🎨 Panduan Mengubah Tampilan Produk UMKM (Style Slider)

## 🎯 Tujuan
Mengubah tampilan produk UMKM dari **grid 4 kolom** menjadi **slider carousel** seperti infografis terkini.

---

## 📋 Perbandingan Style

### **Style Lama (Grid):**
```
┌────┐ ┌────┐ ┌────┐ ┌────┐
│Foto│ │Foto│ │Foto│ │Foto│
│Nama│ │Nama│ │Nama│ │Nama│
│Harga│ │Harga│ │Harga│ │Harga│
└────┘ └────┘ └────┘ └────┘
```

### **Style Baru (Slider):**
```
← [Foto] [Foto] [Foto] [Foto] →
  [Nama] [Nama] [Nama] [Nama]
  [Harga] [Harga] [Harga] [Harga]
  
Auto-scroll + Navigation arrows
```

---

## 🔧 Cara Implementasi

### **LANGKAH 1: Buka File v_home.php**

File: `app/Views/frontend/desaku/desktop/v_home.php`

### **LANGKAH 2: Cari Section Produk UMKM**

Cari kode ini (sekitar baris 600-700):

```php
        <!-- Begin Produk UMKM Section
        ================================================== -->
        <?php 
        use App\Models\M_ProdukUmkm;
        $produk_model = new M_ProdukUmkm();
        $produk_featured = $produk_model->featured()->limit(4)->get()->getResultArray();
```

### **LANGKAH 3: Ganti Seluruh Section Produk**

**HAPUS** kode produk yang lama (dari `<!-- Begin Produk UMKM Section` sampai `<!-- End Produk UMKM Section -->`)

**GANTI** dengan kode dari file: `KODE_PRODUK_SLIDER_STYLE.php`

### **LANGKAH 4: Tambahkan CSS**

Cari bagian `<style>` di file v_home.php (biasanya di akhir), tambahkan CSS dari file `KODE_PRODUK_SLIDER_STYLE.php`

### **LANGKAH 5: Tambahkan JavaScript**

Cari bagian script di akhir file (sebelum `<?= $this->endSection() ?>`), tambahkan JavaScript dari file `KODE_PRODUK_SLIDER_STYLE.php`

### **LANGKAH 6: Simpan & Refresh**

Simpan file dan refresh homepage.

---

## ✨ Fitur Style Baru

### **1. Slider Carousel**
- ✅ Auto-scroll setiap 3 detik
- ✅ Navigation arrows (prev/next)
- ✅ Tampil 4 produk sekaligus (desktop)
- ✅ Responsive:
  - Desktop: 4 produk
  - Tablet: 3 produk
  - Mobile: 1 produk

### **2. Header Style**
- ✅ Background hijau (seperti infografis biru)
- ✅ Judul dengan icon
- ✅ Navigation arrows di tengah
- ✅ Link "Lihat Semua" di kanan

### **3. Card Design**
- ✅ Gambar produk 250px height
- ✅ Badge diskon (top-right)
- ✅ Badge featured (top-left)
- ✅ Hover effect (naik & shadow)
- ✅ Info stok
- ✅ Button "Lihat Detail"

### **4. Animation**
- ✅ Smooth slide transition
- ✅ Hover lift effect
- ✅ Auto-play dengan pause on hover

---

## 🎨 Customisasi

### **Ubah Warna Background Header:**

Ganti `bg-success` dengan warna lain:
```php
<div class="container bg-success ">  <!-- Hijau -->
<div class="container bg-primary ">  <!-- Biru -->
<div class="container bg-danger ">   <!-- Merah -->
<div class="container bg-warning ">  <!-- Kuning -->
<div class="container bg-info ">     <!-- Cyan -->
```

### **Ubah Jumlah Produk:**

Ganti limit:
```php
$produk_featured = $produk_model->featured()->limit(8)->get()->getResultArray();
// Ubah 8 menjadi angka lain (4, 6, 8, 10, dll)
```

### **Ubah Kecepatan Auto-scroll:**

Ganti `autoplaySpeed`:
```javascript
autoplaySpeed: 3000,  // 3 detik
autoplaySpeed: 5000,  // 5 detik
autoplaySpeed: 2000,  // 2 detik
```

### **Ubah Jumlah Produk Tampil:**

Ganti `slidesToShow`:
```javascript
slidesToShow: 4,  // 4 produk (default)
slidesToShow: 3,  // 3 produk
slidesToShow: 5,  // 5 produk
```

---

## 📱 Responsive Breakpoints

| Device | Lebar | Produk Tampil |
|--------|-------|---------------|
| Desktop | > 1024px | 4 produk |
| Tablet | 768-1024px | 3 produk |
| Mobile Large | 480-768px | 2 produk |
| Mobile Small | < 480px | 1 produk |

---

## 🔍 Preview Tampilan

### **Desktop View:**
```
┌─────────────────────────────────────────────────────────────┐
│ 🛍️ Produk UMKM Jemaat    ← →    [Lihat Semua]             │
├─────────────────────────────────────────────────────────────┤
│  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐                   │
│  │[-20%]│  │[★]   │  │      │  │      │                   │
│  │ Foto │  │ Foto │  │ Foto │  │ Foto │                   │
│  │      │  │      │  │      │  │      │                   │
│  │Nama  │  │Nama  │  │Nama  │  │Nama  │                   │
│  │Produk│  │Produk│  │Produk│  │Produk│                   │
│  │      │  │      │  │      │  │      │                   │
│  │Rp 100k│ │Rp 75k│  │Rp 50k│  │Rp 25k│                   │
│  │📦 50  │  │📦 30 │  │📦 20 │  │📦 10 │                   │
│  │[Detail]│ │[Detail]│ │[Detail]│ │[Detail]│               │
│  └──────┘  └──────┘  └──────┘  └──────┘                   │
└─────────────────────────────────────────────────────────────┘
```

### **Mobile View:**
```
┌──────────────────┐
│ 🛍️ Produk UMKM   │
│      ← →         │
├──────────────────┤
│   ┌──────────┐   │
│   │  [-20%]  │   │
│   │   Foto   │   │
│   │          │   │
│   │  Nama    │   │
│   │  Produk  │   │
│   │          │   │
│   │ Rp 100k  │   │
│   │ 📦 Stok  │   │
│   │ [Detail] │   │
│   └──────────┘   │
│                  │
│  Swipe → untuk   │
│  produk lainnya  │
└──────────────────┘
```

---

## 🎯 Perbedaan dengan Style Lama

| Aspek | Style Lama (Grid) | Style Baru (Slider) |
|-------|-------------------|---------------------|
| Layout | Grid 4 kolom statis | Carousel auto-scroll |
| Navigation | Pagination | Arrow prev/next |
| Jumlah tampil | 4 produk fixed | 4-8 produk scroll |
| Auto-play | ❌ Tidak | ✅ Ya (3 detik) |
| Header | Simple | Styled seperti infografis |
| Background | Putih | Hijau (customizable) |
| Responsive | Grid collapse | Slider adjust |

---

## 🚀 Kelebihan Style Slider

### **User Experience:**
- ✅ **Auto-scroll** - Produk berganti otomatis
- ✅ **Interactive** - User bisa swipe/klik arrow
- ✅ **Space-efficient** - Tampil lebih banyak produk
- ✅ **Eye-catching** - Animasi menarik perhatian
- ✅ **Consistent** - Sama dengan style infografis

### **Visual:**
- ✅ **Modern** - Tampilan lebih dinamis
- ✅ **Professional** - Konsisten dengan template
- ✅ **Attractive** - Hover effect & animation
- ✅ **Branded** - Warna bisa disesuaikan

---

## 🔧 Troubleshooting

### **Slider tidak jalan:**
**Solusi:**
1. Pastikan Slick Carousel sudah diload
2. Cek di console browser untuk error
3. Pastikan jQuery diload sebelum Slick
4. Cek file: `slick.min.js` dan `slick.css`

### **Produk tidak muncul:**
**Solusi:**
1. Pastikan ada produk dengan `featured = 1`
2. Pastikan produk `status = 1` (aktif)
3. Pastikan `stok > 0`
4. Cek database sudah diimport

### **Navigation arrows tidak berfungsi:**
**Solusi:**
1. Pastikan ID slider benar: `#produk-slider`
2. Pastikan class button benar: `.produk-slider-prev` dan `.produk-slider-next`
3. Cek JavaScript sudah ditambahkan

### **Responsive tidak jalan:**
**Solusi:**
1. Cek breakpoint di JavaScript
2. Test di berbagai ukuran layar
3. Cek CSS responsive

---

## 📦 Dependencies

Pastikan library ini sudah diload di template:

### **Required:**
- ✅ jQuery (3.5.1+)
- ✅ Slick Carousel (1.8.1+)
- ✅ Bootstrap (4.x)
- ✅ Font Awesome (5.x)

### **Optional:**
- SweetAlert2 (untuk notifikasi)

---

## 📝 Checklist Implementasi

- [ ] Buka file `v_home.php`
- [ ] Cari section produk UMKM lama
- [ ] Hapus kode lama
- [ ] Copy kode baru dari `KODE_PRODUK_SLIDER_STYLE.php`
- [ ] Paste di lokasi yang sama
- [ ] Tambahkan CSS
- [ ] Tambahkan JavaScript
- [ ] Simpan file
- [ ] Refresh homepage
- [ ] Test slider (auto-scroll, arrows, responsive)
- [ ] Test link ke detail produk
- [ ] Test di mobile

---

## 🎨 Customisasi Lanjutan

### **1. Ubah Tinggi Gambar:**
```php
style="height: 250px; object-fit: cover;"
<!-- Ubah 250px sesuai keinginan -->
```

### **2. Ubah Margin Card:**
```css
.product-card-slider {
    margin: 10px;  /* Ubah spacing antar card */
}
```

### **3. Tambah Pause on Hover:**
```javascript
$('#produk-slider').slick({
    pauseOnHover: true,  // Tambahkan ini
    // ... config lainnya
});
```

### **4. Ubah Transition Speed:**
```javascript
$('#produk-slider').slick({
    speed: 500,  // Kecepatan transisi (ms)
    // ... config lainnya
});
```

---

## 🎉 Hasil Akhir

Setelah implementasi, homepage akan menampilkan:

### **Section Jadwal Pelayanan:**
- 4 jadwal terdekat
- Format card dengan tanggal besar
- Badge warna per jenis

### **Section Produk UMKM (Slider):**
- 4-8 produk featured
- Auto-scroll carousel
- Navigation arrows
- Hover effect
- Badge diskon & featured
- Background hijau
- Style konsisten dengan infografis

---

## 📞 Support

File yang tersedia:
1. **`KODE_PRODUK_SLIDER_STYLE.php`** - Kode lengkap
2. **`PANDUAN_GANTI_STYLE_PRODUK.md`** - Panduan ini

Jika ada kendala:
- Cek console browser untuk error
- Pastikan Slick Carousel sudah diload
- Test di berbagai device

---

**Selamat mencoba! 🚀**

**Update:** 7 Oktober 2025  
**Style:** Slider Carousel (seperti Infografis)
