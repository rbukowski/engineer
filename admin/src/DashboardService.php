<?php

declare(strict_types=1);

class DashboardService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
    }

    public function getRoomsOnAdminDashboard(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              r.id,
              r.name,
              r.price,
              JSON_AGG(
                rt.type
              ) AS types
            FROM
              rooms AS r
            LEFT JOIN 
              rooms_relations AS rr ON rr.room_id = r.id
            LEFT JOIN
              rooms_types AS rt ON rr.room_type_id = rt.id
            GROUP BY
              r.id
        SQL);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApartmentsOnAdminDashboard(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              a.id,
              a.name,
              a.price,
              JSON_AGG(at.type) AS types
            FROM
              apartments AS a
            LEFT JOIN
              apartments_relations AS ar ON ar.apartment_id = a.id
            LEFT JOIN
              apartments_types AS at ON at.id = ar.apartment_type_id
            GROUP BY
              a.id
        SQL);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConferenceOnAdminDashboard(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              cr.id,
              cr.name,
              cr.price,
              JSON_AGG(
                ct.type
              ) AS types
            FROM
              conference_rooms AS cr
            LEFT JOIN 
              conference_room_relations AS crr ON crr.conference_room_id = cr.id
            LEFT JOIN
              conference_types AS ct ON ct.id = crr.conference_type_id
            GROUP BY
              cr.id
        SQL);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
