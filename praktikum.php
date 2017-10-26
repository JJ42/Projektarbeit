<?php
error_reporting(E_ALL);
session_start();

/*
 * praktikum.php ist die Seite des eingeloggten Bereichs für Studenten.
 * Hier erscheint das Formular, zum Eintragen des Praktikums.
 * Nach einer Registrierung, sind nur Name, Matrikelnummer und Email des Studenten
 * ausgefüllt. Beim Login, werden die Daten, die bereits eingetragen wurden,
 * angezeigt.
 */
require 'database_connection.php';
if ($_SESSION['logged_in'] == true) {
    
    // Datumsformat bestimmen
    $datetime = getdate(time());
    
    // Praktikumunternehmen auswählen welche aktiv sind
    $companies[0]["Id"] = 0;
    $companies[0]["Name"] = "Bitte ausw&auml;hlen";
    $sql = 'SELECT DISTINCT Id, Name, URL from praktunter where aktiv="1" order by Name';
    $result = mysqli_query($mysqli, $sql);
    for ($lauf = 1; $lauf <= mysqli_num_rows($result); $lauf ++) {
        $row = mysqli_fetch_row($result);
        $companies[$lauf]["Id"] = $row[0];
        $companies[$lauf]["Name"] = utf8_encode($row[1]);
        $companies[$lauf]["URL"] = $row[2];
    }
} else {
    $_SESSION['message'] = "Du musst eingeloggt sein!";
    header("location: error.php");
}
?>

