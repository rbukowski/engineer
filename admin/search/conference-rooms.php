<?php

declare(strict_types=1);

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../sql_connect.php';

$query = $pdo->prepare(<<<SQL
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

return array_map(
    function (array $conferenceRoom): array {
        $conferenceRoom['types'] = json_decode($conferenceRoom['types'], true);

        return $conferenceRoom;
    },
    $query->fetchAll(PDO::FETCH_ASSOC)
);
