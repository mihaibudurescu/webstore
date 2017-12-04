<?php
include "includes/head.php";
include "classes/Db.php";
include "classes/Cart.php";
//print_r($_POST);
$cart = new Cart;
$db = new Db();
if (isset ($_POST['delete']))
{
	$cart->emptyCart($db);
}
if (isset ($_POST['update']))
{
	foreach ($_POST as $k=>$v)
	{
		$cart->updateCart($k, $v, $db);
	}
}
//load the products from database into cart
$cart->setProducts($db);
if (isset ($_POST['id']) && isset ($_POST['quantity']))
{
	$id_product = $_POST['id'];
	$quantity = $_POST['quantity'];	
	$query_exist = "SELECT * FROM `cos` WHERE `ID` = $id_product";
	$exist = $db->query($query_exist);
    $query_update = $exist ? "UPDATE `cos` SET `cantitate` = $quantity + `cos`.`cantitate`  WHERE `cos`.`ID` = $id_product" : "INSERT INTO `cos` (`ID`, `cantitate`) VALUES ($id_product, $quantity)";
	
	$cart->addProduct($db,$query_update);
	$cart->setProducts($db);
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
		foreach ($db->query("SELECT * FROM produse") as $produs)
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
        <li class="active"><a href="view_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Vizualizare cos</a></li>
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
			foreach ($db->query("SELECT * FROM produse") as $v)
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
				$exist2 = $db->query($query_exist2);
				if (!isset ($_POST['checkout']))
				{
					include "includes/form_cart.php";
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



