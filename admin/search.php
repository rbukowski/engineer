<?php

declare(strict_types=1);

switch ($_GET['type'] ?? '') {
    case 'apartments':
        $result = [];
    break;

    case 'rooms':
        $result = [];
    break;

    case 'conference-rooms':
        $result = require_once __DIR__ . '/search/conference-rooms.php';
    break;

    default:
        throw new RuntimeException(
            'Nieobsługiwany parametr wyszukiwania'
        );
}

echo json_encode($result, JSON_PRETTY_PRINT);exit;
