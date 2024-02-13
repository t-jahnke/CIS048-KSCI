<?php
// This page will display next 10 events

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"]) or !isset($_GET["groupid"])) {
    header("Location: login.php");
}
	
    // Get group detail
    $ch = curl_init();
    $url = "http://poppatees.com/KSUProject/group/?groupid=".$_GET['groupid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = json_decode($response);

    //Get events for group
    $url = "http://poppatees.com/KSUProject/event/?groupid=".$_GET['groupid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $events = curl_exec($ch);
    $events = json_decode($events);

    foreach ($response as $group) {
        $GroupId = $group->GroupId;
        $GroupName = $group->GroupName;
        $GroupTypeName = $group->GroupTypeName;
    }
?>
<!DOCTYPE html>
<html lang="en">
<style>
	    .event-box {
		float: left;
        border: 1px solid; /* Blue border */
		border-left: 1px solid;
		border-left-width: 6px;
		border-left-style: solid;
		border-left-color: #00205B;
        padding: 5px; /* Padding around the event */
        margin: 10px; /* Margin between events */
        background-color: #f0f0f0; /* Light blue background color */
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
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
                <h2 class="memtitle">Events for <?php echo($GroupName); ?> </h2>
				<hr>
							<?php	
               echo ("<div>");
echo ("<button type='button' class='btn btn-secondary' onclick=\"location.href='groupdetail.php?groupid=" . $_GET['groupid'] . "'\"> <- Back to Group</button>");
echo ("</div>");
?>
                

            </section>
			<div class="content">
            <section class="prettytext">
			<div class="container p-3 my-3 border">
			<h2 class="memtitle">Event Manager</h2>
				<hr>
				<p> Welcome to your event manager. Here you can create, modify, and delete an event. </p>
							<button type='button' class='btn btn-primary' onclick="location.href='createevent.php?groupid=<?php echo($GroupId); ?>'">Add Event</button>
                <p id="events">
                   
<?php
echo ("<table width='800'>");
echo ("<tr>");
echo ("<td><b><u>Event Name</b></u></td>");
echo ("<td><b><u>Start Time</b></u></td>");
echo ("<td><b><u>End Time</b></u></td>");
echo ("<td><b><u>Event Location</b></u></td>");
echo ("<td></td>");
echo ("<td></td>");
echo ("</tr>");

foreach ($events as $event) {
    echo ("<tr>");
    echo ("<td>$event->EventName</td>");
    $startDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->StartDateTime));
    echo ("<td>$startDateTimeDisplay</td>");
    $EndDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->EndDateTime));
    echo ("<td>$EndDateTimeDisplay</td>");
    echo ("<td>$event->EventLocation</td>");
    
    // "Edit" button
    echo ("<td><button type='button' class='btn btn-warning' onclick=\"location.href='editevent.php?eventid=$event->EventId&groupid=$GroupId'\">Edit</button></td>");

    // Empty cell for spacing
    echo ("<td></td>");

    // "Delete" button
    echo ("<td><button type='button' class='btn btn-danger' onclick=\"location.href='deleteevent.php?eventid=$event->EventId&groupid=$GroupId'\">Delete</button></td>");

    echo ("</tr>");

    // Spacer row
    echo ("<tr><td colspan='6'>&nbsp;</td></tr>");
}

echo ("</table>");
?>

                    
                </p>
				</div>
                <p>&nbsp;</p>

            </section>
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
