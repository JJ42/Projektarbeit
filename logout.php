<?php
error_reporting(E_ALL);
/* Log out process, unsets and destroys session variables */
//session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Error</title>
  <?php include 'css/css_sammlung.html'; ?>
</head>

<body>
	<div class="form">
		<h1>Danke, dass Sie da waren!</h1>

		<p><?= 'Du hast dich erfolgreich ausgeloggt!'; ?></p>

		<a href="index.php"><button class="button button-block">Home
			</button></a>

	</div>
</body>
</html>
