<?php

// Database connection information
$host_name = 'db5014606446.hosting-data.io';
$database = 'dbs12137356';
$user_name = 'dbu1367099';
$password = '.f@m$.2BF9z2pNU';

// Global variable for MariaDB conection
$database_connection = mysqli_connect($host_name, $user_name, $password, $database);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}

function execute_query_encode($query){
	$query->execute();
	$result=$query->get_result();
	$output = $result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($output);
}

function execute_query($query){
	$query->execute();
	return $query->get_result();
}
?>