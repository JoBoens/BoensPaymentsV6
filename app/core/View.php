<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/View.php
 * Versie  : 6.1.0
 * Doel    : Weergave van pagina's via centrale layout
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class View
{
    /**
     * Render een view binnen de hoofdlayout.
     *
     * @param string $view
     * @param array  $data
     */
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = dirname(__DIR__, 2)
            . '/modules/'
            . $view
            . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException(
                "View niet gevonden: {$viewFile}"
            );
        }

        ob_start();

        require $viewFile;

        $content = ob_get_clean();

        require dirname(__DIR__, 2)
            . '/includes/layout.php';
    }
}