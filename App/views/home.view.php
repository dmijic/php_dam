<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('sidebar') ?>

<main id="main" class="main">

    <?= loadPartial('pagetitle', ['title' => 'Početna']); ?>
    <?= loadPartial('dashboard', ['products' => $products]) ?>

</main><!-- End #main -->

<?= loadPartial('footer') ?>