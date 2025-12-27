<div id="viewonline">

    <?php

    use App\Models\M_Ikasmedia_grupakses;

    $this->grupakses = new M_Ikasmedia_grupakses();
    $db = \Config\Database::connect();
    $id_grup = session()->get('id_grup');
    $userid = session()->get('id');
    $list = $db->table('users')->where('id', $userid)->get()->getRowArray();
    $listgrupno = $db->table('cms__usergrup')->where('id_grup', $id_grup)->get()->getRowArray();
    $role = $listgrupno ? esc($listgrupno['nama_grup']) : '-';
    $gm = 'Pengaturan';

    $listgrupakses = $this->grupakses->grupaksessubmenu($id_grup, $gm);
    if ($listgrupakses) {

        foreach ($listgrupakses as $data):

            $akses = $data['akses'];

            if ($akses == '1') {

                if ($data['urlmenu'] == 'user') { ?>
                    <!-- <h6 class="header-title border-bottom ">TERAKHIR LOGIN</h6> -->
                    <div class="card-body ">
                        <h4 class="header-title mb-2">Informasi Login</h4>
                        <div data-simplebar style="max-height: 205px;">
                            <ul class="list-unstyled chat-list">
                                <?php if ($user) {
                                    foreach ($user as $data):
                                        $id_grupr = $data['id_grup'];
                                        $listgrup = $db->table('cms__usergrup')->where('id_grup', $id_grupr)->get()->getRowArray();
                                        $cekon = $db->table('cms__usersessions')->where('user_id', $data['id'])->get()->getRow();
                                        $namagrup = $listgrup ? esc($listgrup['nama_grup']) : '-';
                                        $lastlogin = convertDatetime($data["last_login"]);
                                        $userImage = esc($data['user_image']);
                                        $profil = ($userImage != 'default.png' && file_exists('public/img/user/' . $userImage)) ? $userImage : 'default.png';
                                        ?>
                                        <li class="">
                                            <a href="#">
                                                <div class="media">
                                                    <div class="align-self-center me-3">
                                                        <i class="mdi mdi-circle text-<?= ($cekon) ? 'success' : 'warning' ?> font-size-10"></i>
                                                    </div>
                                                    <div class="align-self-center me-3">
                                                        <img src="<?= base_url('public/img/user/' . $profil) ?>"
                                                            class="rounded-circle avatar-xs" alt="">
                                                    </div>

                                                    <div class="media-body overflow-hidden">
                                                        <h5 class="text-truncate font-size-14 mb-1"><?= esc($data['fullname']) ?> <small
                                                                class="text-danger">(<?= $namagrup ?>)</small></h5>
                                                        <p class="text-truncate mb-0 font-size-12"><?= $lastlogin ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- <hr class="mt-2 mb-1" /> -->
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- Tombol bawah -->
                            <div class="text-center border-top pt-2">

                                <button type="button" id="resetStatus" class="btn btn-warning btn-sm waves-effect waves-light refresh"
                                    title="Klik disini untuk OFFkan status Online bila pengguna keluar tanpa Logoff.">
                                    <i class="mdi mdi-account-convert text-light"></i> Reset
                                </button>


                                <?php if ($sessionFilesCount > 10) { ?>
                                    <button type="button" id="hapusSession" data-dir="./writable/session/"
                                        class="btn btn-danger btn-sm waves-effect waves-light delfile"
                                        title="Klik disini untuk hapus file session.">
                                        <i class="mdi mdi-recycle text-light"></i> <?= $sessionFilesCount ?> Session
                                    </button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-info btn-sm waves-effect waves-light" title="Jumlah file session.">
                                        <i class="mdi mdi-file-refresh"></i> <?= $sessionFilesCount ?> Session
                                    </button>
                                <?php } ?>
                                <?php if ($logFilesCount > 10) { ?>
                                    <button id="hapusLogs" title="Klik disini untuk hapus file logs."
                                        class="btn btn-danger btn-sm waves-effect waves-light" data-dir="./writable/logs/"
                                        data-timelimit="10"><i class="mdi mdi-delete-sweep text-light"></i> <?= $logFilesCount ?> Logs</button>
                                <?php } else { ?>
                                    <button title="Jumlah file logs." class="btn btn-info btn-sm waves-effect waves-light"> <i
                                            class="mdi mdi-file-clock"></i> <?= $logFilesCount ?> Logs</button>
                                <?php } ?>

                            </div>
                        <?php } ?>

                    </div>
                <?php }
            }
        endforeach;
        # end administrator
    } else { ?>

        <div class="card-body pt-1">

            <!-- jika ada yg online selain dia -->
            <?php if ($useron) { ?>
                <h6 class="header-title border-bottom p-2">Informasi Login</h6>
                <div data-simplebar style="max-height: 205px;">
                    <ul class="list-unstyled chat-list">
                        <?php
                        foreach ($useron as $data):

                            $listgrup = $db->table('cms__usergrup')->where('id_grup', $data['id_grup'])->get()->getRowArray();
                            $cekon = $db->table('cms__usersessions')->where('user_id', $data['id'])->get()->getRow();
                            $lastlogin = convertDatetime($data["last_login"]);
                            $namagrup = $listgrup ? esc($listgrup['nama_grup']) : '-';
                            $userImage = esc($data['user_image']);
                            $profil = ($userImage != 'default.png' && file_exists('public/img/user/' . $userImage)) ? $userImage : 'default.png';

                            ?>
                            <li class="">
                                <a href="#">
                                    <div class="media">
                                        <div class="align-self-center me-3">
                                            <i class="mdi mdi-circle text-<?= ($cekon) ? 'success' : 'warning' ?> font-size-10"></i>
                                        </div>
                                        <div class="align-self-center me-3">
                                            <img src="<?= base_url('public/img/user/' . $profil) ?>"
                                                class="rounded-circle avatar-xs" alt="">
                                        </div>

                                        <div class="media-body overflow-hidden">
                                            <h5 class="text-truncate font-size-14 mb-1"><?= esc($data['fullname']) ?> <small
                                                    class="text-danger">(<?= $namagrup ?>)</small></h5>
                                            <p class="text-truncate mb-0 font-size-12"><?= $lastlogin ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <hr class="mt-0" />
            <?php } else {

                $lastlogin = convertDatetime($list["last_login"]);
                $cekon = $db->table('cms__usersessions')->where('user_id', $list['id'])->get()->getRow();
                $userImage = esc($list['user_image']);
                $profil2 = ($userImage != 'default.png' && file_exists('public/img/user/' . $userImage)) ? $userImage : 'default.png';
                ?>

                <!-- Jika tidak ada online -->
                <div data-simplebar style="max-height: 205px;">
                    <ul class="list-unstyled chat-list">

                        <li class="">
                            <a href="<?= base_url('akun') ?>">
                                <div class="media">
                                    <div class="align-self-center me-3">
                                        <i class="mdi mdi-circle text-<?= ($cekon) ? 'success' : 'warning' ?> font-size-10"></i>
                                    </div>
                                    <div class="align-self-center me-3">
                                        <img src="<?= base_url('public/img/user/' . $profil2) ?>"
                                            class="rounded-circle avatar-xs" alt="">
                                    </div>

                                    <div class="media-body overflow-hidden">
                                        <h5 class="text-truncate font-size-14 mb-1"> <?= esc($list['fullname']) ?> <small
                                                class="text-danger">(<?= $role ?>)</small></h5>
                                        <p class="text-truncate mb-0 font-size-12"><?= $lastlogin ?></p>
                                    </div>

                                </div>
                            </a>
                        </li>

                    </ul>
                </div>

            <?php }
    } ?>

        <div class="border-top m-auto">
            <label class="d-block text-primary mb-0 text-center"> <i class="mdi mdi-console"></i> CMS VER:
                <?= esc($vercms) ?> | CI: <?= esc(\CodeIgniter\CodeIgniter::CI_VERSION) ?> </label>
            <p class="text-center"><a href="https:/datagoe.com/" class="text-dark" style="font-size: 12px;">Last update
                    <a class="text-danger" style="font-size: 12px;">23-03-2025</a></a>
            </p>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#hapusSession, #hapusLogs', function () {
        const button = $(this);
        const dir = button.data('dir');
        const timeLimit = button.data('timelimit');

        $.ajax({
            url: '<?= site_url('admin/hapusfile'); ?>',
            method: 'POST',
            data: {
                dir: dir,
                timeLimit: timeLimit
            },
            dataType: 'json',
            beforeSend: function () {
                button.attr('disabled', true);
                button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Proses...</i>');
            },
            complete: function () {
                button.attr('disabled', false);
                button.html(button.attr('id') === 'hapusSession' ? 'Session' : 'Logs'); // Label disederhanakan
            },
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        // Tampilkan spinner pada view sebelum request baru
                        $('.viewonline').html('<div class="text-center py-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');

                        // Refresh data online
                        $.ajax({
                            url: '<?= site_url('admin/getonline'); ?>',
                            method: 'GET',
                            dataType: 'json',
                            success: function (res) {
                                $('.viewonline').html(res.data);
                            },
                            error: function () {
                                $('.viewonline').html('<div class="alert alert-danger">Gagal memuat ulang data online.</div>');
                            }
                        });
                    });
                } else {
                    toastr["error"](response.message);
                }
            },
            error: function () {
                toastr["error"]("Terjadi kesalahan saat menghapus file.");
            }
        });
    });

    $(document).on('click', '#resetStatus', function () {
        $.ajax({
            url: '<?= site_url('admin/offuser'); ?>',
            method: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('#resetStatus').attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Resetting...</i>');
            },
            complete: function () {
                $('#resetStatus').removeAttr('disabled').html('<i class="mdi mdi-account-convert text-light"></i> Reset');
            },
            success: function (response) {
                if (response.status === 'success') {

                    toastr["success"](response.message)
                    $('.viewonline').html(response.data);
                    // window.location = '';
                    csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val()
                } else {
                    toastr["error"](response.message)
                }
            },
            error: function () {
                toastr["error"](response.message)
                window.location = '';

            }
        });
    });
</script>