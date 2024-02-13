<?php
include('../import/db.php');
if (isset($_POST['password']) && isset($_POST['hash'])){
	$hashid = $_POST['hash'];
	$password = $_POST['password'];
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$stmt = $database_connection->prepare("UPDATE Users Set PasswordHash = ? Where PasswordHash = ?");
	$stmt->bind_param("ss", $hash, $hashid);
	$result = execute_query($stmt);

	header('Location: ../login.php?status=resetpassword');
} 
?>