<?php
include('../import/db.php');
include('../import/authorize.php');
if (isset($_GET['groupid']) && isset($_GET['userid']) ){
	$GroupId = $_GET['groupid'];
	$UserId = $_GET['userid'];
	$stmt = $database_connection->prepare("DELETE FROM UserGroups WHERE UserId = ? and GroupId = ?");
	$stmt->bind_param("ss", $UserId, $GroupId);
	$result = execute_query($stmt);
	header('Location: ../groupdetail.php?groupid='.$GroupId);
}
?>