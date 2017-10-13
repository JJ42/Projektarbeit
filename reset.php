<?php
/* Das Passwort-Reset-Formular, der Link zu dieser Seite ist enthalten
   in der forgot.php E-Mail Nachricht
*/
require 'db.php';
session_start();

// Pr�fen, ob die E-Mail Variablen gef�llt sind
if( isset($_GET['student_email']) && !empty($_GET['student_email']))
{
    $student_email = mysqli_real_escape_string($mysqli, $_GET['student_email']);
    

    // Pr�fen ob Benutzeremail existiert
    $sql = "SELECT * FROM praktikum WHERE Student_email='$student_email' ";
    $result = mysqli_query($mysqli, $sql);
    $rows = mysqli_num_rows($result);

    if ( $rows == 0 )
    { 
        $_SESSION['message'] = "Sie haben eine ung&uuml;ltige URL.!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Entschuldigen Sie, die &Uuml;berpr&uuml;fung ist fehlgeschlagen, bitte versuchen sie es erneut!";
    header("location: error.php");  
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Passwort zur&uuml;cksetzen</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">

          <h1>W&auml;hle ein neues Passwort</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              Neues Passwort<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Neues Passwort best&auml;tigen<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="student_email" value="<?= $student_email ?>">    
            
              
          <button class="button button-block">Best&auml;tigen</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
