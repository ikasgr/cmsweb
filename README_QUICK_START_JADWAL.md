# 🚀 Quick Start - Jadwal Pelayanan Gereja

## ⚡ Instalasi Super Cepat (5 Menit)

### **LANGKAH 1: Import Database** ✅

Buka **phpMyAdmin** atau **MySQL Command Line**:

#### Via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database Anda (biasanya `cmsweb` atau sesuai nama project)
3. Klik tab **"Import"**
4. Klik **"Choose File"**
5. Pilih file: `db/jadwal_pelayanan_table.sql`
6. Klik **"Go"** di bagian bawah
7. Tunggu sampai muncul pesan sukses

#### Via Command Line:
```bash
mysql -u root -p cmsweb < db/jadwal_pelayanan_table.sql
```
*(Ganti `root` dengan username MySQL Anda, `cmsweb` dengan nama database Anda)*

**✅ Selesai! Tabel `custome__jadwal_pelayanan` sudah dibuat dengan 9 sample data**

---

### **LANGKAH 2: Tambahkan Menu Navigasi Frontend** ✅

Edit file: `app/Views/frontend/desaku/desktop/v_menu.php`

Cari bagian menu navigasi (biasanya ada tag `<ul>` atau `<nav>`), lalu tambahkan:

```php
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('jadwal') ?>">
        <i class="fas fa-calendar-check"></i> Jadwal Pelayanan
    </a>
</li>
```

**Contoh lengkap:**
```php
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('berita') ?>">Berita</a>
    </li>
    <!-- TAMBAHKAN DI SINI -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jadwal') ?>">
            <i class="fas fa-calendar-check"></i> Jadwal Pelayanan
        </a>
    </li>
    <!-- END -->
</ul>
```

**✅ Selesai! Menu jadwal sudah muncul di navigasi**

---

### **LANGKAH 3: Tambahkan Menu Backend (Admin)** ✅

#### A. Login ke Admin:
```
URL: http://localhost/cmsweb/cms-login
Username: admin
Password: CMS@d4tagoeGen5
```

#### B. Tambahkan Modul:
1. Setelah login, klik menu **"Pengaturan"** → **"Modul"**
2. Klik tombol **"Tambah Modul"**
3. Isi form:
   - **Nama Modul**: `Jadwal Pelayanan`
   - **URL Modul**: `jadwal-pelayanan/list`
   - **Icon**: `fas fa-calendar-alt`
   - **Grup Menu**: Pilih grup yang sesuai (misal: "Informasi" atau "Konten")
   - **Urutan**: Sesuaikan
   - **Status**: Aktif
4. Klik **"Simpan"**

#### C. Set Hak Akses:
1. Masih di menu **"Modul"**
2. Cari modul **"Jadwal Pelayanan"** yang baru ditambahkan
3. Klik tombol **"Set Akses"**
4. Centang grup user yang boleh akses (misal: Administrator, Editor)
5. Pilih **Level Akses**:
   - **Level 1**: Full akses (CRUD)
   - **Level 2**: View only
6. Klik **"Simpan"**

**✅ Selesai! Menu Jadwal Pelayanan sudah muncul di sidebar admin**

---

## 📝 LANGKAH 4: Tambah Jadwal Pertama

### **Di Backend Admin:**

1. **Klik menu "Jadwal Pelayanan"** di sidebar admin
2. **Klik tombol "Tambah Jadwal"**
3. **Isi form:**

#### **Data Wajib (Required):**
- **Judul Jadwal**: `Ibadah Minggu I`
- **Jenis Pelayanan**: Pilih `Ibadah Minggu`
- **Tanggal**: Pilih tanggal Minggu depan (misal: `2025-10-13`)
- **Waktu Mulai**: `07:00`

#### **Data Opsional (Recommended):**
- **Waktu Selesai**: `09:00`
- **Tempat**: `Gedung Gereja Utama`
- **Pengkhotbah**: `Pdt. John Doe`
- **Liturgis**: `Maria Susanti`
- **Singer**: `Tim Worship A` *(bisa multiple, pisah dengan koma)*
- **Pemusik**: `Tim Band A` *(bisa multiple, pisah dengan koma)*
- **Multimedia**: `David Chen`
- **Usher**: `Tim Usher A, Tim Usher B` *(bisa multiple, pisah dengan koma)*
- **Keterangan**: `Ibadah Minggu Pertama - Tema: Kasih Kristus`
- **Status**: Pilih `Published` ✅
- **Warna**: Pilih warna (default biru `#007bff`)

4. **Klik "Simpan"**

**✅ Jadwal pertama berhasil ditambahkan!**

---

## 👀 LANGKAH 5: Lihat Jadwal di Frontend

### **Akses sebagai Jemaat:**

