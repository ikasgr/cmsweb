<?= form_open('pendaftaran-sidi/hapusall', ['class' => 'formhapus']) ?>
<?php if ($akses == 1) { ?>
    <button type="button" class="btn btn-success btn-sm tambah">
        <i class="fas fa-plus-circle"></i> Tambah Data
    </button>
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="far fa-trash-alt"></i> Hapus Terpilih
    </button>
<?php } ?>

<hr>
<div class="table-responsive">
    <table id="listsidi" class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th width="3%" class="text-center">
                    <input type="checkbox" id="centangSemua">
                </th>
                <th width="5%">#</th>
                <th>Nama Lengkap</th>
                <th>TTL</th>
                <th>JK</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Tgl Baptis</th>
                <th>Tgl Daftar</th>
                <th width="12%" class="text-center">Kelengkapan</th>
                <th width="10%" class="text-center">Status</th>
                <th width="15%" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($list as $value) :
                $nomor++;
                
                // Status badge
                if ($value['status'] == '0') {
                    $badge = '<span class="badge badge-warning">Pending</span>';
                } elseif ($value['status'] == '1') {
                    $badge = '<span class="badge badge-success">Disetujui</span>';
                } else {
                    $badge = '<span class="badge badge-danger">Ditolak</span>';
                }
                
                // Icon dokumen
                $dok_count = 0;
                if (!empty($value['dok_ktp'])) $dok_count++;
                if (!empty($value['dok_kk'])) $dok_count++;
                if (!empty($value['dok_baptis'])) $dok_count++;
                if (!empty($value['dok_foto'])) $dok_count++;
            ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="id_sidi[]" class="centangid" value="<?= $value['id_sidi'] ?>">
                    </td>
                    <td><?= $nomor ?></td>
                    <td>
                        <?= esc($value['nama_lengkap']) ?>
                        <?php if ($dok_count > 0) : ?>
                            <span class="badge badge-info badge-pill" title="<?= $dok_count ?> dokumen">
                                <i class="fas fa-paperclip"></i> <?= $dok_count ?>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($value['tempat_lahir']) ?>, <?= date_indo($value['tgl_lahir']) ?></td>
                    <td><?= esc($value['jenis_kelamin']) ?></td>
                    <td><?= esc($value['no_hp']) ?></td>
                    <td><?= esc($value['email']) ?></td>
                    <td><?= date_indo($value['tgl_baptis']) ?></td>
                    <td><?= date_indo($value['tgl_daftar']) ?></td>
                    <td class="text-center">
                        <?php 
                        $kelengkapan = isset($value['kelengkapan_dokumen']) ? $value['kelengkapan_dokumen'] : 0;
                        $color = 'danger';
                        if ($kelengkapan >= 80) $color = 'success';
                        elseif ($kelengkapan >= 50) $color = 'warning';
                        ?>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-<?= $color ?>" role="progressbar" 
                                 style="width: <?= $kelengkapan ?>%" 
                                 aria-valuenow="<?= $kelengkapan ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= $kelengkapan ?>%
                            </div>
                        </div>
                    </td>
                    <td class="text-center"><?= $badge ?></td>
                    <td class="text-center">
                        <button type="button" onclick="lihat('<?= $value['id_sidi'] ?>')" 
                                class="btn btn-info btn-sm" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        <?php if ($akses == 1) { ?>
                            <button type="button" onclick="edit('<?= $value['id_sidi'] ?>')" 
                                    class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <button type="button" onclick="uploaddok('<?= $value['id_sidi'] ?>')" 
                                    class="btn btn-primary btn-sm" title="Upload Dokumen">
                                <i class="fas fa-upload"></i>
                            </button>
                            
                            <button type="button" onclick="toggle('<?= $value['id_sidi'] ?>')" 
                                    class="btn btn-secondary btn-sm" title="Ubah Status">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            
                            <button type="button" onclick="hapus('<?= $value['id_sidi'] ?>','<?= esc($value['nama_lengkap']) ?>')" 
                                    class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        $('#listsidi').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[8, "desc"]] // Sort by Tgl Daftar descending
        });
        
        // Centang semua checkbox
        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangid').prop('checked', true);
            } else {
                $('.centangid').prop('checked', false);
            }
        });
    });
</script>
