<?php
session_start();
include "../includes/head.php";
include "../includes/navbar_admin.php";

if($_SESSION['logat'])
{
    $db = new Db();
	$query_comenzi = "SELECT * FROM `comenzi` ORDER BY `ID_Comanda` DESC ";
    $comenzi = $db->query($query_comenzi);
}

?>
<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary text-center">
        <div class="panel-heading text-center">Panou control</div>
        <div class="panel-body">
			<a href='mesaje.php' class='btn btn-warning' role='button'>Mesaje</a></p>
			<a href='index.php' class='btn btn-info' role='button'>Administreaza</a>
        </div>
    </div>
</div>


<div class="container">    
	<div class='col-sm-9 text-center'> 
			<div class='panel panel-info text-center'>
			<div class='panel-heading text-center'>Lista Comenzilor</div>
			<div class='panel-body'>
			<table class="table">
			 <thead>
				<tr>
					<th>ID Comanda</th>
					<th>Nume</th>
					<th>Adresa</th>
					<th>Telefon</th>
				</tr>
			</thead>
			<tbody>
				<?php 			
 				foreach ($comenzi as $value)
				{
					echo "<tr>
					  <td>$value[ID_Comanda]</td>
					  <td>$value[Nume]</td>
					  <td>$value[Adresa]</td>
					  <td>$value[Telefon]</td>
					</tr>";
				} 
				?>
			</tbody>
			</table>
		   </div>
	    </div>
	  </div>
	</div>	
  </div>
</body>		