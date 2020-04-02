<?php

if (isset($_POST["nimi"])){
	$nimi=$_POST["nimi"];
}

if (isset($_POST["tilaajanumero"])){
	$tilaajanumero=$_POST["tilaajanumero"];
}

if (isset($_POST["terveiset"])){
	$terveiset=$_POST["terveiset"];
}

if (isset($_POST["id"])){
	$id=$_POST["id"];
}

if (isset($_POST["julkinen"])){
	$julkinen=$_POST["julkinen"];
}

// yhteys tietokantaan
$yhteys = mysqli_connect("127.0.0.1", "trtkm19b3", "trtkm19b3");

if (!$yhteys) {
	die("Tietokannan valinta epÃƒÂ¤onnistui: " . mysqli_connect_error());
}

// tietokannan valinta
$tietokanta=mysqli_select_db($yhteys, "trtkm19b3");
print "Tietokanta OK.";

$sql="update milka19100_vieraskirja set nimi=?, tilaajanumero=?, terveiset=?, julkinen=? where id=?"; 
$stmt=mysqli_prepare($yhteys, $sql); 
mysqli_stmt_bind_param($stmt, 'sisii', $nimi, $tilaajanumero, $terveiset, $julkinen, $id); 
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);
mysqli_close($yhteys);

header("Location:poista.php");
return;

?>