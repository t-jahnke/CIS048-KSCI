<?php
$password = "";
$hash = "";
$hashpassword = "";
$hashmessage = "";
if (isset($_POST['password']) && $_POST['password']!="") {
	$password = $_POST['password'];
	$hash = password_hash($password, PASSWORD_DEFAULT);
} elseif (isset($_POST['hashpassword']) && $_POST['hashpassword']!="") {
	$hash = $_POST['hash'];
	$hashpassword = $_POST['hashpassword'];
	if (password_verify($hashpassword, $hash)) {
		$hashmessage = "<font color=green>PASSWORD IS VALID</font>";
	} else {
		$hashmessage = "<font color=red>PASSWORD IS INVALID</font>";
	}
}
?>
<html>
<head>
<title>Generate Hash</title>
</head>
<body>
<h1>Hashing Passwords</h1>
<form action=generatehash.php method=post>
Password: <input type=text name=password value="<?php echo($password) ?>">
<p>
Hash: <?php echo($hash) ?>
<p>
<input type=submit value=Go>
</form>
<hr>
<form action=generatehash.php method=post>
Password: <input type=text name=hashpassword value="<?php echo($hashpassword) ?>">
<p>
Hash: <input type=text name=hash size=100 value="<?php echo($hash) ?>">
<p>
<input type=submit value=Go>
<p>
<?php echo($hashmessage) ?>
</form>
</body>
</html>