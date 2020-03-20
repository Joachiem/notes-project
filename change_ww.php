<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}

if (!$_SESSION['loggedin'] == TRUE) {
			header('Location: inloggen.php');
		}

$stmt = $conn->prepare('SELECT gebruikersnaam FROM gebruikers WHERE user_id = ?');
  $stmt->bind_param('s', $_SESSION['user_id']);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($gebruikersnaam);
  $stmt->fetch();
  echo "Verander het wachtwoord van gebruiker: " . $gebruikersnaam;
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
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button>
		<form method="post" action="server_change_ww.php">
			<div class="form-item">
				<label>Huidig wachtwoord</label>
				<div class="input-wrapper">
					<input type="password" name="user_ww_old">
				</div>	
			</div>
			<div class="form-item">
				<label>Nieuw wachtwoord<label>
				<div class="input-wrapper">
					<input type="password" name="user_ww_new">
				</div>	
			</div>
			<div class="form-item">
				<label>Herhaal nieuw wachtwoord</label>
				<div class="input-wrapper">
					<input type="password" name="user_ww_new_2">
				</div>
			</div>
			<input class="submit" type="submit" value="VERANDER WACHTWOORD">
		</form>
	</body>	
</html>
