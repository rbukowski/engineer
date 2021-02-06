<?php

declare(strict_types=1);

class DictionaryService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
    }

    public function getRoomTypes(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              rt.id,
              rt.type
            FROM
              rooms_types AS rt
        SQL);

        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApartmentTypes(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              at.id,
              at.type
            FROM
              apartments_types AS at
        SQL);

        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConferenceRoomTypes(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              ct.id,
              ct.type
            FROM
              conference_types AS ct
        SQL);

        $query->execute([]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
