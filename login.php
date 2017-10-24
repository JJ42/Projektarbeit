<?php
error_reporting(E_ALL);
session_start();
/*
 * Login.php prüft ob der Benutzer bereits existiert und die Eingaben
 * korrekt sind. Sind sie es, werden die Daten aus der Datenbank abgerufen
 * und es findet eine Weiterleitung auf die Benutzerseite statt.
 */
require 'database_connection.php';


// $_POST Variable gegen SQL Injections Schützen
$matrnr = mysqli_escape_string($mysqli, $_POST['matrnr']);

// Abrufen des Datensatzes aus der Datenbank
$sql = "SELECT * FROM praktikum WHERE Student_matrnr = '" . $matrnr . "'";
$result = mysqli_query($mysqli, $sql);
$rows = mysqli_num_rows($result);

if ($rows == 0) { // Student existiert noch nicht
    $_SESSION['message'] = "Diese Matrikelnummer existiert nicht, 
                        bitte zuerst registrieren";
    header("location: error.php");
} else { // Studenteneintrag existiert
    
    $student = mysqli_fetch_assoc($result);
    
    if ($_POST['password'] = $student['Password']) {
        
        // Benutzer ist eingeloggt
        $_SESSION['logged_in'] = true;
        
        // bereits eingetragene Einträge aus der Datenbank laden
        $_SESSION['id'] = $student['ID'];
        $_SESSION['day'] = $student['Day'];
        $_SESSION['month'] = $student["Month"];
        $_SESSION['year'] = $student["Year"];
        $_SESSION['endDay'] = $student["EndDay"];
        $_SESSION['endMonth'] = $student["EndMonth"];
        $_SESSION['endYear'] = $student["EndYear"];
        $_SESSION['duration'] = $student["Duration"];
        $_SESSION['company'] = $student["Company"];
        $_SESSION['department'] = utf8_encode($student["Department"]);
        $_SESSION['tutor_company_name'] = utf8_encode($student["Tutor_company_name"]);
        $_SESSION['tutor_company_email'] = utf8_encode($student["Tutor_company_email"]);
        $_SESSION['tutor_company_phone'] = utf8_encode($student["Tutor_company_phone"]);
        $_SESSION['tutor_uni_name'] = utf8_encode($student["Tutor_uni_name"]);
        $_SESSION['student_name'] = $student['Student_name'];
        $_SESSION['matrnr'] = $student['Student_matrnr'];
        $_SESSION['student_email'] = $student['Student_email'];
        $_SESSION['student_phone'] = utf8_encode($student["Student_phone"]);
        $_SESSION['description'] = utf8_encode($student["Description"]);
        $_SESSION['title'] = utf8_encode($student["Title"]);
        $_SESSION['town'] = utf8_encode($student["Town"]);
        // $password = utf8_encode($student["Password"]);
        
        
        header("location: praktikum.php");
    } else {
        $_SESSION['message'] = "Das Passwort ist falsch, bitte versuche es erneut!";
        header("location: error.php");
    }
}
?>