<form id="add"  action="add.php" method="post">
			<table class="table table-condensed">
			 <thead>
				<tr>		
					<th>Denumire</th>
					<th>Descriere</th>
					<th>Pret</th>
					<th>Poza</th>
				</tr>
			</thead>
			<tbody>
					 <tr>	
					  <td><input type='text' class ='form-control' name="denumire">  </td>
					  <td><input type='text' class ='form-control' name="descriere">  </td>
					  <td><input type='text' class ='form-control' name="pret"> </td>
					  <td><input type='text' class ='form-control' name="poza" ></td>
					</tr>	
			</tbody>
			</table>	
		<input type='submit' name='add' class='btn btn-success' value='Adauga Produs' />
</form>


