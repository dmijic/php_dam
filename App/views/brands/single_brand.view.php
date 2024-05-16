<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle', ['title' => $brand->brand_name]);

    ?>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= $brand->brand_logo_url ?>" alt="Profile" class="rounded-circle">

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
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" aria-selected="false" role="tab" tabindex="-1">Proizvodi</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Uredi</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" role="tab" tabindex="-1">Obriši brend</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                                <div class="row mt-3">
                                    <h2><?= $brand->brand_name ?></h2>
                                    <a href="<?= $brand->brand_web_url ?>">Posjeti web stranicu</a>
                                </div>
                                <h5 class="card-title">Opis</h5>
                                <p class="small fst-italic"><?= $brand->brand_description ?></p>

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">

                                <div class="row mb-3">



                                    <table class="table table-borderless">
                                        <tbody>
                                            <?php foreach ($products as $product) : ?>
                                                <tr style="border-bottom: 1px solid #ddd; min-height: 60px;">
                                                    <th scope="row"><a href="/product/<?= $product->id ?>"><img src="<?= $product->product_image_url ?>" alt="" style="max-width: 60px;"></a></th>
                                                    <td style="vertical-align: middle;"><a href="/product/<?= $product->id ?>" class="text-primary"><?= $product->name ?></a></td>
                                                    <td style="vertical-align: middle;">
                                                        <a href="/product/<?= $product->id ?>" class="btn btn-outline-primary btn-sm">Pogledaj proizvod</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>



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

                                <!-- General Form Elements -->
                                <form method="POST" action="/brand/<?= $brand->id ?>">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="row mb-3">
                                        <label for="brand_name" class="col-md-4 col-lg-3 col-form-label">Naziv brenda</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" name="brand_name" value="<?= $brand->brand_name ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="brand_logo_url" class="col-md-4 col-lg-3 col-form-label">Logo brenda</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= $brand->brand_logo_url ?>" alt="Profile">
                                            <div class="pt-2">
                                                <input class="form-control" type="file" id="formFile" name="brand_logo_url" value="<?= $brand->brand_logo_url_url ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <label for="brand_description" class="col-md-4 col-lg-3 col-form-label">Kratki opis brenda</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 100px" name="brand_description"><?= $brand->brand_description ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="brand_web_url" class="col-md-4 col-lg-3 col-form-label">Web stranica</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" name="brand_web_url" value="<?= $brand->brand_web_url ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            <button type="submit" class="btn btn-primary">Spremi izmjene</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->








                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBrandModal">
                                    Obriši brend
                                </button>

                            </div>
                            <!-- Delete confirmation modal -->

                            <div class="modal fade" id="deleteBrandModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Jeste li sigurni?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Obrisat ćete brend <?= $brand->brand_name ?>.
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Delete product Form -->
                                            <form method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Odustani</button>
                                                    <button type="submit" class="btn btn-danger">Obriši brend</button>
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