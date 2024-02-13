<?php
include('../import/db.php');
include('../import/authorize.php');
if (isset($_GET['usergroupid']) && isset($_GET['usergroupid']) ){
	$UserGroupId = $_GET['usergroupid'];
	$stmt = $database_connection->prepare("Update UserGroups Set Status = 'A' Where UserGroupId=?");
	$stmt->bind_param("s", $UserGroupId);
	$result = execute_query($stmt);
	header('Location: ../myapprovals.php');
}
?>