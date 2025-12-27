<?= $this->extend('backend/script') ?>
<?= $this->section('content') ?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Kategori Produk</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Kategori Produk</li>
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
    function listkategori() {
        $.ajax({
            url: "<?= site_url('kategori-produk/getdata') ?>",
            dataType: "json",
            beforeSend: function () {
                $('.viewdata').html('<div class="text-center"><i class="fas fa-spin fa-spinner"></i> Loading...</div>');
            },
            success: function (response) {
                if (response.data) {
                    $('.viewdata').html(response.data);
                }
                if (response.noakses) {
                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Modul ini</strong>`,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
                if (response.blmakses) {
                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak terdaftar di Grup akses Anda. <br>
                        <hr>Hubungi Administrator untuk menambahkan Modul <strong>Kategori Produk</strong> ke grup akses Anda.!`,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function () {
        listkategori();
    });
</script>

<?= $this->endSection() ?>