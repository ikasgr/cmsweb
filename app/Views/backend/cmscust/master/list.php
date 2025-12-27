<?php if ($tambah == 1) { ?>
    <button type="submit" class="btn btn-success btn-sm tambahkategori">
        <i class="fas fa fa-plus-circle"></i> Tambah Data
    </button>
    <hr>
<?php } ?>
<input type="hidden" class="form-control" id="req" value="<?= $req ?>" name="req" readonly>
<input type="hidden" class="form-control" id="jns" value="<?= $jns ?>" name="jns" readonly>
<input type="hidden" class="form-control" id="jdl" value="<?= esc($jdl) ?>" name="jdl" readonly>

<div class="table-responsive b-0 ">
    <table id="listmaster" class="table table-hover table-striped table-bordered">

        <thead class="bg-info">
            <tr>
                <th width="40" class="text-center p-2 text-light"> #</th>
                <th class="p-2 text-light"><?= esc(strtoupper($jdl)) ?></th>
                <th width="100" class="text-center p-2 text-light">AKSI</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $nomor = 0;
            # code...
            foreach ($list as $data) {
                $nomor++;
                $id_masterdata = $data['id_masterdata'];
                $gambar = esc($data['image_master']);
                $ketmaster = esc($data['ket_master']);
                $sts_master = esc($data['sts_master']);

                $jmasterdata = $nmbscontrol->selectCount($stsm)->where($stsm, $id_masterdata)->first();
                if ($jmasterdata) {
                    $jdata = $jmasterdata[$stsm];
                } else {
                    $jdata = 0;
                }

                if (file_exists('public/img/master/' . $gambar) && $gambar != '') {
                    $imgmaster = '<img class="img-circle elevation-2 pointer p-0" src="' . base_url('public/img/master/' . $gambar) . '" title="Ganti gambar" width="60px">';
                } else {
                    $imgmaster = '<span class="badge badge-soft-warning font-size-12 pointer" style="font-size:12px" title="Tambahkan Gambar">No Image </span>';
                }
                ?>
                <tr>
                    <td class="text-center p-1"><?= $nomor ?></td>

                    <td class="p-1">
                        &nbsp; <?= esc($data['nama_master']) ?> <a class="text-danger"
                            title="<?= ($jdata != 0) ? '(' . $toltip . ')' : '' ?>"><?= ($jdata != 0) ? '(' . $jdata . ')' : '' ?></a>
                    </td>

                    <td class="text-center p-1">
                        <?php if ($ubah == 1) { ?>
                            <button type="button" onclick="toggle('<?= $id_masterdata ?>')"
                                class="btn btn-circle btn-sm btn-light p-1"
                                title="<?= $sts_master == 1 ? 'Non Aktifkan' : 'Aktifkan' ?>"><i
                                    class="<?= $sts_master == 1 ? 'fas fa-check-circle text-success' : 'far fa-eye text-danger' ?>"></i></button>
                            <button type="button" class="btn btn-light btn-sm p-1" onclick="edit('<?= $id_masterdata ?>')">
                                <i class="icon fas fa-edit text-info"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-circle btn-sm btn-light p-1"
                                title="<?= $sts_master == 1 ? 'Non Aktifkan' : 'Aktifkan' ?>"><i
                                    class="<?= $sts_master == 1 ? 'fas fa-check-circle text-success' : 'far fa-eye text-danger' ?>"></i></button>
                            <button type="button" class="btn btn-light btn-sm p-1">
                                <i class="fas fa-edit text-secondary"></i>
                            </button>
                        <?php } ?>
                        <?php if ($jdata == 0) { ?>
                            <button type="button" class="btn btn-light btn-sm p-1" onclick="hapus('<?= $id_masterdata ?>')">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-light btn-sm p-1">
                                <i class="far fa-trash-alt text-secondary"></i>
                            </button>
                        <?php } ?>

                    </td>

                </tr>
            <?php } ?>
            <!-- end lop -->

        </tbody>

        <tfoot>
            <tr>
                <th class="text-center"><b>#<b></th>
                <th><?= esc(strtoupper($jdl)) ?></th>
                <th class="text-center">AKSI</th>
            </tr>
        </tfoot>
    </table>

</div>

<script>
    $(document).ready(function () {
        $('#listmaster').DataTable({
            'ordering': false,
            'iDisplayLength': 25,
        });

        $('.tambahkategori').click(function (e) {
            e.preventDefault();
            req = $("#req").val();
            jns = $("#jns").val();
            jdl = $("#jdl").val();
            $.ajax({
                url: "<?= site_url('masterdata/formtambah') ?>",
                data: {
                    req: req,
                    jns: jns,
                    jdl: jdl,
                },
                dataType: "json",
                success: function (response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
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

    function uploadfile(id_masterdata) {

        $.ajax({
            type: "post",
            url: "<?= site_url('masterdata/formuploadfoto') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_masterdata: id_masterdata,

            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
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

    function edit(id_masterdata) {
        jdl = $("#jdl").val();
        $.ajax({
            type: "post",
            url: "<?= site_url('masterdata/formedit') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_masterdata: id_masterdata,
                req: req,
                jdl: jdl,

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

    function hapus(id_masterdata) {
        Swal.fire({
            width: '400px',

            title: 'Hapus data?',
            text: `Apakah anda yakin hapus data?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('masterdata/hapusdata') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id_masterdata: id_masterdata
                    },

                    success: function (response) {
                        if (response.sukses) {

                            toastr["success"](response.sukses)
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
                                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listmaster();
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

    function toggle(id_masterdata) {
        $.ajax({
            type: "post",
            url: "<?= site_url('masterdata/toggle') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_masterdata: id_masterdata
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: response.sukses,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    listmaster();
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