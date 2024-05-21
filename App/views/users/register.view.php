<?php

loadPartial('head');

?>

<main>
    <div class="container">




        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Registrirajte se</h5>
                                    <p class="text-center small">Unesite podatke i stvorite novi korisnički račun.</p>
                                </div>

                                <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

                                <form class="row g-3 needs-validation" novalidate="" method="POST" action="/new-user" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="name" class="form-label">Ime i prezime</label>
                                        <input type="text" name="name" class="form-control" id="name" required="" value="<?= $user['name'] ?? '' ?>">
                                        <div class="invalid-feedback">Molimo upišite ime!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="user_img_url" class="col-form-label">Učitajte fotografiju</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" type="file" id="user_img_url" name="user_img_url">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email adresa</label>
                                        <input type="email" name="email" class="form-control" id="email" required="" value="<?= $user['email'] ?? '' ?>">
                                        <div class="invalid-feedback">Molimo upišite ispravnu email adresu!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="username" class="form-label">Korisničko ime</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="username" required="" value="<?= $user['username'] ?? '' ?>">
                                            <div class="invalid-feedback">Molimo odaberite korisničko ime.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Lozinka</label>
                                        <input type="password" name="password" class="form-control" id="password" required="">
                                        <div class="invalid-feedback">Molimo upišite lozinku.</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="password_confirmation" class="form-label">Ponovite lozinku</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required="">
                                        <div class="invalid-feedback">Molimo upišite lozinku.</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="1" id="acceptTerms" required="">
                                            <label class="form-check-label" for="acceptTerms">Prihvaćam <a href="#">uvjete korištenja</a></label>
                                            <div class="invalid-feedback">Morate prihvatiti prije slanja zahtjeva.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Registrirajte se</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Već ste registrirani? <a href="/login">Ulogirajte se</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main>

<?php

loadPartial('footer-login');

?>