<form id="edit" action = "edit.php" method="post"> 
			<table class="table">
			 <thead>
				<tr>
					<th>Denumire</th>
					<th>Descriere</th>
					<th>Pret</th>
					<th>Poza</th>
				</tr>
			</thead>
			<tbody>
				<?php 			
				foreach ($pdo->query("SELECT * FROM `produse` WHERE `ID` = $_GET[id]") as $v)
				{
					echo "<tr>
						 <input type='hidden' name='id_produs' value='$v[ID]'>
					  <td><input type='text' class ='form-control' name='denumire' value = $v[Denumire]></td>
					  <td><input type='text' class ='form-control' name='descriere' value = '$v[Descriere]'></td>
					  <td><input type='text' class ='form-control' name='pret' value = $v[Pret]></td>
					  <td><input type='text' class ='form-control' name='poza' value = $v[Poza]></td>
					</tr>";
				}
				?>
			</tbody>
			</table>					
		<input type="submit" name="update" class="btn btn-info" value="Actualizeaza produs" /> 
</form>


