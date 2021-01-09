<?php

if(!empty($_GET)){
    $room_id = $_GET['id'];

    $type = $_GET['type'];


    require_once('functions.php');

    delete("rooms",$room_id);
}

?>