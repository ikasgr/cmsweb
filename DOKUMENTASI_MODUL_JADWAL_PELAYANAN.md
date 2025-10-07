# 📅 Dokumentasi Modul Jadwal Pelayanan Gereja

## Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Fitur Utama](#fitur-utama)
3. [Instalasi](#instalasi)
4. [Struktur Database](#struktur-database)
5. [Cara Penggunaan](#cara-penggunaan)
6. [API Endpoints](#api-endpoints)
7. [Integrasi Frontend](#integrasi-frontend)

---

## Pengenalan

Modul Jadwal Pelayanan adalah sistem manajemen jadwal lengkap untuk gereja yang memudahkan admin dalam mengelola jadwal ibadah, kegiatan, dan pelayanan gereja, serta memudahkan jemaat untuk melihat jadwal secara online.

### **Tujuan Modul:**
- Mengelola jadwal pelayanan gereja secara terpusat
- Memberikan informasi jadwal yang mudah diakses jemaat
- Mengatur tim pelayanan untuk setiap kegiatan
- Menampilkan jadwal dalam format yang menarik dan informatif

---

## Fitur Utama

### **1. Manajemen Jadwal (Backend)**
- ✅ CRUD jadwal lengkap
- ✅ Multiple jenis pelayanan:
  - Ibadah Minggu
  - Ibadah Pemuda
  - Ibadah Anak
  - Persekutuan Doa
  - Komsel
  - Kebaktian Khusus
  - Acara Gereja
  - Lainnya
- ✅ Pengaturan tim pelayanan:
  - Pengkhotbah
  - Liturgis
  - Singer
  - Pemusik
  - Multimedia
  - Usher
- ✅ Status publish/draft
- ✅ Warna custom untuk calendar
- ✅ Bulk delete

### **2. Tampilan Frontend**
- ✅ List jadwal mendatang
- ✅ Jadwal hari ini (highlight)
- ✅ Jadwal minggu ini (highlight)
- ✅ Filter by jenis pelayanan
- ✅ Detail jadwal (modal)
- ✅ Responsive design
- ✅ Format tanggal Indonesia

### **3. Fitur Tambahan**
- ✅ Upcoming events (5 terdekat)
- ✅ Jadwal by bulan
- ✅ Jadwal by jenis
- ✅ Widget jadwal untuk homepage
- ✅ Calendar view ready (FullCalendar compatible)

---

## Instalasi

### **Langkah 1: Import Database**

```bash
mysql -u username -p database_name < db/jadwal_pelayanan_table.sql
```

**Atau via phpMyAdmin:**
1. Buka phpMyAdmin
2. Pilih database
3. Import file `db/jadwal_pelayanan_table.sql`

**Tabel yang dibuat:**
- `custome__jadwal_pelayanan`

**Sample data:**
- 9 jadwal contoh (Ibadah Minggu, Pemuda, Anak, Doa, Komsel)

### **Langkah 2: Verifikasi File**

Pastikan file berikut sudah ada:

**Model (1 file):**
- ✅ `app/Models/M_JadwalPelayanan.php`

**Controllers (2 file):**
- ✅ `app/Controllers/JadwalPelayanan.php` (Backend)
- ✅ `app/Controllers/Jadwal.php` (Frontend)

**Views Frontend (1 file):**
- ✅ `app/Views/frontend/desaku/desktop/content/jadwal_index.php`

**Configuration:**
- ✅ `app/Controllers/BaseController.php` (updated)
- ✅ `app/Config/Routes.php` (updated)

### **Langkah 3: Tambahkan Menu**

**Backend - Menu Admin:**
1. Login ke admin
2. Menu **Pengaturan** → **Modul**
3. Tambahkan modul:
   - Nama: `Jadwal Pelayanan`
   - URL: `jadwal-pelayanan/list`
   - Icon: `fas fa-calendar-alt`

**Frontend - Menu Navigasi:**

Edit `app/Views/frontend/desaku/desktop/v_menu.php`:

```php
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('jadwal') ?>">
        <i class="fas fa-calendar-check"></i> Jadwal Pelayanan
    </a>
</li>
```

---

## Struktur Database

### **Tabel: custome__jadwal_pelayanan**

| Field | Type | Description |
|-------|------|-------------|
| id_jadwal | INT(11) | Primary Key |
| judul_jadwal | VARCHAR(255) | Judul/nama jadwal |
| jenis_pelayanan | ENUM | Jenis pelayanan (8 pilihan) |
| tanggal | DATE | Tanggal pelayanan |
| waktu_mulai | TIME | Waktu mulai |
| waktu_selesai | TIME | Waktu selesai (opsional) |
| tempat | VARCHAR(255) | Lokasi pelayanan |
| pengkhotbah | VARCHAR(255) | Nama pengkhotbah |
| liturgis | VARCHAR(255) | Nama liturgis |
| singer | TEXT | Nama-nama singer (comma separated) |
| pemusik | TEXT | Nama-nama pemusik (comma separated) |
| multimedia | VARCHAR(255) | Nama operator multimedia |
| usher | TEXT | Nama-nama usher (comma separated) |
| keterangan | TEXT | Keterangan tambahan |
| status | ENUM('0','1') | 0=Draft, 1=Published |
| warna | VARCHAR(7) | Warna hex untuk calendar |
| user_id | INT(11) | ID user yang input |
| tgl_input | DATETIME | Tanggal input |

**Indexes:**
- `idx_tanggal` - Index pada tanggal
- `idx_jenis` - Index pada jenis_pelayanan
- `idx_status` - Index pada status
- `idx_tanggal_status` - Composite index
- `idx_jenis_tanggal` - Composite index

---

## Cara Penggunaan

### **A. Admin - Manajemen Jadwal**

#### **1. Tambah Jadwal Baru**
1. Login ke admin
2. Menu **Jadwal Pelayanan**
3. Klik **Tambah Jadwal**
4. Isi form:
   - **Judul Jadwal** * (required)
   - **Jenis Pelayanan** * (required)
   - **Tanggal** * (required)
   - **Waktu Mulai** * (required)
   - **Waktu Selesai** (opsional)
   - **Tempat** (default: Gedung Gereja)
   - **Pengkhotbah**
   - **Liturgis**
   - **Singer** (pisahkan dengan koma)
   - **Pemusik** (pisahkan dengan koma)
   - **Multimedia**
   - **Usher** (pisahkan dengan koma)
   - **Keterangan**
   - **Status** (Draft/Published)
   - **Warna** (untuk calendar)
5. Klik **Simpan**

#### **2. Edit Jadwal**
1. Klik tombol **Edit** pada jadwal
2. Ubah data yang diperlukan
3. Klik **Simpan Perubahan**

#### **3. Lihat Detail**
1. Klik tombol **Lihat** pada jadwal
2. Muncul modal dengan detail lengkap

#### **4. Hapus Jadwal**
1. Klik tombol **Hapus**
2. Konfirmasi penghapusan

#### **5. Hapus Multiple**
1. Centang jadwal yang akan dihapus
2. Klik **Hapus Terpilih**
3. Konfirmasi

#### **6. Toggle Status**
1. Klik tombol toggle status
2. Status berubah Draft ↔ Published

### **B. Jemaat - Melihat Jadwal**

#### **1. Akses Halaman Jadwal**
- URL: `http://domain.com/jadwal`
- Menu navigasi: **Jadwal Pelayanan**

#### **2. Fitur yang Tersedia:**

**Jadwal Hari Ini:**
- Tampil di sidebar (jika ada)
- Highlight dengan border biru

**Jadwal Minggu Ini:**
- Tampil di bagian atas
- Card dengan background hijau
- Format tanggal lengkap

**Jadwal Mendatang:**
- Dikelompokkan per bulan
- Format compact

**Filter Jenis:**
- Sidebar kiri
- 8 jenis pelayanan
- Klik untuk filter

**Detail Jadwal:**
- Klik tombol "Lihat Detail"
- Modal popup dengan info lengkap:
  - Tanggal & waktu
  - Tempat
  - Pengkhotbah
  - Tim pelayanan lengkap
  - Keterangan

---

## API Endpoints

### **Backend (Admin)**

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/jadwal-pelayanan/list` | Halaman list jadwal | Admin |
| GET | `/jadwal-pelayanan/getdata` | Get data AJAX | Admin |
| GET | `/jadwal-pelayanan/formtambah` | Form tambah | Admin |
| POST | `/jadwal-pelayanan/simpan` | Simpan jadwal | Admin |
| POST | `/jadwal-pelayanan/formedit` | Form edit | Admin |
| POST | `/jadwal-pelayanan/update` | Update jadwal | Admin |
| POST | `/jadwal-pelayanan/hapus` | Hapus single | Admin |
| POST | `/jadwal-pelayanan/hapusall` | Hapus multiple | Admin |
| POST | `/jadwal-pelayanan/toggle` | Toggle status | Admin |
| POST | `/jadwal-pelayanan/formlihat` | Detail jadwal | Admin |
| GET | `/jadwal-pelayanan/getcalendar` | Events for calendar | Admin |

### **Frontend (Publik)**

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/jadwal` | Halaman jadwal | Publik |
| GET | `/jadwal/jenis/{jenis}` | Filter by jenis | Publik |
| POST | `/jadwal/bybulan` | Jadwal by bulan | Publik |
| GET | `/jadwal/getevents` | Events for calendar | Publik |
| POST | `/jadwal/detail` | Detail jadwal | Publik |
| GET | `/jadwal/widget` | Widget jadwal | Publik |

---

## Integrasi Frontend

### **1. Menampilkan di Homepage**

Tambahkan widget jadwal di homepage:

```php
<!-- Widget Jadwal Upcoming -->
<section class="jadwal-section">
    <div class="container">
        <h3>Jadwal Pelayanan Mendatang</h3>
        <?php 
        $jadwal_model = new \App\Models\M_JadwalPelayanan();
        $jadwal_upcoming = $jadwal_model->upcoming(5);
        
        foreach ($jadwal_upcoming as $item) : ?>
            <div class="jadwal-item">
                <div class="date"><?= date('d M', strtotime($item['tanggal'])) ?></div>
                <div class="info">
                    <h5><?= $item['judul_jadwal'] ?></h5>
                    <p><?= $item['waktu_mulai'] ?> | <?= $item['tempat'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        
        <a href="<?= base_url('jadwal') ?>" class="btn btn-primary">
            Lihat Semua Jadwal
        </a>
    </div>
</section>
```

### **2. Sidebar Widget**

```php
<!-- Sidebar Jadwal -->
<div class="widget widget-jadwal">
    <h4>Jadwal Hari Ini</h4>
    <?php 
    $jadwal_model = new \App\Models\M_JadwalPelayanan();
    $jadwal_hari_ini = $jadwal_model->hariini();
    
    if ($jadwal_hari_ini) :
        foreach ($jadwal_hari_ini as $item) : ?>
            <div class="jadwal-item">
                <strong><?= $item['judul_jadwal'] ?></strong><br>
                <small><?= $item['waktu_mulai'] ?> | <?= $item['tempat'] ?></small>
            </div>
        <?php endforeach;
    else : ?>
        <p>Tidak ada jadwal hari ini</p>
    <?php endif; ?>
</div>
```

### **3. Calendar View (FullCalendar)**

Untuk menampilkan jadwal dalam bentuk calendar:

```html
<!-- Include FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/id.js'></script>

<div id='calendar'></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        events: '<?= base_url('jadwal/getevents') ?>',
        eventClick: function(info) {
            // Show detail modal
            alert('Event: ' + info.event.title);
        }
    });
    calendar.render();
});
</script>
```

---

## Customisasi

### **Menambah Jenis Pelayanan:**

Edit file `db/jadwal_pelayanan_table.sql`:

```sql
`jenis_pelayanan` enum(
    'Ibadah Minggu',
    'Ibadah Pemuda',
    'Ibadah Anak',
    'Persekutuan Doa',
    'Komsel',
    'Kebaktian Khusus',
    'Acara Gereja',
    'Lainnya',
    'Jenis Baru Anda'  -- Tambahkan di sini
) NOT NULL
```

### **Mengubah Warna Default:**

Edit `app/Controllers/JadwalPelayanan.php`:

```php
'warna' => $this->request->getVar('warna') ?? '#your-color',
```

### **Mengubah Jumlah Upcoming:**

Edit `app/Controllers/Jadwal.php`:

```php
$jadwal = $this->jadwalpelayanan->upcoming(20); // Ubah angka
```

---

## Troubleshooting

### **Jadwal tidak tampil:**
- Cek status jadwal (harus Published)
- Cek tanggal (harus >= hari ini)
- Cek database sudah diimport

### **Tanggal tidak format Indonesia:**
- Pastikan Moment.js sudah diload
- Pastikan locale 'id' sudah diload
- Cek `moment.locale('id')` dipanggil

### **Modal detail tidak muncul:**
- Cek jQuery sudah diload
- Cek Bootstrap JS sudah diload
- Cek console browser untuk error

---

## 📱 Responsive Design

Views sudah responsive dengan breakpoint:
- **Desktop**: Full layout dengan sidebar
- **Tablet**: Layout adjusted
- **Mobile**: Stack layout

---

## 🎨 Customisasi CSS

Tambahkan di CSS template:

```css
/* Jadwal Custom Styles */
.jadwal-item {
    transition: all 0.3s ease;
}

.jadwal-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.date-box {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.badge-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
```

---

## 🚀 Next Steps

### **Prioritas Tinggi:**
1. Buat views backend (list, tambah, edit, lihat)
2. Test semua fitur
3. Tambahkan data jadwal real

### **Prioritas Sedang:**
4. Implementasi FullCalendar view
5. Notifikasi jadwal (email/WA)
6. Export jadwal (PDF/Excel)

### **Prioritas Rendah:**
7. Recurring events
8. Reminder otomatis
9. Konfirmasi kehadiran tim
10. Absensi pelayanan

---

## 📖 Support

Untuk bantuan lebih lanjut:
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

**Dibuat:** 7 Oktober 2025  
**Versi:** 1.0.0  
**Framework:** CodeIgniter 4  
**Template:** Desaku
