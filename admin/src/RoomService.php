<?php

declare(strict_types=1);

class RoomService implements ObjectServiceInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
    }

    public function doesExist(int $id): bool
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              1
            FROM
              rooms AS r
            WHERE
              r.id = :roomId
            LIMIT
              1
        SQL);

        $query->execute([
            'roomId' => $id,
        ]);

        return !!$query->fetchColumn();
    }
}
