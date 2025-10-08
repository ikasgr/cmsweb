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

            <?= form_open('pendaftaran-nikah/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_nikah" value="<?= $data['id_nikah'] ?>">

            <div class="modal-body">
                <h6 class="text-primary mb-3"><i class="fas fa-user-tie"></i> Data Calon Suami</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap Suami <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap_suami" class="form-control" value="<?= esc($data['nama_lengkap_suami']) ?>">
                            <div class="invalid-feedback errornama_lengkap_suami"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir Suami</label>
                            <input type="text" name="tempat_lahir_suami" class="form-control" value="<?= esc($data['tempat_lahir_suami']) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir Suami <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir_suami" class="form-control" value="<?= $data['tgl_lahir_suami'] ?>">
                            <div class="invalid-feedback errortgl_lahir_suami"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No HP Suami <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp_suami" class="form-control" value="<?= esc($data['no_hp_suami']) ?>">
                            <div class="invalid-feedback errorno_hp_suami"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Suami <span class="text-danger">*</span></label>
                    <textarea name="alamat_suami" class="form-control" rows="2" placeholder="Alamat lengkap suami"><?= esc($data['alamat_suami']) ?></textarea>
                    <div class="invalid-feedback erroralamat_suami"></div>
                </div>

                <hr>
                <h6 class="text-primary mb-3"><i class="fas fa-user"></i> Data Calon Istri</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap Istri <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap_istri" class="form-control" value="<?= esc($data['nama_lengkap_istri']) ?>">
                            <div class="invalid-feedback errornama_lengkap_istri"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir Istri</label>
                            <input type="text" name="tempat_lahir_istri" class="form-control" value="<?= esc($data['tempat_lahir_istri']) ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir Istri <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir_istri" class="form-control" value="<?= $data['tgl_lahir_istri'] ?>">
                            <div class="invalid-feedback errortgl_lahir_istri"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No HP Istri <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp_istri" class="form-control" value="<?= esc($data['no_hp_istri']) ?>">
                            <div class="invalid-feedback errorno_hp_istri"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Istri <span class="text-danger">*</span></label>
                    <textarea name="alamat_istri" class="form-control" rows="2" placeholder="Alamat lengkap istri"><?= esc($data['alamat_istri']) ?></textarea>
                    <div class="invalid-feedback erroralamat_istri"></div>
                </div>

                <hr>
                <h6 class="text-primary mb-3"><i class="fas fa-heart"></i> Data Pernikahan</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Pernikahan (Opsional)</label>
                            <input type="date" name="tgl_nikah" class="form-control" value="<?= $data['tgl_nikah'] ?>">
                            <small class="text-muted">Kosongkan jika belum ditentukan</small>
                        </div>
                    </div>

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
                        if (response.error.nama_lengkap_suami) {
                            $('input[name=nama_lengkap_suami]').addClass('is-invalid');
                            $('.errornama_lengkap_suami').html(response.error.nama_lengkap_suami);
                        } else {
                            $('input[name=nama_lengkap_suami]').removeClass('is-invalid');
                            $('.errornama_lengkap_suami').html('');
                        }

                        if (response.error.nama_lengkap_istri) {
                            $('input[name=nama_lengkap_istri]').addClass('is-invalid');
                            $('.errornama_lengkap_istri').html(response.error.nama_lengkap_istri);
                        } else {
                            $('input[name=nama_lengkap_istri]').removeClass('is-invalid');
                            $('.errornama_lengkap_istri').html('');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listnikah();
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
