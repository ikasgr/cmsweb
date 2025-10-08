# 📱 Implementasi Views - Modul Pendaftaran Redesign

## 🎯 Overview

Dokumentasi lengkap untuk membuat views backend modul pendaftaran dengan fitur document management.

---

## 📁 File Structure Views

```
app/Views/backend/morvin/cmscust/pendaftaran_sidi/
├── index.php (existing - update)
├── list.php (existing - update)
├── lihat.php (existing - update dengan tabs)
├── dokumen.php (NEW - document management)
├── timeline.php (NEW - timeline view)
└── catatan.php (NEW - notes management)
```

---

## 🔧 1. Update List View

**File:** `app/Views/backend/morvin/cmscust/pendaftaran_sidi/list.php`

**Tambahan Kolom di DataTables:**

```javascript
// Tambah kolom kelengkapan dokumen
{
    data: 'kelengkapan_dokumen',
    className: 'text-center',
    render: function(data) {
        let color = 'danger';
        if (data >= 80) color = 'success';
        else if (data >= 50) color = 'warning';
        
        return `
            <div class="progress" style="height: 20px;">
                <div class="progress-bar bg-${color}" role="progressbar" 
                     style="width: ${data}%" aria-valuenow="${data}">
                    ${data}%
                </div>
            </div>
        `;
    }
}
```

---

## 🔧 2. Update Detail View dengan Tabs

**File:** `app/Views/backend/morvin/cmscust/pendaftaran_sidi/lihat.php`

**Struktur Tab:**

```html
<!-- Nav Tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#data-pribadi">
            <i class="fas fa-user"></i> Data Pribadi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#dokumen" 
           onclick="loadDokumen(<?= $data['id'] ?>)">
            <i class="fas fa-file-alt"></i> Dokumen
            <span class="badge bg-warning" id="badge-dokumen">0</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#timeline"
           onclick="loadTimeline(<?= $data['id'] ?>)">
            <i class="fas fa-history"></i> Timeline
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#catatan"
           onclick="loadCatatan(<?= $data['id'] ?>)">
            <i class="fas fa-sticky-note"></i> Catatan
        </a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content mt-3">
    <!-- Tab Data Pribadi -->
    <div id="data-pribadi" class="tab-pane active">
        <!-- Existing content -->
    </div>
    
    <!-- Tab Dokumen -->
    <div id="dokumen" class="tab-pane">
        <div class="viewdokumen"></div>
    </div>
    
    <!-- Tab Timeline -->
    <div id="timeline" class="tab-pane">
        <div class="viewtimeline"></div>
    </div>
    
    <!-- Tab Catatan -->
    <div id="catatan" class="tab-pane">
        <div class="viewcatatan"></div>
    </div>
</div>
```

**JavaScript untuk Load Tabs:**

```javascript
function loadDokumen(id) {
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/getdokumen') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewdokumen').html(response.sukses);
            }
        }
    });
}

function loadTimeline(id) {
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/gettimeline') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewtimeline').html(response.sukses);
            }
        }
    });
}

function loadCatatan(id) {
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/getcatatan') ?>',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                $('.viewcatatan').html(response.sukses);
            }
        }
    });
}
```

---

## 🔧 3. View Dokumen (NEW)

**File:** `app/Views/backend/morvin/cmscust/pendaftaran_sidi/dokumen.php`

**Struktur:**

