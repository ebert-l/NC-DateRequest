<?php
//Ausgabe des Visuellen Inputs auf $clistatinp
/*
Variablen:
$dbid = VID
$ncvname = Volltext Name
$ncuser = UID
$ncemail = E-Mail
*/


$choice = "";
if (isset($_POST['choice'])){
$choice = $_POST['choice'];
$pushsql = "INSERT INTO Client (id, vname, user, email, status, vid) VALUES ('', '" .$ncvname. "', '" .$ncuser. "', '" .$ncemail. "', '" .$choice. "', '" .$dbid. "')";
// $go = mysqli_query($db, $pushsql);
$go = processSQL($pushsql);

$clistatinp = "Daten wurden gespeichert.";
}
else {
$clistatinp = '
<form action="#" method="post" id="'.$dbid.'" target="_self">
		<select name="choice" form="'.$dbid.'">
			<option value="1">Anwesend</option>
			<option value="2">Unsicher</option>
			<option value="3">Leider Abwesend</option>
		</select>
	<input type="submit" form="'.$dbid.'" value="speichern1" />
	<button type="submit">speichern2</button>
</form>
';
}

$clistatinp ='<a href="state.php?ncvname='.$ncvname.'&ncuser='.$ncuser.'&ncemail='.$ncemail.'&dbid='.$dbid.'">Status eingeben</a>' ;
?>
