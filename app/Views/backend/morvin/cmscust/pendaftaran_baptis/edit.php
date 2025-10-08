<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">
                    <i class="fas fa-edit"></i> <?= $title ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= form_open('pendaftaran-baptis/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_baptis" value="<?= $data['id_baptis'] ?>">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($data['nama_lengkap']) ?>">
                            <div class="invalid-feedback errornama_lengkap"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="<?= esc($data['tempat_lahir']) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>">
                            <div class="invalid-feedback errortgl_lahir"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback errorjenis_kelamin"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap"><?= esc($data['alamat']) ?></textarea>
                    <div class="invalid-feedback erroralamat"></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" value="<?= esc($data['no_hp']) ?>">
                            <div class="invalid-feedback errorno_hp"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= esc($data['email']) ?>">
                            <div class="invalid-feedback erroremail"></div>
                        </div>
                    </div>
                </div>

                <hr>
                <h6 class="text-primary"><i class="fas fa-users"></i> Data Orang Tua</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="<?= esc($data['nama_ayah']) ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="<?= esc($data['nama_ibu']) ?>">
                        </div>
                    </div>
                </div>

                <hr>
                <h6 class="text-primary"><i class="fas fa-church"></i> Data Baptis</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Baptis <span class="text-danger">*</span></label>
                            <select name="jenis_baptis" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Baptis Anak" <?= $data['jenis_baptis'] == 'Baptis Anak' ? 'selected' : '' ?>>Baptis Anak</option>
                                <option value="Baptis Dewasa" <?= $data['jenis_baptis'] == 'Baptis Dewasa' ? 'selected' : '' ?>>Baptis Dewasa</option>
                            </select>
                            <div class="invalid-feedback errorjenis_baptis"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Baptis (Opsional)</label>
                            <input type="date" name="tgl_baptis" class="form-control" value="<?= $data['tgl_baptis'] ?>">
                            <small class="text-muted">Kosongkan jika belum ditentukan</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pendamping (Opsional)</label>
                            <input type="text" name="nama_pendamping" class="form-control" value="<?= esc($data['nama_pendamping']) ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hubungan Pendamping</label>
                            <input type="text" name="hubungan_pendamping" class="form-control" value="<?= esc($data['hubungan_pendamping']) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="0" <?= $data['status'] == '0' ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?= $data['status'] == '1' ? 'selected' : '' ?>>Disetujui</option>
                                <option value="2" <?= $data['status'] == '2' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Catatan atau keterangan tambahan..."><?= esc($data['keterangan']) ?></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary btnsimpan">
                    <i class="fas fa-save"></i> Update Data
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formedit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('<i class="fas fa-save"></i> Update Data');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama_lengkap) {
                            $('input[name=nama_lengkap]').addClass('is-invalid');
                            $('.errornama_lengkap').html(response.error.nama_lengkap);
                        } else {
                            $('input[name=nama_lengkap]').removeClass('is-invalid');
                            $('.errornama_lengkap').html('');
                        }

                        if (response.error.no_hp) {
                            $('input[name=no_hp]').addClass('is-invalid');
                            $('.errorno_hp').html(response.error.no_hp);
                        } else {
                            $('input[name=no_hp]').removeClass('is-invalid');
                            $('.errorno_hp').html('');
                        }

                        if (response.error.email) {
                            $('input[name=email]').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('input[name=email]').removeClass('is-invalid');
                            $('.erroremail').html('');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listbaptis();
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