```html
<!-- Upload Section -->
<div class="card mb-3">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-upload"></i> Upload Dokumen</h5>
    </div>
    <div class="card-body">
        <form id="formUploadDokumen" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Jenis Dokumen <span class="text-danger">*</span></label>
                        <select name="jenis_dokumen" class="form-select" required>
                            <option value="">-- Pilih Jenis Dokumen --</option>
                            <?php foreach ($master as $m) : ?>
                                <option value="<?= esc($m['nama_dokumen']) ?>">
                                    <?= esc($m['nama_dokumen']) ?>
                                    <?= $m['wajib'] ? '(Wajib)' : '(Opsional)' ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>File Dokumen <span class="text-danger">*</span></label>
                        <input type="file" name="file_dokumen" class="form-control" 
                               accept=".jpg,.jpeg,.png,.pdf" required>
                        <small class="text-muted">Format: JPG, PNG, PDF. Max: 5MB</small>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload
            </button>
        </form>
    </div>
</div>

<!-- List Dokumen -->
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Dokumen</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Jenis Dokumen</th>
                        <th>File</th>
                        <th width="100">Status</th>
                        <th>Keterangan</th>
                        <th>Upload By</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($dokumen) : ?>
                        <?php $no = 1; foreach ($dokumen as $dok) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($dok['jenis_dokumen']) ?></td>
                                <td>
                                    <a href="<?= base_url($dok['file_path']) ?>" target="_blank">
                                        <?= esc($dok['nama_file']) ?>
                                    </a>
                                    <br><small><?= number_format($dok['file_size']/1024, 2) ?> KB</small>
                                </td>
                                <td>
                                    <?php
                                    $badge = [
                                        'pending' => 'warning',
                                        'valid' => 'success',
                                        'invalid' => 'danger',
                                        'revisi' => 'info'
                                    ];
                                    ?>
                                    <span class="badge bg-<?= $badge[$dok['status_dokumen']] ?>">
                                        <?= ucfirst($dok['status_dokumen']) ?>
                                    </span>
                                </td>
                                <td><?= esc($dok['keterangan']) ?></td>
                                <td><?= esc($dok['uploaded_by_name']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-success" 
                                            onclick="verifyDokumen(<?= $dok['dokumen_id'] ?>, 'valid')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                            onclick="verifyDokumen(<?= $dok['dokumen_id'] ?>, 'invalid')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                            onclick="hapusDokumen(<?= $dok['dokumen_id'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada dokumen</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Upload dokumen
$('#formUploadDokumen').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/uploaddokumen') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                Swal.fire('Berhasil!', response.sukses, 'success');
                loadDokumen(<?= $id ?>);
            } else if (response.error) {
                Swal.fire('Gagal!', response.error, 'error');
            }
        }
    });
});

// Verify dokumen
function verifyDokumen(dokumen_id, status) {
    Swal.fire({
        title: 'Keterangan',
        input: 'textarea',
        inputPlaceholder: 'Masukkan keterangan...',
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('pendaftaran-sidi/verifydokumen') ?>',
                type: 'POST',
                data: {
                    dokumen_id: dokumen_id,
                    status: status,
                    keterangan: result.value
                },
                dataType: 'json',
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire('Berhasil!', response.sukses, 'success');
                        loadDokumen(<?= $id ?>);
                    }
                }
            });
        }
    });
}

// Hapus dokumen
function hapusDokumen(dokumen_id) {
    Swal.fire({
        title: 'Hapus Dokumen?',
        text: 'File akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('pendaftaran-sidi/hapusdokumen') ?>',
                type: 'POST',
                data: { dokumen_id: dokumen_id },
                dataType: 'json',
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire('Berhasil!', response.sukses, 'success');
                        loadDokumen(<?= $id ?>);
                    }
                }
            });
        }
    });
}
</script>
```

---

## 🔧 4. View Timeline (NEW)

**File:** `app/Views/backend/morvin/cmscust/pendaftaran_sidi/timeline.php`

