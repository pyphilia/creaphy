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

		$query = $this->selectQuery($tableName, $rows);
		$query .=  $this->whereQuery($conditions);
		$query .= $this->orderByQuery($orderBy);
		$query .= $this->limitQuery($limit);
		var_dump($query);
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
		$length = count($changes);
		foreach ($changes as $key => $value) {
			$query .= "$key=" . '"' . "$value" . '" ';

			if(--$length) { // if is not last iteration
				$query .= ", ";
			}
		}

		// WHERE
		$query .= $this->whereQuery($conditions);

		$this->execute($query);
	}

	public function delete($tableName, $conditions) {
		$query = "DELETE FROM $tableName " . $this->whereQuery($conditions);
		$this->execute($query);
	}


	// Precize which table !
	public function leftJoin($tableName, $joinTable, $joins, $rows = NULL, $conditions = NULL, $orderBy = NULL, $limit = NULL)  {
		$query = $this->selectQuery($tableName, $rows);
		$query .= "LEFT JOIN $joinTable ON ";
		$length = count($joins);
		foreach ($joins as $key => $value) {
			$query .= "$tableName.$key=$joinTable.$value ";

			if(--$length) { // if is not last iteration
				$query .= "AND ";
			}
		}
		$query .= $this->whereQuery($conditions);
		$query .= $this->orderByQuery($orderBy);
		$query .= $this->limitQuery($limit);

		return $this->execute($query);
	}




	private function execute($query) {
		return $this->db->query($query);
	}

	private function selectQuery($tableName, $rows) {
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
		return $query;
	}

	// @TODO to do better
	// first OR second => array(id => array(first, second)) 
	// first AND second => array(x => first, x => second)
	private function whereQuery($conditions) {
		$query = "";
		if(isset($conditions)) {
			$query = "WHERE ";
			if(isset($conditions)) {
				$length = count($conditions);
				foreach ($conditions as $key => $value) {
					$innerLength = count($value);
					if($innerLength > 1) {

						foreach ($value as $v) {
						
							$query .= "$key=" . '"' . "$v" . '" ';

							if(--$innerLength) { // if is not last iteration
								$query .= "OR ";
							}
							--$length;
						}
					}
					else {
						$query .= "$key=" . '"' . "$value" . '" ';

							if(--$length) { // if is not last iteration
								$query .= "AND ";
							}
					}
				}
			}
		}
		var_dump($query);
		return $query;
	}

	private function orderByQuery($orderBy = NULL) {
		$query = "";
		if(isset($orderBy)) {
			$query .= "ORDER BY $orderBy ";
		}
		return $query;
	}

	private function limitQuery($limit = NULL) {
		$query = "";
		if(isset($limit)) {
			$query .= "LIMIT $limit ";
		} else {
			/*$query .= "LIMIT 4";*/
		}
		return $query;
	}

}
