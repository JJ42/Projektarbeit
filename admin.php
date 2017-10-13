<?php
?>

<!DOCTYPE html>
<html>
<head>
<title>Administrator</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
	<div class="container">
		<br>
		<!-- Erstellen des Seitenbanners -->
		<div class="well">
			<h2>
				Praktikumsdatenbank <br> <small>Administrationsseite</small>
			</h2>
		</div>

		<!-- Erstellen der Navigationsleiste -->
		<div class="navbar navbar-default navbar-static-top">
			<ul class="nav nav-tabs">
				<li role="presentation"><a href="dashbord_dozent.jsp">Einträge
						ansehen</a></li>
				<li role="presentation"><a href="profil.jsp">Daten eintragen</a></li>
				<li role="presentation"><a href="kurse_erstellung.jsp">Einträge
						exportieren</a></li>
				<li role="presentation" class="active"><a
					href="kurse_auswertungen.jsp">Auswertungen</a></li>
				<a href="logout.php"><button class="btn btn-default" name="logout">Logout</button></a>
			</ul>
			
			<!-- Erstellen des Seitentitels -->
			<div class="page-header">
				<h3></h3>
			</div>

		</div>
	</div>
</body>
</html>