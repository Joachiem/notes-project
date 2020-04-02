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
<!DOCTYPEhtml>
<html>
<meta charset="UTF-8">
	<head>
		<link rel="stylesheet" type="text/css" href="style/reset.css">
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<script src="scripts/darkmode.js"></script>
	</head>
	<body id="body" class="dark-mode">
		<ul class="navbar">
			<li><a href="profiel.php">Mijn Profiel</a></li>
			<li id="right"><a href="uitloggen.php">Uitloggen</a></li>
		</ul>
		<button type="button" class="darkmode" name="dark_light" onclick="toggleDarkLight()" title="Toggle dark/light mode">🌛</button>
		<form action="server_create_note.php">
			<input class="submit" type="submit" value="NIEUWE NOTITIE MAKEN" />
		</form><br>
		<h2>MIJN NOTITIES:</h2>
		<table>
			  <tr>
				<th>Nr.</th>
				<th>Titel</th>
				<th></th> 
				<th></th>
			  </tr>
<?php }
	$x = 1;
	$data = mysqli_query($conn,"SELECT note_id, titel FROM notities WHERE user_id = " . $_SESSION['user_id']);
	while ($notes = mysqli_fetch_assoc($data)) { ?> <tr>
				<td><?php echo $x; ?>.</td>
				<td><?php echo $notes['titel']; ?></td>
				<td><a href="note_edit.php?id=<?php echo $notes['note_id']; ?>">Bewerken</a></td>
			    <td><a href="note_delete.php?id=<?php echo $notes['note_id']; ?>">Verwijderen</a></td>
				</tr>
				<br>
				<?php
				$x++;
	}
	?>	</table>
	</body>
</html>