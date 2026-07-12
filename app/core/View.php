<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/View.php
 * Versie  : 6.3.0
 * Doel    : Centrale View Renderer
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class View
{
    /**
     * Layoutbestand
     */
    private static string $layout = 'layouts/main';

    /**
     * Layout wijzigen
     */
    public static function layout(string $layout): void
    {
        self::$layout = $layout;
    }

    /**
     * View renderen
     */
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = BASE_PATH . '/views/' . $view . '.php';

        if (!is_file($viewFile)) {
            throw new RuntimeException(
                "View niet gevonden: {$viewFile}"
            );
        }

        ob_start();

        require $viewFile;

        $content = ob_get_clean();

        $layoutFile = BASE_PATH
            . '/views/'
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
    public static function partial(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $file = BASE_PATH . '/views/' . $view . '.php';

        if (!is_file($file)) {
            throw new RuntimeException(
                "Partial niet gevonden: {$file}"
            );
        }

        require $file;
    }
}