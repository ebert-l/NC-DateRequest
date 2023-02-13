<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <link rel="stylesheet" href="style.css">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
    </head>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


/* �bersicht:
1.0 Include
2.0 Load Data
3.0 Front-End
	3.1 Table Start
	3.2 User Interface
		3.2.1 Save Data
		3.2.2 Update Data
	3.3	Print Data
*/
// 0.0 DEBUG
/* off
$url = $_SERVER['REQUEST_URI'];
echo $url ;
*/
// 1.0 Include
include 'db.php' ;
include 'variables.php' ;

// 2.0 Load Data
$abfrage =  "SELECT vid, titel, datum, uhrzeit, Band, Straße, Ort, Bemerkung FROM Veranst WHERE datum >= DATE(CURRENT_DATE) ORDER BY datum ASC";
$ergebnis = processSQL($abfrage);
// $ergebnis = mysqli_query($db, $abfrage) ;									//Data Load for Client Information and Print
$sqlins = "SELECT id, vname, user, email, status, vid FROM Client";
$sendclient = processSQL($sqlins);
// $sendclient = mysqli_query($db, $sqlins) ;									//Data Push for User Interface
// 3.0 Front-End	Head
include 'cheader.php';

// 3.1 Table Start	ID Name Datum Uhrzeit Band Status
echo '';

// 3.2 User Interface
/*
All HTML and SQL for correct implementing a Status Feedback from the Client
*/

// 3.2.2 Save and Get Data
/*
Information:
Der User soll �ber Dropdown oder Radiobutton seine Statusmeldung abgeben.
Dabei soll ein "onclick" bzw. "onchange" stattfinden welcher dann automatisch einen SQL INSERT schreibt.
ABER der Code muss nun die Datenbank durchsuchen nach Eintragungen von ncuser bez�glich der vid und falls ja -
keinen INSERT mehr schreiben sondern den Betroffenen Datensatz UPDATEn

Das komplette Interface falls m�glich �ber eine Variable ausgeben

Also:

Datenbank "Client" �berpr�fen nach bereits existierendem Datensatz
Feld benennen
User Input erfassen

*/

// 3.3 Print Data
// ----------------- WHILE ----------------------------
while($row = mysqli_fetch_assoc($ergebnis))
{
$dbid = $row['vid'];				//dbid ist die Veranstaltungs ID
$rtime = $row['uhrzeit'];			//rtime ist die Datenbank Uhrzeit
$vtime = substr($rtime, 0, 5);  // Convert into normal Time Format
$vdatey = substr($row['datum'], 0, 4);
$vdatem = substr($row['datum'], 5, 2);
$vdated = substr($row['datum'], 8, 2);
$vdate = ''.$vdated.'.'.$vdatem.'.'.$vdatey.'';

$rband = $row['Band'];			// Turn Numbers into Text
if ($rband == "1"){
$insband = "Big Band";
}
elseif ($rband == "2"){
$insband = "Swing Kids";
}
elseif ($rband == "3"){
$insband = "Swing Dance";
}
$str = $row['Straße'];
$ort = $row['Ort'];
$vbem = $row['Bemerkung'];


// 3.2.2 Save and Get Data
// ----------------- USER INTERFACE -----------------
$userpush = "SELECT status FROM Client WHERE (Client.user = '".$ncuser."') AND (Client.vid = '".$dbid."')" ;
$recstate = processSQL($userpush) ;								//Search for the State, UPDATE the State, INSERT the State
$done = "2";									//Um zu testen ob die Schleife startet oder nicht
$dosomestatus = "0";
$clistatoutp = "";							// Reset Data
// while ($whilestat = mysqli_fetch_object($recstate))
while ($whilestat = mysqli_fetch_assoc($recstate))
{

$dosomestatus = $whilestat['status'];
$done = "1";									//TEst ob die Schleife gestartet ist
if ($dosomestatus == "1") {
$clistatoutp = "Ja";
// $clistatoutp .= "  ";
// $clistatoutp .= $dbid;
include 'client_update.php';					//Ausgabe des Visuellen Inputs auf $clistatinp
// UPDATE falls etwas ge�ndert werden soll
} elseif ($dosomestatus == "2") {
$clistatoutp = "Unsicher";
//$clistatoutp .= "  ";
//$clistatoutp .= $dbid;
include 'client_update.php';					//Ausgabe des Visuellen Inputs auf $clistatinp
// UPDATE falls etwas ge�ndert werden soll
} elseif ($dosomestatus == "3") {
$clistatoutp = "Nein" ;
//$clistatoutp .= "  ";
//$clistatoutp .= $dbid;
include 'client_update.php';					//Ausgabe des Visuellen Inputs auf $clistatinp
// UPDATE falls etwas ge�ndert werden soll
}
// $clistatoutp = $whilestate['status;
$dosomestatus = "0"; // Reset Data
}
if ($done == "2"){
include 'client_insert.php';					// Wenn kein Datensatz existiert -- die Pr�fung ob die Schleife startet oder nicht
}


//Bemerkung Interface
$bembef ="SELECT bem FROM Client_Bem WHERE Client_Bem.user = '".$ncuser."' AND Client_Bem.vid = '".$dbid."'";
// $bemaus = mysqli_query($db, $bembef);
$bemaus = processSQL($bembef);

$donebem = "2";
$bemout = "";
$beminp ="";
// while($bemdat = mysqli_fetch_object($bemaus)) {
while($bemdat = mysqli_fetch_assoc($bemaus)) {
$donebem = "1";
$bemout = $bemdat['bem'];
include "bem_update.php";
}
if ($donebem == "2") {
include "bem_insert.php";
}

$liste = '<a href="print.php?vid='.$dbid.'&titel='.$row['titel'].'&datum='.$row['datum'].'&band='.$insband.'&uhr='.$vtime.'&str='.$str.'&ort='.$ort.'&vbem='.$vbem.'">&#9432;&nbsp;Infos</a>';

// ---------------- END USER INTERFACE ---------------
// <div class="termin" nein>
//   <div class="upper"><span class="id">15</span>
//   <span class="title">Vatertags Jazz</span>
//   <span class="date">15.03.2013</span>
//     <span class="time">16:00 Uhr</span>
//     <span class="band">IKS Big Band</span></div>
//   <div class="lower">
//   <span class="status">Status</span>
//   <span class="bem">Bemerkung</span>
//   <span class="info">Info</span>
//   </div>
// </div>


echo '<div class="termin" ' . $clistatoutp . '>';
echo '<div class="upper"><span class="id">'. $dbid .'</span>';
echo '<span class="title">'. $row['titel'] .'</span>';			//Titel
echo '<span class="date">'. $vdate .'</span> ';
echo '<span class="time">'. $vtime .' Uhr</span>';
echo '<span class="band">'. $insband .'</span></div>';
echo '<div class="lower">';
echo '<span class="status">'. $clistatoutp . $clistatinp . '</span>';
echo '<span class="bem">'. $bemout . $beminp .'</span>';
echo '<span class="info">'. $liste .'</span>';
echo '</div></div>';

// Reset DATA
$clistatoutp ="";
$liste ="";
}
// ----------------- END WHILE -----------------------

?>
