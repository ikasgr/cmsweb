<?php

$template = ['verbost' => 1];
$folder = '';

if ($folder == 'plus1' || $folder == 'plus2' || $folder == 'desaku') { ?>
    <style>
        ol {
            padding: 15px;
        }

        ul {
            list-style-type: disc;
            margin-left: 8px;
        }

        ol li {
            list-style-type: number;
            margin-left: 15px;
        }

        ul li {
            /* list-style-type: square; */
            /* margin-left: 15px; */
            list-style-type: disc;
            margin-left: 8px;
        }
    </style>
<?php } ?>
<div class="modal fade" id="modalview">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header p-2">
                <h5 class="modal-title"><?= esc($title) ?></h5>
            </div>
            <div class="modal-body">
                <!-- <div class="form-group row"> -->
                <?php
                $imageon = $webutama . '/public/img/informasi/layanan/' . esc($gambar); ?>
                <img id='img_load' width='100%' src=<?= $imageon ?>>
                <!-- </div> -->
                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped">
                        <tbody>
                            <tr>
                                <td colspan="2"><strong><?= esc($nama) ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"><?= ($isi_informasi) ?></td>
                            </tr>
                            <?php if (esc($fileunduh) != '') {
                                // $filedown   = $webutama . '/public/unduh/layanan/' . esc($fileunduh);
                                ?>
                                <tr>
                                    <td colspan="2" class="text-center p-1">
                                        <a href="<?= ('download-layanan/' . $fileunduh); ?>" target="_blank"><button
                                                class="btn btn-success"><i class="fas fa-download"></i> Unduh File</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="p-1 mb-1">
                <?php if ($template['verbost'] == 0) { ?>
                    <a class="ml-3 btn btn-danger" type="button" data-dismiss="modal">Tutup</a>
                <?php } else { ?>
                    <a class="ml-3 btn btn-danger" data-bs-dismiss="modal">Tutup</a>
                <?php } ?>
            </p>
        </div>
    </div>

</div>