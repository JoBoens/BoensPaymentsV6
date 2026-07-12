<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : modules/betalingen/create.php
 * Versie  : 6.2.0
 * Doel    : Controller - Nieuwe betaling
 * ------------------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../bootstrap.php';

use App\Core\View;
use App\Core\Database;

$db = Database::connection();

/*
|--------------------------------------------------------------------------
| Volgend betalingsnummer bepalen
|--------------------------------------------------------------------------
*/

$jaar = date('y');

$stmt = $db->prepare("
    SELECT nummer
    FROM betalingen
    WHERE nummer LIKE :prefix
    ORDER BY nummer DESC
    LIMIT 1
");

$stmt->execute([
    'prefix' => $jaar . '%'
]);

$laatste = $stmt->fetchColumn();

if ($laatste) {

    $volgnummer = (int)substr($laatste, 2) + 1;

} else {

    $volgnummer = 1;

}

$nummer = sprintf('%02d%04d', $jaar, $volgnummer);

/*
|--------------------------------------------------------------------------
| Firma's ophalen
|--------------------------------------------------------------------------
*/

$firmas = $db->query("
    SELECT id, naam
    FROM firmas
    WHERE actief = 1
    ORDER BY naam
")->fetchAll();

/*
|--------------------------------------------------------------------------
| Categorieën ophalen
|--------------------------------------------------------------------------
*/

$categorieen = $db->query("
    SELECT id, naam
    FROM categorieen
    WHERE actief = 1
    ORDER BY naam
")->fetchAll();

/*
|--------------------------------------------------------------------------
| Pagina tonen
|--------------------------------------------------------------------------
*/

View::render(
    'betalingen/create',
    [
        'nummer' => $nummer,
        'firmas' => $firmas,
        'categorieen' => $categorieen
    ]
);