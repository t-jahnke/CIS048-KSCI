<?php 
session_start();

$message = "";

if (isset($_GET["status"])) {
    $status = $_GET["status"];
    
    switch ($status) {
        case "createaccount":
            $message = "Account has been created, please login";
            break;
        case "forgotpassword":
            $message = "Check your email for instructions to reset your password.";
            break;
        case "logout":
            $message = "You have been logged out.";
            break;
        case "resetpassword":
            $message = "Your password has been reset, please login.";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <img src="ksulogo.png" alt="Kent State Logo">
        </div>
    </header>

    <section class="content">
        
<h1>Please login using your Kent State University credentials.</h1>
<hr>
<div>
<div style="color: orange; font-weight:bold"><?php echo($message) ?></div>
<br>
<form onsubmit="return validateForm()" action="procedure/login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit" class="btn btn-primary">Login</button> <a> or </a>
    <button type="button" class="btn btn-secondary" onclick="location.href='createaccount.php'">Create Account</button>
</form>
<br>
<div>

     
    <br> 
<a href="forgotpassword.php">Forgot Password?</a>
</div>
    


    </section>

   </body> 

    <footer style="text-align: center;">
		<p>If you need assistance logging in please contact itsupport@ksci.com for technical support. Please note that KSCI cannot change your KSU email.</p>
        <p>&copy; 2023 KSCI</p>
    </footer>

</html>
<?php include("import/footer.php"); ?>