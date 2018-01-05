<?php 
include "../includes/head.php";
include "../includes/navbar_admin.php";
const PICDIR = "../media";

?>
<div class='col-sm-9 text-center'> 
			<div class='panel panel-info text-center'>
			<div class='panel-heading text-center'>Modifica Produse</div>
			<div class='panel-body'>
<?php
$errors = false;
if (empty($_POST['denumire']))
{
	echo "<p><h4>Introduceti o denumire de produs</h4></p>";
	$errors = true;
}

if (empty($_POST['pret']) || !is_numeric($_POST['pret']))
{
	echo "<p><h4>Introduceti un pret format din cifre</h4></p>";
	$errors = true;
}
if ($errors)
{
	include "form_add.php";
}
else
{
    $denumire = htmlspecialchars(trim($_POST['denumire']));
	$descriere = htmlspecialchars($_POST['descriere']);
	$pret = trim($_POST['pret']);
	$tmpname = $_FILES['poza']['tmp_name'];
	$f = finfo_open(FILEINFO_MIME_TYPE);
	$mime = finfo_file($f,$tmpname);
	finfo_close($f);
	if($mime !== 'image/jpeg'){
		echo "<p>Fisierul nu este de tip JPG!</p>";
	}
	else {
		$newfile = tempnam(PICDIR, 'img-');
		$poza = "media/" . basename($newfile);
		move_uploaded_file($tmpname, $newfile);
	}
	
	$query = "INSERT INTO `produse` (`ID`,`Denumire`, `Descriere`,`Poza`,`Pret`) VALUES (NULL,'$denumire', '$descriere', '$poza', $pret)";
	$db = new Db();
	$add = $db->query($query);
	
	if ($add == false)
	{		
		echo "Exista erori, produsul nu a fost adaugat in baza de date";	
	}
	else
	{
		header("Location: /proiect2/admin/index.php");
		//echo "<h4>Produsul a fost adaugat cu succes si are <strong>ID-ul:"."" .$pdo->lastInsertId();
	}
}

?>














