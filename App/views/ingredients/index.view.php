<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar', ['brands' => $brands]);

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Svi sastojci']);

    ?>



    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Default Accordion</h5>

                        <!-- Default Accordion -->
                        <div class="accordion" id="accordionExample">

                            <?php foreach ($ingredients as $ingredient) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $ingredient->id ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $ingredient->id ?>" aria-expanded="false" aria-controls="collapseOne">
                                            <?= $ingredient->name ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $ingredient->id ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $ingredient->id ?>" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                <?php foreach ($claims as $claim) : ?>
                                                    <?php if ($claim->ingredient_id === $ingredient->id) : ?>
                                                        <li class="list-group-item"><?= $claim->content ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?= $ingredient->description ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                        </div><!-- End Default Accordion Example -->

                    </div>
                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>