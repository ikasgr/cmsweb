<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Detail status pesanan Anda</p>
        </div>
    </div>
</section>

<section class="track-result py-16">
    <div class="auto-container">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <a href="<?= base_url('track-order') ?>" class="text-gray-600 hover:text-slate-800">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali Cari
                </a>
                <span class="text-sm text-gray-500">Dipesan pada:
                    <?= date('d M Y H:i', strtotime($order['created_at'])) ?></span>
            </div>

            <!-- Status Timeline -->
            <div class="bg-white rounded-xl shadow-sm border p-8 mb-8">
                <h3 class="font-bold text-gray-800 mb-6">Status Terkini</h3>

                <?php
                $statusMap = [
                    'pending' => ['step' => 1, 'label' => 'Menunggu Pembayaran'],
                    'confirmed' => ['step' => 2, 'label' => 'Pesanan Dikonfirmasi'],
                    'processing' => ['step' => 3, 'label' => 'Sedang Diproses'],
                    'shipped' => ['step' => 4, 'label' => 'Dalam Pengiriman'],
                    'completed' => ['step' => 5, 'label' => 'Selesai'],
                    'cancelled' => ['step' => 0, 'label' => 'Dibatalkan']
                ];

                $currentStatus = $order['status'];
                $currentStep = $statusMap[$currentStatus]['step'] ?? 1;
                ?>

                <?php if ($currentStatus === 'cancelled'): ?>
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg text-center font-bold">
                        <i class="fas fa-times-circle mr-2"></i> Pesanan Dibatalkan
                    </div>
                    <?php if (!empty($order['cancelled_at'])): ?>
                        <p class="text-center text-xs text-red-500 mt-2">Dibatalkan pada:
                            <?= date('d M Y H:i', strtotime($order['cancelled_at'])) ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="relative">
                        <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -translate-y-1/2 z-0 hidden md:block">
                        </div>
                        <div class="absolute top-1/2 left-0 h-1 bg-green-500 -translate-y-1/2 z-0 transition-all duration-500 hidden md:block"
                            style="width: <?= ($currentStep - 1) * 25 ?>%"></div>

                        <div class="flex flex-col md:flex-row justify-between relative z-10 gap-6 md:gap-0">
                            <?php
                            $steps = [
                                1 => ['icon' => 'fa-clock', 'label' => 'Menunggu'],
                                2 => ['icon' => 'fa-clipboard-check', 'label' => 'Dikonfirmasi'],
                                3 => ['icon' => 'fa-box-open', 'label' => 'Diproses'],
                                4 => ['icon' => 'fa-shipping-fast', 'label' => 'Dikirim'],
                                5 => ['icon' => 'fa-check-circle', 'label' => 'Selesai'],
                            ];
                            ?>

                            <?php foreach ($steps as $stepNum => $stepInfo): ?>
                                <div
                                    class="flex md:flex-col items-center gap-4 md:gap-2 <?= $stepNum <= $currentStep ? 'text-green-600' : 'text-gray-400' ?>">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center border-2 bg-white <?= $stepNum <= $currentStep ? 'border-green-500 text-green-600' : 'border-gray-300' ?>">
                                        <i class="fas <?= $stepInfo['icon'] ?>"></i>
                                    </div>
                                    <span class="text-sm font-semibold whitespace-nowrap"><?= $stepInfo['label'] ?></span>
                                    <?php if ($stepNum == $currentStep && isset($order[$currentStatus . '_at'])): ?>
                                        <span
                                            class="text-xs text-gray-500 hidden md:block"><?= date('d M H:i', strtotime($order[$currentStatus . '_at'])) ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Order Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                        <div class="p-6 border-b bg-gray-50">
                            <h3 class="font-bold text-gray-800">Detail Item</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <?php foreach ($order['items'] as $item): ?>
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden flex-shrink-0 border">
                                        <?php
                                        $images = json_decode($item['images'] ?? '[]', true);
                                        $image = $images[0] ?? null;
                                        ?>
                                        <?php if ($image): ?>
                                            <img src="<?= base_url('uploads/umkm/products/' . $image) ?>"
                                                alt="<?= esc($item['product_name']) ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800"><?= esc($item['product_name']) ?></h4>
                                        <p class="text-sm text-gray-500 mb-1">Pelapak: <a
                                                href="<?= base_url('umkm/pelapak/' . $item['seller_id']) ?>"
                                                class="text-blue-600 hover:underline"><?= esc($item['seller_name']) ?></a>
                                        </p>
                                        <p class="text-sm text-gray-600"><?= $item['quantity'] ?> x Rp
                                            <?= number_format($item['price'], 0, ',', '.') ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="block font-bold text-emerald-600">Rp
                                            <?= number_format($item['subtotal'], 0, ',', '.') ?></span>
                                        <span
                                            class="inline-block px-2 py-0.5 mt-2 text-xs rounded-full bg-gray-100 text-gray-600">
                                            <?= ucfirst($item['status']) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="p-6 bg-gray-50 border-t flex justify-end">
                            <div class="text-right">
                                <p class="text-gray-600 mb-1">Total Pembayaran</p>
                                <h3 class="text-2xl font-bold text-emerald-600">Rp
                                    <?= number_format($order['total'], 0, ',', '.') ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                        <h3 class="font-bold text-gray-800 mb-4 pb-2 border-b">Info Pengiriman</h3>
                        <div class="space-y-4 text-sm">
                            <div>
                                <span class="block text-gray-500 text-xs uppercase mb-1">Penerima</span>
                                <p class="font-semibold text-gray-800"><?= esc($order['customer_name']) ?></p>
                                <p class="text-gray-600"><?= esc($order['customer_phone']) ?></p>
                            </div>
                            <div>
                                <span class="block text-gray-500 text-xs uppercase mb-1">Alamat</span>
                                <p class="text-gray-700 leading-relaxed"><?= nl2br(esc($order['customer_address'])) ?>
                                </p>
                            </div>
                            <?php if (!empty($order['notes'])): ?>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase mb-1">Catatan</span>
                                    <p class="text-gray-700 italic">"<?= esc($order['notes']) ?>"</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8 text-sm text-gray-500">
                <p>Jika ada kendala dengan pesanan Anda, silakan hubungi pelapak terkait atau admin gereja.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>