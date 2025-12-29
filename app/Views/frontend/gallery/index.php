<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3><?= isset($filters['type']) && $filters['type'] === 'video' ? 'Galeri Video' : 'Galeri Foto' ?></h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= isset($filters['type']) && $filters['type'] === 'video' ? 'Video' : 'Foto' ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->

<!-- ================> gallery section start here <================== -->
<div class="gallery padding--top padding--bottom bg-light">
    <div class="container-fluid">
        <div class="section__header text-center">
            <h2><?= isset($filters['type']) && $filters['type'] === 'video' ? 'Galeri Video' : 'Galeri Foto' ?></h2>
            <p>Jelajahi koleksi <?= isset($filters['type']) && $filters['type'] === 'video' ? 'video' : 'foto' ?> kami
                yang menampilkan berbagai momen dan kegiatan</p>
        </div>
        <div class="section__wrapper">
            <!-- Gallery Filter -->
            <div class="gallery__filter">
                <ul>
                    <li data-filter="*" class="<?= !isset($filters['category']) ? 'active' : '' ?>">Semua</li>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $index => $cat): ?>
                            <li data-filter=".cate-<?= $index ?>"
                                class="<?= isset($filters['category']) && $filters['category'] == $cat['category'] ? 'active' : '' ?>">
                                <?= esc($cat['category']) ?> (<?= $cat['total'] ?>)
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Gallery Items -->
            <?php if (!empty($items)): ?>
                <div class="row g-3 grid">
                    <?php
                    // Create category index mapping
                    $categoryMap = [];
                    if (!empty($categories)) {
                        foreach ($categories as $index => $cat) {
                            $categoryMap[$cat['category']] = $index;
                        }
                    }
                    ?>

                    <?php foreach ($items as $item): ?>
                        <?php
                        $categoryClass = isset($categoryMap[$item['category']]) ? 'cate-' . $categoryMap[$item['category']] : 'cate-0';
                        ?>
                        <div class="col-lg-3 col-sm-6 col-12 <?= $categoryClass ?>">
                            <div class="gallery__item">
                                <div class="gallery__inner">
                                    <div class="gallery__thumb">
                                        <?php if ($item['type'] === 'video'): ?>
                                            <!-- Video Thumbnail -->
                                            <?php
                                            // Extract YouTube video ID for thumbnail
                                            $videoUrl = $item['file_path'];
                                            $videoId = '';

                                            // Check if it's already just a video ID (11 characters, alphanumeric)
                                            if (strlen($videoUrl) == 11 && preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoUrl)) {
                                                // Already a video ID
                                                $videoId = $videoUrl;
                                            } elseif (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match)) {
                                                // Extract from full URL
                                                $videoId = $match[1];
                                            }

                                            $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : '';
                                            ?>

                                            <?php if ($videoId): ?>
                                                <!-- Clickable video thumbnail -->
                                                <a href="https://www.youtube.com/embed/<?= $videoId ?>?autoplay=1"
                                                    data-rel="lightcase:videoCollection" title="<?= esc($item['title']) ?>">

                                                    <?php if ($thumbnailUrl): ?>
                                                        <img src="<?= $thumbnailUrl ?>" alt="<?= esc($item['title']) ?>" class="w-100"
                                                            onerror="this.onerror=null; this.src='https://img.youtube.com/vi/<?= $videoId ?>/hqdefault.jpg';">
                                                    <?php else: ?>
                                                        <div class="video-placeholder">
                                                            <i class="fas fa-video"></i>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Video Badge -->
                                                    <div class="position-absolute top-0 end-0 m-2">
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-video me-1"></i> VIDEO
                                                        </span>
                                                    </div>

                                                    <!-- Play Button Overlay -->
                                                    <div class="video-play-overlay">
                                                        <div class="play-button-large">
                                                            <i class="fas fa-play"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php else: ?>
                                                <!-- Fallback if no video ID -->
                                                <div class="video-placeholder">
                                                    <i class="fas fa-video"></i>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <!-- Photo -->
                                            <?php
                                            // Fix path: Photos are stored in public/img/galeri/foto/ based on controller logic
                                            $photoPath = 'public/img/galeri/foto/' . $item['file_path'];
                                            $photoFullPath = FCPATH . $photoPath;
                                            $photoExists = !empty($item['file_path']) && file_exists($photoFullPath);
                                            ?>

                                            <?php if ($photoExists): ?>
                                                <!-- Clickable Photo Wrapper -->
                                                <a href="<?= base_url($photoPath) ?>" data-rel="lightcase:myCollection"
                                                    title="<?= esc($item['title']) ?>" class="d-block position-relative">

                                                    <img src="<?= base_url($photoPath) ?>" alt="<?= esc($item['title']) ?>"
                                                        class="w-100">

                                                    <!-- Hover Overlay with Icon -->
                                                    <div class="photo-hover-overlay">
                                                        <div class="gallery__icon">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php else: ?>
                                                <!-- Placeholder for missing image (Non-clickable) -->
                                                <div class="d-block position-relative">
                                                    <div class="photo-placeholder">
                                                        <div class="text-center">
                                                            <i class="fas fa-image fa-3x text-white mb-2" style="opacity: 0.8"></i>
                                                            <p class="text-white small mb-0 fw-bold">Foto tidak tersedia</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Old gallery__content removed -->

                                    <!-- Info Overlay -->
                                    <div class="gallery__info">
                                        <h6 class="gallery__title"><?= character_limiter(esc($item['title']), 40) ?></h6>
                                        <div class="gallery__meta">
                                            <span><i class="far fa-calendar-alt"></i>
                                                <?= date_indo($item['event_date']) ?></span>
                                            <span><i class="far fa-eye"></i> <?= $item['views'] ?? 0 ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            <?php else: ?>
                <!-- Empty State -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i
                                class="fas fa-<?= isset($filters['type']) && $filters['type'] === 'video' ? 'video' : 'images' ?> fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada
                                <?= isset($filters['type']) && $filters['type'] === 'video' ? 'video' : 'foto' ?>
                            </h5>
                            <p class="text-muted">
                                <?= isset($filters['type']) && $filters['type'] === 'video' ? 'Video' : 'Foto' ?> akan
                                ditampilkan di sini
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- ================> gallery section end here <================== -->

