<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script') ?>

<style>
    #grad1 {

        background: rgb(238, 174, 202);
        background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
        margin: auto;
        max-width: 100%;
    }

    #Miracle {

        background-image: linear-gradient(to top, #cd9cf2 0%, #f6f3ff 100%);
    }
</style>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="mdi mdi-palette"></i> <?= esc($title) ?></h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
                        <li class="breadcrumb-item active"> <?= esc($title) ?></li>
                    </ol>
                    <!-- <a href="" class="btn btn-success">Add Widget</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">

    <div class="card mb-4">
        <div class='card-body'>
            <div class=" text-center">
                <div class="alert alert-primary alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Silahkan pilih jenis template dibawah yang hendak di terapkan atau di konfigurasikan..!
                </div>
                <img class="" src="<?= base_url('public/template/backend/morvin/assets/images/tema.jpg') ?>" alt="not found" width="30%" height="">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-body shadow-sm" id="Miracle">
                        <h3 class="card-title font-size-17 mt-0">Template Website</h3>
                        <p class="card-text">Tersedia <b class="text-danger font-size-14"><?= $jtemafront ?></b> tema yang dapat anda Terapkan</p>
                        <a href="template/front" class="btn btn-primary waves-effect waves-light">Go to template website</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body" id="Miracle">
                        <h3 class="card-title font-size-17 mt-0">Template Admin</h3>
                        <p class="card-text">Tersedia <b class="text-danger font-size-14"><?= $jtemaback ?></b> tema yang dapat Anda Terapkan</p>
                        <a href="template/back" class="btn btn-primary waves-effect waves-light">Go to template admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>