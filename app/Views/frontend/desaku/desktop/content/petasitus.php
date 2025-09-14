<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/template-frontend') ?>
<?= $this->extend('frontend/' . esc($folder) . '/desktop' . '/v_menu') ?>
<?= $this->section('content');
$db = \Config\Database::connect();

?>


<section class="container mt-lg-0 mt-0 pb-1">

    <div class="row">
        <div class="col">
            <h4 class="f-20 montserrat-700 text-light-blue"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</section>

<section class="container pb-0">
    <div class="card p-3">
        <div class="row article-container pb-5">

            <div class="col-md-12 px-md-5">
                <div class="article-detail mb-0">

                    <h1 class="text-blue montserrat-700 f-30 text-center">Peta Situs </h1>
                    <hr>

                    <div class=" container-grid projects-wrapper">
                        <!-- isi -->
                        <?php foreach ($mainmenu as $utama) {
                            $menu_id = $utama['menu_id'];
                        ?>
                            <div class="list-group mt-1">
                                <?php
                                if ($utama['parent'] == 'N') {
                                    if ($utama['linkexternal'] == 'N') { ?>
                                        <li class="list-group-item list-group-item-action p-2"><a target="<?= $utama['target'] ?>" href="<?= base_url(esc($utama['menu_link'])) ?>">
                                                <i class="<?= esc($utama['icon']) ?>"></i> <?= esc($utama['nama_menu']) ?> </a></li>
                                    <?php } else { ?>
                                        <li class="list-group-item list-group-item-action p-2"><a target="<?= $utama['target'] ?>" href="<?= esc($utama['menu_link']) ?>"> <i class="<?= esc($utama['icon']) ?>"></i> <?= esc($utama['nama_menu']) ?> </a></li>
                                    <?php  }
                                }
                                $set = $db->table('submenu')
                                    ->where('menu_id', $menu_id)
                                    ->where('stssubmenu', 1)
                                    ->orderBy('urutansm', 'ASC')->get()->getResultArray();
                                if ($utama['parent'] == 'Y') { ?>
                                    <li class="list-group-item list-group-item-action p-1">
                                        <a><i class="<?= esc($utama['icon']) ?>"></i><?= esc($utama['nama_menu']) ?> <i class="fas fa-caret-down"></i></a>
                                        <ul>
                                            <?php foreach ($set as $submenu) {
                                                if ($submenu['linkexternalsm'] == 'N') { ?>
                                                    <li class="list-group-item list-group-item-action p-2"><a target="<?= $submenu['targetsm'] ?>" href="<?= base_url(esc($submenu['link_submenu'])) ?>"><i class="<?= esc($submenu['iconsm']) ?>"></i> <?= esc($submenu['nama_submenu']) ?> </a></li>
                                                <?php } else { ?>
                                                    <li class="list-group-item list-group-item-action p-2"><a target="<?= $submenu['targetsm'] ?>" href="<?= esc($submenu['link_submenu']) ?>"><i class="<?= esc($submenu['iconsm']) ?>"></i> <?= esc($submenu['nama_submenu']) ?> </a></li>
                                                <?php  } ?>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php $settop = $db->table('menu')
                            ->where('posisi', '1')
                            ->where('stsmenu', 1)
                            ->orderBy('urutan', 'ASC')->get()->getResultArray(); ?>
                        <!-- <?php foreach ($settop as $topmenu) {
                                    if ($topmenu['linkexternal'] == 'N') { ?>
                            <div class="list-group mt-1">
                                <li class="list-group-item list-group-item-action p-2"><a target="<?= $topmenu['target'] ?>" href="<?= base_url($topmenu['menu_link']) ?>"><i class="<?= esc($topmenu['icon']) ?>"></i> <?= esc($topmenu['nama_menu']) ?><small class="text-warning"> (Top Menu) </small> </a></li>
                            <?php } else { ?>
                                <li class="list-group-item list-group-item-action p-2"><a target="<?= $topmenu['target'] ?>" href="<?= $topmenu['menu_link'] ?>"><i class="<?= esc($topmenu['icon']) ?>"></i> <?= esc($topmenu['nama_menu']) ?><small class="text-warning"> (Top Menu) </small></a></li>
                            <?php  } ?>
                            </div>
                        <?php } ?> -->

                        <?php $setfot = $db->table('menu')
                            ->where('posisi', '2')
                            ->where('stsmenu', 1)
                            ->orderBy('urutan', 'ASC')->get()->getResultArray(); ?>
                        <?php foreach ($setfot as $fm) {
                            if ($fm['linkexternal'] == 'N') { ?>
                                <div class="list-group mt-1">
                                    <li class="list-group-item list-group-item-action p-2"><a target="<?= $fm['target'] ?>" href="<?= base_url(esc($fm['menu_link'])) ?>"><i class="<?= esc($fm['icon']) ?>"></i> <?= esc($fm['nama_menu']) ?> <small class="text-warning"> (Bottom Menu) </small> </a></li>

                                <?php } else { ?>
                                    <li class="list-group-item list-group-item-action p-2"><a target="<?= $fm['target'] ?>" href="<?= esc($fm['menu_link']) ?>"><i class="<?= esc($fm['icon']) ?>"></i> <?= esc($fm['nama_menu']) ?> <small class="text-warning"> (Bottom Menu) </small> </a></li>
                                <?php  } ?>

                                </div>
                            <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>