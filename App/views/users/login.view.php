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
                                    <h5 class="card-title text-center pb-0 fs-4">Ulogirajte se u vaš račun</h5>
                                    <p class="text-center small">Upišite korisničko ime i lozinku kako biste se ulogirali</p>
                                </div>
                                <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>
                                <form class="row g-3 needs-validation" novalidate="" method="POST" action="/login">

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Korisničko ime</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required="">
                                            <div class="invalid-feedback">Molimo upišite korisničko ime.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Lozinka</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required="">
                                        <div class="invalid-feedback">Molimo upišite lozinku.</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Zapamti me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Niste registrirani? <a href="/new-user">Registrirajte se</a></p>
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