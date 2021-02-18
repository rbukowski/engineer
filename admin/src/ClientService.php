<?php

declare(strict_types=1);

class ClientService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
    }

    public function createClient(string $name): int
    {
        $query = $this->pdo->prepare(<<<SQL
            INSERT INTO clients (
              name
            ) VALUES (
              :name
            ) RETURNING id
        SQL);

        $query->execute([
            'name' => $name,
        ]);

        return $query->fetchColumn();
    }

    public function doesExist(int $clientId): bool
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              1
            FROM
              clients AS c
            WHERE
              c.id = :clientId
            LIMIT
              1
        SQL);

        $query->execute([
            'clientId' => $clientId,
        ]);

        return !!$query->fetchColumn();
    }
}
