<a href="javascript:window.history.go(-1);" class="btn btn-warning btn-sm "><i
        class="far fa-arrow-alt-circle-left font-14"></i> Kembali</a>
<?php if ($hapus == 1) { ?>
    <small class="text-dark ml-2 mb-2"> Untuk menghapus data responden secara keseluruhan, silahkan klik pada tombol <b
            class="text-danger"><i class="fas fa-recycle "></i></b> pada list data survei..! </small>
<?php } ?>
<hr>
<?php $nomor = 0;
if ($list) { ?>
    <div class="table-responsive b-0 ">
        <table id="listsurveypesan" class="table table-hover table-striped table-bordered">
            <thead class="">
                <tr>
                    <th width="8"><b>#</b></th>
                    <th width="150"><b>RESPONDEN</b></th>
                    <th class="text-center" width="8"><b>JK</b></th>
                    <th class="text-center" width="8"><b>USIA</b></th>
                    <th width="90"><b>NO HP</b></th>
                    <th width="90"><b>PENDIDIKAN</b></th>
                    <th width="90"><b>PEKERJAAN</b></th>
                    <th width="150"><b>PESAN</b></th>
                    <th width="85"><b>TGL ISI</b></th>
                    <th width="8" class="text-center"><b>POIN</b></th>
                    <th width="4" class="text-center"><b>#</b></th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 0;

                # code...
            
                foreach ($list as $data):
                    $nomor++;
                    $nama_survey = esc($data['nama_survey']);
                    $id_pendidikan = esc($data['id_pendidikan']);
                    $id_pekerjaan = esc($data['id_pekerjaan']);
                    // $id_pendidikan  = 1;
            
                    if ($id_pendidikan) {
                        $idpend = $id_pendidikan;
                    } else {
                        $idpend = 0;
                    }

                    if ($id_pekerjaan) {
                        $idpek = $id_pekerjaan;
                    } else {
                        $idpek = 0;
                    }

                    $caripendikan = $nmbscontrol->find($idpend);
                    $caripekerjaan = $nmbscontrol->find($idpek);

                    if ($caripendikan) {
                        $pendidikan = esc($caripendikan['nama_master']);
                    } else {
                        $pendidikan = '-';
                    }
                    if ($caripekerjaan) {
                        $pekerjaan = esc($caripekerjaan['nama_master']);
                    } else {
                        $pekerjaan = '-';
                    }
                    ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td>
                            <?= esc($data['nama']) ?>
                        </td>
                        <td class="text-center">
                            <?= esc($data['jk']) ?>
                        </td>
                        <td class="text-center">
                            <?= esc($data['usia']) ?>
                        </td>
                        <td>
                            <?= esc($data['nohp']) ?>
                        </td>
                        <td>
                            <?= esc($pendidikan) ?>
                        </td>
                        <td>
                            <?= esc($pekerjaan) ?>
                        </td>
                        <td>
                            <?= esc($data['saran']) ?>
                        </td>

                        <td> <?= shortdate_indo($data['tanggal']) ?></td>
                        <td class="text-center">
                            <?= esc($data['jpoin']) ?>
                        </td>
                        <td class="text-center">
                            <?php if ($hapus == 1) { ?>
                                <button type="button" title="Hapus Data" class="btn btn-light btn-sm"
                                    onclick="hapus('<?= $data['responden_id'] ?>','<?= $data['survey_id'] ?>','<?= $data['jpoin'] ?>')">
                                    <i class="far fa-trash-alt text-danger"></i>
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-light btn-sm p-1">
                                    <i class="far fa-trash-alt text-secondary"></i>
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th><b>#<b></th>
                    <th><b>RESPONDEN</b></th>
                    <th class="text-center"><b>JK</b></th>
                    <th class="text-center"><b>USIA</b></th>
                    <th><b>NO HP</b></th>
                    <th><b>PENDIDIKAN</b></th>
                    <th><b>PEKERJAAN</b></th>
                    <th><b>PESAN</b></th>
                    <th><b>TGL ISI</b></th>
                    <th class="text-center"><b>POIN</b></th>
                    <th class="text-center"><b>AKSI<b></th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php } else {
    $nama_survey = '';
    ?>

    <div class="alert alert-danger mb-0" role="alert">
        Tidak ada data yang ditampilkan..!
    </div>
    <!-- <label for="">No Data</label> -->
<?php } ?>

<script>
    var table = $('#listsurveypesan').DataTable({
        lengthChange: false,
        "ordering": false,
        'iDisplayLength': 25,
        //  buttons: ['copy', 'excel', 'pdf', 'print'],
        buttons: [

            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> print',
                className: 'btn btn-sm btn-outline-dark mb-3',
                title: 'Respon ' + '<?= $nama_survey ?>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> excel',
                className: 'btn btn-sm btn-success mb-3',
                title: 'Respon ' + '<?= $nama_survey ?>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> copy',
                className: 'btn btn-sm btn-secondary mb-3',
                title: 'Respon ' + '<?= $nama_survey ?>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },

            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> pdf',
                className: 'btn btn-sm btn-danger mb-3',
                title: 'Respon ' + '<?= $nama_survey ?>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }

        ],
    });

    table.buttons().container()
        .appendTo('#listsurveypesan_wrapper .col-md-6:eq(0)');

    function hapus(responden_id, survey_id, jpoin) {
        Swal.fire({
            title: 'Hapus data?',
            // text: `Apakah anda yakin hapus data?`,
            html: `Apakah anda yakin menghapus data ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('survey/hapusrespon') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        responden_id: responden_id,
                        survey_id: survey_id,
                        jpoin: jpoin,
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
                            listsurveypesan();
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
</script>