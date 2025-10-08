<?= csrf_field(); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="float-right">
            <button type="button" class="btn btn-success btn-sm" onclick="tambah()">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </button>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table id="listproduk" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th width="5%">
                    <input type="checkbox" id="checkall">
                </th>
                <th width="5%">No</th>
                <th width="10%">Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            if ($list) :
                foreach ($list as $data) :
                    $harga_tampil = !empty($data['harga_promo']) ? $data['harga_promo'] : $data['harga'];
            ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkboxes" name="id[]" value="<?= $data['id_produk'] ?>">
                        </td>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= base_url('/public/img/produk/' . $data['gambar']) ?>" 
                                 class="img-thumbnail" alt="<?= esc($data['nama_produk']) ?>"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong><?= esc($data['nama_produk']) ?></strong>
                            <?php if (!empty($data['featured']) && $data['featured'] == '1') : ?>
                                <span class="badge bg-warning text-dark">Featured</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge badge-info"><?= esc($data['nama_kategori']) ?></span>
                        </td>
                        <td>
                            <?php if (!empty($data['harga_promo'])) : ?>
                                <span class="text-muted" style="text-decoration: line-through;">
                                    Rp <?= number_format($data['harga'], 0, ',', '.') ?>
                                </span><br>
                            <?php endif; ?>
                            <strong class="text-success">Rp <?= number_format($harga_tampil, 0, ',', '.') ?></strong>
                        </td>
                        <td>
                            <?php if ($data['stok'] > 0) : ?>
                                <span class="badge badge-success"><?= $data['stok'] ?></span>
                            <?php else : ?>
                                <span class="badge badge-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($data['status'] == 1) : ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else : ?>
                                <span class="badge badge-secondary">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="lihat('<?= $data['id_produk'] ?>')">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['id_produk'] ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['id_produk'] ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
            <?php
                endforeach;
            else :
            ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
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
    $(document).ready(function() {
        $('#listproduk').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[1, "desc"]]
        });

        $('#checkall').click(function() {
            $('.checkboxes').prop('checked', $(this).prop('checked'));
        });
    });

    function tambah() {
        $.ajax({
            type: 'get',
            url: '<?= site_url('produk-umkm/formtambah') ?>',
            dataType: 'json',
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function lihat(id) {
        $.ajax({
            type: 'post',
            url: '<?= site_url('produk-umkm/formlihat') ?>',
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_produk: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modallihat').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function edit(id) {
        $.ajax({
            type: 'post',
            url: '<?= site_url('produk-umkm/formedit') ?>',
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_produk: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Produk?',
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
                    url: '<?= site_url('produk-umkm/hapus') ?>',
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_produk: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses
                            });
                            listproduk();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    function hapusall() {
        let id = [];
        $('.checkboxes:checked').each(function() {
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
            title: 'Hapus ' + id.length + ' Produk?',
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
                    url: '<?= site_url('produk-umkm/hapusall') ?>',
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.sukses
                            });
                            listproduk();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>
