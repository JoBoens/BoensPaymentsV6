<?php
declare(strict_types=1);

$config = require __DIR__ . '/../config/app.php';

$date = new DateTime('now', new DateTimeZone($config['timezone']));

ob_start();
?>

<div class="page-header">

    <div>
        <h1>Dashboard</h1>
        <p>Welkom terug, Jo.</p>
    </div>

    <div class="today">
        <?= $date->format('d/m/Y'); ?>
    </div>

</div>

<div class="cards">

    <div class="card dashboard-card">
        <h6>Openstaand</h6>
        <h2>€ 0,00</h2>
    </div>

    <div class="card dashboard-card">
        <h6>Deze maand</h6>
        <h2>€ 0,00</h2>
    </div>

    <div class="card dashboard-card">
        <h6>Dit jaar</h6>
        <h2>€ 0,00</h2>
    </div>

    <div class="card dashboard-card">
        <h6>Achterstallig</h6>
        <h2>0</h2>
    </div>

</div>

<div class="card mt-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">

            <h4>Recente betalingen</h4>

            <button class="btn btn-primary">

                <i class="fa fa-plus"></i>

                Nieuwe betaling

            </button>

        </div>

        <table class="table mt-3">

            <thead>

            <tr>

                <th>Nr</th>

                <th>Firma</th>

                <th>Omschrijving</th>

                <th>Bedrag</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            <tr>

                <td colspan="5" class="text-center text-muted">

                    Nog geen betalingen.

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

<?php

$content = ob_get_clean();

require '../includes/layout.php';