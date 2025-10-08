<!-- Modal Tambah Jemaat -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open('manajemen-jemaat/simpan', ['class' => 'formsimpan']) ?>
            <?= csrf_field(); ?>
            
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
                                    <input type="text" class="form-control" name="no_anggota" value="<?= $no_anggota_baru ?>" readonly>
                                    <div class="invalid-feedback errornoAnggota"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap">
                                    <div class="invalid-feedback errornamaLengkap"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Panggilan</label>
                                    <input type="text" class="form-control" name="nama_panggilan" placeholder="Masukkan nama panggilan">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tgl_lahir">
                                            <div class="invalid-feedback errortglLahir"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback errorjenisKelamin"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat_lengkap" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                                    <div class="invalid-feedback erroralamatLengkap"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>RT/RW</label>
                                            <input type="text" class="form-control" name="rt_rw" placeholder="001/002">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kelurahan</label>
                                            <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kecamatan</label>
                                            <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label>Kota</label>
                                            <input type="text" class="form-control" name="kota" placeholder="Kota">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Kode Pos</label>
                                            <input type="text" class="form-control" name="kode_pos" placeholder="12345">
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
                                    <input type="text" class="form-control" name="no_hp" placeholder="08123456789">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email@example.com">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Pendidikan</label>
                                            <select class="form-select" name="pendidikan">
                                                <option value="">Pilih Pendidikan</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="D3">D3</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Status Pernikahan</label>
                                            <select class="form-select" name="status_pernikahan">
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Janda">Janda</option>
                                                <option value="Duda">Duda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control" name="nama_ayah" placeholder="Nama ayah">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control" name="nama_ibu" placeholder="Nama ibu">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Nama Pasangan</label>
                                    <input type="text" class="form-control" name="nama_pasangan" placeholder="Nama pasangan (jika sudah menikah)">
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
                                    <input type="date" class="form-control" name="tgl_baptis">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Baptis</label>
                                    <input type="text" class="form-control" name="tempat_baptis" placeholder="Gereja tempat baptis">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Baptis</label>
                                    <input type="text" class="form-control" name="pendeta_baptis" placeholder="Nama pendeta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Sidi</label>
                                    <input type="date" class="form-control" name="tgl_sidi">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Sidi</label>
                                    <input type="text" class="form-control" name="tempat_sidi" placeholder="Gereja tempat sidi">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Sidi</label>
                                    <input type="text" class="form-control" name="pendeta_sidi" placeholder="Nama pendeta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Nikah</label>
                                    <input type="date" class="form-control" name="tgl_nikah">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tempat Nikah</label>
                                    <input type="text" class="form-control" name="tempat_nikah" placeholder="Gereja tempat nikah">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Pendeta Nikah</label>
                                    <input type="text" class="form-control" name="pendeta_nikah" placeholder="Nama pendeta">
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
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Status Keanggotaan</label>
                                    <select class="form-select" name="status_keanggotaan">
                                        <option value="Aktif" selected>Aktif</option>
                                        <option value="Pindah">Pindah</option>
                                        <option value="Meninggal">Meninggal</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Tanggal Bergabung <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tgl_bergabung" value="<?= date('Y-m-d') ?>">
                                    <div class="invalid-feedback errortglBergabung"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Gereja Asal</label>
                                    <input type="text" class="form-control" name="gereja_asal" placeholder="Gereja asal (jika pindahan)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan tambahan"></textarea>
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
                        if (response.error.nama_lengkap) {
                            $('#modaltambah .errornamaLengkap').html(response.error.nama_lengkap);
                            $('#modaltambah input[name=nama_lengkap]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errornamaLengkap').html('');
                            $('#modaltambah input[name=nama_lengkap]').removeClass('is-invalid');
                        }

                        if (response.error.no_anggota) {
                            $('#modaltambah .errornoAnggota').html(response.error.no_anggota);
                            $('#modaltambah input[name=no_anggota]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errornoAnggota').html('');
                            $('#modaltambah input[name=no_anggota]').removeClass('is-invalid');
                        }

                        if (response.error.tgl_lahir) {
                            $('#modaltambah .errortglLahir').html(response.error.tgl_lahir);
                            $('#modaltambah input[name=tgl_lahir]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errortglLahir').html('');
                            $('#modaltambah input[name=tgl_lahir]').removeClass('is-invalid');
                        }

                        if (response.error.jenis_kelamin) {
                            $('#modaltambah .errorjenisKelamin').html(response.error.jenis_kelamin);
                            $('#modaltambah select[name=jenis_kelamin]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errorjenisKelamin').html('');
                            $('#modaltambah select[name=jenis_kelamin]').removeClass('is-invalid');
                        }

                        if (response.error.alamat_lengkap) {
                            $('#modaltambah .erroralamatLengkap').html(response.error.alamat_lengkap);
                            $('#modaltambah textarea[name=alamat_lengkap]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .erroralamatLengkap').html('');
                            $('#modaltambah textarea[name=alamat_lengkap]').removeClass('is-invalid');
                        }

                        if (response.error.tgl_bergabung) {
                            $('#modaltambah .errortglBergabung').html(response.error.tgl_bergabung);
                            $('#modaltambah input[name=tgl_bergabung]').addClass('is-invalid');
                        } else {
                            $('#modaltambah .errortglBergabung').html('');
                            $('#modaltambah input[name=tgl_bergabung]').removeClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaltambah').modal('hide');
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
