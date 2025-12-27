<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Overlay Style -->
<section class="relative bg-slate-900 py-24 md:py-32 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <?php if (!empty($newsItem['featured_image'])): ?>
            <img src="<?= base_url('uploads/news/' . $newsItem['featured_image']) ?>" alt="<?= esc($newsItem['title']) ?>"
                class="w-full h-full object-cover opacity-30 blur-sm">
        <?php else: ?>
            <div class="w-full h-full bg-slate-800"></div>
        <?php endif ?>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/80 to-transparent"></div>
    </div>

    <div class="auto-container relative z-10 text-center">
        <div
            class="inline-block px-4 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-full uppercase tracking-wider mb-4">
            <?= esc($categories[$newsItem['category']] ?? ucfirst($newsItem['category'])) ?>
        </div>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight max-w-4xl mx-auto">
            <?= esc($newsItem['title']) ?>
        </h1>
        <div class="flex items-center justify-center gap-6 text-slate-300 text-sm md:text-base">
            <span class="flex items-center"><i class="far fa-calendar-alt mr-2"></i>
                <?= date('d M Y', strtotime($newsItem['published_at'])) ?></span>
            <span class="flex items-center"><i class="far fa-eye mr-2"></i>
                <?= number_format((int) ($newsItem['views'] ?? 0)) ?> kali dibaca</span>
        </div>
    </div>
</section>

<section class="blog-details py-20 bg-white">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Main Content -->
            <div class="col-xl-8 col-lg-8 col-md-12">
                <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <?php if (!empty($newsItem['featured_image'])): ?>
                        <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
                            <img src="<?= base_url('uploads/news/' . $newsItem['featured_image']) ?>"
                                alt="<?= esc($newsItem['title']) ?>" class="w-full h-auto">
                        </div>
                    <?php endif ?>

                    <div class="blog-content">
                        <?= $newsItem['content'] ?>
                    </div>
                </article>

                <!-- Share & Tags (Optional Placeholder) -->
                <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                    <div class="text-gray-500 font-semibold">Bagikan:</div>
                    <div class="flex gap-2">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-blue-50 text-blue-400 flex items-center justify-center hover:bg-blue-400 hover:text-white transition"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition"><i
                                class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="mt-8 flex justify-between">
                    <a href="<?= base_url('news') ?>"
                        class="text-gray-600 font-semibold hover:text-blue-600 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Berita
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4 col-md-12">
                <aside class="space-y-8 sticky top-24">
                    <!-- Categories Widget -->
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <h4 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Kategori</h4>
                        <ul class="space-y-2">
                            <li>
                                <a href="<?= base_url('news') ?>"
                                    class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-600 hover:bg-white transition hover:shadow-sm">
                                    <span>Semua Berita</span>
                                </a>
                            </li>
                            <?php foreach ($categories as $key => $label): ?>
                                <li>
                                    <a href="<?= base_url('news/category/' . $key) ?>"
                                        class="flex items-center justify-between px-3 py-2 rounded-lg <?= $key === $newsItem['category'] ? 'bg-white text-blue-600 font-bold shadow-sm' : 'text-gray-600 hover:bg-white hover:shadow-sm' ?> transition">
                                        <span><?= esc($label) ?></span>
                                        <?php if ($key === $newsItem['category']): ?>
                                            <i class="fas fa-check text-xs"></i>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <!-- Related News Widget -->
                    <?php if (!empty($relatedNews)): ?>
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                            <h4 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">Berita Terkait</h4>
                            <div class="space-y-4">
                                <?php foreach ($relatedNews as $item): ?>
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