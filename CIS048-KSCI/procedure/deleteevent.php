<?php
include('../import/db.php');
if (isset($_POST['eventid']) && isset($_POST['groupid']) ){
	
	$GroupId = $_POST['groupid'];
	$EventId = $_POST['eventid'];

	$stmt = $database_connection->prepare("DELETE FROM Events WHERE EventId = ?");
	$stmt->bind_param("s", $EventId);

	$result = execute_query($stmt);
 
	header('Location: ../manageevents?groupid='.$GroupId.'.php');
}
?>