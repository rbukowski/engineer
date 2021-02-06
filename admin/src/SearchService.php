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
            // [1, 2] ; [1, 2, 3] => [1, 2] || count(2) === count(2) - OK!
            // [1] ; [1, 2, 3, 4, 5] => [1] || count(1) === count(1) - OK!
            // [1, 2, 3] ; [1, 2] => [1, 2] || count(3) !== count(2) - Nie OK!
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
                JSON_AGG(
                  JSON_BUILD_OBJECT(
                    'id', ct.id,
                    'type', ct.type
                  )
                ),
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
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              r.*,
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
              rooms AS r
            LEFT JOIN
              rooms_relations AS rr ON rr.room_id = r.id
            LEFT JOIN
              rooms_types AS rt ON rt.id = rr.room_type_id
            GROUP BY
              r.id
        SQL);

        $query->execute([]);

        return $this->decodeTypes(
            $query->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    private function searchApartments(): array
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              a.*,
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
              apartments AS a
            LEFT JOIN
              apartments_relations AS ar ON ar.apartment_id = a.id
            LEFT JOIN
              apartments_types AS at ON at.id = ar.apartment_type_id
            GROUP BY
              a.id
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
