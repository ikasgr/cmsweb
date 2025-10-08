<!-- Modal Edit Jadwal Ibadah -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('jadwal-ibadah/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal'] ?>">
            
            <div class="modal-body">
                <div class="row">
                    <!-- Informasi Dasar -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Informasi Dasar</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Jenis Ibadah <span class="text-danger">*</span></label>
                                    <select class="form-select" name="id_jenis_ibadah">
                                        <option value="">Pilih Jenis Ibadah</option>
                                        <?php foreach ($jenis_ibadah as $jenis): ?>
                                            <option value="<?= $jenis['id_jenis_ibadah'] ?>" <?= $jenis['id_jenis_ibadah'] == $data['id_jenis_ibadah'] ? 'selected' : '' ?>>
                                                <?= esc($jenis['nama_jenis']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback erroridJenisIbadah"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Judul Ibadah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="judul_ibadah" value="<?= esc($data['judul_ibadah']) ?>">
                                    <div class="invalid-feedback errorjudulIbadah"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
                                            <div class="invalid-feedback errortanggal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select" name="status">
                                                <option value="Terjadwal" <?= $data['status'] == 'Terjadwal' ? 'selected' : '' ?>>Terjadwal</option>
                                                <option value="Berlangsung" <?= $data['status'] == 'Berlangsung' ? 'selected' : '' ?>>Berlangsung</option>
                                                <option value="Selesai" <?= $data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                                <option value="Dibatalkan" <?= $data['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jam Mulai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="jam_mulai" value="<?= $data['jam_mulai'] ?>">
                                            <div class="invalid-feedback errorjamMulai"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="form-control" name="jam_selesai" value="<?= $data['jam_selesai'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tempat</label>
                                    <input type="text" class="form-control" name="tempat" value="<?= esc($data['tempat']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Maksimal Peserta</label>
                                    <input type="number" class="form-control" name="max_peserta" value="<?= $data['max_peserta'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tema & Liturgi -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-book"></i> Tema & Liturgi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Tema Ibadah</label>
                                    <input type="text" class="form-control" name="tema_ibadah" value="<?= esc($data['tema_ibadah']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Ayat Tema</label>
                                    <input type="text" class="form-control" name="ayat_tema" value="<?= esc($data['ayat_tema']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Liturgi</label>
                                    <textarea class="form-control" name="liturgi" rows="8"><?= esc($data['liturgi']) ?></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="3"><?= esc($data['keterangan']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recurring Settings -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-repeat"></i> Pengaturan Recurring
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_recurring" id="isRecurringEdit" <?= $data['is_recurring'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="isRecurringEdit">
                                <strong>Jadwal Berulang</strong> - Buat jadwal ini berulang secara otomatis
                            </label>
                        </div>

                        <div id="recurringSettingsEdit" style="display: <?= $data['is_recurring'] ? 'block' : 'none' ?>;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Tipe Pengulangan</label>
                                        <select class="form-select" name="recurring_type">
                                            <option value="">Pilih Tipe</option>
                                            <option value="Mingguan" <?= $data['recurring_type'] == 'Mingguan' ? 'selected' : '' ?>>Mingguan</option>
                                            <option value="Bulanan" <?= $data['recurring_type'] == 'Bulanan' ? 'selected' : '' ?>>Bulanan</option>
                                            <option value="Tahunan" <?= $data['recurring_type'] == 'Tahunan' ? 'selected' : '' ?>>Tahunan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Berakhir Pada</label>
                                        <input type="date" class="form-control" name="recurring_end" value="<?= $data['recurring_end'] ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Perhatian:</strong> Mengubah pengaturan recurring hanya akan mempengaruhi jadwal ini. Jadwal yang sudah dibuat sebelumnya tidak akan berubah.
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
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Toggle recurring settings
        $('#isRecurringEdit').change(function() {
            if ($(this).is(':checked')) {
                $('#recurringSettingsEdit').show();
            } else {
                $('#recurringSettingsEdit').hide();
            }
        });

        // Form submit
        $('.formedit').submit(function(e) {
            e.preventDefault();
            let form = this;
            
            $.ajax({
                type: "post",
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnUpdate').attr('disable', 'disabled');
                    $('.btnUpdate').html('<i class="fa fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function() {
                    $('.btnUpdate').removeAttr('disable');
                    $('.btnUpdate').html('<i class="fas fa-save"></i> Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.id_jenis_ibadah) {
                            $('#modaledit .erroridJenisIbadah').html(response.error.id_jenis_ibadah);
                            $('#modaledit select[name=id_jenis_ibadah]').addClass('is-invalid');
                        } else {
                            $('#modaledit .erroridJenisIbadah').html('');
                            $('#modaledit select[name=id_jenis_ibadah]').removeClass('is-invalid');
                        }

                        if (response.error.judul_ibadah) {
                            $('#modaledit .errorjudulIbadah').html(response.error.judul_ibadah);
                            $('#modaledit input[name=judul_ibadah]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errorjudulIbadah').html('');
                            $('#modaledit input[name=judul_ibadah]').removeClass('is-invalid');
                        }

                        if (response.error.tanggal) {
                            $('#modaledit .errortanggal').html(response.error.tanggal);
                            $('#modaledit input[name=tanggal]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errortanggal').html('');
                            $('#modaledit input[name=tanggal]').removeClass('is-invalid');
                        }

                        if (response.error.jam_mulai) {
                            $('#modaledit .errorjamMulai').html(response.error.jam_mulai);
                            $('#modaledit input[name=jam_mulai]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errorjamMulai').html('');
                            $('#modaledit input[name=jam_mulai]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listjadwal();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>
