<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Database.php
 * Versie  : 6.1.0
 * Doel    : Centrale databaseverbinding (PDO Singleton)
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $connection = null;

    /**
     * Geeft één enkele PDO-verbinding terug.
     */
    public static function connection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['database'],
            $config['charset']
        );

        try {

            self::$connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );

        } catch (PDOException $e) {

            throw new RuntimeException(
                'Databaseverbinding mislukt: ' . $e->getMessage()
            );

        }

        return self::$connection;
    }

    /**
     * Controle of de verbinding beschikbaar is.
     */
    public static function isConnected(): bool
    {
        try {

            self::connection();

            return true;

        } catch (\Throwable) {

            return false;

        }
    }

    /**
     * Verbreek de verbinding.
     */
    public static function disconnect(): void
    {
        self::$connection = null;
    }
}