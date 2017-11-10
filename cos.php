<?php
include "includes/head.php";
include "includes/db.php";
include "classes/class_cos.php";
//print_r($_POST);
$cos = new Cos;
if (isset ($_POST['delete']))
{
	$cos->GolesteCos($pdo);
}
if (isset ($_POST['update']))
{
	foreach ($_POST as $k=>$v)
	{
		$cos->ActualizeazaCos($k, $v, $pdo);
	}
}
$cos->IncarcaCos($pdo);
if (isset ($_POST['id']) && isset ($_POST['quantity']))
{
	$id_product = $_POST['id'];
	$quantity = $_POST['quantity'];	
	$query_exist = "SELECT * FROM `cos` WHERE `ID` = $id_product";
	$exist = $pdo->query($query_exist)->fetchAll(PDO::FETCH_ASSOC);
	if($exist)
	{
		$query_update = "UPDATE `cos` SET `cantitate` = $quantity + `cos`.`cantitate`  WHERE `cos`.`ID` = $id_product";
	}
	else
	{
		$query_update = "INSERT INTO `cos` (`ID`, `cantitate`) VALUES ($id_product, $quantity)";
	}
	
	$cos->AdaugaProdus($pdo,$query_update,$id_product,$quantity);
	$cos->IncarcaCos($pdo);

}
//var_dump ($exist);

//print_r($cos);

?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  </div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class><a href="index.php">Home</a></li>
        <li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="produs.php">Produse
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
		foreach ($pdo->query("SELECT * FROM produse") as $produs)
		{
			echo "<li><a href = produs.php?id=".$produs['ID'].">".$produs['Denumire']."</a></li>";
		}
		?>	
		</ul>
      </li>	
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin\index.php"><span class="glyphicon glyphicon-user"></span> Administreaza</a></li>
        <li class="active"><a href="cos.php"><span class="glyphicon glyphicon-shopping-cart"></span> Vizualizare cos</a></li>
      </ul>
    </div>
  </div>
</nav>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">Lista produse</div>
        <div class="panel-body">
		<?php
			foreach ($pdo->query("SELECT * FROM produse") as $v)
			{
				$poza = $v['Poza'];
				$id = $v['ID'];
				$denumire = $v['Denumire'];
				echo "<a href = produs.php?id=".$id."><img src='". $poza ."' width='30' height='30'/>" ." ". $denumire . "</a><br>";
			}		
		?>		
		</div>
      </div>
    </div>

    <div class="col-sm-9 text-center"> 
      <div class="panel panel-success">
        <div class="panel-body">
			<?php
				$query_exist2 = "SELECT * FROM `cos`";
				$exist2 = $pdo->query($query_exist2)->fetchAll(PDO::FETCH_ASSOC);
				if (!isset ($_POST['checkout']))
				{
					include "includes/form_cos.html";
				}
				elseif (!$exist2)
				{
					echo "Ne pare rau, pentru a face o comanda trebuie sa aveti minim un produs in cos";
				}
				elseif ($exist2) 
				{
					include "includes/form_comanda.html";
				}			
			?>
		</div>
      </div>
</body>
</html>



