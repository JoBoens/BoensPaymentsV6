<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Models/Firma.php
 * Versie  : 6.9.0
 * Doel    : Model Firma's
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class Firma extends Model
{
    protected string $table = 'firmas';

    public function all(): array
    {
        $sql = "
            SELECT *
            FROM firmas
            ORDER BY naam
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array|false
    {
        $sql = "
            SELECT *
            FROM firmas
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO firmas
            (
                naam,
                contactpersoon,
                straat,
                huisnummer,
                postcode,
                gemeente,
                provincie,
                land,
                telefoon,
                gsm,
                email,
                website,
                btw_nummer,
                ondernemingsnummer,
                iban,
                bic,
                standaard_betaaltermijn,
                actief,
                opmerkingen
            )
            VALUES
            (
                ?,?,?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?
            )
        ";

        return $this->db
            ->prepare($sql)
            ->execute([
                $data['naam'],
                $data['contactpersoon'],
                $data['straat'],
                $data['huisnummer'],
                $data['postcode'],
                $data['gemeente'],
                $data['provincie'],
                $data['land'],
                $data['telefoon'],
                $data['gsm'],
                $data['email'],
                $data['website'],
                $data['btw_nummer'],
                $data['ondernemingsnummer'],
                $data['iban'],
                $data['bic'],
                $data['standaard_betaaltermijn'],
                $data['actief'],
                $data['opmerkingen']
            ]);
    }
}