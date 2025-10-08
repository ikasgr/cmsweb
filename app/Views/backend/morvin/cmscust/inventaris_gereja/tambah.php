<?php
/**
 * =====================================================
 * View: Inventaris Gereja - Form Tambah Aset
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */
?>

<form id="form-aset">
    <div class="row">
        <div class="col-md-8">
            <!-- Informasi Dasar -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-info-circle mr-2"></i>Informasi Dasar Aset
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_aset">Kode Aset <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kode_aset" name="kode_aset"
                                       value="<?= esc($kode_aset_baru ?? '') ?>" readonly>
                                <small class="form-text text-muted">Kode aset akan dibuat otomatis</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_aset">Nama Aset <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_aset" name="nama_aset"
                                       placeholder="Masukkan nama aset" required>
                                <div class="invalid-feedback" id="nama_aset-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kategori">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="id_kategori" name="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php if (!empty($kategori_list)): ?>
                                        <?php foreach ($kategori_list as $kategori): ?>
                                            <option value="<?= $kategori->id_kategori ?>">
                                                <?= esc($kategori->nama_kategori) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="id_kategori-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_lokasi">Lokasi <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="id_lokasi" name="id_lokasi" required>
                                    <option value="">Pilih Lokasi</option>
                                    <?php if (!empty($lokasi_list)): ?>
                                        <?php foreach ($lokasi_list as $lokasi): ?>
                                            <option value="<?= $lokasi->id_lokasi ?>">
                                                <?= esc($lokasi->nama_lokasi) ?> (<?= esc($lokasi->jenis_lokasi) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback" id="id_lokasi-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" id="merk" name="merk"
                                       placeholder="Masukkan merk aset">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" class="form-control" id="model" name="model"
                                       placeholder="Masukkan model aset">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="serial_number">Serial Number</label>
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                       placeholder="Masukkan nomor seri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_pembuatan">Tahun Pembuatan</label>
                                <select class="form-control" id="tahun_pembuatan" name="tahun_pembuatan">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    $current_year = date('Y');
                                    for ($year = $current_year; $year >= $current_year - 50; $year--):
                                    ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Finansial -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-dollar-sign mr-2"></i>Informasi Finansial
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_pembelian">Tanggal Pembelian <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required>
                                <div class="invalid-feedback" id="tanggal_pembelian-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga_perolehan">Harga Perolehan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="harga_perolehan" name="harga_perolehan"
                                           placeholder="0" min="0" step="1000" required>
                                </div>
                                <div class="invalid-feedback" id="harga_perolehan-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai_residu">Nilai Residu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="nilai_residu" name="nilai_residu"
                                           placeholder="0" min="0" step="1000">
                                </div>
                                <small class="form-text text-muted">Nilai aset di akhir masa pakai</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="masa_pakai">Masa Pakai (Tahun)</label>
                                <input type="number" class="form-control" id="masa_pakai" name="masa_pakai"
                                       placeholder="5" min="1" max="50">
                                <small class="form-text text-muted">Otomatis dari kategori jika kosong</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="metode_depreciation">Metode Depreciation</label>
                                <select class="form-control" id="metode_depreciation" name="metode_depreciation">
                                    <option value="">Otomatis dari Kategori</option>
                                    <option value="Straight Line">Straight Line</option>
                                    <option value="Declining Balance">Declining Balance</option>
                                    <option value="Sum of Years">Sum of Years</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier">Supplier/Vendor</label>
                                <select class="form-control select2" id="supplier" name="supplier">
                                    <option value="">Pilih Supplier</option>
                                    <?php if (!empty($vendor_list)): ?>
                                        <?php foreach ($vendor_list as $vendor): ?>
                                            <option value="<?= esc($vendor->nama_vendor) ?>">
                                                <?= esc($vendor->nama_vendor) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_faktur">No. Faktur/Invoice</label>
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                       placeholder="INV-001">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kondisi">Kondisi Aset</label>
                                <select class="form-control" id="kondisi" name="kondisi">
                                    <option value="Baik" selected>Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                    <option value="Tidak Berfungsi">Tidak Berfungsi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-file-text mr-2"></i>Informasi Tambahan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty_start">Mulai Garansi</label>
                                <input type="date" class="form-control" id="warranty_start" name="warranty_start">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty_end">Akhir Garansi</label>
                                <input type="date" class="form-control" id="warranty_end" name="warranty_end">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_company">Perusahaan Asuransi</label>
                                <input type="text" class="form-control" id="insurance_company" name="insurance_company"
                                       placeholder="Nama perusahaan asuransi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insurance_policy">No. Polis Asuransi</label>
                                <input type="text" class="form-control" id="insurance_policy" name="insurance_policy"
                                       placeholder="Nomor polis asuransi">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="insurance_value">Nilai Pertanggungan Asuransi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="insurance_value" name="insurance_value"
                                   placeholder="0" min="0" step="1000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="spesifikasi">Spesifikasi Teknis</label>
                        <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                  placeholder="Spesifikasi teknis, fitur, kapasitas, dll"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                  placeholder="Keterangan tambahan tentang aset"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- QR Code Preview -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-qr-code mr-2"></i>QR Code
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div id="qr-code-preview" style="min-height: 150px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 8px;">
                        <div class="text-muted">
                            <i class="fe-qr-code fa-3x mb-2"></i>
                            <p>QR Code akan dibuat otomatis</p>
                        </div>
                    </div>
                    <small class="form-text text-muted">QR Code akan di-generate setelah aset disimpan</small>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-camera mr-2"></i>Foto Aset
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="foto_aset">Upload Foto</label>
                        <input type="file" class="form-control-file" id="foto_aset" name="foto_aset[]" multiple accept="image/*">
                        <small class="form-text text-muted">Maksimal 5 foto, ukuran maksimal 2MB per foto</small>
                    </div>
                    <div id="foto-preview" class="mt-2"></div>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fe-help-circle mr-2"></i>Petunjuk
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fe-check-circle text-success mr-2"></i>
                            Field dengan tanda <span class="text-danger">*</span> wajib diisi
                        </li>
                        <li class="mb-2">
                            <i class="fe-check-circle text-success mr-2"></i>
                            Kode aset akan dibuat otomatis
                        </li>
                        <li class="mb-2">
                            <i class="fe-check-circle text-success mr-2"></i>
                            QR Code akan di-generate setelah simpan
                        </li>
                        <li class="mb-2">
                            <i class="fe-check-circle text-success mr-2"></i>
                            Masa pakai default dari kategori
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
// Initialize Select2
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Auto-fill masa pakai dan metode depreciation berdasarkan kategori
    $('#id_kategori').change(function() {
        const kategoriId = $(this).val();
        if (kategoriId) {
            // Get kategori details via AJAX
            $.ajax({
                url: '<?= site_url('kategori-aset/get') ?>/' + kategoriId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#masa_pakai').val(response.masa_pakai);
                        $('#metode_depreciation').val(response.metode_depreciation);
                    }
                }
            });
        }
    });

    // Foto preview
    $('#foto_aset').change(function() {
        previewFotos(this);
    });
});

