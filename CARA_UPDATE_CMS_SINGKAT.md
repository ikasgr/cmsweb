# ⚡ Cara Update CMS - Panduan Singkat

## 🎯 Update Otomatis (5 Menit)

### **Langkah 1: Login Admin**
```
URL: http://domain.com/cms-login
Username: admin
Password: CMS@d4tagoeGen5
```

### **Langkah 2: Buka Menu Update**
```
Dashboard → Pengaturan → Upgrade CMS
URL: http://domain.com/updatecms
```

### **Langkah 3: Cek Versi**
Sistem otomatis cek versi ke server:
```
Versi Lokal:  1.0.0
Versi Server: 1.1.0 ⬆️ (Ada update!)
```

### **Langkah 4: Update**

**Jika ada update database:**
1. Klik **"Update Database"**
2. Tunggu selesai ✅

**Update CMS:**
1. Klik **"Update CMS"**
2. Tunggu download & extract
3. Selesai! ✅

### **Langkah 5: Verifikasi**
- Refresh halaman (Ctrl + F5)
- Cek versi sudah berubah
- Test fitur baru

---

## 🔄 Cara Kerja Update

```
CMS Lokal → Cek ke Server → Download ZIP → Extract → Update Versi
```

**Server Pusat:**
- `https://datagoe.com`
- `https://ikasmedia.net`

**File yang Diupdate:**
- `app/Controllers/` - Controller baru/update
- `app/Models/` - Model baru/update
- `app/Views/` - View baru/update
- `public/template/` - Template baru
- `db/*.sql` - Update database

---

## ⚠️ PENTING - Sebelum Update

### **1. BACKUP WAJIB!**

**Backup Database:**
```bash
mysqldump -u root -p database_name > backup_$(date +%Y%m%d).sql
```

**Backup Files:**
```bash
zip -r backup_files.zip app/ public/ writable/
```

### **2. Catat Versi Sekarang**
```sql
SELECT vercms, verdb FROM tbl_setaplikasi;
```

### **3. Test di Localhost Dulu**
- Jangan langsung update di production
- Test semua fitur setelah update

---

## 🛠️ Troubleshooting Cepat

### **Error: "File tidak dapat diakses"**
```bash
# Cek koneksi internet
ping datagoe.com

# Atau update manual
```

### **Error: "Permission denied"**
```bash
# Set permission
chmod 755 writable/uploads/
chmod 755 app/
```

### **Error: "Download failed"**
- Koneksi lambat → Download manual
- Timeout → Increase timeout setting

### **Update Gagal?**
**Rollback:**
```bash
# 1. Restore database
mysql -u root -p database_name < backup.sql

# 2. Restore files
unzip backup_files.zip

# 3. Clear cache
php spark cache:clear
```

---

## 📋 Checklist Update

- [ ] ✅ Backup database
- [ ] ✅ Backup files
- [ ] ✅ Catat versi sekarang
- [ ] ✅ Koneksi internet stabil
- [ ] ✅ Login admin
- [ ] ✅ Buka menu Upgrade CMS
- [ ] ✅ Update database (jika ada)
- [ ] ✅ Update CMS
- [ ] ✅ Clear cache
- [ ] ✅ Test semua fitur
- [ ] ✅ Cek error log

---

## 🎯 Tips Cepat

### **Update Aman:**
- ✅ Backup dulu
- ✅ Update saat traffic rendah
- ✅ Test di localhost
- ✅ Baca changelog

### **Jangan Update Jika:**
- ❌ Tidak ada backup
- ❌ Koneksi tidak stabil
- ❌ Sedang traffic tinggi
- ❌ Belum baca changelog

---

## 📞 Butuh Bantuan?

**Support:**
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

**Dokumentasi Lengkap:**
- Baca: `PANDUAN_UPDATE_CMS.md`

---

## 🔐 Keamanan

**File yang JANGAN Ditimpa:**
- `.env` - Environment config
- `app/Config/Database.php` - Database config
- `public/img/` - Folder upload user
- `writable/` - Cache & logs

**Permission Aman:**
```bash
chmod 755 app/
chmod 755 public/
chmod 755 writable/
chmod 644 .env
```

---

## ⚡ Quick Commands

**Backup:**
```bash
# Database
mysqldump -u root -p cmsweb > backup.sql

# Files
zip -r backup.zip app/ public/ writable/
```

**Restore:**
```bash
# Database
mysql -u root -p cmsweb < backup.sql

# Files
unzip backup.zip
```

**Clear Cache:**
```bash
php spark cache:clear
rm -rf writable/cache/*
```

**Check Version:**
```sql
SELECT vercms, verdb FROM tbl_setaplikasi;
```

---

**Selamat mengupdate! 🚀**

**Update:** 7 Oktober 2025
