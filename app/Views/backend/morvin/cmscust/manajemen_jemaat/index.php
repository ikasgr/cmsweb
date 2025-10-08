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
                        <i class="fas fa-users"></i> <?= $title ?>
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
        listjemaat();
    });

    function listjemaat() {
        $.ajax({
            url: "<?= site_url('manajemen-jemaat/getdata') ?>",
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
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Manajemen Jemaat</strong> ke grup akses Anda.!`,
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
            url: "<?= site_url('manajemen-jemaat/formtambah') ?>",
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
    function lihat(id_jemaat) {
        $.ajax({
            type: "post",
            url: "<?= site_url('manajemen-jemaat/formlihat') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jemaat: id_jemaat
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
    function edit(id_jemaat) {
        $.ajax({
            type: "post",
            url: "<?= site_url('manajemen-jemaat/formedit') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jemaat: id_jemaat
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
    function hapus(id_jemaat, nama) {
        Swal.fire({
            title: 'Hapus data?',
            html: `Yakin menghapus data jemaat <strong>${nama}</strong>? <br>
            <small class="text-danger">Data dan foto akan terhapus permanen!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('manajemen-jemaat/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_jemaat: id_jemaat
                    },
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listjemaat();
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
                text: 'Data dan foto akan terhapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('manajemen-jemaat/hapusall') ?>",
                        type: "post",
                        dataType: "json",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                listjemaat();
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
    function toggle(id_jemaat, nama) {
        Swal.fire({
            title: 'Ubah Status Keanggotaan',
            html: `Pilih status untuk <strong>${nama}</strong>:`,
            icon: 'question',
            input: 'select',
            inputOptions: {
                'Aktif': 'Aktif',
                'Pindah': 'Pindah',
                'Meninggal': 'Meninggal',
                'Non-Aktif': 'Non-Aktif'
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
                let status = result.value;
                let tanggal = null;
                
                if (status === 'Pindah' || status === 'Meninggal') {
                    Swal.fire({
                        title: `Tanggal ${status}`,
                        input: 'date',
                        inputLabel: `Masukkan tanggal ${status.toLowerCase()}`,
                        showCancelButton: true,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Tanggal harus diisi!'
                            }
                        }
                    }).then((dateResult) => {
                        if (dateResult.isConfirmed) {
                            updateStatus(id_jemaat, status, dateResult.value);
                        }
                    });
                } else {
                    updateStatus(id_jemaat, status, null);
                }
            }
        });
    }

    function updateStatus(id_jemaat, status, tanggal) {
        $.ajax({
            type: "post",
            url: "<?= site_url('manajemen-jemaat/toggle') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jemaat: id_jemaat,
                status: status,
                tanggal: tanggal
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    toastr.success(response.sukses);
                    listjemaat();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Upload foto
    function uploadfoto(id_jemaat) {
        $.ajax({
            type: "post",
            url: "<?= site_url('manajemen-jemaat/formupload') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jemaat: id_jemaat
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Hapus foto
    function hapusfoto(id_jemaat, nama) {
        Swal.fire({
            title: 'Hapus Foto?',
            html: `Yakin menghapus foto <strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('manajemen-jemaat/hapusfoto') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_jemaat: id_jemaat
                    },
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listjemaat();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Cari jemaat
    $(document).on('submit', '.formcari', function(e) {
        e.preventDefault();
        let keyword = $('#keyword').val();
        if (keyword.length < 3) {
            toastr.warning('Masukkan minimal 3 karakter untuk pencarian');
            return;
        }
        
        $.ajax({
            url: "<?= site_url('manajemen-jemaat/cari') ?>",
            type: "post",
            dataType: "json",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                keyword: keyword
            },
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // Reset pencarian
    function resetCari() {
        $('#keyword').val('');
        listjemaat();
    }
</script>

<?= $this->endSection() ?>
