        <?= form_open_multipart('', ['class' => 'formtambahx']) ?>
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />

        <table class="table table-hover tambahform">
            <thead class="bg-light p-1">
                <tr>
                    <!-- <th width="0"></th> -->
                    <th>Judul </th>
                    <th>Kategori </th>
                    <th>Deskripsi </th>
                    <th>Link Youtube</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <input type="hidden" name="video_id[]" class="centangid" checked>

                    <td class="pb-0 pt-1 p-2">
                        <input type="text" class="form-control" required id="judul" name="judul[]">
                        <div class="invalid-feedback errorjudul">
                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <select name="kategorivideo_id[]" id="kategorivideo_id" class="form-select pointer">
                            <option Disabled=true Selected=true>-- Pilih Kategori --</option>

                            <?php foreach ($kategori as $key => $data) { ?>
                                <option value="<?= $data['kategorivideo_id'] ?>"><?= esc($data['nama_kategori_video']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <textarea type="text" rows="1" id="ket_video" name="ket_video" class="form-control"></textarea>

                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <input type="text" class="form-control" required id="video_link" name="video_link[]" placeholder="X_fh-xVmto0">
                        <div class="invalid-feedback errorvideo_link">
                    </td>

                    <td class="pb-0 pt-1 p-2">
                        <button type="button" class="btn btn-primary tambahelemen p-2"><i class="fas fa-plus-circle"></i></button>
                    </td>
                </tr>

            </tbody>

        </table>
        <div class="modal-footer">
            <td>
                <button type="button" class="btn btn-primary btnupload2"><i class="mdi mdi-content-save-all"></i> Simpan</button>

            </td>
        </div>
        <?= form_close() ?>

        <script>
            $(document).ready(function() {
                $('.btnupload2').click(function(e) {
                    e.preventDefault();

                    let jmldata = $('.centangid:checked');
                    let gambar = $('file#gambar').val()
                    let form = $('.formtambahx')[0];
                    let data = new FormData(form);
                    // data.append('gambar[]', file);


                    $.ajax({

                        type: "post",
                        url: '<?= site_url('video/simpanmulti') ?>',
                        data: data,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        beforeSend: function() {
                            $('.btnupload').attr('disable', 'disable');
                            $('.btnupload').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                        },
                        complete: function() {
                            $('.btnupload').removeAttr('disable', 'disable');
                            $('.btnupload').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                        },
                        success: function(response) {
                            if (response.error) {

                                if (response.error.judul) {
                                    toastr["error"](response.error.judul)
                                }
                                if (response.error.video_link) {
                                    toastr["error"](response.error.video_link)
                                }
                                if (response.error.kategorivideo_id) {
                                    toastr["error"](response.error.kategorivideo_id)
                                }
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);

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
                                $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                                listvideo();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownerror) {
                            toastr["error"]("Maaf gagal simpan Kode Error:  " + (xhr.status + "\n"), );
                            $('input[name=csrf_tokencmsdatagoe]').val(response.csrf_tokencmsdatagoe);
                        }

                    });

                });
            });

            //back

            $('.kembali').click(function(e) {

                e.preventDefault();
                $.ajax({
                    url: "<?= site_url('video/getdata') ?>",
                    dataType: "json",
                    success: function(response) {
                        // $('.viewdata').html(response.data);
                        listvideo();
                    }
                });
            });

            //elemen add
            $('.tambahelemen').click(function(e) {

                e.preventDefault();
                $('.tambahform').append(`
        
                <tr>
                  <input type="hidden" name="video_id[]" class="centangid" checked>
                     <td class="pb-0 pt-1 p-2">
                        <input type="text" class="form-control p-2" required id="judul" name="judul[]">
                        <div class="invalid-feedback errorjudul">
                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <select name="kategorivideo_id[]" id="kategorivideo_id" class="form-select pointer p-2">
                            <option Disabled=true Selected=true>-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $key => $data) { ?>
                                <option value="<?= $data['kategorivideo_id'] ?>"><?= esc($data['nama_kategori_video']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <textarea type="text" rows="1" id="ket_video" name="ket_video" class="form-control p-2"></textarea>
                    </td>
                    <td class="pb-0 pt-1 p-2">
                        <input type="text" class="form-control p-2" required id="video_link" name="video_link[]" placeholder="X_fh-xVmto0">
                        <div class="invalid-feedback errorvideo_link">
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