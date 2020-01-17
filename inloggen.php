<?php
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
?>

<form action="/sv_inloggen.php">
  <br>
  Gebruikersnaam:<br>
  <input type="text" name="user_gn">
  <br>
  Wachtwoord:<br>
  <input type="password" name="user_ww">
  <br><br>
  <input type="submit" value="Inloggen">
</form>