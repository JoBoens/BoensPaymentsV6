<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : views/layouts/main.php
 * Versie  : 6.2.0
 * Doel    : Hoofdlayout van de applicatie
 * ------------------------------------------------------------
 */

declare(strict_types=1);

$config = require dirname(__DIR__, 2) . '/config/app.php';

$title = $title ?? $config['app_name'];
?>
<!DOCTYPE html>
<html lang="nl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title><?= e($title) ?></title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Eigen CSS -->

    <link
        rel="stylesheet"
        href="<?= App\Core\App::baseUrl(); ?>/assets/css/style.css">

</head>

<body>

<div class="wrapper">

    <?php require dirname(__DIR__,2).'/includes/sidebar.php'; ?>

    <div class="main-content">

        <?php require dirname(__DIR__,2).'/includes/header.php'; ?>

        <main class="content p-4">

            <?= $content ?>

        </main>

    </div>

</div>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

<script
src="<?= App\Core\App::baseUrl(); ?>/assets/js/app.js">
</script>

</body>

</html>