<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>
                    <?php
                    if (isset($activeCategory) && is_string($activeCategory) && isset($categories[$activeCategory])) {
                        echo esc($categories[$activeCategory]);
                    } elseif (isset($activeCategory) && is_string($activeCategory)) {
                        echo esc($activeCategory);
                    } else {
                        echo 'Blog & News';
                    }
                    ?>
                </h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->


<!-- ================> Blog section start here <================== -->
<div class="blog blog-style2 padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__wrapper">
            <div class="row g-4">
                <div class="col-lg-8 col-12">
                    <div class="row g-4">
                        <?php if (empty($newsList)): ?>
                            <div class="col-12">
                                <div class="bg-white p-5 text-center rounded-4 shadow-sm">
                                    <div class="mb-4">
                                        <i class="fas fa-newspaper fa-4x text-muted opacity-25"></i>
                                    </div>
                                    <h3 class="mb-3">Belum ada warta terbaru</h3>
                                    <p class="text-muted mb-4">Saat ini belum ada berita di kategori ini.</p>
                                    <a href="<?= base_url('news') ?>" class="default-btn"><span>Kanal Berita
                                            Utama</span></a>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($newsList as $news): ?>
                                <div class="col-lg-6 col-12">
                                    <div class="blog__item shadow-sm h-100">
                                        <div class="blog__inner h-100 d-flex flex-column">
                                            <div class="blog__thumb">
                                                <a href="<?= base_url('news/' . $news['slug']) ?>">
                                                    <img src="<?= image_url($news['featured_image'], 'public/img/informasi/berita/', 'public/assets/images/blog/01.jpg') ?>"
                                                        alt="<?= esc($news['title']) ?>" class="w-100">
                                                </a>
                                                <div class="blog__category">
                                                    <?php
                                                    $catKey = $news['category'] ?? '';
                                                    if (is_string($catKey) && isset($categories[$catKey])) {
                                                        echo strtoupper(esc($categories[$catKey]));
                                                    } else {
                                                        echo 'WARTA';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="blog__content p-4 d-flex flex-column flex-grow-1">
                                                <a href="<?= base_url('news/' . $news['slug']) ?>" class="mb-3">
                                                    <h4 class="blog-title"><?= esc($news['title']) ?></h4>
                                                </a>
                                                <ul class="blog__meta mb-3">
                                                    <li><i class="far fa-calendar-alt text-warning"></i>
                                                        <?= date('d M Y', strtotime($news['published_at'])) ?></li>
                                                    <li><i class="far fa-eye text-warning"></i>
                                                        <?= number_format($news['views']) ?></li>
                                                </ul>
                                                <div class="blog-excerpt mb-4">
                                                    <?= esc(strip_tags($news['content'] ?? '')) ?>
                                                </div>
                                                <div class="mt-auto">
                                                    <a href="<?= base_url('news/' . $news['slug']) ?>"
                                                        class="read-more-btn">READ MORE <i
                                                            class="fas fa-long-arrow-alt-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($newsList)): ?>
                        <div class="pagination-wrapper mt-5 text-center d-flex justify-content-center">
                            <?= $pager->links('news', 'default_full') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar Section -->
                <div class="col-lg-4 col-12">
                    <div class="sidebar">
                        <!-- Search Widget -->
                        <div class="sidebar__search">
                            <div class="section__header">
                                <h2>Search News</h2>
                            </div>
                            <div class="section__wrapper">
                                <form action="<?= base_url('news') ?>" method="get">
                                    <input type="text" name="q" placeholder="Cari warta..."
                                        value="<?= esc($searchQuery ?? '') ?>">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <!-- Recent Post Widget -->
                        <?php if (isset($popularNews) && count($popularNews) > 0): ?>
                            <div class="sidebar__tab">
                                <div class="section__header">
                                    <h2>Popular Posts</h2>
                                </div>
                                <div class="section__wrapper">
                                    <div class="footer__post">
                                        <div class="section__wrapper">
                                            <?php foreach ($popularNews as $item): ?>
                                                <div class="footer__post-item mb-3 pb-3 border-bottom">
                                                    <div class="footer__post-inner d-flex align-items-start gap-3">
                                                        <div class="footer__post-thumb flex-shrink-0"
                                                            style="width: 50px; height: 60px; overflow: hidden; border-radius: 10px;">
                                                            <a href="<?= base_url('news/' . $item['slug']) ?>">
                                                                <img src="<?= image_url($item['featured_image'], 'public/img/informasi/berita/', 'public/assets/images/footer/post/01.jpg') ?>"
                                                                    alt="news" class="w-100 h-100 object-fit-cover">
                                                            </a>
                                                        </div>
                                                        <div class="footer__post-content">
                                                            <a href="<?= base_url('news/' . $item['slug']) ?>">
                                                                <h6 class="text-dark fw-bold mb-1"
                                                                    style="font-size: 14px; line-height: 1.4;">
                                                                    <?= esc($item['title']) ?>
                                                                </h6>
                                                            </a>
                                                            <p class="small text-muted mb-0"><i class="far fa-calendar-alt"></i>
                                                                <?= date('d M, Y', strtotime($item['published_at'])) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Categories Widget -->
                        <div class="sidebar__catagory">
                            <div class="section__header">
                                <h2>Categories</h2>
                            </div>
                            <div class="section__wrapper">
                                <ul>
                                    <?php foreach ($categories as $key => $label): ?>
                                        <li>
                                            <a href="<?= base_url('news/category/' . $key) ?>"
                                                class="<?= ($activeCategory === $key) ? 'text-primary' : '' ?>">
                                                <i class="fas fa-chevron-right"></i><?= esc($label) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Newsletter Widget / Tags Placeholder -->
                        <div class="sidebar__tag">
                            <div class="footer__tags">
                                <div class="section__header">
                                    <h2>Newsletter</h2>
                                </div>
                                <div class="section__wrapper">
                                    <p class="text-muted small">Dapatkan update terbaru langsung di email Anda.</p>
                                    <form class="mt-3">
                                        <input type="email" class="form-control mb-2" placeholder="Email Address">
                                        <button class="default-btn w-100 py-2 border-0"><span>Subscribe</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ================> Blog section end here <================== -->

<style>
    /* Correction for full image thumb styles on news page */
    .blog-style2 .blog__thumb {
        height: 240px;
        position: relative;
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }

    .blog-style2 .blog__thumb img {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-style2 .blog__item:hover .blog__thumb img {
        transform: scale(1.1);
    }

    .blog-style2 .blog__category {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--primary-yellow, #FFC107);
        color: #000;
        padding: 6px 15px;
        font-weight: 700;
        font-size: 13px;
        border-radius: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .blog-style2 .blog__item {
        border: none;
        background: #fff;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .blog-style2 .blog__item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
    }

    .blog-style2 .blog__inner {
        display: block !important;
    }

    .blog-title {
        font-size: 20px;
        font-weight: 800;
        color: #222;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .blog__item:hover .blog-title {
        color: var(--primary-yellow, #FFC107);
    }

    .blog__meta {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 20px;
    }

    .blog__meta li {
        font-size: 14px;
        color: #888;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blog-excerpt {
        font-size: 15px;
        color: #666;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .read-more-btn {
        font-weight: 700;
        font-size: 13px;
        color: #111;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .read-more-btn:hover {
        color: var(--primary-yellow, #FFC107);
        gap: 15px;
    }

    /* Fix for footer widgets styling in sidebar */
    .sidebar .footer__post-inner {
        display: flex;
        gap: 15px;
    }

    .sidebar .footer__post-content h6 {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 5px;
        line-height: 1.4;
        color: #333 !important;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .sidebar .footer__post-content h6:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .sidebar .footer__post-content p {
        font-size: 11px;
        color: #999;
        margin: 0;
    }

    /* Sidebar list styling */
    .sidebar__catagory ul {
        list-style: none;
        padding: 0;
    }

    .sidebar__catagory ul li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        background: #fff;
        margin-bottom: 5px;
        border-radius: 8px;
        font-weight: 600;
        color: #444;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        text-decoration: none;
    }

    .sidebar__catagory ul li a:hover,
    .sidebar__catagory ul li a.text-primary {
        background: var(--gray-50);
        border-color: var(--primary-yellow);
        color: #000 !important;
        padding-left: 20px;
    }

    .sidebar__catagory ul li a i {
        font-size: 10px;
        color: var(--primary-yellow);
    }
</style>

<?= $this->endSection() ?>