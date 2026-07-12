/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 003_create_categorieen.sql
| Versie  : 6.8.0
|--------------------------------------------------------------------------
*/

CREATE TABLE categorieen (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(100) NOT NULL,

    omschrijving VARCHAR(255) DEFAULT NULL,

    kleur VARCHAR(20) DEFAULT '#0d6efd',

    icoon VARCHAR(50) DEFAULT 'fa-folder',

    sortering SMALLINT UNSIGNED DEFAULT 0,

    actief TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_categorie_naam (naam),

    INDEX idx_sortering (sortering),

    INDEX idx_actief (actief)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;