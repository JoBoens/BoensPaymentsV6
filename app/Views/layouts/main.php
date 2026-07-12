<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Views/layouts/main.php
 * Versie  : 6.7.0
 * Doel    : Hoofdlayout van de applicatie
 * ------------------------------------------------------------
 */

declare(strict_types=1);

use App\Core\App;
use App\Core\View;

$title = $title ?? App::name();
?>
<!DOCTYPE html>

<html lang="nl">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <meta
        name="description"
        content="<?= e(App::name()) ?>">

    <meta
        name="author"
        content="Jo Boens">

    <title><?= e($title) ?></title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        rel="stylesheet">

    <!-- Eigen CSS -->

    <link
        href="<?= App::baseUrl() ?>/assets/css/style.css"
        rel="stylesheet">

</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->

    <?php View::partial('partials/sidebar'); ?>

    <div class="main-content">

        <!-- Header -->

        <?php View::partial('partials/header'); ?>

        <!-- Flash Messages -->

        <?php View::partial('partials/flash'); ?>

        <!-- Pagina -->

        <main class="content p-4">

            <?= $content ?>

        </main>

    </div>

</div>

<!-- Bootstrap -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

<!-- Eigen Javascript -->

<script
    src="<?= App::baseUrl() ?>/assets/js/app.js">
</script>

</body>

</html>