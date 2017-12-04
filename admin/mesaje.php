<?php
session_start();
if (isset ($_SESSION['logat']))
{
	include "../includes/head.php";
    include "../includes/navbar_admin.php";
}
?>
<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary text-center">
        <div class="panel-heading text-center">Panou control</div>
        <div class="panel-body">
		<p><a href='index.php' class='btn btn-warning' role='button'>Administreaza</a></p>
		   <a href='comenzi.php' class='btn btn-info' role='button'>Lista comenzi</a>
		</div>
	  </div>
	 </div>
   
   
<div class='col-sm-9 text-center'> 
	<div class='panel panel-success text-center'>
		<div class='panel-heading text-center'>Mesaje</div>
			<div class='panel-body'>
			<table class="table">
			<thead>
				<tr>
					<th>Nume</td>
					<th>Date contact</td>
					<th>Mesaj</td>
				</tr>
			</thead>
			<tbody>
			<?php 		
			$query = "SELECT * FROM `mesaje`";
			$rez = $db->query($query);
			if($rez === false)
			{
				echo "<h4>Nu aveti mesaje</h4>";
			}
			else
			{
				foreach ($rez as $v)
				{
					echo "<tr>	
					  <td> $v[Nume]</td>
					  <td> $v[Contact]</td>
					  <td>$v[Mesaj]</td>
						</tr>";
				}
			}
		
			?>
			</tbody>
		</table>