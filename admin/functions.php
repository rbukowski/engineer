<?php

    require_once('sql_connect.php');

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
        global $mysqli;

        $sql = "SELECT * FROM rooms_types";

        $result = $mysqli->query($sql);

        $roomTypes = $result->fetch_all(MYSQLI_ASSOC);

        return $roomTypes;
    }

    function getRoomsOnAdminDashbard() {
        global $mysqli;

        // TODO: sprawdzić nadpisywanie id pokoju przez id room type
        $sql = "SELECT * FROM rooms INNER JOIN rooms_types ON rooms.type_id = rooms_types.id ";

        $result = $mysqli->query($sql);

        $roomsWithType = $result->fetch_all(MYSQLI_ASSOC);

        return $roomsWithType;
    }
?>