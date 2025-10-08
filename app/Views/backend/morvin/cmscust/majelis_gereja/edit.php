<!-- Modal Edit Majelis -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open_multipart('majelis-gereja/update', ['class' => 'formupdate']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="majelis_id" value="<?= $data['majelis_id'] ?>">
            
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
                                    <input type="text" class="form-control" name="nama" value="<?= esc($data['nama']) ?>" placeholder="Masukkan nama lengkap">
                                    <div class="invalid-feedback errornama"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>NIP</label>
                                    <input type="text" class="form-control" name="nip" value="<?= esc($data['nip']) ?>" placeholder="Nomor Induk Pegawai (opsional)">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" name="tempat_lahir" value="<?= esc($data['tempat_lahir']) ?>" placeholder="Tempat lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-select" name="jk">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" <?= $data['jk'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $data['jk'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Agama</label>
                                    <input type="text" class="form-control" name="agama" value="<?= esc($data['agama']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"><?= esc($data['alamat']) ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>No. HP</label>
                                            <input type="text" class="form-control" name="no_hp" value="<?= esc($data['no_hp']) ?>" placeholder="08123456789">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= esc($data['email']) ?>" placeholder="email@gereja.org">
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
                                        <option value="Ketua Majelis" <?= $data['jenis_jabatan'] == 'Ketua Majelis' ? 'selected' : '' ?>>Ketua Majelis</option>
                                        <option value="Wakil Ketua" <?= $data['jenis_jabatan'] == 'Wakil Ketua' ? 'selected' : '' ?>>Wakil Ketua</option>
                                        <option value="Sekretaris" <?= $data['jenis_jabatan'] == 'Sekretaris' ? 'selected' : '' ?>>Sekretaris</option>
                                        <option value="Bendahara" <?= $data['jenis_jabatan'] == 'Bendahara' ? 'selected' : '' ?>>Bendahara</option>
                                        <option value="Anggota Majelis" <?= $data['jenis_jabatan'] == 'Anggota Majelis' ? 'selected' : '' ?>>Anggota Majelis</option>
                                        <option value="Pendeta" <?= $data['jenis_jabatan'] == 'Pendeta' ? 'selected' : '' ?>>Pendeta</option>
                                        <option value="Diakon" <?= $data['jenis_jabatan'] == 'Diakon' ? 'selected' : '' ?>>Diakon</option>
                                        <option value="Pelayan Firman" <?= $data['jenis_jabatan'] == 'Pelayan Firman' ? 'selected' : '' ?>>Pelayan Firman</option>
                                        <option value="Pemusik" <?= $data['jenis_jabatan'] == 'Pemusik' ? 'selected' : '' ?>>Pemusik</option>
                                        <option value="Pelayan Multimedia" <?= $data['jenis_jabatan'] == 'Pelayan Multimedia' ? 'selected' : '' ?>>Pelayan Multimedia</option>
                                    </select>
                                    <div class="invalid-feedback errorjenisJabatan"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Jabatan Detail</label>
                                    <select class="form-select" name="jabatan_id">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($jabatan_list as $jab) : ?>
                                            <option value="<?= $jab['jabatan_id'] ?>" <?= $data['jabatan_id'] == $jab['jabatan_id'] ? 'selected' : '' ?>><?= esc($jab['nama_jabatan']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Status Jabatan <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status_jabatan">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif" <?= $data['status_jabatan'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Non-Aktif" <?= $data['status_jabatan'] == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                                        <option value="Masa Percobaan" <?= $data['status_jabatan'] == 'Masa Percobaan' ? 'selected' : '' ?>>Masa Percobaan</option>
                                        <option value="Habis Masa Jabatan" <?= $data['status_jabatan'] == 'Habis Masa Jabatan' ? 'selected' : '' ?>>Habis Masa Jabatan</option>
                                    </select>
                                    <div class="invalid-feedback errorstatusJabatan"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Penahbisan</label>
                                    <input type="date" class="form-control" name="tanggal_penahbisan" value="<?= $data['tanggal_penahbisan'] ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Pelantikan</label>
                                    <input type="date" class="form-control" name="tanggal_pelantikan" value="<?= $data['tanggal_pelantikan'] ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Akhir Jabatan</label>
                                    <input type="date" class="form-control" name="tanggal_akhir_jabatan" value="<?= $data['tanggal_akhir_jabatan'] ?>">
                                    <small class="text-muted">Kosongkan jika tidak ada batas waktu</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Gereja Asal</label>
                                    <input type="text" class="form-control" name="gereja_asal" value="<?= esc($data['gereja_asal']) ?>" placeholder="Nama gereja asal">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Pendidikan Teologi</label>
                                    <input type="text" class="form-control" name="pendidikan_teologi" value="<?= esc($data['pendidikan_teologi']) ?>" placeholder="Latar belakang pendidikan teologi">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Sertifikasi/Kredensial</label>
                                    <textarea class="form-control" name="sertifikasi" rows="2" placeholder="Sertifikasi atau kredensial yang dimiliki"><?= esc($data['sertifikasi']) ?></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Komisi</label>
                                    <select class="form-select" name="komisi" multiple>
                                        <?php 
                                        $komisi_selected = explode(',', $data['komisi']);
                                        foreach ($komisi_list as $kom) : 
                                        ?>
                                            <option value="<?= $kom['komisi_id'] ?>" <?= in_array($kom['komisi_id'], $komisi_selected) ? 'selected' : '' ?>><?= esc($kom['nama_komisi']) ?></option>
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
                                            <?php if ($data['gambar']) : ?>
                                                <div class="mb-2">
                                                    <img src="<?= base_url('public/img/informasi/majelis/' . $data['gambar']) ?>" class="img-thumbnail" width="150">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control" name="gambar" accept="image/*">
                                            <small class="text-muted">Max 2MB, Format: JPG, JPEG, PNG. Kosongkan jika tidak diubah</small>
                                            <div class="invalid-feedback errorgambar"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>SK Pengangkatan</label>
                                            <?php if ($data['file_sk_pengangkatan']) : ?>
                                                <div class="mb-2">
                                                    <a href="<?= base_url('public/img/informasi/pegawai/' . $data['file_sk_pengangkatan']) ?>" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-file"></i> Lihat File
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control" name="file_sk_pengangkatan">
                                            <small class="text-muted">File SK Pengangkatan/Pelantikan. Kosongkan jika tidak diubah</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Sertifikat Penahbisan</label>
                                            <?php if ($data['file_sertifikat']) : ?>
                                                <div class="mb-2">
                                                    <a href="<?= base_url('public/img/informasi/pegawai/' . $data['file_sertifikat']) ?>" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-file"></i> Lihat File
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control" name="file_sertifikat">
                                            <small class="text-muted">File sertifikat penahbisan. Kosongkan jika tidak diubah</small>
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
                <button type="submit" class="btn btn-primary btnupdate">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formupdate').submit(function(e) {
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
                    $('.btnupdate').attr('disabled', 'disabled');
                    $('.btnupdate').html('<i class="fas fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function() {
                    $('.btnupdate').removeAttr('disabled');
                    $('.btnupdate').html('<i class="fas fa-save"></i> Update');
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
                        if (err.gambar) {
                            $('.errorgambar').html(err.gambar);
                            $('input[name=gambar]').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
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
