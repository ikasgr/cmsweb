<?= $this->extend('backend/script') ?>
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
                        <i class="fas fa-money-bill-wave"></i> <?= $title ?>
                    </h6>
                    <div class="float-end">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="showDashboard()">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="showLaporan()">
                            <i class="fas fa-file-alt"></i> Laporan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="viewdata"></div>
                </div>
                <div class="viewmodal"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Laporan -->
<div class="modal fade" id="modallaporan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-alt"></i> Laporan Keuangan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" id="laporanTanggalMulai" value="<?= date('Y-m-01') ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" id="laporanTanggalSelesai" value="<?= date('Y-m-t') ?>">
                    </div>
                    <div class="col-md-4">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-primary" onclick="generateLaporan()">
                            <i class="fas fa-search"></i> Generate Laporan
                        </button>
                    </div>
                </div>
                <div id="laporanContent"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        listkeuangan();
    });

    function listkeuangan() {
        $.ajax({
            url: "<?= site_url('keuangan-gereja/getdata') ?>",
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
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Keuangan Gereja</strong> ke grup akses Anda.!`,
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
            url: "<?= site_url('keuangan-gereja/formtambah') ?>",
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
    function lihat(id_transaksi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('keuangan-gereja/formlihat') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_transaksi: id_transaksi
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
    function edit(id_transaksi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('keuangan-gereja/formedit') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_transaksi: id_transaksi
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
    function hapus(id_transaksi, kode) {
        Swal.fire({
            title: 'Hapus transaksi?',
            html: `Yakin menghapus transaksi <strong>${kode}</strong>? <br>
            <small class="text-danger">Data mutasi kas akan ikut terhapus!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('keuangan-gereja/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        id_transaksi: id_transaksi
                    },
                    success: function (response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listkeuangan();
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
                title: `Hapus ${jmldata} transaksi?`,
                text: 'Data mutasi kas akan ikut terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('keuangan-gereja/hapusall') ?>",
                        type: "post",
                        dataType: "json",
                        data: $(this).serialize(),
                        success: function (response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                listkeuangan();
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

    // Approve transaksi
    function approve(id_transaksi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('keuangan-gereja/formapprove') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_transaksi: id_transaksi
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalapprove').modal('show');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Show Dashboard
    function showDashboard() {
        $.ajax({
            url: "<?= site_url('keuangan-gereja/dashboard') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Show Laporan
    function showLaporan() {
        $('#modallaporan').modal('show');
    }

    // Generate Laporan
    function generateLaporan() {
        let tanggal_mulai = $('#laporanTanggalMulai').val();
        let tanggal_selesai = $('#laporanTanggalSelesai').val();

        if (!tanggal_mulai || !tanggal_selesai) {
            toastr.warning('Silahkan pilih periode laporan');
            return;
        }

        $.ajax({
            url: "<?= site_url('keuangan-gereja/laporan') ?>",
            type: "post",
            dataType: "json",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                tanggal_mulai: tanggal_mulai,
                tanggal_selesai: tanggal_selesai
            },
            success: function (response) {
                $('#laporanContent').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Search transaksi
    $(document).on('submit', '.formsearch', function (e) {
        e.preventDefault();
        let keyword = $('#keyword').val();
        if (keyword.length < 3) {
            toastr.warning('Masukkan minimal 3 karakter untuk pencarian');
            return;
        }

        $.ajax({
            url: "<?= site_url('keuangan-gereja/search') ?>",
            type: "post",
            dataType: "json",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                keyword: keyword
            },
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // Filter by periode
    $(document).on('submit', '.formfilter', function (e) {
        e.preventDefault();
        let tanggal_mulai = $('#filterTanggalMulai').val();
        let tanggal_selesai = $('#filterTanggalSelesai').val();

        if (!tanggal_mulai || !tanggal_selesai) {
            toastr.warning('Silahkan pilih periode filter');
            return;
        }

        $.ajax({
            url: "<?= site_url('keuangan-gereja/filterbyperiode') ?>",
            type: "post",
            dataType: "json",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                tanggal_mulai: tanggal_mulai,
                tanggal_selesai: tanggal_selesai
            },
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // Reset filter
    function resetFilter() {
        $('#keyword').val('');
        $('#filterTanggalMulai').val('');
        $('#filterTanggalSelesai').val('');
        listkeuangan();
    }

    // Format currency input
    $(document).on('input', '.currency', function () {
        let value = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(new Intl.NumberFormat('id-ID').format(value));
    });
</script>

<?= $this->endSection() ?>