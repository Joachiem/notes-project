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
	$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
	$stmt = $conn->prepare('SELECT user_id FROM notities WHERE note_id = ?');
	$stmt->bind_param('s', $_GET['id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($user_id);
	$stmt->fetch();
	if ($_SESSION['user_id'] != $user_id) {
		die('Je hebt geen toestemming om deze notitie te bewerken!');
	}

	$stmt = $conn->prepare('UPDATE notities SET titel = ?,   ');
	$stmt->bind_param('sss', $_POST['titel'], $_POST['content'], $_GET['id']);
	$stmt->execute();