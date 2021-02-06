<?php

declare(strict_types=1);

switch ($_GET['type'] ?? '') {
    case 'apartments':
        break;

    case 'rooms':
        break;

    case 'conference-rooms':
        $result = require_once __DIR__ . '/filters/conference-rooms.php';
        break;

    default:
        throw new RuntimeException(
            'Nieobsługiwany parametr wybierania filtrów!'
        );
}

echo json_encode($result, JSON_PRETTY_PRINT);exit;
