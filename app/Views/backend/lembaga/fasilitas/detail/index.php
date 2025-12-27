<?= $this->section('content') ?>
<?= $this->extend('backend/script'); ?>
<?= $this->include('/backend/datatable-js'); ?>
<?php
if ($list) {
    foreach ($list as $data):
    endforeach; ?>

        <a class="text-primary"> <b><?= $data['fasilitas'] ?></b></a>


<?php } ?>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="mdi mdi-folder-star"></i> <?= $data['fasilitas'] ?></h4>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="<?= base_url('fasilitas/list') ?>">Fasilitas</a></li>
                        <li class="breadcrumb-item active"> <?= $data['fasilitas'] ?></li>
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

                <div class="card-header font-18 bg-light">
                    <h6 class="modal-title mt-0">
                        <i class="fas fa-align-center"></i> DETAIL
                        <input type="hidden" name="fasilitas_id" value="<?= $fasilitas_id ?>" id="fasilitas_id"
                            name="fasilitas_id">
                        <!-- <div class="float-right">
                                <button type="button" class="btn btn-block btn-primary btn-sm tambah"><i class="fas fa fa-plus-circle"></i> TAMBAH DATA</button>
                            </div> -->


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
    function listdetailfasilitas() {

        fasilitas = $("#fasilitas_id").val();

        $.ajax({

            url: "<?= site_url('fasilitas/detailajx') ?>",
            data: {
                fasilitas: fasilitas,
            },
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownerror) {

                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                });

            }
        });
    }

    $(document).ready(function () {
        listdetailfasilitas();

    });
</script>
<?= $this->endSection() ?>