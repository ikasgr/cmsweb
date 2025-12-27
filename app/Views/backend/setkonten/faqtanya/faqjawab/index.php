<?= $this->section('content') ?>
<?= $this->extend('backend/' . 'script') ?>
<?= $this->include('/backend/datatable-js'); ?>


<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="fas fa-align-center"></i> Data FAQ (Jawaban)</h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Kelola Konten</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('tanyajawab/list') ?>">Pertanyaan</a></li>
                        <li class="breadcrumb-item active"> Jawaban</li>
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

                <div class="card-header font-14 bg-light">
                    <a class="modal-title mt-0">
                        <i class="fas fa-question-circle font-10"></i>
                        <input type="hidden" value="<?= $faq_tanyaid ?>" id="faq_tanyaid" name="faq_tanyaid">

                        <?php
                        if ($list) {
                            foreach ($list as $data):
                            endforeach ?>
                            <a class="text-info"><?= esc($data['faqtanya']) ?></a>
                        <?php } ?>

                    </a>
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
    function listjawaban() {

        faq_tanyaid = $("#faq_tanyaid").val();

        $.ajax({

            url: "<?= site_url('tanyajawab/getjawaban') ?>",
            data: {
                faq_tanyaid: faq_tanyaid,
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
                    showConfirmButton: false,
                    timer: 3100
                });

            }
        });
    }

    $(document).ready(function () {
        listjawaban();

    });
</script>
<?= $this->endSection() ?>