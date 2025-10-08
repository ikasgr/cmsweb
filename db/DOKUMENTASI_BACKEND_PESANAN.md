# 📊 Dokumentasi Backend Admin - Pesanan UMKM

## 🎯 Overview

Backend admin untuk mengelola pesanan produk UMKM dengan fitur lengkap monitoring, update status, dan reporting.

---

## 📁 File Structure

```
app/
├── Controllers/
│   └── PesananUmkm.php          # Controller backend
├── Models/
│   ├── M_Pesanan.php            # Model pesanan
│   └── M_PesananDetail.php      # Model detail
└── Views/backend/morvin/cmscust/pesanan_umkm/
    ├── list.php                 # List pesanan dengan DataTables
    ├── lihat.php                # Modal detail pesanan
    ├── dashboard.php            # Dashboard statistik
    └── print.php                # Print invoice
```

---

## 🔧 Controller Methods

### File: `app/Controllers/PesananUmkm.php`

| Method | Route | Description |
|--------|-------|-------------|
| `list()` | GET pesanan-umkm/list | Halaman list pesanan |
| `dashboard()` | GET pesanan-umkm/dashboard | Dashboard statistik |
| `getdata()` | GET pesanan-umkm/getdata | Data AJAX untuk DataTables |
| `formlihat()` | POST pesanan-umkm/formlihat | Modal detail pesanan |
| `updatestatus()` | POST pesanan-umkm/updatestatus | Update status pesanan |
| `hapus()` | POST pesanan-umkm/hapus | Hapus pesanan |
| `hapusall()` | POST pesanan-umkm/hapusall | Hapus multiple |
| `print()` | GET pesanan-umkm/print/(:num) | Print invoice |
| `export()` | GET pesanan-umkm/export | Export Excel |

---

## 🎨 Fitur Backend

### 1. **List Pesanan** (`list.php`)

**URL:** `/pesanan-umkm/list`

**Fitur:**
- ✅ DataTables dengan server-side processing
- ✅ Filter by status (6 tombol):
  - Semua
  - Pending (warning)
  - Diproses (info)
  - Dikirim (primary)
  - Selesai (success)
  - Dibatalkan (danger)
- ✅ Search global
- ✅ Pagination
- ✅ Checkbox untuk hapus multiple
- ✅ 10 kolom informatif
- ✅ 4 tombol aksi per row

**Kolom Tabel:**
1. Checkbox
2. No urut
3. Kode pesanan
4. Tanggal
5. Pembeli (nama + alamat)
6. No. HP
7. Total item & qty
8. Total bayar
9. Status (badge warna)
10. Aksi (4 tombol)

**Tombol Aksi:**
- 🔵 View Detail - Modal detail lengkap
- 🟡 Update Status - Modal update status
- 🟢 Print - Print invoice (new tab)
- 🔴 Hapus - Konfirmasi hapus

---

### 2. **Modal Detail** (`lihat.php`)

**Trigger:** Klik tombol View Detail

**Konten:**
- ✅ Info Pesanan (kode, tanggal, status, timeline)
- ✅ Data Pembeli (nama, HP, email, alamat, catatan)
- ✅ Detail Produk (tabel lengkap)
- ✅ Total & Subtotal
- ✅ Riwayat Status (timeline tracking)
- ✅ Tombol Aksi:
  - Kirim ke WhatsApp
  - Print Invoice
  - Tutup

**Timeline Tracking:**
- Visual timeline dengan marker
- Status history lengkap
- User yang update
- Timestamp
- Keterangan

---

### 3. **Dashboard** (`dashboard.php`)

**URL:** `/pesanan-umkm/dashboard`

**Statistik Cards:**
- 🟡 Pending - Jumlah pesanan pending
- 🔵 Diproses - Jumlah pesanan diproses
- 🟢 Dikirim - Jumlah pesanan dikirim
- ✅ Selesai - Jumlah pesanan selesai

**Informasi:**
- 💰 Total Pendapatan (dari pesanan selesai)
- ❌ Total Dibatalkan
- 📋 Tabel 10 pesanan terbaru

**Chart/Graph:** (Optional - bisa ditambahkan)
- Grafik pesanan per bulan
- Grafik pendapatan
- Top produk terlaris

---

### 4. **Print Invoice** (`print.php`)

**URL:** `/pesanan-umkm/print/{pesanan_id}`

**Fitur:**
- ✅ Layout print-friendly
- ✅ Header dengan logo & info gereja
- ✅ Kode invoice & tanggal
- ✅ Badge status warna
- ✅ Data pembeli lengkap
- ✅ Tabel produk
- ✅ Total & subtotal
- ✅ Footer info kontak
- ✅ Tombol print
- ✅ Auto-print option (commented)

**Print Styling:**
- Responsive
- No button saat print
- Clean layout
- Professional design

---

## 🔄 Flow Update Status

### Status Workflow:
```
Pending → Diproses → Dikirim → Selesai
   ↓
Dibatalkan (dari Pending/Diproses)
```

