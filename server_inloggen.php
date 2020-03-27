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
	?> <form action="inloggen.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
		</div>
				</form> <?php
    die("De MySQL server kon niet bereikt worden.");
}
if (!isset($_POST['user_gn'], $_POST['user_ww'])) {
	?> <form action="inloggen.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
		</div>
				</form> <?php
	die ("Vul alle velden in!");
}
if (empty($_POST['user_gn']) || empty($_POST['user_ww'])) {
	?> <form action="inloggen.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
		</div>
				</form> <?php
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
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
		</div>
				</form> <?php
	}
} else {
	echo 'De ingevoerde gebruikersnaam bestaat niet in onze database!';
	?> <form action="inloggen.php">
		<div class="form-item">
					<input type="submit" value="GA TERUG" />
		</div>
				</form> <?php
}



	$stmt->close();
} ?>
</body>
</html>
