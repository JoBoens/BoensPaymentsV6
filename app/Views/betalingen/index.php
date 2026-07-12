<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Views/betalingen/index.php
 * Versie  : 6.7.0
 * Doel    : Overzicht betalingen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

use App\Core\App;

$title = $title ?? 'Betalingen';
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="mb-1">
            Betalingen
        </h1>

        <p class="text-muted mb-0">
            Overzicht van alle geregistreerde betalingen.
        </p>

    </div>

    <div>

        <a
            href="<?= App::url('betalingen/create') ?>"
            class="btn btn-primary">

            <i class="fa-solid fa-plus me-2"></i>

            Nieuwe betaling

        </a>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <div class="row g-3 mb-4">

            <div class="col-lg-4">

                <input
                    type="text"
                    id="searchInput"
                    class="form-control"
                    placeholder="Zoeken...">

            </div>

            <div class="col-lg-2">

                <select class="form-select">

                    <option value="">Alle statussen</option>
                    <option value="Open">Open</option>
                    <option value="Betaald">Betaald</option>
                    <option value="Vervallen">Vervallen</option>

                </select>

            </div>

            <div class="col-lg-2">

                <select class="form-select">

                    <option>Alle jaren</option>

                </select>

            </div>

            <div class="col-lg-4">

                <input
                    type="text"
                    class="form-control"
                    placeholder="Firma">

            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                <tr>

                    <th width="90">
                        Nr
                    </th>

                    <th>
                        Firma
                    </th>

                    <th>
                        Omschrijving
                    </th>

                    <th>
                        Factuur
                    </th>

                    <th width="120">
                        Vervaldatum
                    </th>

                    <th width="120" class="text-end">
                        Bedrag
                    </th>

                    <th width="120">
                        Status
                    </th>

                    <th width="130" class="text-center">
                        Acties
                    </th>

                </tr>

                </thead>

                <tbody>

                <?php if (empty($betalingen)): ?>

                    <tr>

                        <td colspan="8" class="text-center py-5 text-muted">

                            <i class="fa-regular fa-folder-open fa-3x mb-3"></i>

                            <br>

                            Er zijn nog geen betalingen aanwezig.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($betalingen as $betaling): ?>

                        <?php

                        $badge = match ($betaling['status']) {

                            'Open'      => 'warning',

                            'Betaald'   => 'success',

                            'Vervallen' => 'danger',

                            default     => 'secondary'

                        };

                        ?>

                        <tr>

                            <td>

                                <?= e($betaling['nummer']) ?>

                            </td>

                            <td>

                                <?= e($betaling['firma'] ?? '-') ?>

                            </td>

                            <td>

                                <?= e($betaling['omschrijving']) ?>

                            </td>

                            <td>

                                <?= e($betaling['factuurnummer']) ?>

                            </td>

                            <td>

                                <?= e($betaling['vervaldatum']) ?>

                            </td>

                            <td class="text-end">

                                € <?= number_format(
                                    (float)$betaling['bedrag'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                            </td>

                            <td>

                                <span class="badge bg-<?= $badge ?>">

                                    <?= e($betaling['status']) ?>

                                </span>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= App::url('betalingen/edit?id=' . $betaling['id']) ?>"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Wijzigen">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <a
                                    href="<?= App::url('betalingen/delete?id=' . $betaling['id']) ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Verwijderen"
                                    onclick="return confirm('Deze betaling verwijderen?');">

                                    <i class="fa-solid fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('searchInput');

    input.addEventListener('keyup', () => {

        const value = input.value.toLowerCase();

        document.querySelectorAll('tbody tr').forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                    ? ''
                    : 'none';

        });

    });

});

</script>