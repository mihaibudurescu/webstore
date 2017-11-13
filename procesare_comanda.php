<?php
include "includes/head.php";
include "includes/navbar.html";
//include "includes/db.php";
include "classes/class_cos.php";
include "classes/class_db.php";
$db = new DataBase();
//print_r($_POST);
$regex_nume = '/^([A-Za-z][A-Za-z]+[ ,\'])+[A-Za-z][A-Za-z]+$/';
$regex_tel = '/^((00|\+)?4)?07\d\d([\.\- ]?\d{3}){2}$/';
$regex_adresa = '/^\w{3,}[\.\- ]?\w+/';
$campuri_formular = ['nume','adresa' ,'telefon','trimite_comanda'];
$campuri_post = array_keys($_POST);

$erori = false;
$msg1 ="";
$msg2 ="";
$msg3 ="";
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
	$erori = true;
}
if ($campuri_formular != $campuri_post)
{
	$erori = true;
}
if (!isset($_POST['nume']) || !preg_match($regex_nume, $_POST['nume'])) 
{
	$msg1 = "<h4>Va rugam introduceti un nume de persoana format din cel putin doua cuvinte!</h4>";
	$erori = true;
}
if (!isset($_POST['telefon']) || !preg_match($regex_tel, $_POST['telefon'])) 
{
	$msg2 =  "<h4>Va rugam introduceti un numar de telefon de fix sau mobil de 10 cifre!</h4>";
	$erori = true;
}
if (empty($_POST['adresa']) || !preg_match($regex_adresa, $_POST['adresa']))
{
	$msg3 = "<h4>Adresa invalida. Caractere acceptate: litere, cifre, punct, spatiu, cratima";
	$erori = true;
}
if($erori)
{
	echo "<body>
	<div class='container'>    
	  <div class='row'>
		<div class='col-sm-9'>
		  <div class='panel panel-danger'>
			<div class='panel-heading'>Reintroduceti datele comenzii</div>
			<div class='panel-body'>
			$msg1<br>
			$msg2<br>
			$msg3<br>
			<br>";
	include "includes/form_comanda.html";
}
else
{
	$nume = htmlspecialchars(trim($_POST['nume']));
	$tel = preg_replace('/[\.\- ]/',"",$_POST['telefon']);
	$adresa = htmlspecialchars($_POST['adresa']);
								
	$adauga_comanda = "INSERT INTO `comenzi` (`ID_Comanda`, `Nume`, `Adresa`, `Telefon`) VALUES (NULL, '$nume', '$adresa', '$tel')";
	//$add = $db->exec($adauga_comanda);
    $add = $db->Query($adauga_comanda);
	$id_comanda = $db->LastInsertID();
								
	$cos = new Cos;
	$cos->IncarcaCos($db);
	$produse_cos = $cos->Get_Cos();

	foreach ($produse_cos as $produs)
	{	
		$query_comenzi_produse = "INSERT INTO `comenzi_produse` (`ID_Comanda`, `ID_Produs`, `Cantitate`) VALUES ('$id_comanda', '$produs[ID]', '$produs[Cantitate]')";
		//$db->exec($query_comenzi_produse);
        $db->Query($query_comenzi_produse);
	}
	if ($add !== false)
	{
		header("Location: /proiect2/sumar_comanda.php?comanda=$id_comanda");
	}
}							
?> 

