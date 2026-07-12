/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 008_create_logs.sql
|--------------------------------------------------------------------------
*/

CREATE TABLE logs (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    gebruiker_id INT UNSIGNED DEFAULT NULL,

    module VARCHAR(100),

    actie VARCHAR(100),

    omschrijving TEXT,

    ipadres VARCHAR(45),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_gebruiker (gebruiker_id),

    INDEX idx_module (module),

    INDEX idx_created (created_at)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;