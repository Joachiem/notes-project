<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
?>

<!DOCTYPEhtml>
<html>
<meta charset="UTF-8">
	<head>
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="scripts/darkmode.js"></script>
	</head>
	<body id="body" class="dark-mode">
	<ul class="navbar">
			<li><a href="registreren.php">Registreren</a><li>
		</ul>
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button>
		<h1>Notes.</h1>
		<form method="post" action="server_inloggen.php">
			<div class="form-item">
				<label>Gebruikersnaam</label>
				<div class="input-wrapper">
					<input type="text" name="user_gn">
				</div>
			</div>
			<div class="form-item">
				<label>Wachtwoord</label>
				<div class="input-wrapper">
					<input type="password" name="user_ww">
				</div>
			</div>
			<input class="submit" type="submit" value="INLOGGEN">
		</form>	
	</body>	
</html>