<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Index Layout
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */

$title = $title ?? 'Inventaris Gereja';
$subtitle = $subtitle ?? 'Manajemen Aset & Inventaris';
?>

<?= $this->extend('backend/' . esc($folder) . '/script') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">
                        <i class="fas fa-boxes mr-2 text-primary"></i><?= esc($title) ?>
                    </h4>
                    <p class="text-muted mb-0">
                        <?= esc($subtitle) ?> -
                        <span class="text-primary">Sistem Manajemen Aset Gereja Modern</span>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-cog mr-1"></i>Aksi Cepat
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="tambah()">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah Aset Baru
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="dashboard()">
                                    <i class="fas fa-chart-bar mr-2"></i>Dashboard Analytics
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="openQRScanner()">
                                    <i class="fas fa-qrcode mr-2"></i>Scan QR Code
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="refreshData()">
                                    <i class="fas fa-sync-alt mr-2"></i>Refresh Data
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="exportExcel()">
                                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="printReport()">
                                    <i class="fas fa-print mr-2"></i>Cetak Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats Overview -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card-box widget-box-two widget-two-primary">
            <i class="mdi mdi-clipboard-text widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-500 font-14 text-muted">Total Aset</p>
                <h2 class="font-weight-bold" id="total-aset">
                    <i class="mdi mdi-loading mdi-spin"></i>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box widget-box-two widget-two-success">
            <i class="mdi mdi-check-circle widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-500 font-14 text-muted">Aset Aktif</p>
                <h2 class="font-weight-bold" id="aset-aktif">
                    <i class="mdi mdi-loading mdi-spin"></i>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box widget-box-two widget-two-warning">
            <i class="mdi mdi-wrench widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-500 font-14 text-muted">Maintenance</p>
                <h2 class="font-weight-bold" id="aset-maintenance">
                    <i class="mdi mdi-loading mdi-spin"></i>
                </h2>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card-box widget-box-two widget-two-danger">
            <i class="mdi mdi-alert-circle widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-500 font-14 text-muted">Perlu Perhatian</p>
                <h2 class="font-weight-bold" id="aset-perlu-perhatian">
                    <i class="mdi mdi-loading mdi-spin"></i>
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Alerts -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title mb-0">Aset Terbaru</h4>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="loadRecentAssets()">
                            <i class="mdi mdi-refresh mr-1"></i>Refresh
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="recent-assets">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Memuat data aset terbaru...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    <i class="mdi mdi-bell-ring mr-2"></i>Alert & Notification
                </h4>
            </div>
            <div class="card-body">
                <div id="alerts-notifications">
                    <div class="text-center py-4">
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 mb-0">Memuat alert...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#list-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-list"></i></span>
                            <span class="d-none d-sm-block">
                                <i class="fas fa-list mr-1"></i>Daftar Aset
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#analytics-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-chart-bar"></i></span>
                            <span class="d-none d-sm-block">
                                <i class="fas fa-chart-bar mr-1"></i>Analytics
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#maintenance-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-wrench"></i></span>
                            <span class="d-none d-sm-block">
                                <i class="fas fa-wrench mr-1"></i>Maintenance
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">
                                <i class="fas fa-cog mr-1"></i>Pengaturan
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- List Tab -->
                    <div class="tab-pane show active" id="list-tab" role="tabpanel">
                        <div id="asset-list-container">
                            <div class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2 mb-0">Memuat daftar aset...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Tab -->
                    <div class="tab-pane" id="analytics-tab" role="tabpanel">
                        <div id="analytics-container">
                            <div class="text-center py-4">
                                <div class="spinner-border text-info" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2 mb-0">Memuat analytics...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance Tab -->
                    <div class="tab-pane" id="maintenance-tab" role="tabpanel">
                        <div id="maintenance-container">
                            <div class="text-center py-4">
                                <div class="spinner-border text-warning" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2 mb-0">Memuat data maintenance...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div class="tab-pane" id="settings-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Pengaturan Umum</h5>
                                <div class="form-group">
                                    <label>Auto-generate Kode Aset</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="auto-generate-kode" checked>
                                        <label class="custom-control-label" for="auto-generate-kode">Aktif</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Auto-generate QR Code</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="auto-generate-qr" checked>
                                        <label class="custom-control-label" for="auto-generate-qr">Aktif</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alert Maintenance (hari sebelum)</label>
                                    <input type="number" class="form-control" id="maintenance-alert-days" value="30" min="1" max="90">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Pengaturan Lanjutan</h5>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="backupData()">
                                    <i class="fas fa-download mr-1"></i>Backup Data
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="syncData()">
                                    <i class="fas fa-sync mr-1"></i>Sync Data
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="resetSettings()">
                                    <i class="fas fa-undo mr-1"></i>Reset Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Scanner Modal -->
