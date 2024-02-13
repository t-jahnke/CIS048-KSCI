<?php
include('../import/db.php');
if (isset($_POST['groupname']) && isset($_POST['grouptypeid'])&& isset($_POST['presidentid']) && isset($_POST['details']) && isset($_POST['location']) && isset($_POST['website'])){
	$GroupName = $_POST['groupname'];
	$GroupTypeId = $_POST['grouptypeid'];
	$PresidentId = $_POST['presidentid'];
	$Details = $_POST['details'];
	$Location = $_POST['location'];
	$Website = $_POST['website'];

	$stmt = $database_connection->prepare("INSERT INTO Groups (GroupName, GroupTypeID, PresidentId, Details, Location, Website) VALUES (?,?,?,?,?,?);");
	$stmt->bind_param("ssssss", $GroupName, $GroupTypeId, $PresidentId, $Details, $Location, $Website);
	$result = execute_query($stmt);
 
	header('Location: ../groups.php');
}
?>