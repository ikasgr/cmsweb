<?= $this->extend('backend/' . esc($folder) . '/script') ?>
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
                        <i class="fas fa-user-tie"></i> <?= $title ?>
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
    $(document).ready(function() {
        listmajelis();
    });

    function listmajelis() {
        $.ajax({
            url: "<?= site_url('majelis-gereja/getdata') ?>",
            dataType: "json",
            success: function(response) {
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
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Majelis Gereja</strong> ke grup akses Anda.!`,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Tambah data
    $(document).on('click', '.tambah', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('majelis-gereja/formtambah') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // Lihat detail
    function lihat(majelis_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('majelis-gereja/formlihat') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                majelis_id: majelis_id
            },
            dataType: "json",
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

    // Edit data
    function edit(majelis_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('majelis-gereja/formedit') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                majelis_id: majelis_id
            },
            dataType: "json",
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

    // Hapus data
    function hapus(majelis_id, nama) {
        Swal.fire({
            title: 'Hapus data?',
            html: `Yakin menghapus data majelis <strong>${nama}</strong>? <br>
            <small class="text-danger">Data dan file akan terhapus permanen!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('majelis-gereja/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        majelis_id: majelis_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listmajelis();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Hapus multiple
    $(document).on('submit', '.formhapus', function(e) {
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
                text: 'Data dan file akan terhapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('majelis-gereja/hapusall') ?>",
                        type: "post",
                        dataType: "json",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                listmajelis();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        }
        return false;
    });

    // Toggle status
    function toggle(majelis_id, nama) {
        Swal.fire({
            title: 'Ubah Status Jabatan',
            html: `Pilih status untuk <strong>${nama}</strong>:`,
            icon: 'question',
            input: 'select',
            inputOptions: {
                'Aktif': 'Aktif',
                'Non-Aktif': 'Non-Aktif',
                'Masa Percobaan': 'Masa Percobaan',
                'Habis Masa Jabatan': 'Habis Masa Jabatan'
            },
            inputPlaceholder: 'Pilih status',
            showCancelButton: true,
            confirmButtonText: 'Ubah Status',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus memilih status!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('majelis-gereja/toggle') ?>",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        majelis_id: majelis_id,
                        status: result.value
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listmajelis();
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

<?= $this->endSection() ?>
