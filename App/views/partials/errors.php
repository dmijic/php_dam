<?php if (isset($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

<?php endif; ?>