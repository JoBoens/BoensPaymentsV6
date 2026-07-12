<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Models/Betaling.php
 * Versie  : 6.3.0
 * Doel    : Model Betalingen
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Betaling
{
    /**
     * Databaseverbinding
     */
    private PDO $db;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = Database::connection();
    }

    /**
     * Alle betalingen
     */
    public function all(): array
    {
        $sql = "
            SELECT
                b.*,
                f.naam AS firma
            FROM betalingen b
            LEFT JOIN firmas f
                ON f.id = b.firma_id
            ORDER BY b.vervaldatum ASC,
                     b.id DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Laatste betalingen
     */
    public function latest(int $limit = 10): array
    {
        $stmt = $this->db->prepare("
            SELECT
                b.*,
                f.naam AS firma
            FROM betalingen b
            LEFT JOIN firmas f
                ON f.id = b.firma_id
            ORDER BY b.id DESC
            LIMIT :limiet
        ");

        $stmt->bindValue(
            ':limiet',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Eén betaling ophalen
     */
    public function find(int $id): array|null
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM betalingen
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $betaling = $stmt->fetch(PDO::FETCH_ASSOC);

        return $betaling ?: null;
    }

    /**
     * Nieuwe betaling bewaren
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO betalingen
            (
                nummer,
                firma_id,
                categorie_id,
                omschrijving,
                factuurnummer,
                factuurdatum,
                vervaldatum,
                bedrag,
                status
            )
            VALUES
            (
                :nummer,
                :firma_id,
                :categorie_id,
                :omschrijving,
                :factuurnummer,
                :factuurdatum,
                :vervaldatum,
                :bedrag,
                :status
            )
        ");

        return $stmt->execute($data);
    }

    /**
     * Betaling wijzigen
     */
    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;

        $stmt = $this->db->prepare("
            UPDATE betalingen
            SET
                firma_id      = :firma_id,
                categorie_id  = :categorie_id,
                omschrijving  = :omschrijving,
                factuurnummer = :factuurnummer,
                factuurdatum  = :factuurdatum,
                vervaldatum   = :vervaldatum,
                bedrag        = :bedrag,
                status        = :status
            WHERE id = :id
        ");

        return $stmt->execute($data);
    }

    /**
     * Betaling verwijderen
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
     * Totaal openstaand bedrag
     */
    public function totaalOpenstaand(): float
    {
        return (float)$this->db
            ->query("
                SELECT
                    COALESCE(SUM(bedrag),0)
                FROM betalingen
                WHERE status='Open'
            ")
            ->fetchColumn();
    }

    /**
     * Aantal achterstallige betalingen
     */
    public function aantalAchterstallig(): int
    {
        return (int)$this->db
            ->query("
                SELECT COUNT(*)
                FROM betalingen
                WHERE vervaldatum < CURDATE()
                  AND status <> 'Betaald'
            ")
            ->fetchColumn();
    }
}