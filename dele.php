<?php
include 'db.php';
include 'variables.php';

$vid = $_POST['vid'];

echo '<link rel="stylesheet" href="style.css">';
include 'bheader.php';



if (isset($vid)){
	//DELETE FROM Veranst WHERE Veranst.vid = '"$vid"'
	//DELETE FROM Client WHERE Client.vid = '"$vid"'
	//DELETE FROM Bem WHERE Bem.vid = '"$vid"'
	
$vid = strip_tags($vid); // Löscht alle HTML und PHP Statements im String
$vid = trim($vid, " \t\n\r"); // Löscht alle white Spaces vor und nach dem Inhalt weg
	
	$veranst ="DELETE FROM Veranst WHERE Veranst.vid = '".$vid."'";
	// $push = mysqli_query($db, $veranst);
	$push = processSQL($veranst);
	$client ="DELETE FROM Client WHERE Client.vid = '".$vid."'";
	$push = processSQL($client);
	$bem ="DELETE FROM Client_Bem WHERE Client_Bem.vid = '".$vid."'";
	$push = processSQL($bem);
	
	echo '<p>Erledigt. Du wirst nie wieder etwas von der ID '.$vid.' h&ouml;ren.</p>';
} else {
echo '<p>Bitte geben Sie die Veranstaltungs-ID ein. Alle Daten die mit dieser Veranstaltung in Verbindung stehen werden gel&ouml;scht. Alle Status, Bemerkungen und Informationen.</p></br>';

$alert = "'Hast du SICHER die korrekte ID eingegeben? Und du bist dir sicher, dass alles weg kann?'";
echo '
<form action="#" method="post" id="1" target="_self" accept-charset="utf-8">
	<input type="text" pattern="'. $pattern .'" name="vid" form="1" required></input>
	<input type="checkbox" required>Ich habe die korrekte ID eingegeben und will alles unwiederruflich Entfernen.</input>
	<button type="submit" onclick="return confirm('.$alert.')">L&ouml;schen</button>
</form>

';
}
?>