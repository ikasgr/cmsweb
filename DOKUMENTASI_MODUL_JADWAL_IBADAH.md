# 📅 Dokumentasi Modul Jadwal Ibadah & Pelayanan

## 🎯 **Deskripsi Modul**
Modul Jadwal Ibadah & Pelayanan adalah sistem manajemen lengkap untuk mengelola jadwal ibadah gereja, pelayan, musik, dan pengumuman. Modul ini menyediakan fitur CRUD yang komprehensif dengan calendar view dan recurring events.

---

## 📊 **Fitur Utama**

### ✅ **CRUD Operations**
- **Create**: Tambah jadwal ibadah dengan validasi konflik
- **Read**: Lihat daftar jadwal dengan berbagai filter dan calendar view
- **Update**: Edit jadwal dengan pengaturan recurring
- **Delete**: Hapus jadwal tunggal atau multiple (bulk delete)

### ✅ **Manajemen Jadwal**
- **Jenis Ibadah**: Kategorisasi ibadah dengan warna dan durasi
- **Recurring Events**: Jadwal berulang (mingguan, bulanan, tahunan)
- **Conflict Detection**: Deteksi bentrok jadwal otomatis
- **Status Management**: Terjadwal, Berlangsung, Selesai, Dibatalkan
- **Copy Functionality**: Duplikasi jadwal dengan semua komponennya

### ✅ **Manajemen Pelayanan**
- **Pelayan Ibadah**: Assign pelayan berdasarkan jabatan
- **Jabatan Pelayanan**: Master data jabatan dengan urutan
- **Konfirmasi Status**: Pending, Dikonfirmasi, Ditolak
- **Conflict Check**: Cek konflik pelayan di tanggal yang sama

### ✅ **Manajemen Musik & Pengumuman**
- **Musik Ibadah**: Daftar lagu dengan kategori dan urutan
- **Pengumuman**: Pengumuman dengan prioritas penting
- **Template System**: Copy musik dan pengumuman dari jadwal lain

### ✅ **Fitur Advanced**
- **Calendar Integration**: FullCalendar dengan drag & drop
- **Dashboard Statistics**: Grafik dan statistik lengkap
- **Search & Filter**: Pencarian berdasarkan berbagai kriteria
- **Export Ready**: Siap untuk integrasi export PDF/Excel

---

## 🗂️ **Struktur File**

### **Database**
```
db/custome__jadwal_ibadah.sql - Schema database lengkap dengan sample data
```

### **Models (6 file)**
```
app/Models/M_JadwalIbadah.php        - Model utama jadwal
app/Models/M_JenisIbadah.php         - Model jenis ibadah
app/Models/M_PelayanIbadah.php       - Model pelayan
app/Models/M_JabatanPelayanan.php    - Model jabatan pelayanan
app/Models/M_MusikIbadah.php         - Model musik/lagu
app/Models/M_PengumumanIbadah.php    - Model pengumuman
```

### **Controller**
```
app/Controllers/JadwalIbadah.php - Controller utama dengan 15+ method
```

### **Views**
```
app/Views/backend/morvin/cmscust/jadwal_ibadah/
├── index.php    - Halaman utama dengan calendar integration
├── list.php     - Tampilan daftar dengan statistik
├── tambah.php   - Form tambah dengan recurring settings
├── edit.php     - Form edit jadwal
└── lihat.php    - Detail lengkap jadwal dengan semua komponen
```

---

## 🗄️ **Database Schema**

### **Tabel Utama: `custome__jadwal_ibadah`**

| Field | Type | Description |
|-------|------|-------------|
| `id_jadwal` | INT(11) PK | ID unik jadwal |
| `id_jenis_ibadah` | INT(11) FK | Referensi ke jenis ibadah |
| `judul_ibadah` | VARCHAR(255) | Judul ibadah |
| `tanggal` | DATE | Tanggal ibadah |
| `jam_mulai` | TIME | Jam mulai |
| `jam_selesai` | TIME | Jam selesai |
| `tempat` | VARCHAR(255) | Tempat ibadah |
| `tema_ibadah` | VARCHAR(255) | Tema ibadah |
| `ayat_tema` | TEXT | Ayat tema |
| `liturgi` | TEXT | Susunan acara |
| `keterangan` | TEXT | Keterangan tambahan |
| `max_peserta` | INT(11) | Maksimal peserta |
| `is_recurring` | TINYINT(1) | Apakah recurring |
| `recurring_type` | ENUM | Tipe recurring |
| `recurring_end` | DATE | Tanggal akhir recurring |
| `status` | ENUM | Status jadwal |
| `created_by` | INT(11) | Dibuat oleh |

