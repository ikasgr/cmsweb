<div class="row">
    <div class="col-sm-12">
        <div class="float-right">
            <button type="button" class="btn btn-success btn-sm" onclick="tambah()">
                <i class="fas fa-plus-circle"></i> Tambah Data
            </button>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table id="listpendaftarannikah" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th width="5%">
                    <input type="checkbox" id="checkall">
                </th>
                <th width="5%">No</th>
                <th>Calon Suami</th>
                <th>Calon Istri</th>
                <th>Tanggal Nikah</th>
                <th>No. HP</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            if ($list):
                foreach ($list as $data):
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkboxes" name="id[]" value="<?= $data['id_pendaftaran'] ?>">
                        </td>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= esc($data['nama_pria']) ?></strong><br>
                            <small class="text-muted"><?= esc($data['tempat_lahir_pria']) ?>,
                                <?= date_indo($data['tanggal_lahir_pria']) ?></small>
                        </td>
                        <td>
                            <strong><?= esc($data['nama_wanita']) ?></strong><br>
                            <small class="text-muted"><?= esc($data['tempat_lahir_wanita']) ?>,
                                <?= date_indo($data['tanggal_lahir_wanita']) ?></small>
                        </td>
                        <td>
                            <?php if ($data['tanggal_nikah']): ?>
                                <span class="badge badge-info"><?= date_indo($data['tanggal_nikah']) ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($data['no_hp']) ?></td>
                        <td>
                            <?php if ($data['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif ($data['status'] == 1): ?>
                                <span class="badge badge-success">Disetujui</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Ditolak</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['id_pendaftaran'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm"
                                onclick="edit('<?= $data['id_pendaftaran'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="hapus('<?= $data['id_pendaftaran'] ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="row mt-3">
    <div class="col-sm-12 col-md-5">
        <button type="button" class="btn btn-danger btn-sm" onclick="hapusall()">
            <i class="far fa-trash-alt"></i> Hapus yang Dipilih
        </button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#listpendaftarannikah').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });

        $('#checkall').click(function () {
            $('.checkboxes').prop('checked', $(this).prop('checked'));
        });
    });

    function tambah() {
        $.ajax({
            type: 'get',
            url: '<?= base_url('pendaftaran-nikah/formtambah') ?>',
            dataType: 'json',
            success: function (response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function lihat(id) {
        $.ajax({
            type: 'post',
            url: '<?= base_url('pendaftaran-nikah/formlihat') ?>',
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modallihat').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function edit(id) {
        $.ajax({
            type: 'post',
            url: '<?= base_url('pendaftaran-nikah/formedit') ?>',
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id
            },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('pendaftaran-nikah/hapus') ?>',
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses
                            });
                            listpendaftarannikah();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    function hapusall() {
        let id = [];
        $('.checkboxes:checked').each(function () {
            id.push($(this).val());
        });

        if (id.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Pilih data yang akan dihapus'
            });
            return false;
        }

        Swal.fire({
            title: 'Hapus ' + id.length + ' Data?',
            text: 'Data akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('pendaftaran-nikah/hapusall') ?>',
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses
                            });
                            listpendaftarannikah();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>