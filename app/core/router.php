<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Router.php
 * Versie  : 6.5.0
 * Doel    : MVC Router
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class Router
{
    /**
     * Alle routes.
     */
    private array $routes = [];

    /**
     * GET-route registreren.
     */
    public function get(string $uri, callable|array $action): void
    {
        $this->add('GET', $uri, $action);
    }

    /**
     * POST-route registreren.
     */
    public function post(string $uri, callable|array $action): void
    {
        $this->add('POST', $uri, $action);
    }

    /**
     * Route toevoegen.
     */
    private function add(
        string $method,
        string $uri,
        callable|array $action
    ): void {

        $uri = '/' . trim($uri, '/');

        $this->routes[$method][] = [
            'uri'    => $uri,
            'action' => $action,
        ];
    }

    /**
     * Router uitvoeren.
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

        $uri = parse_url($requestUri, PHP_URL_PATH);

        $base = parse_url(App::baseUrl(), PHP_URL_PATH);

        if ($base !== null && $base !== '' && str_starts_with($uri, $base)) {
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

            if (!class_exists($controller)) {
                throw new RuntimeException(
                    "Controller '{$controller}' niet gevonden."
                );
            }

            $instance = new $controller();

            if (!method_exists($instance, $function)) {
                throw new RuntimeException(
                    "Methode '{$function}' niet gevonden in {$controller}."
                );
            }

            call_user_func_array(
                [$instance, $function],
                $matches
            );

            return;
        }

        http_response_code(404);

        throw new RuntimeException(
            "Route '{$uri}' niet gevonden."
        );
    }
}