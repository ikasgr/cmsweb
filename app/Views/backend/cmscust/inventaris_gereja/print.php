<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Print Report
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */

$statistik = $statistik ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-item {
            display: table-cell;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background: #f9f9f9;
        }
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 10px;
            border-radius: 3px;
            color: white;
            font-weight: bold;
        }
        .badge-success { background-color: #28a745; }
        .badge-warning { background-color: #ffc107; color: #212529; }
        .badge-danger { background-color: #dc3545; }
        .badge-info { background-color: #17a2b8; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><?= esc($title) ?></h1>
        <h2><?= esc($subtitle) ?></h2>
    </div>

    <!-- Statistics -->
    <div class="stats">
        <div class="stat-item">
            <div class="stat-value"><?= number_format($statistik['total_aset'] ?? 0) ?></div>
            <div>Total Aset</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">Rp <?= number_format($statistik['total_nilai_perolehan'] ?? 0, 0, ',', '.') ?></div>
            <div>Nilai Perolehan</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">Rp <?= number_format($statistik['total_nilai_buku'] ?? 0, 0, ',', '.') ?></div>
            <div>Nilai Buku</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">Rp <?= number_format($statistik['total_akumulasi_depreciation'] ?? 0, 0, ',', '.') ?></div>
            <div>Depreciation</div>
        </div>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="12%">Kode Aset</th>
                <th width="20%">Nama Aset</th>
                <th width="15%">Kategori</th>
                <th width="15%">Lokasi</th>
                <th width="10%">Status</th>
                <th width="10%">Kondisi</th>
                <th width="10%">Nilai Buku</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $index => $row): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= esc($row->kode_aset) ?></td>
                        <td><?= esc($row->nama_aset) ?></td>
                        <td><?= esc($row->nama_kategori) ?></td>
                        <td><?= esc($row->nama_lokasi) ?></td>
                        <td class="text-center">
                            <?php
                            $status_class = '';
                            switch ($row->status) {
                                case 'Aktif': $status_class = 'badge-success'; break;
                                case 'Maintenance': $status_class = 'badge-warning'; break;
                                case 'Rusak': $status_class = 'badge-danger'; break;
                                case 'Dijual': $status_class = 'badge-info'; break;
                                default: $status_class = 'badge-secondary';
                            }
                            ?>
                            <span class="badge <?= $status_class ?>"><?= esc($row->status) ?></span>
                        </td>
                        <td class="text-center">
                            <?php
                            $kondisi_class = '';
                            switch ($row->kondisi) {
                                case 'Baik': $kondisi_class = 'badge-success'; break;
                                case 'Rusak Ringan': $kondisi_class = 'badge-warning'; break;
                                case 'Rusak Berat': $kondisi_class = 'badge-danger'; break;
                                case 'Tidak Berfungsi': $kondisi_class = 'badge-dark'; break;
                                default: $kondisi_class = 'badge-secondary';
                            }
                            ?>
                            <span class="badge <?= $kondisi_class ?>"><?= esc($row->kondisi) ?></span>
                        </td>
                        <td class="text-right">Rp <?= number_format($row->nilai_buku, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center py-4">
                        Tidak ada data untuk ditampilkan
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak melalui Sistem Manajemen Gereja - <?= date('d F Y H:i:s') ?></p>
        <p>Jumlah total aset: <?= number_format($statistik['total_aset'] ?? 0) ?> |
           Total nilai: Rp <?= number_format($statistik['total_nilai_buku'] ?? 0, 0, ',', '.') ?></p>
    </div>
</body>
</html>
