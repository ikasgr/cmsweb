<!-- Modal Tambah Jadwal Ibadah -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('jadwal-ibadah/simpan', ['class' => 'formsimpan']) ?>
            <?= csrf_field(); ?>
            
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
                                            <option value="<?= $jenis['id_jenis_ibadah'] ?>"><?= esc($jenis['nama_jenis']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback erroridJenisIbadah"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Judul Ibadah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="judul_ibadah" placeholder="Masukkan judul ibadah">
                                    <div class="invalid-feedback errorjudulIbadah"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
                                            <div class="invalid-feedback errortanggal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select" name="status">
                                                <option value="Terjadwal" selected>Terjadwal</option>
                                                <option value="Berlangsung">Berlangsung</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Dibatalkan">Dibatalkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jam Mulai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="jam_mulai" value="08:00">
                                            <div class="invalid-feedback errorjamMulai"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="form-control" name="jam_selesai" value="10:00">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tempat</label>
                                    <input type="text" class="form-control" name="tempat" value="Gereja" placeholder="Tempat ibadah">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Maksimal Peserta</label>
                                    <input type="number" class="form-control" name="max_peserta" placeholder="Kosongkan jika tidak terbatas">
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
                                    <input type="text" class="form-control" name="tema_ibadah" placeholder="Tema ibadah">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Ayat Tema</label>
                                    <input type="text" class="form-control" name="ayat_tema" placeholder="Contoh: Yohanes 3:16">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Liturgi</label>
                                    <textarea class="form-control" name="liturgi" rows="8" placeholder="Susunan acara ibadah:
1. Doa Pembukaan
2. Pujian
3. Pembacaan Firman
4. Khotbah
5. Persembahan
6. Doa Penutup"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan tambahan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recurring Settings -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-repeat"></i> Pengaturan Recurring (Opsional)
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_recurring" id="isRecurring">
                            <label class="form-check-label" for="isRecurring">
                                <strong>Jadwal Berulang</strong> - Buat jadwal ini berulang secara otomatis
                            </label>
                        </div>

                        <div id="recurringSettings" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Tipe Pengulangan</label>
                                        <select class="form-select" name="recurring_type">
                                            <option value="">Pilih Tipe</option>
                                            <option value="Mingguan">Mingguan</option>
                                            <option value="Bulanan">Bulanan</option>
                                            <option value="Tahunan">Tahunan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Berakhir Pada</label>
                                        <input type="date" class="form-control" name="recurring_end">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Catatan:</strong> Sistem akan membuat jadwal baru secara otomatis sesuai dengan pengaturan recurring yang dipilih.
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
        // Toggle recurring settings
        $('#isRecurring').change(function() {
            if ($(this).is(':checked')) {
                $('#recurringSettings').show();
            } else {
                $('#recurringSettings').hide();
            }
        });

        // Auto fill jam selesai based on jenis ibadah
        $('select[name="id_jenis_ibadah"]').change(function() {
            let selectedOption = $(this).find('option:selected');
            let jamMulai = $('input[name="jam_mulai"]').val();
            
            if (jamMulai) {
                // Default durasi 120 menit, bisa disesuaikan berdasarkan jenis ibadah
                let durasi = 120; // menit
                let jamMulaiObj = new Date('1970-01-01T' + jamMulai + ':00');
                let jamSelesaiObj = new Date(jamMulaiObj.getTime() + durasi * 60000);
                let jamSelesai = jamSelesaiObj.toTimeString().slice(0, 5);
                
                $('input[name="jam_selesai"]').val(jamSelesai);
            }
        });

        // Form submit
        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            let form = this;
            
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
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.id_jenis_ibadah) {
                            $('#modaltambah .erroridJenisIbadah').html(response.error.id_jenis_ibadah);
                            $('#modaltambah select[name=id_jenis_ibadah]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .erroridJenisIbadah').html('');
                            $('#modaltambah select[name=id_jenis_ibadah]').removeClass('is-invalid');
                        }

                        if (response.error.judul_ibadah) {
                            $('#modaltambah .errorjudulIbadah').html(response.error.judul_ibadah);
                            $('#modaltambah input[name=judul_ibadah]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errorjudulIbadah').html('');
                            $('#modaltambah input[name=judul_ibadah]').removeClass('is-invalid');
                        }

                        if (response.error.tanggal) {
                            $('#modaltambah .errortanggal').html(response.error.tanggal);
                            $('#modaltambah input[name=tanggal]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errortanggal').html('');
                            $('#modaltambah input[name=tanggal]').removeClass('is-invalid');
                        }

                        if (response.error.jam_mulai) {
                            $('#modaltambah .errorjamMulai').html(response.error.jam_mulai);
                            $('#modaltambah input[name=jam_mulai]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errorjamMulai').html('');
                            $('#modaltambah input[name=jam_mulai]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaltambah').modal('hide');
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
