<?php

declare(strict_types=1);

require_once __DIR__ . '/src/autoload.php';

AuthorizationChecker::check();

$requestData = $_POST;

// To jest tylko mock!
if (empty($requestData)) {
    $requestData = [
        'clientId' => 1,
        'objectId' => 2,
        'objectType' => 'apartment',
        'paymentTypeId' => 1,
        'dateFrom' => '2021-03-15',
        'dateTo' => '2021-03-19',
    ];
}

try {
    $reservationService = new ReservationService();
    $reservationId = $reservationService->bookReservation(
        $requestData['clientId'],
        $requestData['objectId'],
        $requestData['objectType'],
        $requestData['paymentTypeId'],
        new DateTime($requestData['dateFrom']),
        new DateTime($requestData['dateTo'])
    );

    ResponseEmitter::emit([
        'reservationId' => $reservationId,
    ]);
} catch (Throwable $e) {
    ResponseEmitter::emit([
        'error' => $e->getMessage(),
    ], ResponseEmitter::BAD_REQUEST);
}

