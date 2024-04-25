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

    loadPartial('my-profile');

    ?>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>