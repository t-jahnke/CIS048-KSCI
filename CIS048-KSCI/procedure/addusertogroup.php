<?php
include('../import/db.php');
include('../import/authorize.php');
if (isset($_POST['groupid']) && isset($_POST['userid']) ){
	$GroupId = $_POST['groupid'];
	$UserId = $_POST['userid'];
	$stmt = $database_connection->prepare("INSERT INTO UserGroups (GroupId, UserId, Status) VALUES (?,?,'A')");
	$stmt->bind_param("ss", $GroupId, $UserId);
	$result = execute_query($stmt);
	header('Location: ../groupdetail.php?groupid='.$GroupId);
}
?>