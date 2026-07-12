/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 007_create_gebruikers.sql
|--------------------------------------------------------------------------
*/

CREATE TABLE gebruikers (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    naam VARCHAR(120) NOT NULL,

    email VARCHAR(180) NOT NULL,

    wachtwoord VARCHAR(255) NOT NULL,

    rol ENUM(
        'Administrator',
        'Gebruiker'
    ) DEFAULT 'Gebruiker',

    actief TINYINT(1) DEFAULT 1,

    laatste_login DATETIME DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_email (email)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;