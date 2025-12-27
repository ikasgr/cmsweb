<?= form_open('section/hapusall', ['class' => 'formhapus']) ?>
<?php if ($tambah == 1) { ?>
    <button type="submit" class="btn btn-success btn-sm tambahsection">
        <i class="fas fa fa-plus-circle"></i> Tambah Section Baru
    </button>
<?php } ?>
<?php if ($hapus == 1) { ?>
    <button type="submit" class="btn btn-danger btn-sm tblhapus">
        <i class="far fa-trash-alt text-light"></i> Hapus yang diceklist
    </button>

<?php } ?>
<small class="text-secondary"> Pastikan script class CSS yang ditambah / dimodifikasi tersedia pada <strong
        class="text-danger">Template</strong> yang diterapkan.</small>
<hr>
<div class="table-responsive b-0 ">
    <table id="listsection" class="table table-bordered table-hover">

        <thead class="bg-light">
            <tr>
                <th width="4" class=" text-center">
                    <input type="checkbox" id="centangSemua" class="text-center">
                </th>
                <th width="10" class=" text-center"># </th>
                <th width="5" class=" text-center">Gambar</th>
                <th width="250" class="">Judul</th>
                <th width="90" class="">Template</th>
                <th width="35" class=" text-center">Urutan</th>
                <th width="40" class="text-center ">Aksi </th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($list as $value):
                $nomor++; ?>
                <tr>
                    <td class=" text-center">
                        <input type="checkbox" name="section_id[]" class="centangsectionid"
                            value="<?= $value['section_id'] ?>">
                    </td>
                    <td class=" text-center"><?= $nomor ?></td>

                    <td class=" text-center">
                        <?php if (esc($value['gambar']) == '') { ?>
                            <span class="badge badge-soft-danger pointer" style="font-size:12px"
                                onclick="gantifoto(' <?= $value['section_id'] ?> ')" title="Tambahkan Gambar">No Image </span>
                        <?php } else { ?>
                            <img class="img-circle elevation-2 pointer" title="Ganti Gambar"
                                onclick="gantifoto('<?= $value['section_id'] ?>')"
                                src="<?= base_url('/public/img/section/' . esc($value['gambar'])) ?>" width="80" height="50">
                        <?php } ?>

                    </td>
                    <td class=""><?= esc($value['nama_section']) ?></td>
                    <td class=""><?= esc($value['nama']) ?></td>
                    <td class=" text-center"><?= $value['urutan'] ?></td>

                    <td class="text-center ">
                        <?php if ($ubah == 1) { ?>
                            <button type="button" class="btn btn-light btn-sm p-1"
                                onclick="edit('<?= $value['section_id'] ?>')">
                                <i class="icon fas fa-edit text-info"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-light btn-sm p-1">
                                <i class="icon fas fa-edit text-secondary"></i>
                            </button>
                        <?php } ?>
                        <?php if ($hapus == 1) { ?>
                            <button type="button" class="btn btn-light btn-sm p-1"
                                onclick="hapus('<?= $value['section_id'] ?>','<?= esc($value['nama_section']) ?>')">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-light btn-sm p-1">
                                <i class="far fa-trash-alt text-secondary"></i>
                            </button>
                        <?php } ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="text-center p-1">
                    <input type="checkbox" class="text-center" disabled>
                </th>
                <th class="text-center p-1">#</th>
                <th class="text-center p-1">Gambar</th>
                <th class="p-1">Judul</th>
                <th class="p-1">Template</th>
                <th class="text-center p-1">Urutan</th>
                <th class="text-center p-1">Aksi</th>

            </tr>
        </tfoot>
    </table>
</div>
<?= form_close() ?>

<script>
    $(document).ready(function () {

        $('#listsection').DataTable({
            'ordering': false,
        });

        $('#centangSemua').click(function (e) {
            if ($(this).is(':checked')) {
                $('.centangsectionid').prop('checked', true);
            } else {
                $('.centangsectionid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function (e) {
            e.preventDefault();
            let jmldata = $('.centangsectionid:checked');
            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    title: `Apakah anda yakin ingin menghapus ${jmldata.length} section?`,
                    text: 'Semua section yang terpilih akan terhapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            beforeSend: function () {
                                $('.tblhapus').attr('disable', 'disable');
                                $('.tblhapus').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                            },
                            complete: function () {
                                $('.tblhapus').removeAttr('disable', 'disable');
                                $('.tblhapus').html('<i class="far fa-trash-alt text-light"></i>  Hapus yang diceklist');
                            },
                            success: function (response) {
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                },
                                    toastr["success"](response.sukses)
                                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                                listsection();
                            },
                            error: function (xhr, ajaxOptions, thrownerror) {
                                Swal.fire({
                                    title: "Maaf gagal hapus data!",
                                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 3100
                                }).then(function () {
                                    window.location = '';
                                })
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(section_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('section-script/formedit') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                section_id: section_id
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modaledit').modal('show');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function () {
                    window.location = '';
                })
            }
        });
    }

    function hapus(section_id, ket) {

        Swal.fire({
            // title: 'Hapus data?',
            html: `Apakah anda yakin menghapus <strong>${ket}</strong> ini ?`,

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('section-script/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        section_id: section_id
                    },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            },
                                toastr["success"](response.sukses)
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listsection();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownerror) {
                        Swal.fire({
                            title: "Maaf gagal hapus data!",
                            html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3100
                        }).then(function () {
                            window.location = '';
                        })
                    }
                });
            }
        })
    }

    //tambah data
    $(document).ready(function () {
        $('.tambahsection').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('section-script/formtambah') ?>",
                dataType: "json",
                success: function (response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    $('#modaltambah').modal('show');
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal load data!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function () {
                        window.location = '';
                    })
                }
            });
        });
    });

    function gantifoto(section_id) {

        $.ajax({
            type: "post",
            url: "<?= site_url('section-script/formgantifoto') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                section_id: section_id,
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modalupload').modal('show');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function () {
                    window.location = '';
                })
            }
        });
    }
</script>