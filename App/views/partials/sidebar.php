<?php

use Framework\Database;

$config = require basePath('config/db.php');
$db = new Database($config);
$brands = $db->query('SELECT * FROM brands')->fetchAll();

?>




<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/">
                <i class="bi bi-grid"></i>
                <span>Početna</span>
            </a>
        </li>


        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-folder2-open"></i><span>Brendovi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/brands">
                        <i class="bi bi-circle"></i><span>Svi brendovi</span>
                    </a>
                </li>
            </ul>
        </li> -->

        <!-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#brands-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection"></i><span>Proizvodi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="brands-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/products">
                        <i class="bi bi-circle"></i><span>Svi proizvodi</span>
                    </a>
                </li>
            </ul>
        </li> -->




        <!-- Proizvodi -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#brand-products-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-diagram-3"></i><span>Proizvodi po brendovima</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="brand-products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="/products/<?= slugify($brand->id) ?>">
                            <img src="<?= $brand->brand_logo_url ?>" alt="" style="max-width: 35px; height: auto; margin-right: 15px"><span><?= $brand->brand_name ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </li>

        <!-- Sastojci -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ingredients-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-book"></i><span>Sastojci</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ingredients-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/ingredients">
                        <i class="bi bi-circle"></i><span>Sastojci po abecedi</span>
                    </a>
                </li>
                <li>
                    <a href="/claims">
                        <i class="bi bi-circle"></i><span>Odobrene tvrdnje</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Uređivanje -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#edit-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-pencil-square"></i><span>Uređivanje</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="edit-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/brands/create">
                        <i class="bi bi-circle"></i><span>Dodaj novi brend</span>
                    </a>
                </li>

                <li>
                    <a href="/products/create">
                        <i class="bi bi-circle"></i><span>Dodaj novi proizvod</span>
                    </a>
                </li>
                <li>
                    <a href="/ingredients/create">
                        <i class="bi bi-circle"></i><span>Dodaj novi sastojak</span>
                    </a>
                </li>
                <li>
                    <a href="/claims/create">
                        <i class="bi bi-circle"></i><span>Dodaj novu tvrdnju</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#social-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-phone"></i><span>Društvene mreže</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="social-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="/social_media/by_brand?=<?= slugify($brand->brand_name) ?>">
                            <img src="<?= $brand->brand_logo_url ?>" alt="" style="max-width: 35px; height: auto; margin-right: 15px"><span><?= $brand->brand_name ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#campaigns-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-zip"></i><span>Materijali za kampanje</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="campaigns-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <?php foreach ($brands as $brand) : ?>
                    <li>
                        <a href="/campaigns/<?= slugify($brand->brand_name) ?>">
                            <img src="<?= $brand->brand_logo_url ?>" alt="" style="max-width: 35px; height: auto; margin-right: 15px"><span><?= $brand->brand_name ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </li><!-- End Forms Nav -->

    </ul>

</aside><!-- End Sidebar-->