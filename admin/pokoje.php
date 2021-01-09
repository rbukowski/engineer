<?php
    if(!empty($_POST)){
        $room = $_POST['name'];
        $type = $_POST['type'];

    }

    if(!empty($_FILES)){
        $targetDir = "../asset/offer/rooms/";
        $targerFile = $targetDir.basename($_FILES['photo_room']['name']);
        $imgType = strtolower(pathinfo($targerFile,PATHINFO_EXTENSION));

        if(file_exists($targerFile)){
            die('File alreadu exists!');
        }

        if($_FILES['photo_room']['size'] > 500000){
            die('Image is too big!');
        }

        if($imgType != 'jpeg' && $imgType != 'jpg' && $imgType != 'png') {
            die('Image format is not correct!');
        }

        if(move_uploaded_file($_FILES['photo_room']['tmp_name'],$targerFile)){
            echo "Your file has been uploaded";
        } else{
            die('Your file has not been uploaded');
        }
    }

?>