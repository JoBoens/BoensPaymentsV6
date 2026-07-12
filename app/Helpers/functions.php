<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Helpers/functions.php
 * Versie  : 6.1.0
 * Doel    : Algemene helperfuncties
 * ------------------------------------------------------------
 */

declare(strict_types=1);

if (!function_exists('e')) {

    /**
     * HTML escapen.
     */
    function e(?string $value): string
    {
        return htmlspecialchars(
            $value ?? '',
            ENT_QUOTES,
            'UTF-8'
        );
    }
}

if (!function_exists('redirect')) {

    /**
     * Redirect naar een andere pagina.
     */
    function redirect(string $url): never
    {
        header('Location: ' . $url);
        exit;
    }
}

if (!function_exists('euro')) {

    /**
     * Formatteer bedrag als euro.
     */
    function euro(float $amount): string
    {
        return '€ ' . number_format(
            $amount,
            2,
            ',',
            '.'
        );
    }
}

if (!function_exists('datum')) {

    /**
     * Formatteer datum.
     */
    function datum(?string $date): string
    {
        if (empty($date)) {
            return '';
        }

        return date(
            'd/m/Y',
            strtotime($date)
        );
    }
}

if (!function_exists('flash')) {

    /**
     * Flash message bewaren.
     */
    function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }
}

if (!function_exists('getFlash')) {

    /**
     * Flash message ophalen.
     */
    function getFlash(): ?array
    {
        if (!isset($_SESSION['flash'])) {
            return null;
        }

        $flash = $_SESSION['flash'];

        unset($_SESSION['flash']);

        return $flash;
    }
}

if (!function_exists('old')) {

    /**
     * Oude formulierwaarde teruggeven.
     */
    function old(string $key, mixed $default = ''): mixed
    {
        return $_POST[$key] ?? $default;
    }
}

if (!function_exists('csrf')) {

    /**
     * CSRF-token genereren.
     */
    function csrf(): string
    {
        if (empty($_SESSION['_token'])) {

            $_SESSION['_token'] = bin2hex(
                random_bytes(32)
            );

        }

        return $_SESSION['_token'];
    }
}

if (!function_exists('csrfField')) {

    /**
     * Verborgen CSRF-veld.
     */
    function csrfField(): string
    {
        return '<input type="hidden" name="_token" value="' .
            csrf() .
            '">';
    }
}

if (!function_exists('verifyCsrf')) {

    /**
     * CSRF-token controleren.
     */
    function verifyCsrf(): bool
    {
        return isset($_POST['_token'])
            && isset($_SESSION['_token'])
            && hash_equals(
                $_SESSION['_token'],
                $_POST['_token']
            );
    }
}