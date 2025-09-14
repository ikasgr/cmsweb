<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script'); ?>
<?= $this->include('/backend/' . esc($folder) . '/datatable-js'); ?>
<?php
if ($list) {
    foreach ($list as $data) :
        $namasurvei = esc($data['nama_survey']);
    endforeach;
} else {
    $namasurvei = '';
}  ?>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <a class="text-light" style="font-size: 15px;"><i class="mdi mdi-calendar-question"></i> <?= $namasurvei ?></a>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="<?= base_url('survey/all/') ?>">Survei</a></li>
                        <li class="breadcrumb-item"><a href="#">Pertanyaan</a></li>
                        <li class="breadcrumb-item active"> <?= $namasurvei ?></li>
                    </ol>
                    <!-- <a href="" class="btn btn-success">Add Widget</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">

                <input type="hidden" value="<?= $survey_id ?>" id="survey_id" name="survey_id">

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="viewdata"></div>
                </div>
                <div class="viewmodal"></div>
                <!-- /.card-body -->
            </div>

        </div>

    </div>

</div>

<script>
    function listpertanyaan() {

        survey_id = $("#survey_id").val();

        $.ajax({

            url: "<?= site_url('survey/getpertanyaan') ?>",
            data: {
                survey_id: survey_id,
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownerror) {

                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                });

            }
        });
    }

    $(document).ready(function() {
        listpertanyaan();

    });
</script>
<?= $this->endSection() ?>