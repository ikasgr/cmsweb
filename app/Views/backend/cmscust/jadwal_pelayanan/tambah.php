<!-- Modal Tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('jadwal-pelayanan/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Judul Jadwal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="judul_jadwal" id="judul_jadwal" required>
                        <div class="invalid-feedback errorJudul"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jenis Pelayanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenis_pelayanan" id="jenis_pelayanan" required
                            placeholder="Contoh: Ibadah Raya, Ibadah Pemuda">
                        <div class="invalid-feedback errorJenis"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        <div class="invalid-feedback errorTanggal"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai" required>
                        <div class="invalid-feedback errorMulai"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Waktu Selesai</label>
                        <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Tempat</label>
                    <input type="text" class="form-control" name="tempat" id="tempat" placeholder="Gereja Utama">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Pengkhotbah</label>
                        <input type="text" class="form-control" name="pengkhotbah" id="pengkhotbah">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Liturgis (WL)</label>
                        <input type="text" class="form-control" name="liturgis" id="liturgis">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Singer</label>
                        <input type="text" class="form-control" name="singer" id="singer">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Pemusik</label>
                        <input type="text" class="form-control" name="pemusik" id="pemusik">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Multimedia</label>
                        <input type="text" class="form-control" name="multimedia" id="multimedia">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Usher</label>
                        <input type="text" class="form-control" name="usher" id="usher">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Warna Label (Kalender)</label>
                        <input type="color" class="form-control form-control-color" name="warna" id="warna"
                            value="#007bff" title="Pilih warna untuk kalender">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.formtambah').submit(function (e) {
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
                    $('.btnsimpan').html('Simpan');
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

                        if (response.error.jenis_pelayanan) {
                            $('#jenis_pelayanan').addClass('is-invalid');
                            $('.errorJenis').html(response.error.jenis_pelayanan);
                        } else {
                            $('#jenis_pelayanan').removeClass('is-invalid');
                            $('.errorJenis').html('');
                        }

                        if (response.error.tanggal) {
                            $('#tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('#tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }

                        if (response.error.waktu_mulai) {
                            $('#waktu_mulai').addClass('is-invalid');
                            $('.errorMulai').html(response.error.waktu_mulai);
                        } else {
                            $('#waktu_mulai').removeClass('is-invalid');
                            $('.errorMulai').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        });

                        $('#modaltambah').modal('hide');
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