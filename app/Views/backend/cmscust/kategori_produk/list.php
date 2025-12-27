<?= csrf_field(); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="float-right">
            <button type="button" class="btn btn-success btn-sm" onclick="tambah()">
                <i class="fas fa-plus-circle"></i> Tambah Kategori
            </button>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table id="listkategori" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th width="5%">
                    <input type="checkbox" id="checkall">
                </th>
                <th width="5%">No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Jumlah Produk</th>
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
                            <input type="checkbox" class="checkboxes" name="id[]" value="<?= $data['kategori_id'] ?>">
                        </td>
                        <td><?= $no++ ?></td>
                        <td>
                            <strong><?= esc($data['nama_kategori']) ?></strong>
                            <?php if ($data['deskripsi']): ?>
                                <br><small class="text-muted"><?= substr(esc($data['deskripsi']), 0, 50) ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <code><?= esc($data['slug_kategori']) ?></code>
                        </td>
                        <td>
                            <span class="badge badge-primary">0 produk</span>
                        </td>
                        <td>
                            <?php if ($data['status'] == 1): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['kategori_id'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['kategori_id'] ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
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
        $('#listkategori').DataTable({
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
            url: '<?= site_url('kategori-produk/formtambah') ?>',
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

    function edit(id) {
        $.ajax({
            type: 'post',
            url: '<?= site_url('kategori-produk/formedit') ?>',
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                kategori_id: id
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
            title: 'Hapus Kategori?',
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
                    url: '<?= site_url('kategori-produk/hapus') ?>',
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        kategori_id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses
                            });
                            listkategori();
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
            title: 'Hapus ' + id.length + ' Kategori?',
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
                    url: '<?= site_url('kategori-produk/hapusall') ?>',
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
                            listkategori();
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