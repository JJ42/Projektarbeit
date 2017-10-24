<?php
/* Database connection settings */
$db_server = '127.0.0.1'; // mysql-Server
$db_user = 'root'; // Benutzername fuer Datenbank
$db_password = ''; // Password fuer Datenbank
$db_name = 'Praktikumsdatenbank'; // Name der Datenbank

/* Verbindung zur Datenbank herstellen */
if ($mysqli = mysqli_connect($db_server, $db_user, $db_password)) {
    //echo "Die verbindung wurde aufgebaut";
} else {
   // echo "Die Verbindung ist fehlgeschlagen" . mysqli_error();
    exit();
}
/* Datenbank auswaehlen */
mysqli_select_db($mysqli, $db_name);


/* TODO: wofür benötigt??? */
$fullurl ="http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

?>