<?php
include "includes/head.php";
include "includes/navbar.html";
include "classes/Db.php";
include "classes/Cart.php";
$db = new Db();
?>

<body>
<div class="container">    
  <div class="row">
    <div class="col-sm-3">
      <div class="panel panel-primary">
        <div class="panel-heading">Lista produse</div>
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
	
	<div class="col-sm-9">
          <div class="panel panel-success text-left">
		  <div class="panel-heading">Sumar comanda</div>
            <div class="panel-body">
				<?php
					if (is_numeric($_GET['comanda']))
					{
						$order_id = $_GET['comanda'];
					}
					$query = "SELECT * FROM `comenzi` WHERE ID_Comanda = $order_id";
					$rez  = $db->query($query);
					echo "<h4>Felicitari! Comanda dumneavoastra a fost inregistrata cu succes!</h4>
										<p><h5>Date identificare comanda nr. <strong>$order_id:</strong> </h5></p>"
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
					$query_order = "SELECT ID_Comanda,ID_Produs,Denumire,Cantitate,Pret FROM comenzi_produse JOIN produse ON comenzi_produse.ID_Produs = produse.ID WHERE ID_Comanda = $order_id";
					$order_products = $db->query($query_order);
					$totalPrice = "";
					foreach ($order_products as $product)
					{
						$totalProductPrice = $product['Cantitate'] * $product['Pret'];
						$totalPrice += $totalProductPrice;
						echo "<tr>	
							<td>$product[Cantitate] X $product[Denumire]</td>
							<td> $product[Pret] Ron</td>
							<td>$totalProductPrice</td>
							</tr>";
					}			
					echo "</tbody>
							</table>
							<p><h4>Total: $totalPrice Ron</h4></p>";
                    $cart = new Cart();
					$cart->emptyCart($db);
				?>
           </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
