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
</head>

<body>
    <header>
        <div class="header-container">
            <img src="ksulogo.png" alt="Kent State Logo">
        </div>
    </header>

    <section class="content">
        <div class="addstyle">
            <h1>Please login using your Kent State University credentials.</h1>
            <hr>
            <div style="color: orange; font-weight:bold"><?php echo($message) ?></div>
            <br>
            <form onsubmit="return validateForm()" action="procedure/login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit" value="Login">
            </form>
			<div>[ <a href="createaccount.php">Create Account</a> | <a href="forgotpassword.php">Forgot Password</a> ]</div>
        </div>
    </section>

    

    <div style="text-align: center;">
        <p>If you need assistance logging in please contact itsupport@ksci.com for technical support. Please note that KSCI cannot change your KSU email.</p>
    </div>

    <footer>
        <p>&copy; 2023 KSCI</p>
    </footer>

</body>

</html>