// Preview foto yang diupload
function previewFotos(input) {
    $('#foto-preview').empty();

    if (input.files) {
        const maxFiles = 5;
        const filesArray = Array.from(input.files);

        if (filesArray.length > maxFiles) {
            toastr.warning('Maksimal 5 foto dapat diupload');
            input.value = '';
            return;
        }

        filesArray.forEach(function(file, index) {
            if (file.size > 2 * 1024 * 1024) { // 2MB
                toastr.warning('Foto ' + file.name + ' terlalu besar (maksimal 2MB)');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#foto-preview').append(`
                    <div class="foto-item mb-2">
                        <img src="${e.target.result}" class="img-thumbnail" style="width: 100%; height: 100px; object-fit: cover;">
                        <small class="d-block text-center mt-1">${file.name}</small>
                    </div>
                `);
            };
            reader.readAsDataURL(file);
        });
    }
}

// Generate QR Code preview (simulasi)
function generateQRPreview() {
    const kodeAset = $('#kode_aset').val();
    if (kodeAset) {
        $('#qr-code-preview').html(`
            <div class="text-center">
                <div style="width: 120px; height: 120px; background: #f8f9fa; border: 2px solid #dee2e6; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <div class="text-center">
                        <i class="fe-qr-code fa-2x text-muted"></i>
                        <small class="d-block text-muted mt-1">${kodeAset}</small>
                    </div>
                </div>
            </div>
        `);
    }
}

// Update QR preview ketika kode aset berubah
$('#kode_aset').change(function() {
    generateQRPreview();
});

// Initialize QR preview
$(document).ready(function() {
    generateQRPreview();
});
</script>
