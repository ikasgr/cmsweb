<?= $this->section('content') ?>
<?= $this->extend('backend/' . esc($folder) . '/' . 'script'); ?>

<!-- 
 * CMS DATAGOE!
 *
 * Selamat datang! Terima kasih telah memilih CMS ini sebagai inti dari situs atau aplikasi Anda.. 
 * Demi menjaga integritas dan profesionalisme, mohon untuk tetap menghormati hak cipta dengan 
 * tidak menghapus atau mengubah bagian skrip ini, terutama identitas CMS DATAGOE.
 *
 * Mari kita saling menghargai dan menghormati hasil karya dengan penuh profesionalisme.
 *
 * @author			Vian Taum <viantaum17@gmail.com>
 * @phone			0813-5396-7028
 * @website			www.datagoe.com
 * @copyright		(c) 2024 Datagoe Software
 * ----------------------------------------------------------------------------------
 * CMS DATAGOE : Dari Kampung, Menembus Batas, Menghadirkan Inovasi untuk Indonesia!
 * ----------------------------------------------------------------------------------
 -->

<style>
    .spinner-container {
        display: none;
        /* Menyembunyikan spinner secara default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        /* Mengatur elemen anak (spinner dan teks) dalam satu kolom */
        z-index: 9999;
        /* Menempatkan spinner di atas konten lainnya */
    }

    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .spinner-container p {
        margin-top: 10px;
        /* Memberikan jarak antara spinner dan teks */
        color: white;
        /* Menambahkan warna putih pada teks agar lebih jelas terlihat */
        font-size: 16px;
        /* Mengatur ukuran font */
        font-weight: bold;
        /* Mengatur ketebalan font */
    }
</style>
<div class="page-title-box"></div>

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-header font-18 bg-light">
                    <h5 class="modal-title mt-0">
                        <i class="fas fa-sync-alt"></i> Upgrade CMS DATAGOE
                    </h5>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div id="ket" class="mb-0">
                        <div class="alert alert-info alert-dismissible fade show border border-info" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h6 class="alert-heading"><i class="fas fa-info-circle"></i> <strong> Informasi Pembaruan Sistem</strong> </h6>
                            <p>
                                Pastikan server Anda mendukung ekstensi <strong> OpenSSL</strong> agar pembaruan dapat berjalan dengan lancar.
                                <br>
                                <small class="text-muted"> Saat ini, Anda menggunakan CMS versi <strong><?= esc($vercms) ?></strong> dan Database versi <strong><?= esc($verdb) ?></strong>.</small>
                        </div>
                    </div>
                    <div id="ketsukses" class="mb-0">

                        <div class="alert alert-success d-flex align-items-start show p-2" role="alert">
                            <i class="mdi mdi-checkbox-marked-circle-outline display-6 text-success me-2"></i>
                            <div>
                                <div class="fw-bold mt-1">Anda berhasil terhubung ke server Datagoe</div>
                                <small class="text-muted">Anda sedang menggunakan CMS Datagoe versi <a class="text-danger"><?= esc($vercms) ?></a> dan Database versi <a class="text-danger"><?= esc($verdb) ?></a>.</small>
                            </div>
                        </div>


                    </div>

                    <div id="spinner" class="spinner-container">
                        <div class="spinner"></div>
                        <p id="spinner-text">Sedang Proses...</p>
                    </div>
                    <center>
                        <input type="text" autocomplete="off" autofocus id="fileUrl" class="form-control" placeholder="Silakan masukkan nama file akses yang telah Anda terima." name="fileUrl" />
                        <button id="start-konek" class="btn btn-primary btn-block mt-2" onclick="listdataupdate()" style="width: 200px;">
                            <i class="fas fa-server"></i> Hubungkan ke Server
                        </button>
                    </center>
                    <div class="viewdata"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function listdataupdate() {

        // $('#spinner').show(); // Tampilkan spinner
        fileUrl = $("#fileUrl").val();
        $.ajax({
            url: "<?= site_url('updatecms/getdata') ?>",
            type: "POST",
            data: {
                fileUrl: fileUrl
            },
            dataType: "json",
            beforeSend: function() {
                $('#spinner').show();
            },
            success: function(response) {

                $('#spinner').hide();
                // Menangani jika ada error message dari server
                if (response.error_message) {
                    Swal.fire({
                        // title: "Error!",
                        text: response.error_message,
                        width: "350px",
                        height: "200px",
                        icon: "error"
                    });
                } else {

                    if (response.data) {
                        $('.viewdata').html(response.data);
                        $('#fileUrl').hide();
                        $('#ket').hide();
                        $('#start-konek').hide();
                        $('#ketsukses').show();
                    } else {
                        $('.viewdata').html('<div class="alert alert-danger">Gagal memuat data.</div>');
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownerror) {

                $('#spinner').hide();

                Swal.fire({
                    title: "Maaf gagal load data!",
                    html: `Silahkan Cek kembali Kode Error: <strong>${(xhr.status + "\n")}</strong>`,
                    icon: "error",
                    width: "400px",
                }).then(function() {
                    window.location = '';
                })
            }
        });
    }

    $(document).ready(function() {
        $('#spinner').hide();
        $('#ketsukses').hide();

        $('#fileUrl').keydown(function(e) {
            if (e.keyCode == 13) { // Jika tombol Enter ditekan
                e.preventDefault();
                listdataupdate();
            }
        });
    });
</script>
<?= $this->endSection() ?>