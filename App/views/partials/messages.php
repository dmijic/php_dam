<div class="alert-container" style="position: fixed;
    top: 75px;
    right: 20px;
    z-index: 1000;
    width: 500px;">

    <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <?= $_SESSION['success_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <?= $_SESSION['error_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['info_message'])) : ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <?= $_SESSION['info_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['info_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['warning_message'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <?= $_SESSION['warning_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['warning_message']); ?>
    <?php endif; ?>

</div>