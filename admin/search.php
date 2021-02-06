<?php

declare(strict_types=1);

require_once __DIR__ . '/src/autoload.php';

$searchService = new SearchService(
    PDOBuilder::getInstance()
);

switch ($_GET['type'] ?? '') {
    case 'apartments':
        $result = $searchService->searchApartments();
    break;

    case 'rooms':
        $result = $searchService->searchRooms();
    break;

    case 'conference-rooms':
        $result = $searchService->searchConferenceRooms();
    break;

    default:
        throw new RuntimeException(
            'Nieobsługiwany parametr wyszukiwania'
        );
}

echo json_encode($result, JSON_PRETTY_PRINT);exit;
