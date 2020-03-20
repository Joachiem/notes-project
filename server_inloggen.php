<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if (!isset($_POST['user_gn'], $_POST['user_ww'])) {
	die ("Vul alle velden in!");
}
if (empty($_POST['user_gn']) || empty($_POST['user_ww'])) {
	die ("Vul alle velden in!");
}

if ($stmt = $conn->prepare('SELECT user_id, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?')) {
	$stmt->bind_param('s', $_POST['user_gn']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	if (md5($_POST['user_ww']) == $password) {
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['user_id'] = $id;
		header('Location: profiel.php');
	} else {
		echo 'Het ingevoerde wachtwoord is niet juist!';
		?> <form action="inloggen.php">
					<input type="submit" value="GA TERUG" />
				</form> <?php
	}
} else {
	echo 'De ingevoerde gebruikersnaam bestaat niet in onze database!';
	?> <form action="inloggen.php">
					<input type="submit" value="GA TERUG" />
				</form> <?php
}



	$stmt->close();
}
