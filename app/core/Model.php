<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Model.php
 * Versie  : 6.5.0
 * Doel    : Base Model
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

use PDO;
use RuntimeException;

abstract class Model
{
    /**
     * Databaseverbinding
     */
    protected PDO $db;

    /**
     * Tabelnaam
     */
    protected string $table;

    /**
     * Primary key
     */
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::connection();

        if (empty($this->table)) {
            throw new RuntimeException(
                'Model heeft geen tabelnaam.'
            );
        }
    }

    /**
     * Alle records
     */
    public function all(string $orderBy = ''): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if ($orderBy !== '') {
            $sql .= " ORDER BY {$orderBy}";
        }

        return $this->db
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Eén record
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE {$this->primaryKey} = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    /**
     * Record toevoegen
     */
    public function create(array $data): bool
    {
        $velden = array_keys($data);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->table,
            implode(',', $velden),
            ':' . implode(',:', $velden)
        );

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Record wijzigen
     */
    public function update(int $id, array $data): bool
    {
        $velden = [];

        foreach (array_keys($data) as $veld) {
            $velden[] = "{$veld} = :{$veld}";
        }

        $data['id'] = $id;

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = :id",
            $this->table,
            implode(', ', $velden),
            $this->primaryKey
        );

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data);
    }

    /**
     * Record verwijderen
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE
            FROM {$this->table}
            WHERE {$this->primaryKey} = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * Aantal records
     */
    public function count(): int
    {
        return (int) $this->db
            ->query("
                SELECT COUNT(*)
                FROM {$this->table}
            ")
            ->fetchColumn();
    }

    /**
     * Eerste record
     */
    public function first(): ?array
    {
        $stmt = $this->db->query("
            SELECT *
            FROM {$this->table}
            LIMIT 1
        ");

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    /**
     * Laatste records
     */
    public function latest(
        int $limit = 10,
        string $order = 'id'
    ): array {

        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            ORDER BY {$order} DESC
            LIMIT :limit
        ");

        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}