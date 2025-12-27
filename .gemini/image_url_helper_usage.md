# Helper Function: image_url()

## Deskripsi
Helper function untuk menampilkan URL gambar dengan fallback otomatis ke gambar default jika file tidak ditemukan.

## Lokasi
File: `app/Helpers/dge_helper.php`

## Signature
```php
image_url(string $path, string $baseDir = 'public/img/', string $defaultImage = 'public/img/no_image.png'): string
```

## Parameter
- **$path** (string): Path relatif ke gambar (contoh: 'informasi/berita/image.jpg')
- **$baseDir** (string, optional): Direktori base untuk gambar (default: 'public/img/')
- **$defaultImage** (string, optional): Path ke gambar default (default: 'public/img/no_image.png')

## Return
String URL lengkap ke gambar atau gambar default jika file tidak ada

## Cara Penggunaan

### 1. Penggunaan Dasar
```php
<!-- Sebelum (manual check) -->
<?php if (file_exists('public/img/informasi/berita/' . $gambar)): ?>
    <img src="<?= base_url('public/img/informasi/berita/' . $gambar) ?>">
<?php else: ?>
    <img src="<?= base_url('public/img/no_image.png') ?>">
<?php endif; ?>

<!-- Sesudah (menggunakan helper) -->
<img src="<?= image_url('informasi/berita/' . $gambar) ?>">
```

### 2. Untuk Berita/News
```php
<img src="<?= image_url('informasi/berita/' . $berita->gambar) ?>" alt="<?= esc($berita->judul_berita) ?>">
```

### 3. Untuk Foto/Gallery
```php
<img src="<?= image_url('galeri/foto/' . $foto->gambar) ?>" alt="<?= esc($foto->judul) ?>">
```

### 4. Untuk Pegawai/Staff
```php
<img src="<?= image_url('informasi/pegawai/' . $pegawai->gambar) ?>" alt="<?= esc($pegawai->nama) ?>">
```

### 5. Untuk User Profile
```php
<img src="<?= image_url('user/' . $user->user_image) ?>" alt="<?= esc($user->fullname) ?>">
```

### 6. Untuk Banner
```php
<img src="<?= image_url('banner/' . $banner->banner_image) ?>" alt="<?= esc($banner->ket) ?>">
```

### 7. Untuk Agenda
```php
<img src="<?= image_url('informasi/agenda/' . $agenda->gambar) ?>" alt="<?= esc($agenda->tema) ?>">
```

### 8. Untuk Layanan
```php
<img src="<?= image_url('informasi/layanan/' . $layanan->gambar) ?>" alt="<?= esc($layanan->nama) ?>">
```

### 9. Untuk Pengumuman
```php
<img src="<?= image_url('informasi/pengumuman/' . $pengumuman->gambar) ?>" alt="<?= esc($pengumuman->nama) ?>">
```

### 10. Untuk E-book
```php
<img src="<?= image_url('ebook/' . $ebook->gambar) ?>" alt="<?= esc($ebook->judul) ?>">
```

### 11. Custom Base Directory
```php
<!-- Jika gambar ada di lokasi berbeda -->
<img src="<?= image_url('logo.png', 'public/img/konfigurasi/logo/') ?>">
```

### 12. Custom Default Image
```php
<!-- Menggunakan gambar default yang berbeda -->
<img src="<?= image_url('user/' . $user_image, 'public/img/', 'public/img/default_user.png') ?>">
```

## Keuntungan Menggunakan Helper Ini

1. **Kode Lebih Bersih**: Tidak perlu menulis if-else untuk setiap gambar
2. **Konsisten**: Semua gambar yang tidak ada akan menampilkan gambar default yang sama
3. **Mudah Maintenance**: Jika ingin mengubah gambar default, cukup ubah di satu tempat
4. **Menghindari Broken Image**: User tidak akan melihat icon broken image
5. **Flexible**: Bisa custom base directory dan default image sesuai kebutuhan

## Catatan Penting

1. Pastikan file `public/img/no_image.png` sudah ada
2. Helper ini sudah otomatis di-load karena ada di `app/Helpers/dge_helper.php` yang sudah terdaftar di BaseController
3. Gunakan helper ini di semua view yang menampilkan gambar untuk konsistensi

## Contoh Implementasi di View

### Dashboard (v_dashboard.php)
```php
<!-- Berita Populer -->
<?php foreach ($beritapopuler as $berita): ?>
    <img src="<?= image_url('informasi/berita/' . $berita->gambar) ?>" 
         alt="<?= esc($berita->judul_berita) ?>" 
         class="img-fluid">
<?php endforeach; ?>
```

### List Pegawai
```php
<?php foreach ($pegawai as $p): ?>
    <img src="<?= image_url('informasi/pegawai/' . $p->gambar) ?>" 
         alt="<?= esc($p->nama) ?>" 
         class="rounded-circle" 
         width="50">
<?php endforeach; ?>
```

### Detail Berita
```php
<div class="article-image">
    <img src="<?= image_url('informasi/berita/' . $berita->gambar) ?>" 
         alt="<?= esc($berita->judul_berita) ?>" 
         class="img-fluid w-100">
</div>
```
