<?php
include('../import/db.php');
if (isset($_POST['groupid']) && isset($_POST['groupname']) && isset($_POST['grouptypeid']) && isset($_POST['presidentid']) && isset($_POST['details']) && isset($_POST['location']) && isset($_POST['website'])){
	$GroupId = $_POST['groupid'];
	$GroupName = $_POST['groupname'];
	$GroupTypeId = $_POST['grouptypeid'];
	$PresidentId = $_POST['presidentid'];
	$Details = $_POST['details'];
	$Location = $_POST['location'];
	$Website = $_POST['website'];
	$stmt = $database_connection->prepare("UPDATE Groups SET GroupName = ?, GroupTypeId = ?, PresidentId = ?, Details = ?, Location = ?, Website = ? WHERE GroupId = ?;");
	$stmt->bind_param("sssssss", $GroupName, $GroupTypeId, $PresidentId, $Details, $Location, $Website, $GroupId);
	$result = execute_query($stmt);
	header('Location: ../groups.php');
}
?>