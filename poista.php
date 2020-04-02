<!DOCTYPE html>
<html>
<head>
<title>Vieraskirja</title>
<meta charset='utf-8'>
<link href="etusivu.css" rel="StyleSheet" type="text/css" media="all" >
</head>
<body>
<h2>Vieraskirjan tekstien poisto ja muokkaus</h2>

<?php

// poistettavan syÃ¶tteen mÃ¤Ã¤rittely
if (isset($_GET["poistettava"])){
	$poistettava=$_GET["poistettava"];
}

// valitaan tietokanta
$yhteys = mysqli_connect("127.0.0.1", "trtkm19b3", "trtkm19b3");
$tietokanta=mysqli_select_db($yhteys, "trtkm19b3");

// miten toimitaan, jos poistettava-syÃ¶te on saatu
if (isset($poistettava)){
	$sql="delete from milka19100_vieraskirja where id=?";
	$stmt=mysqli_prepare($yhteys, $sql); 
	mysqli_stmt_bind_param($stmt, 'i', $poistettava); 
	mysqli_stmt_execute($stmt);
}


$tulos=mysqli_query($yhteys, "select * from milka19100_vieraskirja");

print "<table border='1'>\n"; 

print "<ol>";
while ($rivi=mysqli_fetch_object($tulos)){ 
	if ($rivi->julkinen==1) {
		print "<tr>\n"; 
		print "<td>$rivi->id<td>$rivi->nimi<td>$rivi->tilaajanumero<td>$rivi->terveiset<td>$rivi->aikaleima  ".
		"<td><a href='poista.php?poistettava=".$rivi->id."'>Poista</a>".
		"<td><a href='muokkaa.php?muokattava=".$rivi->id."'>Muokkaa</a>\n"; 
	}
} 

print "</ol>";
print "</table>\n";

?>
<br>
<a href="kirjakeidas.html">Etusivulle</a>
<br>
<a href="lomake.html">Kirjoita vieraskirjaan</a>

</body>
</html>