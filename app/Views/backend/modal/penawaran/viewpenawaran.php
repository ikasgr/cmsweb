<div class="modal fade" id="modalview">
    <div class="modal-dialog modal-lg box-shadow modal-dialog-scrollable">
        <div class="modal-content">

            <!-- <div class="card-header p-2">
                <h5 class="modal-title m-0"><?= esc($konfigurasi['judultawaran']) ?>
                    <button type="button" class="btn btn-sm btn-danger float-right btn-modal-close" data-dismiss="modal" aria-label="Close"><span>X</span></button>
                </h5>
            </div> -->
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($konfigurasi['judultawaran']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php

                if (file_exists('public/img/informasi/' . esc($konfigurasi['gbrtawaran']))) {
                    $gbr = base_url('public/img/informasi/' . esc($konfigurasi['gbrtawaran']));
                } else {
                    $gbr = base_url('public/img/konfigurasi/pimpinan/default.png');
                }

                ?>
                <center>
                    <img class="img-fluid" src="<?= $gbr ?>" alt="">
                </center>
                <div class="p-3 text-justify">
                    <p>
                        <?= $konfigurasi['isitawaran'] ?>
                    </p>
                </div>
            </div>
            <div class="modal-footer p-1">
                <?php if ($konfigurasi['sts_tombol'] != 0) { ?>
                    <a href="<?= $konfigurasi['linktawaran'] ?>" class="btn btn-primary"><?= esc($konfigurasi['namatombol']) ?></a>
                <?php  } ?>

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Jangan tampilkan lagi</button>

            </div>
        </div>
    </div>
</div>