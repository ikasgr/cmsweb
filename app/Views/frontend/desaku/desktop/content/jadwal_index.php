<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content') ?>

<section class="container mt-lg-0 mt-0 pb-1">
    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue">Jadwal Pelayanan</h4>
        </div>
    </div>
</section>

<section class="container pb-4">
    <div class="card p-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Jadwal Hari Ini -->
                <?php if ($hariini) : ?>
                    <div class="card mb-3 border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-day"></i> Hari Ini</h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php foreach ($hariini as $item) : ?>
                                <div class="list-group-item">
                                    <h6 class="mb-1"><?= esc($item['judul_jadwal']) ?></h6>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> <?= date('H:i', strtotime($item['waktu_mulai'])) ?>
                                    </small><br>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> <?= esc($item['tempat']) ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Filter Jenis Pelayanan -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-filter"></i> Jenis Pelayanan</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('jadwal') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar"></i> Semua Jadwal
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Ibadah Minggu') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-church"></i> Ibadah Minggu
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Ibadah Pemuda') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-users"></i> Ibadah Pemuda
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Ibadah Anak') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-child"></i> Ibadah Anak
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Persekutuan Doa') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-praying-hands"></i> Persekutuan Doa
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Komsel') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-home"></i> Komsel
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Kebaktian Khusus') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-star"></i> Kebaktian Khusus
                        </a>
                        <a href="<?= base_url('jadwal/jenis/Acara Gereja') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar-alt"></i> Acara Gereja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h1 class="text-blue montserrat-700 f-28 mb-3">
                    <i class="fas fa-calendar-check"></i> Jadwal Pelayanan Mendatang
                </h1>

                <?php if ($jadwal) : ?>
                    <!-- Jadwal Minggu Ini -->
                    <?php if ($mingguini) : ?>
                        <div class="card mb-4 border-success">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-calendar-week"></i> Minggu Ini</h5>
                            </div>
                            <div class="card-body">
                                <?php foreach ($mingguini as $item) : ?>
                                    <div class="jadwal-item mb-3 pb-3 border-bottom">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="date-box text-center p-3 bg-light rounded">
                                                    <div class="day text-primary font-weight-bold" style="font-size: 24px;">
                                                        <?= date('d', strtotime($item['tanggal'])) ?>
                                                    </div>
                                                    <div class="month text-muted">
                                                        <?= strftime('%B %Y', strtotime($item['tanggal'])) ?>
                                                    </div>
                                                    <div class="weekday text-secondary">
                                                        <?= strftime('%A', strtotime($item['tanggal'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h4 class="text-primary mb-2"><?= esc($item['judul_jadwal']) ?></h4>
                                                <span class="badge badge-primary mb-2"><?= esc($item['jenis_pelayanan']) ?></span>
                                                
                                                <div class="jadwal-info">
                                                    <p class="mb-1">
                                                        <i class="fas fa-clock text-primary"></i>
                                                        <strong>Waktu:</strong> 
                                                        <?= date('H:i', strtotime($item['waktu_mulai'])) ?>
                                                        <?php if ($item['waktu_selesai']) : ?>
                                                            - <?= date('H:i', strtotime($item['waktu_selesai'])) ?>
                                                        <?php endif; ?>
                                                    </p>
                                                    <p class="mb-1">
                                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                                        <strong>Tempat:</strong> <?= esc($item['tempat']) ?>
                                                    </p>
                                                    <?php if ($item['pengkhotbah']) : ?>
                                                        <p class="mb-1">
                                                            <i class="fas fa-user-tie text-success"></i>
                                                            <strong>Pengkhotbah:</strong> <?= esc($item['pengkhotbah']) ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <?php if ($item['keterangan']) : ?>
                                                        <p class="mb-0 text-muted">
                                                            <i class="fas fa-info-circle"></i>
                                                            <?= esc($item['keterangan']) ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <button class="btn btn-sm btn-outline-primary mt-2 btn-detail" 
                                                        data-id="<?= $item['id_jadwal'] ?>">
                                                    <i class="fas fa-eye"></i> Lihat Detail
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Jadwal Mendatang Lainnya -->
                    <h4 class="text-blue montserrat-700 f-20 mb-3 mt-4">
                        <i class="fas fa-calendar-plus"></i> Jadwal Mendatang Lainnya
                    </h4>

                    <?php 
                    $current_month = '';
                    foreach ($jadwal as $item) : 
                        // Skip jika sudah tampil di minggu ini
                        $is_this_week = false;
                        foreach ($mingguini as $week_item) {
                            if ($week_item['id_jadwal'] == $item['id_jadwal']) {
                                $is_this_week = true;
                                break;
                            }
                        }
                        if ($is_this_week) continue;

                        $month = strftime('%B %Y', strtotime($item['tanggal']));
                        if ($month != $current_month) :
                            if ($current_month != '') echo '</div></div>';
                            $current_month = $month;
                    ?>
                        <div class="card mb-3">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0"><i class="fas fa-calendar"></i> <?= $month ?></h5>
                            </div>
                            <div class="card-body">
                    <?php endif; ?>

                        <div class="jadwal-item mb-3 pb-3 border-bottom">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="date-box text-center p-2 bg-light rounded">
                                        <div class="day text-primary font-weight-bold" style="font-size: 20px;">
                                            <?= date('d', strtotime($item['tanggal'])) ?>
                                        </div>
                                        <div class="weekday text-secondary small">
                                            <?= strftime('%a', strtotime($item['tanggal'])) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h5 class="text-primary mb-1"><?= esc($item['judul_jadwal']) ?></h5>
                                    <span class="badge badge-secondary mb-2"><?= esc($item['jenis_pelayanan']) ?></span>
                                    <p class="mb-1 small">
                                        <i class="fas fa-clock"></i> <?= date('H:i', strtotime($item['waktu_mulai'])) ?>
                                        <i class="fas fa-map-marker-alt ml-3"></i> <?= esc($item['tempat']) ?>
                                        <?php if ($item['pengkhotbah']) : ?>
                                            <i class="fas fa-user-tie ml-3"></i> <?= esc($item['pengkhotbah']) ?>
                                        <?php endif; ?>
                                    </p>
                                    <button class="btn btn-sm btn-outline-primary btn-detail" 
                                            data-id="<?= $item['id_jadwal'] ?>">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                    <?php if ($current_month != '') : ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada jadwal yang tersedia.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Jadwal -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-calendar-alt"></i> Detail Jadwal Pelayanan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.jadwal-item:last-child {
    border-bottom: none !important;
}
.date-box {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

<script>
$(document).ready(function() {
    // Set locale untuk bahasa Indonesia
    moment.locale('id');
    
    // Detail jadwal
    $('.btn-detail').click(function() {
        let id_jadwal = $(this).data('id');
        
        $.ajax({
            url: '<?= base_url('jadwal/detail') ?>',
            type: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                id_jadwal: id_jadwal
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    let data = response.sukses;
                    let html = `
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-primary mb-3">${data.judul_jadwal}</h4>
                                <span class="badge badge-primary mb-3">${data.jenis_pelayanan}</span>
                                
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><i class="fas fa-calendar"></i> <strong>Tanggal</strong></td>
                                        <td>: ${moment(data.tanggal).format('dddd, DD MMMM YYYY')}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-clock"></i> <strong>Waktu</strong></td>
                                        <td>: ${data.waktu_mulai.substring(0,5)} ${data.waktu_selesai ? '- ' + data.waktu_selesai.substring(0,5) : ''}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-map-marker-alt"></i> <strong>Tempat</strong></td>
                                        <td>: ${data.tempat}</td>
                                    </tr>
                                    ${data.pengkhotbah ? `
                                    <tr>
                                        <td><i class="fas fa-user-tie"></i> <strong>Pengkhotbah</strong></td>
                                        <td>: ${data.pengkhotbah}</td>
                                    </tr>` : ''}
                                    ${data.liturgis ? `
                                    <tr>
                                        <td><i class="fas fa-book"></i> <strong>Liturgis</strong></td>
                                        <td>: ${data.liturgis}</td>
                                    </tr>` : ''}
                                    ${data.singer ? `
                                    <tr>
                                        <td><i class="fas fa-microphone"></i> <strong>Singer</strong></td>
                                        <td>: ${data.singer}</td>
                                    </tr>` : ''}
                                    ${data.pemusik ? `
                                    <tr>
                                        <td><i class="fas fa-music"></i> <strong>Pemusik</strong></td>
                                        <td>: ${data.pemusik}</td>
                                    </tr>` : ''}
                                    ${data.multimedia ? `
                                    <tr>
                                        <td><i class="fas fa-desktop"></i> <strong>Multimedia</strong></td>
                                        <td>: ${data.multimedia}</td>
                                    </tr>` : ''}
                                    ${data.usher ? `
                                    <tr>
                                        <td><i class="fas fa-hand-paper"></i> <strong>Usher</strong></td>
                                        <td>: ${data.usher}</td>
                                    </tr>` : ''}
                                    ${data.keterangan ? `
                                    <tr>
                                        <td><i class="fas fa-info-circle"></i> <strong>Keterangan</strong></td>
                                        <td>: ${data.keterangan}</td>
                                    </tr>` : ''}
                                </table>
                            </div>
                        </div>
                    `;
                    
                    $('#detailContent').html(html);
                    $('#modalDetail').modal('show');
                } else {
                    alert('Data tidak ditemukan');
                }
            }
        });
    });
});
</script>

<!-- Moment.js untuk format tanggal Indonesia -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js"></script>

<?= $this->endSection() ?>
