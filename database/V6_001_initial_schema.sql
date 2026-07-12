/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : V6_001_initial_schema.sql
| Versie  : 6.1.0
| Doel    : Initiële databasestructuur
|--------------------------------------------------------------------------
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS documenten;
DROP TABLE IF EXISTS betalingen;
DROP TABLE IF EXISTS categorieen;
DROP TABLE IF EXISTS firmas;
DROP TABLE IF EXISTS gebruikers;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- GEBRUIKERS
-- =====================================================

CREATE TABLE gebruikers (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    wachtwoord VARCHAR(255) NOT NULL,

    rol ENUM(
        'Administrator',
        'Gebruiker'
    ) DEFAULT 'Gebruiker',

    actief TINYINT(1) DEFAULT 1,

    laatste_login DATETIME NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- FIRMA'S
-- =====================================================

CREATE TABLE firmas (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(150) NOT NULL,

    contactpersoon VARCHAR(150),

    straat VARCHAR(255),

    postcode VARCHAR(20),

    gemeente VARCHAR(100),

    land VARCHAR(100) DEFAULT 'België',

    btw_nummer VARCHAR(50),

    email VARCHAR(150),

    telefoon VARCHAR(50),

    website VARCHAR(255),

    opmerkingen TEXT,

    actief TINYINT(1) DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- CATEGORIEËN
-- =====================================================

CREATE TABLE categorieen (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(100) NOT NULL,

    kleur VARCHAR(20) DEFAULT '#173A63',

    icoon VARCHAR(50),

    actief TINYINT(1) DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- BETALINGEN
-- =====================================================

CREATE TABLE betalingen (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nummer VARCHAR(10) NOT NULL UNIQUE,

    leverancier_factuurnummer VARCHAR(100),

    firma_id INT UNSIGNED NOT NULL,

    categorie_id INT UNSIGNED,

    omschrijving VARCHAR(255) NOT NULL,

    referentie VARCHAR(100),

    factuurdatum DATE NOT NULL,

    vervaldatum DATE,

    betaaldatum DATE,

    bedrag DECIMAL(12,2) NOT NULL DEFAULT 0.00,

    status ENUM(
        'Open',
        'Betaald',
        'Achterstallig',
        'Geannuleerd'
    ) DEFAULT 'Open',

    opmerkingen TEXT,

    created_by INT UNSIGNED,

    updated_by INT UNSIGNED,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_betaling_firma
        FOREIGN KEY (firma_id)
        REFERENCES firmas(id)
        ON UPDATE CASCADE,

    CONSTRAINT fk_betaling_categorie
        FOREIGN KEY (categorie_id)
        REFERENCES categorieen(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    CONSTRAINT fk_betaling_created
        FOREIGN KEY (created_by)
        REFERENCES gebruikers(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    CONSTRAINT fk_betaling_updated
        FOREIGN KEY (updated_by)
        REFERENCES gebruikers(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    INDEX idx_nummer (nummer),

    INDEX idx_firma (firma_id),

    INDEX idx_categorie (categorie_id),

    INDEX idx_status (status),

    INDEX idx_factuurdatum (factuurdatum),

    INDEX idx_vervaldatum (vervaldatum)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- DOCUMENTEN
-- =====================================================

CREATE TABLE documenten (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    betaling_id INT UNSIGNED NOT NULL,

    bestandsnaam VARCHAR(255) NOT NULL,

    origineel_bestandsnaam VARCHAR(255),

    bestandstype VARCHAR(100),

    bestandsgrootte INT UNSIGNED,

    paginas SMALLINT UNSIGNED DEFAULT 1,

    opmerkingen TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_document_betaling
        FOREIGN KEY (betaling_id)
        REFERENCES betalingen(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_document_betaling (betaling_id)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;