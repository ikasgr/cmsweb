<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script') ?>
<?= $this->include('/backend/' . esc($folder) . '/datatable-js'); ?>


<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="mdi mdi-buffer"></i> Modul Public</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">
                        <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Morvin</a></li> -->
                        <li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('modul') ?>">Modul CMS</a></li>
                        <li class="breadcrumb-item active"> Modul Public</li>
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

                <div class="card-body">
                    <div class="viewdata"></div>
                </div>
                <div class="viewmodal"></div>

            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    function listpublik() {
        $.ajax({
            url: "<?= site_url('modul/getpublik') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
                if (response.noakses) {

                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Modul ini</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '../';
                    })
                }
                if (response.blmakses) {

                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak didaftarkan `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        window.location = '../dashboard';
                    })
                }
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
        listpublik();

    });
</script>



<?= $this->endSection() ?>