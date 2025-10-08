# 💰 Dokumentasi Modul Keuangan Gereja

## 🎯 **Deskripsi Modul**
Modul Keuangan Gereja adalah sistem manajemen keuangan lengkap untuk mengelola pemasukan, pengeluaran, kas, dan laporan keuangan gereja. Modul ini menyediakan fitur CRUD yang komprehensif dengan approval system dan dashboard analytics.

---

## 📊 **Fitur Utama**

### ✅ **CRUD Operations**
- **Create**: Tambah transaksi dengan auto-generate kode
- **Read**: Lihat daftar transaksi dengan berbagai filter
- **Update**: Edit transaksi (hanya yang pending/ditolak)
- **Delete**: Hapus transaksi tunggal atau multiple (bulk delete)

### ✅ **Manajemen Transaksi**
- **Auto-Generate Kode**: Kode transaksi otomatis (TRX + tanggal + nomor urut)
- **Approval System**: Sistem persetujuan dengan 4 status (Pending, Disetujui, Ditolak, Dibatalkan)
- **Kategori Keuangan**: Master kategori pemasukan dan pengeluaran dengan warna
- **Metode Pembayaran**: Tunai, Transfer, Cek, Kartu
- **Upload Bukti**: Upload bukti transaksi (gambar/PDF)

### ✅ **Manajemen Kas**
- **Multi Kas**: Kas Utama, Kas Khusus, Tabungan, Deposito
- **Mutasi Otomatis**: Pencatatan mutasi kas otomatis saat transaksi disetujui
- **Rekonsiliasi**: Fitur rekonsiliasi saldo kas
- **Riwayat Mutasi**: Tracking semua perubahan saldo kas

### ✅ **Dashboard & Analytics**
- **Real-time Statistics**: Statistik pemasukan, pengeluaran, saldo
- **Grafik Bulanan**: Chart pemasukan vs pengeluaran per bulan
- **Top Categories**: Kategori pemasukan dan pengeluaran terbesar
- **Pending Approval**: List transaksi yang menunggu persetujuan
- **Kas Overview**: Overview saldo semua kas

### ✅ **Laporan Keuangan**
- **Laporan Periode**: Generate laporan berdasarkan periode
- **Summary Report**: Ringkasan pemasukan, pengeluaran, saldo
- **Detail per Kategori**: Breakdown per kategori keuangan
- **Export Ready**: Siap untuk export ke PDF/Excel

---

## 🗂️ **Struktur File**

### **Database**
```
db/custome__keuangan_gereja.sql - Schema database lengkap dengan sample data
```

### **Models (4 file)**
```
app/Models/M_KeuanganGereja.php     - Model utama transaksi
app/Models/M_KategoriKeuangan.php   - Model kategori keuangan
app/Models/M_KasGereja.php          - Model kas gereja
app/Models/M_MutasiKas.php          - Model mutasi kas
```

### **Controller**
```
app/Controllers/KeuanganGereja.php - Controller utama dengan 15+ method
```

### **Views**
```
app/Views/backend/morvin/cmscust/keuangan_gereja/
├── index.php      - Halaman utama dengan laporan integration
├── list.php       - Tampilan daftar dengan statistik
├── tambah.php     - Form tambah dengan kategori dinamis
├── approve.php    - Form approval dengan kas selection
└── dashboard.php  - Dashboard analytics dengan charts
```

---

## 🗄️ **Database Schema**

### **Tabel Utama: `custome__transaksi_keuangan`**

| Field | Type | Description |
|-------|------|-------------|
| `id_transaksi` | INT(11) PK | ID unik transaksi |
| `kode_transaksi` | VARCHAR(20) UNIQUE | Kode transaksi auto-generate |
| `id_kategori` | INT(11) FK | Referensi ke kategori keuangan |
| `tanggal_transaksi` | DATE | Tanggal transaksi |
| `jenis_transaksi` | ENUM | Pemasukan/Pengeluaran |
| `jumlah` | DECIMAL(15,2) | Nominal transaksi |
| `sumber_dana` | VARCHAR(255) | Sumber dana (untuk pemasukan) |
| `penerima` | VARCHAR(255) | Penerima dana (untuk pengeluaran) |
| `keterangan` | TEXT | Keterangan detail transaksi |
| `bukti_transaksi` | VARCHAR(255) | File bukti transaksi |
| `metode_pembayaran` | ENUM | Tunai/Transfer/Cek/Kartu |
| `no_referensi` | VARCHAR(100) | Nomor referensi |
| `status` | ENUM | Pending/Disetujui/Ditolak/Dibatalkan |
| `disetujui_oleh` | INT(11) | User yang menyetujui |
| `created_by` | INT(11) | User yang membuat |

