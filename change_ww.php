<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}

$stmt = $conn->prepare('SELECT gebruikersnaam FROM gebruikers WHERE user_id = ?');
  $stmt->bind_param('s', $_SESSION['user_id']);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($gebruikersnaam);
  $stmt->fetch();
  echo "Verander het wachtwoord van gebruiker: " . $gebruikersnaam;
?>

<form method="post" action="server_change_ww.php">
  <br>
  Huidige wachtwoord:<br>
  <input type="password" name="user_ww_old">
  <br>
  Nieuwe wachtwoord:<br>
  <input type="password" name="user_ww_new">
  <br>
  Herhaal nieuwe wachtwoord:<br>
  <input type="password" name="user_ww_new_2">
  <br><br>
  <input type="submit" value="Verander wachtwoord">
</form>