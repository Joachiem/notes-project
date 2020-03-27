<html>
<meta charset="UTF-8">
	<head>
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="scripts/darkmode.js"></script>
	</head>
	<body id="body" class="dark-mode">
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button><br>

<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
	?> <form action="registreren.php">
			<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
    die("De MySQL server kon niet bereikt worden.");
}
if (!isset($_POST['user_gn'], $_POST['user_ww'], $_POST['user_ww2'])) {
	?> <form action="registreren.php">
			<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	die ("Vul alle velden in!");
}
if (empty($_POST['user_gn']) || empty($_POST['user_ww']) || empty($_POST['user_ww2'])) {
	?> <form action="registreren.php">
			<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	die ("Vul alle velden in!");
}

if ($_POST['user_ww'] == $_POST['user_ww2']) {
	if ($stmt = $conn->prepare('SELECT user_id, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?')) {
		$stmt->bind_param('s', $_POST['user_gn']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			echo "De ingevoerde gebruikersnaam bestaat al, kies een andere gebruikersnaam!";
			?> <form action="registreren.php">
			<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
		} else {
			if ($stmt = $conn->prepare('INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)')) {
				$password = md5($_POST['user_ww']);
				$stmt->bind_param('ss', $_POST['user_gn'], $password);
				$stmt->execute();
				echo 'U heeft zich succesvol geregistreerd, u kan nu inloggen!';
				?> <form action="inloggen.php">
				<div class="form-item">
					<input type="submit" value="INLOGGEN" />
				</div></form> <?php
			} else {
				echo "Er is een fout opgetreden tijdens het verwerken van uw registratie, probeer het later opnieuw!";
				?> <form action="registreren.php">
				<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
			}
		}
		$stmt->close();
	} else {
		echo "Er is een fout opgetreden tijdens het verwerken van uw registratie, probeer het later opnieuw!";
		?> <form action="registreren.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	}
	$conn->close();
} else {
	echo "De ingevulde wachtwoorden komen niet overeen!";
	?> <form action="registreren.php">
	<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
}
?> </body> </html>