### **Tabel Pendukung**
- `custome__kategori_keuangan` - Master kategori dengan jenis dan warna
- `custome__kas_gereja` - Master kas dengan saldo dan bank info
- `custome__mutasi_kas` - Log mutasi kas dengan saldo before/after
- `custome__persembahan_detail` - Detail persembahan per ibadah
- `custome__budget_gereja` - Budget planning (future)
- `custome__laporan_keuangan` - Generated reports (future)

---

## 🔧 **Instalasi**

### **1. Import Database**
```sql
-- Import file SQL
mysql -u username -p database_name < db/custome__keuangan_gereja.sql
```

### **2. Update BaseController**
Semua model sudah ditambahkan ke `BaseController.php`

### **3. Routes**
Routes sudah ditambahkan ke `app/Config/Routes.php`

### **4. Create Upload Directory**
```bash
mkdir public/file/bukti_transaksi
chmod 755 public/file/bukti_transaksi
```

---

## 🎮 **Cara Penggunaan**

### **Akses Modul**
```
URL: http://domain.com/keuangan-gereja/list
```

### **Tambah Transaksi Baru**
1. Klik tombol "Tambah Transaksi"
2. Pilih jenis transaksi (Pemasukan/Pengeluaran)
3. Pilih kategori (otomatis filter berdasarkan jenis)
4. Isi nominal dan detail transaksi
5. Klik "Simpan" (status akan Pending)

### **Approval Process**
1. Admin melihat transaksi dengan status Pending
2. Klik tombol "Approve" pada transaksi
3. Pilih "Disetujui" atau "Ditolak"
4. Jika disetujui, pilih kas yang terpengaruh
5. Sistem otomatis update saldo kas

### **Dashboard Analytics**
1. Klik tombol "Dashboard"
2. Lihat statistik real-time
3. Analisis grafik bulanan
4. Monitor top categories
5. Proses pending approvals

### **Generate Laporan**
1. Klik tombol "Laporan"
2. Pilih periode laporan
3. Klik "Generate Laporan"
4. Lihat summary dan detail per kategori

---

## 📊 **Fitur Dashboard**

### **Main Statistics**
- **Pemasukan Bulan Ini**: Total pemasukan periode berjalan
- **Pengeluaran Bulan Ini**: Total pengeluaran periode berjalan
- **Saldo Bersih**: Selisih pemasukan dan pengeluaran
- **Total Kas**: Jumlah saldo semua kas aktif

### **Charts & Analytics**
- **Grafik Bulanan**: Line chart pemasukan vs pengeluaran
- **Saldo Per Kas**: Doughnut chart distribusi kas
- **Top Categories**: Ranking kategori terbesar
- **Pending Queue**: List transaksi menunggu approval

### **Status Overview**
- **Pending**: Transaksi menunggu persetujuan
- **Disetujui**: Transaksi yang sudah disetujui
- **Ditolak**: Transaksi yang ditolak
- **Dibatalkan**: Transaksi yang dibatalkan

---

## 💳 **Manajemen Kas**

### **Jenis Kas**
- **Kas Utama**: Kas operasional utama gereja
- **Kas Khusus**: Kas untuk keperluan khusus
- **Tabungan**: Tabungan di bank
- **Deposito**: Deposito berjangka

### **Mutasi Kas**
- Otomatis tercatat saat transaksi disetujui
- Tracking saldo sebelum dan sesudah
- Riwayat lengkap semua perubahan
- Fitur rekonsiliasi untuk koreksi

### **Bank Integration Ready**
- Field untuk nama bank
- Nomor rekening
- Atas nama rekening
- Siap untuk integrasi API bank

---

## 🔍 **Search & Filter**

### **Search Options**
- Pencarian berdasarkan kode transaksi
- Pencarian berdasarkan keterangan
- Pencarian berdasarkan sumber dana/penerima
- Pencarian berdasarkan kategori

### **Filter Options**
- Filter berdasarkan periode tanggal
- Filter berdasarkan jenis transaksi
- Filter berdasarkan status
- Filter berdasarkan kategori

---

## 🔐 **Keamanan & Validasi**

### **Validasi Input**
- Server-side validation untuk semua field wajib
- Validasi format currency dengan separator
- Validasi file upload (gambar/PDF, max 2MB)
- XSS protection dengan `esc()` function

### **Access Control**
- Hanya admin yang login dapat mengakses
- Kontrol hak akses berdasarkan grup user
- CSRF protection aktif
- Audit trail untuk approval

### **Data Integrity**
- Foreign key constraints
- Transaction rollback pada error
- Backup otomatis sebelum delete
- Validation sebelum kas update

---

## 📈 **Approval Workflow**

### **Status Flow**
```
Pending → Disetujui → Kas Updated
       → Ditolak → No Action
       → Dibatalkan → Rollback if needed
```

