<?= $this->extend('backend/template-backend') ?>

<?= $this->section('menu') ?>
<?= $this->include('backend/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4>Kelola Pesanan UMKM</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pesanan UMKM</li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <a href="<?= base_url('pesanan-umkm/dashboard') ?>" class="btn btn-info btn-sm">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                    <a href="<?= base_url('pesanan-umkm/export') ?>" class="btn btn-success btn-sm" target="_blank">
                        <i class="fas fa-file-excel"></i> Export
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Data Pesanan</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="button" class="btn btn-danger btn-sm btnhapusall" disabled>
                                    <i class="far fa-trash-alt"></i> Hapus Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Status -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary filter-status active"
                                        data-status="">
                                        <i class="fas fa-list"></i> Semua
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning filter-status"
                                        data-status="Pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-info filter-status"
                                        data-status="Diproses">
                                        <i class="fas fa-cog"></i> Diproses
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-primary filter-status"
                                        data-status="Dikirim">
                                        <i class="fas fa-shipping-fast"></i> Dikirim
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success filter-status"
                                        data-status="Selesai">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger filter-status"
                                        data-status="Dibatalkan">
                                        <i class="fas fa-times-circle"></i> Dibatalkan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="listpesanan" class="table table-striped table-bordered dt-responsive nowrap"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th width="30">
                                            <input type="checkbox" id="centangSemua" class="form-check-input">
                                        </th>
                                        <th width="50">No</th>
                                        <th width="150">Kode Pesanan</th>
                                        <th width="150">Tanggal</th>
                                        <th>Pembeli</th>
                                        <th width="120">No. HP</th>
                                        <th width="80" class="text-center">Item</th>
                                        <th width="120" class="text-right">Total</th>
                                        <th width="100" class="text-center">Status</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="viewmodal"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div class="modal fade" id="modalstatus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Update Status Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= form_open('', ['class' => 'formstatus']) ?>
            <input type="hidden" name="pesanan_id" id="pesanan_id_status">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Status Pesanan <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Pending">Pending</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Dikirim">Dikirim</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                    <div class="invalid-feedback errorstatus"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"
                        placeholder="Keterangan update status (opsional)"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btnupdatestatus">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    var currentStatus = '';

    $(document).ready(function () {
        var table = $('#listpesanan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pesanan-umkm/getdata') ?>',
                type: 'GET',
                data: function (d) {
                    d.status = currentStatus;
                }
            },
            columns: [
                {
                    data: 'pesanan_id',
                    orderable: false,
                    render: function (data) {
                        return '<input type="checkbox" class="form-check-input centangid" name="pesanan_id[]" value="' + data + '">';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'kode_pesanan',
                    render: function (data) {
                        return '<strong class="text-primary">' + data + '</strong>';
                    }
                },
                {
                    data: 'tgl_pesanan',
                    render: function (data) {
                        return moment(data).format('DD/MM/YYYY HH:mm');
                    }
                },
                {
                    data: 'nama_pembeli',
                    render: function (data, type, row) {
                        return '<div><strong>' + data + '</strong><br><small class="text-muted">' + row.alamat.substring(0, 50) + '...</small></div>';
                    }
                },
                {
                    data: 'no_hp'
                },
                {
                    data: 'total_item',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return '<span class="badge bg-info">' + data + ' item (' + row.total_qty + ' pcs)</span>';
                    }
                },
                {
                    data: 'total_bayar',
                    className: 'text-right',
                    render: function (data) {
                        return '<strong>Rp ' + new Intl.NumberFormat('id-ID').format(data) + '</strong>';
                    }
                },
                {
                    data: 'status_pesanan',
                    className: 'text-center',
                    render: function (data) {
                        var badge = '';
                        switch (data) {
                            case 'Pending':
                                badge = '<span class="badge bg-warning">Pending</span>';
                                break;
                            case 'Diproses':
                                badge = '<span class="badge bg-info">Diproses</span>';
                                break;
                            case 'Dikirim':
                                badge = '<span class="badge bg-primary">Dikirim</span>';
                                break;
                            case 'Selesai':
                                badge = '<span class="badge bg-success">Selesai</span>';
                                break;
                            case 'Dibatalkan':
                                badge = '<span class="badge bg-danger">Dibatalkan</span>';
                                break;
                        }
                        return badge;
                    }
                },
                {
                    data: 'pesanan_id',
                    orderable: false,
                    className: 'text-center',
                    render: function (data, type, row) {
                        return `
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-info" onclick="lihat('${data}')" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-warning" onclick="updateStatus('${data}', '${row.status_pesanan}')" title="Update Status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-success" onclick="printInvoice('${data}')" title="Print">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="hapus('${data}', '${row.kode_pesanan}')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            order: [[3, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            }
        });

        // Filter by status
        $('.filter-status').click(function () {
            $('.filter-status').removeClass('active');
            $(this).addClass('active');
            currentStatus = $(this).data('status');
            table.ajax.reload();
        });

        // Centang semua
        $('#centangSemua').click(function () {
            $('.centangid').prop('checked', this.checked);
            toggleHapusAll();
        });

        $(document).on('change', '.centangid', function () {
            toggleHapusAll();
        });

        function toggleHapusAll() {
            var checked = $('.centangid:checked').length;
            $('.btnhapusall').prop('disabled', checked === 0);
        }

        // Hapus multiple
        $('.btnhapusall').click(function () {
            var pesanan_id = [];
            $('.centangid:checked').each(function () {
                pesanan_id.push($(this).val());
            });

            if (pesanan_id.length === 0) {
                Swal.fire('Perhatian', 'Pilih data yang akan dihapus', 'warning');
                return;
            }

            Swal.fire({
                title: 'Hapus ' + pesanan_id.length + ' pesanan?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('pesanan-umkm/hapusall') ?>',
                        type: 'POST',
                        data: {
                            pesanan_id: pesanan_id,
                            <?= csrf_token() ?>: $('input[name=<?= csrf_token() ?>]').val()
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.sukses) {
                                Swal.fire('Berhasil!', response.sukses, 'success');
                                table.ajax.reload();
                                $('input[name=<?= csrf_token() ?>]').val(response.csrf_tokencmsikasmedia);
                            }
                        }
                    });
                }
            });
        });

        // Update status
        $('.formstatus').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('pesanan-umkm/updatestatus') ?>',
                type: 'POST',
                data: $(this).serialize() + '&<?= csrf_token() ?>=' + $('input[name=<?= csrf_token() ?>]').val(),
                dataType: 'json',
                beforeSend: function () {
                    $('.btnupdatestatus').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
                },
                success: function (response) {
                    if (response.sukses) {
                        Swal.fire('Berhasil!', response.sukses, 'success');
                        $('#modalstatus').modal('hide');
                        table.ajax.reload();
                        $('input[name=<?= csrf_token() ?>]').val(response.csrf_tokencmsikasmedia);
                    }
                },
                complete: function () {
                    $('.btnupdatestatus').prop('disabled', false).html('<i class="fas fa-save"></i> Update Status');
                }
            });
        });
    });

    function lihat(pesanan_id) {
        $.ajax({
            url: '<?= base_url('pesanan-umkm/formlihat') ?>',
            type: 'POST',
            data: {
                pesanan_id: pesanan_id,
                <?= csrf_token() ?>: $('input[name=<?= csrf_token() ?>]').val()
            },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses);
                    $('#modallihat').modal('show');
                }
            }
        });
    }

    function updateStatus(pesanan_id, current_status) {
        $('#pesanan_id_status').val(pesanan_id);
        $('#status').val(current_status);
        $('#modalstatus').modal('show');
    }

    function printInvoice(pesanan_id) {
        window.open('<?= base_url('pesanan-umkm/print/') ?>' + pesanan_id, '_blank');
    }

    function hapus(pesanan_id, kode) {
        Swal.fire({
            title: 'Hapus Pesanan?',
            html: 'Pesanan <strong>' + kode + '</strong> akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('pesanan-umkm/hapus') ?>',
                    type: 'POST',
                    data: {
                        pesanan_id: pesanan_id,
                        <?= csrf_token() ?>: $('input[name=<?= csrf_token() ?>]').val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.sukses) {
                            Swal.fire('Berhasil!', response.sukses, 'success');
                            $('#listpesanan').DataTable().ajax.reload();
                            $('input[name=<?= csrf_token() ?>]').val(response.csrf_tokencmsikasmedia);
                        } else if (response.error) {
                            Swal.fire('Gagal!', response.error, 'error');
                        }
                    }
                });
            }
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<?= $this->endSection() ?>