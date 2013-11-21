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
		if(!$this->con) {
			mysqli_close($this->con);
		}
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
		/* Siempre regresa un array de objetos
		 * acceder a ellos mediante:
		 * array[0]['nombre_columna'];
		 * * */
		$cur = mysqli_query($this->con, $sql);
		$array;

		while($row = mysqli_fetch_array($cur)) {
			$array[] = $row;
		}

		return $array;
	}

	function close() {
		mysqli_close($this->con);
	}

	function setHOST   ($host)   { $this->host = $host; }
	function setUSR    ($usr)    { $this->usr = $usr; }
	function setPWD    ($pwd)    { $this->pwd = $pwd; }
	function setDBNAME ($dbname) { $this->dbname = $dbname; }
	function getHOST   () { return $this->host; }
	function getUSR    () { return $this->usr; }
	function getPWD    () { return $this->pwd; }
	function getDBNAME () { return $this->dbname; }
}

?>