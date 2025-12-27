<?= $this->extend('backend/template-backend') ?>

<?= $this->section('menu') ?>
<?= $this->include('backend/menu') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Jadwal Pelayanan</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jadwal Pelayanan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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
    function listjadwal() {
        $.ajax({
            url: "<?= base_url('jadwal-pelayanan/list') ?>",
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
        listjadwal();
    });
</script>

<?= $this->endSection() ?>