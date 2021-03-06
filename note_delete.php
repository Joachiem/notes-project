<!DOCTYPEhtml>
<html>
<meta charset="UTF-8">
	<head>
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="scripts/darkmode.js"></script>
	</head>
	<body id="body" class="dark-mode">
	<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button><br>
	
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

if (isset($_GET['id'])) {
    $stmt = $conn->prepare('SELECT user_id, note_id FROM notities WHERE note_id = ?');
    $stmt->bind_param('s', $_GET['id']);
	$stmt->execute();
    $stmt->store_result();
	$stmt->bind_result($owner, $note_id);
	$stmt->fetch();
	
	if ($_SESSION['user_id'] == $owner) {
	echo "Wil je deze notitie echt verwijderen?<br>"; 
	?>
	<br><a href="note_delete.php?id=<?php echo $_GET['id'] ?>&confirm=yes">Ja</a>
    <a href="note_delete.php?id=<?php echo $_GET['id'] ?>&confirm=no">Nee</a>
    <?php
	} else {
		header('Location: my_notes.php');
	}
    
	if (isset($_GET['confirm'])) {
			if ($_GET['confirm'] == 'yes') {
            $stmt = $conn->prepare('DELETE FROM notities WHERE note_id = ?');
            $stmt->bind_param('s', $note_id);
			$stmt->execute();
            header('Location: my_notes.php');
			} elseif ($_GET['confirm'] == 'no') {
			header('Location: my_notes.php');
			}
    }
} ?>
</body>
</html>