<?= csrf_field(); ?>

<!-- Statistik Cards -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Majelis</p>
                        <h4 class="mb-2"><?= number_format($statistik['total_majelis']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-user-tie font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Pendeta</p>
                        <h4 class="mb-2"><?= number_format($statistik['total_pendeta']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="fas fa-cross font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Diakon</p>
                        <h4 class="mb-2"><?= number_format($statistik['total_diakon']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-warning rounded-3">
                            <i class="fas fa-hands-helping font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Anggota Majelis</p>
                        <h4 class="mb-2"><?= number_format($statistik['total_anggota']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            <i class="fas fa-users font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mb-3">
    <div class="col-md-6">
        <?php if ($akses == '1' || $akses == '2') { ?>
            <form class="formhapus">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus Terpilih
                </button>
            </form>
        <?php } ?>
    </div>
    <div class="col-md-6 text-end">
        <?php if ($akses == '1' || $akses == '2') { ?>
            <button type="button" class="btn btn-success btn-sm tambah">
                <i class="fas fa-plus-circle"></i> Tambah Majelis
            </button>
        <?php } ?>
    </div>
</div>

<!-- Data Table -->
<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabelMajelis">
        <thead class="table-light">
            <tr>
                <th width="5">
                    <?php if ($akses == '1' || $akses == '2') { ?>
                        <input type="checkbox" id="centangSemua" class="form-check-input">
                    <?php } ?>
                </th>
                <th width="5">#</th>
                <th width="80">Foto</th>
                <th>Nama</th>
                <th width="150">Jenis Jabatan</th>
                <th width="120">Jabatan</th>
                <th width="120">Kontak</th>
                <th width="100">Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($list as $data) : ?>
                <tr>
                    <td>
                        <?php if ($akses == '1' || $akses == '2') { ?>
                            <input type="checkbox" class="form-check-input centangid" name="majelis_id[]" value="<?= $data['majelis_id'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $nomor++ ?></td>
                    <td class="text-center">
                        <?php if ($data['gambar']) : ?>
                            <img src="<?= base_url('public/img/informasi/pegawai/' . $data['gambar']) ?>" 
                                 class="rounded-circle" width="50" height="50" 
                                 style="object-fit: cover;" alt="Foto">
                        <?php else : ?>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-user-tie text-muted"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <strong><?= esc($data['nama']) ?></strong>
                        <?php if ($data['nip']) : ?>
                            <br><small class="text-muted">NIP: <?= esc($data['nip']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        $badge_class = 'primary';
                        if ($data['jenis_jabatan'] == 'Pendeta') $badge_class = 'success';
                        elseif ($data['jenis_jabatan'] == 'Diakon') $badge_class = 'warning';
                        elseif ($data['jenis_jabatan'] == 'Ketua Majelis') $badge_class = 'danger';
                        ?>
                        <span class="badge bg-<?= $badge_class ?>"><?= esc($data['jenis_jabatan']) ?></span>
                    </td>
                    <td><?= esc($data['nama_jabatan'] ?? '-') ?></td>
                    <td>
                        <?php if ($data['no_hp']) : ?>
                            <i class="fas fa-phone"></i> <?= esc($data['no_hp']) ?><br>
                        <?php endif; ?>
                        <?php if ($data['email']) : ?>
                            <i class="fas fa-envelope"></i> <?= esc($data['email']) ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        $status_class = 'success';
                        if ($data['status_jabatan'] == 'Non-Aktif') $status_class = 'secondary';
                        elseif ($data['status_jabatan'] == 'Masa Percobaan') $status_class = 'warning';
                        elseif ($data['status_jabatan'] == 'Habis Masa Jabatan') $status_class = 'danger';
                        ?>
                        <span class="badge bg-<?= $status_class ?>"><?= esc($data['status_jabatan']) ?></span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['majelis_id'] ?>')" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <?php if ($akses == '1' || $akses == '2') { ?>
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['majelis_id'] ?>')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggle('<?= $data['majelis_id'] ?>', '<?= esc($data['nama']) ?>')" title="Ubah Status">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                        <?php } ?>
                        <?php if ($akses == '1') { ?>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['majelis_id'] ?>', '<?= esc($data['nama']) ?>')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabelMajelis').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[3, "asc"]]
        });

        // Centang semua
        $('#centangSemua').click(function() {
            $('.centangid').prop('checked', this.checked);
        });

        // Uncheck centang semua jika ada yang dilepas
        $('.centangid').click(function() {
            if (!$(this).prop('checked')) {
                $('#centangSemua').prop('checked', false);
            }
        });
    });
</script>
