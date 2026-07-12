<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;

class DashboardController
{
    public function index(): void
    {
        $db = Database::connection();

        $aantal = $db->query("
            SELECT COUNT(*)
            FROM betalingen
        ")->fetchColumn();

        die("Aantal betalingen: " . $aantal);
    }
}