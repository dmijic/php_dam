<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Dodaj novi brend']);

    ?>


    <?php if (isset($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dodaj novi brend</h5>

                        <!-- General Form Elements -->
                        <form method="POST" action="/brands">
                            <div class="row mb-3">
                                <label for="brand_name" class="col-form-label">Naziv brenda</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="brand_name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="brand_logo_url" class="col-form-label">Logo brenda</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="formFile" name="brand_logo_url">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="brand_description" class="col-form-label">Kratki opis brenda</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="brand_description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="brand_web_url" class="col-form-label">Web stranica</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="brand_web_url">
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