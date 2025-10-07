<!-- ================================================== -->
<!-- KODE INI HARUS DITAMBAHKAN KE FILE v_home.php -->
<!-- LOKASI: Setelah baris 529 (setelah </div> penutup section berita) -->
<!-- SEBELUM: <div class="container bg-light-blue "> (baris 530) -->
<!-- ================================================== -->

        <!-- ================================================== -->
        <!-- Begin Jadwal Pelayanan Section
        ================================================== -->
        <?php 
        use App\Models\M_JadwalPelayanan;
        $jadwal_model = new M_JadwalPelayanan();
        $jadwal_upcoming = $jadwal_model->upcoming(4);
        
        if ($jadwal_upcoming) : ?>
        <div class="container mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="montserrat-800 f-24 text-blue">
                            <i class="fas fa-calendar-check"></i> Jadwal Pelayanan
                        </h1>
                        <a href="<?= base_url('jadwal') ?>" class="btn btn-primary btn-sm">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($jadwal_upcoming as $jadwal) : 
                    $badge_color = [
                        'Ibadah Minggu' => 'primary',
                        'Ibadah Pemuda' => 'success',
                        'Ibadah Anak' => 'info',
                        'Persekutuan Doa' => 'warning',
                        'Komsel' => 'secondary',
                        'Kebaktian Khusus' => 'danger',
                        'Acara Gereja' => 'dark'
                    ];
                    $badge = $badge_color[$jadwal['jenis_pelayanan']] ?? 'primary';
                ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div class="bg-primary text-white p-3 rounded">
                                        <h2 class="mb-0"><?= date('d', strtotime($jadwal['tanggal'])) ?></h2>
                                        <small><?= strftime('%b', strtotime($jadwal['tanggal'])) ?></small>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title text-primary mb-2"><?= esc($jadwal['judul_jadwal']) ?></h5>
                                    <span class="badge badge-<?= $badge ?> mb-2"><?= esc($jadwal['jenis_pelayanan']) ?></span>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-clock text-primary"></i> 
                                        <small><?= date('H:i', strtotime($jadwal['waktu_mulai'])) ?></small>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-map-marker-alt text-danger"></i> 
                                        <small><?= esc($jadwal['tempat']) ?></small>
                                    </p>
                                    <?php if ($jadwal['pengkhotbah']) : ?>
                                    <p class="card-text mb-0">
                                        <i class="fas fa-user-tie text-success"></i> 
                                        <small><?= esc($jadwal['pengkhotbah']) ?></small>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Jadwal Pelayanan Section -->

        <!-- ================================================== -->
        <!-- Begin Produk UMKM Section
        ================================================== -->
        <?php 
        use App\Models\M_ProdukUmkm;
        $produk_model = new M_ProdukUmkm();
        $produk_featured = $produk_model->featured()->limit(4)->get()->getResultArray();
        
        if ($produk_featured) : ?>
        <div class="container mt-5 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="montserrat-800 f-24 text-blue">
                            <i class="fas fa-shopping-bag"></i> Produk UMKM Jemaat
                        </h1>
                        <a href="<?= base_url('toko') ?>" class="btn btn-success btn-sm">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($produk_featured as $produk) : 
                    $harga_tampil = !empty($produk['harga_promo']) ? $produk['harga_promo'] : $produk['harga'];
                    $diskon = 0;
                    if (!empty($produk['harga_promo'])) {
                        $diskon = round((($produk['harga'] - $produk['harga_promo']) / $produk['harga']) * 100);
                    }
                ?>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card h-100 shadow-sm product-card-home">
                        <div class="position-relative">
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>">
                                <img src="<?= base_url('/public/img/produk/' . $produk['gambar']) ?>" 
                                     class="card-img-top" alt="<?= esc($produk['nama_produk']) ?>"
                                     style="height: 200px; object-fit: cover;">
                            </a>
                            <?php if ($diskon > 0) : ?>
                                <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">
                                    -<?= $diskon ?>%
                                </span>
                            <?php endif; ?>
                            <span class="badge badge-warning position-absolute" style="top: 10px; left: 10px;">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="text-dark">
                                    <?= esc($produk['nama_produk']) ?>
                                </a>
                            </h6>
                            <div class="mb-2">
                                <?php if (!empty($produk['harga_promo'])) : ?>
                                    <small class="text-muted" style="text-decoration: line-through;">
                                        Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                                    </small><br>
                                <?php endif; ?>
                                <span class="text-primary font-weight-bold h6">
                                    Rp <?= number_format($harga_tampil, 0, ',', '.') ?>
                                </span>
                            </div>
                            <a href="<?= base_url('toko/' . $produk['slug_produk']) ?>" class="btn btn-primary btn-sm btn-block">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- End Produk UMKM Section -->

<!-- ================================================== -->
<!-- CSS TAMBAHAN - Tambahkan di bagian <style> atau file CSS terpisah -->
<!-- ================================================== -->
<style>
.product-card-home {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card-home:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}

.product-card-home .card-title a:hover {
    color: #007bff !important;
}
</style>
