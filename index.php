<?php
/* Hauptseite, mit zwei Varianten: Registrieren oder Einloggen 
 * 
 * TESTESTTEST
 * 
 * 
 * */
require 'db.php'; // Einbinden der Datanbankverbindung
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Registrieren/Login</title>
  <?php include 'css/css.html'; ?>
  
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) { // Benutzer Login
        
        require 'login.php';
    } elseif (isset($_POST['register'])) { // Benutzer Registrierung
        
        require 'register.php';
    }
}
?>
<body>

	<!--  Überschrift der Startseite -->
	<div class="container-fluid">
		<div class="well">
			<h2>Online-Datenbank f&uuml;r Praktika in den BSc-Studieng&auml;ngen
				IMIT und WINF</h2>
		</div>

		<!-- Hinweisfeld für die Studenten -->
		<div class="jumbotron">
			<h3>Hinweise:</h3>

			<div class="container">

				Nachdem Sie eine Zusage f&uuml;r einen Praktikumsplatz erhalten
				haben, tragen Sie sich bitte umgehend hier in der Online-Datenbank
				ein.<br> Auf Grundlage dieser Datenbank erfolgt:

				<ul>
					<li>Die Vermittlung eines Praktikumsbetreuers seitens der
						Universit&auml;t</li>
					<li>die Einladung zum Praktikumskolloquium und</li>
					<li>die Erstellung des Leistungsnachweises</li>
					
<!-- TODO: verlinkung email formular um direkt eine Mail zu verschicken -->
				</ul>
				Der Eintrag hier erstetzt <b>nicht</b> den schriftlichen
				Praktikumsbericht.<br> Bei technischen Problemen wenden Sie sich bitte an den
				Praktikumsbeauftragten Felix Hahne (hahne@uni-hildesheim.de)

			</div>
		</div>
		<br>
	</div>
	<div class="form">

		<ul class="tab-group">
			<li class="tab"><a href="#signup">Registrieren</a></li>
			<li class="tab active"><a href="#login">Login</a></li>
		</ul>

		<div class="tab-content">

			<div id="login">
				<h1>Willkommen!</h1>
				<!-- Formular zum Einloggen, wenn man bereits registriert ist -->
				<form action="index.php" method="post" autocomplete="off">

					<div class="field-wrap">
						<label> Matrikel-Nummer<span class="req">*</span>
						</label> <input type="text" required autocomplete="off"
							name="matrnr" maxlength="6" size="6">
					</div>

					<div class="field-wrap">
						<label> Passwort<span class="req">*</span>
						</label> <input type="password" required autocomplete="off"
							name="password" maxlength="20">
					</div>

					<p class="forgot">
						<a href="forgot.php">Passwort vergessen?</a>
					</p>

					<button class="btn btn-block" name="login">Login</button>

				</form>

			</div>
			
			<!-- Formular zum erstmaligen registrieren in die Praktikumsdatenbank -->
			<div id="signup">
				<h1>Registrieren</h1>

				<form action="index.php" method="post" autocomplete="off">

					<div class="top-row">
						<div class="field-wrap">
							<label> Matrikelnummer<span class="req">*</span>
							</label> 
							<input type="text" required autocomplete="off"
								name='matrnr'>
								
						</div>

						<div class="field-wrap">
							<label> Name<span class="req">*</span>
							</label> <input type="text" required autocomplete="off"
								name='student_name'>
						</div>

						<div class="field-wrap">
							<label> Email Adresse<span class="req">*</span>
							</label> <input type="email" required autocomplete="off"
								name='student_email'>
						</div>

						<div class="field-wrap">
							<label> Passwort setzen<span class="req">*</span>
							</label> <input type="password" required autocomplete="off"
								name='password'>
						</div>

						<button class="button button-block" name="register">
							Registrieren</button>
					</div>
				</form>
			</div>
		</div>

	</div>
	<!-- tab-content -->


	<!-- /form -->
	<script
		src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script src="js/index.js"></script>

</body>
</html>
