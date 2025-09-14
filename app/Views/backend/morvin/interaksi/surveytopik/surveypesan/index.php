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
                    <h5 class="text-light"><i class="fas fa-diagnoses"></i> List Responden</h5>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="<?= base_url('survey/all/') ?>">Survei</a></li>
                        <li class="breadcrumb-item"><a href="#">Responden</a></li>
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
                <div class="card-header font-14 bg-light">
                    <h6 class="modal-title mt-0">

                        <i class="fas fa-diagnoses"></i> Topik

                        <a class="text-danger"><?= $namasurvei ?></a>


                    </h6>
                </div>
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
    function listsurveypesan() {

        survey_id = $("#survey_id").val();

        $.ajax({

            url: "<?= site_url('survey/getpesan') ?>",
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
                    //  showConfirmButton: false,
                    // timer: 3100
                });

            }
        });
    }

    $(document).ready(function() {
        listsurveypesan();

    });
</script>
<?= $this->endSection() ?>