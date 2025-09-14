<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script'); ?>
<?= $this->include('/backend/' . esc($folder) . '/datatable-js'); ?>
<?php
if ($list) {
    foreach ($list as $data) :
        $namaproduk = esc($data['nama_produk']);
    endforeach;
} else {
    $namaproduk = '';
}

?>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="mdi mdi-scale-balance"></i> <?= esc($nama_kathukum) ?></h4>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('produkhukum/all') ?>">Produk Hukum</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('produkhukum/subproduk/' . $produk_id) ?>"><?= $namaproduk ?></a></li>
                        <li class="breadcrumb-item active"><?= esc($nama_kathukum) ?></li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">

                <input type="hidden" name="kathukum_id" value="<?= $kathukum_id ?>" id="kathukum_id" name="kathukum_id">

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
    function listsubsubproduk() {

        subproduk = $("#kathukum_id").val();
        // alert(subproduk)
        $.ajax({

            url: "<?= site_url('produkhukum/subsubprodukajx') ?>",
            data: {
                subproduk: subproduk,
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
        listsubsubproduk();

    });
</script>
<?= $this->endSection() ?>