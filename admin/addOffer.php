<?php
    if(!empty($_POST)){
        $name = trim($_POST['name']);
        // TODO: Tutaj przesyła się z frontu jedna wybrana wartość zamiast wszystkich! Do sprawdzenia i do poprawienia!
        $typeIds = is_array($_POST['type'])
            ? $_POST['type'] : [$_POST['type']];
        $submitType = $_POST['submitType'];
        $price = $_POST['price'];

        if (!empty($_FILES)){
            $targetDir = "../asset/offer/rooms/";

            if($submitType == "apartments") {
                $targetDir = "../asset/offer/apartments/";
            } elseif ($submitType == "conference") {
                $targetDir = "../asset/offer/conference/";
            }

            $targetFile = realpath($targetDir) . '/' . basename($_FILES['photo']['name']);
            $imgType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

            if(file_exists($targetFile)){
                die('File already exists!');
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

        /** @var PDO $pdo */
        $pdo = require_once __DIR__ . '/sql_connect.php';

        switch ($submitType) {
            case 'rooms':
                $mainQuery = $pdo->prepare(<<<SQL
                    INSERT INTO rooms (
                      name, photo_url, price
                    )
                    VALUES (
                      :name, :photoUrl, :price
                    )
                    RETURNING id
                SQL);
                $relationQuery = $pdo->prepare(<<<SQL
                    INSERT INTO rooms_relations (
                      room_id, room_type_id
                    )
                    VALUES (
                      :id, :typeId
                    )
                SQL);

                break;
            case 'apartments':
                $mainQuery = $pdo->prepare(<<<SQL
                    INSERT INTO apartments (
                      name, photo_url, price
                    )
                    VALUES (
                      :name, :photoUrl, :price
                    )
                    RETURNING id
                SQL);
                $relationQuery = $pdo->prepare(<<<SQL
                    INSERT INTO apartments_relations (
                      apartment_id, apartment_type_id
                    )
                    VALUES (
                      :id, :typeId
                    )
                SQL);

                break;
            case 'conference-rooms':
                $mainQuery = $pdo->prepare(<<<SQL
                    INSERT INTO conference_rooms (
                      name, photo_url, price
                    )
                    VALUES (
                      :name, :photoUrl, :price
                    )
                    RETURNING id
                SQL);
                $relationQuery = $pdo->prepare(<<<SQL
                    INSERT INTO conference_room_relations (
                      conference_room_id, conference_type_id
                    )
                    VALUES (
                      :id, :typeId
                    )
                SQL);
                break;
            default:
                throw new InvalidArgumentException(
                    "Nieobsługiwany typ do zapisu: \"$submitType\""
                );
        }

        try {
            $mainQuery->execute([
                'name' => $name,
                'photoUrl' => $targetFile ?: '',
                'price' => $price,
            ]);

            // To można byłoby wykonać jako jeden SQL, ale będzie trudniejsze do zrozumienia implementacji.
            foreach ($typeIds as $typeId) {
                $relationQuery->execute([
                    'id' => $mainQuery->fetchColumn(),
                    'typeId' => $typeId,
                ]);
            }

            header("Location:dashboard.php");
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
?>
