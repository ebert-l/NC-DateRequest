<?php

$login = "";
if (isset($_COOKIE['ncsfcookie'])) {
$login = $_COOKIE['ncsfcookie'];
} else {
echo 'Bitte klicke auf "Neu laden".<br />
	Das ist eine Sicherheits&uuml;berpr&uuml;fung.<br/>
	Wenn du diese Seite auch noch nach dem Neuladen siehst, kontaktiere bitte den Admin.</br>
	<a href="javascript:location.reload()" target="_self">Neu laden</a><br />
';



//print_r($_COOKIE);
  die ("...");
}

if ($login == "true") {
echo "";
} else {
  die ("Not authorized");
}
echo '<div class="screen">Safe Connection</div>';
?>
