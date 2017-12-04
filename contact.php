<?php
session_start();
include "includes/head.php";
include 'classes/Db.php';
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
        <li><a href="index.php">Home</a></li>
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
        <li class = "active"><a href="contact.php">Contact</a></li>
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
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">Trimite un mesaj</div>
        <div class="panel-body">
		<?php 
			if (!isset($_POST['nume']) && !isset($_POST['contact']) && !isset($_POST['mesaj']))
			{
				include "includes/form_contact.html";
			}
			else
			{			
				$nume = htmlspecialchars(trim($_POST['nume']));
				$contact = htmlspecialchars($_POST['contact']);
				$mesaj = htmlspecialchars($_POST['mesaj']);
				$query = "INSERT INTO `mesaje` (`ID`, `Nume`, `Contact`, `Mesaj`) VALUES (NULL, '$nume', '$contact', '$mesaj')";
                $add_mesaj = $db->query($query);
				if($add_mesaj)
				{
					echo "<h4> Mesajul dvs. a fost trimis!";
				}
				else
				{
					echo "<h4>Mesajul nu a fost trimis, completati corect toate campurile!<h4>";
				}
			}			
		?>
		
	</div>
</div>
</div>
</body>
		