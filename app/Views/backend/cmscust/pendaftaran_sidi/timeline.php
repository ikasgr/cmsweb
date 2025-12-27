<div class="card">
    <div class="card-body">
        <?php if ($timeline) : ?>
            <div class="timeline">
                <?php foreach ($timeline as $t) : ?>
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">
                                        <span class="badge bg-primary"><?= esc($t['status']) ?></span>
                                    </h6>
                                    <?php if ($t['keterangan']) : ?>
                                        <p class="mb-1 text-muted"><?= nl2br(esc($t['keterangan'])) ?></p>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> <?= date('d/m/Y H:i', strtotime($t['tgl_update'])) ?>
                                </small>
                            </div>
                            <?php if ($t['fullname']) : ?>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> <?= esc($t['fullname']) ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="text-center text-muted py-4">
                <i class="fas fa-history fa-3x mb-3"></i>
                <p>Belum ada riwayat aktivitas</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
    margin-top: 20px;
}

.timeline-item {
    position: relative;
    padding-bottom: 25px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 20px;
    height: calc(100% - 10px);
    width: 2px;
    background: #dee2e6;
}

.timeline-marker {
    position: absolute;
    left: -27px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #007bff;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #007bff;
}

.timeline-item:last-child .timeline-marker {
    background: #28a745;
    box-shadow: 0 0 0 2px #28a745;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #007bff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.timeline-content:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateX(2px);
}

.timeline-item:last-child .timeline-content {
    border-left-color: #28a745;
}
</style>
