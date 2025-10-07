        <?= form_open_multipart('', ['class' => 'formtambahx']) ?>
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />

        <table class="table table-hover tambahform">
            <thead class="bg-light p-1">
                <tr>
                    <th>Keterangan *</th>
                    <th>Gambar *</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <!-- <td id="idhide"> -->
                    <input type="hidden" name="foto_id[]" class="centangid" checked>
                    <!-- </td> -->
                    <input type="hidden" name="kategorifoto_id" value="<?= $kategorifoto_id ?>" class="form-control">

                    <td class=" pb-0 pt-1 p-2">
                        <textarea type="text" rows="1" name="judul[]" id="judul" class="form-control p-2"></textarea>
                        <div class="invalid-feedback errorjudul"></div>
                    </td>
                    <td class=" pb-0 pt-1 p-2">
                        <input type="file" class="form-control p-2" required id="gambar" name="gambar[]">
                        <div class="invalid-feedback errorgambar">
                    </td>

                    <td class="pb-0 pt-1 p-2">
                        <button type="button" class="btn btn-primary waves-effect waves-light tambahelemen p-2"><i class="fas fa-plus-circle"></i></button>
                    </td>
                </tr>

            </tbody>

        </table>
        <div class="modal-footer">
            <td>
                <button type="button" class="btn btn-primary btnupload2"><i class="mdi mdi-content-save-all"></i> Simpan Data</button>

            </td>
        </div>
        <?= form_close() ?>

        <script>
            $(document).ready(function() {
                // $(idhide).hide();
                $('.btnupload2').click(function(e) {
                    e.preventDefault();

                    let jmldata = $('.centangid:checked');
                    let gambar = $('file#gambar').val()
                    let form = $('.formtambahx')[0];
                    let data = new FormData(form);
                    // data.append('gambar[]', file);
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

                        $.ajax({

                            type: "post",
                            url: '<?= site_url('foto/simpanmulti') ?>',
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            dataType: "json",

                            beforeSend: function() {
                                $('.btnupload2').attr('disable', 'disable');
                                $('.btnupload2').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                            },
                            complete: function() {
                                $('.btnupload2').removeAttr('disable', 'disable');
                                $('.btnupload2').html('<i class="mdi mdi-content-save-all"></i>  Simpan Data');
                            },
                            success: function(response) {
                                if (response.error) {
                                    if (response.error.judul) {
                                        toastr["error"](response.error.judul)
                                    }
                                    if (response.error.gambar) {
                                        toastr["error"](response.error.gambar)
                                    }
                                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                                } else {
                                    toastr["success"](response.sukses)
                                    $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                                    listfoto();
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownerror) {
                                toastr["error"]("Maaf gagal simpan Kode Error:  " + (xhr.status + "\n"), );
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                            }

                        });

                });
            });


            //elemen add
            $('.tambahelemen').click(function(e) {
                e.preventDefault();
                $('.tambahform').append(`
                             
                    <tr>
                        <td class="pb-0 pt-1 p-2">
                           <textarea type="text" rows="1" name="judul[]" id="judul" class="form-control p-2" style="width: 100%;"></textarea>
                            <div class="invalid-feedback errorjudul"></div>
                        </td>
                   
                        <td class="pb-0 pt-1 p-2">
                            <input type="file" class="form-control p-2" required id="gambar" name="gambar[]">
                            <div class="invalid-feedback errorgambar"></div>
                        </td>
                     
                        <td class="pb-0 pt-1 p-2">
                            <button type="button" class="btn btn-danger waves-effect waves-light hapuselemen text-secondary p-2"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
               
        `);
            });

            $(document).on('click', '.hapuselemen', function(ex) {
                ex.preventDefault();
                $(this).parents('tr').remove();

            });
        </script>