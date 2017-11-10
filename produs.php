<?php 
include "includes/head.php";
include "includes/db.php";
session_start();
if( isset( $_GET['id'] ) && is_numeric( $_GET['id'])) {
	$id_produs = $_GET['id'];
	$query = "SELECT * FROM `produse` WHERE `ID` = '$id_produs'";

    $a = $pdo->query($query);
    $r = $a->fetchAll(PDO::FETCH_ASSOC);
}

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
		<li class='active'>
		<a class="dropdown-toggle" data-toggle="dropdown" href="produs.php">Produse
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
		foreach ($pdo->query("SELECT * FROM produse") as $v)
		{
			echo "<li><a href = produs.php?id=".$v['ID'].">".$v['Denumire']."</a></li>";
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
			echo "<a href='cos.php'><span class='glyphicon glyphicon-shopping-cart'></span> Vizualizare cos</a></li>";
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<body>
<div class="container text-center">    
  <div class="row">
    <div class="col-sm-3 well">
		<div class="well">
		<?php		
			echo "<p><strong>".$r[0]['Denumire']."</strong></p>".
			"<img src='". $r[0]['Poza'] ."' width='200' height='200'/>";
		?>
		</div>
		 <div class="well">
			<p><strong>Pret</strong></p>
			<?php
			echo "<p><strong>".$r[0]['Pret']." Ron</strong><p>";
			?>
			</div>
			<form class="add-to-cart" action="cos.php" method="post">
							<div>
								<input type="hidden" name="id" value="<?php echo $id_produs ?>">
								<label for="quantity">Cantitate</label>
								<input type="text" name="quantity" id="qty-1" class="qty" value="1" />
							</div>
							<p></p>
							<p><input type="submit" value="Adauga in cos" class="btn btn-primary" role="button"/></p>
			</form>
		</div>
		 <div class="col-sm-9">
          <div class="panel panel-default text-left">
		  <div class="panel-heading">Descriere produs</div>
            <div class="panel-body">
				<p><?php echo $r[0]['Descriere'] ; ?> </p>
           </div>
          </div>
        </div>
      </div>
    </div>
	
	


	 



