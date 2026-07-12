<?php
declare(strict_types=1);

function euro(float $bedrag): string
{
    return '€ ' . number_format($bedrag, 2, ',', '.');
}

function datum(?string $datum): string
{
    if (empty($datum)) {
        return '';
    }

    return date('d/m/Y', strtotime($datum));
}

function redirect(string $url): never
{
    header("Location: {$url}");
    exit;
}