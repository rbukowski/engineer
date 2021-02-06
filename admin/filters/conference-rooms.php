<?php

declare(strict_types=1);

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../sql_connect.php';

$query = $pdo->prepare(<<<SQL
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
