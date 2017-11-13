<?php
$date = trim($_SERVER['PATH_INFO'], '/');
$id = trim(substr($date,strpos($date,"/")),"/");
$format = ltrim(substr($date,strpos($date,".")),".");
$regex_date = '/^(listareproduse|detaliiprodus)\.(json|xml)[\/?\d+?]?/';
//print_r($_SERVER['PATH_INFO']);
if (preg_match($regex_date ,$date))
{
	include "../classes/class_db.php";
    $db = new DataBase();
	$date = explode('.' , $date);
	$listareProduse = in_array("listareproduse",$date);
	$detaliiProdus = in_array("detaliiprodus", $date);
	$date += $_GET;
	$xml = simplexml_load_string("<produse></produse>");
	//print_r($date);

	$sort = "asc";
	if (array_key_exists('sort',$date))
	{
		$sort = $date['sort'];	
	}
	$query_denumire = "SELECT `Denumire` from `produse` ORDER BY `Denumire` $sort";
	if (array_key_exists('filter', $date))
	{
		$filter = $date['filter'];
		$query_denumire = "SELECT `Denumire` FROM produse WHERE Denumire LIKE '%$filter%' ORDER BY `Denumire` $sort";
	}
	if ($listareProduse)
	{		
		$sql = $db->Query($query_denumire);
		switch ($format)
		{
			case "json":
				echo json_encode($sql,JSON_PRETTY_PRINT);
				break;
				
			case "xml":
				foreach ($sql as $v)
				{
					$produs = $xml->addChild('produs');
					$produs->addChild('denumire',$v['Denumire']);
				} 
				header('Content-type: application/xml');
				echo $xml->asXML();
				break;		
		}
	}
	if ($detaliiProdus)
	{
		$format = trim(substr($format,0,strpos($format, "/")),"/");
		$query = "SELECT * FROM `produse` WHERE `ID` = '$id'";
		$sql = $db->Query($query);
		if($sql)
		{
			http_response_code(200);
			switch($format)
			{
				case "json":
					echo json_encode($sql,JSON_PRETTY_PRINT);
					break;
				
				case "xml":
					foreach ($sql as $v)
					{
						$produs = $xml->addChild('produs');
						$produs->addAttribute('id', $v['ID']);
						$produs->addChild('denumire',$v['Denumire']);
						$produs->addChild('descriere', $v['Descriere']);
						$produs->addChild('pret', $v['Pret']);
					} 
					header('Content-type: application/xml');
					echo $xml->asXML();	
					break;
			}
		}
		else
		{
			http_response_code(400);
			echo "<h4>Bad Request</h4>";
		}	
	}
}
else
{
	http_response_code(400);
	echo "<h4>Bad Request</h4>";
}




















?>