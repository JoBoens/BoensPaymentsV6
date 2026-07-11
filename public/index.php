<?php
declare(strict_types=1);

$config = require __DIR__ . '/../config/app.php';

?>
<!DOCTYPE html>

<html lang="nl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= $config['app_name']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-body">

<h1><?= $config['app_name']; ?></h1>

<p>Versie <?= $config['version']; ?></p>

<p class="text-success">

Foundation gestart.

</p>

</div>

</div>

</div>

</body>

</html>