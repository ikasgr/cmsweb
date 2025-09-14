<?php
$db = \Config\Database::connect();
?>

<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</section>

<section class="container pb-0">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsikasmedia" />
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">

                    <h1 class="text-blue montserrat-700 f-30 text-center">Transparansi Anggaran </h1>
                    <hr>


                    <div style="background-color: #fff8dc;border-radius: 5px;border: 1px solid #ffdb92;margin: 0 5px 0 0px;" class="row pt-3">

                        <div class="col-lg-10 col-md-12 col-sm-12">
                            <div class="mb-3 d-flex">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-group">

                                        <select class="form-control pointer" name="tahun" id="tahun">
                                            <option value="">-Pilih Tahun Anggaran-</option>
                                            <?php
                                            $thnini = date('Y');
                                            for ($i = 2015; $i <= $thnini; $i++) { ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php }  ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="flex-grow-1 ml-1">

                                    <select name="judul" id="judul" class="form-control pointer">
                                        <option Disabled=true Selected=true>-- Silahkan Pilih Judul--</option>
                                        <?php foreach ($listopsi as $key => $data) { ?>
                                            <option value="<?= esc($data['judul']) ?>"><?= esc($data['judul']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-sm-12">
                            <button type="button" class="btn btn-primary btn-block mb-3" id="terapkan">Terapkan</button>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class=" m-b-20">
                            <!-- <div class="card-body"> -->

                            <div class="viewtampilgrafik text-center"></div>

                            <!-- </div> -->

                        </div> <!-- end statistik -->
                        <div class="alert alert-light" style='background-color:#f4f4f4; border-color:#e3e3e3;'>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                Jika data yang dicari tidak ditemukan, Silahkan klik <b class="pointer" onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk lakukan permintaan Informasi.
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        TampilGrafikAwal();

        $('#terapkan').click(function(e) {

            e.preventDefault();
            TampilGrafik();
        });

    });

    // awal
    function TampilGrafikAwal() {
        $.ajax({
            type: "post",
            url: "<?= site_url('transparansi/TampilkanGrafikAll') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                tahun: $('#tahun').val(),
                judul: $('#judul').val(),
            },
            dataType: "json",

            beforeSend: function() {
                $('.viewtampilgrafik').html('<span class="spinner-border spinner-grow-sm text-center" role="status" aria-hidden="true"></span> <i>Loading...</i>');
            },

            success: function(response) {
                if (response.data) {
                    $('.viewtampilgrafik').html(response.data);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }

    function TampilGrafik() {
        $.ajax({
            type: "post",
            url: "<?= site_url('transparansi/TampilkanGrafik') ?>",
            data: {
                // [csrfToken]: csrfHash,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                tahun: $('#tahun').val(),
                judul: $('#judul').val(),


            },
            dataType: "json",

            beforeSend: function() {
                $('.viewtampilgrafik').html('<span class="spinner-border spinner-grow-sm text-center" role="status" aria-hidden="true"></span> <i>Loading...</i>');
            },

            success: function(response) {
                if (response.data) {
                    $('.viewtampilgrafik').html(response.data);
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function() {
                    // window.location = '';
                })
            }
        });
    }
</script>

<?= $this->endSection() ?>