<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Views/partials/flash.php
 * Versie  : 6.6.0
 * Doel    : Bootstrap Flash Messages
 * ------------------------------------------------------------
 */

declare(strict_types=1);

use App\Core\Session;

$messages = Session::flashes();

if (empty($messages)) {
    return;
}
?>

<div class="container-fluid mb-4">

    <?php foreach ($messages as $message): ?>

        <?php

        $type = $message['type'] ?? 'info';

        $icon = match ($type) {

            'success' => 'fa-circle-check',

            'danger'  => 'fa-circle-xmark',

            'warning' => 'fa-triangle-exclamation',

            default   => 'fa-circle-info'

        };

        ?>

        <div class="alert alert-<?= e($type) ?> alert-dismissible fade show shadow-sm">

            <i class="fa-solid <?= $icon ?> me-2"></i>

            <?= e($message['message']) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Sluiten">
            </button>

        </div>

    <?php endforeach; ?>

</div>