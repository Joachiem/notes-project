<?php
session_start();
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if (!$_SESSION['loggedin'] == TRUE) {
			header('Location: inloggen.php');
}
	require 'config/settings.php';
	$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
	$stmt = $conn->prepare('SELECT titel, inhoud, user_id FROM notities WHERE note_id = ?');
	$stmt->bind_param('s', $_GET['id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($titel, $inhoud, $user_id);
	$stmt->fetch();
	if ($_SESSION['user_id'] != $user_id) {
		die('Je hebt geen toestemming om deze notitie te bekijken!');
	}

?>
<html>
<form action="server_save_note.php" method="post">
        
        <label>Naam:</label><br>
        <textarea name="titel"><?php echo $titel; ?></textarea><br>

        <label>Note:</label><br>
        <textarea name="content"><?php echo $inhoud; ?></textarea><br>
    
        <button type="submit">OPSLAAN</button>
    </div>
</form>
</html>