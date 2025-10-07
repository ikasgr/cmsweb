-- ========================================
-- SQL untuk Tema NeoGoe
-- ========================================

-- Cek apakah tema neogoe sudah ada
SELECT * FROM template WHERE folder = 'neogoe' AND jtema = 1;

-- Jika belum ada, jalankan INSERT:
INSERT INTO `template` (
    `nama`, 
    `pembuat`, 
    `folder`, 
    `status`, 
    `id`, 
    `ket`, 
    `img`, 
    `jtema`, 
    `hplogo`, 
    `wllogo`, 
    `hpbanner`, 
    `wlbanner`, 
    `verbost`, 
    `duatema`, 
    `warna_topbar`, 
    `sidebar_mode`, 
    `video_bag`
) VALUES (
    'NeoGoe',                           -- nama tema
    'Datagoe',                          -- pembuat
    'neogoe',                           -- folder (PENTING!)
    0,                                  -- status (0=inactive, 1=active)
    1,                                  -- id
    'Tema Modern NeoGoe untuk Website Pemerintahan, Instansi, Company Profile', -- keterangan
    'neogoe.jpg',                       -- screenshot
    1,                                  -- jtema (1=frontend, 0=backend)
    60,                                 -- hplogo (tinggi logo dalam px)
    200,                                -- wllogo (lebar logo dalam px)
    600,                                -- hpbanner (tinggi banner dalam px)
    1800,                               -- wlbanner (lebar banner dalam px)
    '1',                                -- verbost
    0,                                  -- duatema
    '#2c3e50',                          -- warna_topbar
    0,                                  -- sidebar_mode
    NULL                                -- video_bag
);

-- Jika sudah ada, jalankan UPDATE:
UPDATE `template` 
SET 
    `nama` = 'NeoGoe',
    `pembuat` = 'Datagoe',
    `ket` = 'Tema Modern NeoGoe untuk Website Pemerintahan, Instansi, Company Profile',
    `img` = 'neogoe.jpg',
    `hplogo` = 60,
    `wllogo` = 200,
    `hpbanner` = 600,
    `wlbanner` = 1800,
    `verbost` = '1',
    `warna_topbar` = '#2c3e50'
WHERE `folder` = 'neogoe' AND `jtema` = 1;

-- ========================================
-- Cara Aktifkan Tema NeoGoe
-- ========================================

-- 1. Reset semua tema frontend ke inactive
UPDATE `template` SET `status` = 0 WHERE `jtema` = 1;

-- 2. Aktifkan tema NeoGoe
UPDATE `template` SET `status` = 1 WHERE `folder` = 'neogoe' AND `jtema` = 1;

-- ========================================
-- Cek Status Tema
-- ========================================

-- Lihat semua tema frontend
SELECT 
    template_id,
    nama,
    folder,
    status,
    pembuat,
    ket
FROM template 
WHERE jtema = 1 
ORDER BY status DESC, template_id ASC;

-- Lihat tema yang aktif
SELECT * FROM template WHERE status = 1 AND jtema = 1;