<div class="modal fade" id="qrScannerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan QR Code Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div id="qr-reader" style="width: 100%; height: 300px;"></div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary" onclick="startQRScanner()">Start Camera</button>
                        <button type="button" class="btn btn-danger" onclick="stopQRScanner()">Stop Camera</button>
                    </div>
                </div>
                <div id="qr-result" class="mt-3" style="display: none;">
                    <div class="alert alert-success">
                        <strong>Aset Ditemukan:</strong><br>
                        <span id="qr-aset-info"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables
let qrScanner = null;
let isScanning = false;

// Initialize page
$(document).ready(function() {
    loadStatistics();
    loadRecentAssets();
    loadAlerts();
    loadAssetList();

    // Tab change handlers
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        const target = $(e.target).attr('href');
        if (target === '#analytics-tab') {
            loadAnalytics();
        } else if (target === '#maintenance-tab') {
            loadMaintenanceData();
        }
    });
});

// Load statistics
function loadStatistics() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/dashboard') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                const stats = $(response.data).find('.card-body').data();
                if (stats) {
                    $('#total-aset').text(stats.total_aset || 0);
                    $('#aset-aktif').text(stats.aset_aktif || 0);
                    $('#aset-maintenance').text(stats.aset_maintenance || 0);
                    $('#aset-perlu-perhatian').text((stats.aset_rusak || 0) + (stats.overdue || 0));
                }
            }
        },
        error: function() {
            $('#total-aset, #aset-aktif, #aset-maintenance, #aset-perlu-perhatian').text('Error');
        }
    });
}

// Load recent assets
function loadRecentAssets() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/getdata') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                const recentAssets = $(response.data).find('tbody tr').slice(0, 5);
                let html = '<div class="list-group list-group-flush">';

                if (recentAssets.length > 0) {
                    recentAssets.each(function() {
                        const cols = $(this).find('td');
                        const kodeAset = $(cols[1]).text().trim();
                        const namaAset = $(cols[2]).find('strong').text().trim();
                        const kategori = $(cols[3]).text().trim();

                        html += `
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${namaAset}</strong><br>
                                    <small class="text-muted">${kodeAset} • ${kategori}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" onclick="lihatAset('${kodeAset}')">
                                    <i class="fe-eye"></i>
                                </button>
                            </div>
                        `;
                    });
                } else {
                    html += '<div class="text-center py-3"><p class="text-muted mb-0">Belum ada aset</p></div>';
                }

                html += '</div>';
                $('#recent-assets').html(html);
            }
        }
    });
}

// Load alerts and notifications
function loadAlerts() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/dashboard') ?>',
        type: 'GET',
        success: function(response) {
            let html = '';

            if (response.data) {
                // Parse alerts from dashboard data
                const dashboardContent = $(response.data);
                const maintenanceAlerts = dashboardContent.find('.card-body').filter(':contains("Perlu Maintenance")').find('tr').length - 1;
                const warrantyAlerts = dashboardContent.find('.card-body').filter(':contains("Garansi")').find('tr').length - 1;

                if (maintenanceAlerts > 0) {
                    html += `
                        <div class="alert-item d-flex align-items-start mb-2">
                            <i class="mdi mdi-wrench text-warning mr-2 mt-1"></i>
                            <div>
                                <strong>${maintenanceAlerts} aset perlu maintenance</strong><br>
                                <small class="text-muted">Periksa jadwal maintenance</small>
                            </div>
                        </div>
                    `;
                }

                if (warrantyAlerts > 0) {
                    html += `
                        <div class="alert-item d-flex align-items-start mb-2">
                            <i class="mdi mdi-shield-alert text-danger mr-2 mt-1"></i>
                            <div>
                                <strong>${warrantyAlerts} garansi akan habis</strong><br>
                                <small class="text-muted">Periksa masa garansi</small>
                            </div>
                        </div>
                    `;
                }
            }

            if (html === '') {
                html = '<div class="text-center py-3"><p class="text-muted mb-0">Tidak ada alert</p></div>';
            }

            $('#alerts-notifications').html(html);
        }
    });
}

