<?php

class Database {
	function __construct($host, $usr, $pwd, $dbname) {
		$this->setHost($host);
		$this->setUSR($usr);
		$this->setPWD($pwd);
		$this->setDBNAME($dbname);
		$this->connect();
	}

	function __destruct() {
		mysqli_close($this->con);
	}

	function connect() {
		$this->con = mysqli_connect($this->host
			, $this->usr
			, $this->pwd
			, $this->dbname);
		if (mysqli_connect_errno($this->con)) {
			echo "Fallo conexion a MySQL: ".mysqli_connect_error();
		}
	}

	function exeSQL($sql) {
		mysqli_query($this->con, $sql);

	}

	function rawQuery($sql) {
		$cur = mysqli_query($this->con, $sql);
		
		while($row = mysqli_fetch_array($cur)) {
			echo $row['id'] . " " . $row['nombre'];
			echo "<br>";
		}
	}

	function close() {
		mysqli_close($this->con);
	}

	function setHOST   ($host)   { $this->host = $host; }
	function setUSR    ($usr)    { $this->usr = $usr; }
	function setPWD    ($pwd)    { $this->pwd = $pwd; }
	function setDBNAME ($dbname) { $this->dbname = $dbname; }
	function getHOST   ($host)   { return $this->host; }
	function getUSR    ($usr)    { return $this->usr; }
	function getPWD    ($pwd)    { return $this->pwd; }
	function getDBNAME ($dbname) { return $this->dbname; }
}


$db = new Database('localhost', 'root', 'zcxadsqew', 'database');
$db->exeSQL('DROP TABLE IF EXISTS datos');
$db->exeSQL('CREATE TABLE datos(id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(40), PRIMARY KEY(id))');
$db->exeSQL('INSERT INTO `datos`(`nombre`) VALUES ("Carlos Gonzalez Rubio")');
$db->exeSQL('INSERT INTO `datos`(`nombre`) VALUES ("Karla Lizeth Martinez Gutierrez")');
$db->rawQuery('SELECT * FROM datos');

?>