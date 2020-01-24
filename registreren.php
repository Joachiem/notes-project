<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
?>

<form method="post" action="server_registreren.php">
  <br>
  Gebruikersnaam:<br>
  <input type="text" name="user_gn">
  <br>
  Wachtwoord:<br>
  <input type="password" name="user_ww">
  <br>
  Herhaal wachtwoord:<br>
  <input type="password" name="user_ww2">
  <br><br>
  <input type="submit" value="Registreren">
</form>