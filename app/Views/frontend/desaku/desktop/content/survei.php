<?php
$db = \Config\Database::connect();
?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">

                    <h1 class="text-blue montserrat-700 f-30 text-center">Lembar Quisioner </h1>
                    <hr>

                    <?php if ($surveytopik) { ?>

                        <?php foreach ($surveytopik as $data) {
                            $survey_id = $data['survey_id'];
                        ?>
                            <div class="alert alert-primary" style='background-color:#f4f4f4; border-color:#e3e3e3;font-size:20px;'>
                                <?= esc($data['nama_survey']) ?>
                            </div>
                        <?php } ?>
                        <!-- Mohon kesediaan Anda untuk memberikan penilaian dan masukan kepada kami, dimana hal ini sangat bermanfaat untuk meningkatkan kualitas layanan kami. -->

                        <tr>
                            <td width="98%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                <font face="Arial" size="2"><b>Mohon kesediaan Anda untuk memberikan
                                        penilaian dan masukan kepada Kami, dimana hal ini sangat bermanfaat
                                        untuk meningkatkan kualitas layanan kami.<br>
                                    </b><i>Sebelum melanjutkan, Mohon mengisi Biodata Anda pada form yang telah disediakan dibawah.</i></font>
                            </td>
                        </tr>
                        <hr>
                        <?= form_open('survey/isisurvei', ['class' => 'formsurvey']) ?>

                        <div class="text-left mt-2 ">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label class="mt-2">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlentities(set_value('nama'), ENT_QUOTES) ?>" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="mt-2 ">No HP</label>

                                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= htmlentities(set_value('nohp'), ENT_QUOTES) ?>" required>
                                </div>

                                <div class="form-group col-md-4 col-12">
                                    <label class="mt-2">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    <div class="invalid-feedback errornama"></div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                    <label class="mt-2">Umur</label>
                                    <input type="number" class="form-control" id="usia" name="usia" required>
                                    <div class="invalid-feedback errorusia"></div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                    <label class="mt-2">Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-control pointer">
                                        <option value="" selected=""> Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3 col-12">
                                    <label class="mt-2 ">No HP</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" required>
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <label class="mt-2">Pendidikan</label>
                                    <select name="id_pendidikan" id="id_pendidikan" class="form-control pointer">
                                        <option value="" selected="">Pilih Pendidikan</option>
                                        <?php foreach ($pendidikan as $key => $data) { ?>
                                            <option value="<?= esc($data['id_masterdata']) ?>"><?= esc($data['nama_master']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label class="mt-2">Pekerjaan</label>
                                    <select name="id_pekerjaan" id="id_pekerjaan" class="form-control pointer">
                                        <option value="" selected="">Pilih Pekerjaan</option>
                                        <?php foreach ($pekerjaan as $key => $data) { ?>
                                            <option value="<?= esc($data['id_masterdata']) ?>"><?= esc($data['nama_master']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <hr>
                </div>

                <div class="text-left ">

                    <?php
                        $set = $db->table('survey_pertanyaan')->where('survey_id', $survey_id)->orderBy('pertanyaan_id', 'ASC')->get()->getResultArray();
                        $no = 0;
                        if ($set) {
                            foreach ($set as $datatanya) {
                                $no++;
                    ?>

                            <b><?= $no ?>. <?= esc($datatanya['pertanyaan']) ?></b>
                            <hr>

                            <?= csrf_field();
                                $set2 = $db->table('survey_jawaban')->where('pertanyaan_id', $datatanya['pertanyaan_id'])->orderBy('pertanyaan_id', 'ASC')->get()->getResultArray();
                                $nos = 0;
                                $i = 1;
                                foreach ($set2 as $datajwb) {
                                    $nos++;
                            ?>

                                <label>
                                    <input name="jawaban_id[<?= $no ?>]" class="centang_id" required type="radio" value="<?= $datajwb['nilai'] ?>">
                                    <input type="hidden" id="nilai" name="nilai" value="<?= $datajwb['nilai'] ?>" class="form-control">

                                    <a class="pointer"><?= esc($datajwb['jawaban']) ?> </a>

                                </label><br>

                            <?php } ?>
                            <br>

                        <?php } ?>
                        <input type="hidden" id="totalnil" name="totalnil" class="form-control form-control-sm">
                        <div class="text-left ">
                            <label> <b class="text-primary">Saran dan masukan yang Membangun</b></label>
                            <input type="hidden" id="survey_id" name="survey_id" value="<?= $survey_id ?>" class="form-control">
                            <textarea type="text" id="saran" name="saran" class="form-control"><?= htmlentities(set_value('saran'), ENT_QUOTES) ?></textarea>
                        </div>

                        <hr>
                        <center>
                            <input style='width: 120px; padding:2px; font-size:14px;' type=submit class='btn btn-primary btnsimpan' value='KIRIM DATA' />
                        </center>
                        <?= form_close() ?>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                            <a style='color:red'>Belum Ada pertanyaan untuk topik ini.!</a>
                        </div>
                    <?php } ?>
                </div>

            <?php } else { ?>
                <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                    <a style='color:red'>Belum Ada data Survey.!</a><br> Punya pertanyaan, keluhan, masukan atau saran, silahkan klik <b class="pointer" onclick="window.location.href='<?= base_url('masukansaran') ?>'">disini</b>, untuk sampaikan.
                </div>
            <?php } ?>

            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {

        function Hitungnilai() {
            var radioValue = $('.centang_id:checked').val();
            var total = 0;
            if (radioValue) {
                $('.centang_id:checked').each(function() {
                    total += Number(this.value);
                });
                $('#totalnil').val(total);

            }
        }


        $('.formsurvey').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centang_id:checked');

            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Hitungnilai();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",

                    beforeSend: function() {
                        $('.btnsimpan').attr('disable', 'disable');
                        $('.btnsimpan').html('<span class="spinner-border spinner-grow-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                    },
                    complete: function() {
                        $('.btnsimpan').removeAttr('disable', 'disable');
                        $('.btnsimpan').html('<i class="mdi mdi-content-save-all"></i>  Simpan');
                    },

                    success: function(response) {
                        if (response.error) {

                            Swal.fire({
                                title: "Maaf..!",
                                html: `Silahkan pilih salah satu jawaban diatas. `,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 3550

                            });

                            if (response.error.jawaban_id) {
                                $('#jawaban_id').addClass('is-invalid');
                                $('.errorjawaban_id').html(response.error.jawaban_id);
                            } else {
                                $('#jawaban_id').removeClass('is-invalid');
                                $('.errorjawaban_id').html('');
                            }
                            if (response.error.nama) {
                                $('#nama').addClass('is-invalid');
                                $('.errornama').html(response.error.nama);
                            } else {
                                $('#nama').removeClass('is-invalid');
                                $('.errornama').html('');
                            }
                            if (response.error.usia) {
                                $('#usia').addClass('is-invalid');
                                $('.errorusia').html(response.error.usia);
                            } else {
                                $('#usia').removeClass('is-invalid');
                                $('.errorusia').html('');
                            }

                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }
                        if (response.gagal) {

                            Swal.fire({
                                title: "Maaf..!",
                                text: response.gagal,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 3550
                            });
                            $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                        }
                        if (response.sukses) {

                            Swal.fire({
                                title: "Sukses!",
                                text: response.sukses,
                                icon: "success",
                                // showConfirmButton: false,
                                // timer: 4550
                            }).then(function() {

                                window.location = '<?= base_url('survey') ?>';
                            });
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownerror) {
                        // toastr["error"]("Maaf gagal hapus Kode Error:  " + (xhr.status + "\n"), )
                        Swal.fire({
                            title: "Maaf gagal load data!",
                            html: `Ada kesalahan Kode Error: <strong>${(xhr.status + "\n")}</strong> `,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 3100
                        });
                        $('input[name=csrf_tokencmsikasmedia]').val(response.csrf_tokencmsikasmedia);
                    }
                });
                return false;
            }
        });

    });
</script>

<?= $this->endSection() ?>