```html
<div class="card">
    <div class="card-body">
        <div class="timeline">
            <?php if ($timeline) : ?>
                <?php foreach ($timeline as $t) : ?>
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">
                                    <span class="badge bg-primary"><?= esc($t['status']) ?></span>
                                </h6>
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($t['tgl_update'])) ?>
                                </small>
                            </div>
                            <?php if ($t['keterangan']) : ?>
                                <p class="mb-1"><?= esc($t['keterangan']) ?></p>
                            <?php endif; ?>
                            <?php if ($t['fullname']) : ?>
                                <small class="text-muted">
                                    <i class="fas fa-user"></i> <?= esc($t['fullname']) ?>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted">Belum ada timeline</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline-item {
    position: relative;
    padding-bottom: 20px;
}
.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 20px;
    height: calc(100% - 10px);
    width: 2px;
    background: #dee2e6;
}
.timeline-marker {
    position: absolute;
    left: -27px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #007bff;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #007bff;
}
.timeline-content {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
    border-left: 3px solid #007bff;
}
</style>
```

---

## 🔧 5. View Catatan (NEW)

**File:** `app/Views/backend/morvin/cmscust/pendaftaran_sidi/catatan.php`

```html
<!-- Form Add Catatan -->
<div class="card mb-3">
    <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="fas fa-plus"></i> Tambah Catatan</h5>
    </div>
    <div class="card-body">
        <form id="formAddCatatan">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label>Tipe Catatan</label>
                <select name="tipe" class="form-select" required>
                    <option value="internal">Internal (Admin Only)</option>
                    <option value="eksternal">Eksternal (Visible to User)</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</div>

<!-- List Catatan -->
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Catatan</h5>
    </div>
    <div class="card-body">
        <?php if ($catatan) : ?>
            <?php foreach ($catatan as $c) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="badge bg-<?= $c['tipe'] == 'internal' ? 'danger' : 'success' ?>">
                                    <?= ucfirst($c['tipe']) ?>
                                </span>
                                <small class="text-muted ms-2">
                                    <i class="fas fa-user"></i> <?= esc($c['fullname']) ?>
                                </small>
                            </div>
                            <small class="text-muted">
                                <?= date('d/m/Y H:i', strtotime($c['tgl_catatan'])) ?>
                            </small>
                        </div>
                        <p class="mb-0 mt-2"><?= nl2br(esc($c['catatan'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-muted">Belum ada catatan</p>
        <?php endif; ?>
    </div>
</div>

<script>
$('#formAddCatatan').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '<?= base_url('pendaftaran-sidi/addcatatan') ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.sukses) {
                Swal.fire('Berhasil!', response.sukses, 'success');
                loadCatatan(<?= $id ?>);
                $('#formAddCatatan')[0].reset();
            }
        }
    });
});
</script>
```

---

## 📋 Checklist Implementation

### Database:
- [ ] Import `update_pendaftaran_redesign.sql`
- [ ] Verify 3 tabel baru created
- [ ] Verify master data inserted

### Views:
- [ ] Update `list.php` - Add kelengkapan column
- [ ] Update `lihat.php` - Add tabs structure
- [ ] Create `dokumen.php` - Document management
- [ ] Create `timeline.php` - Timeline view
- [ ] Create `catatan.php` - Notes management

### Testing:
- [ ] Test upload dokumen
- [ ] Test verify dokumen
- [ ] Test delete dokumen
- [ ] Test timeline tracking
- [ ] Test add catatan
- [ ] Test approve/reject

### Replication:
- [ ] Copy to PendaftaranBaptis
- [ ] Copy to PendaftaranNikah
- [ ] Update routes for baptis & nikah

---

## 🚀 Quick Start

1. **Import Database:**
   ```bash
   mysql -u username -p database < update_pendaftaran_redesign.sql
   ```

2. **Create Folder:**
   ```bash
   mkdir public/img/pendaftaran/sidi
   mkdir public/img/pendaftaran/baptis
   mkdir public/img/pendaftaran/nikah
   ```

3. **Set Permission:**
   ```bash
   chmod 755 public/img/pendaftaran/*
   ```

4. **Test Upload:**
   - Login admin
   - Buka pendaftaran sidi
   - Klik detail
   - Tab dokumen
   - Upload file

---

**Status:** READY TO IMPLEMENT  
**Estimated Time:** 1-2 jam  
**Priority:** HIGH
