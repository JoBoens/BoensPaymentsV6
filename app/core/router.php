<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Router.php
 * Versie  : 6.4.0
 * Doel    : MVC Router met URL-parameters
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class Router
{
    /**
     * Alle routes
     */
    private array $routes = [];

    /**
     * GET
     */
    public function get(string $uri, callable|array $action): void
    {
        $this->add('GET', $uri, $action);
    }

    /**
     * POST
     */
    public function post(string $uri, callable|array $action): void
    {
        $this->add('POST', $uri, $action);
    }

    /**
     * Route toevoegen
     */
    private function add(string $method, string $uri, callable|array $action): void
    {
        $uri = '/' . trim($uri, '/');

        $this->routes[$method][] = [
            'uri' => $uri,
            'action' => $action
        ];
    }

    /**
     * Router uitvoeren
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $base = parse_url(App::baseUrl(), PHP_URL_PATH);

        if ($base && str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
        }

        $uri = '/' . trim($uri, '/');

        foreach ($this->routes[$method] ?? [] as $route) {

            $pattern = preg_replace(
                '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
                '([^/]+)',
                $route['uri']
            );

            $pattern = '#^' . $pattern . '$#';

            if (!preg_match($pattern, $uri, $matches)) {
                continue;
            }

            array_shift($matches);

            $action = $route['action'];

            if (is_callable($action)) {
                call_user_func_array($action, $matches);
                return;
            }

            [$controller, $function] = $action;

            $controller = new $controller();

            call_user_func_array(
                [$controller, $function],
                $matches
            );

            return;
        }

        http_response_code(404);

        throw new RuntimeException(
            'Pagina niet gevonden.'
        );
    }
}