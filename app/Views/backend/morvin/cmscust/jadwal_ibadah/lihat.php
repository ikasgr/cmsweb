<!-- Modal Lihat Detail Jadwal Ibadah -->
<div class="modal fade" id="modallihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <!-- Header Info -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h3 class="text-primary"><?= esc($data['judul_ibadah']) ?></h3>
                        <p class="text-muted mb-2">
                            <span class="badge" style="background-color: <?= $data['warna'] ?>; color: white; font-size: 14px;">
                                <?= esc($data['nama_jenis']) ?>
                            </span>
                        </p>
                        <?php if ($data['tema_ibadah']): ?>
                            <h5 class="text-success">
                                <i class="fas fa-lightbulb"></i> <?= esc($data['tema_ibadah']) ?>
                            </h5>
                        <?php endif; ?>
                        <?php if ($data['ayat_tema']): ?>
                            <p class="text-info">
                                <i class="fas fa-book"></i> <strong><?= esc($data['ayat_tema']) ?></strong>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 text-end">
                        <?php
                        $statusClass = [
                            'Terjadwal' => 'bg-primary',
                            'Berlangsung' => 'bg-success',
                            'Selesai' => 'bg-info',
                            'Dibatalkan' => 'bg-danger'
                        ];
                        ?>
                        <span class="badge <?= $statusClass[$data['status']] ?> fs-6 mb-2">
                            <?= esc($data['status']) ?>
                        </span>
                        <?php if ($data['is_recurring']): ?>
                            <br><span class="badge bg-warning fs-6">
                                <i class="fas fa-repeat"></i> Recurring <?= esc($data['recurring_type']) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <!-- Informasi Jadwal -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> Informasi Jadwal</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Tanggal</strong></td>
                                        <td>: <?= date('l, d F Y', strtotime($data['tanggal'])) ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Waktu</strong></td>
                                        <td>: <?= date('H:i', strtotime($data['jam_mulai'])) ?>
                                            <?php if ($data['jam_selesai']): ?>
                                                - <?= date('H:i', strtotime($data['jam_selesai'])) ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat</strong></td>
                                        <td>: <i class="fas fa-map-marker-alt text-danger"></i> <?= esc($data['tempat']) ?></td>
                                    </tr>
                                    <?php if ($data['max_peserta']): ?>
                                    <tr>
                                        <td><strong>Maks. Peserta</strong></td>
                                        <td>: <?= number_format($data['max_peserta']) ?> orang</td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($data['is_recurring']): ?>
                                    <tr>
                                        <td><strong>Recurring</strong></td>
                                        <td>: <?= esc($data['recurring_type']) ?>
                                            <?php if ($data['recurring_end']): ?>
                                                <br><small class="text-muted">Sampai: <?= date('d F Y', strtotime($data['recurring_end'])) ?></small>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>

                        <?php if ($data['keterangan']): ?>
                        <div class="card mt-3">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-sticky-note"></i> Keterangan</h6>
                            </div>
                            <div class="card-body">
                                <p><?= nl2br(esc($data['keterangan'])) ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Liturgi -->
                    <div class="col-lg-6">
                        <?php if ($data['liturgi']): ?>
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="card-title mb-0"><i class="fas fa-list-ol"></i> Liturgi / Susunan Acara</h6>
                            </div>
                            <div class="card-body">
                                <pre class="mb-0" style="white-space: pre-wrap; font-family: inherit;"><?= esc($data['liturgi']) ?></pre>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pelayan Ibadah -->
                <?php if (isset($data['pelayan']) && !empty($data['pelayan'])): ?>
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-users"></i> Pelayan Ibadah</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($data['pelayan'] as $pelayan): ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card border">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <?php if ($pelayan['foto']): ?>
                                                <img src="<?= base_url('public/file/foto/jemaat/' . $pelayan['foto']) ?>" 
                                                     class="rounded-circle me-3" width="40" height="40" 
                                                     style="object-fit: cover;" alt="Foto">
                                            <?php else: ?>
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1"><?= esc($pelayan['nama_pelayan']) ?></h6>
                                                <small class="text-muted" style="background-color: <?= $pelayan['warna'] ?>; color: white; padding: 2px 6px; border-radius: 3px;">
                                                    <?= esc($pelayan['nama_jabatan']) ?>
                                                </small>
                                                <?php if ($pelayan['no_anggota']): ?>
                                                    <br><small class="text-info"><?= esc($pelayan['no_anggota']) ?></small>
                                                <?php endif; ?>
                                                <br>
                                                <?php
                                                $konfirmasiClass = [
                                                    'Pending' => 'bg-warning',
                                                    'Dikonfirmasi' => 'bg-success',
                                                    'Ditolak' => 'bg-danger'
                                                ];
                                                ?>
                                                <small class="badge <?= $konfirmasiClass[$pelayan['status_konfirmasi']] ?>">
                                                    <?= esc($pelayan['status_konfirmasi']) ?>
                                                </small>
                                            </div>
                                        </div>
                                        <?php if ($pelayan['keterangan']): ?>
                                            <small class="text-muted d-block mt-2"><?= esc($pelayan['keterangan']) ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Musik & Lagu -->
                <?php if (isset($data['musik']) && !empty($data['musik'])): ?>
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-music"></i> Musik & Lagu</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="5">#</th>
                                        <th width="100">Kategori</th>
                                        <th>Judul Lagu</th>
                                        <th width="150">Pengarang</th>
                                        <th width="80">No. Kidung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['musik'] as $index => $musik): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <span class="badge bg-secondary"><?= esc($musik['kategori']) ?></span>
                                        </td>
                                        <td>
                                            <strong><?= esc($musik['judul_lagu']) ?></strong>
                                            <?php if ($musik['keterangan']): ?>
                                                <br><small class="text-muted"><?= esc($musik['keterangan']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($musik['pengarang']) ?: '-' ?></td>
                                        <td><?= esc($musik['nomor_kidung']) ?: '-' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Pengumuman -->
                <?php if (isset($data['pengumuman']) && !empty($data['pengumuman'])): ?>
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-bullhorn"></i> Pengumuman</h6>
                    </div>
                    <div class="card-body">
                        <?php foreach ($data['pengumuman'] as $pengumuman): ?>
                        <div class="alert <?= $pengumuman['is_penting'] ? 'alert-warning' : 'alert-info' ?> mb-3">
                            <h6 class="alert-heading">
                                <?php if ($pengumuman['is_penting']): ?>
                                    <i class="fas fa-exclamation-triangle"></i>
                                <?php else: ?>
                                    <i class="fas fa-info-circle"></i>
                                <?php endif; ?>
                                <?= esc($pengumuman['judul_pengumuman']) ?>
                            </h6>
                            <p class="mb-0"><?= nl2br(esc($pengumuman['isi_pengumuman'])) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Informasi Sistem -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Informasi Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Dibuat:</strong> <?= date('d F Y H:i', strtotime($data['created_at'])) ?>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Diupdate:</strong> <?= date('d F Y H:i', strtotime($data['updated_at'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="edit('<?= $data['id_jadwal'] ?>')">
                    <i class="fas fa-edit"></i> Edit Jadwal
                </button>
            </div>
        </div>
    </div>
</div>
