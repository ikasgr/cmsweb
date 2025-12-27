<!-- Modal Tambah Produk -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <?= form_open_multipart('produk-umkm/simpan', ['class' => 'formsimpan']) ?>
            <?= csrf_field(); ?>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_produk" placeholder="Masukkan nama produk">
                            <div class="invalid-feedback errornamaProduk"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat['kategori_id'] ?>"><?= esc($kat['nama_kategori']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback errorkategoriId"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4" placeholder="Deskripsi produk"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="harga" placeholder="0">
                                    <div class="invalid-feedback errorharga"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Harga Promo</label>
                                    <input type="number" class="form-control" name="harga_promo" placeholder="0">
                                    <small class="text-muted">Kosongkan jika tidak ada promo</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="stok" placeholder="0">
                                    <div class="invalid-feedback errorstok"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Berat (gram)</label>
                                    <input type="number" class="form-control" name="berat" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Satuan</label>
                                    <select class="form-select" name="satuan">
                                        <option value="pcs">Pcs</option>
                                        <option value="kg">Kg</option>
                                        <option value="liter">Liter</option>
                                        <option value="pack">Pack</option>
                                        <option value="box">Box</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Gambar Produk <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                            <small class="text-muted">Max 2MB, Format: JPG, JPEG, PNG</small>
                            <div class="invalid-feedback errorgambar"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Featured</label>
                                    <select class="form-select" name="featured">
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">
                        <h6 class="mb-3"><i class="fab fa-whatsapp text-success"></i> Integrasi WhatsApp</h6>
                        
                        <div class="form-group mb-3">
                            <label>Nomor WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp_admin" placeholder="628123456789">
                            <small class="text-muted">Format: 628xxx (tanpa +, tanpa spasi). Kosongkan untuk menggunakan nomor default.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Template Pesan WhatsApp</label>
                            <textarea class="form-control" name="whatsapp_template" rows="3" placeholder="Halo, saya tertarik dengan produk ini...">Halo, saya tertarik dengan produk:

*{nama_produk}*
Harga: Rp {harga}

Apakah produk ini masih tersedia?</textarea>
                            <small class="text-muted">Gunakan {nama_produk}, {harga}, {kategori} untuk placeholder otomatis.</small>
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
                        if (err.nama_produk) {
                            $('.errornamaProduk').html(err.nama_produk);
                            $('input[name=nama_produk]').addClass('is-invalid');
                        }
                        if (err.kategori_id) {
                            $('.errorkategoriId').html(err.kategori_id);
                            $('select[name=kategori_id]').addClass('is-invalid');
                        }
                        if (err.harga) {
                            $('.errorharga').html(err.harga);
                            $('input[name=harga]').addClass('is-invalid');
                        }
                        if (err.stok) {
                            $('.errorstok').html(err.stok);
                            $('input[name=stok]').addClass('is-invalid');
                        }
                        if (err.gambar) {
                            $('.errorgambar').html(err.gambar);
                            $('input[name=gambar]').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaltambah').modal('hide');
                        listproduk();
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
