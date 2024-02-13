<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Account</title>
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
        <div class="addstyle">
            <h1>Enter details below to create user account.</h1>
            <hr>
			<div class="container p-3 my-3 border">
            <form onsubmit="return validateForm()" action="procedure/createaccount.php" method="post">
                <label for="firstname">First Name</label><br>
                <input type="text" id="firstname" name="firstname" required><br><br>

                <label for="lastname">Last Name</label><br>
                <input type="text" id="lastname" name="lastname" required><br><br>

                <label for="email">Email</label><br>
                <input type="text" id="email" name="email" required><br><br>

                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br><br>

             <button type="submit" class="btn btn-success">Create Account</button>
<button type="button" class="btn btn-secondary" onclick="window.location.href='login.php'">Cancel</button>

            </form>
        </div>
		 </div>
    </section>



</body>

        <footer style="text-align: center;">
		<p>If you need assistance logging in please contact itsupport@ksci.com for technical support. Please note that KSCI cannot change your KSU email.</p>
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>
