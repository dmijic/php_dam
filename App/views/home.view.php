<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('sidebar', ['brands' => $brands]) ?>

<main id="main" class="main">

    <?= loadPartial('pagetitle', ['title' => 'Početna']); ?>
    <?= loadPartial('dashboard', ['brands' => $brands, 'products' => $products]) ?>

</main><!-- End #main -->

<?= loadPartial('footer') ?>