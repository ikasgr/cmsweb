<?php
/**
 * =====================================================
 * View: Inventaris Gereja - List Data
 * Church Management System - Fase 2
 * Created: 8 Oktober 2025
 * =====================================================
 */

$akses = $akses ?? '1';
?>

<?php if ($akses == '1' || $akses == '2'): ?>
    <table id="datatable" class="table table-striped table-bordered table-hover dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th width="5%">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" class="checkall" id="checkall">
                        <label for="checkall"></label>
                    </div>
                </th>
                <th width="8%">Foto</th>
                <th width="10%">Kode Aset</th>
                <th width="20%">Nama Aset</th>
                <th width="15%">Kategori</th>
                <th width="15%">Lokasi</th>
                <th width="10%">Status</th>
                <th width="10%">Kondisi</th>
                <th width="10%">Nilai Buku</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $row): ?>
                    <tr>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="checkitem" id="checkitem_<?= $row->id_aset ?>"
                                    value="<?= $row->id_aset ?>">
                                <label for="checkitem_<?= $row->id_aset ?>"></label>
                            </div>
                        </td>
                        <td>
                            <?php if ($row->foto_aset && file_exists('public/img/aset/' . $row->foto_aset)): ?>
                                <a href="<?= base_url('public/img/aset/' . $row->foto_aset) ?>" target="_blank">
                                    <img src="<?= base_url('public/img/aset/' . $row->foto_aset) ?>" alt="Foto"
                                        class="img-thumbnail rounded-circle avatar-sm"
                                        style="height: 40px; width: 40px; object-fit: cover;">
                                </a>
                            <?php else: ?>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-soft-secondary text-secondary font-16 rounded-circle">
                                        <?= strtoupper(substr($row->nama_aset, 0, 1)) ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= esc($row->kode_aset) ?></strong>
                            <?php if ($row->qr_code): ?>
                                <br><small class="text-muted">QR: <?= substr($row->qr_code, 0, 10) ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= esc($row->nama_aset) ?></strong>
                            <?php if ($row->merk || $row->model): ?>
                                <br><small class="text-muted">
                                    <?php if ($row->merk): ?>                     <?= esc($row->merk) ?>                 <?php endif; ?>
                                    <?php if ($row->merk && $row->model): ?> - <?php endif; ?>
                                    <?php if ($row->model): ?>                     <?= esc($row->model) ?>                 <?php endif; ?>
                                </small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge badge-soft-primary"
                                style="background-color: <?= esc($row->warna) ?>20; color: <?= esc($row->warna) ?>; border: 1px solid <?= esc($row->warna) ?>30;">
                                <i class="<?= esc($row->icon) ?> mr-1"></i>
                                <?= esc($row->nama_kategori) ?>
                            </span>
                        </td>
                        <td><?= esc($row->nama_lokasi) ?></td>
                        <td>
                            <?php
                            $status_class = '';
                            $status_icon = '';
                            switch ($row->status) {
                                case 'Aktif':
                                    $status_class = 'badge-soft-success';
                                    $status_icon = 'fe-check-circle';
                                    break;
                                case 'Maintenance':
                                    $status_class = 'badge-soft-warning';
                                    $status_icon = 'fe-wrench';
                                    break;
                                case 'Rusak':
                                    $status_class = 'badge-soft-danger';
                                    $status_icon = 'fe-alert-triangle';
                                    break;
                                case 'Dijual':
                                    $status_class = 'badge-soft-info';
                                    $status_icon = 'fe-dollar-sign';
                                    break;
                                default:
                                    $status_class = 'badge-soft-secondary';
                                    $status_icon = 'fe-circle';
                            }
                            ?>
                            <span class="badge <?= $status_class ?> p-2">
                                <i class="fe <?= $status_icon ?> mr-1"></i>
                                <?= esc($row->status) ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $kondisi_class = '';
                            switch ($row->kondisi) {
                                case 'Baik':
                                    $kondisi_class = 'badge-soft-success';
                                    break;
                                case 'Rusak Ringan':
                                    $kondisi_class = 'badge-soft-warning';
                                    break;
                                case 'Rusak Berat':
                                    $kondisi_class = 'badge-soft-danger';
                                    break;
                                case 'Tidak Berfungsi':
                                    $kondisi_class = 'badge-soft-dark';
                                    break;
                                default:
                                    $kondisi_class = 'badge-soft-secondary';
                            }
                            ?>
                            <span class="badge <?= $kondisi_class ?>">
                                <?= esc($row->kondisi) ?>
                            </span>
                        </td>
                        <td class="text-right">
                            <strong>Rp <?= number_format($row->nilai_buku, 0, ',', '.') ?></strong>
                            <?php if ($row->harga_perolehan != $row->nilai_buku): ?>
                                <br><small class="text-muted">
                                    Perolehan: Rp <?= number_format($row->harga_perolehan, 0, ',', '.') ?>
                                </small>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-info" onclick="lihat('<?= $row->id_aset ?>')"
                                    title="Lihat Detail">
                                    <i class="fe-eye"></i>
                                </button>

                                <?php if ($akses == '1'): ?>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="edit('<?= $row->id_aset ?>')"
                                        title="Edit">
                                        <i class="fe-edit"></i>
                                    </button>

                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fe-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($row->status == 'Aktif'): ?>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Maintenance')">
                                                    <i class="fe-wrench mr-2"></i>Set Maintenance
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Rusak')">
                                                    <i class="fe-alert-triangle mr-2"></i>Set Rusak
                                                </a>
                                            <?php elseif ($row->status == 'Maintenance'): ?>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Aktif')">
                                                    <i class="fe-check-circle mr-2"></i>Set Aktif
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Rusak')">
                                                    <i class="fe-alert-triangle mr-2"></i>Set Rusak
                                                </a>
                                            <?php elseif ($row->status == 'Rusak'): ?>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Aktif')">
                                                    <i class="fe-check-circle mr-2"></i>Set Aktif
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                    onclick="toggleStatus('<?= $row->id_aset ?>', 'Maintenance')">
                                                    <i class="fe-wrench mr-2"></i>Set Maintenance
                                                </a>
                                            <?php endif; ?>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                onclick="hapus('<?= $row->id_aset ?>', '<?= addslashes($row->nama_aset) ?>')">
                                                <i class="fe-trash-2 mr-2"></i>Hapus
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <div class="text-muted">
                            <i class="fe-search fa-3x mb-3"></i>
                            <h5>Tidak ada data aset</h5>
                            <p>Silakan tambah aset baru atau ubah filter pencarian</p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($akses == '1' && !empty($list)): ?>
        <!-- Bulk Actions -->
        <div class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <span class="mr-2">Aksi Massal:</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="bulkSetStatus('Maintenance')">
                                <i class="fe-wrench mr-1"></i>Set Maintenance
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkSetStatus('Rusak')">
                                <i class="fe-alert-triangle mr-1"></i>Set Rusak
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkDelete()">
                                <i class="fe-trash-2 mr-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <small class="text-muted">
                        <span id="selected-count">0</span> dari <span id="total-count"><?php echo count($list); ?></span> aset
                        dipilih
                    </small>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Akses Ditolak!</h4>
        Anda tidak memiliki akses untuk melihat data inventaris gereja.
    </div>
