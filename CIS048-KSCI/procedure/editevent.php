<?php
include('../import/db.php');
if (isset($_POST['eventname']) && isset($_POST['eventid']) && isset($_POST['eventlocation']) && isset($_POST['eventstartdate']) && isset($_POST['groupid']) && isset($_POST['eventenddate'])){
	$EventName = $_POST['eventname'];
	$EventLocation = $_POST['eventlocation'];
	$EventStartDate = $_POST['eventstartdate'];
	$EventEndDate = $_POST['eventenddate'];
	$GroupId = $_POST['groupid'];
	$EventId = $_POST['eventid'];

	$stmt = $database_connection->prepare("UPDATE Events SET EventName = ?, EventLocation = ?, StartDateTime = ?, EndDateTime = ? WHERE EventId = ?");
	$stmt->bind_param("sssss", $EventName, $EventLocation, $EventStartDate, $EventEndDate, $EventId);

	$result = execute_query($stmt);
 
	header('Location: ../manageevents.php?groupid='.$GroupId.'.php');
}
?>