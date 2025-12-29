<!-- Modal Edit -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('jadwal-pelayanan/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal'] ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Judul Jadwal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul_jadwal" id="judul_jadwal"
                            value="<?= esc($data['judul_jadwal']) ?>" required>
                        <div class="invalid-feedback errorJudul"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jenis Pelayanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenis_pelayanan" id="jenis_pelayanan"
                            value="<?= esc($data['jenis_pelayanan']) ?>" required>
                        <div class="invalid-feedback errorJenis"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal"
                            value="<?= $data['tanggal'] ?>" required>
                        <div class="invalid-feedback errorTanggal"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai"
                            value="<?= $data['waktu_mulai'] ?>" required>
                        <div class="invalid-feedback errorMulai"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Waktu Selesai</label>
                        <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai"
                            value="<?= $data['waktu_selesai'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Tempat</label>
                    <input type="text" class="form-control" name="tempat" id="tempat"
                        value="<?= esc($data['tempat']) ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Pengkhotbah</label>
                        <input type="text" class="form-control" name="pengkhotbah" id="pengkhotbah"
                            value="<?= esc($data['pengkhotbah']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Liturgis (WL)</label>
                        <input type="text" class="form-control" name="liturgis" id="liturgis"
                            value="<?= esc($data['liturgis']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Singer</label>
                        <input type="text" class="form-control" name="singer" id="singer"
                            value="<?= esc($data['singer']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Pemusik</label>
                        <input type="text" class="form-control" name="pemusik" id="pemusik"
                            value="<?= esc($data['pemusik']) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Multimedia</label>
                        <input type="text" class="form-control" name="multimedia" id="multimedia"
                            value="<?= esc($data['multimedia']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Usher</label>
                        <input type="text" class="form-control" name="usher" id="usher"
                            value="<?= esc($data['usher']) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan"
                        rows="3"><?= esc($data['keterangan']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Warna Label (Kalender)</label>
                        <input type="color" class="form-control form-control-color" name="warna" id="warna"
                            value="<?= $data['warna'] ?? '#007bff' ?>" title="Pilih warna">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btnsimpan">Update</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.formedit').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function () {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Update');
                },
                success: function (response) {
                    if (response.error) {
                        if (response.error.judul_jadwal) {
                            $('#judul_jadwal').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_jadwal);
                        } else {
                            $('#judul_jadwal').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        if (response.error.tanggal) {
                            $('#tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('#tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        });

                        $('#modaledit').modal('hide');
                        listjadwal();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>