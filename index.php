<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if ($_SESSION['loggedin'] == TRUE) {
			header('Location: profiel.php');
		} else {
			header('Location: inloggen.php');
}