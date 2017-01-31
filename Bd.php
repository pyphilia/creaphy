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


	public function select($tableName, $rows = NULL, $conditions = NULL, $orderBy = NULL, $limit = NULL) {

		$query = "SELECT ";

		// ROWS SELECTION
		if(isset($rows)) {
			$length = count($rows);
			foreach ($rows as $row) {
				$query .= $row;

				if(--$length) { // if is not last iteration
					$query .= ",";
				}

			}
		} else {
			$query .= "* ";
		}

		// TABLENAME 
		$query .= " FROM $tableName ";


		// WHERE
		$length = count($conditions);
		if(isset($conditions) && $length > 0) {
			$query .= "WHERE ";
			foreach ($conditions as $key => $value) {
				
				$query .= $key . "=" . $value . " ";
				
				if(--$length) { // if is not last iteration
					$query .= "AND ";
				}
				
			}
			
		}
		// ORDERBY
		if(isset($orderBy)) {
			$query .= "ORDER BY $orderBy ";
		}

		// LIMIT
		if(isset($limit)) {
			$query .= "LIMIT $limit ";
		} else {
			$query .= "LIMIT 4";
		}

		return $this->execute($query);
	}


	public function insert($tableName, $values) {

		// ROWS SELECTION
		$length = count($values);
		$rows = "";
		$insertedValues = "";
		foreach ($values as $key => $value) {
			$rows .= "$key";
			var_dump(gettype($value));
			$insertedValues .= (is_string($value)) ? '"'.$value.'"' : "$value" ;
			if(--$length) { // if is not last iteration
				$rows .= ",";
				$insertedValues .= ",";
			}
		}

		$query = "INSERT INTO $tableName ($rows) VALUES ($insertedValues)";

		$this->execute($query);
	}


	public function update($tableName, $changes, $conditions) {
		$query = "UPDATE $tableName SET ";

		// UPDATE
		foreach ($changes as $key => $value) {
			$query .= "$key=" . '"' . "$value" . '" ';

			if(--$length) { // if is not last iteration
				$query .= "AND ";
			}
		}

		// WHERE
		$length = count($conditions);
		$query .= "WHERE ";
		foreach ($conditions as $key => $value) {
			$query .= "$key=" . '"' . "$value" . '" ';

			if(--$length) { // if is not last iteration
				$query .= "AND ";
			}
		}

		$this->execute($query);
	}

	public function delete() {

	}

	private function execute($query) {
		return $this->db->query($query);
	}
}

?>