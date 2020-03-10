<?php
session_start();
require 'config/settings.php';
$conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("De MySQL server kon niet bereikt worden.");
}
if (!$_SESSION['loggedin'] == TRUE) {
			header('Location: inloggen.php');
		} else { ?>
<br>
		<form action="server_create_note.php">
				<input type="submit" value="NIEUWE NOTITIE MAKEN" />
		</form><br>

<?php } 
	$data = mysqli_query($conn,"SELECT note_id, titel FROM notities WHERE user_id = " . $_SESSION['user_id']);
	while ($notes = mysqli_fetch_assoc($data)) {
				echo $notes['titel']; ?> 
				<a href="note_edit.php?id=<?php echo $notes['note_id']; ?>">Bewerken</a> 
			    <a href="note_delete.php?id=<?php echo $notes['note_id']; ?>">Notitie verwijderen</a>
				<br>
				<?php
				
			//}
	}
	?></table>