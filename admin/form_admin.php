<form id="admin" action = "edit.php" method="post"> 
			<table class="table">
			 <thead>
				<tr>
					<th>Selecteaza produs</th>
					<th>Denumire</th>
					<th>Descriere</th>
					<th>Pret</th>
					<th>Poza</th>
					<th>Editeaza produs</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($db->query("SELECT * FROM produse") as $v)
				{
					echo "<tr>	
						<td><input type='checkbox' name='select_$v[ID]' value = $v[ID]></td>
					  <td> $v[Denumire]  </td>
					  <td> $v[Descriere] </td>
					  <td> $v[Pret]      </td>
					  <td> $v[Poza]   </td>
					  <td><a href=http://localhost/proiect2/admin/edit?view=edit&id=" . $v['ID'] . "> Editeaza</a></td>
					</tr>";
				}
				?>
			</tbody>
			</table>					
		<input type="submit" name="delete" class="btn btn-danger" value="Sterge produsele selectate" /> 
</form>
<?php 
	include "form_add.php";
?>


