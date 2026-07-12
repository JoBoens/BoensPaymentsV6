/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 009_create_foreign_keys.sql
| Versie  : 6.8.0
|--------------------------------------------------------------------------
| Alle Foreign Keys
|--------------------------------------------------------------------------
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================
-- BETALINGEN -> FIRMAS
-- ============================================================

ALTER TABLE betalingen
ADD CONSTRAINT fk_betalingen_firma
FOREIGN KEY (firma_id)
REFERENCES firmas(id)
ON UPDATE CASCADE
ON DELETE SET NULL;

-- ============================================================
-- BETALINGEN -> CATEGORIEEN
-- ============================================================

ALTER TABLE betalingen
ADD CONSTRAINT fk_betalingen_categorie
FOREIGN KEY (categorie_id)
REFERENCES categorieen(id)
ON UPDATE CASCADE
ON DELETE SET NULL;

-- ============================================================
-- DOCUMENTEN -> BETALINGEN
-- ============================================================

ALTER TABLE documenten
ADD CONSTRAINT fk_documenten_betaling
FOREIGN KEY (betaling_id)
REFERENCES betalingen(id)
ON UPDATE CASCADE
ON DELETE CASCADE;

-- ============================================================
-- LOGS -> GEBRUIKERS
-- ============================================================

ALTER TABLE logs
ADD CONSTRAINT fk_logs_gebruiker
FOREIGN KEY (gebruiker_id)
REFERENCES gebruikers(id)
ON UPDATE CASCADE
ON DELETE SET NULL;

SET FOREIGN_KEY_CHECKS = 1;