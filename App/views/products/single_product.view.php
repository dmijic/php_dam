<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => $product->name]);

    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= $product->product_image_url ?>" alt="Profile" class="rounded-circle">

                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Informacije</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" role="tab" tabindex="-1">Aktivni sastojci</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Uredi</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" role="tab" tabindex="-1">Obriši proizvod</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                                <div class="row mt-3">
                                    <h5><a href="/brand/<?= $brand->id ?>"><?= $brand->brand_name ?></a></h5>
                                    <h3><?= $product->name ?></h3>
                                </div>

                                <h5 class="card-title">Opis</h5>
                                <p class="small fst-italic"><?= $product->product_description ?></p>

                                <h5 class="card-title">Detalji</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Sadržaj</div>
                                    <div class="col-lg-9 col-md-8"><?= $product->quantity ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Sastav</div>
                                    <div class="col-lg-9 col-md-8"><?= $product->active_ingredients ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Način upotrebe</div>
                                    <div class="col-lg-9 col-md-8"><?= $product->suggested_use ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Napomene</div>
                                    <div class="col-lg-9 col-md-8"><?= $product->remark ?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                <div class="row mb-3">

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

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                                <?php if (isset($errors)) : ?>
                                    <?php foreach ($errors as $error) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $error ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endforeach; ?>

                                <?php endif; ?>

                                <!-- Profile Edit Form -->
                                <form action="/product/<?= $product->id ?>" method="POST">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="row mb-3">
                                        <label for="product_image_url" class="col-md-4 col-lg-3 col-form-label">Fotografija proizvoda</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= $product->product_image_url ?>" alt="Profile">
                                            <div class="pt-2">
                                                <input class="form-control" type="file" id="formFile" name="product_image_url" value="<?= $product->product_image_url ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Naziv proizvoda</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name" value="<?= $product->name ?? '' ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="product_description" class="col-md-4 col-lg-3 col-form-label">Opis</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="product_description" class="form-control" id="product_description" style="height: 100px"><?= $product->product_description ?? '' ?></textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="brand_id" class="col-md-4 col-lg-3 col-form-label">Brend</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="brand_id" aria-label="Default select example">
                                                <option value="">Odaberite brend proizvoda</option>
                                                <?php foreach ($brands as $brand) : ?>
                                                    <option value="<?= $brand->id ?>"><?= $brand->brand_name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <label for="quantity" class="col-md-4 col-lg-3 col-form-label">Količina</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="quantity" type="text" class="form-control" value="<?= $product->quantity ?? '' ?>">
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <label for="active_ingredients" class="col-md-4 col-lg-3 col-form-label">Aktivni sastojci</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 100px" name="active_ingredients"><?= $product->active_ingredients ?? '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="suggested_use" class="col-md-4 col-lg-3 col-form-label">Preporučena upotreba</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 100px" name="suggested_use"><?= $product->suggested_use ?? '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="remark" class="col-md-4 col-lg-3 col-form-label">Napomene</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 100px" name="remark"><?= $product->remark ?? '' ?></textarea>
                                        </div>
                                    </div>



                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Spremi izmjene</button>
                                    </div>
                                </form>

                                <!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                    Obriši proizvod
                                </button>

                            </div>
                            <!-- Delete confirmation modal -->

                            <div class="modal fade" id="deleteProductModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Jeste li sigurni?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Obrisat ćete proizvod <?= $product->name ?>.
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Delete product Form -->
                                            <form method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Odustani</button>
                                                    <button type="submit" class="btn btn-danger">Obriši proizvod</button>
                                                </div>
                                            </form><!-- End Delete product Form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Delete confirmation modal -->

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>


</main><!-- End #main -->

<?php

loadPartial('footer');

?>