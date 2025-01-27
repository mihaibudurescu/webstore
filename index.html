<!DOCTYPE html>
<html lang="en">
<?php 
include 'includes/head.php';
include 'classes/Db.php';
session_start();
$db = new Db();
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
        <li class="active"><a href="index.php">Home</a></li>
        <li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="produs.php">Produse
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
        foreach ($db->query("SELECT * FROM produse") as $v)
		{
			echo "<li><a href = 'produs.php?id=".$v['ID']."'>".$v['Denumire']."</a></li>";
		}
		?>	
		</ul>
      </li>	
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin\index.php"><span class="glyphicon glyphicon-user"></span> Administreaza</a></li>
        <li><?php if (isset($_SESSION['logat']))
		{
			echo "<a href='admin/logout.php'>Logout</a></li>";
		}
		else 
		{
			echo "<a href='view_cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Vizualizare cos</a></li>";
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary">
        <div class="panel-heading">Lista produse</div>
        <div class="panel-body">
		<?php
            foreach($db->query("SELECT * FROM produse") as $v)
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

    <div class="col-sm-9"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BLACK FRIDAY DEAL</div>
        <div class="panel-body"><img src="media/stilou.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <div class="panel-footer"></div>
      </div>

</body>
</html>


















