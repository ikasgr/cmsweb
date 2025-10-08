<!-- Modal Tambah Transaksi Keuangan -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('keuangan-gereja/simpan', ['class' => 'formsimpan']) ?>
            <?= csrf_field(); ?>
            
            <div class="modal-body">
                <div class="row">
                    <!-- Informasi Dasar -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Informasi Transaksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Kode Transaksi</label>
                                    <input type="text" class="form-control" value="<?= $kode_transaksi_baru ?>" readonly>
                                    <small class="text-muted">Kode akan di-generate otomatis</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Transaksi <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_transaksi" id="jenisTransaksi">
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" name="id_kategori" id="kategoriSelect">
                                        <option value="">Pilih jenis transaksi dulu</option>
                                    </select>
                                    <div class="invalid-feedback erroridKategori"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal Transaksi <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal_transaksi" value="<?= date('Y-m-d') ?>">
                                            <div class="invalid-feedback errortanggalTransaksi"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jumlah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control currency" name="jumlah" placeholder="0">
                                            <div class="invalid-feedback errorjumlah"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Metode Pembayaran</label>
                                    <select class="form-select" name="metode_pembayaran">
                                        <option value="Tunai" selected>Tunai</option>
                                        <option value="Transfer">Transfer Bank</option>
                                        <option value="Cek">Cek</option>
                                        <option value="Kartu">Kartu Debit/Kredit</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>No. Referensi</label>
                                    <input type="text" class="form-control" name="no_referensi" placeholder="No. transfer, cek, dll (opsional)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Transaksi -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-file-alt"></i> Detail Transaksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3" id="sumberDanaGroup" style="display: none;">
                                    <label>Sumber Dana</label>
                                    <input type="text" class="form-control" name="sumber_dana" placeholder="Dari mana dana ini berasal">
                                </div>

                                <div class="form-group mb-3" id="penerimaGroup" style="display: none;">
                                    <label>Penerima</label>
                                    <input type="text" class="form-control" name="penerima" placeholder="Kepada siapa dana ini diberikan">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Keterangan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="keterangan" rows="4" placeholder="Jelaskan detail transaksi ini"></textarea>
                                    <div class="invalid-feedback errorketerangan"></div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Catatan:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Transaksi akan berstatus <strong>Pending</strong> dan perlu persetujuan</li>
                                        <li>Setelah disetujui, saldo kas akan otomatis terupdate</li>
                                        <li>Pastikan semua data sudah benar sebelum menyimpan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary btnSimpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Data kategori
        const kategoriPemasukan = <?= json_encode($kategori_pemasukan) ?>;
        const kategoriPengeluaran = <?= json_encode($kategori_pengeluaran) ?>;

        // Change jenis transaksi
        $('#jenisTransaksi').change(function() {
            const jenis = $(this).val();
            const kategoriSelect = $('#kategoriSelect');
            
            kategoriSelect.empty();
            kategoriSelect.append('<option value="">Pilih Kategori</option>');
            
            if (jenis === 'Pemasukan') {
                kategoriPemasukan.forEach(function(kategori) {
                    kategoriSelect.append(`<option value="${kategori.id_kategori}" style="color: ${kategori.warna}">${kategori.nama_kategori}</option>`);
                });
                $('#sumberDanaGroup').show();
                $('#penerimaGroup').hide();
            } else if (jenis === 'Pengeluaran') {
                kategoriPengeluaran.forEach(function(kategori) {
                    kategoriSelect.append(`<option value="${kategori.id_kategori}" style="color: ${kategori.warna}">${kategori.nama_kategori}</option>`);
                });
                $('#sumberDanaGroup').hide();
                $('#penerimaGroup').show();
            } else {
                $('#sumberDanaGroup').hide();
                $('#penerimaGroup').hide();
            }
        });

        // Format currency input
        $('.currency').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(new Intl.NumberFormat('id-ID').format(value));
        });

        // Form submit
        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            let form = this;
            
            // Clean currency format before submit
            let jumlahValue = $('input[name="jumlah"]').val().replace(/[^0-9]/g, '');
            $('input[name="jumlah"]').val(jumlahValue);
            
            $.ajax({
                type: "post",
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable');
                    $('.btnSimpan').html('<i class="fas fa-save"></i> Simpan');
                    
                    // Restore currency format
                    $('input[name="jumlah"]').val(new Intl.NumberFormat('id-ID').format(jumlahValue));
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.id_kategori) {
                            $('#modaltambah .erroridKategori').html(response.error.id_kategori);
                            $('#modaltambah select[name=id_kategori]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .erroridKategori').html('');
                            $('#modaltambah select[name=id_kategori]').removeClass('is-invalid');
                        }

                        if (response.error.tanggal_transaksi) {
                            $('#modaltambah .errortanggalTransaksi').html(response.error.tanggal_transaksi);
                            $('#modaltambah input[name=tanggal_transaksi]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errortanggalTransaksi').html('');
                            $('#modaltambah input[name=tanggal_transaksi]').removeClass('is-invalid');
                        }

                        if (response.error.jumlah) {
                            $('#modaltambah .errorjumlah').html(response.error.jumlah);
                            $('#modaltambah input[name=jumlah]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errorjumlah').html('');
                            $('#modaltambah input[name=jumlah]').removeClass('is-invalid');
                        }

                        if (response.error.keterangan) {
                            $('#modaltambah .errorketerangan').html(response.error.keterangan);
                            $('#modaltambah textarea[name=keterangan]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errorketerangan').html('');
                            $('#modaltambah textarea[name=keterangan]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaltambah').modal('hide');
                        listkeuangan();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset form when modal closed
        $('#modaltambah').on('hidden.bs.modal', function() {
            $('.formsimpan')[0].reset();
            $('#kategoriSelect').empty().append('<option value="">Pilih jenis transaksi dulu</option>');
            $('#sumberDanaGroup, #penerimaGroup').hide();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').html('');
        });
    });
</script>
