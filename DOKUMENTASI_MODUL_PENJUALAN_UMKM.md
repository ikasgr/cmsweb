# 📦 Dokumentasi Modul Penjualan Produk UMKM Gereja

## Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Fitur Utama](#fitur-utama)
3. [Instalasi](#instalasi)
4. [Struktur Database](#struktur-database)
5. [Cara Penggunaan](#cara-penggunaan)
6. [API Endpoints](#api-endpoints)
7. [Pengembangan](#pengembangan)

---

## Pengenalan

Modul Penjualan Produk UMKM Gereja adalah sistem e-commerce lengkap yang dirancang khusus untuk membantu gereja dalam memasarkan produk-produk UMKM jemaat secara online.

### **Tujuan Modul:**
- Memfasilitasi penjualan produk UMKM jemaat
- Meningkatkan pendapatan gereja dan jemaat
- Memberikan platform online yang mudah digunakan
- Mengelola pesanan dan stok produk secara efisien

---

## Fitur Utama

### **1. Manajemen Produk**
- ✅ CRUD produk lengkap
- ✅ Kategori produk
- ✅ Upload gambar produk (resize otomatis)
- ✅ Harga normal & harga promo
- ✅ Manajemen stok
- ✅ Produk featured
- ✅ Status aktif/nonaktif
- ✅ Tracking hits/views

### **2. Katalog Produk (Frontend)**
- ✅ Tampilan grid produk
- ✅ Filter by kategori
- ✅ Search produk
- ✅ Detail produk
- ✅ Produk terkait
- ✅ Produk featured
- ✅ Produk terlaris

### **3. Keranjang Belanja**
- ✅ Add to cart
- ✅ Update quantity
- ✅ Remove item
- ✅ Session-based cart
- ✅ Cart summary
- ✅ Auto calculate subtotal

### **4. Checkout & Pembayaran**
- ✅ Form checkout lengkap
- ✅ Validasi data pemesan
- ✅ Metode pembayaran:
  - Transfer Bank
  - COD (Cash on Delivery)
  - E-Wallet
- ✅ Upload bukti transfer
- ✅ Generate nomor pesanan otomatis

### **5. Manajemen Pesanan (Backend)**
- ✅ List semua pesanan
- ✅ Filter by status
- ✅ Detail pesanan
- ✅ Update status pesanan:
  - Pending
  - Diproses
  - Dikirim
  - Selesai
  - Dibatalkan
- ✅ Update status pembayaran
- ✅ Input resi pengiriman
- ✅ Cetak invoice

### **6. Laporan & Statistik**
- ✅ Total produk
- ✅ Total pesanan
- ✅ Total pendapatan
- ✅ Pesanan baru
- ✅ Produk terlaris
- ✅ Stok menipis

---

## Instalasi

### **Langkah 1: Import Database**

```bash
mysql -u username -p database_name < db/produk_umkm_tables.sql
```

**Atau via phpMyAdmin:**
1. Buka phpMyAdmin
2. Pilih database
3. Import file `db/produk_umkm_tables.sql`

**Tabel yang dibuat:**
- `custome__kategori_produk`
- `custome__produk_umkm`
- `custome__keranjang`
- `custome__pesanan`
- `custome__pesanan_detail`

### **Langkah 2: Buat Folder Upload**

```bash
# Buat folder untuk gambar produk
mkdir -p public/img/produk
chmod 755 public/img/produk

# Buat folder untuk bukti transfer
mkdir -p public/img/bukti_transfer
chmod 755 public/img/bukti_transfer
```

### **Langkah 3: Verifikasi File**

Pastikan file berikut sudah ada:

**Models (5 file):**
- ✅ `app/Models/M_ProdukUmkm.php`
- ✅ `app/Models/M_KategoriProduk.php`
- ✅ `app/Models/M_Keranjang.php`
- ✅ `app/Models/M_Pesanan.php`
- ✅ `app/Models/M_PesananDetail.php`

**Controllers (1 file - untuk saat ini):**
- ✅ `app/Controllers/ProdukUmkm.php`

**Configuration:**
- ✅ `app/Controllers/BaseController.php` (updated)
- ✅ `app/Config/Routes.php` (updated)

### **Langkah 4: Tambahkan Menu di Admin**

1. Login ke admin
2. Menu **Pengaturan** → **Modul**
3. Tambahkan modul baru:

**Modul 1: Produk UMKM**
- Nama: `Produk UMKM`
- URL: `produk-umkm/list`
- Icon: `fas fa-shopping-bag`

**Modul 2: Kategori Produk**
- Nama: `Kategori Produk`
- URL: `kategori-produk/list`
- Icon: `fas fa-tags`

**Modul 3: Pesanan**
- Nama: `Pesanan`
- URL: `pesanan/list`
- Icon: `fas fa-shopping-cart`

---

## Struktur Database

### **1. Tabel: custome__kategori_produk**

| Field | Type | Description |
|-------|------|-------------|
| kategori_id | INT(11) | Primary Key |
| nama_kategori | VARCHAR(100) | Nama kategori |
| slug_kategori | VARCHAR(150) | URL-friendly slug |
| deskripsi | TEXT | Deskripsi kategori |
| gambar | VARCHAR(255) | Gambar kategori |
| urutan | INT(11) | Urutan tampilan |
| status | ENUM('0','1') | 0=Nonaktif, 1=Aktif |

### **2. Tabel: custome__produk_umkm**

| Field | Type | Description |
|-------|------|-------------|
| id_produk | INT(11) | Primary Key |
| nama_produk | VARCHAR(255) | Nama produk |
| slug_produk | VARCHAR(300) | URL-friendly slug |
| kategori_id | INT(11) | Foreign Key |
| deskripsi | TEXT | Deskripsi produk |
| harga | DECIMAL(15,2) | Harga normal |
| harga_promo | DECIMAL(15,2) | Harga promo (opsional) |
| stok | INT(11) | Jumlah stok |
| berat | INT(11) | Berat (gram) |
| satuan | VARCHAR(50) | Satuan (pcs, box, dll) |
| gambar | VARCHAR(255) | Gambar utama |
| galeri | TEXT | JSON array gambar |
| status | ENUM('0','1') | 0=Nonaktif, 1=Aktif |
| featured | ENUM('0','1') | 0=Tidak, 1=Ya |
| hits | INT(11) | Jumlah views |
| tgl_input | DATETIME | Tanggal input |
| user_id | INT(11) | ID user input |

### **3. Tabel: custome__keranjang**

| Field | Type | Description |
|-------|------|-------------|
| id_keranjang | INT(11) | Primary Key |
| session_id | VARCHAR(100) | Session ID |
| user_id | INT(11) | ID user (jika login) |
| id_produk | INT(11) | Foreign Key |
| jumlah | INT(11) | Quantity |
| harga | DECIMAL(15,2) | Harga satuan |
| subtotal | DECIMAL(15,2) | Total harga |
| tgl_input | DATETIME | Tanggal input |

### **4. Tabel: custome__pesanan**

| Field | Type | Description |
|-------|------|-------------|
| id_pesanan | INT(11) | Primary Key |
| no_pesanan | VARCHAR(50) | Nomor pesanan unik |
| user_id | INT(11) | ID user (opsional) |
| nama_pemesan | VARCHAR(255) | Nama pemesan |
| email | VARCHAR(100) | Email |
| no_hp | VARCHAR(20) | No HP |
| alamat | TEXT | Alamat lengkap |
| provinsi | VARCHAR(100) | Provinsi |
| kota | VARCHAR(100) | Kota/Kabupaten |
| kecamatan | VARCHAR(100) | Kecamatan |
| kode_pos | VARCHAR(10) | Kode pos |
| total_harga | DECIMAL(15,2) | Total harga produk |
| ongkir | DECIMAL(15,2) | Ongkos kirim |
| grand_total | DECIMAL(15,2) | Total keseluruhan |
| metode_pembayaran | ENUM | transfer/cod/ewallet |
| status_pembayaran | ENUM | unpaid/paid/failed |
| status_pesanan | ENUM | pending/diproses/dikirim/selesai/dibatalkan |
| bukti_transfer | VARCHAR(255) | File bukti transfer |
| catatan | TEXT | Catatan pesanan |
| tgl_pesan | DATETIME | Tanggal pesan |
| tgl_bayar | DATETIME | Tanggal bayar |
| tgl_kirim | DATETIME | Tanggal kirim |
| tgl_selesai | DATETIME | Tanggal selesai |
| resi_pengiriman | VARCHAR(100) | Nomor resi |
| kurir | VARCHAR(50) | Nama kurir |

### **5. Tabel: custome__pesanan_detail**

| Field | Type | Description |
|-------|------|-------------|
| id_detail | INT(11) | Primary Key |
| id_pesanan | INT(11) | Foreign Key |
| id_produk | INT(11) | Foreign Key |
| nama_produk | VARCHAR(255) | Nama produk (snapshot) |
| harga | DECIMAL(15,2) | Harga (snapshot) |
| jumlah | INT(11) | Quantity |
| subtotal | DECIMAL(15,2) | Total harga |

---

## Cara Penggunaan

### **A. Admin - Manajemen Produk**

#### **1. Tambah Produk Baru**
1. Login ke admin
2. Menu **Produk UMKM**
3. Klik **Tambah Produk**
4. Isi form:
   - Nama Produk *
   - Kategori *
   - Deskripsi
   - Harga *
   - Harga Promo (opsional)
   - Stok *
   - Berat (gram)
   - Satuan
   - Upload Gambar *
   - Status (Aktif/Nonaktif)
   - Featured (Ya/Tidak)
5. Klik **Simpan**

#### **2. Edit Produk**
1. Klik tombol **Edit** pada produk
2. Ubah data yang diperlukan
3. Klik **Simpan Perubahan**

#### **3. Ganti Gambar**
1. Klik tombol **Ganti Gambar**
2. Pilih gambar baru
3. Upload (gambar lama otomatis terhapus)

#### **4. Hapus Produk**
1. Klik tombol **Hapus**
2. Konfirmasi penghapusan
3. Produk dan gambar akan terhapus

### **B. Admin - Manajemen Kategori**

#### **1. Tambah Kategori**
1. Menu **Kategori Produk**
2. Klik **Tambah Kategori**
3. Isi:
   - Nama Kategori
   - Deskripsi
   - Urutan
   - Status
4. Simpan

#### **2. Kelola Kategori**
- Edit kategori
- Hapus kategori (jika tidak ada produk)
- Ubah urutan tampilan

### **C. Admin - Manajemen Pesanan**

#### **1. Lihat Pesanan Baru**
1. Menu **Pesanan**
2. Filter: **Pending**
3. Lihat detail pesanan

#### **2. Proses Pesanan**
1. Klik **Detail** pada pesanan
2. Verifikasi pembayaran
3. Update status:
   - **Diproses**: Pesanan sedang disiapkan
   - **Dikirim**: Pesanan sudah dikirim
   - **Selesai**: Pesanan selesai
   - **Dibatalkan**: Pesanan dibatalkan

#### **3. Input Resi Pengiriman**
1. Buka detail pesanan
2. Input nomor resi
3. Pilih kurir
4. Simpan

### **D. Customer - Belanja Online**

#### **1. Browse Produk**
- Lihat semua produk
- Filter by kategori
- Search produk
- Lihat detail produk

#### **2. Add to Cart**
1. Klik **Tambah ke Keranjang**
2. Pilih jumlah
3. Produk masuk keranjang

#### **3. Checkout**
1. Klik icon keranjang
2. Review pesanan
3. Klik **Checkout**
4. Isi data pemesan:
   - Nama lengkap
   - Email
   - No HP
   - Alamat lengkap
5. Pilih metode pembayaran
6. Klik **Pesan Sekarang**

#### **4. Upload Bukti Transfer**
1. Lakukan pembayaran
2. Upload bukti transfer
3. Tunggu konfirmasi admin

---

## API Endpoints

### **Produk UMKM**

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/produk-umkm/list` | Halaman list produk | Admin |
| GET | `/produk-umkm/getdata` | Get data AJAX | Admin |
| GET | `/produk-umkm/formtambah` | Form tambah produk | Admin |
| POST | `/produk-umkm/simpan` | Simpan produk baru | Admin |
| POST | `/produk-umkm/formedit` | Form edit produk | Admin |
| POST | `/produk-umkm/update` | Update produk | Admin |
| POST | `/produk-umkm/hapus` | Hapus produk | Admin |
| POST | `/produk-umkm/gantigambar` | Ganti gambar | Admin |
| POST | `/produk-umkm/toggle` | Toggle status | Admin |

### **Kategori Produk**

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/kategori-produk/list` | List kategori | Admin |
| GET | `/kategori-produk/getdata` | Get data AJAX | Admin |
| POST | `/kategori-produk/simpan` | Simpan kategori | Admin |
| POST | `/kategori-produk/update` | Update kategori | Admin |
| POST | `/kategori-produk/hapus` | Hapus kategori | Admin |

### **Pesanan**

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| GET | `/pesanan/list` | List pesanan | Admin |
| GET | `/pesanan/getdata` | Get data AJAX | Admin |
| POST | `/pesanan/detail` | Detail pesanan | Admin |
| POST | `/pesanan/updatestatus` | Update status | Admin |
| POST | `/pesanan/hapus` | Hapus pesanan | Admin |

---

## Pengembangan

### **Fitur yang Bisa Ditambahkan:**

1. **Integrasi Payment Gateway**
   - Midtrans
   - Xendit
   - DOKU

2. **Integrasi Ongkir**
   - RajaOngkir API
   - JNE, TIKI, POS

3. **Wishlist**
   - Simpan produk favorit

4. **Review & Rating**
   - Customer review
   - Star rating

5. **Diskon & Voucher**
   - Kode promo
   - Diskon otomatis

6. **Notifikasi**
   - Email notification
   - WhatsApp notification

7. **Laporan**
   - Laporan penjualan
   - Export Excel/PDF

8. **Multi-vendor**
   - Setiap jemaat punya toko sendiri

---

## Keamanan

- ✅ CSRF Protection
- ✅ XSS Protection
- ✅ SQL Injection Prevention
- ✅ File upload validation
- ✅ Image resize otomatis
- ✅ Access control per user group

---

## Support

Untuk bantuan lebih lanjut:
- Website: https://ikasmedia.net
- WhatsApp: 081 353 967 028

---

**Dibuat:** 7 Oktober 2025  
**Versi:** 1.0.0  
**Framework:** CodeIgniter 4
