<?php
class EasyPortfolio {
	private $sqliteerror = "";
	function __construct() {
		$this->db = sqlite_open('EasyPortfolio', 0666, $this->sqliteerror);
		if (!$this->db) die ($this->sqliteerror);
	}
	function createTable() {
		$stm = "CREATE TABLE EasyPortfolio(Id integer PRIMARY KEY," . 
			"Subject text NOT NULL, " .
			"Date text NOT NULL, " .
			"Body text NOT NULL, " .
			"Image text NOT NULL)";
		$ok = sqlite_exec($this->db, $stm, $this->sqliteerror);
		if (!$ok) die ("Whoops, there was an error while creating the EasyPortfolio-Database. " . $this->error);
	}
	function getAllEnt() {
		$query = "SELECT * FROM EasyPortfolio";
		$result = sqlite_query($this->db, $query);
		$a = array();
		while ($row = sqlite_fetch_array($result)) {
			$a[] = new EasyPortfolioEnt($row['Id'], $row['Subject'], $row['Date'], $row['Body'], $row['Image']);
		}
		return $a;
	}
	function setNewEnt($subject, $body, $image) {
		$query = "INSERT INTO EasyPortfolio VALUES(null, '".sqlite_escape_string($subject)."','".time()."','".sqlite_escape_string($body)."','".sqlite_escape_string($image)."')";
		$result = sqlite_query($this->db, $query);
		if (!$result) die("Whoops, there was an error while creating the EasyPortfolio-Post.");
	}
	function delEnt($id) {
		$query = "DELETE FROM EasyPortfolio WHERE Id = '$id'";
		$result = sqlite_query($this->db, $query);
		if (!$result) die("Whoops, there was an error while creating the EasyPortfolio-Post.");
	}
	function delAllEnt() {
		$query = "DELETE FROM EasyPortfolio WHERE Id = Id";
		$result = sqlite_query($this->db, $query);
		if (!$result) die("Whoops, there was an error while creating the EasyPortfolio-Post.");
	}
	function closeDB() {
		sqlite_close($this->db);
	}
	
}

class EasyPortfolioEnt {
	private $id = "";
	private $subject = "";
	private $date = "";
	private $body = "";
	private $image = "";
	function __construct($id, $subject, $date, $body, $image) {
		$this->date = $date;
		$this->body = $body;
		$this->subject = $subject;
		$this->image = $image;
		$this->id = $id;
	}
	function getId () {
		return $this->id;
	}
	function getSubject () {
		return $this->subject;
	}
	function getBody () {
		return $this->body;
	}
	function getDate ($a) {
		switch ($a) {
			case 0:
				return $this->date;
				break;
			case 1:
				return date("d.m.Y",$this->date);
				break;
			case 2:
				$month = array("JAN", "FEB", "MÄR", "APR", "MAI", "JUN", "JUL","AUG", "SEP", "OKT", "NOV", "DEZ");
				return date("d",$this->date) . " " . $month[(date("n",$this->date)-1) % 12];
				break;
		}
		return $this->date;
	}
	function getImage () {
		return $this->image;
	}
}
?>