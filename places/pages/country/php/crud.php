<?php

include "../../php/MySqlOpenHelper.php";

class Crud {
	function __construct() {
		$database    = "places-google-map";
		$host        = "localhost";
		$usr         = "root";
		$pwd         = "zcxadsqew";
		$this->db    = new Database($host, $usr, $pwd, $database);
	}
	
	function create($name) {
		if($name != "") {
			$sql = "INSERT INTO 'country'('name', 'create_at', 'updated_at') 
			VALUES ('".$name."',now(),now())";
			$this->db->exeSQL($sql);
		} else {
			echo "No se ha especificado ningun nombre.";
		}
	}

	function read($id) {
		$sql = "SELECT * FROM country WHERE id=".$id;
		$array = $this->db->rawQuery($sql);
		return $array[0]["name"];
	}

	function update($id, $name) {
		$sql = "UPDATE country SET name='".$name."', updated_at=now() WHERE id=".$id;
		$this->db->exeSQL($sql);
	}
	
	function delete($id) {
		$sql = "DELETE FROM 'country' WHERE id=".$id;
		$this->db->exeSQL($sql);
	}

	function show() {
		$sql = "SELECT * FROM country";
		$array = $this->db->rawQuery($sql);


		echo "<table border='1'>
		<tr>
		<th>id</th>
		<th>Country</th>
		</tr>";

		foreach ($array as &$item) {
			echo "<tr>";
			echo "<td>" . $item['id'] . "</td>";
			echo "<td>" . $item['name'] . "</td>";
			echo "</tr>";
		}

		echo "</table>";

		unset($item);
	}
}

?>