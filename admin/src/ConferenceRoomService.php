<?php

declare(strict_types=1);

class ConferenceRoomService implements ObjectServiceInterface
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
              conference_rooms AS cr
            WHERE
              cr.id = :conferenceRoomId
            LIMIT
              1
        SQL);

        $query->execute([
            'conferenceRoomId' => $id,
        ]);

        return !!$query->fetchColumn();
    }
}
