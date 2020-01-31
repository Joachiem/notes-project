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
	<head>
		<link rel="stylesheet" type="text/css" href="style/main.css">
	</head>
	<body>
		<div class="container">
			<h1>Notes.</h1>
			<form method="post" action="server_inloggen.php">
				<br>Gebruikersnaam:<br>
				<input type="text" name="user_gn">
				<br>Wachtwoord:<br>
				<input type="password" name="user_ww">
				<br><br>
				<input type="submit" value="Inloggen">
			</form>
		</div>	
	</body>	
</html>