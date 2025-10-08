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
                        <i class="fas fa-calendar-alt"></i> <?= $title ?>
                    </h6>
                    <div class="float-end">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="showCalendar()">
                            <i class="fas fa-calendar"></i> View Calendar
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="showDashboard()">
                            <i class="fas fa-chart-bar"></i> Dashboard
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

<!-- Modal Calendar -->
<div class="modal fade" id="modalcalendar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-alt"></i> Calendar Jadwal Ibadah
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        listjadwal();
    });

    function listjadwal() {
        $.ajax({
            url: "<?= site_url('jadwal-ibadah/getdata') ?>",
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
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Jadwal Ibadah</strong> ke grup akses Anda.!`,
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
            url: "<?= site_url('jadwal-ibadah/formtambah') ?>",
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
    function lihat(id_jadwal) {
        $.ajax({
            type: "post",
            url: "<?= site_url('jadwal-ibadah/formlihat') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jadwal: id_jadwal
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
    function edit(id_jadwal) {
        $.ajax({
            type: "post",
            url: "<?= site_url('jadwal-ibadah/formedit') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                id_jadwal: id_jadwal
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
    function hapus(id_jadwal, judul) {
        Swal.fire({
            title: 'Hapus jadwal?',
            html: `Yakin menghapus jadwal <strong>${judul}</strong>? <br>
            <small class="text-danger">Data pelayan, musik, dan pengumuman akan ikut terhapus!</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('jadwal-ibadah/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_jadwal: id_jadwal
                    },
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listjadwal();
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
                title: `Hapus ${jmldata} jadwal?`,
                text: 'Data pelayan, musik, dan pengumuman akan ikut terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('jadwal-ibadah/hapusall') ?>",
                        type: "post",
                        dataType: "json",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.sukses) {
                                toastr.success(response.sukses);
                                listjadwal();
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
    function toggle(id_jadwal, judul) {
        Swal.fire({
            title: 'Ubah Status Jadwal',
            html: `Pilih status untuk <strong>${judul}</strong>:`,
            icon: 'question',
            input: 'select',
            inputOptions: {
                'Terjadwal': 'Terjadwal',
                'Berlangsung': 'Berlangsung',
                'Selesai': 'Selesai',
                'Dibatalkan': 'Dibatalkan'
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
                    url: "<?= site_url('jadwal-ibadah/toggle') ?>",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_jadwal: id_jadwal,
                        status: result.value
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listjadwal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Copy jadwal
    function copy(id_jadwal, judul) {
        Swal.fire({
            title: 'Copy Jadwal',
            html: `Copy jadwal <strong>${judul}</strong> ke tanggal:`,
            input: 'date',
            inputLabel: 'Pilih tanggal baru',
            showCancelButton: true,
            confirmButtonText: 'Copy Jadwal',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Tanggal harus diisi!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('jadwal-ibadah/copy') ?>",
                    data: {
                        csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                        id_jadwal: id_jadwal,
                        tanggal_baru: result.value
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            toastr.success(response.sukses);
                            listjadwal();
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Show Calendar
    function showCalendar() {
        $('#modalcalendar').modal('show');
        
        // Initialize FullCalendar
        setTimeout(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                editable: false,
                eventLimit: true,
                events: {
                    url: '<?= site_url('jadwal-ibadah/getcalendar') ?>',
                    type: 'GET',
                    error: function() {
                        alert('Error loading calendar events!');
                    }
                },
                eventClick: function(event) {
                    lihat(event.id);
                    $('#modalcalendar').modal('hide');
                }
            });
        }, 500);
    }

    // Show Dashboard
    function showDashboard() {
        $.ajax({
            url: "<?= site_url('jadwal-ibadah/dashboard') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Search jadwal
    $(document).on('submit', '.formsearch', function(e) {
        e.preventDefault();
        let keyword = $('#keyword').val();
        if (keyword.length < 3) {
            toastr.warning('Masukkan minimal 3 karakter untuk pencarian');
            return;
        }
        
        $.ajax({
            url: "<?= site_url('jadwal-ibadah/search') ?>",
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

    // Filter by month
    $(document).on('change', '#filterBulan, #filterTahun', function() {
        let bulan = $('#filterBulan').val();
        let tahun = $('#filterTahun').val();
        
        if (bulan && tahun) {
            $.ajax({
                url: "<?= site_url('jadwal-ibadah/filterbymonth') ?>",
                type: "post",
                dataType: "json",
                data: {
                    csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                    bulan: bulan,
                    tahun: tahun
                },
                success: function(response) {
                    $('.viewdata').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    });

    // Reset filter
    function resetFilter() {
        $('#keyword').val('');
        $('#filterBulan').val('');
        $('#filterTahun').val('');
        listjadwal();
    }
</script>

<?= $this->endSection() ?>
