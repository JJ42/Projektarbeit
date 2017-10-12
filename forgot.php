<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $sql = "SELECT * FROM users WHERE Student_email='$email'";
    $result = mysqli_query($mysqli, $sql);
    $rows = mysqli_num_rows($result);

    if ( $rows == 0 ) // Der Nutzer exisitiert nicht
    { 
        $_SESSION['message'] = "Ein Benutzer mit dieser Email exisitert nicht!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $student = mysqli_fetch_assoc($result); // $student becomes array with user data
        
        $email = $student['email'];
       
        $student_name = $studnet['student_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Bitte &uuml;berprüfe deine Email <span>$email</span>"
        . " um das Passwort endg&uuml;ltig zur&uuml;ck zusetzen!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link ( clevertechie.com )';
        $message_body = '
        Hello '.$first_name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/Praktikum_db/reset.php?email='.$email;  

        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    
  <div class="form">

    <h1>Passwort zur&uuml;cksetzen</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email-Adresse<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block">Reset</button>
    </form>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
