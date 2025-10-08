# 🔄 Redesign Modul Pendaftaran - Backend Admin

## 🎯 Tujuan Redesign

Meningkatkan modul pendaftaran Sidi, Baptis, dan Nikah dengan:
- ✅ Tampilan data lebih detail dan informatif
- ✅ Fitur upload dokumen pendukung lengkap
- ✅ Manajemen dokumen yang lebih baik
- ✅ Preview dokumen (image & PDF)
- ✅ Download dokumen
- ✅ Tracking status dokumen
- ✅ Validasi kelengkapan dokumen
- ✅ Timeline proses pendaftaran

---

## 📋 Modul yang Akan Diredesign

### 1. **Pendaftaran Sidi**
**Dokumen Existing:**
- KTP
- KK (Kartu Keluarga)
- Sertifikat Baptis
- Foto

**Dokumen Tambahan:**
- Surat Rekomendasi Gereja Asal (jika pindahan)
- Surat Keterangan Berkelakuan Baik
- Sertifikat Katekisasi

### 2. **Pendaftaran Baptis**
**Dokumen Existing:**
- KTP
- KK
- Akta Lahir
- Foto
- Surat Nikah Orang Tua

**Dokumen Tambahan:**
- Surat Rekomendasi (untuk dewasa)
- Surat Pernyataan Orang Tua (untuk anak)
- Sertifikat Katekisasi (untuk dewasa)

### 3. **Pendaftaran Nikah**
**Dokumen Existing:**
- Dokumen lengkap calon suami & istri

**Dokumen Tambahan:**
- Surat Baptis kedua calon
- Surat Sidi kedua calon
- Surat Keterangan Belum Menikah
- Surat Izin Orang Tua (jika < 21 tahun)
- Sertifikat Konseling Pranikah
- Surat Rekomendasi Gereja Asal

---

## 🎨 Fitur Baru Backend

### **1. Dashboard Pendaftaran**
- Card statistik per jenis pendaftaran
- Grafik pendaftaran per bulan
- List pending approval
- Alert dokumen tidak lengkap

### **2. List View Enhanced**
- DataTables dengan filter advanced
- Badge status warna
- Progress bar kelengkapan dokumen
- Quick action buttons
- Bulk operations

### **3. Detail View Lengkap**
- Tab-based interface:
  - Tab Data Pribadi
  - Tab Dokumen
  - Tab Timeline/History
  - Tab Catatan Admin
- Preview dokumen inline
- Download all documents (ZIP)
- Print formulir

### **4. Upload Dokumen**
- Drag & drop upload
- Multiple file upload
- Preview sebelum upload
- Validasi format & size
- Progress bar upload
- Thumbnail untuk image
- Icon untuk PDF

### **5. Manajemen Dokumen**
- List dokumen dengan status:
  - ✅ Lengkap
  - ⏳ Pending
  - ❌ Tidak Valid
  - 🔄 Perlu Diganti
- Komentar per dokumen
- Request dokumen tambahan
- Approve/Reject per dokumen

### **6. Status Management**
- Status workflow:
  - 📝 Draft
  - ⏳ Pending Review
  - 📄 Dokumen Lengkap
  - ✅ Disetujui
  - ❌ Ditolak
  - 🔄 Revisi
- Timeline tracking
- Email notification per status
- WhatsApp notification

### **7. Print & Export**
- Print formulir pendaftaran
- Print surat persetujuan
- Export data Excel
- Export dokumen ZIP
- Generate QR Code

---

## 🗄️ Database Schema Update

### Tabel Baru: `custome__pendaftaran_dokumen`
```sql
CREATE TABLE `custome__pendaftaran_dokumen` (
  `dokumen_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `status_dokumen` enum('pending','valid','invalid','revisi') DEFAULT 'pending',
  `keterangan` text DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `tgl_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  `verified_by` int(11) DEFAULT NULL,
  `tgl_verified` datetime DEFAULT NULL,
  PRIMARY KEY (`dokumen_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabel Baru: `custome__pendaftaran_timeline`
