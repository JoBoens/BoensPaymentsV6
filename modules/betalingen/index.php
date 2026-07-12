<?php
declare(strict_types=1);

$config = require __DIR__ . '/../../config/app.php';

$date = new DateTime('now', new DateTimeZone($config['timezone']));

ob_start();
?>

<div class="page-header">

    <div>
        <h1>Betalingen</h1>
        <p>Beheer al je betalingen.</p>
    </div>

    <div>
        <a href="create.php" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Nieuwe betaling
        </a>
    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Zoeken..."
                >
            </div>

            <div class="col-md-2">
                <select class="form-select">
                    <option>Alle statussen</option>
                </select>
            </div>

            <div class="col-md-2">
                <select class="form-select">
                    <option>Alle jaren</option>
                </select>
            </div>

            <div class="col-md-4">
                <select class="form-select">
                    <option>Alle firma's</option>
                </select>
            </div>

        </div>

        <table class="table table-hover align-middle">

            <thead>

            <tr>

                <th>Nr</th>

                <th>Firma</th>

                <th>Omschrijving</th>

                <th>Factuur</th>

                <th>Vervaldag</th>

                <th class="text-end">Bedrag</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            <tr>

                <td colspan="7" class="text-center text-muted py-5">

                    Nog geen betalingen aanwezig.

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

<?php

$content = ob_get_clean();

require __DIR__ . '/../../includes/layout.php';