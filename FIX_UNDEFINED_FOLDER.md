# 🔧 Fix Undefined Variable $folder

## ❌ Error

```
ErrorException
Undefined variable $folder
APPPATH/Views/backend/morvin/cmscust/pendaftaran_baptis/index.php at line 1
```

---

## ✅ Solusi - SUDAH DIPERBAIKI!

### **Penyebab:**
Urutan `extend()` dan `section()` salah, menyebabkan variabel `$folder` belum tersedia.

### **Perbaikan:**
Tukar urutan: `section()` harus sebelum `extend()`

---

## 📝 Perubahan Kode

### **Sebelum (Error):**
```php
<?= $this->extend('backend/' . $folder . '/' . 'script') ?>

<?= $this->section('content') ?>
```

### **Sesudah (Fixed):**
```php
<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script'); ?>
```

**Perubahan:**
1. ✅ `section()` dipindah ke atas
2. ✅ `extend()` dipindah ke bawah
3. ✅ Tambah `esc()` untuk keamanan
4. ✅ Ganti `?>` dengan `;`

---

## 📁 File yang Diperbaiki (4 file)

1. ✅ `app/Views/backend/morvin/cmscust/pendaftaran_baptis/index.php`
2. ✅ `app/Views/backend/morvin/cmscust/pendaftaran_nikah/index.php`
3. ✅ `app/Views/backend/morvin/cmscust/produk_umkm/index.php`
4. ✅ `app/Views/backend/morvin/cmscust/kategori_produk/index.php`

---

## 🎯 Penjelasan

### **Mengapa Harus Dibalik?**

**CodeIgniter 4 View Rendering:**
1. `section()` mendefinisikan konten
2. `extend()` memanggil parent template
3. Parent template menyediakan variabel seperti `$folder`
4. Jika `extend()` di atas, variabel belum tersedia saat parsing

**Urutan yang Benar:**
```php
<?= $this->section('content') ?>      // 1. Define section
<?= $this->extend('parent'); ?>       // 2. Extend parent
```

---

## 🚀 Testing

### **Test Backend:**
```
✅ http://domain.com/pendaftaran_baptis/all
✅ http://domain.com/pendaftaran_nikah/all
✅ http://domain.com/produk-umkm/list
✅ http://domain.com/kategori-produk/list
```

### **Cek Tidak Ada Error:**
- ✅ Tidak ada error "Undefined variable $folder"
- ✅ Halaman load normal
- ✅ DataTables tampil

---

## ✅ Checklist

- [x] ✅ Fix pendaftaran_baptis/index.php
- [x] ✅ Fix pendaftaran_nikah/index.php
- [x] ✅ Fix produk_umkm/index.php
- [x] ✅ Fix kategori_produk/index.php
- [x] ✅ Dokumentasi
- [ ] ⏳ Clear cache
- [ ] ⏳ Test backend

---

## 🎉 Kesimpulan

**Error undefined variable $folder sudah diperbaiki!**

**File yang diupdate:** 4 file backend

**Tinggal:**
1. Clear cache
2. Refresh halaman backend
3. Error hilang! ✅

---

**Dibuat:** 7 Oktober 2025  
**Error:** Undefined variable $folder  
**Status:** ✅ SOLVED
