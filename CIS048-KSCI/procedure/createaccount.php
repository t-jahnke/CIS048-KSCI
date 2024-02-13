<?php
include('../import/db.php');
if (isset($_POST['password']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hash = password_hash($password, PASSWORD_DEFAULT);
	$stmt = $database_connection->prepare("INSERT INTO Users (FirstName, LastName, Email, PasswordHash) VALUES (?,?,?,?)");
	$stmt->bind_param("ssss", $firstname, $lastname, $email, $hash);
	$result = execute_query($stmt);

	header('Location: ../login.php?status=createaccount');
	
} 
?>