<?php
/* Database connection settings */
$db_server = '127.0.0.1'; // mysql-Server
$db_user = 'root'; // Benutzername fuer Datenbank
$db_password = ''; // Password fuer Datenbank
$db_name = 'praktikumsdatenbank'; // Name der Datenbank

/* Verbindung zur Datenbank herstellen */
if ($mysqli = mysqli_connect($db_server, $db_user, $db_password)) {
    echo "Die verbindung wurde aufgebaut";
} else {
    echo "Die Verbindung ist fehlgeschlagen" . mysqli_error();
    exit();
}

// $fullurl ="http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

mysqli_select_db($mysqli, $db_name);


?>