### **Tabel Pendukung**
- `custome__jenis_ibadah` - Master jenis ibadah
- `custome__pelayan_ibadah` - Data pelayan per jadwal
- `custome__jabatan_pelayanan` - Master jabatan pelayanan
- `custome__musik_ibadah` - Musik/lagu per jadwal
- `custome__pengumuman_ibadah` - Pengumuman per jadwal
- `custome__kehadiran_ibadah` - Data kehadiran (future)
- `custome__persembahan_ibadah` - Data persembahan (future)

---

## 🔧 **Instalasi**

### **1. Import Database**
```sql
-- Import file SQL
mysql -u username -p database_name < db/custome__jadwal_ibadah.sql
```

### **2. Update BaseController**
Semua model sudah ditambahkan ke `BaseController.php`

### **3. Routes**
Routes sudah ditambahkan ke `app/Config/Routes.php`

### **4. Dependencies**
Untuk calendar view, pastikan FullCalendar sudah tersedia:
```html
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
```

---

## 🎮 **Cara Penggunaan**

### **Akses Modul**
```
URL: http://domain.com/jadwal-ibadah/list
```

### **Tambah Jadwal Baru**
1. Klik tombol "Tambah Jadwal"
2. Pilih jenis ibadah
3. Isi informasi dasar (judul, tanggal, waktu)
4. Isi tema dan liturgi (opsional)
5. Set recurring jika diperlukan
6. Klik "Simpan"

### **Recurring Events**
1. Centang "Jadwal Berulang" saat tambah/edit
2. Pilih tipe: Mingguan, Bulanan, atau Tahunan
3. Set tanggal berakhir
4. Sistem akan generate jadwal otomatis

### **Calendar View**
1. Klik tombol "View Calendar"
2. Navigasi dengan tombol prev/next
3. Klik event untuk lihat detail
4. Drag & drop untuk reschedule (future feature)

### **Copy Jadwal**
1. Klik tombol "Copy" pada jadwal yang ingin diduplikasi
2. Pilih tanggal baru
3. Sistem akan copy jadwal beserta pelayan, musik, dan pengumuman

### **Conflict Detection**
- Sistem otomatis cek bentrok jadwal saat save
- Warning muncul jika ada konflik waktu
- Validasi berlaku untuk tanggal dan jam yang sama

---

## 📊 **Fitur Dashboard**

### **Statistik Cards**
- **Total Jadwal**: Jumlah seluruh jadwal
- **Bulan Ini**: Jadwal bulan berjalan
- **Minggu Ini**: Jadwal minggu berjalan
- **Hari Ini**: Jadwal hari ini

### **Status Statistics**
- **Terjadwal**: Jadwal yang belum dimulai
- **Berlangsung**: Jadwal yang sedang berjalan
- **Selesai**: Jadwal yang sudah selesai
- **Dibatalkan**: Jadwal yang dibatalkan

### **Quick Access**
- Jadwal hari ini
- Jadwal minggu ini
- Jadwal mendatang (7 hari)

---

## 🔍 **Search & Filter**

### **Search Options**
- Pencarian berdasarkan judul ibadah
- Pencarian berdasarkan tema
- Pencarian berdasarkan tempat
- Pencarian berdasarkan jenis ibadah

### **Filter Options**
- Filter berdasarkan bulan dan tahun
- Filter berdasarkan jenis ibadah
- Filter berdasarkan status
- Filter berdasarkan tempat

---

## 🎵 **Manajemen Musik & Pelayanan**

### **Musik Ibadah**
- Kategori: Pembukaan, Pujian, Penyembahan, Persembahan, Penutup, Khusus
- Urutan lagu dapat diatur
- Support chord dan lirik
- Audio file upload (future)

### **Pelayan Ibadah**
- Jabatan: Pendeta, Liturgis, Organis, Pemimpin Pujian, dll
- Status konfirmasi per pelayan
- Integrasi dengan data jemaat
- Conflict detection untuk pelayan

### **Pengumuman**
- Prioritas penting dengan highlight
- Urutan pengumuman dapat diatur
- Rich text support (future)

---

## 🔐 **Keamanan & Validasi**

### **Validasi Input**
- Server-side validation untuk semua field wajib
- Validasi format tanggal dan waktu
- Conflict detection untuk jadwal
- XSS protection dengan `esc()` function

### **Access Control**
- Hanya admin yang login dapat mengakses
- Kontrol hak akses berdasarkan grup user
- CSRF protection aktif
- Audit trail untuk perubahan data

---

## 🚀 **Fitur Lanjutan**

### **Calendar Integration**
```javascript
// FullCalendar initialization
$('#calendar').fullCalendar({
    events: {
        url: 'jadwal-ibadah/getcalendar',
        type: 'GET'
    },
    eventClick: function(event) {
        lihat(event.id);
    }
});
```

