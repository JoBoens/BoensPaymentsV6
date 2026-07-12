<?php
declare(strict_types=1);

require_once __DIR__ . '/../Database.php';

class Betaling
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM betalingen ORDER BY id DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll();
    }

    public function find(int $id): array|null
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM betalingen WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO betalingen
            (
                nummer,
                firma_id,
                omschrijving,
                factuurdatum,
                referentie,
                bedrag,
                uiterste_datum,
                categorie_id,
                opmerkingen,
                created_at,
                updated_at
            )
            VALUES
            (
                :nummer,
                :firma_id,
                :omschrijving,
                :factuurdatum,
                :referentie,
                :bedrag,
                :uiterste_datum,
                :categorie_id,
                :opmerkingen,
                NOW(),
                NOW()
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }
}