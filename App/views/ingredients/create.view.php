<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Dodaj novi sastojak']);


    ?>



    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dodaj novi sastojak</h5>
                        <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>


                        <!-- General Form Elements -->
                        <form method="POST" action="/ingredients">
                            <div class="row mb-3">
                                <label for="name" class="col-form-label">Naziv sastojka</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-form-label">Opis sastojka</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="description"></textarea>
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