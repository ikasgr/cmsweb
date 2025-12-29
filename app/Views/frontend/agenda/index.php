<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Agenda & Kegiatan</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> Agenda Section Start Here <================== -->
<div class="service padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__header text-center mb-5">
            <h2 class="fw-bold">Agenda & Kegiatan</h2>
            <p class="text-muted">Informasi lengkap tentang jadwal kegiatan dan acara kami</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($agenda)): ?>
                <?php foreach ($agenda as $item): ?>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="event-card h-100 border-0 shadow-sm rounded-3 overflow-hidden hover-shadow-lg transition">
                            <div class="row g-0">
                                <!-- Event Image -->
                                <div class="col-md-5">
                                    <?php if (!empty($item['gambar']) && $item['gambar'] != 'default.png'): ?>
                                        <img src="<?= base_url('public/img/informasi/agenda/' . $item['gambar']) ?>"
                                            alt="<?= esc($item['tema']) ?>" class="w-100 h-100"
                                            style="object-fit: cover; min-height: 250px;">
                                    <?php else: ?>
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center"
                                            style="min-height: 250px;">
                                            <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Event Content -->
                                <div class="col-md-7">
                                    <div class="p-4">
                                        <!-- Date Badge -->
                                        <div class="mb-3">
                                            <span class="badge bg-primary">
                                                <i class="far fa-calendar me-1"></i>
                                                <?= date('d M Y', strtotime($item['tgl_mulai'])) ?>
                                                <?php if ($item['tgl_mulai'] != $item['tgl_selesai']): ?>
                                                    - <?= date('d M Y', strtotime($item['tgl_selesai'])) ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>

                                        <!-- Event Title -->
                                        <h5 class="fw-bold mb-3">
                                            <a href="#" class="text-dark text-decoration-none hover-text-primary"
                                                data-agenda-id="<?= $item['agenda_id'] ?>"
                                                onclick="lihatAgenda(event, <?= $item['agenda_id'] ?>)">
                                                <?= esc($item['tema']) ?>
                                            </a>
                                        </h5>

                                        <!-- Event Info -->
                                        <div class="event-info mb-3">
                                            <div class="mb-2">
                                                <i class="fas fa-clock text-warning me-2"></i>
                                                <small class="text-muted"><?= esc($item['jam']) ?></small>
                                            </div>
                                            <div class="mb-2">
                                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                                <small class="text-muted"><?= esc($item['tempat']) ?></small>
                                            </div>
                                            <div class="mb-2">
                                                <i class="fas fa-user text-info me-2"></i>
                                                <small class="text-muted"><?= esc($item['pengirim']) ?></small>
                                            </div>
                                        </div>

                                        <!-- Event Description -->
                                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                                            <?= character_limiter(strip_tags($item['isi_agenda']), 100) ?>
                                        </p>

                                        <!-- Action Button -->
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            onclick="lihatAgenda(event, <?= $item['agenda_id'] ?>)">
                                            <i class="fas fa-info-circle me-1"></i> Selengkapnya
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada agenda tersedia</h5>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (!empty($pager)): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <?= $pager->links('hal', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- ================> Agenda Section End Here <================== -->

<!-- Modal untuk Detail Agenda -->
<div class="modal fade" id="modalDetailAgenda" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="modalDetailContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<style>
    .hover-shadow-lg:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        transform: translateY(-5px);
    }

    .hover-text-primary:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .transition {
        transition: all 0.3s ease;
    }

    .event-card {
        transition: all 0.3s ease;
    }

    .event-card:hover {
        border-color: var(--primary-yellow, #ffc107) !important;
    }

    .event-info i {
        width: 20px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function lihatAgenda(event, agendaId) {
        event.preventDefault();

        $.ajax({
            type: "post",
            url: "<?= base_url('agenda/formlihatagenda') ?>",
            data: {
                agenda_id: agendaId,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: "json",
            beforeSend: function () {
                $('#modalDetailContent').html(`
                <div class="modal-body text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat detail agenda...</p>
                </div>
            `);
                $('#modalDetailAgenda').modal('show');
            },
            success: function (response) {
                if (response.sukses) {
                    $('#modalDetailContent').html(response.sukses);
                } else if (response.error) {
                    $('#modalDetailContent').html(`
                    <div class="modal-body text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <p class="text-muted">${response.error}</p>
                    </div>
                `);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                $('#modalDetailContent').html(`
                <div class="modal-body text-center py-5">
                    <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                    <p class="text-muted">Terjadi kesalahan saat memuat data</p>
                </div>
            `);
            }
        });
    }
</script>

<?= $this->endSection() ?>