<?php
class Cos
{
	private $produse = [];
	private $pretTotal;
	
	function AdaugaProdus($db, $query, $id_product, $quantity)
	{
		$add = $db->Query($query);
	}
	
	function IncarcaCos($db)
	{
		$query = "SELECT produse.ID, Denumire, Pret, Cantitate FROM produse JOIN cos ON produse.ID = cos.ID";
		$this->produse = $db->Query($query);
	}
	
	function AfiseazaCos()
	{
		foreach ($this->produse as $v)
		{
			$pret = $v['Pret'] * $v['Cantitate'];
			$this->pretTotal += $pret;
			echo "<tr>	
						<td><input type='checkbox' name='delete_$v[ID]' value = $v[ID]></td>
					  <td> $v[Denumire]</td>
					  <td> $v[Pret]</td>
					  <td><input type='text' class ='form-control' name=new_quantity_$v[ID] value = $v[Cantitate]></td>
					  <td>$pret Ron</td>
				  </tr>";
		}
	echo "</tbody>
			</table>
			<p><h3>Total: $this->pretTotal Ron</h3></p>";
	}
	
	function ActualizeazaCos($k, $v, $db)
	{
		$regex_key1 = '/^delete_\d+$/';
		$regex_key2 = '/^new_quantity_\d+$/';
		if (preg_match($regex_key1, $k))
		{
			$query = "DELETE FROM `cos` WHERE `cos`.`ID` = $v"; 
			$db->Query($query);
		}
		if (preg_match($regex_key2, $k))
		{
			$id = trim($k, "new_quantity_");
			$query = "UPDATE `cos` SET `cantitate` = '$v' WHERE `cos`.`ID` = '$id'";
			$db->Query($query);
		}
	}
	function GolesteCos($db)
	{
		$query = "DELETE FROM `cos`";
		//$pdo->exec($query);
        $db->Query($query);
	}
	
	function Get_Cos()
	{
		return $this->produse;
	}
	
}

















?>