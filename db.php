<?php
$db = new mysqli("", "", "", ""); // Host, User, PW, Name || Momentan ist das die TEST Datenbank
if(!$db) {
	exit("Verbindungsfehler: ".mysqli_connect_error());
} 

function processSQL($string){
	global $db;
	mysqli_real_query($db, $string);
	return mysqli_store_result($db);
}

include 'safe.php';
?>
