<?php

$template = ['verbost' => 1];
?>
<div class="modal fade" id="modalview" tabindex="-1" aria-labelledby="modalviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header p-2">
                <h5 class="modal-title"><?= esc($title) ?></h5>

            </div>
            <div class="modal-body">
                <!-- <div class=""> -->
                <table class="table table-hover p-0">
                    <tbody>
                        <?php foreach ($poljawab as $p):

                            if ($jumpol) {
                                $prosentase = sprintf("%.2f", (($p['rating'] / $jumpol) * 100));
                            } else {
                                $prosentase = 0;
                            }

                            ?>
                            <tr>
                                <?php if ($p['type'] == 'Jawaban') { ?>
                                    <td width="200"><?= esc($p['pilihan']) ?> <a
                                            class="text-danger">(<code><?= $p['rating'] ?></code>)</td>
                                    <td>
                                        <div class="progress p-0" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated p-0 pointer"
                                                title="<?= $prosentase ?> %" role="progressbar"
                                                style="width: <?= $prosentase ?>%" aria-valuenow="10" aria-valuemin="0"
                                                aria-valuemax="100"><?= $prosentase ?>%</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="2"><?= esc($p['pilihan']) ?></td>
                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="2"> <b>Jumlah Responden :</b> <a class="text-danger"> <?= $jumpol ?></a> </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
            <div class="modal-footer p-1">

                <?php if ($template['verbost'] == 0) { ?>
                    <a class="d-inline float-left btn btn-danger" data-dismiss="modal">Tutup</a>
                <?php } else { ?>
                    <a class="float-left btn btn-danger" data-bs-dismiss="modal">Tutup</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>