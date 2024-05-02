<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1><?= $status ?></h1>
        <h2><?= $message ?></h2>
    </section>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>