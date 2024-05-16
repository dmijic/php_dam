<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => 'Dodaj novi proizvod']);


    ?>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dodaj novi proizvod</h5>
                        <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>


                        <!-- General Form Elements -->
                        <form method="POST" action="/products" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="name" class="col-form-label">Naziv proizvoda</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" value="<?= $product['name'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="product_description" class="col-form-label">Opis proizvoda</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="product_description" style="height: 100px"><?= $product['product_description'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="product_image_url" class="col-form-label">Slika proizvoda</label>
                                <div class="col-sm-12">
                                    <input class="form-control" type="file" id="formFile" name="product_image_url">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="brand_id" class="col-sm-2 col-form-label">Brend</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="brand_id" aria-label="Default select example">
                                        <option>Odaberite brend proizvoda</option>
                                        <?php foreach ($brands as $brand) : ?>
                                            <option value="<?= $brand->id ?>"><?= $brand->brand_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="quantity" class="col-form-label">Količina</label>
                                <div class="col-sm-12">
                                    <input type="text" name="quantity" class="form-control" value="<?= $product['quantity'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="active_ingredients" class="col-form-label">Aktivni sastojci</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="active_ingredients"><?= $product['active_ingredients'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="suggested_use" class="col-form-label">Preporučena upotreba</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="suggested_use"><?= $product['suggested_use'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="remark" class="col-form-label">Napomene</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" style="height: 100px" name="remark"><?= $product['remark'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Spremi proizvod</button>
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