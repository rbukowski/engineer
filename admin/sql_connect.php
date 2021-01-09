 <?php
 
 $host = "127.0.0.1";
 $user = 'root';
 $password = '';
 $dbname = 'inz';

 $mysqli = new mysqli($host, $user, $password, $dbname);
 $mysqli -> query("SET NAMES 'utf-8' COLLATE 'utf-8_polish_ci'");
 $mysqli -> query("SET CHARSET utf-8");

 if($error = $mysqli->connect_errno){
     die("Wystąpił błąd połączenia Nr: $error");
 }

 ?>