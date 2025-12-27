<!-- Modal Tambah Majelis -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open_multipart('majelis-gereja/simpan', ['class' => 'formsimpan']) ?>
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
                                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap">
                                    <div class="invalid-feedback errornama"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>NIP</label>
                                    <input type="text" class="form-control" name="nip" placeholder="Nomor Induk Pegawai (opsional)">
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
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-select" name="jk">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Agama</label>
                                    <input type="text" class="form-control" name="agama" value="Kristen Protestan">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>No. HP</label>
                                            <input type="text" class="form-control" name="no_hp" placeholder="08123456789">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="email@gereja.org">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Jabatan & Pelayanan -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-briefcase"></i> Jabatan & Pelayanan</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Jenis Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_jabatan">
                                        <option value="">Pilih Jenis Jabatan</option>
                                        <option value="Ketua Majelis">Ketua Majelis</option>
                                        <option value="Wakil Ketua">Wakil Ketua</option>
                                        <option value="Sekretaris">Sekretaris</option>
                                        <option value="Bendahara">Bendahara</option>
                                        <option value="Anggota Majelis">Anggota Majelis</option>
                                        <option value="Pendeta">Pendeta</option>
                                        <option value="Diakon">Diakon</option>
                                        <option value="Pelayan Firman">Pelayan Firman</option>
                                        <option value="Pemusik">Pemusik</option>
                                        <option value="Pelayan Multimedia">Pelayan Multimedia</option>
                                    </select>
                                    <div class="invalid-feedback errorjenisJabatan"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jabatan Detail</label>
                                    <select class="form-select" name="jabatan_id">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan_list as $jab) : ?>
                                            <option value="<?= $jab['jabatan_id'] ?>"><?= esc($jab['nama_jabatan']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Status Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status_jabatan">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                        <option value="Masa Percobaan">Masa Percobaan</option>
                                        <option value="Habis Masa Jabatan">Habis Masa Jabatan</option>
                                    </select>
                                    <div class="invalid-feedback errorstatusJabatan"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Penahbisan</label>
                                    <input type="date" class="form-control" name="tanggal_penahbisan">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Pelantikan</label>
                                    <input type="date" class="form-control" name="tanggal_pelantikan">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Akhir Jabatan</label>
                                    <input type="date" class="form-control" name="tanggal_akhir_jabatan">
                                    <small class="text-muted">Kosongkan jika tidak ada batas waktu</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Gereja Asal</label>
                                    <input type="text" class="form-control" name="gereja_asal" placeholder="Nama gereja asal">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Pendidikan Teologi</label>
                                    <input type="text" class="form-control" name="pendidikan_teologi" placeholder="Latar belakang pendidikan teologi">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Sertifikasi/Kredensial</label>
                                    <textarea class="form-control" name="sertifikasi" rows="2" placeholder="Sertifikasi atau kredensial yang dimiliki"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Komisi</label>
                                    <select class="form-select" name="komisi" multiple>
                                        <?php foreach ($komisi_list as $kom) : ?>
                                            <option value="<?= $kom['komisi_id'] ?>"><?= esc($kom['nama_komisi']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-muted">Tekan Ctrl untuk memilih lebih dari satu</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload File -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-upload"></i> Upload File</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Foto Profil</label>
                                            <input type="file" class="form-control" name="gambar" accept="image/*">
                                            <small class="text-muted">Max 2MB, Format: JPG, JPEG, PNG</small>
                                            <div class="invalid-feedback errorgambar"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>SK Pengangkatan</label>
                                            <input type="file" class="form-control" name="file_sk_pengangkatan">
                                            <small class="text-muted">File SK Pengangkatan/Pelantikan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Sertifikat Penahbisan</label>
                                            <input type="file" class="form-control" name="file_sertifikat">
                                            <small class="text-muted">File sertifikat penahbisan</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btnsimpan">
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
            let form = $(this)[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', 'disabled');
                    $('.btnsimpan').html('<i class="fas fa-spin fa-spinner"></i> Menyimpan...');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('<i class="fas fa-save"></i> Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        let err = response.error;
                        if (err.nama) {
                            $('.errornama').html(err.nama);
                            $('input[name=nama]').addClass('is-invalid');
                        }
                        if (err.jenis_jabatan) {
                            $('.errorjenisJabatan').html(err.jenis_jabatan);
                            $('select[name=jenis_jabatan]').addClass('is-invalid');
                        }
                        if (err.status_jabatan) {
                            $('.errorstatusJabatan').html(err.status_jabatan);
                            $('select[name=status_jabatan]').addClass('is-invalid');
                        }
                        if (err.gambar) {
                            $('.errorgambar').html(err.gambar);
                            $('input[name=gambar]').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaltambah').modal('hide');
                        listmajelis();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset validation on input
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
