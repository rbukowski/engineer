<?php
    if(!empty($_POST)){
        $name = trim($_POST['name']);
        $type_id = trim($_POST['type']);
        $submitType = $_POST['submitType'];
        $price = $_POST['price'];

        

        if(!empty($_FILES)){
            $targetDir = "../asset/offer/rooms/";
    
            if($submitType == "apartments") {
                $targetDir = "../asset/offer/apartments/";
            } elseif ($submitType == "conference") {
                $targetDir = "../asset/offer/conference/";
            }
    
            $targetFile = $targetDir.basename($_FILES['photo']['name']);
            $imgType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    
            if(file_exists($targetFile)){
                die('File alreadu exists!');
            }
    
            if($_FILES['photo']['size'] > 500000){
                die('Image is too big!');
            }
    
            if($imgType != 'jpeg' && $imgType != 'jpg' && $imgType != 'png') {
                die('Image format is not correct!');
            }
    
            if(move_uploaded_file($_FILES['photo']['tmp_name'],$targetFile)){
                echo "Your file has been uploaded";
            } else{
                die('Your file has not been uploaded');
            }
        }

        require_once('sql_connect.php');

        $sql = "INSERT INTO rooms (name, photo_url, price, type) VALUES (?,?,?,?)";

        if ($statement = $mysqli->prepare($sql)) {
            var_dump($type_id);
            var_dump($name, $targetFile);
            if($statement->bind_param('ssii', $name, $targetFile, $price, $type_id)){
                if($statement->execute()){
                    header("Location:dashboard.php");
                } else {
                    die('Error');
                }
            }
        } else {
            die('Nieprawidłowe zapytanie!');
        }




    }

    

?>