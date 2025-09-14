<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script') ?>
<?= $this->include('/backend/' . esc($folder) . '/datatable-js'); ?>


<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="mdi mdi-chart-arc"></i> <?= esc($nama) ?></h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('transparansi/list') ?>">Transparansi</a></li>
                        <li class="breadcrumb-item active"> <?= esc($nama) ?></li>
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

                <input type="hidden" name="transparan_id" value="<?= $transparan_id ?>" id="transparan_id" name="transparan_id">

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
    function listdetailtransparansi() {

        transparansi = $("#transparan_id").val();

        $.ajax({

            url: "<?= site_url('transparansi/detailajx') ?>",
            data: {
                transparansi: transparansi,
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
        listdetailtransparansi();

    });
</script>
<?= $this->endSection() ?>