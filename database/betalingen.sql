CREATE TABLE betalingen (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nummer VARCHAR(10) NOT NULL UNIQUE,

    firma_id INT DEFAULT NULL,

    categorie_id INT DEFAULT NULL,

    omschrijving VARCHAR(255) NOT NULL,

    referentie VARCHAR(100),

    factuurdatum DATE,

    uiterste_datum DATE,

    betaaldatum DATE,

    bedrag DECIMAL(10,2) DEFAULT 0,

    opmerkingen TEXT,

    document VARCHAR(255),

    status ENUM('Open','Betaald','Vervallen') DEFAULT 'Open',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

);