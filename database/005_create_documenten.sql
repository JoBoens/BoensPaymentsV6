/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 005_create_documenten.sql
|--------------------------------------------------------------------------
*/

CREATE TABLE documenten (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    betaling_id INT UNSIGNED NOT NULL,

    origineel_bestand VARCHAR(255) NOT NULL,

    opgeslagen_bestand VARCHAR(255) NOT NULL,

    bestandstype VARCHAR(100),

    bestandsgrootte BIGINT,

    opmerkingen TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_betaling (betaling_id)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;