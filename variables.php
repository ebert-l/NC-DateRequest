<?php
// Feste Variablen
$ncvname = "";
$ncuser = "";
$ncemail = "";
$vid ="";

if (isset($_GET['name'])) {
    $ncvname = $_GET['name'];			//Voll Name -- transportiert �ber Nextcloud
}
if (isset($_GET['uid'])) {
    $ncuser = $_GET['uid'];				//Username -- transportiert �ber Nextcloud
}
if (isset($_GET['email'])) {
    $ncemail = $_GET['email'];			//EMail des Users -- transportiert �ber Nextcloud
}
if (isset($_GET['vid'])) {
    $vid = $_GET['vid'];				//ID der Veranstaltung
}
$pattern = "[ABCDEFGHIJKLMNOPQRSTUVXYZ���abcdefghijklmnopqrstuvwxyz���,.-! ]";
?>
