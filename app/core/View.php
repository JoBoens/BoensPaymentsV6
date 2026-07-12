<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/View.php
 * Versie  : 6.7.0
 * Doel    : Centrale View Renderer
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class View
{
    /**
     * Standaard layout
     */
    private static string $layout = 'layouts/main';

    /**
     * Basispad naar de views
     */
    private const VIEW_PATH = BASE_PATH . '/app/Views/';

    /**
     * Layout wijzigen
     */
    public static function layout(string $layout): void
    {
        self::$layout = trim($layout, '/');
    }

    /**
     * View renderen
     */
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = self::VIEW_PATH
            . trim($view, '/')
            . '.php';

        if (!is_file($viewFile)) {
            throw new RuntimeException(
                "View niet gevonden: {$viewFile}"
            );
        }

        ob_start();

        require $viewFile;

        $content = ob_get_clean();

        $layoutFile = self::VIEW_PATH
            . self::$layout
            . '.php';

        if (!is_file($layoutFile)) {
            throw new RuntimeException(
                "Layout niet gevonden: {$layoutFile}"
            );
        }

        require $layoutFile;
    }

    /**
     * Partial laden
     */
    public static function partial(
        string $view,
        array $data = []
    ): void {

        extract($data, EXTR_SKIP);

        $file = self::VIEW_PATH
            . trim($view, '/')
            . '.php';

        if (!is_file($file)) {
            throw new RuntimeException(
                "Partial niet gevonden: {$file}"
            );
        }

        require $file;
    }

    /**
     * Bestaat een view?
     */
    public static function exists(string $view): bool
    {
        return is_file(
            self::VIEW_PATH
            . trim($view, '/')
            . '.php'
        );
    }

    /**
     * Huidige layout ophalen
     */
    public static function getLayout(): string
    {
        return self::$layout;
    }
}