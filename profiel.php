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
	<body class="dark-mode">
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button>
		<?php
		if (!$_SESSION['loggedin'] == TRUE) {
			header('Location: inloggen.php');
		} else {
			$stmt = $conn->prepare('SELECT gebruikersnaam FROM gebruikers WHERE user_id = ?');
			$stmt->bind_param('s', $_SESSION['user_id']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($gebruikersnaam);
			$stmt->fetch();

			echo "Account-ID: " . $_SESSION['user_id'];
			echo "<br> Gebruikersnaam: " . $gebruikersnaam;
		}
		?>
		<br>
		<form action="change_ww.php">
			<div class="form-item">
				<input class="verander-wachtwoord" type="submit" value="VERANDER WACHTWOORD" />
			</div>	
		</form>
        <br>
		<form action="my_notes.php">
			<div class="form-item">
				<input class="......" type="submit" value="MIJN NOTITIES" />
			</div>	
		</form>
</html>