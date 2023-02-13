<?php
include 'db.php';
include 'cheader.php';
include 'variables.php';
echo '<link rel="stylesheet" href="style.css">';

$user = $_GET['user'];			//Voll Name -- transportiert �ber Nextcloud
$bem = $_POST['bem'];



if (isset($bem)) {
$bem = strip_tags($bem); // L�scht alle HTML und PHP Statements im String
$bem = trim($bem, " \t\n\r"); // L�scht alle white Spaces vor und nach dem Inhalt weg
	
$upbef ="INSERT INTO Client_Bem (id, vid, user, bem ) VALUES ('', '".$vid."', '".$user."', '".$bem."')";
processSQL($upbef);
//$sql = mysqli_query($db, $upbef);
echo '<div class="chooser"><p>Daten wurden gespeichert.</p></div>';
} else {
echo '<div class="chooser"><p>Bitte geben Sie Ihre Bemerkung f�r das Event Nr.: '.$vid.' ein.';
echo '
<form action="#" method="post" id="'.$vid.'" target="_self" accept-charset="utf-8">
		<input type="text" name="bem" pattern="'.$pattern.'" form="'.$vid.'"></input>
	<button type="submit">Speichern</button>
</form>
';
}
// echo  '</p><p><a href="javascript:history.go(-2)">Zur&uuml;ck zur &Uuml;bersicht</a></p></div></body></html>';

?>