<!-- Anzeigen des Formulars, zum eintragen des Praktikums -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hallo</title>
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

		<!-- Erstellen eines Seitenbanners -->
		<div class="well">
			<h1>Online-Datenbank f&uuml;r die Bachelorstudieng&auml;nge IMIT und
				WINF</h1>
		</div>


		<div class="panel panel-default">
			<form action="praktikum.php" method="post">



				<!-- Pers�nliche Daten des Studenten -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Pers&ouml;nliche Daten</h3>
					</div>
					<div class="panel-body">

						<!-- Studentenname -->
						<div class="form-group">
							<label for="student_name" class="col-sm-2 control-label">Name:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="student_name" class="form-control" type="text"
                            id="student_name" required="required" value="', isset($_SESSION['student_name']) ? $_SESSION['student_name'] : '', '">'?>	
						</div>
						</div>

						<!-- Matrikelnummer -->
						<div class="form-group">
							<label for="matrnr" class="col-sm-2 control-label">Matrikel-Nr.:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="matrnr" class="form-control" type="text"
                            id="matrnr" required="required" value="', isset($_SESSION['matrnr']) ? $_SESSION['matrnr'] : '', '">'?>
						</div>
						</div>

						<!-- Studenten Email -->
						<div class="form-group">
							<label for="student_email" class="col-sm-2 control-label">E-mail:</label>
							<div class="col-sm-10">
									<?php
        echo '<input name="student_email" class="form-control" type="text"
                            id="student_email" required="required" value="', isset($_SESSION['student_email']) ? $_SESSION['student_email'] : '', '">'?>
						</div>
						</div>

						<!-- Telefonnummer des Studenten -->
						<div class="form-group">
							<label for="student_phone" class="col-sm-2 control-label">Telefon:</label>
							<div class="col-sm-10">
									<?php
        echo '<input name="student_phone" class="form-control" type="text"
                            id="student_phone" required="required" value="', isset($_SESSION['student_phone']) ? $_SESSION['student_phone'] : '', '">'?>
						</div>
						</div>
					</div>
				</div>

				<!-- Einstellen des Praktikumszeitraumes -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Praktikumszeitraum</h3>
					</div>
					<div class="panel-body">

						<!-- Anfangsdatum -->

						<div class="form-group">
							<label for="date" class="col-sm-2 control-label">Beginn:</label>
							<div class="col-sm-10">
								<select class="form-control" name="day">
							<?php
    
    // TODO: Kalender einbauen!!!!
    $lastselection = isset($_SESSION['day']) ? $_SESSION['day'] : $datetime['mday'];
    for ($i = 1; $i <= 31; $i ++) {
        echo '        <option value="', $i, ($i == $lastselection) ? '" selected>' : '">', date("d", mktime(0, 0, 0, 1, $i, 1)), '</option>', "\n";
    }
    ?>
                        							</select> <select class="form-control"
									name="month">
                        							<?php
                            
                            $lastselection = isset($_SESSION['month']) ? $_SESSION['month'] : $datetime['mon'];
                            for ($i = 1; $i <= 12; $i ++) {
                                echo '        <option value="', $i, ($i == $lastselection) ? '" selected>' : '">', strftime("%b", mktime(0, 0, 0, $i, 1, 1)), '</option>', "\n";
                            }
                            ?>
							</select> <select class="form-control" name="year">
							<?php
    $selection = isset($_SESSION['year']) ? $_SESSION['year'] : $datetime['year'];
    $min_year = $datetime["year"] - 2;
    for ($i = $min_year; $i <= $min_year + 3; $i ++) {
        echo '        <option value="', ($i == $selection) ? '" selected>' : '">', $i, '</option>', "\n";
    }
    ?>
							</select>

							</div>
						</div>

						<!-- End Datum -->
						<div class="form-group">
							<label for="endDate" class="col-sm-2 control-label">Ende:</label>
							<div class="col-sm-10">

								<select class="form-control" name="endDay">
							<?php
    
    // TODO: Kalender einbauen!!!!
    $lastselection = isset($_SESSION['endDay']) ? $_SESSION['endDay'] : $datetime['mday'];
    for ($i = 1; $i <= 31; $i ++) {
        echo '        <option value="', $i, ($i == $lastselection) ? '" selected>' : '">', date("d", mktime(0, 0, 0, 1, $i, 1)), '</option>', "\n";
    }
    ?>
							</select> <select class="form-control" name="endMonth">
							<?php
    $lastselection = isset($_SESSION['endMonth']) ? $_SESSION['endMonth'] : $datetime['mon'];
    for ($i = 1; $i <= 12; $i ++) {
        echo '        <option value="', $i, ($i == $lastselection) ? '" selected>' : '">', strftime("%b", mktime(0, 0, 0, $i, 1, 1)), '</option>', "\n";
    }
    ?>
							</select> <select class="form-control" name="endYear">
							<?php
    $selection = isset($_SESSION['endYear']) ? $_SESSION['endYear'] : $datetime['endYear'];
    $min_year = $datetime["year"] - 2;
    for ($i = $min_year; $i <= $min_year + 3; $i ++) {
        echo '        <option value="', ($i == $selection) ? '" selected>' : '">', $i, '</option>', "\n";
    }
    ?>
							</select>
							</div>
						</div>

						<!-- Dauer des Praktikums in Wochen -->
						<div class="form-group">
							<label for="duration" class="col-sm-2 control-label">Dauer in
								Wochen:</label>
							<div class="col-sm-10">
								<?php
        echo '<input name="duration" class="form-control" type="text"
                            id="duration" required="required" value="', isset($_SESSION['duration']) ? $_SESSION['duration'] : '', '">'?>
						</div>
						</div>
					</div>
				</div>

				<!-- Informationen �ber das Unternehmen -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Das Praktikumsunternehmen</h3>
					</div>
					<div class="panel-body">

						<!-- Unternehmensname -->
						<div class="form-group">
							<label for="company" class="col-sm-2 control-label">Unternehmen:</label>
							<div class="col-sm-10">
								<select name="company" class="form-control">
							<?php
    $lastselection = isset($_SESSION['company']) ? $_SESSION['company'] : "";
    
    foreach ($companies as $oneCompany) {
        echo '        <option value="', $oneCompany["Id"], ($oneCompany["Id"] == $lastselection) ? '" selected>' : '">', $oneCompany["Name"], '</option>', "\n";
    }
    ?>		
							</select>
							</div>
						</div>

						<!-- Unternehmensabteilung -->
						<div class="form-group">
							<label for="department" class="col-sm-2 control-label">Abteilung:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="department" class="form-control" type="text"
                            id="department" required="required" value="', isset($_SESSION['department']) ? $_SESSION['department'] : '', '">'?>						
						</div>
						</div>

						<!-- Stadt des Unternehmens -->
						<div class="form-group">
							<label for="town" class="col-sm-2 control-label">Einsatzort:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="town" class="form-control" type="text"
                            id="town" required="required" value="', isset($_SESSION['town']) ? $_SESSION['town'] : '', '">'?>
						</div>
						</div>
					</div>
				</div>

				<!-- Informationen den Unternehmensbetreuer -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Betreuer seitens des Unternehmens</h3>
					</div>

					<!-- Unternehmensbetreuer -->
					<div class="panel-body">
						<div class="form-group">
							<label for="tutor_company_name" class="col-sm-2 control-label">Betreuer:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="tutor_company_name" class="form-control" type="text"
                            id="tutor_company_name" required="required" value="', isset($_SESSION['tutor_company_name']) ? $_SESSION['tutor_company_name'] : '', '">'?>
						</div>
						</div>

						<!-- Betreuer E-Mail -->
						<div class="form-group">
							<label for="tutor_company_email" class="col-sm-2 control-label">E-Mail:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="tutor_company_email" class="form-control" type="text"
                            id="tutor_company_email" required="required" value="', isset($_SESSION['tutor_company_email']) ? $_SESSION['tutor_company_email'] : '', '">'?>
						</div>
						</div>

						<!-- Unternehmens telefon -->
						<div class="form-group">
							<label for="tutor_company_phone" class="col-sm-2 control-label">Telefon:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="tutor_company_phone" class="form-control" type="text"
                            id="tutor_company_phone" required="required" value="', isset($_SESSION['tutor_company_phone']) ? $_SESSION['tutor_company_phone'] : '', '">'?>
						</div>
						</div>

					</div>
				</div>

				<!-- Informationen �ber das Praktikum -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Informationen zum Praktikum</h3>
					</div>
					<div class="panel-body">

						<!-- Praktikumstitel -->
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Kurztitel:</label>
							<div class="col-sm-10">
							<?php
    echo '<input name="title" class="form-control" type="text"
                            id="title" required="required" value="', isset($_SESSION['title']) ? $_SESSION['title'] : '', '">'?>
						</div>
						</div>

						<!-- Inhalt des Praktikums -->
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">Inhalt
								des Praktikums:</label>
							<div class="col-sm-10">
						
						<?php
    echo '<textarea name="description" class="form-control" rows="6"
							id="description" required="required">';
    echo $_SESSION['description'];
    echo '</textarea>';
    
    ?>
							</div>
						</div>

					</div>
				</div>
				<button class="btn btn-block" name="save">Speichern</button>
				<button class="btn btn-block" name="logout">Logout</button>
			</form>
		</div>
	</div>
</body>
</html>
