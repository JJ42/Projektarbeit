<?php
error_reporting(E_ALL);
session_start();
/* 
 * Login.php prüft ob der Benutzer bereits existiert und die Eingaben
 * korrekt sind. Sind sie es, werden die Daten aus der Datenbank abgerufen
 * und es findet eine Weiterleitung auf die Benutzerseite statt.
 * */
require 'database_connection.php';


// $_POST Variable gegen SQL Injection schützen
$adminNr = mysqli_escape_string($mysqli, $_POST['adminNr']);

// Abrufen des Datensatzes aus der Datenbank
$sql = "SELECT * FROM administrator WHERE Admin_nr = '" . $adminNr . "'";
$result = mysqli_query($mysqli, $sql);
$rows = mysqli_num_rows($result);

if ($rows == 0) { // Administrator existiert nich
    $_SESSION['message'] = "Sie haben keine Administratoren rechte";
    header("location: error.php");
} else { // Admin existiert
    
    $admin = mysqli_fetch_assoc($result);
    
    if ($_POST['adminPasswort'] == $admin['Admin_passwort']) {
        
        // Benutzer ist eingeloggt
        $_SESSION['logged_in'] = true; 
        
        // Benutzerdaten holen
        $_SESSION['adminNr'] = $admin['Admin_Nr'];
        $_SESSION['adminName'] = $admin['Admin_name'];
        $_SESSION['adminVorname'] = $admin["Admin_vorname"];
        $_SESSION['adminTitel'] = $admin["Admin_titel"];
        $_SESSION['adminEmail'] = $admin["Admin_email"];
        
        header("location: admin.php");
    } else {
        $_SESSION['message'] = "Das Passwort ist falsch, bitte versuche es erneut!";
        header("location: error.php");
    }
}
?>
