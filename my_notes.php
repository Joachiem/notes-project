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
		</form>

// hier iets met foreach voor elke notitie van de gebruiker (bewerken en verwijderen)

<?php } ?>