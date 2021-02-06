<?php

declare(strict_types=1);

/** @var PDO $pdo */
$pdo = require_once __DIR__ . '/../admin/sql_connect.php';

try {
    // docker-compose exec fpm php dump/run.php
    $sqlStatements = file_get_contents(
        realpath(__DIR__ . '/database.sql')
    );
    $pdo->exec($sqlStatements);

    echo 'Super. Masz wgraną bazę danych!' . PHP_EOL;
} catch (Throwable $e) {
    echo 'Wystąpił błąd' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}

exit(0);
