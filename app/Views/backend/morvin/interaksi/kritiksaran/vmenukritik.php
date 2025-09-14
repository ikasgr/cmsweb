<div id="viewdata2">
    <?php
    if ($list) {
        foreach ($list as $key => $value) {
    ?>
            <a title="Kritik Saran" onclick="viewkritik2('<?= $value['kritiksaran_id'] ?>')" class="text-reset notification-item pointer">
                <div class="media">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title bg-danger rounded-circle font-size-16">
                            <i class="ti-comments text-white"></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <h6 class="mt-0 mb-1"><?= esc($value['nama']) ?> </h6>
                        <div class="font-size-13 text-muted">
                            <p class="mb-1"><?= esc($value['judul']) ?></p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= date_indo($value['tanggal']) ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>

    <?php } ?>
</div>




<script>
    function viewkritik2(kritiksaran_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('kritiksaran/formedit') ?>",
            data: {
                csrf_tokencmsdatagoe: $('input[name=csrf_tokencmsdatagoe]').val(),
                kritiksaran_id: kritiksaran_id
            },
            dataType: "json",
            success: function(response) {
                if (response.noakses) {

                    Swal.fire({
                        title: "Gagal Akses!",
                        html: `Anda tidak berhak mengakses <strong>Modul ini</strong> `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        // window.location = '../';
                    })
                }
                if (response.blmakses) {

                    Swal.fire({
                        title: "Maaf gagal load Modul!",
                        html: `Modul ini belum atau tidak didaftarkan `,
                        icon: "error",
                        showConfirmButton: false,
                        timer: 3100
                    }).then(function() {
                        // window.location = '../admin';
                    })
                }
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#modaledit').modal('show');
                }
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
</script>