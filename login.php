<?php
/*
 * Login, pr�fen ob der Benutzer existiert und das Passwort korrekt ist.
 * Sind die Eingaben korrekt werden die bereits get�tigten
 * Daten aus der Datenbank abgerufen
 */

/* Datenbankanbindung einbinden */
require 'db.php';
session_start();

/* $_POST Variablen gegen SQL injections sch�tzen */
$matrnr = mysqli_escape_string($mysqli, $_POST['matrnr']);

// Abrufen der id und des Passwortes aus der Datenbank
$sql = "SELECT * FROM praktikum WHERE Student_matrnr = '" . $matrnr . "'";
$result = mysqli_query($mysqli, $sql);
$rows = mysqli_num_rows($result);

if ($rows == 0) { // Benutzer existiert nicht
    $_SESSION['message'] = " Diese Matrikel-Nummer existiert nicht, bitte registrieren Sie sich zuerst!";
    
    header("location: error.php");
} else { // Benutzer existiert
    
    $student = mysqli_fetch_assoc($result);
    
    // $_SESSION['message'] = "Input :".$_POST['password']." In DB ".$student['Password'];
    if ($_POST['password'] = $student['Password']) {
        
        // Um zu wissen, dass der Benutzer eingeloggt ist
        $_SESSION['logged_in'] = true;
        
        // ist das Konto durch E-Mail Verify aktiviert?
        // $_SESSION['active'] = $student['active'];
        
        /*
         * TODO: bereits get�tigte Eintr�ge holen
         * 
         */
        
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
        
        /* Weiterleitung auf das Formular des Studenten */
        header("location: profile.php");
    } else {
        $_SESSION['message'] = "Du hast ein falsches Passwort eingegeben, versuche es erneut!";
        header("location: error.php");
    }
}
?>