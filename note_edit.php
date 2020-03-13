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
	
	$stmt = $conn->prepare('SELECT titel, inhoud, user_id FROM notities WHERE note_id = ?');
	$stmt->bind_param('s', $_GET['id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($titel, $inhoud, $user_id);
	$stmt->fetch();
	if ($_SESSION['user_id'] != $user_id) {
		header('Location: my_notes.php');
	}

?>
<!DOCTYPEhtml>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="scripts/darkmode.js"></script>
	</head>
	<body id="body" class="dark-mode">
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button>
		<form action="server_save_note.php?id=<?php echo $_GET['id'] ?>" method="post">
			<div class="form-item">
				<label>Naam:</label>
				<div class="input-wrapper">
					<textarea name="titel"><?php echo $titel; ?></textarea>
				</div>	
			</div>	
			<div class="form-item">
				<label>Note:</label>
				<div class="input-wrapper">
					<textarea name="content"><?php echo $inhoud; ?></textarea>
				</div>
			</div>
			<button type="submit">OPSLAAN</button>
	</form>
	</body>
</html>