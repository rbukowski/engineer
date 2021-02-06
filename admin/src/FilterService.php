<?php

declare(strict_types=1);

class FilterService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getConferenceRoomsFilters(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              ctg.id,
              ctg.name,
              JSON_OBJECTAGG(ct.id, ct.type) AS types
            FROM
              conference_types AS ct
            INNER JOIN
              conference_type_groups AS ctg ON ctg.id = ct.group_id
            GROUP BY
              ctg.id
        SQL);

        $query->execute([]);

        return array_map(
            function (array $filterGroup): array {
                $filterGroup['types'] = json_decode($filterGroup['types'], true);

                return $filterGroup;
            },
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function getRoomsFilters(): array
    {
        return [];
    }

    public function getApartmentsFilters(): array
    {
        return [];
    }
}
