<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Views/dashboard/index.php
 * Versie  : 6.3.0
 * Doel    : Dashboard
 * ------------------------------------------------------------
 */

declare(strict_types=1);

$config = require dirname(__DIR__, 3) . '/config/app.php';

$date = new DateTime(
    'now',
    new DateTimeZone($config['timezone'])
);
?>

<div class="page-header mb-4">

    <div>

        <h1 class="mb-1">Dashboard</h1>

        <p class="text-muted mb-0">
            Welkom terug, Jo.
        </p>

    </div>

    <div class="text-end">

        <div class="fw-semibold">

            <?= $date->format('d/m/Y'); ?>

        </div>

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h6 class="text-muted mb-2">
                    Openstaand
                </h6>

                <h3 class="mb-0">

                    € <?= number_format($openstaand, 2, ',', '.'); ?>

                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h6 class="text-muted mb-2">
                    Deze maand
                </h6>

                <h3 class="mb-0">

                    € <?= number_format($dezeMaand, 2, ',', '.'); ?>

                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h6 class="text-muted mb-2">
                    Dit jaar
                </h6>

                <h3 class="mb-0">

                    € <?= number_format($ditJaar, 2, ',', '.'); ?>

                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <h6 class="text-muted mb-2">
                    Achterstallig
                </h6>

                <h3 class="mb-0">

                    <?= $achterstallig ?>

                </h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm mt-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            Recente betalingen

        </h5>

        <a
            href="<?= App\Core\App::url('betalingen/create'); ?>"
            class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>

            Nieuwe betaling

        </a>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                <tr>

                    <th width="120">Nr</th>

                    <th>Omschrijving</th>

                    <th class="text-end" width="150">
                        Bedrag
                    </th>

                    <th width="150">
                        Status
                    </th>

                </tr>

                </thead>

                <tbody>

                <?php if (empty($betalingen)): ?>

                    <tr>

                        <td colspan="4"
                            class="text-center text-muted py-5">

                            Nog geen betalingen aanwezig.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($betalingen as $betaling): ?>

                        <tr>

                            <td>

                                <?= e($betaling['nummer']) ?>

                            </td>

                            <td>

                                <?= e($betaling['omschrijving']) ?>

                            </td>

                            <td class="text-end">

                                € <?= number_format(
                                    (float)$betaling['bedrag'],
                                    2,
                                    ',',
                                    '.'
                                ); ?>

                            </td>

                            <td>

                                <span class="badge bg-secondary">

                                    <?= e($betaling['status']) ?>

                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>