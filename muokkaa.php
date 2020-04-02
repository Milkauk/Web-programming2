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
if (isset($_GET["muokattava"])){
	$muokattava=$_GET["muokattava"];
}

// valitaan tietokanta
$yhteys = mysqli_connect("127.0.0.1", "trtkm19b3", "trtkm19b3");
$tietokanta=mysqli_select_db($yhteys, "trtkm19b3");

//Miten toimitaan, jos ei ole saatu muokattavaa syÃ¶tettÃ¤
if (!isset($muokattava)){
	header("Location:poista.php");
	exit;
}
	
$sql="select * from milka19100_vieraskirja where id=?";
$stmt=mysqli_prepare($yhteys, $sql); 
mysqli_stmt_bind_param($stmt, 'i', $muokattava); 
mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if ($rivi=mysqli_fetch_object($tulos)){
?>
<h2>Tervetuloa vieraskirjaan!</h2>
<form action='paivita.php' method='post'>
<h2>
<input type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
Päivitettävän nimi: <input type='text' name='nimi' value='<?php print $rivi->nimi;?>' size="30" maxlength="30"/><br><br>
Päivitettävän tilaajanumero: <input type='text' name='tilaajanumero' value='<?php print $rivi->tilaajanumero;?>' size="15" maxlength="15"/><br><br>
Päivitettävän terveiset:<br>
<textarea name='terveiset' cols='50' rows='5'><?php print $rivi->terveiset;?></textarea><br>
Julkinen: <input type='text' name='julkinen' value='<?php print $rivi->julkinen;?>' ><br><br>
<input type='submit' name='ok' value='OK'> 
</h2>
</form>
<?php	
}

mysqli_stmt_close($stmt);
mysqli_close($yhteys);

?>

<br>
<a href="kirjakeidas.html">Etusivulle</a>
<br>
<a href="lomake.html">Kirjoita vieraskirjaan</a>

</body>
</html>