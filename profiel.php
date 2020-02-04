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

	$stmt = $conn->prepare('SELECT gebruikersnaam FROM gebruikers WHERE user_id = ?');
	$stmt->bind_param('s', $_SESSION['user_id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($gebruikersnaam);
	$stmt->fetch();

echo "Account-ID: " . $_SESSION['user_id'];
echo "<br> Gebruikersnaam: " . $gebruikersnaam;


} ?>

<br>
<form action="change_ww.php">
    <input type="submit" value="Verander wachtwoord" />
</form>



