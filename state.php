<?php

// INSERT INTO Client (id, vname, user, email, status, vid) VALUES ('', '" .$ncvname. "', '" .$ncuser. "', '" .$ncemail. "', '" .$choice. "', '" .$dbid. "')";
include 'db.php' ;

//Variablen:
/*
$dbid = VID
$ncvname = Volltext Name
$ncuser = UID
$ncemail = E-Mail
*/

$name = $_GET['ncvname'];				//Voll Name -- transportiert �ber Nextcloud
$user = $_GET['ncuser'];				//Username -- transportiert �ber Nextcloud
$ncemail = $_GET['ncemail'];			//E-Mail
$verans = $_GET['dbid'];				//uid = vid = Veranstaltung transportiert �ber Edit Link

echo '<link rel="stylesheet" href="style.css">';
/* off
$url = $_SERVER['REQUEST_URI'];
echo $url ;
*/
$choices = $_POST['choices'];
$bem = $_POST['bem'];
/*
Variablen:
$name = Voll Name des Users
$user = User ID
$verans = V ID
*/

include 'cheader.php';
echo '<div class="chooser"><p>Bitte geben Sie Ihren Status f�r das Event Nr.: '.$verans.' an.</p>';

if (isset($choices)){
$sql = "INSERT INTO Client (id, vname, user, email, status, vid) VALUES ('', '" .$name. "', '" .$user. "', '" .$ncemail. "', '" .$choices. "', '" .$verans. "')";
processSQL($sql);


$clistatinp = "Daten wurden gespeichert.";
}
else {
$clistatinp = '
<form action="#" method="post" id="'.$verans.'" target="_self">
		<select name="choices" form="'.$verans.'">
			<option value="1">Anwesend</option>
			<option value="2">Unsicher</option>
			<option value="3">Leider Abwesend</option>
		</select><br />
	<button type="submit">Speichern</button>
</form>
';
}
//	Old Saving -- do not Use!  <input type="submit" form="'.$verans.'" value="speichern1" />

echo  '<html><body><p>';
echo  $clistatinp ;
echo  '</p>';
// echo '<p><a href="javascript:history.go(-2)">Zur&uuml;ck zur &Uuml;bersicht</a></p>';
echo '</div></body></html>';

?>