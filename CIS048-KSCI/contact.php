<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
     <?php include("import/header.php"); ?>
    <section class="main-content">
        <?php include("import/sidebar.php"); ?>
                
        <div class="content">
		<section class="prettytext">
		<section>
            <h2 class="memtitle">Contact Us</h2>
            <hr>
			</section>
			<div class="container p-3 my-3 border">
            <h2><u>Office Location:</h2></u>
            <p>Room 206 of the Business Administration (BSA), Kent Campus</p>
            <h2><u>Office Phone:</h2></u>
            <p>123-456-7890</p>
            <h2><u>Office Email:</h2></u>
            <p>generalsupport@ksci.com</p>
            <h2><u>Office Hours:</h2></u>
            <p>Monday - Friday 9 a.m. to 5 p.m.</p>
			<br><section>
            
			</section>
            <h2><u>IT Support Email:</h2></u>
            <p>itsupport@ksci.com</p>
            <h2><u>IT Support Phone:</h2></u>
            <p>234-567-8910</p>
            <!-- Add more contact information if needed -->
        </div>
		</div>
    </section>
	</section>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var username = "<?php echo($_SESSION["UserName"]) ?>";
            var welcomeMessage = document.getElementById('welcome-message');
            welcomeMessage.textContent = 'Welcome, ' + username;
        });
</script>
</body>

    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>