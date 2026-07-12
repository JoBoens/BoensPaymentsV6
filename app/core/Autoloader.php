<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Autoloader.php
 * Versie  : 6.1.0
 * Doel    : Automatisch laden van alle App-klassen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class Autoloader
{
    /**
     * Registreer de autoloader.
     */
    public static function register(): void
    {
        spl_autoload_register([self::class, 'load']);
    }

    /**
     * Laad een klasse automatisch.
     */
    private static function load(string $class): void
    {
        $prefix = 'App\\';

        // Alleen onze eigen namespace laden
        if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
            return;
        }

        // Namespace verwijderen
        $relativeClass = substr($class, strlen($prefix));

        // Omzetten naar bestandspad
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR .
                str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) .
                '.php';

        if (is_file($file)) {
            require_once $file;
        }
    }
}