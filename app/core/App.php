<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/App.php
 * Versie  : 6.1.0
 * Doel    : Centrale applicatieklasse
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class App
{
    /**
     * Applicatieconfiguratie
     */
    private static array $config = [];

    /**
     * Applicatie starten
     */
    public static function boot(): void
    {
        self::loadConfig();

        date_default_timezone_set(
            self::$config['timezone']
        );

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Configuratie laden
     */
    private static function loadConfig(): void
    {
        self::$config = require dirname(__DIR__, 2)
            . '/config/app.php';
    }

    /**
     * Config-waarde ophalen
     */
    public static function config(string $key, mixed $default = null): mixed
    {
        return self::$config[$key] ?? $default;
    }

    /**
     * Applicatienaam
     */
    public static function name(): string
    {
        return self::config('app_name', 'Boens Payments');
    }

    /**
     * Versie
     */
    public static function version(): string
    {
        return self::config('version', '6.1.0');
    }

    /**
     * Base URL
     */
    public static function baseUrl(): string
    {
        return rtrim(
            self::config('base_url', ''),
            '/'
        );
    }

    /**
     * Uploadmap
     */
    public static function uploadPath(): string
    {
        return dirname(__DIR__, 2)
            . '/uploads/';
    }

    /**
     * Volledig pad naar storage
     */
    public static function storagePath(): string
    {
        return dirname(__DIR__, 2)
            . '/storage/';
    }

    /**
     * URL opbouwen
     */
    public static function url(string $path = ''): string
    {
        return self::baseUrl() . '/' . ltrim($path, '/');
    }

    /**
     * Databaseverbinding ophalen
     */
    public static function db(): \PDO
    {
        return Database::connection();
    }
}