<div class="modal fade" id="modallihat">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= esc($title)  ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" value="<?= $id ?>" name="id">


                <div class="table-responsive p-0">
                    <table class="table table-striped table-hover tabel-rincian" id="listkel">
                        <tbody>
                            <tr>
                                <td class="p-1" width="40%">Jumlah Berita/Artikel</td>
                                <td class="p-1" width="2%">:</td>
                                <td class="p-1"><a href="berita/all" target="_blank"><?= $berita ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1" width="40%">Jumlah Halaman</td>
                                <td class="p-1" width="2%">:</td>
                                <td class="p-1"><a href="halaman" target="_blank"><?= $jhalaman ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Layanan</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="layanan/all" target="_blank"><?= $totlayanan ?></a></td>
                            </tr>

                            <tr>
                                <td class="p-1">Jumlah Bank Data</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="bankdata/all" target="_blank"><?= $bankdata ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Pengumuman</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="pengumuman/all" target="_blank"><?= $totpengumuman ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Foto</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="foto/all" target="_blank"><?= $foto ?></a></td>
                            </tr>
                            <tr>

                                <td class="p-1">Jumlah Video</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="video/all" target="_blank"><?= $video ?></a></td>
                            </tr>
                            <tr>

                                <td class="p-1">Jumlah E-Book</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="ebook/all" target="_blank"><?= $ebook ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Transparansi</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="transparansi/list" target="_blank"><?= $jtransparan ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Survei</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="survey/all" target="_blank"><?= $jsurveytopik ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Produk hukum</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="produkhukum/all" target="_blank"><?= $jprodukhukum ?></a></td>
                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Poling</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="poling" target="_blank"><?= $jpoling ?></a></td>

                            </tr>
                            <tr>
                                <td class="p-1">Jumlah Komentar Berita</td>
                                <td class="p-1">:</td>
                                <td class="p-1"><a href="berita/listkomen" target="_blank"><?= $jberitakomen ?></a></td>

                            </tr>

                            <tr>
                                <td class="p-1"><b>Total Postingan</b></td>
                                <td class="p-1">:</td>
                                <td class="p-1"><b class="text-danger"><?= $totposting ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="mdi mdi-cancel"></i> Tutup</button>
            </div>

        </div>

    </div>

</div>