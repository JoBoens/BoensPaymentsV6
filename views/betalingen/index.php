<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Views/betalingen/index.php
 * Versie  : 6.3.1
 * Doel    : Overzicht betalingen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

use App\Core\App;
?>

<div class="page-header mb-4">

    <div>

        <h1 class="mb-1">Betalingen</h1>

        <p class="text-muted mb-0">
            Beheer al je inkomende en uitgaande betalingen.
        </p>

    </div>

    <div>

        <a href="<?= App::url('betalingen/create'); ?>"
           class="btn btn-primary">

            <i class="fa-solid fa-plus"></i>

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
                    id="search"
                    class="form-control"
                    placeholder="Zoeken...">

            </div>

            <div class="col-lg-2">

                <select class="form-select">

                    <option value="">Alle statussen</option>
                    <option>Open</option>
                    <option>Betaald</option>
                    <option>Vervallen</option>

                </select>

            </div>

            <div class="col-lg-2">

                <select class="form-select">

                    <option value="">Alle jaren</option>

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

            <table class="table table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th width="100">Nr</th>

                    <th>Firma</th>

                    <th>Omschrijving</th>

                    <th>Factuur</th>

                    <th>Vervaldag</th>

                    <th class="text-end">Bedrag</th>

                    <th width="130">Status</th>

                    <th width="140" class="text-center">

                        Acties

                    </th>

                </tr>

                </thead>

                <tbody>

                <?php if (empty($betalingen)): ?>

                    <tr>

                        <td colspan="8"
                            class="text-center py-5 text-muted">

                            <i class="fa-regular fa-folder-open fa-2x mb-3"></i>

                            <br>

                            Er zijn nog geen betalingen aanwezig.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach ($betalingen as $betaling): ?>

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

                            <td class="text-end fw-semibold">

                                € <?= number_format(
                                    (float)$betaling['bedrag'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                            </td>

                            <td>

                                <?php

                                $kleur = match ($betaling['status']) {

                                    'Betaald' => 'success',

                                    'Open' => 'warning',

                                    'Vervallen' => 'danger',

                                    default => 'secondary'

                                };

                                ?>

                                <span class="badge bg-<?= $kleur ?>">

                                    <?= e($betaling['status']) ?>

                                </span>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= App::url('betalingen/edit?id=' . $betaling['id']) ?>"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <a
                                    href="<?= App::url('betalingen/delete?id=' . $betaling['id']) ?>"
                                    class="btn btn-sm btn-outline-danger"
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