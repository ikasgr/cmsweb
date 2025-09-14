<?= form_open('user/hapusall', ['class' => 'formhapus']) ?>
<?php
$db = \Config\Database::connect();
?>

<?php if ($hapus == 1) { ?>
    <button type="submit" class="btn btn-danger btn-sm tblhapus">
        <i class="far fa-trash-alt text-light"></i> Hapus yang dipilih
    </button>
<?php } ?>

<?php if ($tambah == 1) { ?>
    <button type="submit" class="btn btn-success btn-sm tambahuser">
        <i class="fas fa fa-plus-circle"></i> Tambah Baru
    </button>
<?php } ?>

<?php if ($akses == 1) { ?>
    <button type="button" class="btn btn-social btn-flat btn-warning btn-sm" onclick="location.href=('<?= base_url('log-sesi'); ?>')"><i class="fas fa-glasses"></i> Log Sesi</button>
    <a href="user/grup" button type="button" class="btn btn-primary btn-sm">
        <i class="fas fa-user-shield text-light"></i> Kelola Grup
    </a>
<?php } ?>

<hr>
<?php if ($list) { ?>
    <div class="table-responsive p-0 order-table">
        <table id="listuser" class="table table-hover table-striped table-bordered">

            <thead class="badge-soft-secondary">
                <tr>
                    <th width="5">
                        <input type="checkbox" id="centangSemua" class="text-center">
                    </th>
                    <th width="30"><b>Foto</b></th>
                    <th width="85"><b>User Name</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Email</b></th>
                    <th width="70"><b>Role Grup</b></th>
                    <th width="95"><b>Last Login</b></th>
                    <th width="120" class="text-center"><b>Aksi</b> </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $listGroupData  = $db->table('cms__usergrup')->whereIn('id_grup', array_column($list, 'id_grup'))->get()->getResultArray();
                $opdData        = $db->table('custome__opd')->whereIn('opd_id', array_column($list, 'opd_id'))->where('opd_id !=', 0)->get()->getResultArray();
                $listGroupMap   = array_column($listGroupData, null, 'id_grup');
                $opdMap         = array_column($opdData, null, 'opd_id');
                $jtogel1        = '1'; // lock akses
                $jtogel2        = '2'; // reset akses

                foreach ($list as $value) :
                    $profil         = ($value['user_image'] != 'default.png' && file_exists('public/img/user/' . $value['user_image'])) ? $value['user_image'] : 'default.png';
                    $listgrup       = $listGroupMap[$value['id_grup']] ?? null;
                    $viewopd        = $opdMap[$value['opd_id']] ?? null;
                    $namagrup       = $listgrup['nama_grup'] ?? '-';
                    $jenisgrp       = $listgrup['jenis'] ?? '';
                    $formattedDate  = convertDatetime($value["last_login"]);
                    $isActive       = $value['active'] == '1';
                    $btnToggleClass = $isActive ? 'btn-light' : 'btn-light';
                    $toggleTitle    = $isActive ? 'Non Aktifkan Akun' : 'Aktifkan Akun';
                    $toggleIcon     = $isActive ? 'fas fa-user-check text-success' : 'fas fa-user-alt-slash text-danger';
                    $cekon          = $db->table('cms__usersessions')->where('user_id', $value['id'])->get()->getRow();

                ?>
                    <tr>
                        <td><input type="checkbox" name="id[]" class="centangUserid" value="<?= $value['id'] ?>"></td>
                        <td><img class="img-circle elevation-2 rounded <?= $ubah == 1 ? 'pointer' : '' ?>" onclick="<?= $ubah == 1 ? "gantifoto('{$value['id']}')" : '' ?>" src="<?= base_url('public/img/user/' . $profil) ?>" width="40px"></td>
                        <td><?= $value['active'] != '1' ? "<a class='text-danger'>" . esc($value['username']) . "</a>" : esc($value['username']) ?>
                            <?php if ($cekon) { ?>
                                <span class="badge badge-soft-success font-size-12 badge-pill">
                                    <i class="mdi mdi-checkbox-blank-circle text-success"></i> Online
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-soft-warning font-size-12 badge-pill">
                                    <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Offline
                                </span>
                            <?php } ?>
                        </td>
                        <td><?= esc($value['fullname']) ?> <?= $viewopd ? "<br><a class='text-primary' title='Unit Kerja : " . esc($viewopd['nama_opd']) . "'>" . esc($viewopd['singkatan_opd']) . "</a>" : '' ?></td>
                        <td>
                            <?= $value['email'] ?><br>
                            <a class="badge badge-soft-<?= $value['login_attempts'] <= 2 ? 'info' : 'danger' ?> font-size-12 badge-pill pointer" <?= $ubah == 1 && $value['login_attempts'] >= 3 ? 'onclick="toggle(\'' . $value['id'] . '\', \'' . $jtogel2 . '\')"' : '' ?> title="Upaya Login">
                                <?= $value['login_attempts'] != '' ? ' (' . $value['login_attempts'] . ')' : '' ?>
                            </a>
                            <?php if ($akses == 1 && $value['otp_code'] != '') : ?>
                                <a class="badge badge-soft-primary font-size-12 badge-pill pointer" title="Kode OTP">
                                    <?= $value['otp_code'] ?>
                                </a>
                            <?php endif; ?>

                        </td>
                        <td><?= $namagrup ?></td>
                        <td><?= $formattedDate ?></td>
                        <td class="text-center">
                            <!-- Toggle Active/Inactive -->
                            <?php if ($ubah == 1) : ?>
                                <button type="button" onclick="toggle('<?= $value['id'] ?>', '<?= $jtogel1 ?>')" class="mt-2 btn btn-circle btn-sm <?= $btnToggleClass ?>" title="<?= $toggleTitle ?>">
                                    <i class="nav-icon <?= $toggleIcon ?>"></i>
                                </button>
                            <?php endif; ?>

                            <!-- View Statistics -->
                            <button type="button" class="mt-2 btn btn-light btn-sm p-1" title="Lihat Statistik Postingan" onclick="lihat('<?= $value['id'] ?>', '<?= $jenisgrp ?>')">
                                <i class="nav-icon fa fa-search text-info"></i>
                            </button>

                            <!-- Edit -->
                            <?php if ($ubah == 1) : ?>
                                <button type="button" class="mt-2 btn btn-light btn-sm p-1" onclick="edit('<?= $value['id'] ?>', '<?= $jenisgrp ?>')">
                                    <i class="fa fa-edit text-warning"></i>
                                </button>
                            <?php else : ?>
                                <button type="button" class="mt-2 btn btn-light btn-sm p-1" disabled>
                                    <i class="fa fa-edit text-secondary"></i>
                                </button>
                            <?php endif; ?>

                            <!-- Delete -->
                            <?php if ($jenisgrp != '1' && $hapus == 1) : ?>
                                <button type="button" class="mt-2 btn btn-light btn-sm p-1" onclick="hapus('<?= $value['id'] ?>', '<?= esc($value['fullname']) ?>')">
                                    <i class="far fa-trash-alt text-danger"></i>
                                </button>
                            <?php else : ?>
                                <button type="button" class="mt-2 btn btn-light btn-sm p-1" disabled>
                                    <i class="far fa-trash-alt text-secondary"></i>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


            <tfoot>
                <tr>
                    <th>
                        <input type="checkbox" class="text-center" disabled>
                    </th>
                    <th><b>Foto</b></th>
                    <th><b>User Name</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Email</b></th>
                    <th><b>Role Grup</b></th>
                    <th><b>Last Login</b></th>
                    <th class="text-center"><b>Aksi</b> </th>

                </tr>
            </tfoot>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-danger text-center">Data pengguna tidak ditemukan.</div>
<?php } ?>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        // $('#listuser').DataTable();
        var table = $('#listuser').DataTable({
            "ordering": false,

        });
        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangUserid').prop('checked', true);
            } else {
                $('.centangUserid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangUserid:checked');
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
                    title: `Apakah anda yakin ingin menghapus ${jmldata.length} user?`,
                    text: 'Semua user yang terpilih akan terhapus!',
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
                                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                                listuser();
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

    function edit(id, jenisgrp) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/formedit') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id,
                jenisgrp: jenisgrp
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                    $('#modaledit').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
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

    function lihat(id, jenisgrp) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/formlihat') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id,
                jenisgrp: jenisgrp
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modallihat').modal('show');
                    $('#modallihat').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
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

    function hapus(id, nama) {
        Swal.fire({

            html: `Apakah anda yakin menghapus <strong>${nama}</strong> ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('user/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id: id
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
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            listuser();
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

    //tambah data
    $(document).ready(function() {

        $('.tambahuser').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('user/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal('show');
                    $('#modaltambah').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                error: function(xhr, ajaxOptions, thrownerror) {
                    Swal.fire({
                        title: "Maaf gagal load data!",
                        html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                        icon: "error",
                        // showConfirmButton: false,
                        // timer: 3100
                    }).then(function() {
                        // window.location = '';
                    })
                }
            });
        });
    });

    //aktifnonaktif

    function toggle(id, jns) {
        $.ajax({
            type: "post",
            url: "<?= site_url('user/toggle') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id: id,
                jns: jns
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
                    listuser();
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

    function gantifoto(id) {

        $.ajax({
            type: "post",
            url: "<?= site_url('user/formgantifoto') ?>",
            data: {
                id: id,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                    $('#modalupload').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
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
</script>