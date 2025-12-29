<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Lengkapi data pengiriman untuk memproses pesanan Anda</p>
        </div>
    </div>
</section>

<section class="checkout-page py-16">
    <div class="auto-container">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mb-8">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('cart/checkout') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <!-- Customer Details -->
                <div class="col-lg-7">
                    <div class="bg-white rounded-lg shadow-sm border p-6 md:p-8 mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b">Data Pembeli</h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" value="<?= old('customer_name') ?>"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    required placeholder="Masukkan nama Anda">
                                <?php if (session('errors.customer_name')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= session('errors.customer_name') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="customer_email" value="<?= old('customer_email') ?>"
                                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                        required placeholder="Email aktif">
                                    <?php if (session('errors.customer_email')): ?>
                                        <p class="text-red-500 text-sm mt-1"><?= session('errors.customer_email') ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">No. WhatsApp / HP <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="customer_phone" value="<?= old('customer_phone') ?>"
                                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                        required placeholder="08...">
                                    <?php if (session('errors.customer_phone')): ?>
                                        <p class="text-red-500 text-sm mt-1"><?= session('errors.customer_phone') ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Alamat Pengiriman Lengkap <span
                                        class="text-red-500">*</span></label>
                                <textarea name="customer_address" rows="3"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    required
                                    placeholder="Nama jalan, nomor rumah, RT/RW, Kecamatan, Kota..."><?= old('customer_address') ?></textarea>
                                <?php if (session('errors.customer_address')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= session('errors.customer_address') ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Catatan Tambahan
                                    (Opsional)</label>
                                <textarea name="notes" rows="2"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                    placeholder="Pesan khusus untuk penjual..."><?= old('notes') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="bg-gray-50 rounded-lg p-6 border sticky top-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b">Ringkasan Pesanan</h3>

                        <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2">
                            <?php foreach ($cart as $item): ?>
                                <div class="flex gap-4">
                                    <div class="w-16 h-16 bg-white rounded overflow-hidden flex-shrink-0 border">
                                        <?php if ($item['image']): ?>
                                            <img src="<?= base_url('public/uploads/umkm/products/' . $item['image']) ?>"
                                                alt="<?= esc($item['name']) ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="icon-photo"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-800 truncate"><?= esc($item['name']) ?></h4>
                                        <p class="text-xs text-gray-500"><?= $item['qty'] ?> x Rp
                                            <?= number_format($item['price'], 0, ',', '.') ?></p>
                                        <p class="text-sm font-semibold text-emerald-600">Rp
                                            <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="flex justify-between mb-2 text-gray-600">
                            <span>Total Item</span>
                            <span><?= count($cart) ?></span>
                        </div>

                        <div class="flex justify-between mb-6 text-xl font-bold text-gray-900 pt-4 border-t">
                            <span>Total Bayar</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-100">
                            <h4 class="font-bold text-blue-900 text-sm mb-2"><i class="fas fa-info-circle mr-1"></i>
                                Informasi Pembayaran</h4>
                            <p class="text-xs text-blue-800">
                                Silakan lakukan pembayaran ke rekening gereja / pelapak setelah melakukan checkout.
                                Detail pembayaran akan dikirimkan ke WhatsApp Anda.
                            </p>
                        </div>

                        <button type="submit" class="thm-btn w-full text-center">
                            <span class="txt">Buat Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>


