<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>


<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>

</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">
                    <h1 class="text-blue montserrat-700 f-30 text-center">Bank Data </h1>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_tokencmsdatagoe" />
                    <div class=" stretch-card grid-margin">
                        <?php if ($list) { ?>
                            <table id="downloaddata" class="table table-hover table-striped p-0 table-bordered">
                                <thead>
                                    <th width="5"># </th>
                                    <th>Jenis Surat</th>
                                    <th>Posting</th>
                                    <th width="5" class="text-center"># </th>
                                </thead>
                                <tbody>
                                    <?php $nomor = 0;
                                    foreach ($list as $data) :
                                        $nomor++; ?>
                                        <tr>
                                            <td><?= $nomor ?></td>
                                            <td><?= esc($data['nama_bankdata']) ?></td>
                                            <td><?= date_indo($data['tgl_upload']) ?></td>
                                            <td class="text-center p-1">
                                                <a href="<?= base_url('download/'  . esc($data['fileupload'])); ?>"><button class="btn btn-success btn-sm" onclick="updatehits('<?= $data['bankdata_id'] ?>')" title="Download"><i class="fas fa-download"></i> </button></a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Surat</th>
                                        <th>Posting</th>
                                        <th class="text-center"># </th>

                                    </tr>
                                </tfoot>
                            </table>



                        <?php } else { ?>
                            <div class="alert alert-danger text-center" style='background-color:#FAEBD7; border-color:#e3e3e3;'>
                                <a style='color:red'>Belum ada data untuk kategori ini..!</a>
                            </div>
                        <?php } ?>

                    </div>


                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(document).ready(function() {

        var table = $('#downloaddata').DataTable({
            "lengthChange": true,
            "ordering": false,
            "paging": true,
            // "info": false,
            // "pagingType": "numbers",
        });


    })
</script>


<?= $this->endSection() ?>