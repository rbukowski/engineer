<?php
    $pdo = require_once __DIR__ . '/sql_connect.php';

    function delete($param, $id) {
        global $mysqli;

        if($param == "rooms"){
            $sql = "DELETE FROM rooms WHERE id = ?";
        } else {
            $sql = "DELETE FROM apartments WHERE id = ?";
        }

        if ($statement = $mysqli->prepare($sql)) {
            if($statement->bind_param('i',$id )) {
                $statement->execute();
                header("Location: ../dashboard.php");
            }
        }
    }

    function getRoomTypes() {
        global $pdo;

        $query = $pdo->prepare(<<<SQL
            SELECT
                *
            FROM
                rooms_types
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getRoomsOnAdminDashbard() {
        global $pdo;

        $query = $pdo->prepare(<<<SQL
            SELECT
                rooms.id, rooms.name, rooms.price, rooms_types.type
            FROM
                rooms
            INNER JOIN
                rooms_types
            ON
                rooms.type_id = rooms_types.id
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // getting apartments from DB
    function getApartmentTypes() {
        global $pdo;

        $query = $pdo->prepare(<<<SQL
            SELECT
                *
            FROM
                apartment_types
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getApartmentsOnAdminDashbard() {
        global $pdo;

        var_dump($pdo);

        $query = $pdo->prepare(<<<SQL
            SELECT
                ap.id, ap.name, ap.price, at.type
            FROM
                apartments
            AS
                ap
            INNER JOIN
                apartments_types
            AS
                at
            ON
                ap.type_id = at.id
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // getting conference rooms from DB

    function getConferenceRoomTypes() {
        global $pdo;

        $query = $pdo->prepare(<<<SQL
            SELECT
                rooms.id, rooms.name, rooms.price, rooms_types.type
            FROM
                conference_types
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getConferenceOnAdminDashbard() {
        global $pdo;

        $query = $pdo->prepare(<<<SQL
            SELECT
                cr.id, cr.name, cr.price, ct.type
            FROM
                conference_rooms
            AS
                cr
            INNER JOIN
                conference_types
            AS
                ct
            ON
                cr.type_id = ct.id
        SQL);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        var_dump($result);

        return $result;
    }
?>
