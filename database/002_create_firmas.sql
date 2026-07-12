/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : database/002_create_firmas.sql
| Versie  : 6.8.0
|--------------------------------------------------------------------------
*/

CREATE TABLE firmas (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(150) NOT NULL,

    contactpersoon VARCHAR(150) DEFAULT NULL,

    straat VARCHAR(150) DEFAULT NULL,

    huisnummer VARCHAR(20) DEFAULT NULL,

    postcode VARCHAR(20) DEFAULT NULL,

    gemeente VARCHAR(100) DEFAULT NULL,

    provincie VARCHAR(100) DEFAULT NULL,

    land VARCHAR(100) DEFAULT 'België',

    telefoon VARCHAR(50) DEFAULT NULL,

    gsm VARCHAR(50) DEFAULT NULL,

    email VARCHAR(150) DEFAULT NULL,

    website VARCHAR(150) DEFAULT NULL,

    btw_nummer VARCHAR(40) DEFAULT NULL,

    ondernemingsnummer VARCHAR(40) DEFAULT NULL,

    iban VARCHAR(50) DEFAULT NULL,

    bic VARCHAR(20) DEFAULT NULL,

    standaard_betaaltermijn SMALLINT UNSIGNED DEFAULT 30,

    actief TINYINT(1) NOT NULL DEFAULT 1,

    opmerkingen TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_naam (naam),

    INDEX idx_email (email),

    INDEX idx_btw (btw_nummer),

    INDEX idx_actief (actief)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;