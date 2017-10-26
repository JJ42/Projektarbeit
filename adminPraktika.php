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
				<li role="navigation" class="active"><a href="adminPraktika.php">Praktikas</a></li>
				<li role="navigation"><a href="adminAuswertungen.php">Auswertungen</a></li>

			</ul>
			<p class="navbar-text">Angemeldet als <?php echo $_SESSION['adminTitel']." " . $_SESSION['adminVorname']." " .$_SESSION['adminName'];?></p>
			<form action="admin.php" method="post">
				<button name="logout" class="btn btn-default navbar-btn">Logout</button>
			</form>

			<!-- Erstellen des Seitentitels -->
			<div class="page-header">
				<h3>Praktika Liste</h3>
			</div>

			<div class="panel panel-default">
				<form action="admin.php" method="post">
					<div class="panel-body">
						<?php 
						// Abfragen der aktiven Praktikumsunternehmen
						$sql = 'SELECT Id, Student_name, Student_matrnr, Company, Department, Town, Day, Month, Year, Angelegt, Kolloquium from praktikum order by angelegt DESC';
						$result = mysqli_query($mysqli, $sql);
						$daten = mysqli_num_rows($result);
						$felder = mysqli_num_fields($result);
						
						echo '<table class="table table-striped">';
						echo '<tr>';
						for ($j = 0; $j <= $felder - 1; $j ++) {
						    echo '<td>' . (mysqli_fetch_field_direct($result, $j)->name) . '</td>';
						}
						echo '</tr>';
						
						while ($zeile = mysqli_fetch_array($result)) {
						    echo '<tr>';
						    for ($j = 0; $j < $felder - 1; $j ++) {
						        echo "<td>" . $zeile[$j] . "</td>";
						    }
						    echo "</tr>";
						}
						echo '</table>';
						
						?>
					</div>
				</form>
			</div>

		</div>
	</div>
</body>

</html>
