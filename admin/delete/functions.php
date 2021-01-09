<?php

require_once('../sql_connect.php');

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
?>