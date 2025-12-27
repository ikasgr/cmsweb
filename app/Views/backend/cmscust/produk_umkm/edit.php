<!-- Modal Edit Produk -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open_multipart('produk-umkm/update', ['class' => 'formupdate']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">
            <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Gambar Saat Ini -->
                        <div class="form-group mb-3">
                            <label>Gambar Produk</label>
                            <?php if ($data['gambar']): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('public/img/produk/' . $data['gambar']) ?>" class="img-thumbnail"
                                        width="200" id="preview-gambar">
                                </div>
                            <?php else: ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('public/img/no-image.png') ?>" class="img-thumbnail" width="200"
                                        id="preview-gambar">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control mt-2" name="gambar" id="input-gambar"
                                accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Max 2MB, Format: JPG,
                                JPEG, PNG</small>
                            <div class="invalid-feedback errorgambar"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_produk"
                                value="<?= esc($data['nama_produk']) ?>" placeholder="Masukkan nama produk">
                            <div class="invalid-feedback errornamaProduk"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Kategori <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori as $kat): ?>
                                    <option value="<?= $kat['kategori_id'] ?>" <?= $data['kategori_id'] == $kat['kategori_id'] ? 'selected' : '' ?>><?= esc($kat['nama_kategori']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback errorkategoriId"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4"
                                placeholder="Deskripsi produk"><?= esc($data['deskripsi']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="harga" value="<?= $data['harga'] ?>"
                                        placeholder="0">
                                    <div class="invalid-feedback errorharga"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Harga Promo</label>
                                    <input type="number" class="form-control" name="harga_promo"
                                        value="<?= $data['harga_promo'] ?>" placeholder="0">
                                    <small class="text-muted">Kosongkan jika tidak ada promo</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="stok" value="<?= $data['stok'] ?>"
                                        placeholder="0">
                                    <div class="invalid-feedback errorstok"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Berat (gram)</label>
                                    <input type="number" class="form-control" name="berat" value="<?= $data['berat'] ?>"
                                        placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Satuan</label>
                                    <select class="form-select" name="satuan">
                                        <option value="pcs" <?= $data['satuan'] == 'pcs' ? 'selected' : '' ?>>Pcs</option>
                                        <option value="kg" <?= $data['satuan'] == 'kg' ? 'selected' : '' ?>>Kg</option>
                                        <option value="liter" <?= $data['satuan'] == 'liter' ? 'selected' : '' ?>>Liter
                                        </option>
                                        <option value="pack" <?= $data['satuan'] == 'pack' ? 'selected' : '' ?>>Pack
                                        </option>
                                        <option value="box" <?= $data['satuan'] == 'box' ? 'selected' : '' ?>>Box</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1" <?= $data['status'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="0" <?= $data['status'] == '0' ? 'selected' : '' ?>>Non-Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Featured</label>
                                    <select class="form-select" name="featured">
                                        <option value="0" <?= $data['featured'] == '0' ? 'selected' : '' ?>>Tidak</option>
                                        <option value="1" <?= $data['featured'] == '1' ? 'selected' : '' ?>>Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">
                        <h6 class="mb-3"><i class="fab fa-whatsapp text-success"></i> Integrasi WhatsApp</h6>

                        <div class="form-group mb-3">
                            <label>Nomor WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp_admin"
                                value="<?= esc($data['whatsapp_admin'] ?? '') ?>" placeholder="628123456789">
                            <small class="text-muted">Format: 628xxx (tanpa +, tanpa spasi). Kosongkan untuk menggunakan
                                nomor default.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label>Template Pesan WhatsApp</label>
                            <textarea class="form-control" name="whatsapp_template" rows="3"
                                placeholder="Halo, saya tertarik dengan produk ini..."><?= esc($data['whatsapp_template'] ?? 'Halo, saya tertarik dengan produk:

*{nama_produk}*
Harga: Rp {harga}

Apakah produk ini masih tersedia?') ?></textarea>
                            <small class="text-muted">Gunakan {nama_produk}, {harga}, {kategori} untuk placeholder
                                otomatis.</small>
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
    $(document).ready(function () {
        $('.formupdate').submit(function (e) {
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
                beforeSend: function () {
                    $('.btnupdate').attr('disabled', 'disabled');
                    $('.btnupdate').html('<i class="fas fa-spin fa-spinner"></i> Mengupdate...');
                },
                complete: function () {
                    $('.btnupdate').removeAttr('disabled');
                    $('.btnupdate').html('<i class="fas fa-save"></i> Update');
                },
                success: function (response) {
                    if (response.error) {
                        let err = response.error;
                        if (err.nama_produk) {
                            $('.errornamaProduk').html(err.nama_produk);
                            $('input[name=nama_produk]').addClass('is-invalid');
                        }
                        if (err.harga) {
                            $('.errorharga').html(err.harga);
                            $('input[name=harga]').addClass('is-invalid');
                        }
                        if (err.gambar) {
                            $('.errorgambar').html(err.gambar);
                            $('#input-gambar').addClass('is-invalid');
                        }
                    } else {
                        toastr.success(response.sukses);
                        $('#modaledit').modal('hide');
                        listproduk();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        // Reset validation on input
        $('input, select, textarea').on('input change', function () {
            $(this).removeClass('is-invalid');
        });

        // Preview gambar saat dipilih
        $('#input-gambar').change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview-gambar').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });

    function gantigambar(id_produk) {
        Swal.fire({
            title: 'Ganti Gambar',
            html: `
                <form id="formgantigambar" enctype="multipart/form-data">
                    <input type="hidden" name="id_produk" value="${id_produk}">
                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    <small class="text-muted">Max 2MB, Format: JPG, JPEG, PNG</small>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Upload',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const formData = new FormData(document.getElementById('formgantigambar'));
                formData.append('csrf_tokencmsikasmedia', $('input[name=csrf_tokencmsikasmedia]').val());

                return $.ajax({
                    url: "<?= site_url('produk-umkm/gantigambar') ?>",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json"
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.sukses) {
                    toastr.success(result.value.sukses);
                    $('#modaledit').modal('hide');
                    listproduk();
                } else if (result.value.error) {
                    toastr.error(result.value.error.gambar);
                }
            }
        });
    }
</script>