### Update Process:
1. Admin klik tombol "Update Status"
2. Modal muncul dengan dropdown status
3. Admin pilih status baru
4. Isi keterangan (optional)
5. Submit
6. Data tersimpan di:
   - `custome__pesanan` (status + timestamp)
   - `custome__pesanan_tracking` (history)

### Timestamp Auto-Update:
- `tgl_diproses` - Saat status = Diproses
- `tgl_dikirim` - Saat status = Dikirim
- `tgl_selesai` - Saat status = Selesai

---

## 📊 DataTables Configuration

### Server-Side Processing:
```javascript
{
    processing: true,
    serverSide: true,
    ajax: {
        url: '/pesanan-umkm/getdata',
        data: function(d) {
            d.status = currentStatus; // Filter
        }
    }
}
```

### Features:
- ✅ Sorting
- ✅ Searching
- ✅ Pagination
- ✅ Custom rendering
- ✅ Indonesian language
- ✅ Responsive

---

## 🔐 Security & Validation

### Backend Validation:
- ✅ Login check (session)
- ✅ AJAX request only
- ✅ CSRF protection
- ✅ Data sanitization
- ✅ SQL injection prevention

### Frontend Validation:
- ✅ Required fields
- ✅ Confirmation dialogs
- ✅ Error handling
- ✅ Success notifications

---

## 🎨 UI/UX Features

### Design:
- ✅ Modern card layout
- ✅ Color-coded status badges
- ✅ Icon indicators
- ✅ Hover effects
- ✅ Responsive design

### Notifications:
- ✅ SweetAlert2 untuk alerts
- ✅ Success messages
- ✅ Error messages
- ✅ Confirmation dialogs

### Loading States:
- ✅ DataTables loading
- ✅ Button loading spinner
- ✅ Modal loading

---

## 📱 Responsive Design

### Breakpoints:
- Desktop: Full features
- Tablet: Adjusted layout
- Mobile: Stacked cards

### Mobile Optimizations:
- ✅ Touch-friendly buttons
- ✅ Scrollable tables
- ✅ Collapsible sections
- ✅ Mobile-first approach

---

## 🚀 Quick Start

### 1. Import Database:
```bash
mysql -u username -p database < custome__pesanan_umkm_safe.sql
```

### 2. Access Backend:
```
URL: http://domain.com/pesanan-umkm/list
Login: Admin credentials
```

### 3. Test Features:
- [ ] View list pesanan
- [ ] Filter by status
- [ ] View detail pesanan
- [ ] Update status
- [ ] Print invoice
- [ ] Hapus pesanan
- [ ] View dashboard

---

## 📋 Admin Tasks

### Daily Tasks:
1. Cek pesanan pending
2. Update status pesanan
3. Konfirmasi pembayaran
4. Print invoice
5. Kirim notifikasi WhatsApp

### Weekly Tasks:
1. Review dashboard statistik
2. Export data pesanan
3. Analisis penjualan
4. Follow-up pesanan tertunda

### Monthly Tasks:
1. Laporan bulanan
2. Analisis produk terlaris
3. Review customer feedback
4. Optimasi proses

---

## 🔍 Troubleshooting

### DataTables tidak load:
```javascript
// Cek console browser
// Cek endpoint: /pesanan-umkm/getdata
// Cek session login
```

### Modal tidak muncul:
```javascript
// Cek jQuery loaded
// Cek Bootstrap JS loaded
// Cek AJAX response
```

### Print tidak berfungsi:
```javascript
// Cek popup blocker
// Cek URL print: /pesanan-umkm/print/{id}
// Cek browser print settings
```

---

## 📊 Database Queries

### Get Pesanan dengan Detail:
```sql
SELECT p.*, 
       COUNT(pd.detail_id) as jml_item
FROM custome__pesanan p
LEFT JOIN custome__pesanan_detail pd ON pd.pesanan_id = p.pesanan_id
GROUP BY p.pesanan_id
ORDER BY p.pesanan_id DESC;
```

### Get Statistik:
```sql
-- Pending
SELECT COUNT(*) FROM custome__pesanan WHERE status_pesanan = 'Pending';

-- Total Pendapatan
SELECT SUM(total_bayar) FROM custome__pesanan WHERE status_pesanan = 'Selesai';
```

---

## 🎯 Future Enhancements

### Phase 2:
- [ ] Export Excel dengan format
- [ ] Email notification
- [ ] SMS notification
- [ ] Bulk status update
- [ ] Advanced filtering
- [ ] Date range filter

### Phase 3:
- [ ] Chart & graphs
- [ ] Analytics dashboard
- [ ] Customer management
- [ ] Product analytics
- [ ] Sales forecast
- [ ] Inventory integration

---

## 📞 Support

**Akses Backend:**
- URL: `/pesanan-umkm/list`
- Dashboard: `/pesanan-umkm/dashboard`
- Print: `/pesanan-umkm/print/{id}`

**Dokumentasi:**
- Backend: `DOKUMENTASI_BACKEND_PESANAN.md`
- Frontend: `DOKUMENTASI_TOKO_UMKM_WHATSAPP.md`
- Database: `CARA_IMPORT_PESANAN.md`

---

**Status**: ✅ READY TO USE
**Version**: 1.0
**Last Updated**: 2025-10-08
