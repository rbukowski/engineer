<?php
    if(!empty($_POST)) {
        if(isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
            header("Location: dashboard.php");
        }

        $pdo = require_once __DIR__ . '/sql_connect.php';

        $nick = trim($_POST['login']);
        $password = hash('whirlpool', trim($_POST['password']));

        if($nick == '' || $password == ''){
            die("Twój login lub haslo jest niepoprawne");
        }

        // przygotowanie zapytania
        $query = $pdo->prepare(<<<SQL
            SELECT
                password
            FROM
                users
            WHERE
                name = :name
        SQL);

        $query->execute([
            'name' => $nick,
        ]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $user_password = $result[0]["password"];

        if ($password == $user_password){
            session_start();
            $_SESSION['logged'] = true;
            header("Location: dashboard.php");
        } else{
            die('Hasło nieprawidłowe');
        }

    } else {
        die("No data sent");
    }
?>