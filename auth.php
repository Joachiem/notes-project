<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if (!isset($_POST['user_ww']) || !$_POST['user_gn']) { 
	die("Vul alle velden in!");
	} elseif (!isset($_POST['user_gn']) || !$_POST['user_ww']) {
	die("Vul alle velden in!");
}

if ($stmt = $conn->prepare('SELECT user_id, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['user_gn']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	if (md5($_POST['user_ww'], $password)) {
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['gb'] = $_POST['user_gn'];
		$_SESSION['user_id'] = $id;
		echo $_SESSION['gb'] . ' is succesvol ingelogd!';
	} else {
		echo 'Het ingevoerde wachtwoord is niet juist!';
	}
} else {
	echo 'De ingevoerde gebruikersnaam bestaat niet in onze database!';
}



	$stmt->close();
}
