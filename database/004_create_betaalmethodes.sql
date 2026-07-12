/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 004_create_betaalmethodes.sql
|--------------------------------------------------------------------------
*/

CREATE TABLE betaalmethodes (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(60) NOT NULL,

    omschrijving VARCHAR(255) DEFAULT NULL,

    actief TINYINT(1) DEFAULT 1,

    sortering SMALLINT UNSIGNED DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_betaalmethode (naam)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;