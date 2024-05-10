<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Brendovi']);

    ?>

    <section class="section">
        <div class="row align-items-top">

            <?php
            foreach ($brands as $brand) :
            ?>


                <div class="col-lg-4">

                    <!-- Card with an image on top -->
                    <div class="card">
                        <div class="image-container" style="min-height: 200px; display: flex; align-items: center; justify-content:center;">
                            <img src="<?= $brand->brand_logo_url ?>" class="card-img-top" alt="..." style="max-width: 160px; height: auto;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?= $brand->brand_name ?></h5>
                            <p class="card-text"><?= showExcerpt($brand->brand_description, 60) ?></p>
                            <a href="/brand/<?= $brand->id ?>" class="btn btn-primary">Pregled</a>
                        </div>
                    </div><!-- End Card with an image on top -->

                </div>
            <?php endforeach; ?>

        </div>
    </section>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>