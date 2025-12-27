<?= csrf_field(); ?>

<!-- Statistik Cards -->
<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Jemaat</p>
                        <h4 class="mb-2"><?= number_format($statistik['total']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-users font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2">Jemaat Aktif</p>
                        <h4 class="mb-2"><?= number_format($statistik['aktif']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="fas fa-user-check font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2">Pindah</p>
                        <h4 class="mb-2"><?= number_format($statistik['pindah']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-warning rounded-3">
                            <i class="fas fa-exchange-alt font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2">Meninggal</p>
                        <h4 class="mb-2"><?= number_format($statistik['meninggal']) ?></h4>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-info rounded-3">
                            <i class="fas fa-cross font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Action Buttons -->
<div class="row mb-3">
    <div class="col-md-6">
        <form class="formcari">
            <?= csrf_field(); ?>
            <div class="input-group">
                <input type="text" class="form-control" id="keyword" name="keyword"
                    placeholder="Cari nama atau nomor anggota...">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
                <button class="btn btn-outline-secondary" type="button" onclick="resetCari()">
                    <i class="fas fa-refresh"></i> Reset
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-end">
        <?php if ($akses == '1' || $akses == '2') { ?>
            <button type="button" class="btn btn-success btn-sm tambah">
                <i class="fas fa-plus-circle"></i> Tambah Jemaat
            </button>
        <?php } ?>
    </div>
</div>

<!-- Data Table -->
<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabelJemaat">
        <thead class="table-light">
            <tr>
                <th width="5">
                    <?php if ($akses == '1' || $akses == '2') { ?>
                        <input type="checkbox" id="centangSemua" class="form-check-input">
                    <?php } ?>
                </th>
                <th width="5">#</th>
                <th width="80">Foto</th>
                <th width="100">No. Anggota</th>
                <th>Nama Lengkap</th>
                <th width="80">Jenis Kelamin</th>
                <th width="100">Tanggal Lahir</th>
                <th width="120">Kontak</th>
                <th width="100">Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($list as $data): ?>
                <tr>
                    <td>
                        <?php if ($akses == '1' || $akses == '2') { ?>
                            <input type="checkbox" class="form-check-input centangid" name="id_jemaat[]"
                                value="<?= $data['id_jemaat'] ?>">
                        <?php } ?>
                    </td>
                    <td><?= $nomor++ ?></td>
                    <td class="text-center">
                        <?php if ($data['foto']): ?>
                            <img src="<?= base_url('public/file/foto/jemaat/' . $data['foto']) ?>" class="rounded-circle"
                                width="50" height="50" style="object-fit: cover;" alt="Foto">
                        <?php else: ?>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-muted"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($data['no_anggota']) ?></strong></td>
                    <td>
                        <strong><?= esc($data['nama_lengkap']) ?></strong>
                        <?php if ($data['nama_panggilan']): ?>
                            <br><small class="text-muted">(<?= esc($data['nama_panggilan']) ?>)</small>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($data['jenis_kelamin'] == 'L'): ?>
                            <span class="badge bg-primary">Laki-laki</span>
                        <?php else: ?>
                            <span class="badge bg-pink">Perempuan</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= date('d/m/Y', strtotime($data['tgl_lahir'])) ?>
                        <br><small class="text-muted">
                            <?php
                            $umur = date_diff(date_create($data['tgl_lahir']), date_create('today'))->y;
                            echo $umur . ' tahun';
                            ?>
                        </small>
                    </td>
                    <td>
                        <?php if ($data['no_hp']): ?>
                            <i class="fas fa-phone text-success"></i> <?= esc($data['no_hp']) ?><br>
                        <?php endif; ?>
                        <?php if ($data['email']): ?>
                            <i class="fas fa-envelope text-primary"></i> <?= esc($data['email']) ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $statusClass = [
                            'Aktif' => 'bg-success',
                            'Pindah' => 'bg-warning',
                            'Meninggal' => 'bg-secondary',
                            'Non-Aktif' => 'bg-danger'
                        ];
                        ?>
                        <span class="badge <?= $statusClass[$data['status_keanggotaan']] ?>">
                            <?= esc($data['status_keanggotaan']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['id_jemaat'] ?>')"
                                title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            <?php if ($akses == '1' || $akses == '2') { ?>
                                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['id_jemaat'] ?>')"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-secondary btn-sm"
                                    onclick="toggle('<?= $data['id_jemaat'] ?>', '<?= esc($data['nama_lengkap']) ?>')"
                                    title="Ubah Status">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>

                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="uploadfoto('<?= $data['id_jemaat'] ?>')" title="Upload Foto">
                                    <i class="fas fa-camera"></i>
                                </button>

                                <?php if ($data['foto']): ?>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="hapusfoto('<?= $data['id_jemaat'] ?>', '<?= esc($data['nama_lengkap']) ?>')"
                                        title="Hapus Foto">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif; ?>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="hapus('<?= $data['id_jemaat'] ?>', '<?= esc($data['nama_lengkap']) ?>')"
                                    title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($akses == '1' || $akses == '2') { ?>
    <!-- Bulk Actions -->
    <div class="mt-2">
        <form class="formhapus">
            <?= csrf_field(); ?>
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="far fa-trash-alt"></i> Hapus Data Terpilih
            </button>
        </form>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#tabelJemaat').DataTable({
            "language": {
                "url": "<?= base_url() ?>/public/template/backend/assets/js/datatables/Indonesian.json"
            },
            "pageLength": 25,
            "responsive": true,
            "order": [[4, "asc"]], // Sort by nama_lengkap
            "columnDefs": [
                { "orderable": false, "targets": [0, 2, 9] } // Disable sorting for checkbox, foto, and aksi columns
            ]
        });

        // Select all checkbox
        $('#centangSemua').click(function () {
            if ($(this).is(':checked')) {
                $('.centangid').prop('checked', true);
            } else {
                $('.centangid').prop('checked', false);
            }
        });

        // Individual checkbox
        $('.centangid').click(function () {
            if ($('.centangid:checked').length == $('.centangid').length) {
                $('#centangSemua').prop('checked', true);
            } else {
                $('#centangSemua').prop('checked', false);
            }
        });
    });
</script>