<?php endif; ?>

<script>
    // DataTable initialization
    $(document).ready(function () {
        $('#datatable').DataTable({
            "pageLength": 25,
            "responsive": true,
            "order": [[1, "desc"]],
            "columnDefs": [
                {
                    "targets": [0, 1, 9],
                    "orderable": false
                },
                {
                    "targets": [8],
                    "className": "text-right"
                }
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "drawCallback": function () {
                // Update selected count
                updateSelectedCount();
            }
        });

        // Check all functionality
        $('#checkall').change(function () {
            $('.checkitem').prop('checked', $(this).prop('checked'));
            updateSelectedCount();
        });

        // Individual checkbox change
        $('.checkitem').change(function () {
            updateSelectedCount();
        });
    });

    // Update selected count
    function updateSelectedCount() {
        const selectedCount = $('.checkitem:checked').length;
        const totalCount = $('.checkitem').length;

        $('#selected-count').text(selectedCount);
        $('#total-count').text(totalCount);

        // Show/hide bulk actions
        if (selectedCount > 0) {
            $('.mt-3').show();
        } else {
            $('.mt-3').hide();
        }
    }

    // Bulk set status
    function bulkSetStatus(status) {
        const selectedItems = $('.checkitem:checked');
        if (selectedItems.length === 0) {
            toastr.warning('Pilih aset terlebih dahulu');
            return;
        }

        Swal.fire({
            title: 'Ubah Status Aset?',
            text: `Apakah Anda yakin ingin mengubah status ${selectedItems.length} aset menjadi "${status}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const ids = [];
                selectedItems.each(function () {
                    ids.push($(this).val());
                });

                $.ajax({
                    url: '<?= site_url('inventaris-gereja/bulkstatus') ?>',
                    type: 'POST',
                    data: { id_aset: ids, status: status },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            $('#checkall').prop('checked', false);
                            loadAssetList();
                        } else {
                            toastr.error(response.error);
                        }
                    }
                });
            }
        });
    }

    // Bulk delete
    function bulkDelete() {
        const selectedItems = $('.checkitem:checked');
        if (selectedItems.length === 0) {
            toastr.warning('Pilih aset terlebih dahulu');
            return;
        }

        Swal.fire({
            title: 'Hapus Aset?',
            text: `Apakah Anda yakin ingin menghapus ${selectedItems.length} aset yang dipilih?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const ids = [];
                selectedItems.each(function () {
                    ids.push($(this).val());
                });

                $.ajax({
                    url: '<?= site_url('inventaris-gereja/hapusall') ?>',
                    type: 'POST',
                    data: { id_aset: ids },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            $('#checkall').prop('checked', false);
                            loadAssetList();
                            loadStatistics();
                        } else {
                            toastr.error(response.error);
                        }
                    }
                });
            }
        });
    }
</script>