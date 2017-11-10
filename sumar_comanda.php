<?php
include "includes/head.php";
include "includes/navbar.html";
include "includes/db.php";
include "classes/class_cos.php";
?>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary">
        <div class="panel-heading">Lista produse</div>
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
	
	<div class="col-sm-9">
          <div class="panel panel-success text-left">
		  <div class="panel-heading">Sumar comanda</div>
            <div class="panel-body">
				<?php
					$cos = new Cos;
					$cos->IncarcaCos($pdo);
					$produse_cos = $cos->Get_Cos();
					if (is_numeric($_GET['comanda']))
					{
						$id_comanda = $_GET['comanda'];
					}
					$pretTotal ="";
					$query = "SELECT * FROM `comenzi` WHERE ID_Comanda = $id_comanda";
					$rez  = $pdo->query($query)->fetchAll();
					echo "<h4>Felicitari! Comanda dumneavoastra a fost inregistrata cu succes!</h4>
										<p><h5>Date identificare comanda nr. <strong>$id_comanda:</strong> </h5></p>"
										            .$rez[0]['Nume']."<br>"
													.$rez[0]['Adresa']."<br>"
													.$rez[0]['Telefon']."<br>
													<br>
								<table class='table'>
								 <thead>
									<tr>
										<th>Denumire</th>
										<th>Pret</th>
										<th>Total</th>
									</tr>
								</thead>";
					foreach ($produse_cos as $produs)
					{
						$pretTotalProdus = $produs['Cantitate'] * $produs['Pret'];
						$pretTotal += $pretTotalProdus;
								
						echo "<tr>	
							<td>$produs[Cantitate] X $produs[Denumire]</td>
							<td> $produs[Pret] Ron</td>
							<td>$pretTotalProdus</td>
							</tr>";
					}			
					echo "</tbody>
							</table>
							<p><h4>Total: $pretTotal Ron</h4></p>";		
					$cos->GolesteCos($pdo);				
				?>
           </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
