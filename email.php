<?php
/*
 * Überprüft die registrierte Benutzer-E-Mail, der Link zu dieser Seite
 * ist in der register.php E-Mail-Nachricht enthalten
 */
require 'db.php';
session_start();

// Make sure email variables aren't empty
if (isset($_GET['email']) && ! empty($_GET['email'])) {
    $email = $mysqli->escape_string($_GET['email']);
    
    // Select user with matching email , who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM praktikum WHERE email='$email'  AND active='0'");
    
    if ($result->num_rows == 0) {
        $_SESSION['message'] = "Sie haben ihr Konto bereits aktiviert oder die URL ist ungültig!";
        
        header("location: error.php");
    } else {
        $_SESSION['message'] = "Ihr Konto wurde aktiviert!";
        
        // Benutzerstatus wird auf aktiviert gesetzt (active = 1)
        $mysqli->query("UPDATE praktikum SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        
        header("location: success.php");
    }
} else {
    $_SESSION['message'] = "Ung&uuml;ltige Parameter für die Konto&uuml;berpr&uuml;fung!";
    header("location: error.php");
}
?>