<!-- Load jQuery if not already loaded -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Isotope for filtering -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<!-- Lightcase for lightbox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.col-lg-3',
            layoutMode: 'fitRows'
        });

        // Filter items on button click
        $('.gallery__filter').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });

            // Update active state
            $('.gallery__filter li').removeClass('active');
            $(this).addClass('active');
        });

        // Initialize Lightcase
        $('a[data-rel^=lightcase]').lightcase({
            swipe: true,
            maxWidth: 1200,
            maxHeight: 800
        });

        // Refresh isotope after images loaded - using native JavaScript
        $(window).on('load', function () {
            $grid.isotope('layout');
        });

        // Fallback: refresh layout after a short delay
        setTimeout(function () {
            $grid.isotope('layout');
        }, 500);
    });
</script>

<style>
    .gallery__filter {
        text-align: center;
        margin-bottom: 40px;
    }

    .gallery__filter ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .gallery__filter li {
        padding: 8px 20px;
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .gallery__filter li:hover,
    .gallery__filter li.active {
        background: var(--primary, #4CAF50);
        color: #fff;
        border-color: var(--primary, #4CAF50);
    }

    .gallery__item {
        margin-bottom: 0;
    }

    .gallery__inner {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .gallery__inner:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .gallery__thumb {
        position: relative;
        overflow: hidden;
    }

    .gallery__thumb img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery__inner:hover .gallery__thumb img {
        transform: scale(1.1);
    }

    .gallery__content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 5;
    }

    .gallery__inner:hover .gallery__content {
        opacity: 1;
        pointer-events: auto;
    }

    /* ... (gallery__icon styles remain same) ... */

    .gallery__info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        padding: 20px 15px 15px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
        pointer-events: none;
        /* Allow clicks to pass through info area for video */
        z-index: 6;
    }

    /* ... (gallery__info styles) ... */

    /* Video specific styles handled below */

    .video-placeholder {
        width: 100%;
        height: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-placeholder i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .video-play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        pointer-events: none;
    }

    /* Make the gallery thumb clickable for videos */
    .gallery__thumb a {
        display: block;
        position: relative;
        z-index: 10;
        /* High Z-Index to ensure clickable */
        cursor: pointer;
    }

    .play-button-large {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .gallery__icon {
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary, #4CAF50);
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .gallery__icon:hover {
        background: var(--primary, #4CAF50);
        color: #fff;
        transform: scale(1.1);
    }

    .gallery__info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
        padding: 20px 15px 15px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .gallery__inner:hover .gallery__info {
        transform: translateY(0);
    }

    .gallery__title {
        color: #fff;
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: 600;
    }

    .gallery__meta {
        display: flex;
        gap: 15px;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.8);
    }

    .gallery__meta i {
        margin-right: 5px;
    }

    /* Photo specific styles */
    .photo-placeholder {
        width: 100%;
        height: 250px;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        /* Blue gradient */
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        transition: transform 0.5s ease;
    }

    .gallery__inner:hover .photo-placeholder {
        transform: scale(1.1);
    }

    .photo-hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery__inner:hover .photo-hover-overlay {
        opacity: 1;
    }

    /* Video specific styles */
    .video-placeholder {
        width: 100%;
        height: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-placeholder i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .video-play-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        pointer-events: none;
    }

    /* Make the gallery thumb clickable for videos */
    .gallery__thumb a {
        display: block;
        position: relative;
    }

    .play-button-large {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .play-button-large i {
        font-size: 24px;
        color: #dc3545;
        margin-left: 4px;
    }

    .gallery__inner:hover .play-button-large {
        transform: scale(1.15);
        background: #fff;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.4);
    }

    /* Isotope CSS */
    .grid {
        transition: height 0.3s ease;
    }

    .grid>div {
        transition: all 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .gallery__filter ul {
            gap: 5px;
        }

        .gallery__filter li {
            padding: 6px 12px;
            font-size: 13px;
        }

        .gallery__thumb img,
        .video-placeholder {
            height: 200px;
        }

        .play-button-large {
            width: 60px;
            height: 60px;
        }

        .play-button-large i {
            font-size: 20px;
        }
    }
</style>

<?= $this->endSection() ?>