### **Recurring Logic**
```php
// Generate recurring events
$generated = $this->jadwalibadah->generateRecurring($id_jadwal);
```

### **Conflict Detection**
```php
// Check schedule conflict
$konflik = $this->jadwalibadah->cekKonflik($tanggal, $jam_mulai, $jam_selesai);
```

---

## 📱 **Responsive Design**

### **Mobile Friendly**
- Responsive table dengan DataTables
- Mobile-optimized forms
- Touch-friendly calendar
- Optimized for tablet and phone

### **UI Components**
- Bootstrap 5 styling
- FontAwesome icons
- SweetAlert2 for confirmations
- Toastr for notifications

---

## 🔧 **API Endpoints**

### **Main Operations**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| GET | `/jadwal-ibadah/list` | Halaman utama |
| GET | `/jadwal-ibadah/getdata` | Get data untuk DataTables |
| POST | `/jadwal-ibadah/formlihat` | Form lihat detail |
| POST | `/jadwal-ibadah/formedit` | Form edit |
| POST | `/jadwal-ibadah/update` | Update data |
| GET | `/jadwal-ibadah/formtambah` | Form tambah |
| POST | `/jadwal-ibadah/simpan` | Simpan data baru |
| POST | `/jadwal-ibadah/hapus` | Hapus single data |
| POST | `/jadwal-ibadah/hapusall` | Hapus multiple data |
| POST | `/jadwal-ibadah/toggle` | Toggle status |

### **Advanced Features**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| GET | `/jadwal-ibadah/getcalendar` | Get calendar events |
| POST | `/jadwal-ibadah/copy` | Copy jadwal |
| GET | `/jadwal-ibadah/dashboard` | Dashboard data |
| POST | `/jadwal-ibadah/search` | Search jadwal |
| POST | `/jadwal-ibadah/filterbymonth` | Filter by month |

---

## 🐛 **Troubleshooting**

### **Error: Table doesn't exist**
```bash
# Import database schema
mysql -u username -p database_name < db/custome__jadwal_ibadah.sql
```

### **Error: FullCalendar not working**
```html
<!-- Pastikan library sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
```

### **Error: Class not found**
```php
// Pastikan semua model sudah ditambahkan di BaseController.php
$this->jadwalibadah = new M_JadwalIbadah();
```

### **Recurring tidak berfungsi**
1. Cek field `is_recurring` dan `recurring_end`
2. Pastikan method `generateRecurring()` dipanggil
3. Cek log error untuk detail

---

## 📈 **Pengembangan Lebih Lanjut**

### **Fitur yang Bisa Ditambahkan**
1. **Kehadiran Digital**: QR code untuk absensi
2. **Live Streaming**: Integrasi dengan platform streaming
3. **Mobile App**: Aplikasi mobile untuk jemaat
4. **Push Notification**: Reminder jadwal ibadah
5. **Export Features**: PDF bulletin, Excel report
6. **Email Integration**: Auto-send reminder ke pelayan
7. **Resource Booking**: Booking ruangan dan peralatan
8. **Multi-location**: Support multiple gereja

### **Optimisasi**
1. **Caching**: Cache calendar events
2. **Indexing**: Optimasi database index
3. **Pagination**: Server-side pagination
4. **Background Jobs**: Queue untuk recurring generation

---

## 📝 **Changelog**

### **Version 1.0.0** - 8 Oktober 2025
- ✅ Implementasi CRUD lengkap
- ✅ Calendar integration dengan FullCalendar
- ✅ Recurring events system
- ✅ Conflict detection
- ✅ Copy functionality
- ✅ Search dan filter advanced
- ✅ Dashboard statistics
- ✅ Responsive design
- ✅ Validasi lengkap

---

## 👨‍💻 **Developer Notes**

### **Pola Kode**
Modul ini mengikuti pola yang sama dengan modul lainnya:
- Controller menggunakan AJAX untuk semua operasi
- View terpisah untuk setiap fungsi
- Model dengan method yang spesifik dan optimized
- Validasi server-side yang ketat

### **Database Design**
- Normalisasi yang baik dengan foreign key constraints
- Index untuk performa optimal
- Enum untuk status dan kategori
- Timestamp untuk audit trail

### **Integration Ready**
- Siap integrasi dengan modul jemaat
- API-ready untuk mobile app
- Export-ready untuk reporting
- Notification-ready untuk reminder

---

**Dibuat:** 8 Oktober 2025  
**Framework:** CodeIgniter 4  
**Template:** Morvin  
**Status:** ✅ READY TO USE

**URL Akses:** `http://domain.com/jadwal-ibadah/list`
