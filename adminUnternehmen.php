<?php
error_reporting(E_ALL);
session_start();
require 'database_connection.php';
require 'adminFunction.php';

/*
 * adminUnternhmen.php ist für die administration der Praktikumsunternehmen.
 * hier kann der eingeloggte Administrator Daten der Unternehmen
 * ändern, löschen, aktivieren/deaktivieren oder neue Unternehmen hinzufügen
 */

?>

<!-- Anzeigen der Adminseite -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin</title>
  <?php include 'css/css_sammlung.html'; ?>
</head>
<?php
// Prüfen, welcher Button betätigt wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Speichern
    if (isset($_POST['save'])) {
        require 'save.php';
    } // Logout
elseif (isset($_POST['logout'])) {
        require 'logout.php';
    }
}
?>
<body>
	<div class="container">
		<!-- Erstellen des Seitenbanners -->
		<div class="well">
			<h1>
				Praktikumsdatenbank<small>Administratorenseite</small>
			</h1>
		</div>



		<!-- Erstellen der Navigationsleiste -->
		<div class="navbar navbar-default navbar-static-top">
			<ul class="nav nav-tabs">
				<li role="navigation"><a href="admin.php">Mein Profil</a></li>
				<li role="navigation" class="active"><a href="adminUnternehmen.php">Praktikumsunternehmen</a></li>
				<li role="navigation"><a href="adminPraktika.php">Praktikas</a></li>
				<li role="navigation"><a href="adminAuswertungen.php">Auswertungen</a></li>

			</ul>
			<p class="navbar-text">Angemeldet als <?php echo $_SESSION['adminTitel']." " . $_SESSION['adminVorname']." " .$_SESSION['adminName'];?></p>
			<form action="admin.php" method="post">
				<button name="logout" class="btn btn-default navbar-btn">Logout</button>
			</form>

			<!-- Erstellen des Seitentitels -->
			<div class="page-header">
				<h3>Praktikumsunternehmen</h3>
			</div>



			<div class="container">
				<div class="form">

					<ul class="tab-group">
						<li class="tab"><a href="#deaktiv">Deaktiv</a></li>
						<li class="tab active"><a href="#aktiv">Aktiv</a></li>
					</ul>

					<div class="tab-content">
						<div id="aktiv">
							<form action="adminUnternehmen.php" method="post">

								<div class="panel panel-default">
									<div class="panel-body"></div>


								</div>


								<button class="btn btn-block" name="save">Speichern</button>

							</form>

						</div>

						<!-- Formular zum erstmaligen registrieren in die Praktikumsdatenbank -->
						<div id="deaktiv">
							<form action="adminUnternehmen.php" method="post">

								<div class="panel panel-default">
									<div class="panel-body"></div>


								</div>

								<button class="btn btn-block" name="save">Speichern</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script
		src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script src="js/index.js"></script>
</body>

</html>
