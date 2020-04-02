<?php

if (isset($_POST["nimi"])){
	$nimi=$_POST["nimi"];
}
else{
	header("Location:lomake.html");
	exit;
}

if (isset($_POST["tilaajanumero"])){
	$tilaajanumero=$_POST["tilaajanumero"];
}
else{
	$tilaajanumero="";
}


if (isset($_POST["terveiset"])){
	$terveiset=$_POST["terveiset"];
}
else{
	$terveiset="";
}


$yhteys = mysqli_connect("127.0.0.1", "trtkm19b3", "trtkm19b3");

if (!$yhteys) {
	die("Tietokannan valinta epÃ¤onnistui: " . mysqli_connect_error());
}

$tietokanta=mysqli_select_db($yhteys, "trtkm19b3");
print "Tietokanta OK.";


$sql="insert into milka19100_vieraskirja(nimi, tilaajanumero, terveiset) values(?, ?, ?)"; 
$stmt=mysqli_prepare($yhteys, $sql); 
mysqli_stmt_bind_param($stmt, 'sis', $nimi, $tilaajanumero, $terveiset); 
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($yhteys);

?>