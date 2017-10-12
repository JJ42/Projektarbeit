<?php

/*
 * Registrierungsprozess, fügt Benutzerinformationen in die Datenbank ein
 * und sendet eine Bestätigungs-E-Mail
 */
require 'db.php';

// Session-Variablen setzen die in profil.php genutzt werden sollen
$_SESSION['matrnr'] = $_POST['matrnr'];
$_SESSION['student_name'] = $_POST['student_name'];
$_SESSION['student_email'] = $_POST['student_email'];

// $_POST Variablen gegen SQL injections schützen
$matrnr = mysqli_escape_string($mysqli, $_POST['matrnr']);
$student_name = mysqli_escape_string($mysqli, $_POST['student_name']);
$student_email = mysqli_escape_string($mysqli, $_POST['student_email']);
$password = mysqli_escape_string($mysqli, $_POST['password']);

// Prüfen ob ein Student mit der Matrikel-Nummer bereits existiert
$sql = "SELECT Id, Password FROM praktikum WHERE Student_matrnr = '" . $matrnr . "'";
$result = mysqli_query($mysqli, $sql);
$rows = mysqli_num_rows($result);

// Wenn rows einen größeren Wert als 0 zurück gibt, existiert die Matrikelnummer bereits
if ($rows > 0) {
    
    $_SESSION['message'] = 'Diese Matrikelnummer existiert bereits, bitte loggen sie sich mit Ihren bereits vorhandenen Daten ein!';
    header("location: error.php");
} else { // Matrikelnummer wurde noch nicht registriert
    
    // Prüfen, ob die eingegebene Matrikelnummer 6-stellig ist
    if (! preg_match("/^[0-9]{6}$/", $_POST['matrnr'])) {
        
        $_SESSION['message'] = 'Die Matrikelnummer, muss eine sechsstellige Zahl sein!';
        
        header("location: error.php");
    } else {
        
        // neue ID bestimmen für Datenbank
        $maxId = "SELECT max(Id) FROM praktikum";
        $result = mysqli_query($mysqli, $maxId);
        $row = mysqli_fetch_row($result);
        $newID = $row[0] + 1;
                
        // füge neuen Datensatz ein
        
        $insert = "INSERT INTO praktikum
                VALUES 
                ('" . $newID . "', '0','0','0','0','0','0','0','0', 
                NULL, NULL, NULL, NULL, NULL, '" . $_POST["student_name"] . "', '" . $_POST["matrnr"] . "', 
               '" . $_POST["student_email"] . "', NULL, NULL, NULL, NULL, NULL,
                NOW(), NULL, NULL, )";
        
        //TODO: results wert ist leer, bearbeiten und korrigieren
        $results = mysqli_query($mysqli, $insert);
        $rows = mysqli_num_rows($results); 
        
        $_SESSION['message'] = "Input : " .$results;
        header("location: error.php");
        
        // Student zur Datenbank zufügen
        /*
         * if ($rows == 0) {
         * $_SESSION['message'] = 'Registrierung fehlgeschlagen!';
         * header("location: error.php");
         * } else {
         *
         * $_SESSION['logged_in'] = true; // So we know the user has logged in
         *
         * // header("location: profile.php");
         *
         * }
         */
    }
}

?>