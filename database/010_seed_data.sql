/*
|--------------------------------------------------------------------------
| Boens Payments V6
|--------------------------------------------------------------------------
| Bestand : 010_seed_data.sql
| Versie  : 6.8.0
|--------------------------------------------------------------------------
| Standaardgegevens
|--------------------------------------------------------------------------
*/

START TRANSACTION;

-- ============================================================
-- CATEGORIEEN
-- ============================================================

INSERT INTO categorieen
(naam, omschrijving, kleur, icoon, sortering)
VALUES

('Energie','Elektriciteit en gas','#ffc107','fa-bolt',10),
('Water','Watermaatschappij','#0dcaf0','fa-droplet',20),
('Telecom','Telefonie en GSM','#198754','fa-phone',30),
('Internet','Internet abonnement','#0d6efd','fa-wifi',40),
('Verzekeringen','Alle verzekeringen','#dc3545','fa-shield-halved',50),
('Belastingen','Overheidsheffingen','#6f42c1','fa-building-columns',60),
('Voertuigen','Auto en mobiliteit','#fd7e14','fa-car',70),
('Software','Software licenties','#20c997','fa-laptop-code',80),
('Kantoor','Kantoorbenodigdheden','#6c757d','fa-briefcase',90),
('Gezondheid','Medisch','#d63384','fa-heart-pulse',100),
('Abonnementen','Terugkerende abonnementen','#198754','fa-repeat',110),
('Diversen','Overige uitgaven','#adb5bd','fa-folder',999);

-- ============================================================
-- BETAALMETHODES
-- ============================================================

INSERT INTO betaalmethodes
(naam, omschrijving, sortering)
VALUES

('Overschrijving','Bankoverschrijving',10),
('SEPA Domiciliëring','Automatische domiciliëring',20),
('Bancontact','Bancontact',30),
('Visa','Visa kredietkaart',40),
('Mastercard','Mastercard kredietkaart',50),
('PayPal','PayPal',60),
('Cash','Contant',70);

-- ============================================================
-- INSTELLINGEN
-- ============================================================

INSERT INTO instellingen
(instelling, waarde)
VALUES

('app_name','Boens Payments V6'),
('company_name','Boens'),
('currency','EUR'),
('language','nl_BE'),
('timezone','Europe/Brussels'),
('payment_prefix','BET'),
('payment_digits','4'),
('default_vat','21'),
('version','6.8.0');

-- ============================================================
-- EERSTE GEBRUIKER
-- Login:
-- admin@boens.org
-- wachtwoord: admin123
-- ============================================================

INSERT INTO gebruikers
(
    naam,
    email,
    wachtwoord,
    rol,
    actief
)
VALUES
(
    'Administrator',
    'admin@boens.org',

    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',

    'Administrator',

    1
);

COMMIT;