<?php

declare(strict_types=1);

class ApartmentService implements ObjectServiceInterface
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
              apartments AS a
            WHERE
              a.id = :apartmentId
            LIMIT
              1
        SQL);

        $query->execute([
            'apartmentId' => $id,
        ]);

        return !!$query->fetchColumn();
    }
}
