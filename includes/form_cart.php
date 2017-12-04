<form id="cart" action = "view_cart.php" method="post">
			<table class="table">
			 <thead>
				<tr>
					<th>Sterge produs</th>
					<th>Denumire</th>
					<th>Pret</th>
					<th>Cantitate</th>
					<th>Pret total produs</th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $products = $cart->getProducts();
                    foreach ($products as $product)
                    {
                        $price = $product['Pret'] * $product['Cantitate'];
                        echo "<tr>	
                            <td><input type='checkbox' name='delete_$product[ID]' value = $product[ID]></td>
                          <td> $product[Denumire]</td>
                          <td> $product[Pret]</td>
                          <td><input type='text' class ='form-control' name=new_quantity_$product[ID] value = $product[Cantitate]></td>
                          <td>$price Ron</td>
                      </tr>";
                    }
                    echo "</tbody>
                        </table>
                        <p><h3>Total: " . $cart->getTotalPrice() . " Ron</h3></p>";
				?>
					<input type="submit" name="update" id="update-cart" class="btn btn-warning" value="Actualizeaza Cos" />
					<input type="submit" name="delete" id="empty-cart" class="btn btn-danger" value="Goleste Cos" />
					<input type="submit" name="checkout" id="checkout-cart" class="btn btn-success" value="Comanda" />
			</form>