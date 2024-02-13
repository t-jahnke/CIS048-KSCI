<?php
session_start();

if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

$UserId = $_SESSION["UserId"];
$ch = curl_init();
$url = "http://poppatees.com/KSUProject/members/?presidentid=".$UserId;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$response = json_decode($response);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Approvals</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
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
                <h2 class="memtitle">My Approvals</h2>
                <hr>
            </section>
            <section class="prettytext">
			

				<div class="container p-3 my-3 border">
								<div>
				<h2 class="memtitle">Approval Manager</h2>
				<hr>
				<p> Welcome to your approval manager. Here you can accept or reject user's membership requests. </p>
                </div>
                <p id="approvals">
                    <?php
                    // Loop through approcals and display
                        echo ("<table width='600'>");
                            echo ("<tr>");
                                echo ("<td><b>Group Name</b></td>");
                                echo ("<td><b>Member Requesting Access</b></td>");
                                echo ("<td><b>Accept</b></td>");
                                echo ("<td><b>Reject</b></td>");
                            echo ("</tr>");
                        foreach ($response as $approval) {
                            echo ("<tr>");
                                echo ("<td>".$approval->GroupName."</td>");
                                echo ("<td>".$approval->Member."</td>");
                               echo ("<td><button type=\"button\" class=\"btn btn-success\" onclick=\"location.href='procedure/approverequest.php?usergroupid=".$approval->UserGroupId."'\">[✓]</button></td>");
								echo ("<td><button type=\"button\" class=\"btn btn-danger\" onclick=\"location.href='procedure/rejectrequest.php?usergroupid=".$approval->UserGroupId."'\">[X]</button></td>");
                            echo ("</tr>");
                        }
                        echo ("</table>");
                    ?>
                </p>
            </section>
			<div>
        </div>
		</div>
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