1. Buka browser baru (atau mode incognito)
2. Akses: `http://localhost/cmsweb/jadwal`
3. **Atau klik menu "Jadwal Pelayanan" di navigasi**

### **Yang Akan Terlihat:**

✅ **Jadwal yang baru ditambahkan muncul!**

**Tampilan meliputi:**
- 📅 Tanggal lengkap (format Indonesia)
- ⏰ Waktu pelayanan
- 📍 Tempat
- 👤 Pengkhotbah
- 🎵 Tim pelayanan (Singer, Pemusik, dll)
- 📝 Keterangan

**Fitur yang bisa digunakan:**
- ✅ Filter by jenis pelayanan (sidebar kiri)
- ✅ Lihat detail lengkap (klik tombol "Lihat Detail")
- ✅ Jadwal hari ini (jika ada, muncul di sidebar)
- ✅ Jadwal minggu ini (highlight dengan card hijau)

---

## 🎯 Tips Menambahkan Jadwal

### **1. Jadwal Rutin (Setiap Minggu):**

**Ibadah Minggu I:**
- Judul: `Ibadah Minggu I`
- Jenis: `Ibadah Minggu`
- Waktu: `07:00 - 09:00`
- Ulangi setiap minggu dengan tanggal berbeda

**Ibadah Minggu II:**
- Judul: `Ibadah Minggu II`
- Jenis: `Ibadah Minggu`
- Waktu: `10:00 - 12:00`
- Ulangi setiap minggu dengan tanggal berbeda

### **2. Jadwal Mingguan:**

**Persekutuan Doa (Rabu):**
- Judul: `Persekutuan Doa`
- Jenis: `Persekutuan Doa`
- Tanggal: Setiap Rabu
- Waktu: `19:00 - 21:00`

**Ibadah Pemuda (Sabtu):**
- Judul: `Ibadah Pemuda`
- Jenis: `Ibadah Pemuda`
- Tanggal: Setiap Sabtu
- Waktu: `18:00 - 20:00`

### **3. Jadwal Khusus:**

**Kebaktian Natal:**
- Judul: `Kebaktian Natal`
- Jenis: `Kebaktian Khusus`
- Tanggal: `2025-12-25`
- Waktu: `19:00 - 21:00`
- Warna: `#dc3545` (merah)

**Kebaktian Paskah:**
- Judul: `Kebaktian Paskah`
- Jenis: `Kebaktian Khusus`
- Tanggal: Sesuai kalender Paskah
- Waktu: `06:00 - 08:00`
- Warna: `#ffc107` (kuning)

---

## 📊 Contoh Jadwal Lengkap 1 Bulan

### **Minggu 1:**
- **Minggu**: Ibadah Minggu I (07:00), Ibadah Minggu II (10:00), Sekolah Minggu (09:00)
- **Rabu**: Persekutuan Doa (19:00)
- **Jumat**: Komsel Wilayah A & B (19:00)
- **Sabtu**: Ibadah Pemuda (18:00)

### **Minggu 2:**
- **Minggu**: Ibadah Minggu I (07:00), Ibadah Minggu II (10:00), Sekolah Minggu (09:00)
- **Rabu**: Persekutuan Doa (19:00)
- **Jumat**: Komsel Wilayah C & D (19:00)
- **Sabtu**: Ibadah Pemuda (18:00)

### **Minggu 3:**
- **Minggu**: Ibadah Minggu I (07:00), Ibadah Minggu II (10:00), Sekolah Minggu (09:00)
- **Rabu**: Persekutuan Doa (19:00)
- **Jumat**: Komsel Wilayah E & F (19:00)
- **Sabtu**: Ibadah Pemuda (18:00)

### **Minggu 4:**
- **Minggu**: Ibadah Minggu I (07:00), Ibadah Minggu II (10:00), Sekolah Minggu (09:00)
- **Rabu**: Persekutuan Doa (19:00)
- **Jumat**: Komsel All Wilayah (19:00)
- **Sabtu**: Ibadah Pemuda (18:00)

---

## 🔧 Troubleshooting

### **❌ Menu "Jadwal Pelayanan" tidak muncul di admin:**

**Solusi:**
1. Pastikan modul sudah ditambahkan di menu **Pengaturan → Modul**
2. Pastikan hak akses sudah di-set untuk grup user Anda
3. Logout dan login kembali
4. Clear cache browser (Ctrl + Shift + Delete)

### **❌ Jadwal tidak muncul di frontend:**

**Solusi:**
1. Pastikan **Status** jadwal = `Published` (bukan Draft)
2. Pastikan **Tanggal** jadwal >= hari ini (jadwal masa lalu tidak ditampilkan)
3. Refresh halaman (F5)
4. Clear cache browser

### **❌ Error "Table doesn't exist":**

