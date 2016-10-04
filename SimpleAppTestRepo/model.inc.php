<?php
	class DB {
		public function SELECT($sql) {
			$resultsToArray = array();
			
			$db = new mysqli("localhost", "root", "", "simple_db");
			if($db->connect_errno > 0){
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			
			while($row = $result->fetch_assoc()){
				array_push($resultsToArray, $row);
			}
	
			return $resultsToArray;
		}
	}
?>