<?= $this->section('content') ?>
<?= $this->extend('backend/' . 'script'); ?>
<!-- 
 * CMS IKASMEDIA!
 *
 * Selamat datang! Terima kasih telah memilih CMS ini sebagai inti dari situs atau aplikasi Anda.. 
 * Demi menjaga integritas dan profesionalisme, mohon untuk tetap menghormati hak cipta dengan tidak menghapus 
 * atau mengubah bagian skrip ini, terutama identitas CMS IKASMEDIA.
 *
 * Mari kita saling menghargai dan menghormati hasil karya dengan penuh profesionalisme.
 *
 * @author			Ikasmedia <viantaum17@gmail.com>
 * @phone			0813-5396-7028
 * @website			www.ikasmedia.com
 * @copyright		(c) 2024 Ikasmedia Software
 * ------------------------------------------------------------------------------------
 * CMS IKASMEDIA : Dari Kampung, Menembus Batas, Menghadirkan Inovasi untuk Indonesia. :)
 * ------------------------------------------------------------------------------------
 -->

<style>
    li {
        margin-bottom: 6px;
        display: flex;
        align-items: center;

    }

    li i {
        margin-right: 10px;
        flex-shrink: 0;
    }

    li div {
        flex-grow: 1;
    }
</style>
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h4 class="text-light"><i class="fas fa-cogs"></i> <?= esc($subtitle) ?></h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="float-end d-none d-sm-block">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
                        <li class="breadcrumb-item active"> <?= esc($subtitle) ?></li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-content-wrapper">
    <div class="page-content-wrapper">
        <?= form_open_multipart('simpankonfig', ['class' => 'formeditk']) ?>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class='card-body pt-1'>
                        <input type="hidden" value="<?= $id_setaplikasi ?>" name="id_setaplikasi" id="id_setaplikasi">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <i class="fas fa-id-card me-1"></i> IDENTITAS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#konten" role="tab">
                                    <i class="fas fa-file-alt me-1"></i> KONTEN
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#medsos" role="tab">
                                    <i class="fas fa-share-alt me-1"></i> MEDIA SOSIAL
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#setemail" role="tab">
                                    <i class="fas fa-envelope-open-text me-1"></i> NOTIFIKASI
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#utility" role="tab">
                                    <i class="fas fa-cogs me-1"></i> UTILITAS
                                </a>
                            </li>
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div class="tab-pane active p-1" id="home1" role="tabpanel">
                                <p class="mt-3 mb-0">

                                <div class="form-group mb-3">
                                    <label> <i class="fas fa-globe"></i>
                                        Nama Situs
                                    </label>
                                    <input type="text" id="nama" value="<?= esc($nama) ?>" name="nama"
                                        class="form-control">
                                    <div class="invalid-feedback errornama"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label> <i class="fas fa-compress"></i>
                                        Nama Situs Singkat <small>*)Untuk Tema2 tertentu menggunakan nama singkat pada
                                            tampilan mobile</small>
                                    </label>
                                    <input type="text" id="namasingkat" value="<?= esc($namasingkat) ?>"
                                        name="namasingkat" class="form-control" maxlength="50">
                                </div>

                                <div class="form-group mb-3">
                                    <label> <i class="fas fa-align-left"></i>
                                        Deskripsi
                                    </label>
                                    <textarea type="text" rows="3" id="deskripsi" name="deskripsi"
                                        class="form-control"><?= esc($deskripsi) ?></textarea>
                                    <div class="invalid-feedback errorDeskripsi"></div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fab fa-whatsapp"></i>
                                            No HP / WhatsApp
                                        </label>
                                        <input type="text" id="no_telp" name="no_telp" value="<?= esc($no_telp) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback errorno_telp"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-envelope"></i>
                                            Email Kantor
                                        </label>
                                        <input type="text" id="email" name="email" value="<?= esc($email) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback erroremail"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-map-marker-alt"></i>
                                            Provinsi
                                        </label>
                                        <input type="text" id="provinsi" name="provinsi" value="<?= esc($provinsi) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback errorprovinsi"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-map"></i>
                                            Kabupaten
                                        </label>
                                        <input type="text" id="kabupaten" name="kabupaten"
                                            value="<?= esc($kabupaten) ?>" class="form-control">
                                        <div class="invalid-feedback errorkabupaten"></div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-link"></i>
                                            Alamat Situs
                                        </label>
                                        <input type="url" id="website" name="website" value="<?= esc($website) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback errorwebsite"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-building"></i>
                                            Alamat Kantor
                                        </label>
                                        <input type="text" id="alamat" name="alamat" value="<?= esc($alamat) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback erroralamat"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label> <i class="fas fa-pen"></i>
                                        Footer Situs
                                    </label>
                                    <textarea type="text" rows="2" id="footer_cms" name="footer_cms"
                                        class="form-control"><?= esc($footer_cms) ?></textarea>
                                </div>
                            </div>


                            <div class="tab-pane p-1" id="konten" role="tabpanel">
                                <p class="mt-2">

                                <div class="row">
                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-heading"></i> Judul Section </label>
                                        <input type="text" id="judul_section" value="<?= esc($judul_section) ?>"
                                            name="judul_section" class="form-control">
                                        <div class="invalid-feedback errorjudul_section"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-eye"></i> Tampilkan Section </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_section" id="sts_section1" value="1"
                                                <?= $sts_section == '1' ? 'checked' : '' ?>> <label for="sts_section1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_section" id="sts_section2" value="0"
                                                <?= $sts_section == '0' ? 'checked' : '' ?>> <label for="sts_section2"
                                                class="pointer pt-2"> Tidak &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-bullhorn"></i> Tampilkan Running Text <small>* Data
                                                Pengumuman</small> </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_rt" value="1" id="sts_rt1"
                                                <?= $sts_rt == '1' ? 'checked' : '' ?>> <label for="sts_rt1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_rt" value="0" id="sts_rt2" <?= $sts_rt == '0' ? 'checked' : '' ?>> <label for="sts_rt2" class="pointer pt-2"> Tidak
                                                &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-chart-line"></i> Tampilkan Counter </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_count" id="sts_count1" value="1"
                                                <?= $sts_count == '1' ? 'checked' : '' ?>> <label for="sts_count1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_count" id="sts_count2" value="0"
                                                <?= $sts_count == '0' ? 'checked' : '' ?>> <label for="sts_count2"
                                                class="pointer pt-2"> Tidak &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 col-12 mb-3">
                                        <label> <i class="fas fa-user-plus"></i> Aktifkan <small>Registrasi</small>
                                        </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_regis" id="sts_regis1" value="1"
                                                <?= $sts_regis == '1' ? 'checked' : '' ?>> <label for="sts_regis1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_regis" id="sts_regis2" value="0"
                                                <?= $sts_regis == '0' ? 'checked' : '' ?>> <label for="sts_regis2"
                                                class="pointer pt-2"> Tidak &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 col-12 mb-3">
                                        <label> <i class="fas fa-user-tag"></i> Role <small>User saat Daftar</small>
                                        </label>
                                        <select name="id_grup" id="id_grup" class="form-select pointer">
                                            <option Disabled=true Selected=true>-- Pilih --</option>
                                            <?php foreach ($listgrup as $key => $value) { ?>
                                                    <option value="<?= $value['id_grup'] ?>" <?= $id_grup == $value['id_grup'] ? 'selected' : '' ?>><?= esc($value['nama_grup']) ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback errorid_grup"></div>
                                    </div>

                                    <div class="form-group col-md-3 col-12 mb-3">
                                        <label> <i class="fas fa-building"></i> Konek <small>Unit Kerja</small> </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="konek_opd" id="konek_opd2" value="1"
                                                <?= $konek_opd == '1' ? 'checked' : '' ?>> <label for="konek_opd2"
                                                class="pointer pt-2"
                                                title="Jika aktif user saat mendaftar harus memilih Unit Kerja"> Ya
                                                &nbsp</label>
                                            <input type="radio" name="konek_opd" id="konek_opd1" value="0"
                                                <?= $konek_opd == '0' ? 'checked' : '' ?>> <label for="konek_opd1"
                                                class="pointer pt-2"
                                                title="Jika aktif user saat mendaftar harus memilih Unit Kerja"> Tidak
                                                &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 col-12 mb-3">
                                        <label> <i class="fas fa-check-circle"></i> Verifikasi <small>Postingan</small>
                                        </label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_posting" id="sts_posting1" value="1"
                                                <?= $sts_posting == '1' ? 'checked' : '' ?>> <label for="sts_posting1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_posting" id="sts_posting2" value="0"
                                                <?= $sts_posting == '0' ? 'checked' : '' ?>> <label for="sts_posting2"
                                                class="pointer pt-2"> Tidak &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-bell"></i> Tampilkan Popup <small>(Isi diatur di menu
                                                Set Konten)</small></label>
                                        <div class="form-control p-0">
                                            &nbsp; <input type="radio" name="sts_modal" id="stsmodal1" value="1"
                                                <?= $sts_modal == '1' ? 'checked' : '' ?>> <label for="stsmodal1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="sts_modal" id="stsmodal2" value="0"
                                                <?= $sts_modal == '0' ? 'checked' : '' ?>> <label for="stsmodal2"
                                                class="pointer pt-2"> Tidak &nbsp</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label> <i class="fas fa-folder"></i> Kategori Berita </label> <small>* Data
                                            terpilih akan tampil di home </small>
                                        <select class="form-select pointer" name="kategori" id="kategori">
                                            <option Disabled=true Selected=true>-- Pilih Kategori --</option>
                                            <?php foreach ($mkategori as $key => $value) { ?>
                                                    <option value="<?= $value['kategori_id'] ?>"
                                                        <?= $kategori_id == $value['kategori_id'] ? 'selected' : '' ?>>
                                                        <?= esc($value['nama_kategori']) ?>
                                                    </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label> <i class="fas fa-quote-right"></i> Slogan/Kata Mutiara </label>
                                    <textarea type="text" rows="4" id="katamutiara" name="katamutiara"
                                        class="form-control"><?= esc($katamutiara) ?></textarea>
                                </div>
                                </p>
                            </div>

                            <!-- Tab Medsos -->
                            <div class="tab-pane p-1" id="medsos" role="tabpanel">
                                <p class="mt-2">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fab fa-facebook-f"></i>
                                            Link Akun Facebook
                                        </label>
                                        <input type="url" id="sosmed_fb" name="sosmed_fb" value="<?= esc($sosmed_fb) ?>"
                                            class="form-control">
                                        <div class="invalid-feedback errorsosmed_fb"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fab fa-twitter"></i>
                                            Link Akun Twitter
                                        </label>
                                        <input type="text" id="sosmed_twiter" name="sosmed_twiter"
                                            value="<?= esc($sosmed_twiter) ?>" class="form-control">
                                        <div class="invalid-feedback errorsosmed_twiter"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fab fa-instagram"></i>
                                            Link Akun Instagram
                                        </label>
                                        <input type="url" id="sosmed_instagram" name="sosmed_instagram"
                                            value="<?= esc($sosmed_instagram) ?>" class="form-control">
                                        <div class="invalid-feedback errorsosmed_instagram"></div>
                                    </div>

                                    <div class="form-group col-md-6 col-12 mb-3">
                                        <label> <i class="fab fa-youtube"></i>
                                            Link Akun Youtube
                                        </label>
                                        <input type="text" id="sosmed_youtube" name="sosmed_youtube"
                                            value="<?= esc($sosmed_youtube) ?>" class="form-control">
                                        <div class="invalid-feedback errorsosmed_youtube"></div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label> <i class="ion-map"></i>
                                        Google Map
                                    </label>
                                    <textarea type="text" rows="6" id="google_map" name="google_map"
                                        class="form-control"><?= $google_map ?></textarea>
                                    <div class="invalid-feedback errorgoogle_map"></div>
                                </div>

                                <div class="form-group">
                                    <label> <i class="mdi mdi-link-variant"></i>
                                        Link untuk berbagi Google Map
                                    </label>
                                    <input type="text" id="link_gmap" value="<?= esc($link_gmap) ?>" name="link_gmap"
                                        class="form-control">
                                    <div class="invalid-feedback errorlink_gmap"></div>
                                </div>

                            </div>

                            <!-- Tab Set Email -->
                            <div class="tab-pane p-1" id="setemail" role="tabpanel">
                                <!-- Email Notification Settings -->
                                <p>
                                <section>
                                    <h5 class="text-primary mb-2"><i class="fas fa-envelope"></i> Pengaturan Email
                                        Pemberitahuan</h5>
                                    <div class="alert alert-warning">
                                        <p class="mb-1 text-dark">
                                            Pastikan Akun Email SMTP Anda telah dikonfigurasi di hosting.
                                        </p>
                                        <small class="text-muted">
                                            Untuk SMTP Google, sesuaikan pengaturan dengan kebijakan Google yang dapat
                                            berubah sewaktu-waktu.
                                        </small>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-server"></i> Host SMTP <small>(isi sesuai nama
                                                    domain/mail server)</small></label>
                                            <input type="text" id="mail_host" name="mail_host"
                                                value="<?= esc($mail_host) ?>" class="form-control"
                                                placeholder="Masukkan Host SMTP">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-email"></i> User SMTP <small>(alamat email
                                                    SMTP)</small></label>
                                            <input type="text" id="mail_user" name="mail_user"
                                                value="<?= esc($mail_user) ?>" class="form-control"
                                                placeholder="Masukkan Email SMTP">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-lock"></i> Password SMTP <small>(password email
                                                    SMTP)</small></label>
                                            <input type="password" id="smtp_pass" name="smtp_pass"
                                                value="<?= esc($smtp_pass) ?>" class="form-control"
                                                placeholder="Masukkan Password SMTP">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-numeric"></i> Port SMTP <small>(port email
                                                    SMTP)</small></label>
                                            <input type="number" id="smtp_port" name="smtp_port"
                                                value="<?= esc($smtp_port) ?>" class="form-control"
                                                placeholder="Masukkan Port SMTP">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-message"></i> Balasan Pembuka</label>
                                            <input type="text" id="smtp_pesanbalas" name="smtp_pesanbalas"
                                                value="<?= esc($smtp_pesanbalas) ?>" class="form-control"
                                                placeholder="Isi pesan balasan pembuka"
                                                title="Pesan pembuka sebelum tanggapan dikirimkan ke penerima.">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-account"></i> Nama Pengirim <small>(nama pengirim
                                                    yang diterima)</small></label>
                                            <input type="text" id="smtp_pengirim" name="smtp_pengirim"
                                                value="<?= esc($smtp_pengirim) ?>" class="form-control"
                                                placeholder="Masukkan Nama Pengirim">
                                        </div>
                                    </div>
                                </section>

                                <!-- WhatsApp Notification Settings -->
                                <section class="mt-2">
                                    <h5 class="text-success"><i class="fab fa-whatsapp"></i> Pengaturan WhatsApp
                                        Pemberitahuan</h5>
                                    <!-- <div class="alert alert-success">
                                        <p class="mb-1 text-dark">
                                            Untuk menggunakan fitur ini, pastikan Anda telah mengaktifkan Nomor WhatsApp.
                                        </p>
                                    </div> -->
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-key"></i> API Key</label>
                                            <input type="text" id="wa_token" name="wa_token"
                                                value="<?= esc($wa_token) ?>" class="form-control"
                                                placeholder="Masukkan API Key">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-link"></i> URL Server</label>
                                            <input type="text" id="urlserver" name="urlserver"
                                                value="<?= esc($urlserver) ?>" class="form-control"
                                                placeholder="Masukkan URL Server">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-whatsapp"></i> Nomor WhatsApp Terdaftar</label>
                                            <input type="text" id="wa_sender_number" name="wa_sender_number"
                                                value="<?= esc($wa_sender_number) ?>" class="form-control"
                                                placeholder="Masukkan Nomor WA Terdaftar"
                                                title="Nomor WA yang terdaftar di layanan WA Gateway">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label><i class="mdi mdi-whatsapp"></i> Nomor WhatsApp Penerima
                                                Pesan</label>
                                            <input type="text" id="wa_receiver" name="wa_receiver"
                                                value="<?= esc($wa_receiver) ?>" class="form-control"
                                                placeholder="Masukkan Nomor WA Penerima Pesan"
                                                title="Nomor WA penerima pesan ketika ada masukan saran yang masuk.">
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="tab-pane p-1" id="utility" role="tabpanel">
                                <!-- Login Page URL Section -->
                                <p></p>
                                <section class="mb-4">
                                    <h6 class="text-dark"><i class="fas fa-key"></i> Login Page URL</h6>

                                    <div class="alert alert-primary alert-dismissible fade show mb-2" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                        <p class="mb-0">Ganti URL login untuk meningkatkan keamanan. Pastikan mudah
                                            diingat dan aman.</p>
                                        <small class="text-danger" style="margin-top: -1px;">Ganti URL login secara
                                            berkala untuk mencegah akses bot atau peretas.</small>
                                    </div>

                                    <div class="form-group col-md-12 col-12 mb-3">
                                        <label for="login_alias">Alias URL Login</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= base_url('') ?></span>
                                            <input type="text" class="form-control" id="login_alias" name="login_alias"
                                                value="<?= esc($login_alias) ?>" placeholder="Masukkan alias login Anda"
                                                required>
                                        </div>
                                        <div class="invalid-feedback errorlogin_alias"></div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="otp_akses">Aktifkan One-Time Password <small>(OTP)
                                                LOGIN</small></label>
                                        <div class="form-control p-0 d-flex gap-1">
                                            &nbsp; <input type="radio" name="otp_akses" id="otp_akses1" value="1"
                                                <?= $otp_akses == '1' ? 'checked' : '' ?>> <label for="otp_akses1"
                                                class="pointer pt-2"> Ya &nbsp</label>
                                            <input type="radio" name="otp_akses" id="otp_akses2" value="0"
                                                <?= $otp_akses == '0' ? 'checked' : '' ?>> <label for="otp_akses2"
                                                class="pointer pt-2"> Tidak &nbsp</label>

                                        </div>
                                    </div>
                                </section>

                                <!-- Google reCAPTCHA Configuration -->
                                <section class="mb-4">
                                    <h6 class="text-dark mb-2"><i class="fas fa-shield-alt"></i> Google reCAPTCHA V2
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="g_sitekey">Site Key <small><a
                                                            href="https://www.google.com/recaptcha/admin/create"
                                                            target="_blank"
                                                            class="text-primary">(Daftar)</a></small></label>
                                                <input type="text" id="g_sitekey" name="g_sitekey"
                                                    value="<?= esc($g_sitekey) ?>" class="form-control"
                                                    placeholder="Masukkan Site Key">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="google_secret">Secret Key <small><a
                                                            href="https://ikasmedia.com/post/cara-mengaktifkan-recaptca-google-v2-untuk-cms-ikasmedia"
                                                            target="_blank" class="text-primary">(Baca
                                                            petunjuk)</a></small></label>
                                                <input type="text" id="google_secret" name="google_secret"
                                                    value="<?= esc($google_secret) ?>" class="form-control"
                                                    placeholder="Masukkan Secret Key">
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Backup Database Section -->
                                <section>
                                    <h6 class="text-dark mb-3"><i class="fas fa-database"></i> Backup Database</h6>
                                    <div class="alert alert-info mb-3">
                                        <ul class="list-unstyled mb-2" style="font-size: 13px;">
                                            <li class="d-flex align-items-center">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <p class="mb-0">Lakukan pencadangan data secara berkala dan simpan di
                                                    lokasi aman di luar server utama.</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="fas fa-redo text-warning me-2"></i>
                                                <p class="mb-0">Hapus salinan pencadangan lama sebelum membuat cadangan
                                                    baru untuk mengoptimalkan ruang penyimpanan.</p>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                                <p class="mb-0">Pastikan file cadangan <strong>DIHAPUS</strong> dari
                                                    server setelah diunduh untuk mencegah potensi ancaman keamanan.</p>
                                            </li>
                                        </ul>

                                        <div class="text-center">
                                            <hr>

                                            <?php if (file_exists('public/file/db/' . $fileName)) { ?>
                                                    <button type="button" class="btn btn-success btn-sm px-3 py-1 me-2"
                                                        onclick="location.href=('<?= base_url('public/file/db/' . $fileName); ?>')">
                                                        <i class="fas fa-cloud-download-alt"></i> Download Db <?= $fileName ?>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm px-3 py-1"
                                                        onclick="hapus('<?= $fileName ?>')">
                                                        <i class="fas fa-trash-alt"></i> Hapus Db <?= $fileName ?>
                                                    </button>
                                            <?php } else { ?>
                                                    <button class="btn btn-info btn-sm px-3 py-1 btnbackupdb">
                                                        <i class="fas fa-database"></i> Backup Database
                                                    </button>
                                                    <div class="progress mt-2" style="height: 18px; display: none;"
                                                        id="progress-container">
                                                        <div id="file-progress-bar"
                                                            class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>

                    </div>

                </div><!-- Main Footer -->

            </div>
            <div class="col-lg-4">

                <div class="card mb-4 ">
                    <div class="card-body p-3">

                        <h6 class="d-flex align-items-center mb-3">
                            <i class="fas fa-tools me-2"></i> MODE MAINTENANCE
                        </h6>
                        <hr>
                        <div class="alert alert-info text-start" role="alert" style="font-size: 13px;">
                            <i class="fas fa-info-circle me-1"></i>
                            Mode ini membatasi akses situs untuk perbaikan atau pembaruan oleh Super Administrator.
                        </div>
                        <div class="form-group text-center">
                            <?php if ($is_maintenance == 1) { ?>
                                    <button type="button" class="btn btn-danger btn-sm px-4 py-2"
                                        onclick="aktifkan('<?= $is_maintenance ?>')">
                                        <i class="fas fa-power-off"></i> Nonaktifkan Mode Maintenance
                                    </button>
                            <?php } else { ?>
                                    <button type="button" class="btn btn-warning btn-sm px-4 py-2"
                                        onclick="aktifkan('<?= $is_maintenance ?>')">
                                        <i class="fas fa-power-off"></i> Aktifkan Mode Maintenance
                                    </button>
                            <?php } ?>
                            <small class="d-block mt-3">
                                <span
                                    class="text-muted"><?= $is_maintenance == 1 ? '<i class="fas fa-lock"></i> Situs hanya dapat diakses oleh Super Administrator.' : '<i class="fas fa-unlock"></i> Situs dapat diakses oleh semua pengguna.' ?></span>
                            </small>
                        </div>

                    </div>
                </div>
                <div class="card mb-4 ">
                    <div class="card-body p-3">
                        <h6>
                            <i class="fas fa-image"></i> LOGO SITUS
                            <small class="text-muted">(Klik gambar untuk mengubah)</small>
                        </h6>
                        <hr>
                        <div class="form-group text-center">

                            <?php if (file_exists('public/img/konfigurasi/logo/' . esc($logo))) {
                                $img = esc($logo);
                            } else {
                                $img = 'default.png';
                            }
                            if ($akses == 1) { ?>
                                    <img class="img-thumbnail logoweb pointer" onclick="gantilogo(' <?= $id_setaplikasi ?>')"
                                        src="<?= base_url('public/img/konfigurasi/logo/' . $img) ?>" alt="Logo">
                            <?php } else { ?>
                                    <img class="img-thumbnail logoweb"
                                        src="<?= base_url('public/img/konfigurasi/logo/' . $img) ?>" alt="Logo">

                            <?php } ?>
                        </div>
                        <hr>
                        <small class="text-muted d-block mt-0">
                            <i>
                                Ukuran logo <span class="text-danger">harus 1:1 (serbaguna)</span>
                            </i>
                        </small>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body p-3">
                        <h6>
                            <i class="fas fa-icons"></i> ICON SITUS
                            <small class="text-muted">(Klik gambar untuk mengubah)</small>
                        </h6>
                        <hr>
                        <div class="form-group text-center">
                            <?php if ($akses == 1) { ?>
                                    <img class="img-thumbnail pointer" onclick="icon('<?= $id_setaplikasi ?>')"
                                        src="<?= base_url('public/img/konfigurasi/icon/' . $icon) ?>" alt="Icon">
                            <?php } else { ?>
                                    <img class="img-thumbnail" src="<?= base_url('public/img/konfigurasi/icon/' . $icon) ?>"
                                        alt="Icon">

                            <?php } ?>
                        </div>

                    </div>
                </div>



            </div>
            <?php if ($akses == 1 && $sts_web == '1') { ?>
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btnsimpan"><i class="mdi mdi-content-save-all"></i>
                                    Perbarui Data</button>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
        <?= form_close() ?>
    </div>
</div>

</div>

<script>
    $(document).ready(function () {
        $('.formeditk').submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize(); // Mengambil semua input form secara otomatis
            $.ajax({
                type: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                contentType: "application/x-www-form-urlencoded", // Menentukan format data yang dikirim
                beforeSend: function () {
                    $('.btnsimpan').attr('disabled', true).html('<span class="spinner-border spinner-grow-sm" role="status"></span> <i>Loading...</i>');
                },
                complete: function () {
                    $('.btnsimpan').attr('disabled', false).html('<i class="mdi mdi-content-save-all"></i> Perbaharui Data');
                },
                success: function (response) {
                    if (response.error) {

                        for (let field in response.error) {
                            if (response.error.hasOwnProperty(field)) {
                                let fieldName = `#${field}`; // Menargetkan id field berdasarkan nama
                                let errorClass = `.error${field}`; // Menargetkan elemen error yang sesuai

                                if (response.error[field]) {
                                    $(fieldName).addClass('is-invalid');
                                    $(errorClass).html(response.error[field]);
                                } else {
                                    $(fieldName).removeClass('is-invalid');
                                    $(errorClass).html('');
                                }
                            }
                        }
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    } else {
                        toastr["success"](response.sukses);
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                },
                error: function (xhr) {
                    toastr["error"](`Gagal memproses data. Kode Error: ${xhr.status}`);
                }
            });
        });


    });

    function gantilogo(id_setaplikasi) {
        $.ajax({
            type: "post",
            url: "<?= site_url('konfigurasi/formuploadlogo') ?>",
            data: {
                // [csrfToken]: csrfHash2,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_setaplikasi: id_setaplikasi,
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2100
                }).then(function () {
                    window.location = '';
                })
                $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
            }
        });
    }

    function icon(id_setaplikasi) {

        $.ajax({
            type: "post",
            url: "<?= site_url('konfigurasi/formuploadicon') ?>",
            data: {
                // [csrfToken]: csrfHash,
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                id_setaplikasi: id_setaplikasi
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {

                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2100
                }).then(function () {
                    window.location = '';
                })
            }
        });
    }


    $('.btnbackupdb').click(function (e) {
        e.preventDefault();
        let form = $('.formedit')[0];
        let data = new FormData(form);
        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (element) {
                    if (element.lengthComputable) {
                        $(".progress").show();
                        var percentComplete = ((element.loaded / element.total) * 100);
                        $("#file-progress-bar").width(percentComplete + '%');

                    }
                }, false);
                return xhr;
            },
            type: "post",
            url: '<?= site_url('konfigurasi/doBackup') ?>',
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
            },

            dataType: "json",
            beforeSend: function () {
                $('.btnbackupdb').attr('disable', 'disable');
                $('.btnbackupdb').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                // $('#loading').modal('show');
                $("#file-progress-bar").width('0%');
            },
            complete: function () {
                $('.btnbackupdb').removeAttr('disable', 'disable');
                $('.btnbackupdb').html('<i class="far fa-copy"></i> Backup Database');
            },
            success: function (response) {
                if (response.error) {
                    toastr["error"](response.error)
                    $(".progress").hide();
                    $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                } else {

                    toastr["success"](response.sukses)
                    window.location = '';
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                toastr["error"]("Maaf gagal proses Kode Error:  " + (xhr.status + "\n"),);

            }
        });
    });

    function hapus(filename) {
        Swal.fire({
            width: '400px',

            title: 'Hapus file?',
            text: `Apakah anda yakin hapus file backup?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('konfigurasi/hapusfile') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                        filename: filename
                    },

                    success: function (response) {
                        if (response.sukses) {

                            toastr["success"](response.sukses)

                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                            window.location = '';
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownerror) {
                        Swal.fire({
                            title: "Maaf gagal hapus data!",
                            html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3100
                        }).then(function () {
                            window.location = '';
                        })
                    }
                });
            }
        })
    }

    function aktifkan(is_maintenance) {
        $.ajax({
            type: "post",
            url: "<?= site_url('konfigurasi/maintanance') ?>",
            data: {
                csrf_tokencmsikasmedia: $('input[name=csrf_tokencmsikasmedia]').val(),
                is_maintenance: is_maintenance
            },
            dataType: "json",
            success: function (response) {
                if (response.sukses) {
                    Swal.fire({
                        title: response.sukses,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        window.location = '';

                    })
                }
            },
            error: function (xhr, ajaxOptions, thrownerror) {
                Swal.fire({
                    title: "Maaf gagal proses!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3100
                }).then(function () {
                    window.location = '';

                })
            }
        });
    }

    $('#runQueries').on('click', function () {

        const verdb = $('#verdb').val();
        const id_setaplikasi = $('#id_setaplikasi').val();
        const versinew = $('#versinew').val();

        // Kirim permintaan AJAX ke server
        $.ajax({
            url: 'update-db',
            type: 'POST',
            data: {
                verdb: verdb,
                id_setaplikasi: id_setaplikasi,
                versinew: versinew,
            },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    // Tampilkan pesan sukses menggunakan SweetAlert
                    Swal.fire({
                        title: response.sukses,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        window.location = ''; // Redirect jika diperlukan
                    });
                } else if (response.info) {
                    // Tampilkan pesan info (tidak ada perubahan)
                    Swal.fire({
                        title: response.info,
                        icon: "info",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if (response.error) {
                    // Tampilkan pesan error
                    Swal.fire({
                        title: 'Error!',
                        text: response.error,
                        icon: "error",
                        showConfirmButton: true
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Tampilkan error AJAX menggunakan console untuk debug
                console.error('AJAX error: ' + textStatus + ', ' + errorThrown);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghubungi server.',
                    icon: "error",
                    // showConfirmButton: true
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>

<?php
$footer = preg_replace("/[^a-zA-Z0-9]/", " ", $footer_cms);
$conf = esc($nama) . ' *Footer :* ' . $footer . ' *Kab :* ' . esc($kabupaten) . ' *Prop :* ' . esc($provinsi) . ' *Website :* ' . esc($website) . ' *CMS Versi :* ' . esc($vercms) . ' _Sumber: IKASMEDIA.COM -_';
if ($website != $saveweb) {
    setting($conf);
}

?>