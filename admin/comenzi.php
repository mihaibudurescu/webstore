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
            <a href='index.php' class='btn btn-info' role='button'>Administreaza</a></p>
            <a href='comenzi.php' class='btn btn-success' role='button'>Lista Comenzi</a>
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
				<?php
                if( isset( $_GET['id'] ) && is_numeric( $_GET['id']))
                {
                    echo "<th>Produs</th>
                        <th>Pret unitar produs</th>
                        <th>Pret total produs</th>
                        </tr>
                        </thead>
                        <tbody>";
                    $id_comanda = $_GET['id'];
                    $query_order = "SELECT ID_Comanda,ID_Produs,Denumire,Cantitate,Pret FROM comenzi_produse JOIN produse ON comenzi_produse.ID_Produs = produse.ID WHERE ID_Comanda = $id_comanda";
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
                }
 				else {
                    echo "
                    <th>ID Comanda</th>
					<th>Nume</th>
					<th>Adresa</th>
					<th>Telefon</th>
				</tr>
			</thead>
			<tbody>";
                    foreach ($comenzi as $value) {
                        echo "<tr>
                          <td><a href = 'comenzi.php?id=$value[ID_Comanda]'>$value[ID_Comanda]</a></td>
                          <td>$value[Nume]</td>
                          <td>$value[Adresa]</td>
                          <td>$value[Telefon]</td>
                        </tr>";
                    }
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