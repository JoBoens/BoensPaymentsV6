/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : V6_003_indexes_views.sql
| Versie  : 6.1.0
|--------------------------------------------------------------------------
*/

-- =====================================================
-- EXTRA INDEXEN
-- =====================================================

CREATE INDEX idx_betalingen_nummer
ON betalingen (nummer);

CREATE INDEX idx_betalingen_status
ON betalingen (status);

CREATE INDEX idx_betalingen_factuurdatum
ON betalingen (factuurdatum);

CREATE INDEX idx_betalingen_vervaldatum
ON betalingen (vervaldatum);

CREATE INDEX idx_betalingen_betaaldatum
ON betalingen (betaaldatum);

CREATE INDEX idx_betalingen_bedrag
ON betalingen (bedrag);

CREATE INDEX idx_firmas_naam
ON firmas (naam);

CREATE INDEX idx_categorieen_naam
ON categorieen (naam);

-- =====================================================
-- VIEW : OPEN BETALINGEN
-- =====================================================

CREATE OR REPLACE VIEW vw_open_betalingen AS

SELECT

    b.id,
    b.nummer,
    f.naam AS firma,
    c.naam AS categorie,
    b.omschrijving,
    b.factuurdatum,
    b.vervaldatum,
    b.bedrag,
    b.status

FROM betalingen b

LEFT JOIN firmas f
ON b.firma_id = f.id

LEFT JOIN categorieen c
ON b.categorie_id = c.id

WHERE b.status <> 'Betaald';

-- =====================================================
-- VIEW : DASHBOARD TOTALEN
-- =====================================================

CREATE OR REPLACE VIEW vw_dashboard_totalen AS

SELECT

    COUNT(*)                     AS aantal,

    SUM(bedrag)                  AS totaal,

    SUM(
        CASE
            WHEN status='Open'
            THEN bedrag
            ELSE 0
        END
    ) AS openstaand,

    SUM(
        CASE
            WHEN status='Betaald'
            THEN bedrag
            ELSE 0
        END
    ) AS betaald

FROM betalingen;