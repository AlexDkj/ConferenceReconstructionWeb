<?php
	$db_host = "localhost";
	$db_name = "eam";
	$db_user = "root";
	$db_pass = "root";

	
	
	$conn= new mysqli($db_host,$db_user,$db_pass,$db_name);
	
	
	if ($conn->connect_error){
			die("Unable to connect to database: " . $conn->connect_error);
		}
	
