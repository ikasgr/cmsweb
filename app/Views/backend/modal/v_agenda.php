<?php


$template = ['verbost' => 1];
$folder = '';
?>
<div class="modal fade" id="modalview">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <!-- <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-lg"> -->
        <div class="modal-content">

            <div class="modal-header p-2">
                <h5 class="modal-title"><?= esc($title) ?></h5>
                <!-- <?php if ($template['verbost'] == 0) { ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><?= ($folder == 'desaku' || $folder == 'plus3') ? '' : 'x' ?></button>
                <?php } else { ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><?= ($folder == 'desaku' || $folder == 'plus3') ? '' : 'x' ?></button>
                <?php } ?> -->
            </div>
            <div class="modal-body">
                <!-- <div class="form-group row"> -->
                <img id='img_load' width='100%' src='<?= base_url('public/img/informasi/agenda/' . $gambar) ?>'>
                <!-- </div> -->
                <!-- <div class="table-responsivex"> -->
                <table class="table table-bordered table-hover table-striped">
                    <tbody>
                        <tr>
                            <td colspan="2"><strong><?= esc($tema) ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $isi ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>Mulai <b><?= date_indo($tgl_mulai) ?></b> sampai dengan
                                <b><?= date_indo($tgl_selesai) ?></b></td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td><strong><?= esc($tempat) ?></strong></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td><strong><?= esc($jam) ?></strong></td>
                        </tr>
                        <tr>
                            <td>Pengirim / Penyelenggara</td>
                            <td><strong><?= esc($pengirim) ?></strong></td>
                        </tr>

                    </tbody>
                </table>
                <!-- </div> -->
            </div>

            <p class="p-1 mb-1 mt-1">
                <?php if ($template['verbost'] == 0) { ?>
                    <a class="ml-3 btn btn-danger" type="button" data-dismiss="modal">Tutup</a>
                <?php } else { ?>
                    <a class="ml-3 btn btn-danger" data-bs-dismiss="modal">Tutup</a>
                <?php } ?>
            </p>

        </div>

    </div>
</div>