<?php

$template = ['verbost' => 1];


$ipdetek = $_SERVER['REMOTE_ADDR'];
$agentdetek = $_SERVER['HTTP_USER_AGENT'];

// cek coki
// $ipcek          = get_cookie("ip");
// $agentcek       = get_cookie("agent");
// $layanan_idcek  = get_cookie("layid");
// // Validasi apakah cookie cocok dengan IP, agen, dan layanan
// $pollingSudahDiisi = $ipcek === $ipdetek
//     && $agentcek === $agentdetek
//     && $layanan_idcek == $informasi_id;
?>
<div class="modal fade" id="modalview" tabindex="-1" aria-labelledby="modalviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= $title ?></h5>
                <?php if ($template['verbost'] == 0) { ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <?php } else { ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <?php } ?>
            </div>
            <div class="modal-body">
                <?php if ($is_poling_closed): ?>
                    <!-- Tampilkan hasil polling -->
                    <b><?= $poltanya ?></b>
                    <table class="table table-hover p-0 pt-0">
                        <tbody>
                            <?php foreach ($poljawab as $p): ?>
                                <?php
                                $prosentase = $jumpol ? sprintf("%.2f", (($p['rating'] / $jumpol) * 100)) : 0;
                                ?>
                                <tr>
                                    <td width="200"><?= esc($p['pilihan']) ?> <a
                                            class="text-danger">(<code><?= $p['rating'] ?></code>)</a></td>
                                    <td>
                                        <div class="progress  p-0" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated p-0 pointer"
                                                title="<?= $prosentase ?>%" role="progressbar"
                                                style="width: <?= $prosentase ?>%" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100"><?= $prosentase ?>%</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"> <b>Jumlah Responden :</b> <a class="text-danger"> <?= $jumpol ?></a> </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <!-- Tampilkan form polling -->
                    <b><?= $poltanya ?></b>
                    <?= form_open_multipart('', ['class' => 'formtambah']) ?>
                    <input type="hidden" class="form-control" id="informasi_id" value="<?= $informasi_id ?>"
                        name="informasi_id">
                    <?php foreach ($poljawab as $p): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="poling_id" id="radpol<?= $p['poling_id'] ?>"
                                value="<?= $p['poling_id'] ?>">
                            <label class="form-check-label pointer" for="radpol<?= $p['poling_id'] ?>">
                                <?= esc($p['pilihan']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <br>
                    <div class="modal-footer pt-1">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btnsimpanisipolinglay">Pilih</button>
                    </div>
                    <?= form_close() ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script>
    $('.btnsimpanisipolinglay').click(function (e) {

        e.preventDefault();
        let form = $('.formtambah')[0];
        let data = new FormData(form);
        $.ajax({
            type: "post",
            url: '<?= site_url('layanan/ubahpoling') ?>',
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('.btnsimpanisipolinglay').attr('disable', 'disable');
                $('.btnsimpanisipolinglay').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
            },
            complete: function () {
                $('.btnsimpanisipolinglay').removeAttr('disable', 'disable');
                $('.btnsimpanisipolinglay').html('Pilih');
            },
            success: function (response) {
                if (response.error) {

                    Swal.fire({
                        // title: "Maaf..!",
                        html: `Silahkan pilih salah satu jawaban diatas. `,
                        icon: "error",
                        width: '400px',
                        height: '90px'
                        // showConfirmButton: false,
                        // timer: 3550
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
                if (response.gagal) {

                    Swal.fire({
                        title: "Maaf..!",
                        text: response.gagal,
                        icon: "error",
                        width: '400px',
                        height: '90px'
                        // showConfirmButton: false,
                        // timer: 3550
                    });
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
                if (response.sukses) {

                    Swal.fire({
                        title: "Sukses!",
                        text: response.sukses,
                        icon: "success",
                        width: '400px',
                        height: '90px'
                        // showConfirmButton: false,
                        // timer: 3550
                    }).then(function () {
                        window.location = '<?= base_url('') ?>';
                    });
                }

            },
            error: function (xhr, ajaxOptions, thrownerror) {

                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
            }
        });
    });
</script>