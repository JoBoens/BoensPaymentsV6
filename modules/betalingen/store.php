<?php
declare(strict_types=1);

require_once __DIR__ . '/../../app/Database.php';

try {

    $db = Database::connection();

    echo "<h2 style='color:green'>✅ Databaseverbinding geslaagd!</h2>";

} catch (Throwable $e) {

    echo "<h2 style='color:red'>❌ Databaseverbinding mislukt</h2>";

    echo "<pre>";
    echo $e->getMessage();
    echo "</pre>";
}