<?php
declare(strict_types=1);

class UploadService
{
    public static function upload(array $bestand): ?string
    {
        if (empty($bestand['name'])) {
            return null;
        }

        // Wordt verder uitgewerkt in V6.2
        return $bestand['name'];
    }
}