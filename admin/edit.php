<?php
include "../includes/head.php";
include "../includes/navbar_admin.php";
//include "../includes/db.php";
//print_r($_POST);
//print_r($_GET);
?>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-10">
      <div class="panel panel-primary text-center">
        <div class="panel-heading">Editeaza produsul</div>
        <div class="panel-body">
		
<?php

if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_SERVER['QUERY_STRING']) && is_numeric($_GET['id']))
{
	include "form_edit.php";
	
}

if(isset($_POST['delete']))
{
	foreach([$_POST] as $k)
	{
		foreach($k as $v)
		{
			$query = "DELETE FROM `produse` WHERE `produse`.`ID` = $v";
			//$delete = $db->exec($query);
            $delete = $db->Query($query);
			if ($delete)
			{
				echo "<h4>Produsul cu ID: <strong>$v</strong> a fost sters cu succes</h4><br>
				<br>
				<a href='index.php' class='btn btn-info' role='button'>Inapoi</a>";
			}
			
		}
	}
}
if(count($_POST) === 1)
{
	echo "Pentru a sterge un produs trebuie sa il selectati<br>
		<br>
		<a href='index.php' class='btn btn-info' role='button'>Inapoi</a>";	
}

if(isset($_POST['update']))
{
		$id_produs = $_POST['id_produs'];
		$denumire = $_POST['denumire'];
		$descriere = $_POST['descriere'];
		$pret = $_POST['pret'];
		$poza = $_POST['poza'];
		$query_update = "UPDATE `produse` SET `Denumire` = '$denumire', `Descriere` = '$descriere' ,
		`Pret` = '$pret' , `Poza` = '$poza'	WHERE `produse`.`ID` = $id_produs";
		
		$update = $db->Query($query_update);
		if($update)
		{
			echo "<h4>Produsul cu ID-ul <strong>$id_produs</strong> a fost actualizat cu succes!</h4><br>
			<a href='index.php' class='btn btn-info' role='button'>Inapoi</a>";
			
		}	
		else
		{
			echo "<h4>Produsul cu ID-ul <strong>$id_produs NU</strong> a avut actualizari!</h4><br>
			<a href='index.php' class='btn btn-info' role='button'>Inapoi</a>";
		}
} 















?>