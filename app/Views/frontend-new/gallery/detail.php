<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= esc($item['title']) ?></h1>
            <p><?= esc(ucwords($item['category'] ?: 'Umum')) ?> &bull;
                <?= date('d F Y', strtotime($item['event_date'] ?? $item['created_at'])) ?></p>
        </div>
    </div>
</section>

<section class="gallery-detail py-20 bg-gray-50">
    <div class="auto-container">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-12">
            <!-- Media Viewer -->
            <div class="bg-gray-900 flex justify-center items-center relative group min-h-[400px] md:min-h-[600px]">
                <?php if ($item['type'] === 'photo'): ?>
                    <img src="<?= base_url('uploads/gallery/' . $item['file_path']) ?>" alt="<?= esc($item['title']) ?>"
                        class="max-w-full max-h-[80vh] object-contain">
                    <a href="<?= base_url('uploads/gallery/' . $item['file_path']) ?>" target="_blank"
                        class="absolute bottom-6 right-6 bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold transition-colors flex items-center">
                        <i class="fas fa-download mr-2"></i> Unduh Foto Original
                    </a>
                <?php else: ?>
                    <?php if (!empty($item['video_url'])): ?>
                        <div class="w-full h-full aspect-video">
                            <iframe src="<?= esc($item['video_url']) ?>" class="w-full h-full" allowfullscreen
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                        </div>
                    <?php else: ?>
                        <img src="<?= $item['thumbnail'] ? base_url('uploads/gallery/' . $item['thumbnail']) : base_url('assets/images/gallery/video-placeholder.jpg') ?>"
                            alt="<?= esc($item['title']) ?>" class="w-full h-full object-cover opacity-50">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-white text-lg">Video tidak tersedia</span>
                        </div>
                    <?php endif ?>
                <?php endif ?>
            </div>

            <!-- Info & Description -->
            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row gap-8 justify-between">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Dokumentasi Ini</h2>
                        <?php if (!empty($item['description'])): ?>
                            <div class="prose text-gray-600 leading-relaxed">
                                <?= nl2br(esc($item['description'])) ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-400 italic">Tidak ada deskripsi tambahan.</p>
                        <?php endif ?>
                    </div>

                    <div class="w-full md:w-80 flex-shrink-0">
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <h4 class="font-bold text-gray-800 mb-4 pb-2 border-b">Informasi Detail</h4>
                            <ul class="space-y-4 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-500">Jenis Media</span>
                                    <span
                                        class="font-semibold text-gray-900"><?= $item['type'] === 'photo' ? 'Foto' : 'Video' ?></span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-500">Kategori</span>
                                    <span
                                        class="font-semibold text-gray-900"><?= esc(ucwords($item['category'] ?: 'Umum')) ?></span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-500">Tanggal Acara</span>
                                    <span
                                        class="font-semibold text-gray-900"><?= date('d M Y', strtotime($item['event_date'] ?? $item['created_at'])) ?></span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-500">Dilihat</span>
                                    <span class="font-semibold text-gray-900"><?= number_format($item['views'] ?? 0) ?>
                                        kali</span>
                                </li>
                            </ul>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex gap-2 justify-center">
                                    <button
                                        class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition"><i
                                            class="fab fa-facebook-f"></i></button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition"><i
                                            class="fab fa-whatsapp"></i></button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-600 hover:text-white transition"><i
                                            class="fas fa-link"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <a href="<?= base_url('gallery') ?>"
                        class="inline-flex items-center text-gray-600 hover:text-blue-600 font-semibold transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>

        <?php if (!empty($related)): ?>
            <div class="mt-16">
                <div class="flex items-center justify-between mb-8">
                    <div class="sec-title text-left mb-0">
                        <div class="sec-title__tagline">
                            <h6>Media Lainnya</h6>
                        </div>
                        <h2 class="sec-title__title">Dokumentasi Terkait</h2>
                    </div>
                    <a href="<?= base_url('gallery') ?>" class="hidden md:inline-block thm-btn thm-btn--outline"><span
                            class="txt">Lihat Semua</span></a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($related as $relatedItem): ?>
                        <div
                            class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                            <div class="relative h-56 overflow-hidden">
                                <a href="<?= base_url('gallery/' . $relatedItem['id']) ?>" class="block w-full h-full">
                                    <?php if ($relatedItem['type'] === 'photo'): ?>
                                        <img src="<?= base_url('uploads/gallery/' . $relatedItem['file_path']) ?>"
                                            alt="<?= esc($relatedItem['title']) ?>"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div
                                            class="absolute top-3 right-3 bg-white/90 backdrop-blur text-gray-800 p-1.5 rounded-full shadow-sm text-xs">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php else: ?>
                                        <img src="<?= $relatedItem['thumbnail'] ? base_url('uploads/gallery/' . $relatedItem['thumbnail']) : base_url('assets/images/gallery/video-placeholder.jpg') ?>"
                                            alt="<?= esc($relatedItem['title']) ?>"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div
                                            class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-colors">
                                            <div
                                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 shadow-lg group-hover:scale-110 transition-transform">
                                                <i class="fas fa-play ml-1 text-xs"></i>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-3 right-3 bg-white/90 backdrop-blur text-gray-800 p-1.5 rounded-full shadow-sm text-xs">
                                            <i class="fas fa-video"></i>
                                        </div>
                                    <?php endif ?>
                                </a>
                            </div>

                            <div class="p-5 flex-1 flex flex-col">
                                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-2 block">
                                    <?= esc(ucwords($relatedItem['category'] ?: 'Umum')) ?>
                                </span>

                                <h3
                                    class="font-bold text-base text-gray-800 mb-2 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a
                                        href="<?= base_url('gallery/' . $relatedItem['id']) ?>"><?= esc($relatedItem['title']) ?></a>
                                </h3>

                                <div class="mt-auto text-xs text-gray-500 flex items-center">
                                    <i class="far fa-calendar mr-1.5"></i>
                                    <?= date('d M Y', strtotime($relatedItem['event_date'] ?? $relatedItem['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>