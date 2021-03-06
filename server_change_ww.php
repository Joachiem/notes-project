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
    die("De MySQL server kon niet bereikt worden.");
}

if (!$_SESSION['loggedin'] == TRUE) {
	header('Location: inloggen.php');
} else {

	if (!isset($_POST['user_ww_old'], $_POST['user_ww_new'], $_POST['user_ww_new_2'])) {
		?> <form action="change_ww.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	die ("Vul alle velden in!");
	}
	if (empty($_POST['user_ww_old']) || empty($_POST['user_ww_new']) || empty($_POST['user_ww_new_2'])) {
		?> <form action="change_ww.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	die ("Vul alle velden in!");
	}

	if ($_POST['user_ww_new'] !== $_POST['user_ww_new_2']) {
		?> <form action="change_ww.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	die ("De nieuwe ingevulde wachtwoorden komen niet overeen.");
	}

	$stmt = $conn->prepare('SELECT wachtwoord FROM gebruikers WHERE user_id = ?');
	$stmt->bind_param('s', $_SESSION['user_id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($server_ww_old);
	$stmt->fetch();
	if (md5($_POST['user_ww_old']) == $server_ww_old) {
		$md5 = md5($_POST['user_ww_new']);
		$stmt = $conn->prepare('UPDATE gebruikers SET wachtwoord = ? WHERE user_id = ?');
		$stmt->bind_param('ss', $md5, $_SESSION['user_id']);
		$stmt->execute();
		echo "Het wachtwoord is succesvol gewijzigd!";
		?> <form action="profiel.php">
		<div class="form-item">
					<input type="submit" value="NAAR MIJN PROFIEL" />
				</div></form> <?php
	} else {
		echo "Het ingevoerde oude wachtwoord is onjuist";
		?> <form action="change_ww.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
				</div></form> <?php
	}

}?>
</body>
</html>