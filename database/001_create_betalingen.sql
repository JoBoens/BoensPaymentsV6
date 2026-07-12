CREATE TABLE betalingen (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nummer VARCHAR(30) NOT NULL UNIQUE,

    factuurdatum DATE NOT NULL,

    vervaldatum DATE DEFAULT NULL,

    betaaldatum DATE DEFAULT NULL,

    firma_id INT UNSIGNED DEFAULT NULL,

    categorie_id INT UNSIGNED DEFAULT NULL,

    omschrijving VARCHAR(255) NOT NULL,

    referentie VARCHAR(100) DEFAULT NULL,

    bedrag DECIMAL(12,2) NOT NULL DEFAULT 0,

    btw_percentage DECIMAL(5,2) DEFAULT 21.00,

    btw_bedrag DECIMAL(12,2) DEFAULT 0,

    totaal DECIMAL(12,2) DEFAULT 0,

    betaalmethode VARCHAR(40) DEFAULT NULL,

    status ENUM(
        'Open',
        'Betaald',
        'Geannuleerd'
    ) DEFAULT 'Open',

    document VARCHAR(255) DEFAULT NULL,

    opmerkingen TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_factuurdatum (factuurdatum),

    INDEX idx_vervaldatum (vervaldatum),

    INDEX idx_status (status),

    INDEX idx_firma (firma_id),

    INDEX idx_categorie (categorie_id)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;