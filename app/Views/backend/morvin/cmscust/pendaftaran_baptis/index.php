<?= $this->extend('backend/' . esc($folder) . '/template-backend') ?>

<?= $this->section('menu') ?>
<?= $this->include('backend/' . esc($folder) . '/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Pendaftaran Baptis</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pendaftaran Baptis</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="viewdata"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal"></div>

<script>
    function listpendaftaranbaptis() {
        $.ajax({
            url: "<?= base_url('pendaftaran-baptis/getdata') ?>",
            dataType: "json",
            beforeSend: function () {
                $('.viewdata').html('<div class="text-center"><i class="fas fa-spin fa-spinner"></i> Loading...</div>');
            },
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function () {
        listpendaftaranbaptis();
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script
    src="<?= base_url('public/template/backend/' . esc($folder) . '/assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script
    src="<?= base_url('public/template/backend/' . esc($folder) . '/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<?= $this->endSection() ?>