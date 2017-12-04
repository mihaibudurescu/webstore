<?php
class Cart
{
	private $products = [];
	private $totalPrice;

    /**
     * adds a product in database 'magazin', 'cos' table
     * if the product already exists in 'cos' table it will increment his quantity
     * @param $db
     * @param $query
     */
	function addProduct($db, $query) {
		$db->query($query);
	}

    /**
     * loads the products from database 'magazin' (joined tables 'cos' and 'produse') into $products property
     * with this method we have persistent cart data with Sql, without sessions or cookies
     * @param $db
     */
	function setProducts($db) {
		$query = "SELECT produse.ID, Denumire, Pret, Cantitate FROM produse JOIN cos ON produse.ID = cos.ID";
		$this->products = $db->query($query);
	}

    /**
     * returns cart products as array
     * @return array
     */
    function getProducts() {
        return $this->products;
    }

    /**
     * calculates cart total price and assignes the value to $totalPrice property
     * returns the value of $totalPrice property
     * @return mixed
     */
    function getTotalPrice() {
        foreach ($this->products as $v) {
            $this->totalPrice += $v['Pret'] * $v['Cantitate'];
        }
        return $this->totalPrice;
    }

    /**
     * used for values updates in 'cos' table
     * @param $k
     * @param $v
     * @param $db
     */
	function updateCart($k, $v, $db) {
		$regex_key1 = '/^delete_\d+$/';
		$regex_key2 = '/^new_quantity_\d+$/';
		if (preg_match($regex_key1, $k)) {
			$query = "DELETE FROM `cos` WHERE `cos`.`ID` = $v"; 
			$db->query($query);
		}
		if (preg_match($regex_key2, $k)) {
			$id = trim($k, "new_quantity_");
			$query = "UPDATE `cos` SET `cantitate` = '$v' WHERE `cos`.`ID` = '$id'";
			$db->query($query);
		}
	}

    /**
     * deletes all the rows from 'cos' table after an order is placed
     * @param $db
     */
	function emptyCart($db){
		$query = "DELETE FROM `cos`";
        $db->query($query);
	}
}

?>