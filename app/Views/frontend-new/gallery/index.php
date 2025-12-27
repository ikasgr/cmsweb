<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Dokumentasi foto dan video pelayanan serta kegiatan jemaat.</p>
        </div>
    </div>
</section>

<section class="gallery-page py-20 bg-gray-50">
    <div class="auto-container">
        <!-- Filter Section -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
            <form action="<?= base_url('gallery') ?>" method="get" class="flex flex-wrap gap-4 items-end">
                <div class="w-full md:w-auto flex-1">
                    <label class="block text-gray-700 font-semibold mb-2 text-sm">Jenis Media</label>
                    <div class="relative">
                        <select name="type"
                            class="w-full px-4 py-3 border rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">Semua</option>
                            <option value="photo" <?= $filters['type'] === 'photo' ? 'selected' : '' ?>>Foto</option>
                            <option value="video" <?= $filters['type'] === 'video' ? 'selected' : '' ?>>Video</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div class="w-full md:w-auto flex-1">
                    <label class="block text-gray-700 font-semibold mb-2 text-sm">Kategori</label>
                    <div class="relative">
                        <select name="category"
                            class="w-full px-4 py-3 border rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <?php $categoryName = $category['category'] ?: 'Umum'; ?>
                                <option value="<?= esc($category['category']) ?>"
                                    <?= $filters['category'] === $category['category'] ? 'selected' : '' ?>>
                                    <?= esc(ucwords($categoryName)) ?> (<?= $category['total'] ?>)
                                </option>
                            <?php endforeach ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div class="w-full md:w-auto">
                    <button type="submit" class="thm-btn w-full md:w-auto text-center"><span class="txt">Terapkan
                            Filter</span></button>
                </div>
            </form>
        </div>

        <?php if (empty($items)): ?>
            <div class="bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100">
                <div
                    class="w-20 h-20 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="icon-camera"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada media</h3>
                <p class="text-gray-500">Belum ada dokumentasi yang sesuai dengan filter ini.</p>
                <a href="<?= base_url('gallery') ?>"
                    class="text-blue-600 font-semibold mt-4 inline-block hover:underline">Lihat Semua Galeri</a>
            </div>
        <?php else: ?>
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($items as $item): ?>
                    <div
                        class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            <a href="<?= base_url('gallery/' . $item['id']) ?>" class="block w-full h-full">
                                <?php if ($item['type'] === 'photo'): ?>
                                    <img src="<?= base_url('uploads/gallery/' . $item['file_path']) ?>"
                                        alt="<?= esc($item['title']) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div
                                        class="absolute top-4 right-4 bg-white/90 backdrop-blur text-gray-800 p-2 rounded-full shadow-sm">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php else: ?>
                                    <img src="<?= $item['thumbnail'] ? base_url('uploads/gallery/' . $item['thumbnail']) : base_url('assets/images/gallery/video-placeholder.jpg') ?>"
                                        alt="<?= esc($item['title']) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div
                                        class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-colors">
                                        <div
                                            class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-600 shadow-lg group-hover:scale-110 transition-transform">
                                            <i class="fas fa-play ml-1"></i>
                                        </div>
                                    </div>
                                    <div
                                        class="absolute top-4 right-4 bg-white/90 backdrop-blur text-gray-800 p-2 rounded-full shadow-sm">
                                        <i class="fas fa-video"></i>
                                    </div>
                                <?php endif ?>
                            </a>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                    <?= esc(ucwords($item['category'] ?: 'Umum')) ?>
                                </span>
                                <span class="text-xs text-gray-500 flex items-center">
                                    <i class="far fa-calendar mr-1"></i>
                                    <?= date('d M Y', strtotime($item['event_date'] ?? $item['created_at'])) ?>
                                </span>
                            </div>

                            <h3
                                class="font-bold text-lg text-gray-800 mb-2 leading-tight group-hover:text-blue-600 transition-colors">
                                <a href="<?= base_url('gallery/' . $item['id']) ?>"><?= esc($item['title']) ?></a>
                            </h3>

                            <p class="text-gray-600 text-sm line-clamp-2 mb-4 flex-1">
                                <?= esc(strip_tags($item['description'] ?? '')) ?></p>

                            <div
                                class="flex items-center justify-between pt-4 border-t border-gray-50 mt-auto text-sm text-gray-500">
                                <span class="flex items-center text-xs">
                                    <i class="far fa-eye mr-1.5"></i> <?= number_format($item['views'] ?? 0) ?> views
                                </span>
                                <a href="<?= base_url('gallery/' . $item['id']) ?>"
                                    class="font-semibold text-blue-600 hover:text-blue-800 flex items-center text-xs uppercase tracking-wide">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- Pagination logic would go here if needed -->
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>