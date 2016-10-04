<?php
	error_reporting(1);
	//include_once("model.inc.php");
	
	//$clsdb = new DB(); 
	function SELECT($sql) {
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


	$data = SELECT("SELECT u.id, CONCAT(u.LAST_NAME, ' ', u.FIRST_NAME) AS NAME , 
						GROUP_CONCAT((SELECT name FROM TBL_TEAMS t WHERE t.id = tu.team_id) SEPARATOR ', ') AS TEAMS
						FROM TBL_TEAMS_USERS tu 
						INNER JOIN TBL_USERS u ON u.id = tu.user_id 
						GROUP BY u.LAST_NAME");
						
	/*$data = SELECT("SELECT u.id, CONCAT(u.LAST_NAME, ' ', u.FIRST_NAME) AS NAME , 
						t.name AS TEAMS
						FROM TBL_TEAMS_USERS tu 
						INNER JOIN TBL_USERS u ON u.id = tu.user_id 
                        INNER JOIN TBL_TEAMS t ON t.id = tu.team_id ORDER BY u.id ASC");					
						*/
						
				
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<title>Simple App</title>
</head>

<body>
	<div class="container" style="margin-top:5%;">
         <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Teams</th>
                </tr>
            </thead>
            <tbody>
            	<?php
					$id;
					
					foreach($data as $d) { ?>
                    	<tr>
					   		<td><?php echo $d['id'] ?></td>	
                            <td><?php echo $d['NAME'] ?></td>	
                            <?php
								$atags = "";
								$myArray = explode(',', $d['TEAMS']);
								foreach($myArray as $val) {
									$atags .= '<a href="#'.strtolower(str_replace(" ","_",trim($val))).'">'.$val.'</a>';
								}
							?>
                            <td><?php echo $atags ?></td>
						</tr><?php
					}
				?>
            </tbody>
        </table>
    </div>
</body>
</html>
