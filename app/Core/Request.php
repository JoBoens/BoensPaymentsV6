<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Request.php
 * Versie  : 6.5.0
 * Doel    : Centrale Request klasse
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class Request
{
    /**
     * HTTP methode
     */
    public static function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    /**
     * Is GET?
     */
    public static function isGet(): bool
    {
        return self::method() === 'GET';
    }

    /**
     * Is POST?
     */
    public static function isPost(): bool
    {
        return self::method() === 'POST';
    }

    /**
     * GET waarde
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * POST waarde
     */
    public static function post(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Alle POST data
     */
    public static function all(): array
    {
        return $_POST;
    }

    /**
     * Bestaat sleutel?
     */
    public static function has(string $key): bool
    {
        return isset($_POST[$key]) || isset($_GET[$key]);
    }

    /**
     * Integer
     */
    public static function int(string $key, int $default = 0): int
    {
        return (int) (self::post($key)
            ?? self::get($key)
            ?? $default);
    }

    /**
     * Float
     */
    public static function float(string $key, float $default = 0): float
    {
        return (float) (self::post($key)
            ?? self::get($key)
            ?? $default);
    }

    /**
     * String
     */
    public static function string(string $key, string $default = ''): string
    {
        return trim(
            (string) (
                self::post($key)
                ?? self::get($key)
                ?? $default
            )
        );
    }

    /**
     * Boolean
     */
    public static function bool(string $key): bool
    {
        return filter_var(
            self::post($key)
            ?? self::get($key),
            FILTER_VALIDATE_BOOL
        );
    }

    /**
     * Bestand upload
     */
    public static function file(string $key): ?array
    {
        return $_FILES[$key] ?? null;
    }

    /**
     * Client IP
     */
    public static function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }

    /**
     * User Agent
     */
    public static function userAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
}