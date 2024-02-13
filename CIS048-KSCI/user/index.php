<?php
header("Content-Type:application/json");
include('../import/db.php');
if (isset($_GET['userid']) && $_GET['userid']!="") {
	// Get user details
	$stmt = $database_connection->prepare("SELECT UserId, UniqId, FirstName, LastName, Email, Created, Updated FROM Users WHERE UserId=?");
	$stmt->bind_param("s", $_GET['userid']);
	execute_query_encode($stmt);
}
else {
	// Get users
	$stmt = $database_connection->prepare("SELECT UserId, FirstName, LastName FROM Users");
	execute_query_encode($stmt);
}
?>