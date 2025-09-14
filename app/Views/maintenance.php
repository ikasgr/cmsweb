<!DOCTYPE html>
<html lang="in">
<?php

use App\Models\ModelKonfigurasi;

$this->konfigurasi    = new ModelKonfigurasi();
$konfigurasi          = $this->konfigurasi->vkonfig();
?>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('/public/img/konfigurasi/icon/' . esc($konfigurasi->icon)) ?>">
    <title>Maintenance | <?= esc($konfigurasi->nama) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Neuton|Roboto" rel="stylesheet">
    <style>
        .holder {
            width: 480px;
            text-align: center;
            margin: 0 auto;
            padding-top: 120px;
        }

        .holder h1 {
            font-family: 'loveloblack', sans-serif;
            font-size: 5em;
            color: #2d2d2d;
            text-shadow: 3px 3px 0 #e3e3e3;
            line-height: 27px;
            margin-top: 12px;
            margin-bottom: 10px;
        }

        .holder h1 span.tbl {
            font-family: Dosis, Tahoma, sans-serif;
            font-size: 35px;
            color: #2d2d2d;
            line-height: 1em;
            font-weight: bold;
            letter-spacing: -1px;
            line-height: 1;
            text-shadow: -1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        .holder h1 span {
            font-family: Dosis, Tahoma, sans-serif;
            font-size: 1em;
            color: #3d9df8;
            line-height: 1em;
            font-weight: bold;
            letter-spacing: -1px;
            line-height: 1;
            text-shadow: -1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 18px;
            font-weight: 600;
            color: #13447E;
            font-family: 'Neuton', serif;
        }
    </style>

</head>

<body>
    <div class="holder">
        <img src="<?= base_url('/public/img/konfigurasi/maintenance.png') ?>" width="300px" height="200px" alt="" class="img-fluid mx-auto d-block">
        <!-- <img src="<?= base_url('/public/img/konfigurasi/logo/' . esc($konfigurasi->logo)) ?>" style="width:250px;" /> -->
        <h1><span class="tbl">Situs web sedang dalam Pemeliharaan.</span></h1>
        <p><span class="tbl">Maaf atas ketidaknyamanan ini. <br> Anda dapat menghubungi kami disini <a href="https://wa.me/<?= esc($konfigurasi->no_telp) ?>?text=Halo,..<?= esc($konfigurasi->nama) ?>"><?= esc($konfigurasi->no_telp) ?></a> Terima kasih.</span></p><br>

        <br />
    </div>
</body>

</html>