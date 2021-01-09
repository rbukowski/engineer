<?php

require_once('../sql_connect.php');

function delete($param, $id) {
    global $mysqli;

    $sql = "DELETE FROM pokoje WHERE id = ?";
}

?>