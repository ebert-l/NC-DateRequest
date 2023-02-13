<?php
/* off
$url = $_SERVER['REQUEST_URI'];
echo $url ;

*/
include 'db.php';
include 'variables.php';

$name = $_POST['name'];
$datum = $_POST['datum'];
$zeit = $_POST['zeit'];
$band = $_POST['band'];
$str = $_POST['str'];
$ort = $_POST['ort'];
$vbem = $_POST['vbem'];


echo '<link rel="stylesheet" href="style.css">';
// 3.0 Front-End	Head
include 'bheader.php';

if (isset($band)){
$name = strip_tags($name); // L�scht alle HTML und PHP Statements im String
$name = trim($name, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$datum = strip_tags($datum); // L�scht alle HTML und PHP Statements im String
$datum = trim($datum, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$zeit = strip_tags($zeit); // L�scht alle HTML und PHP Statements im String
$zeit = trim($zeit, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$band = strip_tags($band); // L�scht alle HTML und PHP Statements im String
$band = trim($band, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$str = strip_tags($str); // L�scht alle HTML und PHP Statements im String
$str = trim($str, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$ort = strip_tags($ort); // L�scht alle HTML und PHP Statements im String
$ort = trim($ort, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
$vbem = strip_tags($vbem); // L�scht alle HTML und PHP Statements im String
$vbem = trim($vbem, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg

$befehl ="INSERT INTO Veranst (vid, titel, datum, uhrzeit, Band, Straße, Ort, Bemerkung) VALUES ('', '".$name."', '".$datum."', '".$zeit."', '".$band."', '".$str."', '".$ort."', '".$vbem."')";
$push = processSQL($befehl);

echo '<div class="chooser"><p>Gespeichert!</p>';
echo 'Bitte Seite neu Laden.</div>';
} else {
echo '<div class="chooser"><p>Bitte geben Sie alle Daten ein<br />Erlaubte Zeichen A-Z, a-z, 0-9, ., !, ,</p></div>';
}
/* var erlaubt = "1234567890,+*-/()";
* var regexp = /[^$erlaubt]/;
* var formval = document.rechner.line.value;
* var ergebnis= regexp.exec(formval);

pattern="[A-Za-z0-9!., ]+
*/

echo '
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			Datum:
		</th>
		<th>
			Uhrzeit:
		</th>
		<th>
			Band:
		</th>
		<th>
			Stra&szlig;e (Str. + Nr.):
		</th><th>
			Ort (PLZ + Ort):
		</th><th>
			Bemerkung:
		</th><th>
			Speichern:
		</th>
	</tr>
';
echo '
<tr>
<form action="#" method="post" id="1" target="_self" accept-charset="utf-8">
	<td><input type="text" pattern="'. $pattern .'" name="name" form="1"></input></td>
	<td><input type="date" name="datum" form="1"></input></td>
	<td><input type="time" name="zeit" form="1"></input></td>
	<td><select name="band" form="1">
		<option value="1">Big Band</option>
		<option value="2">Swing Kids</option>
		<option value="3">Swing Dance</option>
	</select></td>
	<td><input type="text" pattern="'. $pattern .'" name="str" form="1"></input></td>
	<td><input type="text" pattern="'. $pattern .'" name="ort" form="1"></input></td>
	<td><input type="text" pattern="'. $pattern .'" name="vbem" form="1"></input></td>
	<td><button type="submit">Speichern</button></td>
</form>
</tr>
';


?>
