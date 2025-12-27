<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>


            <?= form_open_multipart('', ['class' => 'formtambah']) ?>


            <div class="modal-body">
                <div class="form-group mb-2">
                    <label>
                        Nama Unit Kerja
                    </label>

                    <input type="text" id="nama_opd" name="nama_opd" class="form-control">
                    <div class="invalid-feedback errornama_opd"></div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>
                            Singkatan Penerbit
                        </label>
                        <input type=" text" id="singkatan_opd" name="singkatan_opd" class="form-control">
                        <div class="invalid-feedback errorsingkatan_opd"></div>
                    </div>

                    <div class="form-group col-md-6 col-12 mb-2">
                        <label>
                            Tipe
                        </label>

                        <select name="tipe_id" id="tipe_id" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Pilih Tipe --</option>
                            <?php foreach ($tipe as $key => $data) { ?>
                                <option value="<?= $data['tipe_id'] ?>"><?= esc($data['nama_tipe']) ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errortipe_id"></div>
                    </div>

                </div>
                <div class="form-group mb-2">
                    <label>
                        Alamat
                    </label>
                    <input type="text" id="alamat" name="alamat" class=" form-control">
                    <div class="invalid-feedback erroralamat"></div>

                </div>

                <div class="form-group">
                    <label>
                        Deskripsi Penerbit
                    </label>
                    <textarea type="text" id="deskripsi_opd" name="deskripsi_opd" class="form-control"></textarea>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i>
                    Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('.btnsimpan').click(function (e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: '<?= site_url('unitkerja/simpan') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function () {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                },
                success: function (response) {
                    if (response.error) {

                        if (response.error.nama_opd) {
                            $('#nama_opd').addClass('is-invalid');
                            $('.errornama_opd').html(response.error.nama_opd);
                        } else {
                            $('#nama_opd').removeClass('is-invalid');
                            $('.errornama_opd').html('');
                        }

                        if (response.error.deskripsi) {
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        } else {
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }

                        if (response.error.singkatan_opd) {
                            $('#singkatan_opd').addClass('is-invalid');
                            $('.errorsingkatan_opd').html(response.error.singkatan_opd);
                        } else {
                            $('#singkatan_opd').removeClass('is-invalid');
                            $('.errorsingkatan_opd').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
                        }


                        if (response.error.tipe_id) {
                            $('#tipe_id').addClass('is-invalid');
                            $('.errortipe_id').html(response.error.tipe_id);
                        } else {
                            $('#tipe_id').removeClass('is-invalid');
                            $('.errortipe_id').html('');
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);

                    } else {

                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        },
                            toastr["success"](response.sukses)
                        $('#modaltambah').modal('hide');
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        listunitkerja();
                    }
                },
                error: function (xhr, ajaxOptions, thrownerror) {
                    toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"),);
                    $('#modaltambah').modal('hide');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            });
        });
    });
</script>