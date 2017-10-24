<!-- Die index.php stellt die Startseite der Praktikumsdatenbank dar. 
Dort findet man das Login oder auch Registrierungsformular. 
Außerdem ist es möglich, ein neues Passwort festzulegen, sollte man sein altes vergessen haben. 

Der Administrator kann sich einloggen. -->

<?php
error_reporting(E_ALL);
/* Einbinden der Datenbank anbindung */
require 'database_connection.php';

/*
 * die Session wird gestartet, bis man sich wieder ausloogt.
 * TODO: wozu braucht man eine Session???
 */
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<title>Registrieren/Login</title>

<!-- einbinden der Layout-Dateien -->
  <?php include 'css/css_sammlung.html'; ?>
  
</head>
<?php 
/* 
 * Bedinungsprüfung, welches Formular benutzt wurde 
 * und an welche PHP Seite dadruch weitergeleitet 
 * werden soll. Es wird geprüft, welcher Button der 
 * drei Formulare abgesendet wurde und welche php Seite dadurch
 * eingebunden wird. 
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Studenten Login
    if (isset($_POST['login'])) { 
        require 'login.php';
    }
    // Studenten Registrierung
    elseif (isset($_POST['register'])) {
        require 'register.php';
    }
    // Admin Login
    elseif (isset($_POST['adminLogin'])) {
        require 'adminLogin.php';
    }
}
?>
<body>
	<div class="container">

		<!-- Erstellen eines Seitenbanners -->
		<div class="well">
			<h1>Online-Datenbank f&uuml;r die Bachelorstudieng&auml;nge IMIT und
				WINF</h1>
		</div>

		<!-- Hinweistext für die Studenten einfügen -->
		<div class="panel panel-default">
			<div class="page-header">
				<h2>Hinweise</h2>
			</div>

			<!-- Login und Registrieren Bereich -->
			<div class="container">
				<div class="form">

					<ul class="tab-group">
						<li class="tab"><a href="#register">Registrieren</a></li>
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
										name="matrnr" maxlength="6" size="6" class="form-control">
								</div>

								<div class="field-wrap">
									<label> Passwort<span class="req">*</span>
									</label> <input type="password" required autocomplete="off"
										name="password" maxlength="20" class="form-control">
								</div>

								<p class="forgot">
									<a href="forgot.php">Passwort vergessen?</a>
								</p>

								<button class="btn btn-block" name="login">Login</button>

							</form>

						</div>

						<!-- Formular zum erstmaligen registrieren in die Praktikumsdatenbank -->
						<div id="register">
							<h1>Registrieren</h1>

							<form action="index.php" method="post" autocomplete="off">

								<div class="top-row">
									<div class="field-wrap">
										<label> Matrikelnummer<span class="req">*</span>
										</label> <input type="text" required autocomplete="off"
											name='matrnr' class="form-control">

									</div>

									<div class="field-wrap">
										<label> Name<span class="req">*</span>
										</label> <input type="text" required autocomplete="off"
											name='student_name' class="form-control">
									</div>

									<div class="field-wrap">
										<label> Email Adresse<span class="req">*</span>
										</label> <input type="email" required autocomplete="off"
											name='student_email' class="form-control">
									</div>

									<div class="field-wrap">
										<label> Passwort setzen<span class="req">*</span>
										</label> <input type="password" required autocomplete="off"
											name='password' class="form-control">
									</div>

									<button class="btn btn-block" name="register">
										Registrieren</button>
								</div>


							</form>
						</div>
					</div>

				</div>

				<!-- Login-Bereich Administrator -->
				<div class="container">
					<div class="page-header">
						<h3>Login Administrator</h3>
					</div>

					<!-- Formular zum Anmelden des Administrators -->
					<form class="form-horizontal" action="index.php" method="post"
						autocomplete="off">

						<div class="form-group">
							<label for="adminNr">Zugangsnummer</label> <input type="text"
								name="adminNr" class="form-control" id="adminNr">
						</div>

						<div class="form-group">
							<label for="passwort">Passwort</label> <input type="password"
								name="passwort" class="form-control" id="passwort">
						</div>

						<div class="form-group">
							<button class="btn btn-block" name="adminLogin">Einloggen</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- JS einbinden -->
	<script
		src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script src="js/index.js"></script>

</body>
</html>

