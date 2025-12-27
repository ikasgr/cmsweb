<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1>Majelis Gereja</h1>
            <p>Profil majelis dan tim pendukung pelayanan Gereja FLOBAMORA.</p>
        </div>
    </div>
</section>

<section class="team-page py-20 bg-gray-50">
    <div class="auto-container">
        <?php if (!empty($majelis)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($majelis as $member): ?>
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col"
                        id="<?= esc(url_title($member['name'], '-', true)) ?>">
                        <div class="relative h-80 overflow-hidden bg-gray-100">
                            <!-- Background Shape -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-60 z-10">
                            </div>

                            <?php if (!empty($member['photo'])): ?>
                                <img src="<?= base_url('uploads/majelis/' . $member['photo']) ?>" alt="<?= esc($member['name']) ?>"
                                    class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/team/team-placeholder.jpg') ?>"
                                    alt="<?= esc($member['name']) ?>" class="w-full h-full object-cover object-top opacity-50">
                                <div class="absolute inset-0 flex items-center justify-center z-0">
                                    <i class="icon-user text-6xl text-gray-400"></i>
                                </div>
                            <?php endif ?>

                            <div
                                class="absolute bottom-0 left-0 right-0 p-6 z-20 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <div
                                    class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-2 shadow-sm">
                                    <?= esc($member['position']) ?>
                                </div>
                                <h3 class="text-2xl font-bold text-white leading-tight"><?= esc($member['name']) ?></h3>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <?php if (!empty($member['bio'])): ?>
                                <p class="text-gray-600 mb-6 flex-1 text-sm leading-relaxed">
                                    <?= esc($member['bio']) ?>
                                </p>
                            <?php else: ?>
                                <p class="text-gray-400 italic mb-6 flex-1 text-sm">Tidak ada biografi singkat.</p>
                            <?php endif ?>

                            <div class="border-t border-gray-100 pt-4 flex flex-col gap-2">
                                <?php if (!empty($member['phone'])): ?>
                                    <a href="tel:<?= esc($member['phone']) ?>"
                                        class="flex items-center text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                                            <span class="icon-phone text-xs"></span>
                                        </div>
                                        <?= esc($member['phone']) ?>
                                    </a>
                                <?php endif ?>

                                <?php if (!empty($member['email'])): ?>
                                    <a href="mailto:<?= esc($member['email']) ?>"
                                        class="flex items-center text-sm text-gray-500 hover:text-blue-600 transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                                            <span class="icon-email text-xs"></span>
                                        </div>
                                        <?= esc($member['email']) ?>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <div class="bg-white p-12 text-center rounded-xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
                <div
                    class="w-20 h-20 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="icon-user"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Data Belum Tersedia</h3>
                <p class="text-gray-500">Profil majelis gereja belum ditambahkan.</p>
            </div>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>