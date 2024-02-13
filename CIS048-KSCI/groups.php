<?php
// This page will display all gruops in the system regardless of who is logged in

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
}

if (isset($_POST['search'])) {
    // Get all groups that match search
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://poppatees.com/KSUProject/group/?search=".$_POST['search']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = json_decode($response);
} else {
    // Get all groups
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://poppatees.com/KSUProject/group/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = json_decode($response);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Groups</title>
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
            <section>
                <h2 class="memtitle">Explore Groups</h2>
				
                <hr>
				<section class="prettytext">
				<section class="search-section" id="search-section">
<form action='groups.php' method='post'>
    <input type='text' name='search'>
    <button type='submit' class='btn btn-primary'>Search</button>
</form>

</section>
</section>
            </section>
            <section class="prettytext">
			<div class="container p-3 my-3 border">
                <p id="groups">
                    <?php
                    // Loop through groups and display
                    foreach ($response as $group) {
                        echo "<div><b><a href='groupdetail.php?groupid=$group->GroupId'>$group->GroupName</a></b> - $group->Details</div><br>";
                    }
                    ?>
                </p>
				</div>
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
