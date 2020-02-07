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
$titel = "Nieuwe notitie";
$stmt = $conn->prepare('INSERT INTO notities (user_id, titel) VALUES (?, ?)');
$stmt->bind_param('ss', $_SESSION['user_id'], $titel);
$stmt->execute();
header('Location: my_notes.php');
}