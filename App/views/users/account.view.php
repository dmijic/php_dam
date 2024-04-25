<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar', ['brands' => $brands]);

?>

<main id="main" class="main">

    <?php

    loadPartial('pagetitle');

    ?>

    <?php

    loadPartial('my-account');

    ?>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>