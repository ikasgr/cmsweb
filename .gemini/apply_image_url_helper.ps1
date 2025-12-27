#!/usr/bin/env pwsh
# Script untuk menerapkan image_url() helper ke semua view files

Write-Host "Menerapkan image_url() helper ke view files..." -ForegroundColor Green

# Daftar pattern yang akan diganti
$replacements = @(
    @{
        Pattern = "base_url\('/public/img/informasi/berita/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/berita/' . esc(`$1))"
        Description = "Berita images"
    },
    @{
        Pattern = "base_url\('public/img/informasi/berita/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/berita/' . esc(`$1))"
        Description = "Berita images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/informasi/pegawai/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/pegawai/' . esc(`$1))"
        Description = "Pegawai images"
    },
    @{
        Pattern = "base_url\('public/img/informasi/pegawai/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/pegawai/' . esc(`$1))"
        Description = "Pegawai images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/galeri/foto/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('galeri/foto/' . esc(`$1))"
        Description = "Foto gallery images"
    },
    @{
        Pattern = "base_url\('public/img/galeri/foto/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('galeri/foto/' . esc(`$1))"
        Description = "Foto gallery images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/user/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('user/' . esc(`$1))"
        Description = "User images"
    },
    @{
        Pattern = "base_url\('public/img/user/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('user/' . esc(`$1))"
        Description = "User images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/banner/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('banner/' . esc(`$1))"
        Description = "Banner images"
    },
    @{
        Pattern = "base_url\('public/img/banner/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('banner/' . esc(`$1))"
        Description = "Banner images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/informasi/agenda/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/agenda/' . esc(`$1))"
        Description = "Agenda images"
    },
    @{
        Pattern = "base_url\('public/img/informasi/agenda/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/agenda/' . esc(`$1))"
        Description = "Agenda images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/informasi/layanan/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/layanan/' . esc(`$1))"
        Description = "Layanan images"
    },
    @{
        Pattern = "base_url\('public/img/informasi/layanan/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('informasi/layanan/' . esc(`$1))"
        Description = "Layanan images (without leading slash)"
    },
    @{
        Pattern = "base_url\('/public/img/ebook/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('ebook/' . esc(`$1))"
        Description = "Ebook images"
    },
    @{
        Pattern = "base_url\('public/img/ebook/' \. esc\(\`$([^)]+)\)\)"
        Replacement = "image_url('ebook/' . esc(`$1))"
        Description = "Ebook images (without leading slash)"
    }
)

$viewsPath = "d:\wwwroot\server.id\web\app\Views"
$totalFiles = 0
$totalReplacements = 0

Write-Host "`nCatatan: Script ini hanya menampilkan preview." -ForegroundColor Yellow
Write-Host "Untuk implementasi sebenarnya, gunakan tool replace_file_content secara manual.`n" -ForegroundColor Yellow

# Scan semua file PHP di Views
Get-ChildItem -Path $viewsPath -Filter "*.php" -Recurse | ForEach-Object {
    $file = $_
    $content = Get-Content $file.FullName -Raw
    $modified = $false
    $fileReplacements = 0
    
    foreach ($replacement in $replacements) {
        if ($content -match $replacement.Pattern) {
            $fileReplacements++
            $modified = $true
        }
    }
    
    if ($modified) {
        $totalFiles++
        $totalReplacements += $fileReplacements
        Write-Host "✓ $($file.FullName.Replace($viewsPath, '.'))" -ForegroundColor Cyan
        Write-Host "  Found $fileReplacements pattern(s) to replace" -ForegroundColor Gray
    }
}

Write-Host "`n========================================" -ForegroundColor Green
Write-Host "Summary:" -ForegroundColor Green
Write-Host "  Files to modify: $totalFiles" -ForegroundColor White
Write-Host "  Total patterns found: $totalReplacements" -ForegroundColor White
Write-Host "========================================`n" -ForegroundColor Green

Write-Host "Untuk menerapkan perubahan, gunakan Antigravity untuk:" -ForegroundColor Yellow
Write-Host "1. Replace pattern di setiap file yang ditemukan" -ForegroundColor Gray
Write-Host "2. Atau minta Antigravity untuk melakukan bulk replacement`n" -ForegroundColor Gray
