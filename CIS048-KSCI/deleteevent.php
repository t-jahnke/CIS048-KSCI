<?php
// This page will display next 10 events

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"]) or !isset($_GET["eventid"]) or !isset($_GET["groupid"]) ) {
    header("Location: login.php");
}
	
    // Get group detail
    $ch = curl_init();
    $url = "http://poppatees.com/KSUProject/group/?groupid=".$_GET['groupid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = json_decode($response);

    foreach ($response as $group) {
        $GroupId = $group->GroupId;
        $GroupName = $group->GroupName;
        $GroupTypeName = $group->GroupTypeName;
    }

    //Get event detail
    $url = "http://poppatees.com/KSUProject/event/?eventid=".$_GET['eventid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $events = curl_exec($ch);
    $events = json_decode($events);

    foreach ($events as $event) {
        $EventId = $event->EventId;
        $EventName = $event->EventName;
        $EventStartDate = $event->StartDateTime;
        $EventEndDate = $event->EndDateTime;
        $EventLocation = $event->EventLocation;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
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
            <h1>Enter details below to create an event for <?php echo($GroupName);?></h1>
            <hr>
			<div class="container p-3 my-3 border">
            <form onsubmit="return validateForm()" action="procedure/deleteevent.php" method="post">
                <input type="hidden" id="groupid" name="groupid" value="<?php echo($GroupId);?>">
                <input type="hidden" id="eventid" name="eventid" value="<?php echo($EventId);?>">
                <label for="groupname">Event Name: </label> <?php echo($EventName);?><br><br>

                <label for="groupname">Event Location: </label> <?php echo($EventLocation);?><br><br>
   
                <label for="groupname">Start Time: </label> <?php $startDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->StartDateTime));
                                    echo ($startDateTimeDisplay);?><br><br>
   
                <label for="groupname">End Time: </label> <?php $endDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->EndDateTime));
                                    echo ($endDateTimeDisplay);?><br><br>
   
<button type="submit" class="btn btn-danger">Delete Event</button>
<button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>
            </form>
			</div>
        </div>
    </section>

   
</body>

    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>
