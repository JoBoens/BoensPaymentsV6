<?php
declare(strict_types=1);

require_once __DIR__ . '/../Database.php';

class NummerGenerator
{
    public static function volgendeBetaling(): string
    {
        $db = Database::connection();

        $jaar = date('y');

        $prefix = $jaar;

        $stmt = $db->prepare("
            SELECT nummer
            FROM betalingen
            WHERE nummer LIKE ?
            ORDER BY nummer DESC
            LIMIT 1
        ");

        $stmt->execute([$prefix . '%']);

        $laatste = $stmt->fetchColumn();

        if (!$laatste) {
            return $prefix . '0001';
        }

        return (string)((int)$laatste + 1);
    }
}