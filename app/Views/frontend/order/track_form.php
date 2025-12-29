<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Pantau status pengiriman pesanan Anda secara real-time</p>
        </div>
    </div>
</section>

<section class="track-order py-16">
    <div class="auto-container">
        <div class="max-w-xl mx-auto">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger mb-6 text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm border p-8">
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search-location text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Cari Pesanan Anda</h3>
                    <p class="text-gray-600 text-sm mt-1">Masukkan ID Pesanan dan Email yang digunakan saat checkout.
                    </p>
                </div>

                <form action="<?= base_url('track-order/result') ?>" method="get" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">ID Pesanan</label>
                        <input type="text" name="order_number"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="Contoh: ORD-20251227-AB123" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="email@contoh.com" required>
                    </div>

                    <button type="submit" class="thm-btn w-full text-center">
                        <span class="txt">Lacak Pesanan</span>
                    </button>

                    <p class="text-xs text-center text-gray-500 mt-4">
                        Butuh bantuan? <a href="<?= base_url('contact') ?>"
                            class="text-blue-600 hover:underline">Hubungi kami</a>.
                    </p>
                </form>
            </div>

            <div class="mt-8 text-center">
                <a href="<?= base_url('umkm') ?>" class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali Belanja
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>