**Solusi:**
1. Pastikan database sudah diimport
2. Cek di phpMyAdmin apakah tabel `custome__jadwal_pelayanan` ada
3. Jika belum, import ulang file SQL

### **❌ Format tanggal tidak Indonesia:**

**Solusi:**
1. Pastikan Moment.js sudah diload di template
2. Cek di console browser apakah ada error JavaScript
3. Pastikan file `moment.js` dan `locale/id.js` sudah diload

### **❌ Modal detail tidak muncul:**

**Solusi:**
1. Pastikan jQuery sudah diload
2. Pastikan Bootstrap JS sudah diload
3. Cek console browser untuk error
4. Pastikan tidak ada conflict JavaScript

---

## 📱 Akses dari Mobile

Jadwal sudah responsive dan bisa diakses dari:
- 📱 **Smartphone** (Android/iOS)
- 💻 **Tablet** (iPad, Android Tablet)
- 🖥️ **Desktop** (Windows, Mac, Linux)

**URL yang sama:**
`http://domain-anda.com/jadwal`

---

## 🎨 Customisasi Warna per Jenis

Anda bisa set warna berbeda untuk setiap jenis pelayanan:

| Jenis Pelayanan | Warna Recommended | Hex Code |
|----------------|-------------------|----------|
| Ibadah Minggu | Biru | `#007bff` |
| Ibadah Pemuda | Hijau | `#28a745` |
| Ibadah Anak | Cyan | `#17a2b8` |
| Persekutuan Doa | Kuning | `#ffc107` |
| Komsel | Ungu | `#6f42c1` |
| Kebaktian Khusus | Merah | `#dc3545` |
| Acara Gereja | Orange | `#fd7e14` |
| Lainnya | Abu-abu | `#6c757d` |

---

## 📋 Checklist Selesai

Centang jika sudah selesai:

- [ ] ✅ Import database `jadwal_pelayanan_table.sql`
- [ ] ✅ Tambahkan menu navigasi frontend
- [ ] ✅ Tambahkan modul di backend admin
- [ ] ✅ Set hak akses modul
- [ ] ✅ Tambah jadwal pertama
- [ ] ✅ Cek jadwal muncul di frontend
- [ ] ✅ Test filter jenis pelayanan
- [ ] ✅ Test modal detail
- [ ] ✅ Test responsive di mobile

---

## 🎉 Selamat!

**Modul Jadwal Pelayanan sudah aktif dan bisa digunakan!**

### **URL Penting:**

**Frontend (Jemaat):**
```
http://localhost/cmsweb/jadwal
```

**Backend (Admin):**
```
http://localhost/cmsweb/jadwal-pelayanan/list
```

### **Next Steps:**

1. ✅ Tambahkan jadwal untuk 1 bulan ke depan
2. ✅ Informasikan ke jemaat tentang fitur baru ini
3. ✅ Update jadwal setiap minggu
4. ✅ Pastikan tim pelayanan selalu terupdate

---

## 💡 Tips Pro

### **1. Bulk Add Jadwal:**
Untuk menambah banyak jadwal sekaligus, bisa langsung insert ke database:

```sql
INSERT INTO custome__jadwal_pelayanan 
(judul_jadwal, jenis_pelayanan, tanggal, waktu_mulai, waktu_selesai, tempat, status, user_id) 
VALUES
('Ibadah Minggu I', 'Ibadah Minggu', '2025-10-13', '07:00:00', '09:00:00', 'Gedung Gereja', '1', 1),
('Ibadah Minggu II', 'Ibadah Minggu', '2025-10-13', '10:00:00', '12:00:00', 'Gedung Gereja', '1', 1),
('Ibadah Minggu I', 'Ibadah Minggu', '2025-10-20', '07:00:00', '09:00:00', 'Gedung Gereja', '1', 1),
('Ibadah Minggu II', 'Ibadah Minggu', '2025-10-20', '10:00:00', '12:00:00', 'Gedung Gereja', '1', 1);
```

### **2. Template Jadwal:**
Buat template untuk jadwal rutin, copy paste saat menambah jadwal baru.

### **3. Reminder:**
Set reminder di kalender pribadi untuk update jadwal setiap minggu.

---

## 📞 Butuh Bantuan?

Jika ada kendala:
1. Cek dokumentasi lengkap: `DOKUMENTASI_MODUL_JADWAL_PELAYANAN.md`
2. Cek troubleshooting di atas
3. Hubungi support:
   - Website: https://ikasmedia.net
   - WhatsApp: 081 353 967 028

---

**Selamat menggunakan Modul Jadwal Pelayanan! 🙏**

**Dibuat:** 7 Oktober 2025  
**Versi:** 1.0.0  
**Framework:** CodeIgniter 4
