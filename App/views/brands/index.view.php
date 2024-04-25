<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar', ['brands' => $brands]);

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
                            <button type="button" class="btn btn-primary">Pregled</button>
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