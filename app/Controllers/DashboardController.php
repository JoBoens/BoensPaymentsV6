<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Controllers/DashboardController.php
 * Versie  : 6.3.0
 * Doel    : Dashboard Controller
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class DashboardController
{
    /**
     * Dashboard tonen
     */
    public function index(): void
    {
        $db = Database::connection();

        /*
        |--------------------------------------------------------------------------
        | Statistieken
        |--------------------------------------------------------------------------
        */

        $openstaand = (float) $db->query("
            SELECT COALESCE(SUM(bedrag),0)
            FROM betalingen
            WHERE status = 'Open'
        ")->fetchColumn();

        $dezeMaand = (float) $db->query("
            SELECT COALESCE(SUM(bedrag),0)
            FROM betalingen
            WHERE MONTH(factuurdatum)=MONTH(CURDATE())
              AND YEAR(factuurdatum)=YEAR(CURDATE())
        ")->fetchColumn();

        $ditJaar = (float) $db->query("
            SELECT COALESCE(SUM(bedrag),0)
            FROM betalingen
            WHERE YEAR(factuurdatum)=YEAR(CURDATE())
        ")->fetchColumn();

        $achterstallig = (int) $db->query("
            SELECT COUNT(*)
            FROM betalingen
            WHERE vervaldatum < CURDATE()
              AND status <> 'Betaald'
        ")->fetchColumn();

        /*
        |--------------------------------------------------------------------------
        | Laatste betalingen
        |--------------------------------------------------------------------------
        */

        $stmt = $db->query("
            SELECT
                nummer,
                omschrijving,
                bedrag,
                status
            FROM betalingen
            ORDER BY id DESC
            LIMIT 10
        ");

        $betalingen = $stmt->fetchAll();

        /*
        |--------------------------------------------------------------------------
        | View laden
        |--------------------------------------------------------------------------
        */

        View::render('dashboard/index', [

            'title'         => 'Dashboard',

            'openstaand'    => $openstaand,

            'dezeMaand'     => $dezeMaand,

            'ditJaar'       => $ditJaar,

            'achterstallig' => $achterstallig,

            'betalingen'    => $betalingen

        ]);
    }
}