<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Models/Betaling.php
 * Versie  : 6.2.0
 * Doel    : Model voor alle betalingen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Betaling
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    /**
     * Alle betalingen ophalen.
     */
    public function getAll(): array
    {
        $sql = "
            SELECT
                b.*,
                f.naam AS firma,
                c.naam AS categorie
            FROM betalingen b
            LEFT JOIN firmas f
                ON b.firma_id = f.id
            LEFT JOIN categorieen c
                ON b.categorie_id = c.id
            ORDER BY b.factuurdatum DESC,
                     b.id DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll();
    }

    /**
     * Eén betaling ophalen.
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM betalingen
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $betaling = $stmt->fetch();

        return $betaling ?: null;
    }

    /**
     * Nieuwe betaling opslaan.
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO betalingen (

                nummer,

                leverancier_factuurnummer,

                firma_id,

                categorie_id,

                omschrijving,

                referentie,

                factuurdatum,

                vervaldatum,

                betaaldatum,

                bedrag,

                status,

                opmerkingen,

                created_at,

                updated_at

            )

            VALUES (

                :nummer,

                :leverancier_factuurnummer,

                :firma_id,

                :categorie_id,

                :omschrijving,

                :referentie,

                :factuurdatum,

                :vervaldatum,

                :betaaldatum,

                :bedrag,

                :status,

                :opmerkingen,

                NOW(),

                NOW()

            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Betaling wijzigen.
     */
    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        $sql = "
            UPDATE betalingen
            SET

                leverancier_factuurnummer = :leverancier_factuurnummer,

                firma_id = :firma_id,

                categorie_id = :categorie_id,

                omschrijving = :omschrijving,

                referentie = :referentie,

                factuurdatum = :factuurdatum,

                vervaldatum = :vervaldatum,

                betaaldatum = :betaaldatum,

                bedrag = :bedrag,

                status = :status,

                opmerkingen = :opmerkingen,

                updated_at = NOW()

            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Betaling verwijderen.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE
            FROM betalingen
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * Zoeken.
     */
    public function search(string $zoek): array
    {
        $stmt = $this->db->prepare("
            SELECT
                b.*,
                f.naam AS firma,
                c.naam AS categorie

            FROM betalingen b

            LEFT JOIN firmas f
                ON b.firma_id = f.id

            LEFT JOIN categorieen c
                ON b.categorie_id = c.id

            WHERE

                b.nummer LIKE :zoek

                OR

                b.omschrijving LIKE :zoek

                OR

                b.referentie LIKE :zoek

                OR

                f.naam LIKE :zoek

            ORDER BY b.factuurdatum DESC
        ");

        $stmt->execute([
            'zoek' => "%{$zoek}%"
        ]);

        return $stmt->fetchAll();
    }

    /**
     * Totaal openstaand bedrag.
     */
    public function totaalOpenstaand(): float
    {
        $stmt = $this->db->query("
            SELECT
                COALESCE(SUM(bedrag),0)
            FROM betalingen
            WHERE status='Open'
        ");

        return (float)$stmt->fetchColumn();
    }

    /**
     * Aantal betalingen.
     */
    public function aantal(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM betalingen
        ");

        return (int)$stmt->fetchColumn();
    }
}