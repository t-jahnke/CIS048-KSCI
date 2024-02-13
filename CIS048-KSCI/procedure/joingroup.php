<?php
include('../import/db.php');
include('../import/authorize.php');
if (isset($_GET['groupid']) && isset($_GET['userid']) ){
	$GroupId = $_GET['groupid'];
	$UserId = $_GET['userid'];
	$stmt = $database_connection->prepare("INSERT INTO UserGroups (GroupId, UserId, Status) VALUES (?,?,'R')");
	$stmt->bind_param("ss", $GroupId, $UserId);
	$result = execute_query($stmt);
	header('Location: ../groupdetail.php?groupid='.$GroupId);
}
?>