// Load asset list
function loadAssetList() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/getdata') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                $('#asset-list-container').html(response.data);
            } else if (response.noakses) {
                $('#asset-list-container').html('<div class="alert alert-danger">Anda tidak memiliki akses untuk melihat data ini</div>');
            } else {
                $('#asset-list-container').html('<div class="alert alert-warning">Tidak ada data untuk ditampilkan</div>');
            }
        },
        error: function() {
            $('#asset-list-container').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

// Load analytics tab
function loadAnalytics() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/dashboard') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                $('#analytics-container').html(response.data);
            }
        }
    });
}

// Load maintenance tab
function loadMaintenanceData() {
    $.ajax({
        url: '<?= site_url('maintenance-aset/list') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                $('#maintenance-container').html(response.data);
            } else {
                $('#maintenance-container').html('<div class="alert alert-info">Fitur maintenance sedang dalam pengembangan</div>');
            }
        }
    });
}

// Quick actions
function tambah() {
    $.ajax({
        url: '<?= site_url('inventaris-gereja/formtambah') ?>',
        type: 'GET',
        success: function(response) {
            if (response.data) {
                $('.modal-title').html('Tambah Aset Baru');
                $('.modal-body').html(response.data);
                $('.modal-footer').html(`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpanAset()">Simpan</button>
                `);
                $('#modal').modal('show');
            }
        }
    });
}

function dashboard() {
    loadAnalytics();
    $('a[href="#analytics-tab"]').tab('show');
}

function openQRScanner() {
    $('#qrScannerModal').modal('show');
    if (!isScanning) {
        startQRScanner();
    }
}

function refreshData() {
    loadStatistics();
    loadRecentAssets();
    loadAlerts();
    loadAssetList();
    toastr.info('Data berhasil di-refresh');
}

// QR Scanner functions
function startQRScanner() {
    if (typeof Html5QrcodeScanner !== 'undefined') {
        qrScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        });

        qrScanner.render(onScanSuccess, onScanError);
        isScanning = true;
    } else {
        $('#qr-result').html('<div class="alert alert-warning">QR Scanner tidak tersedia di browser ini</div>').show();
    }
}

function stopQRScanner() {
    if (qrScanner) {
        qrScanner.clear();
        isScanning = false;
    }
    $('#qr-result').hide();
}

function onScanSuccess(decodedText) {
    // Search aset by QR Code
    $.ajax({
        url: '<?= site_url('inventaris-gereja/getbyqrcode') ?>',
        type: 'POST',
        data: { qr_code: decodedText },
        success: function(response) {
            if (response.sukses) {
                $('#qr-aset-info').html(`
                    <strong>${response.sukses.nama_aset}</strong><br>
                    Kode: ${response.sukses.kode_aset}<br>
                    Kategori: ${response.sukses.nama_kategori}<br>
                    Lokasi: ${response.sukses.nama_lokasi}
                `);
                $('#qr-result').show();
                stopQRScanner();
            } else {
                $('#qr-aset-info').html('Aset tidak ditemukan');
                $('#qr-result').show();
            }
        }
    });
}

function onScanError(errorMessage) {
    console.log(errorMessage);
}

// Utility functions
function lihatAset(kodeAset) {
    // Find aset by kode and show detail
    $.ajax({
        url: '<?= site_url('inventaris-gereja/search') ?>',
        type: 'POST',
        data: { keyword: kodeAset },
        success: function(response) {
            if (response.data) {
                $('#asset-list-container').html(response.data);
                $('a[href="#list-tab"]').tab('show');
            }
        }
    });
}

function exportExcel() {
    window.open('<?= site_url('inventaris-gereja/export') ?>', '_blank');
}

function printReport() {
    window.open('<?= site_url('inventaris-gereja/print') ?>', '_blank');
}

function backupData() {
    toastr.info('Fitur backup sedang dalam pengembangan');
}

function syncData() {
    toastr.info('Fitur sync sedang dalam pengembangan');
}

function resetSettings() {
    Swal.fire({
        title: 'Reset Pengaturan?',
        text: 'Semua pengaturan akan dikembalikan ke default',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            toastr.success('Pengaturan berhasil direset');
        }
    });
}

// Auto refresh every 5 minutes
setInterval(function() {
    loadStatistics();
}, 300000);
</script>

<?= $this->endSection() ?>
