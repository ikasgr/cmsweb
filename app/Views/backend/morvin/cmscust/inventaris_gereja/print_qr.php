<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Print QR Code
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Aset - <?= esc($aset->kode_aset) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .qr-container {
            border: 2px solid #333;
            padding: 20px;
            margin: 20px auto;
            max-width: 300px;
            background: white;
        }
        .qr-code {
            margin: 20px 0;
        }
        .qr-code img {
            width: 150px;
            height: 150px;
            border: 1px solid #ddd;
        }
        .asset-info {
            margin-top: 20px;
        }
        .asset-info h2 {
            margin: 5px 0;
            font-size: 16px;
        }
        .asset-info p {
            margin: 3px 0;
            font-size: 12px;
            color: #666;
        }
        .instructions {
            margin-top: 30px;
            font-size: 10px;
            color: #888;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none; }
            .qr-container {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h1>QR Code Aset Gereja</h1>

        <div class="qr-code">
            <!-- QR Code akan digenerate oleh library QR Code -->
            <div style="width: 150px; height: 150px; background: #f8f9fa; border: 2px dashed #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                <div class="text-center">
                    <i class="fe-qr-code fa-3x text-muted"></i>
                    <small class="d-block text-muted mt-2">QR Code</small>
                </div>
            </div>
        </div>

        <div class="asset-info">
            <h2><?= esc($aset->nama_aset) ?></h2>
            <p><strong>Kode:</strong> <?= esc($aset->kode_aset) ?></p>
            <p><strong>Kategori:</strong> <?= esc($aset->nama_kategori) ?></p>
            <p><strong>Lokasi:</strong> <?= esc($aset->nama_lokasi) ?></p>
            <?php if ($aset->merk): ?>
                <p><strong>Merk:</strong> <?= esc($aset->merk) ?></p>
            <?php endif; ?>
            <?php if ($aset->model): ?>
                <p><strong>Model:</strong> <?= esc($aset->model) ?></p>
            <?php endif; ?>
        </div>

        <div style="margin-top: 20px; font-size: 10px; color: #666;">
            <p>Scan QR Code untuk melihat detail aset</p>
            <p>Dicetak: <?= date('d M Y H:i') ?></p>
        </div>
    </div>

    <div class="instructions">
        <strong>Cara Penggunaan:</strong><br>
        1. Tempelkan QR Code ini pada aset fisik<br>
        2. Scan dengan kamera smartphone untuk tracking<br>
        3. Gunakan untuk maintenance dan inventory check<br>
        4. QR Code unik untuk setiap aset
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            window.print();
        };

        // Generate QR Code using JavaScript (simple implementation)
        function generateQRCode(text) {
            // This is a simple placeholder - in production, use a proper QR library
            const canvas = document.createElement('canvas');
            canvas.width = 150;
            canvas.height = 150;

            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#f8f9fa';
            ctx.fillRect(0, 0, 150, 150);
            ctx.strokeStyle = '#333';
            ctx.strokeRect(0, 0, 150, 150);

            // Simple pattern for demo
            ctx.fillStyle = '#333';
            for (let i = 0; i < 7; i++) {
                for (let j = 0; j < 7; j++) {
                    if ((i + j) % 2 === 0) {
                        ctx.fillRect(i * 20 + 5, j * 20 + 5, 15, 15);
                    }
                }
            }

            return canvas.toDataURL();
        }

        // Replace placeholder with generated QR
        document.addEventListener('DOMContentLoaded', function() {
            const qrPlaceholder = document.querySelector('.qr-code div');
            if (qrPlaceholder && <?= json_encode($aset->qr_code ?? '') ?>) {
                qrPlaceholder.innerHTML = `
                    <img src="${generateQRCode('<?= $aset->kode_aset ?>')}" alt="QR Code">
                `;
            }
        });
    </script>
</body>
</html>
