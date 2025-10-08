<!-- Modal Edit Jemaat -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('manajemen-jemaat/update', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_jemaat" value="<?= $data['id_jemaat'] ?>">
            
            <div class="modal-body">
                <div class="row">
                    <!-- Data Pribadi -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-user"></i> Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Nomor Anggota <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_anggota" value="<?= esc($data['no_anggota']) ?>">
                                    <div class="invalid-feedback errornoAnggota"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" value="<?= esc($data['nama_lengkap']) ?>">
                                    <div class="invalid-feedback errornamaLengkap"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Panggilan</label>
                                    <input type="text" class="form-control" name="nama_panggilan" value="<?= esc($data['nama_panggilan']) ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" value="<?= esc($data['tempat_lahir']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
                                            <div class="invalid-feedback errortglLahir"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" <?= $data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="P" <?= $data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback errorjenisKelamin"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat_lengkap" rows="3"><?= esc($data['alamat_lengkap']) ?></textarea>
                                    <div class="invalid-feedback erroralamatLengkap"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>RT/RW</label>
                                            <input type="text" class="form-control" name="rt_rw" value="<?= esc($data['rt_rw']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kelurahan</label>
                                            <input type="text" class="form-control" name="kelurahan" value="<?= esc($data['kelurahan']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" name="kecamatan" value="<?= esc($data['kecamatan']) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label>Kota</label>
                                            <input type="text" class="form-control" name="kota" value="<?= esc($data['kota']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control" name="kode_pos" value="<?= esc($data['kode_pos']) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Kontak & Lainnya -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-phone"></i> Kontak & Data Lainnya</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?= esc($data['no_hp']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= esc($data['email']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" value="<?= esc($data['pekerjaan']) ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Pendidikan</label>
                                            <select class="form-select" name="pendidikan">
                                                <option value="">Pilih Pendidikan</option>
                                                <option value="SD" <?= $data['pendidikan'] == 'SD' ? 'selected' : '' ?>>SD</option>
                                                <option value="SMP" <?= $data['pendidikan'] == 'SMP' ? 'selected' : '' ?>>SMP</option>
                                                <option value="SMA" <?= $data['pendidikan'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
                                                <option value="D3" <?= $data['pendidikan'] == 'D3' ? 'selected' : '' ?>>D3</option>
                                                <option value="S1" <?= $data['pendidikan'] == 'S1' ? 'selected' : '' ?>>S1</option>
                                                <option value="S2" <?= $data['pendidikan'] == 'S2' ? 'selected' : '' ?>>S2</option>
                                                <option value="S3" <?= $data['pendidikan'] == 'S3' ? 'selected' : '' ?>>S3</option>
                                                <option value="Lainnya" <?= $data['pendidikan'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status Pernikahan</label>
                                            <select class="form-select" name="status_pernikahan">
                                                <option value="Belum Menikah" <?= $data['status_pernikahan'] == 'Belum Menikah' ? 'selected' : '' ?>>Belum Menikah</option>
                                                <option value="Menikah" <?= $data['status_pernikahan'] == 'Menikah' ? 'selected' : '' ?>>Menikah</option>
                                                <option value="Janda" <?= $data['status_pernikahan'] == 'Janda' ? 'selected' : '' ?>>Janda</option>
                                                <option value="Duda" <?= $data['status_pernikahan'] == 'Duda' ? 'selected' : '' ?>>Duda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah" value="<?= esc($data['nama_ayah']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu" value="<?= esc($data['nama_ibu']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Pasangan</label>
                                    <input type="text" class="form-control" name="nama_pasangan" value="<?= esc($data['nama_pasangan']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Rohani -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-cross"></i> Data Rohani</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Baptis</label>
                                    <input type="date" class="form-control" name="tgl_baptis" value="<?= $data['tgl_baptis'] ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Baptis</label>
                                    <input type="text" class="form-control" name="tempat_baptis" value="<?= esc($data['tempat_baptis']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Baptis</label>
                                    <input type="text" class="form-control" name="pendeta_baptis" value="<?= esc($data['pendeta_baptis']) ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Sidi</label>
                                    <input type="date" class="form-control" name="tgl_sidi" value="<?= $data['tgl_sidi'] ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Sidi</label>
                                    <input type="text" class="form-control" name="tempat_sidi" value="<?= esc($data['tempat_sidi']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Sidi</label>
                                    <input type="text" class="form-control" name="pendeta_sidi" value="<?= esc($data['pendeta_sidi']) ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Nikah</label>
                                    <input type="date" class="form-control" name="tgl_nikah" value="<?= $data['tgl_nikah'] ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Nikah</label>
                                    <input type="text" class="form-control" name="tempat_nikah" value="<?= esc($data['tempat_nikah']) ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Nikah</label>
                                    <input type="text" class="form-control" name="pendeta_nikah" value="<?= esc($data['pendeta_nikah']) ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Keanggotaan -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-church"></i> Data Keanggotaan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Status Keanggotaan</label>
                                    <select class="form-select" name="status_keanggotaan">
                                        <option value="Aktif" <?= $data['status_keanggotaan'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Pindah" <?= $data['status_keanggotaan'] == 'Pindah' ? 'selected' : '' ?>>Pindah</option>
                                        <option value="Meninggal" <?= $data['status_keanggotaan'] == 'Meninggal' ? 'selected' : '' ?>>Meninggal</option>
                                        <option value="Non-Aktif" <?= $data['status_keanggotaan'] == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Tanggal Bergabung <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tgl_bergabung" value="<?= $data['tgl_bergabung'] ?>">
                                    <div class="invalid-feedback errortglBergabung"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Tanggal Pindah</label>
                                    <input type="date" class="form-control" name="tgl_pindah" value="<?= $data['tgl_pindah'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Tanggal Meninggal</label>
                                    <input type="date" class="form-control" name="tgl_meninggal" value="<?= $data['tgl_meninggal'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Gereja Asal</label>
                                    <input type="text" class="form-control" name="gereja_asal" value="<?= esc($data['gereja_asal']) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Gereja Tujuan</label>
                                    <input type="text" class="form-control" name="gereja_tujuan" value="<?= esc($data['gereja_tujuan']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"><?= esc($data['keterangan']) ?></textarea>
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
                        if (response.error.nama_lengkap) {
                            $('#modaledit .errornamaLengkap').html(response.error.nama_lengkap);
                            $('#modaledit input[name=nama_lengkap]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errornamaLengkap').html('');
                            $('#modaledit input[name=nama_lengkap]').removeClass('is-invalid');
                        }

                        if (response.error.no_anggota) {
                            $('#modaledit .errornoAnggota').html(response.error.no_anggota);
                            $('#modaledit input[name=no_anggota]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errornoAnggota').html('');
                            $('#modaledit input[name=no_anggota]').removeClass('is-invalid');
                        }

                        if (response.error.tgl_lahir) {
                            $('#modaledit .errortglLahir').html(response.error.tgl_lahir);
                            $('#modaledit input[name=tgl_lahir]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errortglLahir').html('');
                            $('#modaledit input[name=tgl_lahir]').removeClass('is-invalid');
                        }

                        if (response.error.jenis_kelamin) {
                            $('#modaledit .errorjenisKelamin').html(response.error.jenis_kelamin);
                            $('#modaledit select[name=jenis_kelamin]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errorjenisKelamin').html('');
                            $('#modaledit select[name=jenis_kelamin]').removeClass('is-invalid');
                        }

                        if (response.error.alamat_lengkap) {
                            $('#modaledit .erroralamatLengkap').html(response.error.alamat_lengkap);
                            $('#modaledit textarea[name=alamat_lengkap]').addClass('is-invalid');
                        } else {
                            $('#modaledit .erroralamatLengkap').html('');
                            $('#modaledit textarea[name=alamat_lengkap]').removeClass('is-invalid');
                        }

                        if (response.error.tgl_bergabung) {
                            $('#modaledit .errortglBergabung').html(response.error.tgl_bergabung);
                            $('#modaledit input[name=tgl_bergabung]').addClass('is-invalid');
                        } else {
                            $('#modaledit .errortglBergabung').html('');
                            $('#modaledit input[name=tgl_bergabung]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listjemaat();
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
