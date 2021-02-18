<?php

declare(strict_types=1);

require_once __DIR__ . '/src/autoload.php';

AuthorizationChecker::check();

$requestData = $_POST;

// To jest tylko mock!
if (empty($requestData)) {
    $requestData = [
        'name' => 'Testowy klient',
    ];
}

try {
    $clientService = new ClientService();
    $clientId = $clientService->createClient($requestData['name']);

    ResponseEmitter::emit([
        'clientId' => $clientId,
    ]);
} catch (Throwable $e) {
    ResponseEmitter::emit([
        'error' => $e->getMessage(),
    ], ResponseEmitter::BAD_REQUEST);
}

