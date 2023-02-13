<?php

// PDATE `Client` SET `status` = '3' WHERE `Client`.`id` = 12;
include 'db.php' ;

$name = $_GET['name'];			//Voll Name -- transportiert �ber Nextcloud
$user = $_GET['uid'];				//Username -- transportiert �ber Nextcloud
$verans = $_GET['veranst'];			//uid = vid = Veranstaltung transportiert �ber Edit Link

echo '<link rel="stylesheet" href="style.css">';
/* Debug off
echo "TEst";
$url = $_SERVER['REQUEST_URI'];
*/
echo $url ;
$choices = $_POST['choices'];


/*
Variablen:
$name = Voll Name des Users
$user = User ID
$verans = V ID
*/

include 'cheader.php';

echo '<div class="chooser"><p>Bitte &auml;ndern Sie Ihren Status f�r das Event Nr.: '.$verans.'</p>';
if (isset($choices)){
$choices = strip_tags($choices); // L�scht alle HTML und PHP Statements im String
$choices = trim($choices, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg	

$sql = "UPDATE Client SET status = '".$choices."' WHERE Client.user ='".$user."' AND Client.vid ='".$verans."'";
// $ach = mysqli_query($db, $sql);
$ach = processSQL($sql);

$clistatinp = "Daten wurden gespeichert.";
}
else {
$clistatinp = '
<form action="#" method="post" id="'.$verans.'" target="_self" accept-charset="utf-8">
		<select name="choices" form="'.$verans.'">
			<option value="1">Anwesend</option>
			<option value="2">Unsicher</option>
			<option value="3">Leider Abwesend</option>
		</select>
	<button type="submit">Speichern</button>
</form>
';
}
//	Old Saving -- do not Use!  <input type="submit" form="'.$verans.'" value="speichern1" />

echo  '<html><body><p>';
echo  $clistatinp ;
echo  '</p>';
// echo '<p><a href="javascript:history.back()">Zur&uuml;ck zur &Uuml;bersicht</a></p>';
echo '</div></body></html>';

?>