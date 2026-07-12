<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : config/app.php
 * Versie  : 6.1.0
 * Doel    : Centrale applicatieconfiguratie
 * ------------------------------------------------------------
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Algemene informatie
    |--------------------------------------------------------------------------
    */

    'app_name' => 'Boens Payments',

    'company_name' => 'Boens',

    'version' => '6.1.0',

    'environment' => 'development',

    'debug' => true,

    /*
    |--------------------------------------------------------------------------
    | Website
    |--------------------------------------------------------------------------
    */

    'base_url' => '/BetalingenV6',

    'timezone' => 'Europe/Brussels',

    'locale' => 'nl_BE',

    'currency' => 'EUR',

    'date_format' => 'd/m/Y',

    /*
    |--------------------------------------------------------------------------
    | Bestanden
    |--------------------------------------------------------------------------
    */

    'upload_folder' => 'uploads',

    'documents_folder' => 'uploads/documents',

    'temp_folder' => 'storage/temp',

    'cache_folder' => 'storage/cache',

    'log_folder' => 'storage/logs',

    /*
    |--------------------------------------------------------------------------
    | Applicatie
    |--------------------------------------------------------------------------
    */

    'items_per_page' => 25,

    'max_upload_size' => 20 * 1024 * 1024, // 20 MB

    'allowed_extensions' => [

        'pdf',

        'jpg',

        'jpeg',

        'png',

        'gif',

        'webp'

    ],

    /*
    |--------------------------------------------------------------------------
    | Nummering
    |--------------------------------------------------------------------------
    */

    'payment_prefix_year' => true,

    'payment_digits' => 4,

];