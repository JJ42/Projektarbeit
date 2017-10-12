<?php
/* 
 * Diese Seite überprüft die Eingaben und aktualisiert die Eingaben in der Datenbank 
 * Erst wird geprüft ob jedes Feld gefüllt ist und ob die Eingabebedinungen eingehalten wurden
 * danach wird durch einen SQL Befehl, der Datensatz in der Datenbank gespeichert
 */
require 'db.php';

$day = mysqli_escape_string($mysqli, $_POST['day']);

//$day = $_POST["day"];
$_SESSION['message'] = "Input :".$_POST['day']." In DB ";
header("location: error.php");

/* $id = $_POST["id"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$endDay = $_POST["endDay"];
$endMonth = $_POST["endMonth"];
$endYear = $_POST["endYear"];
$duration = $_POST["duration"];
$company = $_POST["company"];
$department = utf8_encode($_POST["department"]);
$tutor_company_name = utf8_encode($_POST["tutor_company_name"]);
$tutor_company_email = utf8_encode($_POST["tutor_company_email"]);
$tutor_company_phone = utf8_encode($_POST["tutor_company_phone"]);
$tutor_uni_name = utf8_encode($_POST["tutor_uni_name"]);
$student_name = utf8_encode($_POST["student_name"]);
$student_matrnr = utf8_encode($_POST["student_matrnr"]);
$student_email = utf8_encode($_POST["student_email"]);
$student_phone = utf8_encode($_POST["student_phone"]);
$description = utf8_encode($_POST["description"]);
$title = utf8_encode($_POST["title"]);
$town = utf8_encode($_POST["town"]);
//$Password = utf8_encode($_POST["Password"]); */

/* speicher Vorgang in der DB */
//if ($_POST['save']) {
    /* überprüfen ob alle Felder gefüllt sind */
     
//} else {
  //  $_SESSION['message'] = "Es wurden nicht alle Felder korrekt ausgef&uuml;llt, bitte kontrollieren Sie ihre Eingaben.";
    //header("location: error.php");
//}

//$save = "UPDATE praktikum SET" . "Day='" . $_POST['day'] . "'";
//$result = mysqli_query($mysqli, $save);

//$_SESSION['message'] = " Deine Daten wurden erfolgreich gespeichert!"; 
?>