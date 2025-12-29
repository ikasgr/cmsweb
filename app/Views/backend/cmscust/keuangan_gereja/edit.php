<!-- Modal Edit Transaksi Keuangan -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('keuangan-gereja/update', ['class' => 'formupdate']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi'] ?>">

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
                                    <input type="text" class="form-control" value="<?= $data['kode_transaksi'] ?>"
                                        readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Transaksi <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_transaksi" id="jenisTransaksiEdit">
                                        <option value="">Pilih Jenis Transaksi</option>
                                        <option value="Pemasukan" <?= $data['jenis_transaksi'] == 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                                        <option value="Pengeluaran" <?= $data['jenis_transaksi'] == 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" name="id_kategori" id="kategoriSelectEdit">
                                        <option value="">Pilih jenis transaksi dulu</option>
                                    </select>
                                    <div class="invalid-feedback erroridKategori"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal Transaksi <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal_transaksi"
                                                value="<?= $data['tanggal_transaksi'] ?>">
                                            <div class="invalid-feedback errortanggalTransaksi"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jumlah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control currency" name="jumlah"
                                                value="<?= number_format($data['jumlah'], 0, ',', '.') ?>"
                                                placeholder="0">
                                            <div class="invalid-feedback errorjumlah"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Metode Pembayaran</label>
                                    <select class="form-select" name="metode_pembayaran">
                                        <option value="Tunai" <?= $data['metode_pembayaran'] == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                                        <option value="Transfer" <?= $data['metode_pembayaran'] == 'Transfer' ? 'selected' : '' ?>>Transfer Bank</option>
                                        <option value="Cek" <?= $data['metode_pembayaran'] == 'Cek' ? 'selected' : '' ?>>
                                            Cek</option>
                                        <option value="Kartu" <?= $data['metode_pembayaran'] == 'Kartu' ? 'selected' : '' ?>>Kartu Debit/Kredit</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>No. Referensi</label>
                                    <input type="text" class="form-control" name="no_referensi"
                                        value="<?= $data['no_referensi'] ?>"
                                        placeholder="No. transfer, cek, dll (opsional)">
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
                                <div class="form-group mb-3" id="sumberDanaGroupEdit" style="display: none;">
                                    <label>Sumber Dana</label>
                                    <input type="text" class="form-control" name="sumber_dana"
                                        value="<?= $data['sumber_dana'] ?>" placeholder="Dari mana dana ini berasal">
                                </div>

                                <div class="form-group mb-3" id="penerimaGroupEdit" style="display: none;">
                                    <label>Penerima</label>
                                    <input type="text" class="form-control" name="penerima"
                                        value="<?= $data['penerima'] ?>" placeholder="Kepada siapa dana ini diberikan">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Keterangan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="keterangan" rows="4"
                                        placeholder="Jelaskan detail transaksi ini"><?= $data['keterangan'] ?></textarea>
                                    <div class="invalid-feedback errorketerangan"></div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Catatan:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Perubahan data akan tercatat di log aktivitas</li>
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
                <button type="submit" class="btn btn-primary btnUpdate">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Data kategori
        const kategoriPemasukan = <?= json_encode($kategori_pemasukan) ?>;
        const kategoriPengeluaran = <?= json_encode($kategori_pengeluaran) ?>;
        const currentKategori = "<?= $data['id_kategori'] ?>";

        // Function to populate categories based on type
        function populateCategories(jenis, selected = '') {
            const kategoriSelect = $('#kategoriSelectEdit');
            kategoriSelect.empty();
            kategoriSelect.append('<option value="">Pilih Kategori</option>');

            if (jenis === 'Pemasukan') {
                kategoriPemasukan.forEach(function (kategori) {
                    const isSelected = kategori.id_kategori == selected ? 'selected' : '';
                    kategoriSelect.append(`<option value="${kategori.id_kategori}" style="color: ${kategori.warna}" ${isSelected}>${kategori.nama_kategori}</option>`);
                });
                $('#sumberDanaGroupEdit').show();
                $('#penerimaGroupEdit').hide();
            } else if (jenis === 'Pengeluaran') {
                kategoriPengeluaran.forEach(function (kategori) {
                    const isSelected = kategori.id_kategori == selected ? 'selected' : '';
                    kategoriSelect.append(`<option value="${kategori.id_kategori}" style="color: ${kategori.warna}" ${isSelected}>${kategori.nama_kategori}</option>`);
                });
                $('#sumberDanaGroupEdit').hide();
                $('#penerimaGroupEdit').show();
            } else {
                $('#sumberDanaGroupEdit').hide();
                $('#penerimaGroupEdit').hide();
            }
        }

        // Initialize form
        const currentJenis = $('#jenisTransaksiEdit').val();
        populateCategories(currentJenis, currentKategori);

        // Change jenis transaksi
        $('#jenisTransaksiEdit').change(function () {
            const jenis = $(this).val();
            populateCategories(jenis);
        });

        // Format currency input
        $('.currency').on('input', function () {
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(new Intl.NumberFormat('id-ID').format(value));
        });

        // Form submit
        $('.formupdate').submit(function (e) {
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
                beforeSend: function () {
                    $('.btnUpdate').attr('disable', 'disabled');
                    $('.btnUpdate').html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');
                },
                complete: function () {
                    $('.btnUpdate').removeAttr('disable');
                    $('.btnUpdate').html('<i class="fas fa-save"></i> Simpan Perubahan');

                    // Restore currency format
                    $('input[name="jumlah"]').val(new Intl.NumberFormat('id-ID').format(jumlahValue));
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.id_kategori) {
                            $('#modaledit .erroridKategori').html(response.error.id_kategori);
                            $('#modaledit select[name=id_kategori]').addClass('is-invalid');
                        } else {
                            $('#modaledit .erroridKategori').html('');
                            $('#modaledit select[name=id_kategori]').removeClass('is-invalid');
                        }

                        if (response.error.tanggal_transaksi) {
                            $('#modaledit .errortanggalTransaksi').html(response.error.tanggal_transaksi);
                            $('#modaledit input[name=tanggal_transaksi]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errortanggalTransaksi').html('');
                            $('#modaledit input[name=tanggal_transaksi]').removeClass('is-invalid');
                        }

                        if (response.error.jumlah) {
                            $('#modaledit .errorjumlah').html(response.error.jumlah);
                            $('#modaledit input[name=jumlah]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errorjumlah').html('');
                            $('#modaledit input[name=jumlah]').removeClass('is-invalid');
                        }

                        if (response.error.keterangan) {
                            $('#modaledit .errorketerangan').html(response.error.keterangan);
                            $('#modaledit textarea[name=keterangan]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errorketerangan').html('');
                            $('#modaledit textarea[name=keterangan]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listkeuangan();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset form when modal closed
        $('#modaledit').on('hidden.bs.modal', function () {
            // No need to reset logic since we fetch new data on open
        });
    });
</script>