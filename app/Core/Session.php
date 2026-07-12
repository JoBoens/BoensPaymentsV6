<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Session.php
 * Versie  : 6.6.0
 * Doel    : Centrale Session Manager
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class Session
{
    /**
     * Sessie starten indien nodig.
     */
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Waarde opslaan.
     */
    public static function set(string $key, mixed $value): void
    {
        self::start();

        $_SESSION[$key] = $value;
    }

    /**
     * Waarde ophalen.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();

        return $_SESSION[$key] ?? $default;
    }

    /**
     * Controle of sleutel bestaat.
     */
    public static function has(string $key): bool
    {
        self::start();

        return array_key_exists($key, $_SESSION);
    }

    /**
     * Waarde verwijderen.
     */
    public static function forget(string $key): void
    {
        self::start();

        unset($_SESSION[$key]);
    }

    /**
     * Volledige sessie wissen.
     */
    public static function destroy(): void
    {
        self::start();

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    /**
     * Flashbericht opslaan.
     */
    public static function flash(string $type, string $message): void
    {
        self::start();

        $_SESSION['_flash'][] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Success bericht.
     */
    public static function success(string $message): void
    {
        self::flash('success', $message);
    }

    /**
     * Error bericht.
     */
    public static function error(string $message): void
    {
        self::flash('danger', $message);
    }

    /**
     * Warning bericht.
     */
    public static function warning(string $message): void
    {
        self::flash('warning', $message);
    }

    /**
     * Info bericht.
     */
    public static function info(string $message): void
    {
        self::flash('info', $message);
    }

    /**
     * Alle flashberichten ophalen.
     * Na het ophalen worden ze verwijderd.
     */
    public static function flashes(): array
    {
        self::start();

        $messages = $_SESSION['_flash'] ?? [];

        unset($_SESSION['_flash']);

        return $messages;
    }

    /**
     * Eén flashbericht ophalen.
     */
    public static function flashFirst(): ?array
    {
        $messages = self::flashes();

        return $messages[0] ?? null;
    }

    /**
     * Login gebruiker opslaan.
     */
    public static function login(array $user): void
    {
        self::set('user', $user);
    }

    /**
     * Uitloggen.
     */
    public static function logout(): void
    {
        self::forget('user');
    }

    /**
     * Ingelogd?
     */
    public static function isLoggedIn(): bool
    {
        return self::has('user');
    }

    /**
     * Huidige gebruiker.
     */
    public static function user(): ?array
    {
        return self::get('user');
    }

    /**
     * CSRF-token ophalen of aanmaken.
     */
    public static function csrf(): string
    {
        self::start();

        if (!isset($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'];
    }

    /**
     * CSRF-token valideren.
     */
    public static function validateCsrf(?string $token): bool
    {
        self::start();

        return hash_equals(
            $_SESSION['_csrf'] ?? '',
            $token ?? ''
        );
    }
}