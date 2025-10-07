# 📝 Panduan Menambahkan Jadwal & Produk ke Homepage

## 🎯 Tujuan
Menambahkan section **Jadwal Pelayanan** dan **Produk UMKM** ke halaman utama website (homepage).

---

## 📍 Lokasi File yang Harus Diedit

**File:** `app/Views/frontend/desaku/desktop/v_home.php`

---

## 🔧 Cara Edit Manual

### **Langkah 1: Buka File v_home.php**

Buka file dengan text editor favorit Anda (VS Code, Notepad++, Sublime Text, dll):
```
app/Views/frontend/desaku/desktop/v_home.php
```

### **Langkah 2: Cari Lokasi yang Tepat**

Cari baris ini (sekitar baris 526-530):
```php
            <?php } ?>
            <!-- End Featured
 End List Posts
	================================================== -->
        </div>
        <div class="container bg-light-blue ">
```

### **Langkah 3: Tambahkan Kode**

**SETELAH** baris `</div>` (baris 529)  
**SEBELUM** baris `<div class="container bg-light-blue ">` (baris 530)

Tambahkan kode berikut:

```php

        <!-- ================================================== -->
        <!-- Begin Jadwal Pelayanan Section
        ================================================== -->
        <?php 
        use App\Models\M_JadwalPelayanan;
        $jadwal_model = new M_JadwalPelayanan();
        $jadwal_upcoming = $jadwal_model->upcoming(4);
        
        if ($jadwal_upcoming) : ?>
        <div class="container mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="montserrat-800 f-24 text-blue">
                            <i class="fas fa-calendar-check"></i> Jadwal Pelayanan
                        </h1>
                        <a href="<?= base_url('jadwal') ?>" class="btn btn-primary btn-sm">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($jadwal_upcoming as $jadwal) : 
                    $badge_color = [
                        'Ibadah Minggu' => 'primary',
                        'Ibadah Pemuda' => 'success',
                        'Ibadah Anak' => 'info',
                        'Persekutuan Doa' => 'warning',
                        'Komsel' => 'secondary',
                        'Kebaktian Khusus' => 'danger',
                        'Acara Gereja' => 'dark'
                    ];
                    $badge = $badge_color[$jadwal['jenis_pelayanan']] ?? 'primary';
                ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div class="bg-primary text-white p-3 rounded">
                                        <h2 class="mb-0"><?= date('d', strtotime($jadwal['tanggal'])) ?></h2>
                                        <small><?= strftime('%b', strtotime($jadwal['tanggal'])) ?></small>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title text-primary mb-2"><?= esc($jadwal['judul_jadwal']) ?></h5>
                                    <span class="badge badge-<?= $badge ?> mb-2"><?= esc($jadwal['jenis_pelayanan']) ?></span>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-clock text-primary"></i> 
                                        <small><?= date('H:i', strtotime($jadwal['waktu_mulai'])) ?></small>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-map-marker-alt text-danger"></i> 
                                        <small><?= esc($jadwal['tempat']) ?></small>
                                    </p>
                                    <?php if ($jadwal['pengkhotbah']) : ?>
                                    <p class="card-text mb-0">
                                        <i class="fas fa-user-tie text-success"></i> 
                                        <small><?= esc($jadwal['pengkhotbah']) ?></small>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Jadwal Pelayanan Section -->

        <!-- ================================================== -->
        <!-- Begin Produk UMKM Section
        ================================================== -->
        <?php 
        use App\Models\M_ProdukUmkm;
        $produk_model = new M_ProdukUmkm();
        $produk_featured = $produk_model->featured()->limit(4)->get()->getResultArray();
        
        if ($produk_featured) : ?>
        <div class="container mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="montserrat-800 f-24 text-blue">
                            <i class="fas fa-shopping-bag"></i> Produk UMKM Jemaat
                        </h1>
                        <a href="<?= base_url('toko') ?>" class="btn btn-success btn-sm">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($produk_featured as $produk) : 
                    $harga_tampil = !empty($produk['harga_promo']) ? $produk['harga_promo'] : $produk['harga'];
                    $diskon = 0;
                    if (!empty($produk['harga_promo'])) {
                        $diskon = round((($produk['harga'] - $produk['harga_promo']) / $produk['harga']) * 100);
                    }
                ?>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 shadow-sm product-card-home">
                        <div class="position-relative">
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>">
                                <img src="<?= base_url('/public/img/produk/' . $produk['gambar']) ?>" 
                                     class="card-img-top" alt="<?= esc($produk['nama_produk']) ?>"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                            <?php if ($diskon > 0) : ?>
                                <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">
                                    -<?= $diskon ?>%
                                </span>
                            <?php endif; ?>
                            <span class="badge badge-warning position-absolute" style="top: 10px; left: 10px;">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="text-dark">
                                    <?= esc($produk['nama_produk']) ?>
                                </a>
                            </h6>
                            <div class="mb-2">
                                <?php if (!empty($produk['harga_promo'])) : ?>
                                    <small class="text-muted" style="text-decoration: line-through;">
                                        Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                                    </small><br>
                                <?php endif; ?>
                                <span class="text-primary font-weight-bold h6">
                                    Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                                </span>
                            </div>
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Produk UMKM Section -->

```

