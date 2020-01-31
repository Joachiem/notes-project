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

echo "Account-ID: " . $_SESSION['user_id'];


} ?>

<br>
<form action="change_gn.php">
    <input type="submit" value="Verander gebruikersnaam" />
</form>
<form action="change_ww.php">
    <input type="submit" value="Verander wachtwoord" />
</form>



