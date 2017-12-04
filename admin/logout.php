<?php
session_start();
include "../includes/head.php";
include "../classes/Db.php";

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
        <li><a href="../index.php">Home</a></li>
        <li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="../produs.php">Produse
		<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<?php
        $db = new Db();
		foreach ($db->query("SELECT * FROM produse") as $v)
		{
			echo "<li><a href = ../produs.php?id=".$v['ID'].">".$v['Denumire']."</a></li>";
		}
		?>	
		</ul>
      </li>	
        <li><a href="../contact.php">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Administreaza</a></li>
        <li class="active"><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
if (isset ($_SESSION['logat']))
{
	session_destroy();
	echo "<h4>V-ati delogat cu succes!<h4>";
}

?>