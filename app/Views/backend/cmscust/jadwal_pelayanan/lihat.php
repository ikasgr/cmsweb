<!-- Modal Lihat -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="modallihatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modallihatLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="30%">Judul Jadwal</th>
                            <td><?= esc($data['judul_jadwal']) ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Pelayanan</th>
                            <td><span class="badge bg-primary"><?= esc($data['jenis_pelayanan']) ?></span></td>
                        </tr>
                        <tr>
                            <th>Waktu Pelaksanaan</th>
                            <td>
                                <?= date('d/m/Y', strtotime($data['tanggal'])) ?><br>
                                <?= date('H:i', strtotime($data['waktu_mulai'])) ?> -
                                <?= $data['waktu_selesai'] ? date('H:i', strtotime($data['waktu_selesai'])) . ' WIB' : 'Selesai' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td><?= esc($data['tempat']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Pengkhotbah</th>
                            <td><?= esc($data['pengkhotbah']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Liturgis (WL)</th>
                            <td><?= esc($data['liturgis']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Singer</th>
                            <td><?= esc($data['singer']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Pemusik</th>
                            <td><?= esc($data['pemusik']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Multimedia</th>
                            <td><?= esc($data['multimedia']) ?: '-' ?></td>
                        </tr>
                        <tr>
                            <th>Usher</th>
                            <td><?= esc($data['usher']) ?: '-' ?></td>
                        </tr>
                        <?php if ($data['keterangan']): ?>
                            <tr>
                                <th>Keterangan</th>
                                <td><?= nl2br(esc($data['keterangan'])) ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($data['status'] == 1): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tgl Input</th>
                            <td><?= date('d/m/Y H:i', strtotime($data['tgl_input'])) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>