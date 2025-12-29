<?= $this->section('content') ?>
<?= $this->extend('backend/script'); ?>
<?= $this->include('backend/datatable-js'); ?>

<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="far fa-clone"></i> <?= esc($subtitle) ?></h4>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active"> <?= esc($subtitle) ?></li>
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

                <input type="hidden" class="form-control" id="req" value="<?= $reqs ?>" readonly>
                <input type="hidden" class="form-control" id="jns" value="<?= $jns ?>" readonly>
                <input type="hidden" class="form-control" id="jdl" value="<?= $subtitle ?>" readonly>
                <input type="hidden" class="form-control" id="stsm" value="<?= $stsm ?>" readonly>
                <input type="hidden" class="form-control" id="nmbscontrol" value="<?= $nmbscontrol ?>" readonly>
                <input type="hidden" class="form-control" id="toltip" value="<?= $toltip ?>" readonly>
                <input type="hidden" class="form-control" id="url" value="<?= $url ?>" readonly>

                <div class="card-body">
                    <div class="viewdata"></div>
                </div>
                <div class="viewmodal"></div>

            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    function listmaster() {
        req = $("#req").val();
        jns = $("#jns").val();
        jdl = $("#jdl").val();
        stsm = $("#stsm").val();
        nmbscontrol = $("#nmbscontrol").val();
        toltip = $("#toltip").val();
        url = $("#url").val();
        $.ajax({
            url: "<?= site_url('masterdata/getdata') ?>",
            data: {
                req: req,
                jns: jns,
                jdl: jdl,
                stsm: stsm,
                nmbscontrol: nmbscontrol,
                toltip: toltip,
                url: url,
            },
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);

                if (response.noakses) {

                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Modul ini</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function () {
                        window.location = '<?= base_url('/') ?>';
                    })
                }
                if (response.blmakses) {

                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak didaftarkan `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function () {
                        window.location = '<?= base_url('/') ?>';
                    })
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {

                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                }).then(function () {
                    window.location = '<?= base_url('/') ?>';

                });
            }
        });
    }

    $(document).ready(function () {
        listmaster();
    });
</script>



<?= $this->endSection() ?>