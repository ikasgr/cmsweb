<?= $this->extend('backend/' . esc($folder) . '/template-backend') ?>

<?= $this->section('menu') ?>
<?= $this->include('backend/' . esc($folder) . '/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-header font-18 bg-light">
                    <h6 class="modal-title mt-0">
                        <i class="fas fa-church"></i> <?= $title ?>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="viewdata"></div>
                </div>
                <div class="viewmodal"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        listsidi();
    });

    function listsidi() {
        $.ajax({
            url: "<?= site_url('pendaftaran-sidi/getdata') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);

                if (response.noakses) {
                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Modul ini</strong>`,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2500
                    });
                }

                if (response.blmakses) {
                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak terdaftar di Grup akses Anda. <br>
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Pendaftaran Sidi</strong> ke grup akses Anda.!`,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Tambah data
    $(document).on('click', '.tambah', function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('pendaftaran-sidi/formtambah') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').modal('show');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // Lihat detail
    function lihat(id_sidi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pendaftaran-sidi/formlihat') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_sidi: id_sidi
            },
            dataType: "json",
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

    // Edit data
    function edit(id_sidi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pendaftaran-sidi/formedit') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_sidi: id_sidi
            },
            dataType: "json",
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

    // Hapus data
    function hapus(id_sidi, nama) {
        Swal.fire({
            title: 'Hapus data?',
            html: `Yakin menghapus pendaftaran <strong>${nama}</strong>? <br>
            <small class="text-danger">Data dan dokumen akan terhapus permanen!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pendaftaran-sidi/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_sidi: id_sidi
                    },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listsidi();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Hapus multiple
    $(document).on('submit', '.formhapus', function (e) {
        e.preventDefault();
        let jmldata = $('.centangid:checked').length;

        if (jmldata === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Ooops!',
                text: 'Silahkan pilih data terlebih dahulu!',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                title: `Hapus ${jmldata} data?`,
                text: 'Data dan dokumen akan terhapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('pendaftaran-sidi/hapusall') ?>",
                        type: "post",
                        dataType: "json",
                        data: $(this).serialize(),
                        success: function (response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                listsidi();
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        }
        return false;
    });

    // Toggle status
    function toggle(id_sidi) {
        Swal.fire({
            title: 'Ubah Status?',
            html: `Pilih status pendaftaran:`,
            icon: 'question',
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Setujui',
            denyButtonText: '<i class="fas fa-times"></i> Tolak',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#28a745',
            denyButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            let status = null;
            if (result.isConfirmed) {
                status = '1'; // Disetujui
            } else if (result.isDenied) {
                status = '2'; // Ditolak
            }

            if (status !== null) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('pendaftaran-sidi/toggle') ?>",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_sidi: id_sidi,
                        status: status
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listsidi();
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Upload dokumen
    function uploaddok(id_sidi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pendaftaran-sidi/formupload') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_sidi: id_sidi
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Hapus file dokumen
    function hapusfile(id_sidi, jenis_dok, nama) {
        Swal.fire({
            title: 'Hapus Dokumen?',
            html: `Yakin menghapus dokumen <strong>${jenis_dok}</strong> dari ${nama}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('pendaftaran-sidi/hapusfile') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_sidi: id_sidi,
                        jenis_dok: jenis_dok
                    },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listsidi();
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

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script
    src="<?= base_url('public/template/backend/' . esc($folder) . '/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script
    src="<?= base_url('public/template/backend/' . esc($folder) . '/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<?= $this->endSection() ?>