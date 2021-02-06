<?php

declare(strict_types=1);

class FilterService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
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
              COALESCE(
                JSON_AGG(
                  JSON_BUILD_OBJECT(
                    'id', ct.id,
                    'type', ct.type
                  )
                ),
                '{}'
              ) AS types
            FROM
              conference_types AS ct
            LEFT JOIN
              conference_type_groups AS ctg ON ctg.id = ct.group_id
            GROUP BY
              ctg.id
        SQL);

        $query->execute([]);

        return $this->decodeTypes(
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    private function getRoomsFilters(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              rtg.id,
              rtg.name,
              COALESCE(
                JSON_AGG(
                  JSON_BUILD_OBJECT(
                    'id', rt.id,
                    'type', rt.type
                  )
                ),
                '{}'
              ) AS types
            FROM
              rooms_types AS rt
            LEFT JOIN
              rooms_type_groups AS rtg ON rtg.id = rt.group_id
            GROUP BY
              rtg.id
        SQL);

        $query->execute([]);

        return $this->decodeTypes(
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    private function getApartmentsFilters(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              atg.id,
              atg.name,
              COALESCE(
                JSON_AGG(
                  JSON_BUILD_OBJECT(
                    'id', at.id,
                    'type', at.type
                  )
                ),
                '{}'
              ) AS types
            FROM
              apartments_types AS at
            LEFT JOIN
              apartments_type_groups AS atg ON atg.id = at.group_id
            GROUP BY
              atg.id
        SQL);

        $query->execute([]);

        return $this->decodeTypes(
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    private function decodeTypes(array $rows): array
    {
        return array_map(
            function (array $row): array {
                $row['types'] = TypesDecoder::decodeFromJson($row['types']);

                return $row;
            },
            $rows
        );
    }
}
