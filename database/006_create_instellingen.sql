/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 006_create_instellingen.sql
|--------------------------------------------------------------------------
*/

CREATE TABLE instellingen (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    instelling VARCHAR(100) NOT NULL,

    waarde TEXT,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_instelling (instelling)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;