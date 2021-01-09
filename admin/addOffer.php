<?php
    if(!empty($_POST)){
        $room = $_POST['name'];
        $type = $_POST['type'];
        $submitType = $_POST['submitType'];

    }

    if(!empty($_FILES)){
        $targetDir = "../asset/offer/rooms/";

        if($submitType == "apartments") {
            $targetDir = "../asset/offer/apartments/";
        } elseif ($submitType == "conference") {
            $targetDir = "../asset/offer/conference/";
        }

        $targerFile = $targetDir.basename($_FILES['photo']['name']);
        $imgType = strtolower(pathinfo($targerFile,PATHINFO_EXTENSION));

        if(file_exists($targerFile)){
            die('File alreadu exists!');
        }

        if($_FILES['photo']['size'] > 500000){
            die('Image is too big!');
        }

        if($imgType != 'jpeg' && $imgType != 'jpg' && $imgType != 'png') {
            die('Image format is not correct!');
        }

        if(move_uploaded_file($_FILES['photo']['tmp_name'],$targerFile)){
            echo "Your file has been uploaded";
        } else{
            die('Your file has not been uploaded');
        }
    }

?>