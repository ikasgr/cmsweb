<?php if ($list) { ?>
    <?php if ($tambah == 1) { ?>
        <button type="submit" class="btn btn-success btn-sm tambahpoling">
            <i class="fas fa fa-plus-circle"></i> Tambah Jawaban Baru
        </button>
    <?php } ?>
    <small class="text-secondary"> Untuk <strong class="text-danger">Tutup Polling/Jajak Pendapat </strong> silahkan Non aktifkan pada pertanyaan..! </small>
    <hr>
    <table class="table table-sm table-hover table-striped p-0 mt-3">

        <tr>
            <td class="p-1" width="15%">Layanan yang dinilai</td>
            <td class="p-1" width="1%">:</td>
            <td class="p-1"> <a> <b><?= esc($nama) ?></b> </a> </td>
        </tr>
        <tr>
            <td class="p-1" width="15%">Total Responden</td>
            <td class="p-1" width="1%">:</td>
            <td class="p-1"> <a> <b><?= $jumpol ?></b> </a> </td>
        </tr>
    </table>
    <div class="table-responsive p-0 ">
        <table id="listpoling" class="table table-hover table-bordered">
            <thead class="bg-light p-1">
                <tr>
                    <th><b>PILIHAN</b></th>
                    <th width="100" class="text-center"><b>AKSI</b></th>
                </tr>
            </thead>

            <tbody>

                <?php $nomor = 0;
                foreach ($list as $data) :

                    if ($jumpol) {
                        $prosentase = sprintf("%.2f", (($data['rating'] / $jumpol) * 100));
                    } else {
                        $prosentase = 0;
                    }
                    $nomor++; ?>
                    <tr>

                        <td class="p-2">
                            <?= esc($data['pilihan']) ?>
                            <?php if ($data['type'] == 'Jawaban') { ?>
                                <strong><a class="text-danger font-size-13">(<?= esc($data['rating']) ?>)</a></strong>
                                <div class="progress p-0" style="height: 20px;">
                                    <div class="progress-bar progress-bar-striped progress-bar p-0" role="progressbar" style="width: <?= $prosentase ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><?= $prosentase ?>%</div>
                                </div>
                            <?php } ?>
                        </td>

                        <td class="text-center p-2">
                            <?php if ($ubah == 1) { ?>
                                <button type="button" onclick="toggle('<?= $data['poling_id'] ?>')" class="btn btn-circle btn-sm btn-light" title="<?= $data['status'] == 'Y' ? 'Non Aktifkan' : 'Aktifkan' ?>"><i class="<?= $data['status'] == 'Y' ? 'fas fa-check-circle text-success' : 'far fa-eye text-danger' ?>"></i></button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-circle btn-sm btn-light" title="<?= $data['status'] == 'Y' ? 'Non Aktifkan' : 'Aktifkan' ?>"><i class="<?= $data['status'] == 'Y' ? 'fas fa-check-circle text-success' : 'far fa-eye text-danger' ?>"></i></button>
                            <?php } ?>
                            <?php if ($ubah == 1) { ?>
                                <button type="button" class="btn btn-light btn-sm" onclick="edit('<?= $data['poling_id'] ?>')">
                                    <i class="icon fas fa-edit text-primary"></i>
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-light btn-sm ">
                                    <i class="icon fas fa-edit text-secondary"></i>
                                </button>
                            <?php } ?>
                            <?php if ($hapus == 1) { ?>

                                <?php if ($data['type'] == 'Pertanyaan' && $jjawab == 0) { ?>
                                    <button type="button" class="btn btn-light btn-sm" onclick="hapus('<?= $data['poling_id'] ?>')">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                <?php } elseif ($data['type'] == 'Jawaban') { ?>
                                    <button type="button" class="btn btn-light btn-sm" onclick="hapus('<?= $data['poling_id'] ?>')">
                                        <i class="far fa-trash-alt text-danger"></i>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-light btn-sm ">
                                        <i class="icon far fa-trash-alt text-secondary"></i>
                                    </button>
                                <?php } ?>

                            <?php } else { ?>
                                <button type="button" class="btn btn-light btn-sm ">
                                    <i class="icon far fa-trash-alt text-secondary"></i>
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><b>PILIHAN</b></th>
                    <th class="text-center"><b>AKSI<b></th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php } else { ?>
    <center>
        <img class="" src="<?= base_url('public/template/backend/morvin/assets/images/err.png') ?>" alt="not found" width="200" height="100%">
        <!-- <div class="alert alert-danger mb-0" role="alert"> -->
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            Maaf, data polling untuk layanan <b><?= esc($nama) ?></b> saat ini tidak tersedia, Silakan lakukan <i class="fas fa-copy text-warning"></i> Duplikasi Polling <br>pada menu <a href="<?= base_url('layanan/all') ?>" class="alert-link">Layanan</a> untuk mulai menggunakannya.
        </div>
    </center>
<?php } ?>
<script>
    $(document).ready(function() {

        $('.tambahpoling').click(function(e) {
            e.preventDefault();
            informasi_id = $("#informasi_id").val();
            $.ajax({
                url: "<?= site_url('layanan/formtambahpol') ?>",
                data: {
                    informasi_id: informasi_id,
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal load data!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '';
                    })
                }
            });
        });


        var table = $('#listpoling').DataTable({
            "lengthChange": false,
            "ordering": false,
            "paging": false,
            "info": false,
            "searching": false,
            // "pagingType": "numbers",
        });
    });

    function edit(poling_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('poling/formedit') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                poling_id: poling_id
            },
            dataType: "json",
            success: function(response) {
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

            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }

    function hapus(poling_id) {
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
                    url: "<?= site_url('poling/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        poling_id: poling_id
                    },

                    success: function(response) {
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
                            listpoling();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        Swal.fire({
                            title: "Maaf gagal hapus data!",
                            html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3100
                        }).then(function() {
                            window.location = '';
                        })
                    }
                });
            }
        })
    }

    function toggle(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('poling/toggle') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: response.sukses,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    listpoling();
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }
</script>