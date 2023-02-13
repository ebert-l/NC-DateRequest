<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
// 0.0 DEBUG
/* off
$url = $_SERVER['REQUEST_URI'];
echo $url ;
*/
// 1.0 Include
include 'db.php' ;
include 'musicians.php';

// 2.0 Load Data
$abfrage =  "SELECT vid, titel, datum, uhrzeit, Band, Straße, Ort, Bemerkung FROM Veranst ORDER BY datum ASC";
// $ergebnis = mysqli_query($db, $abfrage) ;	
$ergebnis = processSQL($abfrage) ;	
								//Data Load for Client Information and Print
$sqlins = "SELECT id, vname, user, email, status, vid FROM Client";
$sendclient = processSQL($sqlins) ;									//Data Push for User Interface
echo '<link rel="stylesheet" href="style.css">';
// 3.0 Front-End	Head
include 'bheader.php';

// 3.1 Table Start	ID Name Datum Uhrzeit Band Status
echo '
<div class="chooser"><a href="newv.php">Neue Veranstaltungsumfrage erstellen</a></div>
<div class="chooser"><a href="dele.php">Eine Veranstaltung l&ouml;schen</a></div>
<table>
	<tr>
		<th>
			ID:
		</th>
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
			Status:
		</th>
	</tr>
';

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
$dbid = $row['vid'];
$rtime = $row['uhrzeit'];
$vtime = substr($rtime, 0, 5);  // Convert into normal Time Format

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
$vdatey = substr($row['datum'], 0, 4);
$vdatem = substr($row['datum'], 5, 2);
$vdated = substr($row['datum'], 8, 2);
$vdate = ''.$vdated.'.'.$vdatem.'.'.$vdatey.'';

$str = $row['Straße'];
$ort = $row['Ort'];
$vbem = $row['Bemerkung'];


$clistatoutp = '<a href="print.php?vid='.$dbid.'&titel='.$row['titel'].'&datum='.$row['datum'].'&band='.$insband.'&uhr='.$vtime.'&str='.$str.'&ort='.$ort.'&vbem='.$vbem.'">Zusagen anzeigen</a>';

echo "<tr>";
echo "<td>";
echo $dbid;
echo "</td><td>";
echo $row['titel'];
echo "</td><td>";
echo $vdate;
//echo $row['datum'];
echo "</td><td>";
echo $vtime;
echo " Uhr";
echo "</td><td>";
echo $insband;
echo "</td><td>";
// echo $bgcolor;
echo $clistatoutp;
echo "</td></tr>";
}
?>