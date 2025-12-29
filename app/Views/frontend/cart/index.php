<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="page-header">
    <div class="auto-container">
        <div class="page-header__inner">
            <h1><?= $title ?></h1>
            <p>Kelola daftar belanjaan Anda sebelum checkout</p>
        </div>
    </div>
</section>

<section class="cart-page py-16">
    <div class="auto-container">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success mb-8">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mb-8">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <div class="text-center py-12">
                <i class="icon-shopping-bag1 text-6xl text-gray-300 mb-4 inline-block"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Keranjang Belanja Kosong</h3>
                <p class="text-gray-600 mb-6">Anda belum menambahkan produk apapun ke keranjang.</p>
                <a href="<?= base_url('umkm') ?>" class="thm-btn">
                    <span class="txt">Mulai Belanja</span>
                </a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white rounded-lg shadow-sm border p-6">
                        <div class="table-responsive">
                            <table class="w-full text-left">
                                <thead class="border-b">
                                    <tr>
                                        <th class="py-4 font-bold text-gray-700">Produk</th>
                                        <th class="py-4 font-bold text-gray-700">Harga</th>
                                        <th class="py-4 font-bold text-gray-700 text-center">Jumlah</th>
                                        <th class="py-4 font-bold text-gray-700">Total</th>
                                        <th class="py-4 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <?php foreach ($cart as $item): ?>
                                        <tr>
                                            <td class="py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                                        <?php if ($item['image']): ?>
                                                            <img src="<?= base_url('public/uploads/umkm/products/' . $item['image']) ?>"
                                                                alt="<?= esc($item['name']) ?>" class="w-full h-full object-cover">
                                                        <?php else: ?>
                                                            <div
                                                                class="w-full h-full flex items-center justify-center text-gray-400">
                                                                <i class="icon-photo"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-gray-800 hover:text-blue-600 transition">
                                                            <a
                                                                href="<?= base_url('umkm/produk/' . $item['slug']) ?>"><?= esc($item['name']) ?></a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-6 font-medium text-gray-700">
                                                Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                            </td>
                                            <td class="py-6">
                                                <form action="<?= base_url('cart/update') ?>" method="post"
                                                    class="flex items-center justify-center gap-2">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                    <input type="number" name="qty" value="<?= $item['qty'] ?>" min="1"
                                                        class="w-16 px-2 py-1 border rounded text-center"
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="py-6 font-bold text-emerald-600">
                                                Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>
                                            </td>
                                            <td class="py-6 text-right">
                                                <a href="<?= base_url('cart/remove/' . $item['id']) ?>"
                                                    class="text-red-500 hover:text-red-700 p-2"
                                                    onclick="return confirm('Hapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-between items-center mt-6 pt-4 border-t">
                            <a href="<?= base_url('umkm') ?>" class="text-gray-600 hover:text-gray-900 font-medium">
                                <i class="fas fa-arrow-left mr-2"></i> Lanjut Belanja
                            </a>
                            <a href="<?= base_url('cart/clear') ?>"
                                class="text-red-500 hover:text-red-700 font-medium text-sm"
                                onclick="return confirm('Kosongkan semua keranjang?')">
                                Kosongkan Keranjang
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-8 lg:mt-0">
                    <div class="bg-gray-50 rounded-lg p-6 border sticky top-8">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b">Ringkasan Pesanan</h3>

                        <div class="flex justify-between mb-4 text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>

                        <div class="flex justify-between mb-6 text-xl font-bold text-gray-900 pt-4 border-t">
                            <span>Total</span>
                            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>

                        <a href="<?= base_url('cart/checkout') ?>" class="thm-btn w-full text-center block">
                            <span class="txt">Checkout Sekarang</span>
                        </a>

                        <p class="text-xs text-gray-500 mt-4 text-center">
                            Pembayaran dan pengiriman akan dikonfirmasi setelah checkout.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>


