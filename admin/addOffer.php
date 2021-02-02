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

        $pdo = require_once __DIR__ . '/sql_connect.php';

        $query = $pdo->prepare(<<<SQL
            INSERT INTO :db_table (name, photo_url, price, type_id)
            VALUES (:name, :photo_url, :price, :type_id)
        SQL);

        try {
            $query->execute([
                'db_table' => $submitType,
                'name' => $name,
                'photo_url' => $targetFile,
                'price' => $price,
                'type_id' => $type_id
            ]);
            header("Location:dashboard.php");
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
?>