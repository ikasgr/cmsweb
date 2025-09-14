<div id="viewdatakomen">
    <?php
    if ($list) {
        foreach ($list as $key => $value) {
            $tglkomen  = convertDatetime($value["tanggal_komen"]);
    ?>
            <a title="Komentar Berita" onclick="viewkom('<?= $value['beritakomen_id'] ?>')" class="text-reset notification-item pointer">
                <div class="media">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                            <i class="ti-comment-alt text-white"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?= htmlentities($value['nama_komen']) ?></h6>
                        <div class="font-size-13 text-muted">
                            <p class="mb-1"><?= esc($value['judul_berita']) ?></p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= $tglkomen ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>

    <?php } ?>
</div>

<script>
    function viewkom(beritakomen_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('berita/formkomenback') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                beritakomen_id: beritakomen_id
            },
            dataType: "json",
            success: function(response) {
                if (response.noakses) {

                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Form ini</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        // window.location = '../';
                    })
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
                if (response.blmakses) {

                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Form ini belum atau tidak didaftarkan `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        // window.location = '../admin';
                    })
                }
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalkomen').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modalkomen').modal('show');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {

                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    // showConfirmButton: false,
                    // timer: 3100
                });
                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
            }
        });
    }
</script>