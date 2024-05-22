<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php
    loadPartial('pagetitle', ['title' => 'Rezultati pretraživanja za pojam: ' . $searchTerm]);
    ?>


    <?php if (!empty($products)) : ?>

        <section class="section">
            <div class="row align-items-top">
                <hr>
                <h4>Proizvodi</h4>

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

    <?php endif; ?>


    <?php if (!empty($brands)) : ?>

        <section class="section">
            <div class="row align-items-top">
                <hr>
                <h4>Brendovi</h4>

                <?php
                foreach ($brands as $brand) :
                ?>

                    <div class="col-lg-3">
                        <!-- Card with an image on top -->

                        <div class="card">
                            <a href="/brand/<?= $brand->id ?>"><img src="<?= $brand->brand_logo_url ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title"><a href="/brand/<?= $brand->id ?>"><?= $brand->brand_name ?></a></h5>
                                <p class="card-text"><?= showExcerpt($brand->brand_description, 60) ?></p>
                                <a href="/brand/<?= $brand->id ?>" class="btn btn-primary">Pregled</a>
                            </div>
                        </div>
                        <!-- End Card with an image on top -->
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

    <?php endif; ?>


    <?php if (!empty($ingredients)) : ?>

        <section class="section">
            <div class="row align-items-top">
                <hr>
                <h4>Aktivni sastojci</h4>

                <?php
                foreach ($ingredients as $ingredient) :
                ?>

                    <div class="col-lg-3">
                        <!-- Card with an image on top -->

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/ingredient/<?= $ingredient->id ?>"><?= $ingredient->name ?></a></h5>
                                <p class="card-text"><?= showExcerpt($ingredient->description, 60) ?></p>
                                <a href="/ingredient/<?= $ingredient->id ?>" class="btn btn-primary">Pregled</a>
                            </div>
                        </div>
                        <!-- End Card with an image on top -->
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

    <?php endif; ?>


</main><!-- End #main -->

<?php

loadPartial('footer');

?>