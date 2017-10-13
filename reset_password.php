<?php
/* Passwort zurücksetzen, Datenbank wird mit neuem Nutzerpasswort aktualisiert */
require 'db.php';
session_start();

// Sicherstellen, ob das Fomular mit der method="post" abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Pruefen, ob die beiden Passwoerter uebereinstimmen
    if ($_POST['newpassword'] == $_POST['confirmpassword']) {
        
        $new_password = $_POST['newpassword'];
       
        $student_email = mysqli_real_escape_string($mysqli, $_POST['student_email']);
        
        //Praktikumsdatenbank wird aktulaisiert und das neue Passwort des Studenten gespeichert
        $sql = "UPDATE praktikum SET password='$new_password' WHERE Student_email='$student_email'";
        
        if (mysqli_query($mysqli, $sql)) {
            
            $_SESSION['message'] = "Dein Passwort wurde erfolgreich zur&uuml;ck gesetzt!";
            header("location: success.php");
        }
    } else {
        $_SESSION['message'] = "Die Passw&ouml;rter stimmen nicht &uuml;berein, bitte versuchen Sie es erneut!";
        header("location: error.php");
    }
}
?>