### **Approval Rules**
- Hanya transaksi Pending yang bisa disetujui
- Transaksi Disetujui tidak bisa diubah
- Transaksi Ditolak bisa diedit dan disubmit ulang
- Kas otomatis update saat Disetujui

---

## 🚀 **Fitur Lanjutan**

### **Auto-Generate Kode**
```php
// Format: TRX + YYYYMMDD + 001
$kode = $this->keuangangereja->generateKodeTransaksi();
// Result: TRX20251008001
```

### **Currency Formatting**
```javascript
// Auto format input currency
$('.currency').on('input', function() {
    let value = $(this).val().replace(/[^0-9]/g, '');
    $(this).val(new Intl.NumberFormat('id-ID').format(value));
});
```

### **Kas Mutation**
```php
// Catat mutasi kas otomatis
$this->mutasikas->catatMutasi($id_kas, $id_transaksi, $jenis_mutasi, $jumlah);
```

---

## 📱 **Responsive Design**

### **Mobile Friendly**
- Responsive table dengan DataTables
- Mobile-optimized forms
- Touch-friendly dashboard
- Optimized for tablet and phone

### **UI Components**
- Bootstrap 5 styling
- FontAwesome icons
- Chart.js for analytics
- SweetAlert2 for confirmations
- Toastr for notifications

---

## 🔧 **API Endpoints**

### **Main Operations**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| GET | `/keuangan-gereja/list` | Halaman utama |
| GET | `/keuangan-gereja/getdata` | Get data untuk DataTables |
| POST | `/keuangan-gereja/formlihat` | Form lihat detail |
| POST | `/keuangan-gereja/formedit` | Form edit |
| POST | `/keuangan-gereja/update` | Update data |
| GET | `/keuangan-gereja/formtambah` | Form tambah |
| POST | `/keuangan-gereja/simpan` | Simpan data baru |
| POST | `/keuangan-gereja/hapus` | Hapus single data |
| POST | `/keuangan-gereja/hapusall` | Hapus multiple data |

### **Approval & Reports**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| POST | `/keuangan-gereja/formapprove` | Form approve |
| POST | `/keuangan-gereja/approve` | Process approval |
| GET | `/keuangan-gereja/dashboard` | Dashboard data |
| POST | `/keuangan-gereja/search` | Search transaksi |
| POST | `/keuangan-gereja/filterbyperiode` | Filter by periode |
| POST | `/keuangan-gereja/laporan` | Generate laporan |
| POST | `/keuangan-gereja/uploadbukti` | Upload bukti |

---

## 🐛 **Troubleshooting**

### **Error: Table doesn't exist**
```bash
# Import database schema
mysql -u username -p database_name < db/custome__keuangan_gereja.sql
```

### **Error: Upload directory not writable**
```bash
# Set permissions
chmod 755 public/file/bukti_transaksi
chown www-data:www-data public/file/bukti_transaksi
```

### **Error: Chart not displaying**
```html
<!-- Pastikan Chart.js sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

### **Currency format tidak bekerja**
1. Cek JavaScript currency formatter
2. Pastikan Intl.NumberFormat supported
3. Cek format locale 'id-ID'

---

## 📈 **Pengembangan Lebih Lanjut**

### **Fitur yang Bisa Ditambahkan**
1. **Budget Planning**: Perencanaan anggaran tahunan
2. **Bank Integration**: Integrasi dengan API bank
3. **Mobile App**: Aplikasi mobile untuk approval
4. **Auto Backup**: Backup otomatis database
5. **Export Features**: Export ke PDF, Excel, CSV
6. **Email Notification**: Notifikasi approval via email
7. **Multi Currency**: Support multiple mata uang
8. **Recurring Transaction**: Transaksi berulang otomatis

### **Optimisasi**
1. **Caching**: Cache dashboard statistics
2. **Indexing**: Optimasi database index
3. **Pagination**: Server-side pagination
4. **Background Jobs**: Queue untuk heavy operations

---

## 📝 **Changelog**

### **Version 1.0.0** - 8 Oktober 2025
- ✅ Implementasi CRUD lengkap
- ✅ Approval system dengan kas integration
- ✅ Dashboard analytics dengan Chart.js
- ✅ Auto-generate kode transaksi
- ✅ Multi kas management
- ✅ Upload bukti transaksi
- ✅ Search dan filter advanced
- ✅ Laporan keuangan periode
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
- Decimal untuk currency precision
- Enum untuk status dan kategori
- Timestamp untuk audit trail

### **Integration Ready**
- Siap integrasi dengan modul jadwal ibadah (persembahan)
- API-ready untuk mobile app
- Export-ready untuk reporting
- Bank-ready untuk auto sync

---

**Dibuat:** 8 Oktober 2025  
**Framework:** CodeIgniter 4  
**Template:** Morvin  
**Status:** ✅ READY TO USE

**URL Akses:** `http://domain.com/keuangan-gereja/list`
