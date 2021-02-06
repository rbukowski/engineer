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

    public function getFiltersByType(string $type): array
    {
        switch ($type) {
            case 'apartments':
                return $this->getApartmentsFilters();

            case 'rooms':
                return $this->getRoomsFilters();

            case 'conference-rooms':
                return $this->getConferenceRoomsFilters();
        }

        throw new RuntimeException(
            'Nieobsługiwany parametr wybierania filtrów!'
        );
    }

    private function getConferenceRoomsFilters(): array
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

    private function getRoomsFilters(): array
    {
        return [];
    }

    private function getApartmentsFilters(): array
    {
        return [];
    }
}
