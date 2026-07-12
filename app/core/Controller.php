<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Controller.php
 * Versie  : 6.6.0
 * Doel    : Base Controller
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    /**
     * View renderen.
     */
    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    /**
     * Redirect naar een pagina.
     */
    protected function redirect(string $path = ''): never
    {
        header('Location: ' . App::url($path));
        exit;
    }

    /**
     * JSON response.
     */
    protected function json(
        array $data,
        int $status = 200
    ): never {

        http_response_code($status);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(
            $data,
            JSON_PRETTY_PRINT
            | JSON_UNESCAPED_UNICODE
            | JSON_UNESCAPED_SLASHES
        );

        exit;
    }

    /**
     * Success bericht.
     */
    protected function success(string $message): void
    {
        Session::success($message);
    }

    /**
     * Error bericht.
     */
    protected function error(string $message): void
    {
        Session::error($message);
    }

    /**
     * Warning bericht.
     */
    protected function warning(string $message): void
    {
        Session::warning($message);
    }

    /**
     * Info bericht.
     */
    protected function info(string $message): void
    {
        Session::info($message);
    }

    /**
     * Huidige gebruiker.
     */
    protected function user(): ?array
    {
        return Session::user();
    }

    /**
     * Ingelogd?
     */
    protected function isLoggedIn(): bool
    {
        return Session::isLoggedIn();
    }

    /**
     * Login verplicht.
     */
    protected function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {

            $this->warning(
                'Gelieve eerst in te loggen.'
            );

            $this->redirect('login');
        }
    }

    /**
     * 404 pagina.
     */
    protected function abort404(
        string $message = 'Pagina niet gevonden.'
    ): never {

        http_response_code(404);

        $this->render('errors/404', [

            'title'   => '404',

            'message' => $message

        ]);

        exit;
    }

    /**
     * 403 pagina.
     */
    protected function abort403(
        string $message = 'Toegang geweigerd.'
    ): never {

        http_response_code(403);

        $this->render('errors/403', [

            'title'   => '403',

            'message' => $message

        ]);

        exit;
    }

    /**
     * 500 pagina.
     */
    protected function abort500(
        string $message = 'Interne serverfout.'
    ): never {

        http_response_code(500);

        $this->render('errors/500', [

            'title'   => '500',

            'message' => $message

        ]);

        exit;
    }
}