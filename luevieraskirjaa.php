<!DOCTYPE html>
<html>
<head>
<title>Vieraskirja</title>
<meta charset='utf-8'>
<link href="etusivu.css" rel="StyleSheet" type="text/css" media="all" >
</head>
<body>
<h2>Tervetuloa lukemaan vieraskirjaa!</h2>

<?php
$yhteys = mysqli_connect("127.0.0.1", "trtkm19b3", "trtkm19b3");
$tietokanta=mysqli_select_db($yhteys, "trtkm19b3");
$tulos=mysqli_query($yhteys, "select * from milka19100_vieraskirja");

print "<table border='1'>\n"; 
while ($rivi=mysqli_fetch_object($tulos)){ 
	if ($rivi->julkinen==0) {
		print "<tr>\n"; 
		print "<td>$rivi->id<td>$rivi->nimi<td>$rivi->tilaajanumero<td>$rivi->terveiset<td>$rivi->aikaleima\n"; 
	}
} 
print "</table>\n";

?>
<br>
<a href="kirjakeidas.html">Etusivulle</a>
<br>
<a href="lomake.html">Kirjoita vieraskirjaan</a>

</body>
</html>