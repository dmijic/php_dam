<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Dodaj novu tvrdnju']);


    ?>



    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dodaj novu odobrenu tvrdnju</h5>

                        <!-- General Form Elements -->
                        <form method="POST" action="/claims">
                            <div class="row mb-3">
                                <label class="col-form-label" for="ingredient_id">Sastojak na koji se odnosi odobrena tvrdnja</label>
                                <div class="col-sm-12">
                                    <select class="form-select" multiple="" aria-label="multiple select example" name="ingredient_id">
                                        <option selected="">Odaberite sastojak</option>
                                        <?php foreach ($ingredients as $ingredient) : ?>
                                            <option value="<?= $ingredient->id ?>"><?= $ingredient->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content" class="col-form-label">Tvrdnja</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="content"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Spremi</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>




</main><!-- End #main -->

<?php

loadPartial('footer');

?>