### **Langkah 4: Tambahkan CSS (Opsional)**

Cari bagian `<style>` atau di akhir file sebelum `</section>`, tambahkan:

```css
<style>
.product-card-home {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card-home:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}

.product-card-home .card-title a:hover {
    color: #007bff !important;
}
</style>
```

### **Langkah 5: Simpan File**

Simpan file `v_home.php` dengan **Ctrl + S**

---

## ✅ Hasil yang Diharapkan

Setelah edit, homepage akan menampilkan:

### **1. Section Jadwal Pelayanan**
- Menampilkan **4 jadwal terdekat**
- Card dengan tanggal besar di kiri
- Info: Judul, jenis, waktu, tempat, pengkhotbah
- Badge warna berbeda per jenis pelayanan
- Button "Lihat Semua" ke halaman jadwal lengkap

### **2. Section Produk UMKM**
- Menampilkan **4 produk featured**
- Card dengan gambar produk
- Badge diskon (jika ada)
- Badge "Featured"
- Harga normal & promo
- Button "Lihat Detail" ke detail produk
- Button "Lihat Semua" ke halaman toko

---

## 🎨 Preview Tampilan

### **Jadwal Pelayanan:**
```
┌─────────────────────────────────────────────────────────┐
│  📅 Jadwal Pelayanan              [Lihat Semua →]      │
├─────────────────────────────────────────────────────────┤
│  ┌──────┐  Ibadah Minggu I                             │
│  │  15  │  [Ibadah Minggu]                             │
│  │ Okt  │  🕐 07:00 | 📍 Gedung Gereja                 │
│  └──────┘  👤 Pdt. John Doe                            │
└─────────────────────────────────────────────────────────┘
```

### **Produk UMKM:**
```
┌─────────────────────────────────────────────────────────┐
│  🛍️ Produk UMKM Jemaat            [Lihat Semua →]      │
├─────────────────────────────────────────────────────────┤
│  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐               │
│  │ [-20%]  │[★]    │  │      │  │      │               │
│  │ Foto  │  │ Foto │  │ Foto │  │ Foto │               │
│  │Produk │  │Produk│  │Produk│  │Produk│               │
│  │       │  │      │  │      │  │      │               │
│  │Nama   │  │Nama  │  │Nama  │  │Nama  │               │
│  │Rp 100k│  │Rp 75k│  │Rp 50k│  │Rp 25k│               │
│  │[Detail]  │[Detail] │[Detail] │[Detail]              │
│  └──────┘  └──────┘  └──────┘  └──────┘               │
└─────────────────────────────────────────────────────────┘
```

---

## 🔍 Troubleshooting

### **Jadwal tidak muncul:**
- Pastikan database `custome__jadwal_pelayanan` sudah diimport
- Pastikan ada jadwal dengan status Published
- Pastikan tanggal jadwal >= hari ini

### **Produk tidak muncul:**
- Pastikan database `custome__produk_umkm` sudah diimport
- Pastikan ada produk dengan status Aktif
- Pastikan ada produk dengan featured = 1
- Pastikan folder `public/img/produk/` ada dan berisi gambar

### **Error "Class not found":**
- Pastikan `BaseController.php` sudah diupdate dengan model baru
- Clear cache: `php spark cache:clear`

---

## 📋 Checklist

- [ ] Buka file `v_home.php`
- [ ] Cari baris 529 (`</div>`)
- [ ] Tambahkan kode section jadwal
- [ ] Tambahkan kode section produk
- [ ] Tambahkan CSS (opsional)
- [ ] Simpan file
- [ ] Refresh homepage
- [ ] Cek jadwal muncul (jika ada data)
- [ ] Cek produk muncul (jika ada data)

---

## 🎯 Catatan Penting

1. **Kode lengkap** sudah tersedia di file: `KODE_TAMBAHAN_HOMEPAGE.php`
2. **Copy paste** kode dari file tersebut ke lokasi yang tepat
3. **Jangan hapus** kode yang sudah ada, hanya **tambahkan** kode baru
4. **Backup** file `v_home.php` sebelum edit (untuk jaga-jaga)

---

## 📞 Bantuan

Jika ada kendala:
1. Cek file `KODE_TAMBAHAN_HOMEPAGE.php` untuk kode lengkap
2. Pastikan lokasi penambahan kode sudah benar
3. Cek console browser untuk error JavaScript
4. Cek error log PHP jika ada error

---

**Selamat mencoba! 🚀**

**Update:** 7 Oktober 2025
