<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Svi proizvodi']);

    ?>

    <section class="section">
        <div class="row align-items-top">

            <?php
            foreach ($products as $product) :
            ?>

                <div class="col-lg-3">
                    <!-- Card with an image on top -->

                    <div class="card">
                        <a href="/product/<?= $product->id ?>"><img src="<?= $product->product_image_url ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="/product/<?= $product->id ?>"><?= $product->name ?></a></h5>
                            <p class="card-text"><?= showExcerpt($product->product_description, 60) ?></p>
                            <a href="/product/<?= $product->id ?>" class="btn btn-primary">Pregled</a>
                        </div>
                    </div>
                    <!-- End Card with an image on top -->
                </div>

            <?php endforeach; ?>

        </div>
    </section>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>