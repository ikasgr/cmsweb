<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= esc($pesanan['kode_pesanan']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }

        .header {
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .company-info h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .company-info p {
            margin: 3px 0;
            color: #666;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-info h2 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .invoice-number {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .status-pending { background: #ffc107; color: #000; }
        .status-diproses { background: #17a2b8; color: #fff; }
        .status-dikirim { background: #007bff; color: #fff; }
        .status-selesai { background: #28a745; color: #fff; }
        .status-dibatalkan { background: #dc3545; color: #fff; }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
        }

        .info-box {
            width: 48%;
        }

        .info-box h3 {
            color: #007bff;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        .info-box table {
            width: 100%;
        }

        .info-box td {
            padding: 5px 0;
            vertical-align: top;
        }

        .info-box td:first-child {
            font-weight: bold;
            width: 120px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .products-table th {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        .products-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .products-table tr:hover {
            background: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-section {
            margin-top: 20px;
            float: right;
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .total-row.grand-total {
            background: #28a745;
            color: white;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            margin-top: 10px;
        }

        .footer {
            clear: both;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
        }

        .print-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 30px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin: 20px 0;
        }

        .print-button:hover {
            background: #0056b3;
        }

        @media print {
            .print-button {
                display: none;
            }
            
            body {
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Print Button -->
        <div class="text-center">
            <button class="print-button" onclick="window.print()">
                <i class="fas fa-print"></i> Print Invoice
            </button>
        </div>

        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="company-info">
                    <h1><?= esc($konfigurasi->nama) ?></h1>
                    <p><?= esc($konfigurasi->alamat) ?></p>
                    <p>Telp: <?= esc($konfigurasi->no_telp) ?></p>
                    <?php if ($konfigurasi->email) : ?>
                        <p>Email: <?= esc($konfigurasi->email) ?></p>
                    <?php endif; ?>
                </div>
                <div class="invoice-info">
                    <h2>INVOICE</h2>
                    <div class="invoice-number">#<?= esc($pesanan['kode_pesanan']) ?></div>
                    <p>Tanggal: <?= date('d/m/Y H:i', strtotime($pesanan['tgl_pesanan'])) ?></p>
                    <?php
                    $status_class = [
                        'Pending' => 'pending',
                        'Diproses' => 'diproses',
                        'Dikirim' => 'dikirim',
                        'Selesai' => 'selesai',
                        'Dibatalkan' => 'dibatalkan'
                    ];
                    $class = $status_class[$pesanan['status_pesanan']] ?? 'pending';
                    ?>
                    <span class="status-badge status-<?= $class ?>"><?= esc($pesanan['status_pesanan']) ?></span>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-box">
                <h3>Data Pembeli</h3>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= esc($pesanan['nama_pembeli']) ?></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>: <?= esc($pesanan['no_hp']) ?></td>
                    </tr>
                    <?php if ($pesanan['email']) : ?>
                        <tr>
                            <td>Email</td>
                            <td>: <?= esc($pesanan['email']) ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= esc($pesanan['alamat']) ?></td>
                    </tr>
                </table>
            </div>

            <div class="info-box">
                <h3>Informasi Pesanan</h3>
                <table>
                    <tr>
                        <td>Total Item</td>
                        <td>: <?= $pesanan['total_item'] ?> item</td>
                    </tr>
                    <tr>
                        <td>Total Quantity</td>
                        <td>: <?= $pesanan['total_qty'] ?> pcs</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>: <?= esc($pesanan['status_pesanan']) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Products Table -->
        <table class="products-table">
            <thead>
                <tr>
                    <th width="50" class="text-center">No</th>
                    <th>Nama Produk</th>
                    <th width="120" class="text-right">Harga</th>
                    <th width="80" class="text-center">Jumlah</th>
                    <th width="120" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($detail as $item) : 
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= esc($item['nama_produk']) ?></td>
                        <td class="text-right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= $item['jumlah'] ?></td>
                        <td class="text-right">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <span>Subtotal:</span>
                <strong>Rp <?= number_format($pesanan['subtotal'], 0, ',', '.') ?></strong>
            </div>
            <div class="total-row">
                <span>Ongkir:</span>
                <strong>Rp <?= number_format($pesanan['ongkir'], 0, ',', '.') ?></strong>
            </div>
            <div class="total-row grand-total">
                <span>TOTAL BAYAR:</span>
                <strong>Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></strong>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih atas pesanan Anda!</strong></p>
            <p>Invoice ini digenerate otomatis oleh sistem.</p>
            <p>Untuk informasi lebih lanjut, hubungi kami di <?= esc($konfigurasi->no_telp) ?></p>
        </div>
    </div>

    <script>
        // Auto print on load (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
