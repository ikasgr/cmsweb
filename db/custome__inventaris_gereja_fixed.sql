-- =====================================================
-- Database Schema: Modul Inventaris Gereja (FIXED)
-- Church Management System - Fase 2
-- Created: 8 Oktober 2025
-- FIXED: Removed foreign key constraints to users table
-- =====================================================

-- 1. Tabel Master Kategori Aset
CREATE TABLE `custome__kategori_aset` (
    `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
    `kode_kategori` varchar(10) NOT NULL,
    `nama_kategori` varchar(100) NOT NULL,
    `parent_id` int(11) DEFAULT NULL,
    `deskripsi` text,
    `icon` varchar(50) DEFAULT 'fas fa-box',
    `warna` varchar(7) DEFAULT '#007bff',
    `masa_pakai` int(11) DEFAULT 5 COMMENT 'Dalam tahun',
    `metode_depreciation` enum('Straight Line','Declining Balance','Sum of Years') DEFAULT 'Straight Line',
    `status` enum('Aktif','Non-Aktif') DEFAULT 'Aktif',
    `urutan` int(11) DEFAULT 0,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_kategori`),
    UNIQUE KEY `kode_kategori` (`kode_kategori`),
    KEY `parent_id` (`parent_id`),
    FOREIGN KEY (`parent_id`) REFERENCES `custome__kategori_aset` (`id_kategori`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Master Lokasi Aset
CREATE TABLE `custome__lokasi_aset` (
    `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
    `kode_lokasi` varchar(10) NOT NULL,
    `nama_lokasi` varchar(100) NOT NULL,
    `jenis_lokasi` enum('Ruangan','Gedung','Area','Lantai') DEFAULT 'Ruangan',
    `parent_id` int(11) DEFAULT NULL,
    `deskripsi` text,
    `kapasitas` int(11) DEFAULT NULL,
    `penanggung_jawab` varchar(100) DEFAULT NULL,
    `status` enum('Aktif','Non-Aktif','Renovasi') DEFAULT 'Aktif',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_lokasi`),
    UNIQUE KEY `kode_lokasi` (`kode_lokasi`),
    KEY `parent_id` (`parent_id`),
    FOREIGN KEY (`parent_id`) REFERENCES `custome__lokasi_aset` (`id_lokasi`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Master Vendor/Supplier
CREATE TABLE `custome__vendor_maintenance` (
    `id_vendor` int(11) NOT NULL AUTO_INCREMENT,
    `kode_vendor` varchar(15) NOT NULL,
    `nama_vendor` varchar(150) NOT NULL,
    `jenis_vendor` enum('Supplier','Maintenance','Repair','Insurance') DEFAULT 'Supplier',
    `alamat` text,
    `telepon` varchar(20),
    `email` varchar(100),
    `contact_person` varchar(100),
    `spesialisasi` text COMMENT 'Bidang keahlian vendor',
    `rating` decimal(2,1) DEFAULT 0.0,
    `status` enum('Aktif','Non-Aktif','Blacklist') DEFAULT 'Aktif',
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_vendor`),
    UNIQUE KEY `kode_vendor` (`kode_vendor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Utama Aset Gereja
CREATE TABLE `custome__aset_gereja` (
    `id_aset` int(11) NOT NULL AUTO_INCREMENT,
    `kode_aset` varchar(20) NOT NULL,
    `nama_aset` varchar(200) NOT NULL,
    `id_kategori` int(11) NOT NULL,
    `id_lokasi` int(11) NOT NULL,
    `merk` varchar(100) DEFAULT NULL,
    `model` varchar(100) DEFAULT NULL,
    `serial_number` varchar(100) DEFAULT NULL,
    `tahun_pembuatan` year DEFAULT NULL,
    `tanggal_pembelian` date NOT NULL,
    `harga_perolehan` decimal(15,2) NOT NULL DEFAULT 0.00,
    `nilai_residu` decimal(15,2) DEFAULT 0.00,
    `masa_pakai` int(11) DEFAULT 5 COMMENT 'Dalam tahun',
    `metode_depreciation` enum('Straight Line','Declining Balance','Sum of Years') DEFAULT 'Straight Line',
    `nilai_buku` decimal(15,2) DEFAULT 0.00,
    `akumulasi_depreciation` decimal(15,2) DEFAULT 0.00,
    `supplier` varchar(150) DEFAULT NULL,
    `no_faktur` varchar(50) DEFAULT NULL,
    `warranty_start` date DEFAULT NULL,
    `warranty_end` date DEFAULT NULL,
    `insurance_company` varchar(100) DEFAULT NULL,
    `insurance_policy` varchar(50) DEFAULT NULL,
    `insurance_value` decimal(15,2) DEFAULT 0.00,
    `kondisi` enum('Baik','Rusak Ringan','Rusak Berat','Tidak Berfungsi') DEFAULT 'Baik',
    `status` enum('Aktif','Maintenance','Rusak','Dijual','Hilang','Dihapuskan') DEFAULT 'Aktif',
    `qr_code` varchar(100) DEFAULT NULL,
    `barcode` varchar(100) DEFAULT NULL,
    `foto_aset` text COMMENT 'JSON array foto',
    `spesifikasi` text,
    `keterangan` text,
    `created_by` int(11) DEFAULT NULL,
    `updated_by` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_aset`),
    UNIQUE KEY `kode_aset` (`kode_aset`),
    UNIQUE KEY `qr_code` (`qr_code`),
    KEY `id_kategori` (`id_kategori`),
    KEY `id_lokasi` (`id_lokasi`),
    KEY `created_by` (`created_by`),
    FOREIGN KEY (`id_kategori`) REFERENCES `custome__kategori_aset` (`id_kategori`),
    FOREIGN KEY (`id_lokasi`) REFERENCES `custome__lokasi_aset` (`id_lokasi`)
    -- Note: Removed foreign key to users table as it may not exist in all installations
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Jadwal & Riwayat Maintenance
CREATE TABLE `custome__maintenance_aset` (
    `id_maintenance` int(11) NOT NULL AUTO_INCREMENT,
    `kode_maintenance` varchar(20) NOT NULL,
    `id_aset` int(11) NOT NULL,
    `jenis_maintenance` enum('Preventif','Korektif','Prediktif','Emergency') DEFAULT 'Preventif',
    `tanggal_jadwal` date NOT NULL,
    `tanggal_selesai` date DEFAULT NULL,
    `deskripsi` text NOT NULL,
    `id_vendor` int(11) DEFAULT NULL,
    `teknisi` varchar(100) DEFAULT NULL,
    `biaya_estimasi` decimal(12,2) DEFAULT 0.00,
    `biaya_aktual` decimal(12,2) DEFAULT 0.00,
    `status` enum('Dijadwalkan','Sedang Proses','Selesai','Ditunda','Dibatalkan') DEFAULT 'Dijadwalkan',
    `hasil_maintenance` text,
    `rekomendasi` text,
    `foto_sebelum` text COMMENT 'JSON array foto',
    `foto_sesudah` text COMMENT 'JSON array foto',
    `next_maintenance` date DEFAULT NULL,
    `created_by` int(11) DEFAULT NULL,
    `updated_by` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_maintenance`),
    UNIQUE KEY `kode_maintenance` (`kode_maintenance`),
    KEY `id_aset` (`id_aset`),
    KEY `id_vendor` (`id_vendor`),
    KEY `created_by` (`created_by`),
    FOREIGN KEY (`id_aset`) REFERENCES `custome__aset_gereja` (`id_aset`) ON DELETE CASCADE,
    FOREIGN KEY (`id_vendor`) REFERENCES `custome__vendor_maintenance` (`id_vendor`) ON DELETE SET NULL
    -- Note: Removed foreign key to users table as it may not exist in all installations
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabel Riwayat Perbaikan
CREATE TABLE `custome__perbaikan_aset` (
    `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT,
    `kode_perbaikan` varchar(20) NOT NULL,
    `id_aset` int(11) NOT NULL,
    `tanggal_laporan` date NOT NULL,
    `tanggal_perbaikan` date DEFAULT NULL,
    `jenis_kerusakan` varchar(200) NOT NULL,
    `deskripsi_kerusakan` text NOT NULL,
    `penyebab_kerusakan` text,
    `tindakan_perbaikan` text,
    `spare_part` text COMMENT 'JSON array spare part',
    `id_vendor` int(11) DEFAULT NULL,
    `teknisi` varchar(100) DEFAULT NULL,
    `biaya_perbaikan` decimal(12,2) DEFAULT 0.00,
    `biaya_spare_part` decimal(12,2) DEFAULT 0.00,
    `total_biaya` decimal(12,2) DEFAULT 0.00,
    `status` enum('Dilaporkan','Sedang Diperbaiki','Selesai','Tidak Dapat Diperbaiki') DEFAULT 'Dilaporkan',
    `kondisi_setelah` enum('Baik','Rusak Ringan','Rusak Berat','Tidak Berfungsi') DEFAULT 'Baik',
    `garansi_perbaikan` int(11) DEFAULT 0 COMMENT 'Dalam hari',
    `foto_kerusakan` text COMMENT 'JSON array foto',
    `foto_perbaikan` text COMMENT 'JSON array foto',
    `keterangan` text,
    `created_by` int(11) DEFAULT NULL,
    `updated_by` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_perbaikan`),
    UNIQUE KEY `kode_perbaikan` (`kode_perbaikan`),
    KEY `id_aset` (`id_aset`),
    KEY `id_vendor` (`id_vendor`),
    KEY `created_by` (`created_by`),
    FOREIGN KEY (`id_aset`) REFERENCES `custome__aset_gereja` (`id_aset`) ON DELETE CASCADE,
    FOREIGN KEY (`id_vendor`) REFERENCES `custome__vendor_maintenance` (`id_vendor`) ON DELETE SET NULL
    -- Note: Removed foreign key to users table as it may not exist in all installations
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Tabel Transfer/Perpindahan Aset
CREATE TABLE `custome__transfer_aset` (
    `id_transfer` int(11) NOT NULL AUTO_INCREMENT,
    `kode_transfer` varchar(20) NOT NULL,
    `id_aset` int(11) NOT NULL,
    `lokasi_asal` int(11) NOT NULL,
    `lokasi_tujuan` int(11) NOT NULL,
    `tanggal_transfer` date NOT NULL,
    `alasan_transfer` text NOT NULL,
    `kondisi_saat_transfer` enum('Baik','Rusak Ringan','Rusak Berat','Tidak Berfungsi') DEFAULT 'Baik',
    `penanggung_jawab_asal` varchar(100) DEFAULT NULL,
    `penanggung_jawab_tujuan` varchar(100) DEFAULT NULL,
    `keterangan` text,
    `status` enum('Diajukan','Disetujui','Selesai','Ditolak') DEFAULT 'Diajukan',
    `approved_by` int(11) DEFAULT NULL,
    `approved_at` timestamp NULL DEFAULT NULL,
    `created_by` int(11) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_transfer`),
    UNIQUE KEY `kode_transfer` (`kode_transfer`),
    KEY `id_aset` (`id_aset`),
    KEY `lokasi_asal` (`lokasi_asal`),
    KEY `lokasi_tujuan` (`lokasi_tujuan`),
    KEY `approved_by` (`approved_by`),
    KEY `created_by` (`created_by`),
    FOREIGN KEY (`id_aset`) REFERENCES `custome__aset_gereja` (`id_aset`) ON DELETE CASCADE,
    FOREIGN KEY (`lokasi_asal`) REFERENCES `custome__lokasi_aset` (`id_lokasi`),
    FOREIGN KEY (`lokasi_tujuan`) REFERENCES `custome__lokasi_aset` (`id_lokasi`)
    -- Note: Removed foreign key to users table as it may not exist in all installations
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Tabel Calculation Depreciation
CREATE TABLE `custome__depreciation_aset` (
    `id_depreciation` int(11) NOT NULL AUTO_INCREMENT,
    `id_aset` int(11) NOT NULL,
    `tahun` year NOT NULL,
    `bulan` tinyint(2) NOT NULL,
    `nilai_awal` decimal(15,2) NOT NULL,
    `depreciation_bulanan` decimal(15,2) NOT NULL,
    `akumulasi_depreciation` decimal(15,2) NOT NULL,
    `nilai_buku` decimal(15,2) NOT NULL,
    `metode` enum('Straight Line','Declining Balance','Sum of Years') DEFAULT 'Straight Line',
    `keterangan` text,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_depreciation`),
    UNIQUE KEY `unique_aset_periode` (`id_aset`, `tahun`, `bulan`),
    KEY `id_aset` (`id_aset`),
    FOREIGN KEY (`id_aset`) REFERENCES `custome__aset_gereja` (`id_aset`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- SAMPLE DATA
-- =====================================================

-- Sample Kategori Aset
INSERT INTO `custome__kategori_aset` (`kode_kategori`, `nama_kategori`, `parent_id`, `deskripsi`, `icon`, `warna`, `masa_pakai`, `metode_depreciation`, `status`, `urutan`) VALUES
('FURN', 'Furniture & Perabotan', NULL, 'Meja, kursi, lemari, dan perabotan lainnya', 'fas fa-chair', '#8B4513', 10, 'Straight Line', 'Aktif', 1),
('ELEC', 'Elektronik', NULL, 'Komputer, TV, sound system, dan peralatan elektronik', 'fas fa-tv', '#1E90FF', 5, 'Straight Line', 'Aktif', 2),
('VEHI', 'Kendaraan', NULL, 'Mobil, motor, dan kendaraan operasional', 'fas fa-car', '#FF6347', 8, 'Declining Balance', 'Aktif', 3),
('BUIL', 'Bangunan & Infrastruktur', NULL, 'Gedung, renovasi, dan infrastruktur', 'fas fa-building', '#32CD32', 20, 'Straight Line', 'Aktif', 4),
('COMP', 'Komputer & IT', 2, 'Laptop, PC, printer, dan peralatan IT', 'fas fa-laptop', '#4169E1', 4, 'Straight Line', 'Aktif', 5),
('SOUN', 'Sound System', 2, 'Mixer, speaker, microphone, dan peralatan audio', 'fas fa-microphone', '#FF1493', 7, 'Straight Line', 'Aktif', 6);

-- Sample Lokasi Aset
INSERT INTO `custome__lokasi_aset` (`kode_lokasi`, `nama_lokasi`, `jenis_lokasi`, `parent_id`, `deskripsi`, `kapasitas`, `penanggung_jawab`, `status`) VALUES
('GU01', 'Gedung Utama', 'Gedung', NULL, 'Gedung utama gereja untuk ibadah', NULL, 'Pak Pendeta', 'Aktif'),
('RU01', 'Ruang Ibadah Utama', 'Ruangan', 1, 'Ruang ibadah utama dengan kapasitas 500 orang', 500, 'Tim Liturgi', 'Aktif'),
('RU02', 'Ruang Kelas Sekolah Minggu', 'Ruangan', 1, 'Ruang untuk kegiatan sekolah minggu anak-anak', 50, 'Guru SM', 'Aktif'),
('RU03', 'Ruang Kantor', 'Ruangan', 1, 'Ruang kantor administrasi gereja', 10, 'Sekretaris', 'Aktif'),
('RU04', 'Ruang Konsistori', 'Ruangan', 1, 'Ruang rapat majelis dan konsistori', 20, 'Ketua Majelis', 'Aktif'),
('GU02', 'Gedung Serbaguna', 'Gedung', NULL, 'Gedung untuk acara besar dan kegiatan komunitas', NULL, 'Koordinator Acara', 'Aktif'),
('RU05', 'Dapur', 'Ruangan', 6, 'Dapur untuk persiapan makanan acara', 15, 'Tim Konsumsi', 'Aktif'),
('AR01', 'Halaman Parkir', 'Area', NULL, 'Area parkir kendaraan jemaat', 100, 'Satpam', 'Aktif');

-- Sample Vendor
INSERT INTO `custome__vendor_maintenance` (`kode_vendor`, `nama_vendor`, `jenis_vendor`, `alamat`, `telepon`, `email`, `contact_person`, `spesialisasi`, `rating`, `status`) VALUES
('VEN001', 'CV Mitra Elektronik', 'Supplier', 'Jl. Elektronik No. 123, Jakarta', '021-1234567', 'info@mitraelektronik.com', 'Budi Santoso', 'Peralatan elektronik, sound system, komputer', 4.5, 'Aktif'),
('VEN002', 'Bengkel Jaya Motor', 'Maintenance', 'Jl. Raya Motor No. 456, Jakarta', '021-7654321', 'jayamotor@gmail.com', 'Ahmad Wijaya', 'Service kendaraan bermotor', 4.2, 'Aktif'),
('VEN003', 'Furniture Indah', 'Supplier', 'Jl. Furniture No. 789, Jakarta', '021-9876543', 'furniture.indah@yahoo.com', 'Siti Nurhaliza', 'Furniture kantor dan rumah tangga', 4.0, 'Aktif'),
('VEN004', 'IT Solution Pro', 'Maintenance', 'Jl. IT Center No. 321, Jakarta', '021-5555666', 'support@itsolutionpro.com', 'Dedi Kurniawan', 'Maintenance komputer, jaringan, software', 4.7, 'Aktif'),
('VEN005', 'Asuransi Berkah', 'Insurance', 'Jl. Asuransi No. 654, Jakarta', '021-7777888', 'info@asuransiberkah.co.id', 'Maya Sari', 'Asuransi kendaraan dan properti', 4.3, 'Aktif');

-- Sample Aset Gereja (Fixed: Removed created_by reference)
INSERT INTO `custome__aset_gereja` (`kode_aset`, `nama_aset`, `id_kategori`, `id_lokasi`, `merk`, `model`, `serial_number`, `tahun_pembuatan`, `tanggal_pembelian`, `harga_perolehan`, `nilai_residu`, `masa_pakai`, `supplier`, `no_faktur`, `warranty_start`, `warranty_end`, `kondisi`, `status`, `spesifikasi`, `keterangan`) VALUES
('AST001', 'Kursi Jemaat Kayu Jati', 1, 2, 'Furniture Indah', 'FI-KJ-001', 'FI001-100', 2024, '2024-01-15', 15000000.00, 1500000.00, 10, 'Furniture Indah', 'INV-2024-001', '2024-01-15', '2025-01-15', 'Baik', 'Aktif', '100 unit kursi kayu jati dengan bantalan', 'Kursi untuk jemaat di ruang ibadah utama'),
('AST002', 'Sound System Yamaha', 6, 2, 'Yamaha', 'MG16XU', 'YMH-2024-001', 2024, '2024-02-10', 25000000.00, 2500000.00, 7, 'CV Mitra Elektronik', 'INV-2024-002', '2024-02-10', '2026-02-10', 'Baik', 'Aktif', 'Mixer 16 channel dengan USB interface', 'Sound system utama untuk ibadah'),
('AST003', 'Laptop Dell Inspiron', 5, 4, 'Dell', 'Inspiron 15 3000', 'DL123456789', 2024, '2024-03-05', 8500000.00, 850000.00, 4, 'CV Mitra Elektronik', 'INV-2024-003', '2024-03-05', '2025-03-05', 'Baik', 'Aktif', 'Intel i5, 8GB RAM, 512GB SSD', 'Laptop untuk administrasi kantor'),
('AST004', 'Meja Kantor Minimalis', 1, 4, 'Furniture Indah', 'FI-MK-002', 'FI002-005', 2024, '2024-01-20', 3500000.00, 350000.00, 10, 'Furniture Indah', 'INV-2024-004', '2024-01-20', '2025-01-20', 'Baik', 'Aktif', '5 unit meja kantor dengan laci', 'Meja untuk staff administrasi'),
('AST005', 'Proyektor Epson', 2, 2, 'Epson', 'EB-X41', 'EPS-2024-001', 2024, '2024-04-12', 6500000.00, 650000.00, 5, 'CV Mitra Elektronik', 'INV-2024-005', '2024-04-12', '2025-04-12', 'Baik', 'Aktif', '3600 lumens, XGA resolution', 'Proyektor untuk presentasi ibadah');
