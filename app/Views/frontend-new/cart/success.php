<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-20">
    <div class="auto-container">
        <div class="max-w-2xl mx-auto text-center">
            <div
                class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-600">
                <i class="fas fa-check text-4xl"></i>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-600 mb-8 text-lg">
                Terima kasih telah berbelanja di UMKM Gereja. <br>
                Pesanan Anda telah kami terima dan akan segera diproses oleh pelapak.
            </p>

            <div class="bg-gray-50 border rounded-xl p-6 mb-8 text-left">
                <h4 class="font-bold text-lg text-gray-800 mb-4">Apa Selanjutnya?</h4>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span
                            class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-bold">1</span>
                        <span>Pelapak akan menerima notifikasi pesanan ini.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-bold">2</span>
                        <span>Anda mungkin dihubungi via WhatsApp untuk konfirmasi pembayaran dan pengiriman.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span
                            class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-bold">3</span>
                        <span>Pantau status pesanan berkala jika Anda memiliki akun.</span>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?= base_url('umkm') ?>" class="thm-btn">
                    <span class="txt">Belanja Lagi</span>
                </a>
                <a href="<?= base_url('/') ?>"
                    class="px-8 py-4 bg-gray-100 text-gray-700 font-bold rounded-full hover:bg-gray-200 transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>