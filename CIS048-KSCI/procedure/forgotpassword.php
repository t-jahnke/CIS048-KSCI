<?php
include('../import/db.php');
if (isset($_POST['email'])){
	$email = $_POST['email'];
	$stmt = $database_connection->prepare("SELECT PasswordHash FROM Users WHERE Email=?");
	$stmt->bind_param("s", $email);
	$result = execute_query($stmt);
	while ($row = $result->fetch_row()) {
		$hash = $row[0];
	}
	$resetpasswordlink = "http://poppatees.com/KSUProject/resetpassword.php?id=".$hash;
	$to = $email;
	$subject = 'KSCI - Reset your password';
	$message = 'Please reset your password for KSCI using the link below:'."\r\n".$resetpasswordlink;
	$headers = 'From: thomas@poppatees.com' . "\r\n" .
	'Reply-To: thomas@poppatees.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	header('Location: ../login.php?status=forgotpassword');
	
} 
?>