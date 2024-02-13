<?php
session_start();
if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
}

/// Get next ten events
$ch = curl_init();
$url = "http://poppatees.com/KSUProject/event/";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$eventResponse = curl_exec($ch);
$eventData = json_decode($eventResponse);

// Get events data
$ch = curl_init();
$url = "http://poppatees.com/KSUProject/event/";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$events = json_decode($response, true);

$fullCalendarEvents = array();

foreach ($events as $event) {
    $fullCalendarEvent = array(
        'title' => $event['EventName'],
        'start' => $event['StartDateTime'],
        'end' => $event['EndDateTime']
    );

    $fullCalendarEvents[] = $fullCalendarEvent;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<body>
    <?php include("import/header.php"); ?>
    <section class="main-content">
        <?php include("import/sidebar.php"); ?>
        <div class="content">
            <section>
                <h2 class="memtitle">Member Dashboard</h2>
                <hr>
            </section>
            <section class="prettytext">
                <h2><u>Events News Update</u></h2>
				<div class="content">
				<p> Here you can find the latest events coming up for your organizations. If you would like to see a list of all upcoming events, click "Events" or <a href="events.php">click here.</a> </p>
				<br>
                    <section class="prettytext">
                        <div style="float: right; width: 475px; border: 1px solid #ccc; padding: 10px;" id="calendar"></div>
                    </section>
                </div>
            </section>
			<div class="content">
            <section class="prettytext">
                <p id="events">
                  <?php
// ...

foreach($eventData as $event) {
    echo ("<div>");
    echo ("<div><b>Event Name:</b> $event->EventName</div>");

    // Format start date and time
    $startDateTime = date("m/d/Y H:i", strtotime($event->StartDateTime));
    echo ("<div><b>Start Date:</b> $startDateTime</div>");

    // Format end date and time
    $endDateTime = date("m/d/Y H:i", strtotime($event->EndDateTime));
    echo ("<div><b>End Date:</b> $endDateTime</div>");

    echo ("<div><b>Location:</b> $event->EventLocation</div>");
    echo ("<div>&nbsp;</div>");
    echo ("</div>");
}
?>

                </p>
            </section>
        </div>
		</div>
    </section>

    <footer>
        <p>&copy; 2023 KSCI</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var username = "<?php echo($_SESSION["UserName"]) ?>";
            var welcomeMessage = document.getElementById('welcome-message');
            welcomeMessage.textContent = 'Welcome, ' + username;
        });

        document.addEventListener('DOMContentLoaded', function() {
            var eventsData = <?php echo json_encode($fullCalendarEvents); ?>;

            $('#calendar').fullCalendar({
                events: eventsData,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                }
            });
        });
    </script>
</body>

</html>
<?php include("import/footer.php"); ?>
