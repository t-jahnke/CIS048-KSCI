<?php
include('../import/db.php');
if (isset($_POST['eventname']) && isset($_POST['eventlocation']) && isset($_POST['eventstartdate']) && isset($_POST['groupid']) && isset($_POST['eventenddate'])){
	$EventName = $_POST['eventname'];
	$EventLocation = $_POST['eventlocation'];
	$EventStartDate = $_POST['eventstartdate'];
	$EventEndDate = $_POST['eventenddate'];
	$GroupId = $_POST['groupid'];

	$stmt = $database_connection->prepare("INSERT INTO Events (EventName, EventLocation, StartDateTime, EndDateTime, GroupId) VALUES (?,?,?,?,?);");
	$stmt->bind_param("sssss", $EventName, $EventLocation, $EventStartDate, $EventEndDate, $GroupId);
	$result = execute_query($stmt);
 
	header('Location: ../groupdetail?groupid='.$GroupId.'.php');
}
?>