<?php
	error_reporting(1);
	include_once("model.inc.php");
	
	$clsdb = new DB(); 

	$data = $clsdb->SELECT("SELECT CONCAT(u.LAST_NAME, ' ', u.FIRST_NAME) AS NAME , 
						GROUP_CONCAT((SELECT name FROM TBL_TEAMS t WHERE t.id = tu.team_id) SEPARATOR ', ') AS TEAMS
						FROM TBL_TEAMS_USERS tu 
						INNER JOIN TBL_USERS u ON u.id = tu.user_id 
						GROUP BY u.LAST_NAME");
						
	
	print_r($data);
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
                <tr>
                    <td>1</td>
                    <td>John</td>
                    <td>Carter</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
