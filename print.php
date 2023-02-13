<?php
include 'db.php';
$vid = $_GET['vid'];

$titel = $_GET['titel'];
$datum = $_GET['datum'];
$band = $_GET['band'];
$uhr = $_GET['uhr'];
$str = $_GET['str'];
$ort = $_GET['ort'];
$vbem = $_GET['vbem'];
/*off
$url = $_SERVER['REQUEST_URI'];
echo $url ;
*/
echo '<link rel="stylesheet" href="style.css">';

include 'cheader.php';
include 'musicians.php';

//Convert Date Formate
$vdatey = substr($datum, 0, 4);
$vdatem = substr($datum, 5, 2);
$vdated = substr($datum, 8, 2);
$vdate = ''.$vdated.'.'.$vdatem.'.'.$vdatey.'';

//Create Database Command for Musician Sort
$zahl = count($sax);
$num = count($sax);
$up = 0;
$saxo = "";

while($zahl > 0){
if ($zahl == $num){
} else { 
$saxo .= " OR Client.user = ";
$osaxo .= " AND Client.user != ";
};
$saxo .= "'" . $sax[$up] . "'";
$osaxo .= "'" . $sax[$up] . "'";
$up = $up + 1;
$zahl = $zahl - 1 ;
};										// Created $saxo List

$zahl = count($rythem);
$num = count($rythem);
$up = 0;
$rythems = "";

while($zahl > 0){
if ($zahl == $num){
} else { 
$rythems .= " OR Client.user = ";
$orythems .= " AND Client.user != ";
};
$rythems .= "'" . $rythem[$up] . "'";
$orythems .= "'" . $rythem[$up] . "'";
$up = $up + 1;
$zahl = $zahl - 1 ;
};										// Created $rythems List

$zahl = count($trombone);
$num = count($trombone);
$up = 0;
$trombones = "";

while($zahl > 0){
if ($zahl == $num){
} else { 
$trombones .= " OR Client.user = ";
$otrombones .= " AND Client.user != ";
};
$trombones .= "'" . $trombone[$up] . "'";
$otrombones .= "'" . $trombone[$up] . "'";
$up = $up + 1;
$zahl = $zahl - 1 ;
};										// Created $trombones List

$zahl = count($trumpet);
$num = count($trumpet);
$up = 0;
$trumpets = "";

while($zahl > 0){
if ($zahl == $num){
} else { 
$trumpets .= " OR Client.user = ";
$otrumpets .= " AND Client.user != ";
};
$trumpets .= "'" . $trumpet[$up] . "'";
$otrumpets .= "'" . $trumpet[$up] . "'";
$up = $up + 1;
$zahl = $zahl - 1 ;
};										// Created $trumpets List

$zahl = count($vocal);
$num = count($vocal);
$up = 0;
$vocals = "";

while($zahl > 0){
if ($zahl == $num){
} else { 
$vocals .= " OR Client.user = ";
$ovocals .= " AND Client.user != ";
};
$vocals .= "'" . $vocal[$up] . "'";
$ovocals .= "'" . $vocal[$up] . "'";
$up = $up + 1;
$zahl = $zahl - 1 ;
};										// Created $vocals List

$others = "" .$ovocals. " AND Client.user != " .$otrumpets. " AND Client.user != " .$otrombones. " AND Client.user != " .$orythems. " AND Client.user != " .$osaxo. "" ;
//echo $others ;


echo '
<div class="screen" style="margin-left:4%;"><a class="screen" href="javascript:self.print()">Seite drucken</a></div>
<h3 style="margin-left:4%;">'.$titel.'</h3>
<div class="top">
<div class="info">
<p>'.$band.'<br />
'.$vdate.'<br />
'.$uhr.' Uhr</p></div>

<div class="info">
<p>
'.$str.'<br />
'.$ort.'<br />
</p>
</div>
<div class="info">
<p>
Zus&auml;tzliche Info:<br />
'.$vbem.'
</p>
</div>
</div>

<div class="musician">
<h3>Vocals</h3>
</div>
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';

//SELECT `vname`, `email`, `status`, `vid` FROM `Client` WHERE Client.vid = '2' AND (Client.user = 'Leon' OR Client.user = 'Stefan' OR Client.user = 'Frank') ORDER By status ASC


//Vocals
$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user = ".$vocals.") ORDER BY status ASC";		
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>";	// While Ende

//Trumpets
echo '
<h3 class="musician">Trumpets</h3>
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';


$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user = ".$trumpets.") ORDER BY status ASC";
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>"; 	// While Ende


//Trombones
echo '
<h3 class="musician">Trombones</h3>
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';


$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user = ".$trombones.") ORDER BY status ASC";
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>"; 	// While Ende


//Saxo
echo '
<h3 class="musician">Saxophones</h3>
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';


$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user = ".$saxo.") ORDER BY status ASC";
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>"; 	// While Ende


//Rythem
echo '
<h3 class="musician">Groove</h3>
</br><table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';


$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user = ".$rythems.") ORDER BY status ASC";
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>"; 	// While Ende



//Other
echo '
<h3 class="musician">Other</h3>
<table>
	<tr>
		<th>
			Name:
		</th>
		<th>
			E-Mail:
		</th>
		<th>
			Zusage:
		</th>
		<th>
			Bemerkung:
		</th>
	</tr>
';


$daten = "SELECT vname, user, email, status, vid FROM Client WHERE Client.vid = '".$vid."' AND (Client.user != ".$others." ) ORDER BY status ASC";
$aufruf = mysqli_query($db, $daten);
$vstatus = "";
while ($output = mysqli_fetch_object($aufruf))
{
$name = $output->vname;
$email = $output->email;
$status = $output->status;
$user = $output->user;
$vstatus = "";

if ($status == "1") {
$vstatus = "Zusage";
$tdclass = '';
} elseif ($status == "2") {
$tdclass = ' class="unsicher"';
$vstatus = "Unsicher";
} elseif ($status == "3") {
$tdclass = ' class="abwesend"';
$vstatus = "Absage";
}

$bemdaten = "SELECT bem FROM Client_Bem WHERE Client_Bem.vid = '".$vid."' AND Client_Bem.user = '".$user."'";
$callbem = mysqli_query($db, $bemdaten);
$bem = "";
while ($bemerkung = mysqli_fetch_object($callbem))
{
$bem = $bemerkung->bem;
}



echo "<tr>";
echo "<td" . $tdclass . ">";
echo $name;
echo "</td><td" . $tdclass . ">";
echo $email;
echo "</td><td" . $tdclass . ">";
echo $vstatus;
echo "</td><td" . $tdclass . ">";
echo $bem;
echo "</td></tr>";

}  
echo "</table>"; 	// While Ende

?>