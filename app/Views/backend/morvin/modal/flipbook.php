<!DOCTYPE html>
<html>

<head>

    <meta name="description" content="<?= esc($konfigurasi['deskripsi']) ?>">
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi['icon'])) ?>">
    <title><?= esc($title) ?></title>

    <script src="<?= base_url('/public/deploy/js/jquery-3.7.1.min.js') ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url('/public/deploy/css/flipbook.style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/public/deploy/css/font-awesome.css') ?>">

    <script src="<?= base_url('/public/deploy/js/flipbook.min.js') ?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#container").flipBook({
                pdfUrl: "<?= base_url('public/deploy/pdf/'  . esc($fileebok)) ?>",
                // responsiveView: true
            });

        })
    </script>

</head>

<body>
    <div id="container">
        <!-- <p>Jdl</p> -->
        <!-- <p>Click on a book cover to start reading.</p> -->
        <!-- <img src="img/> -->
    </div>

</body>

</html>