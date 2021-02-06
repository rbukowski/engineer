<?php

declare(strict_types=1);

class SearchService
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function searchByType(string $type, array $filterTypeIds = []): array
    {
        $result = $this->getResultByType($type);

        // Jak nie ma filtrów to zwracamy cały wynik.
        if (empty($filterTypeIds)) {
            return $result;
        }

        foreach ($result as $key => $row) {
            // ArrayIntersect zwraca elementy pierwszej tablicy, które istnieją w drugiej tablicy.
            // Sprawdzamy w ten sposób (poprzez zliczenie elementów pasujących do filtrów) i zliczenie filtrów
            // Czy wszystkie filtry na pewno zostały spełnione.
            // W takim przypadku, jeżeli przeszukiwany element będzie spełniał dodatkowe filtry - nie zostanie
            // On wykluczony z wyniku.
            $areFiltersSatisfied = count(
                array_intersect($filterTypeIds, array_keys($row['types']))
            ) === count($filterTypeIds);

            if (!$areFiltersSatisfied) {
                unset($result[$key]);
            }
        }

        // Robię array_merge, żeby po stronie JavaScript mieć tablicę, a nie obiekty.
        return array_merge($result);
    }

    private function getResultByType(string $type): array
    {
        switch ($type) {
            case 'apartments':
                return $this->searchApartments();

            case 'rooms':
                return $this->searchRooms();

            case 'conference-rooms':
                return $this->searchConferenceRooms();
        }

        throw new RuntimeException(
            'Nieobsługiwany parametr wybierania filtrów!'
        );
    }

    private function searchConferenceRooms(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              cr.*,
              COALESCE(
                JSON_OBJECTAGG(ct.id, ct.type),
                '{}'
              ) AS types
            FROM
              conference_rooms AS cr
            LEFT JOIN
              conference_room_relations AS crr ON crr.conference_room_id = cr.id
            LEFT JOIN
              conference_types AS ct ON crr.conference_type_id = ct.id
            GROUP BY
              cr.id
        SQL);

        $query->execute([]);

        return $this->decodeTypes(
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    private function searchRooms(): array
    {
        return [];
    }

    private function searchApartments(): array
    {
        return [];
    }

    private function decodeTypes(array $rows): array
    {
        return array_map(
            function (array $row): array {
                $row['types'] = json_decode($row['types'] ?? '{}', true);

                return $row;
            },
            $rows
        );
    }
}