```sql
CREATE TABLE `custome__pendaftaran_timeline` (
  `timeline_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`timeline_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Tabel Baru: `custome__pendaftaran_catatan`
```sql
CREATE TABLE `custome__pendaftaran_catatan` (
  `catatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pendaftaran` enum('sidi','baptis','nikah') NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tipe` enum('internal','eksternal') DEFAULT 'internal',
  `user_id` int(11) NOT NULL,
  `tgl_catatan` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catatan_id`),
  KEY `idx_pendaftaran` (`jenis_pendaftaran`, `pendaftaran_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Update Tabel Existing:
```sql
-- Tambah field di tabel pendaftaran_sidi
ALTER TABLE `custome__pendaftaran_sidi` 
ADD COLUMN `kelengkapan_dokumen` int(11) DEFAULT 0 COMMENT 'Persentase kelengkapan',
ADD COLUMN `tgl_disetujui` datetime DEFAULT NULL,
ADD COLUMN `tgl_ditolak` datetime DEFAULT NULL,
ADD COLUMN `approved_by` int(11) DEFAULT NULL,
ADD COLUMN `alasan_tolak` text DEFAULT NULL;

-- Sama untuk baptis dan nikah
```

---

## 📁 File Structure Baru

```
app/
├── Controllers/
│   ├── PendaftaranSidi.php (update)
│   ├── PendaftaranBaptis.php (update)
│   ├── PendaftaranNikah.php (update)
│   └── PendaftaranDokumen.php (new)
├── Models/
│   ├── M_PendaftaranSidi.php (update)
│   ├── M_PendaftaranBaptis.php (update)
│   ├── M_PendaftaranNikah.php (update)
│   ├── M_PendaftaranDokumen.php (new)
│   ├── M_PendaftaranTimeline.php (new)
│   └── M_PendaftaranCatatan.php (new)
└── Views/backend/morvin/cmscust/
    ├── pendaftaran_sidi/
    │   ├── dashboard.php (new)
    │   ├── list.php (redesign)
    │   ├── lihat.php (redesign)
    │   ├── dokumen.php (new)
    │   └── print.php (new)
    ├── pendaftaran_baptis/
    │   └── (sama seperti sidi)
    └── pendaftaran_nikah/
        └── (sama seperti sidi)
```

---

## 🎨 UI/UX Improvements

### **List View:**
- Modern card layout
- Filter by status
- Search advanced
- Badge warna status
- Progress bar dokumen
- Quick actions

### **Detail View:**
- Tab navigation
- Accordion sections
- Image lightbox
- PDF viewer inline
- Timeline vertical
- Comment system

### **Upload Interface:**
- Drag & drop zone
- Multiple upload
- Progress indicator
- Preview thumbnails
- Delete confirmation

---

## 🔐 Security & Validation

### **Upload Security:**
- Whitelist file types (jpg, png, pdf)
- Max file size (5MB per file)
- Virus scan (optional)
- Secure file naming
- Protected directory

### **Access Control:**
- Role-based access
- Permission per action
- Audit log
- Session validation

---

## 📊 Reporting & Analytics

### **Dashboard:**
- Total pendaftaran per jenis
- Pending approval count
- Dokumen tidak lengkap
- Grafik trend bulanan

### **Reports:**
- Laporan pendaftaran periode
- Laporan kelengkapan dokumen
- Laporan approval rate
- Export Excel/PDF

---

## 🚀 Implementation Plan

### **Phase 1: Database & Models** (Day 1)
- [ ] Create new tables
- [ ] Update existing tables
- [ ] Create new models
- [ ] Update existing models

### **Phase 2: Backend Controllers** (Day 2)
- [ ] Update existing controllers
- [ ] Create document controller
- [ ] Add upload handlers
- [ ] Add validation

### **Phase 3: Backend Views** (Day 3-4)
- [ ] Redesign list views
- [ ] Create detail views
- [ ] Create upload interface
- [ ] Add timeline view

### **Phase 4: Testing & Polish** (Day 5)
- [ ] Test all features
- [ ] Fix bugs
- [ ] Add documentation
- [ ] Deploy

---

## 📝 Notes

**Backward Compatibility:**
- Existing data tetap berfungsi
- Migration script untuk data lama
- Fallback untuk dokumen lama

**Performance:**
- Lazy loading untuk images
- Pagination untuk dokumen
- Cache untuk preview
- CDN untuk assets

**Mobile Responsive:**
- Touch-friendly upload
- Responsive tables
- Mobile-optimized preview
- Swipe gestures

---

**Status:** 📋 PLANNING COMPLETE
**Ready for:** Implementation Phase 1
**Estimated Time:** 5 days
**Priority:** HIGH
