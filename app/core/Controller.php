<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Controller.php
 * Versie  : 6.4.0
 * Doel    : Base Controller
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    /**
     * View renderen
     */
    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    /**
     * Redirect naar een URL binnen de applicatie
     */
    protected function redirect(string $path = ''): never
    {
        header('Location: ' . App::url($path));
        exit;
    }

    /**
     * JSON-response teruggeven
     */
    protected function json(array $data, int $status = 200): never
    {
        http_response_code($status);

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(
            $data,
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES |
            JSON_PRETTY_PRINT
        );

        exit;
    }

    /**
     * 404-pagina
     */
    protected function abort404(string $message = 'Pagina niet gevonden.'): never
    {
        http_response_code(404);

        $this->render('errors/404', [
            'title' => '404',
            'message' => $message
        ]);

        exit;
    }

    /**
     * 500-pagina
     */
    protected function abort500(string $message = 'Interne serverfout.'): never
    {
        http_response_code(500);

        $this->render('errors/500', [
            'title' => '500',
            'message' => $message
        ]);

        exit;
    }
}