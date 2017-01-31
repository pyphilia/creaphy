<?php 
class Bd {

	private $db;

	public function __construct($dbhost, $dbuser, $dbpw, $dbname) {
		$this->db = new PDO(
			'mysql:host=' . $dbhost . ';dbname='. $dbname . ';set=utf8mb4',
			$dbuser,
			$dbpw
			);
	}

	/***To retrieve results from queries : 
	foreach($result as $res) {
		var_dump($res);
	}
	***/

	public function select($tableName, $rows = array("*"), $conditions = NULL, $limit = 10, $orderBy = NULL) {
		$query = "SELECT ";

		// ROWS SELECTION
		$length = count($rows);
		foreach ($rows as $row) {
			$query .= $row;

				if(--$length) { // if is not last iteration
					$query .= ",";
				}
							
		}

		// TABLENAME 
		$query .= " FROM $tableName ";


		// WHERE
		$length = count($conditions);
		if(isset($conditions) && $length > 0) {
			$query .= "WHERE ";
			foreach ($conditions as $condition) {
				
				$query .= $condition['0'] . "=" . $condition['1'] . " ";
				
				if(--$length) { // if is not last iteration
					$query .= "AND ";
				}
				
			}
			
		}
		// ORDERBY
		if(isset($orderBy)) {
			$query .= "ORDER BY " . $orderBy . " ";
		}

		// LIMIT
		if(isset($limit)) {
			$query .= "LIMIT " . $limit . " ";
		}

		return $this->execute($query);
	}

	public function insert($tableName) {
		$stmt = $this->db->query("INSERT $tableName");
		return $stmt;
	}

	public function update() {
		
	}

	public function delete() {
		
	}

	private function execute($query) {
		return $this->db->query($query);
	}
}

?>