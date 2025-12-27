<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Dapatkan kabar dan warta pelayanan terbaru gereja.</p>
        </div>
    </div>
</section>

<section class="blog-page py-20 bg-gray-50">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- News List -->
            <div class="col-xl-8 col-lg-8 col-md-12">
                <?php if (empty($newsList)): ?>
                    <div class="bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100">
                        <div
                            class="w-20 h-20 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                            <i class="icon-newspaper"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada berita</h3>
                        <p class="text-gray-500">Berita pada kategori ini belum tersedia saat ini.</p>
                        <a href="<?= base_url('news') ?>" class="thm-btn mt-6"><span class="txt">Lihat Semua
                                Berita</span></a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($newsList as $news): ?>
                            <div class="col-md-6 mb-8">
                                <div
                                    class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 h-full flex flex-col border border-gray-100 group">
                                    <div class="relative overflow-hidden h-48">
                                        <?php if (!empty($news['featured_image'])): ?>
                                            <img src="<?= base_url('uploads/news/' . $news['featured_image']) ?>"
                                                alt="<?= esc($news['title']) ?>"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                <i class="icon-photo text-3xl"></i>
                                            </div>
                                        <?php endif ?>
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                                <?= esc($categories[$news['category']] ?? ucfirst($news['category'])) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="p-6 flex-1 flex flex-col">
                                        <div class="flex items-center text-xs text-gray-500 mb-3 space-x-4">
                                            <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i>
                                                <?= date('d M Y', strtotime($news['published_at'])) ?></span>
                                            <span class="flex items-center"><i class="far fa-eye mr-1.5"></i>
                                                <?= number_format((int) ($news['views'] ?? 0)) ?></span>
                                        </div>

                                        <h3
                                            class="text-xl font-bold text-gray-800 mb-3 leading-snug group-hover:text-blue-600 transition-colors">
                                            <a href="<?= base_url('news/' . $news['slug']) ?>">
                                                <?= esc($news['title']) ?>
                                            </a>
                                        </h3>

                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                                            <?= esc($news['excerpt'] ?? word_limiter(strip_tags($news['content']), 20)) ?>
                                        </p>

                                        <div class="mt-auto pt-4 border-t border-gray-100">
                                            <a href="<?= base_url('news/' . $news['slug']) ?>"
                                                class="text-blue-600 font-semibold text-sm hover:text-blue-800 flex items-center">
                                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <div class="mt-8 flex justify-center">
                        <?= $pager->links('news', 'default_full') ?>
                    </div>
                <?php endif ?>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4 col-md-12">
                <aside class="space-y-8">
                    <!-- Search Widget -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Pencarian</h4>
                        <form action="<?= base_url('news') ?>" method="get" class="relative">
                            <input type="text" name="q" placeholder="Cari berita..."
                                class="w-full pl-4 pr-12 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                                <i class="icon-search text-xl"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Kategori</h4>
                        <ul class="space-y-2">
                            <li>
                                <a href="<?= base_url('news') ?>"
                                    class="flex items-center justify-between px-3 py-2 rounded-lg <?= $activeCategory === null ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' ?> transition">
                                    <span>Semua Berita</span>
                                    <i class="fas fa-chevron-right text-xs opacity-50"></i>
                                </a>
                            </li>
                            <?php foreach ($categories as $key => $label): ?>
                                <li>
                                    <a href="<?= base_url('news/category/' . $key) ?>"
                                        class="flex items-center justify-between px-3 py-2 rounded-lg <?= $activeCategory === $key ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' ?> transition">
                                        <span><?= esc($label) ?></span>
                                        <i class="fas fa-chevron-right text-xs opacity-50"></i>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <!-- Popular News Widget -->
                    <?php if (isset($popularNews) && count($popularNews) > 0): ?>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h4 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Terpopuler</h4>
                            <div class="space-y-4">
                                <?php foreach ($popularNews as $item): ?>
                                    <div class="flex gap-4 group">
                                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-200">
                                            <?php if (!empty($item['featured_image'])): ?>
                                                <img src="<?= base_url('uploads/news/' . $item['featured_image']) ?>"
                                                    alt="<?= esc($item['title']) ?>"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            <?php else: ?>
                                                <div class="w-full h-full flex items-center justify-center text-gray-400"><i
                                                        class="icon-photo"></i></div>
                                            <?php endif ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h5
                                                class="text-sm font-bold text-gray-800 leading-snug mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">
                                                <a
                                                    href="<?= base_url('news/' . $item['slug']) ?>"><?= esc($item['title']) ?></a>
                                            </h5>
                                            <span class="text-xs text-gray-500 flex items-center">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <?= date('d M Y', strtotime($item['published_at'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                </aside>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>