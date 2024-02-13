<?php
session_start();

if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}

$UserId = $_SESSION["UserId"];
$ch = curl_init();
$url = "http://poppatees.com/KSUProject/event/?userid=".$UserId;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$myevents = curl_exec($ch);
$myevents = json_decode($myevents);
$MyEventsArray = array();
foreach ($myevents as $myevent) {
    array_push($MyEventsArray,$myevent->EventId);
}  


$ch = curl_init();
$url = "http://poppatees.com/KSUProject/event/";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$eventResponse = curl_exec($ch);

if ($eventResponse === false) {
    // Handle cURL error
    echo "cURL Error: " . curl_error($ch);
    exit;
}

$eventData = json_decode($eventResponse);

if ($eventData === null) {
    // Handle JSON decoding error
    echo "Error decoding JSON: " . json_last_error_msg();
    exit;
}

$fullCalendarEvents = array();

foreach ($eventData as $event) {
    $startDateTime = (new DateTime($event->StartDateTime))->format("m/d/Y h:i a");
    $endDateTime = (new DateTime($event->EndDateTime))->format("m/d/Y h:i a");

    $fullCalendarEvent = array(
        'title' => $event->EventName,
        'start' => $startDateTime,
        'end' => $endDateTime,
		'location' => $event->EventLocation
    );

    $fullCalendarEvents[] = $fullCalendarEvent;
}

// ... rest of your code
?>


<!DOCTYPE html>
<html lang="en">
<style>
            .container {
            display: flex;
        }

        .calendar-container {
            flex: 1;
            width: 550px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-right: 20px;
        }

        .events-container {
            flex: 1;
        }

        .event-box {
            border: 1px solid;
            border-left: 6px solid #00205B;
            padding: 5px;
            margin: 10px;
            background-color: #f0f0f0;
        }

        /* Increase the size of the calendar buttons */
        .fc-button {
            font-size: 1em;
            padding: 1em 4em;
        }

        /* Increase the size of the event title */
        .fc-event-title {
            font-size: 1.1em;
        }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="cal.css">
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
                <h2 class="memtitle">Events</h2>
				<hr>
				<p> Welcome! Here you will find a list of all scheduled events regardless of organization membership. </p>
                
            </section>
            <div class="content">
                <section>
                    <!-- Calendar Container -->
                    <div class="container">
                        <div class="calendar-container">
						<h2 class="memtitle">Calendar</h2>
						<hr>
                            <div id="calendar"></div>
                        </div>

                        <!-- Events Container -->
						<div class="calendar-container">
                        <div class="events-container">
                            <h2 class="memtitle">All Events</h2>
                            <hr>
                            <p id="events">
        <?php
        foreach ($eventData as $event) {
            if (in_array($event->EventId, $MyEventsArray)){
				echo ("<div class='event-box'>"); // Add a class for styling
                    echo ("<div><b>Group Name:</b> $event->GroupName <b>(Member)</b></div>");
                    echo ("<div><b>Event Name:</b> $event->EventName</div>");

                    // Format start date and time for display
                    $startDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->StartDateTime));
                    echo ("<div><b>Start Date:</b> $startDateTimeDisplay</div>");

                    // Format end date and time for display
                    $endDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->EndDateTime));
                    echo ("<div><b>End Date:</b> $endDateTimeDisplay</div>");

                    echo ("<div><b>Location:</b> $event->EventLocation</div>");
                    echo ("<div>&nbsp;</div>");
                echo ("</div>");
            } else {
                echo ("<div class='event-box'>"); // Add a class for styling
                    echo ("<div><b>Group Name:</b> $event->GroupName</div>");
                    echo ("<div><b>Event Name:</b> $event->EventName</div>");

                    // Format start date and time for display
                    $startDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->StartDateTime));
                    echo ("<div><b>Start Date:</b> $startDateTimeDisplay</div>");

                    // Format end date and time for display
                    $endDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->EndDateTime));
                    echo ("<div><b>End Date:</b> $endDateTimeDisplay</div>");

                    echo ("<div><b>Location:</b> $event->EventLocation</div>");
                    echo ("<div>&nbsp;</div>");
                echo ("</div>");
            }
        }
        ?>
                            </p>
                        </div>
						</div>
                    </div>
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
document.addEventListener('DOMContentLoaded', function () {
    var eventsData = <?php echo json_encode($fullCalendarEvents); ?>;

    $('#calendar').fullCalendar({
        events: eventsData,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        eventRender: function (event, element) {
            var tooltipContent = 'Event: ' + event.title +
                '\nStart: ' + event.start.format('MMM DD, YYYY h:mm A') +
                '\nEnd: ' + event.end.format('MMM DD, YYYY h:mm A');

            if (event.location !== undefined && event.location !== null && event.location !== '') {
                tooltipContent += '\nLocation: ' + event.location;
            }

            element.attr('title', tooltipContent);
        }
    });
});


    </script>
</body>
    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>
