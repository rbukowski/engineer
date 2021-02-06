<?php

declare(strict_types=1);

require_once __DIR__ . '/src/autoload.php';

$searchService = new SearchService(PDOBuilder::getInstance());

ResponseEmitter::emit(
    $searchService->searchByType(
        $_GET['type'] ?? '',
        $_GET['filters'] ?? []
    )
);
