<?php
session_start();
include('../import/db.php');
if (isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stmt = $database_connection->prepare("SELECT PasswordHash, UserId, CONCAT(FirstName, ' ', LastName) as UserName FROM Users WHERE Email=?");
	$stmt->bind_param("s", $username);
	$result = execute_query($stmt);
	$hash = "";
	while ($row = $result->fetch_row()) {
		$hash = $row[0];
		$userid = $row[1];
		$username = $row[2];
	}
	if (password_verify($password, $hash)) {
		$_SESSION["UserId"] = $userid;
		$_SESSION["UserName"] = $username;
	} else {
		session_destroy();
	}

	header('Location: ../index.php');
	
} 
?>