<?php
error_reporting(E_ALL);
session_start();
/*
 * register.php prüft ob der Benutzer bereits existiert.
 * Die max ID wird ermittelt und um eins erhöht, sobald ein neuer Datensatz
 * angelegt wird. Der neue Datensatz des Studenten, der sich registriert
 * wird in die Datenbank geschrieben. Danach wird der Nutzer auf den
 * eingeloggten Bereich praktikum.php geleitet
 */
require 'database_connection.php';

$matrnr = $_POST['matrnr'];
$student_name = $_POST['student_name'];
$student_email = $_POST['student_email'];
$password = $_POST['password'];

// Abfragen ob ein Student mit der eingegeben Matrikelnr. bereits existiert
$sql = "SELECT Id, Password FROM praktikum WHERE Student_matrnr = '" . $matrnr . "'";
$result = mysqli_query($mysqli, $sql);
$rows = mysqli_num_rows($result);

// Wenn rows einen größeren Wert als 0 zurück gibt, existiert die Matrikelnr bereits
if($rows > 0) {
    $_SESSION['message'] = 'Diese Matrikelnummer existiert bereits, 
                            bitte loggen Sie sich ein.';
    header("location: error.php");
} else {
    // Datensatz anlegen
    $eintrag = "INSERT INTO praktikum VALUES ('', '0', '0', '0', '0', '0', '0', '0', '0', NULL , NULL , NULL , NULL , NULL , '" . $student_name . "' , '" . $matrnr . "' , '" . $student_email . "' , NULL , NULL , NULL , NULL , '" . $password . "', NOW(), NULL, NULL)";
    $eintragen = mysqli_query($mysqli, $eintrag);
    
    if ($eintragen) {
        $_SESSION['logged_in'] = true; //Student ist eingeloggt
        $_SESSION['matrnr'] = $matrnr;
        $_SESSION['student_name'] = $student_name;
        $_SESSION['student_email'] = $student_email;
        $_SESSION['password'] = $password;
        header("location: praktikum.php");
    } else {
        $_SESSION['message'] = 'Registrierung fehlgeschlagen';
        header("location: error.php");
    }   
}
?>

