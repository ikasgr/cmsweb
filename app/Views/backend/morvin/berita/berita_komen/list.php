<?php
$db = \Config\Database::connect();
?>

<?= form_open('berita/hapuskomenall', ['class' => 'formhapus']) ?>

<?php if ($hapus == 1) { ?>
    <button type="submit" class="btn btn-danger btn-sm tblhapus" id="tblhapus">
        <i class="far fa-trash-alt text-light"></i> Hapus yang diceklist
    </button>

    <hr>
<?php } ?>
<div class="table-responsive b-0 ">
    <table id="listkomen" class="table table-hover table-striped table-bordered">

        <thead class="bg-info text-light">
            <tr>
                <th width="3">
                    <input type="checkbox" id="centangSemua" class="text-center pointer">
                </th>
                <th>Berita</th>
                <th>Nama</th>
                <th>Komentar</th>
                <th width="110" class="text-center">Tanggal Komen</th>
                <th width="80" class="text-center">Aksi </th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list as $value) :

                $berita = $db->table('berita')->where('berita_id', $value['berita_id'])->orderBy('berita_id', 'ASC')->get()->getResultArray();
                if ($berita) {
                    foreach ($berita as $databerita) {
                    };
                    $slug = $databerita['slug_berita'];
                    $judul = $databerita['judul_berita'];
                } else {
                    $slug = '';
                    $judul = '';
                }
                $tglkomen  = convertDatetime($value["tanggal_komen"]);

            ?>
                <tr>
                    <td>
                        <input type="checkbox" name="beritakomen_id[]" class="centangid mt-3" value="<?= $value['beritakomen_id'] ?>">
                    </td>
                    <td>
                        <?= $value['sts_komen'] == '0'
                            ? "<b><a href='" . base_url($slug) . "' target='_blank' class='text-primary' title='" . ($value['balas_komen'] ?? '') . "'>$judul</a></b>"
                            : "<a href='" . base_url($slug) . "' target='_blank' class='text-primary' title='" . ($value['balas_komen'] ?? '') . "'>$judul</a>" ?>
                    </td>

                    <td>
                        <?= $value['sts_komen'] == '0' ? "<b>" . htmlentities($value['nama_komen']) . "</b>" : htmlentities($value['nama_komen']) ?>
                    </td>

                    <td>
                        <?= $value['sts_komen'] == '0' ? "<b>" . htmlentities($value['isi_komen']) . "</b>" : htmlentities($value['isi_komen']) ?>
                    </td>

                    <td>
                        <?= $value['sts_komen'] == '0' ? "<b>$tglkomen</b>" : $tglkomen ?>
                    </td>

                    <td class="text-center p-0">
                        <button type="button" onclick="" class="mt-3 btn btn-sm <?= $value['sts_komen'] == '1' ? 'btn-light text-success' : 'btn-light text-danger' ?>" title="<?= $value['sts_komen'] == '1' ? 'Telah ditanggapi' : 'Belum ditanggapi' ?>">
                            <i class="fas <?= $value['sts_komen'] == '1' ? 'fa-check-circle' : 'fa-arrow-circle-right' ?> font-20"></i>
                        </button>
                        <?php if ($ubah == 1) { ?>
                            <button type="button" class="mt-3 btn btn-light btn-sm" onclick="edit('<?= $value['beritakomen_id'] ?>')">
                                <i class="fas fa-reply-all text-primary"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="mt-3 btn btn-light btn-sm">
                                <i class="fas fa-reply-all text-secondary"></i>
                            </button>
                        <?php } ?>
                        <?php if ($hapus == 1) { ?>
                            <button type="button" class="mt-3 btn btn-light btn-sm" onclick="hapus('<?= $value['beritakomen_id'] ?>','<?= htmlentities($value['nama_komen']) ?>')">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="mt-3 btn btn-light btn-sm">
                                <i class="far fa-trash-alt text-secondary"></i>
                            </button>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>

                <th>
                    <input type="checkbox" class="text-center" disabled>
                </th>
                <!-- <th>#</th> -->
                <th>Berita</th>
                <th>Nama</th>
                <th>Komentar</th>
                <th>Tanggal Komen</th>

                <th class="text-center">Aksi</th>

            </tr>
        </tfoot>
    </table>
</div>

<?= form_close() ?>

<script>
    $(document).ready(function() {

        var table = $('#listkomen').DataTable({
            // "lengthChange": false,
            "ordering": false,
            // "paging": false,
            // "info": false,
            // "searching": false,
            // "pagingType": "numbers",
        });
        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangid').prop('checked', true);
            } else {
                $('.centangid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangid:checked');
            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500,
                })

            } else {
                Swal.fire({
                    title: `Apakah anda yakin ingin menghapus ${jmldata.length} data ini?`,
                    text: 'Semua data yang terpilih akan terhapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('.tblhapus').attr('disable', 'disable');
                                $('.tblhapus').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                            },
                            complete: function() {
                                $('.tblhapus').removeAttr('disable', 'disable');
                                $('.tblhapus').html('<i class="far fa-trash-alt text-light"></i>  Hapus yang diceklist');
                            },
                            success: function(response) {
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
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                                listkomen();
                                listkomennew();
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
        });
    });

    function edit(beritakomen_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('berita/formkomenback') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                beritakomen_id: beritakomen_id
            },
            dataType: "json",
            success: function(response) {
                if (response.noakses) {

                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses<strong>Modul ini</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '../dashboard';
                    })
                }
                if (response.blmakses) {

                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak didaftarkan `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '../dashboard';
                    })
                }
                if (response.sukses) {

                    $('.viewmodal').html(response.sukses).show();
                    $('#modalkomen').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                    $('#modalkomen').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }

    function hapus(beritakomen_id, nama) {

        Swal.fire({
            html: `Yakin hapus komentar dari <strong>${nama}</strong> ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "<?= site_url('berita/hapuskomen') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        beritakomen_id: beritakomen_id,

                    },
                    success: function(response) {
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
                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            listkomen();
                            listkomennew();
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
</script>