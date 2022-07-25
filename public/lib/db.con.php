<?php

class DataBase {

	public $db;

	function __construct() {
		$this->db = new mysqli("localhost", "root", "", "campaigns");
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
		}
	}

	function __destruct() {
		$this->db->close();
	}

	public function con() {
	}
}


global $db, $conn;
if (!isset($db)) {
	$db = new DataBase();
}

$conn = $db->db;
