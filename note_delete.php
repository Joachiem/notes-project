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
	$stmt->bind_result($user_id, $note_id);
	$stmt->fetch();
		if (!$_SESSION['user_id'] == $user_id) {
			die('Je hebt geen toestemming om deze notitie te verwijderen!');
		}
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $conn->prepare('DELETE FROM notities WHERE note_id = ?');
            $stmt->bind_param('s', $note_id);
			$stmt->execute();
            header('Location: my_notes.php');
			} else {
				header('Location: my_notes.php');
			}
    } else {
    echo "Wil je deze notitie echt verwijderen?"; ?>
	<html>
	<a href="note_delete.php?id=<?php echo $_GET['id'] ?>&confirm=yes">Ja</a>
    <a href="note_delete.php?id=<?php echo $_GET['id'] ?>&confirm=no">Nee</a>
    </html>
<?php } 
} ?>