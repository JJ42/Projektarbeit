<?php
/*
 * Die error.php Datei, zeigt alle fehlermeldungen an. Es it ein
 * mit HTML formatiert und leitet einen zurück zur Startseite.
 */
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css_sammlung.html'; ?>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a href="index.php"><button class="btn btn-block">Zur&uuml;ck</button></a>
</div>
</body>
</html>
