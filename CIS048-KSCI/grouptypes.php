<?php
// This page will display all gruops in the system regardless of who is logged in

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
}

// Get all groups
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://poppatees.com/KSUProject/group/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$response = json_decode($response);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Dashboard</title>
    <link rel="stylesheet" href="styles.css">
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
            <section>
                <h2 class="memtitle">Explore Groups</h2>
                <hr>
            </section>
            <section class="prettytext">
                <p id="groups">
                    <?php
                    // Loop through groups and display
                    foreach ($response as $group) {
                        echo "<div><b><a href='groupdetail.php?groupid=$group->GroupId'>$group->GroupName</a></b> - $group->Details</div>";
                    }
                    ?>
                </p>
            </section>
        </div>
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