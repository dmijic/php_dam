<?php

loadPartial('head');
loadPartial('navbar');
loadPartial('sidebar');

?>

<main id="main" class="main">

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-6">

                <!-- Default Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Query</h5>
                        <?php inspectAndDie($data) ?>
                        <?= $data['query'] ?>
                    </div>
                </div><!-- End Default Card -->

            </div>

            <div class="col-lg-6">

                <!-- Default Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Response</h5>
                        <?= $data['response'] ?>
                    </div>
                </div><!-- End Default Card -->

            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php

loadPartial('footer');

?>