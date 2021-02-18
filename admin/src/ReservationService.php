<?php

declare(strict_types=1);

class ReservationService
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var RoomService
     */
    private $roomService;

    /**
     * @var ConferenceRoomService
     */
    private $conferenceRoomService;

    /**
     * @var ApartmentService
     */
    private $apartmentService;

    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct()
    {
        $this->pdo = PDOBuilder::getInstance();
        $this->roomService = new RoomService();
        $this->conferenceRoomService = new ConferenceRoomService();
        $this->apartmentService = new ApartmentService();
        $this->clientService = new ClientService();
    }

    public function bookReservation(
        int $clientId,
        int $objectId,
        string $objectType,
        int $paymentTypeId,
        DateTime $dateFrom,
        DateTime $dateTo
    ): int {
        // Sprawdzamy prawidłowość dat.
        $this->throwUnlessValidDates($dateFrom, $dateTo);
        // Upewniamy się, że klient istnieje.
        $this->throwUnlessClientExists($clientId);
        // Sprawdzamy czy typ rezerwacji (np. apartament) istnieje.
        $this->throwUnlessReservationTypeExists($objectType);
        // Sprawdzamy czy typ płatności istnieje.
        $this->throwUnlessPaymentTypeExists($paymentTypeId);
        // Upewniamy się, że obiekt (np. apartament) który rezerwujemy istnieje.
        $this->throwUnlessObjectExists($objectId, $objectType);
        // Sprawdzamy czy ww. obiekt (np. apartament) jest zajęty już w tym terminie.
        $this->throwUnlessAvailable($objectId, $objectType, $dateFrom, $dateTo);

        $query = $this->pdo->prepare(<<<SQL
            INSERT INTO reservations (
              client_id,
              type,
              date_from,
              date_to,
              payment_type,
              reservation_object_id
            ) VALUES (
              :clientId,
              (SELECT id FROM reservation_types WHERE type = :objectType LIMIT 1),
              :dateFrom,
              :dateTo,
              :paymentTypeId,
              :reservationObjectId
            )
            RETURNING id
        SQL);

        $query->execute([
            'clientId' => $clientId,
            'objectType' => $objectType,
            'dateFrom' => $dateFrom->format('Y-m-d'),
            'dateTo' => $dateTo->format('Y-m-d'),
            'paymentTypeId' => $paymentTypeId,
            'reservationObjectId' => $objectId,
        ]);

        return $query->fetchColumn();
    }

    private function throwUnlessClientExists(int $clientId): void
    {
        if (!$this->clientService->doesExist($clientId)) {
            throw new InvalidArgumentException(
                "Klient o identyfikatorze \"$clientId\" nie istnieje."
            );
        }
    }

    private function throwUnlessReservationTypeExists(string $objectType): void
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              1
            FROM
              reservation_types AS rt
            WHERE
              rt.type = :objectType
            LIMIT
              1
        SQL);

        $query->execute([
            'objectType' => $objectType,
        ]);

        if (!$query->fetchColumn()) {
            throw new OutOfBoundsException(
                "Nie można założyć rezerwacji dla wybranego typu obiektu: \"$objectType\"!"
            );
        }
    }


    private function throwUnlessPaymentTypeExists(int $paymentTypeId)
    {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              1
            FROM
              payment_types AS pt
            WHERE
              pt.id = :paymentTypeId
            LIMIT
              1
        SQL);

        $query->execute([
            'paymentTypeId' => $paymentTypeId,
        ]);

        if (!$query->fetchColumn()) {
            throw new OutOfBoundsException(
                "Nie można założyć rezerwacji dla wybranego typu obiektu: \"$objectType\"!"
            );
        }
    }

    private function throwUnlessObjectExists(int $objectId, string $objectType): void
    {
        if (!$this->getServiceByObjectType($objectType)->doesExist($objectId)) {
            throw new LogicException(
                'Nie można założyć rezerwacji dla nieistniejącego obiektu!'
            );
        }
    }


    private function throwUnlessAvailable(
        int $objectId,
        string $objectType,
        DateTime $dateFrom,
        DateTime $dateTo
    ): void {
        $query = $this->pdo->prepare(<<<SQL
            SELECT
              r.id
            FROM
              reservations AS r
            INNER JOIN
              reservation_types AS rt ON r.type = rt.id
            WHERE
              rt.type = :objectType
              AND r.reservation_object_id = :objectId
              AND (
                (r.date_from > :dateFrom AND r.date_from < :dateTo)
                OR (r.date_to > :dateFrom AND r.date_from < :dateTo)
              )
            LIMIT
              1
        SQL);

        $query->execute([
            'objectType' => $objectType,
            'objectId' => $objectId,
            'dateFrom' => $dateFrom->format('Y-m-d'),
            'dateTo' => $dateTo->format('Y-m-d'),
        ]);

        if ($reservationId = $query->fetchColumn()) {
            throw new LogicException(
                'Nie można założyć rezerwacji, ponieważ obiekt jest już zajęty w wybranym terminie.'
                    . " Wystąpiła kolizja z rezerwacją \"{$reservationId}\"."
            );
        }
    }

    private function getServiceByObjectType(string $objectType): ObjectServiceInterface
    {
        switch ($objectType) {
            case 'apartment':
                return $this->apartmentService;

            case 'conference-room':
                return $this->conferenceRoomService;

            case 'room':
                return $this->roomService;
        }

        throw new OutOfBoundsException(
            "Nieobsługiwany typ \"$objectType\"!"
        );
    }

    private function throwUnlessValidDates(DateTime $dateFrom, DateTime $dateTo): void
    {
        if ($dateFrom->format('Y-m-d') === $dateTo->format('Y-m-d')) {
            throw new LogicException(
                'Rezerwacja musi obejmować minimum dwa dni.'
            );
        }

        if ($dateTo < $dateFrom) {
            throw new LogicException(
                'Rezerwacja nie może kończyć się przed swoim rozpoczęciem.'
            );
        }
    }
}
