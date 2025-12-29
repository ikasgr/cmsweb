<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>

<!-- ================> PageHeader section start here <================== -->
<div class="pageheader">
    <div class="container">
        <div class="pageheader__area">
            <div class="pageheader__left">
                <h3>Detail News</h3>
            </div>
            <div class="pageheader__right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('news') ?>">News</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= esc($news['category_name'] ?? 'Detail') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ================> PageHeader section end here <================== -->


<!-- ================> Blog section start here <================== -->
<div class="blog blog-style2 blog-single padding--top padding--bottom bg-light">
    <div class="container">
        <div class="section__wrapper">
            <div class="row g-4">
                <div class="col-lg-8 col-12">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="blog__item shadow-sm border-0">
                                <div class="blog__inner">
                                    <div class="blog__thumb">
                                        <img src="<?= image_url($news['featured_image'], 'public/img/informasi/berita/', 'public/assets/images/blog/07.jpg') ?>"
                                            alt="<?= esc($news['title']) ?>" class="w-100">
                                    </div>
                                    <div class="blog__content p-4 p-md-5">
                                        <h2 class="mb-4 fw-bold text-dark"><?= esc($news['title']) ?></h2>
                                        <ul class="blog__content-metapost mb-4">
                                            <li><i class="far fa-calendar"></i>
                                                <?= date('d M Y', strtotime($news['published_at'])) ?></li>
                                            <li><i class="fas fa-user"></i> <?= esc($news['author']) ?></li>
                                            <li><i class="fas fa-tag"></i> <a
                                                    href="<?= base_url('news/category/' . ($news['category'] ?? '')) ?>"><?= esc($news['category_name'] ?? 'Uncategorized') ?></a>
                                            </li>
                                            <li><i class="far fa-eye"></i> <?= number_format($news['views']) ?> Views
                                            </li>
                                        </ul>

                                        <div class="article-body">
                                            <?= $news['content'] ?>
                                        </div>

                                        <div class="blog__tags mt-5 pt-4 border-top">
                                            <div class="blog__tags-left">
                                                <div class="blog__tags-title">
                                                    <p>Tags:</p>
                                                </div>
                                                <div class="blog__tags-details">
                                                    <ul>
                                                        <?php if (!empty($news['tags'])): ?>
                                                            <?php foreach ($news['tags'] as $tg): ?>
                                                                <li><a
                                                                        href="<?= base_url('news/tagar/' . esc($tg['tag_id'])) ?>"><?= esc($tg['nama_tag']) ?></a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <li><a
                                                                    href="#"><?= esc($news['category_name'] ?? 'General') ?></a>
                                                            </li>
                                                            <li><a href="#">Warta</a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="blog__tags-right">
                                                <div class="blog__tags-title">
                                                    <p>Share:</p>
                                                </div>
                                                <div class="blog__tags-details">
                                                    <div class="footer__social">
                                                        <ul>
                                                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>"
                                                                    target="_blank"><i
                                                                        class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>"
                                                                    target="_blank"><i class="fab fa-twitter"></i></a>
                                                            </li>
                                                            <li><a href="https://api.whatsapp.com/send?text=<?= urlencode($news['title'] . ' ' . current_url()) ?>"
                                                                    target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Sections -->
                                        <div class="blog__comments mt-5 pt-5 border-top">
                                            <div class="section__header mb-4 d-flex align-items-center gap-3">
                                                <h4 class="fw-bold m-0"><?= $totalComments ?> Komentar</h4>
                                                <div class="flex-grow-1" style="height: 1px; background: linear-gradient(to right, #eee, transparent);"></div>
                                            </div>
                                            <div class="blog__comments-details">
                                                <ul class="list-unstyled">
                                                    <?php if(!empty($comments)): ?>
                                                        <?php foreach($comments as $komen): ?>
                                                            <li class="mb-4 pb-4 border-bottom d-flex align-items-start">
                                                                <div class="blog__comments-thumb flex-shrink-0">
                                                                    <img src="<?= base_url('public/assets/images/blog/author/none.jpg') ?>" alt="author" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover; border: 3px solid #fff;">
                                                                </div>
                                                                <div class="blog__comments-content flex-grow-1 ms-3">
                                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                                        <h6 class="m-0 fw-bold text-dark" style="font-size: 15px;"><?= esc($komen['nama_komen']) ?></h6>
                                                                        <span class="small text-muted" style="font-size: 11px;"><i class="far fa-clock me-1 text-warning"></i> <?= date('d M Y, H:i', strtotime($komen['tanggal_komen'])) ?></span>
                                                                    </div>
                                                                    <p class="mb-0 text-muted" style="font-size: 0.9rem; line-height: 1.6;"><?= esc($komen['isi_komen']) ?></p>
                                                                    
                                                                    <?php if(!empty($komen['balas_komen'])): ?>
                                                                        <div class="blog__comments-reply mt-3 p-3 rounded-3 shadow-sm" style="background: #fdfdfd; border: 1px solid #f1f1f1;">
                                                                            <div class="d-flex align-items-center mb-2">
                                                                                <div class="flex-shrink-0">
                                                                                    <img src="<?= base_url('public/assets/images/blog/author/admin.png') ?>" alt="admin" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <h6 class="m-0 fw-bold" style="font-size: 13px;">Admin <span class="badge bg-warning text-dark ms-1 px-2 py-1 rounded-pill" style="font-size: 9px; text-transform: uppercase;">Official</span></h6>
                                                                                    <span class="small text-muted" style="font-size: 10px;"><?= date('d M Y, H:i', strtotime($komen['tgl_balas'])) ?></span>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-0 text-muted" style="font-size: 0.85rem; font-style: italic; line-height: 1.5;"><?= esc($komen['balas_komen']) ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <li class="text-center py-5 border-dashed rounded-3">
                                                            <div class="mb-3 text-muted opacity-25">
                                                                <i class="far fa-comments fa-3x"></i>
                                                            </div>
                                                            <h6 class="text-muted fw-bold">Belum ada komentar.</h6>
                                                            <p class="text-muted small mb-0">Jadilah yang pertama untuk memberikan komentar!</p>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="blog__respond mt-5 pt-5 border-top">
                                            <div class="section__header mb-4">
                                                <h4 class="fw-bold text-dark">Tinggalkan Komentar</h4>
                                                <p class="text-muted small m-0">Alamat email Anda tidak akan dipublikasikan.</p>
                                            </div>
                                            <div class="blog__respond-details">
                                                <form id="formKomentar" class="row g-3">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="berita_id" value="<?= $news['id'] ?>">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold text-dark small text-uppercase" style="font-size: 11px;">Nama Lengkap *</label>
                                                        <input name="nama" type="text" class="form-control bg-light border-0 py-3" style="font-size: 14px;" placeholder="Masukkan nama Anda">
                                                        <div class="invalid-feedback errorNama"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold text-dark small text-uppercase" style="font-size: 11px;">Alamat Email *</label>
                                                        <input name="email" type="email" class="form-control bg-light border-0 py-3" style="font-size: 14px;" placeholder="nama@domain.com">
                                                        <div class="invalid-feedback errorEmail"></div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold text-dark small text-uppercase" style="font-size: 11px;">Komentar / Pesan *</label>
                                                        <textarea name="isi" rows="5" class="form-control bg-light border-0 py-3" style="font-size: 14px; resize: none;" placeholder="Tuliskan komentar atau pertanyaan Anda di sini..."></textarea>
                                                        <div class="invalid-feedback errorIsi"></div>
                                                    </div>
                                                    <div class="col-12 mt-3 text-end">
                                                        <button type="submit" class="default-btn btnSimpanKomen px-5 py-2"><span>Kirim <i class="fas fa-paper-plane ms-2"></i></span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__nav d-flex justify-content-between mt-4">
                                <a href="<?= base_url('news') ?>" class="default-btn"><span><i class="fas fa-long-arrow-alt-left me-2"></i> Kembali ke List Berita</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="sidebar">
                        <div class="sidebar__search">
                            <div class="section__header">
                                <h2>Search Now</h2>
                            </div>
                            <div class="section__wrapper">
                                <form action="<?= base_url('news') ?>" method="get">
                                    <input type="text" name="q" placeholder="Search news...">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar__tab">
                            <div class="section__header">
                                <h2>Post News</h2>
                            </div>
                            <div class="section__wrapper">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="post-tab" data-bs-toggle="tab"
                                            data-bs-target="#post" type="button" role="tab" aria-controls="post"
                                            aria-selected="true">Popular Post</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="post" role="tabpanel"
                                        aria-labelledby="post-tab">
                                        <div class="footer__post">
                                            <div class="section__wrapper">
                                                <?php if (!empty($popularNews)): ?>
                                                    <?php foreach ($popularNews as $item): ?>
                                                        <div class="footer__post-item mb-3 pb-3 border-bottom">
                                                            <div class="footer__post-inner d-flex align-items-start gap-3">
                                                                <div class="footer__post-thumb flex-shrink-0"
                                                                    style="width: 50px; height: 60px; overflow: hidden; border-radius: 10px;">
                                                                    <a href="<?= base_url('news/' . $item['slug']) ?>">
                                                                        <img src="<?= image_url($item['featured_image'], 'public/img/informasi/berita/', 'public/assets/images/footer/post/01.jpg') ?>"
                                                                            alt="news" class="w-100 h-100 object-fit-cover">
                                                                    </a>
                                                                </div>
                                                                <div class="footer__post-content">
                                                                    <a href="<?= base_url('news/' . $item['slug']) ?>">
                                                                        <h6 class="text-dark fw-bold mb-1"
                                                                            style="font-size: 14px; line-height: 1.4;">
                                                                            <?= esc($item['title']) ?>
                                                                        </h6>
                                                                    </a>
                                                                    <p class="small text-muted mb-0"><i
                                                                            class="far fa-calendar-alt me-1"></i>
                                                                        <?= date('d M, Y', strtotime($item['published_at'])) ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar__catagory">
                            <div class="section__header">
                                <h2>Categories</h2>
                            </div>
                            <div class="section__wrapper">
                                <ul>
                                    <?php foreach ($categories as $key => $label): ?>
                                        <li>
                                            <a href="<?= base_url('news/category/' . $key) ?>"
                                                class="<?= (isset($news['category']) && $news['category'] === $key) ? 'active text-primary fw-bold' : '' ?>">
                                                <i class="fas fa-chevron-right"></i><?= esc($label) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#formKomentar').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('berita/simpanKomentar') ?>",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpanKomen').attr('disabled', 'disabled');
                    $('.btnSimpanKomen').html('<span>Mengirim... <i class="fas fa-spinner fa-spin ms-2"></i></span>');
                },
                complete: function() {
                    $('.btnSimpanKomen').removeAttr('disabled');
                    $('.btnSimpanKomen').html('<span>Kirim <i class="fas fa-paper-plane ms-2"></i></span>');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('input[name="nama"]').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('input[name="nama"]').removeClass('is-invalid').addClass('is-valid');
                            $('.errorNama').html('');
                        }

                        if (response.error.email) {
                            $('input[name="email"]').addClass('is-invalid');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('input[name="email"]').removeClass('is-invalid').addClass('is-valid');
                            $('.errorEmail').html('');
                        }

                        if (response.error.isi) {
                            $('textarea[name="isi"]').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('textarea[name="isi"]').removeClass('is-invalid').addClass('is-valid');
                            $('.errorIsi').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Terima Kasih!',
                            text: response.sukses,
                            confirmButtonColor: '#ffc107',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.error(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>

<style>
    .article-body {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #444;
    }

    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        margin: 25px 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .article-body h2, .article-body h3 {
        color: #222;
        margin-top: 35px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .article-body blockquote {
        background: #f8fbff;
        border-left: 5px solid var(--primary-yellow, #ffc107);
        padding: 40px;
        font-style: italic;
        margin: 40px 0;
        border-radius: 0 20px 20px 0;
        position: relative;
    }

    .article-body blockquote::before {
        content: '\f10d';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 20px;
        opacity: 0.1;
        color: var(--primary-yellow);
    }

    .sidebar .footer__post-content h6 {
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sidebar .footer__post-content h6:hover {
        color: var(--primary-yellow, #ffc107) !important;
    }

    .sidebar__catagory ul li a.active {
        color: var(--primary-yellow) !important;
        background: rgba(255, 193, 7, 0.05);
        padding-left: 20px;
        border-left: 3px solid var(--primary-yellow);
    }

    /* Comment Section Styles */
    .blog__comments-details li {
        transition: all 0.3s ease;
        border-radius: 12px;
        padding: 15px;
    }

    .blog__comments-details li:hover {
        background: rgba(255,193,7, 0.02);
    }

    .blog__comments-thumb img {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08) !important;
    }

    .blog__comments-details li:hover .blog__comments-thumb img {
        transform: rotate(5deg) scale(1.1);
        border-color: var(--primary-yellow) !important;
    }

    .blog__comments-content h6 {
        color: #222;
        letter-spacing: -0.2px;
    }

    .blog__comments-reply {
        transition: all 0.3s ease;
    }

    .blog__comments-reply:hover {
        transform: translateX(10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
    }

    .blog__respond .form-control {
        transition: all 0.3s ease;
        border: 1px solid transparent !important;
    }

    .blog__respond .form-control:focus {
        background: #fff !important;
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.08) !important;
        border-color: rgba(255, 193, 7, 0.4) !important;
        transform: translateY(-2px);
    }

    .btnSimpanKomen {
        border: none;
        background: var(--primary-yellow, #ffc107);
        color: #000;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 10px 20px rgba(255, 193, 7, 0.15);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btnSimpanKomen:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.3);
        background: #000;
        color: var(--primary-yellow);
    }

    .invalid-feedback {
        font-size: 11px;
        margin-top: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #dc3545;
        display: none;
    }

    .is-invalid + .invalid-feedback {
        display: block;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .border-dashed {
        border-style: dashed !important;
        border-width: 2px !important;
        background: #fdfdfd !important;
        color: #aaa;
    }

    @media (max-width: 768px) {
        .blog__comments-thumb {
            width: 45px;
            height: 45px;
        }
        .blog__comments-content {
            margin-left: 10px !important;
        }
    }
</style>

<?= $this->endSection() ?>