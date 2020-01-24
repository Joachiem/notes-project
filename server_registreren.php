<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if (!isset($_POST['user_gn'], $_POST['user_ww'], $_POST['user_ww2'])) {
	die ("Vul alle velden in!");
}
if (empty($_POST['user_gn']) || empty($_POST['user_ww']) || empty($_POST['user_ww2'])) {
	die ("Vul alle velden in!");
}

if ($_POST['user_ww'] == $_POST['user_ww2']) {
	if ($stmt = $conn->prepare('SELECT user_id, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?')) {
		$stmt->bind_param('s', $_POST['user_gn']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			echo "De ingevoerde gebruikersnaam bestaat al, kies een andere gebruikersnaam!";
		} else {
			if ($stmt = $conn->prepare('INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)')) {
				$password = md5($_POST['user_ww']);
				$stmt->bind_param('ss', $_POST['user_gn'], $password);
				$stmt->execute();
				echo 'U heeft zich succesvol geregistreerd, u kan nu inloggen!';
			} else {
				echo "Er is een fout opgetreden tijdens het verwerken van uw registratie, probeer het later opnieuw!";
			}
		}
		$stmt->close();
	} else {
		echo "Er is een fout opgetreden tijdens het verwerken van uw registratie, probeer het later opnieuw!";
	}
	$conn->close();
} else {
	echo "De ingevulde wachtwoorden komen niet overeen!";
}
