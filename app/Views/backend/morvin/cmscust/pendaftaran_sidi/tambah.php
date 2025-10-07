<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel">
                    <i class="fas fa-plus-circle"></i> <?= $title ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <?= form_open('pendaftaran-sidi/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap">
                            <div class="invalid-feedback errornama_lengkap"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control">
                            <div class="invalid-feedback errortgl_lahir"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback errorjenis_kelamin"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap"></textarea>
                    <div class="invalid-feedback erroralamat"></div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
                            <div class="invalid-feedback errorno_hp"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com">
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
                            <input type="text" name="nama_ayah" class="form-control" placeholder="Nama ayah">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" placeholder="Nama ibu">
                        </div>
                    </div>
                </div>
                
                <hr>
                <h6 class="text-primary"><i class="fas fa-church"></i> Data Baptis & Sidi</h6>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Baptis <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_baptis" class="form-control">
                            <div class="invalid-feedback errortgl_baptis"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gereja Baptis</label>
                            <input type="text" name="gereja_baptis" class="form-control" placeholder="Nama gereja">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Sidi (Opsional)</label>
                            <input type="date" name="tgl_sidi" class="form-control">
                            <small class="text-muted">Kosongkan jika belum ditentukan</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Catatan atau keterangan tambahan..."></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary btnsimpan">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formtambah').submit(function(e) {
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
                    $('.btnsimpan').html('<i class="fas fa-save"></i> Simpan Data');
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
                        $('#modaltambah').modal('hide');
                        listsidi();
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
