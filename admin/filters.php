<?php

declare(strict_types=1);

require_once __DIR__ . '/src/autoload.php';

$filterService = new FilterService(
    PDOBuilder::getInstance()
);

switch ($_GET['type'] ?? '') {
    case 'apartments':
        $result = $filterService->getApartmentsFilters();
        break;

    case 'rooms':
        $result = $filterService->getRoomsFilters();
        break;

    case 'conference-rooms':
        $result = $filterService->getConferenceRoomsFilters();
        break;

    default:
        throw new RuntimeException(
            'Nieobsługiwany parametr wybierania filtrów!'
        );
}

echo json_encode($result, JSON_PRETTY_PRINT);exit;
