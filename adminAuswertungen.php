<?php
error_reporting(E_ALL);
session_start();
require 'database_connection.php';
require 'adminFunction.php';

/*
 *
 *
 *
 *
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
				<li role="navigation"><a href="adminUnternehmen.php">Praktikumsunternehmen</a></li>
				<li role="navigation"><a href="adminPraktika.php">Praktikas</a></li>
				<li role="navigation" class="active"><a href="adminAuswertungen.php">Auswertungen</a></li>
				
			</ul>
				<p class="navbar-text">Angemeldet als <?php echo $_SESSION['adminTitel']." " . $_SESSION['adminVorname']." " .$_SESSION['adminName'];?></p>
				<form action="admin.php" method="post">
				<button name="logout" class="btn btn-default navbar-btn">Logout</button>
			</form>
			
			<!-- Erstellen des Seitentitels -->
			<div class="page-header">
				<h3>Auswertungen</h3>
			</div>

			<div class="panel panel-default">
				<form action="admin.php" method="post">
					<div class="panel-body">
						<div class="form-group">
							<label for="adminTitel" class="col-sm-2 control-label">Titel:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="adminTitel" class="form-control" type="text"
                            id="adminTitel" required="required" value="', isset($_SESSION['adminTitel']) ? $_SESSION['adminTitel'] : '', '">'?>	
							</div>
						</div>
						<div class="form-group">
							<label for="adminVorname" class="col-sm-2 control-label">Vorname:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="adminVorname" class="form-control" type="text"
                            id="adminVorname" required="required" value="', isset($_SESSION['adminVorname']) ? $_SESSION['adminVorname'] : '', '">'?>	
							</div>
						</div>
						<div class="form-group">
							<label for="adminName" class="col-sm-2 control-label">Name:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="adminName" class="form-control" type="text"
                            id="adminName" required="required" value="', isset($_SESSION['adminName']) ? $_SESSION['adminName'] : '', '">'?>	
							</div>
						</div>
						<div class="form-group">
							<label for="adminEmail" class="col-sm-2 control-label">E-Mail:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="adminEmail" class="form-control" type="email"
                            id="adminName" required="required" value="', isset($_SESSION['adminEmail']) ? $_SESSION['adminEmail'] : '', '">'?>	
							</div>
						</div>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</body>

</html>
