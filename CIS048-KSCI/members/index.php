<?php
header("Content-Type:application/json");
include('../import/db.php');
if (isset($_GET['groupid']) && $_GET['groupid']!="") {
	// Get users based off groupid	
	$query = $database_connection->prepare("SELECT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as Member, U.UserId FROM Groups G, Users U, UserGroups UG WHERE G.GroupId=? and G.GroupId = UG.GroupId and UG.UserId = U.UserId and UG.Status = 'A'");
	$query->bind_param("s", $_GET['groupid']);
	execute_query_encode($query);
} elseif(isset($_GET['presidentid']) && $_GET['presidentid']!="") {
	// Get all group request for groups you are president of
	$query = $database_connection->prepare("SELECT UG.UserGroupId, G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as Member, U.UserId FROM Groups G, Users U, UserGroups UG WHERE G.PresidentId=? and G.GroupId = UG.GroupId and UG.UserId = U.UserId and UG.Status = 'R'");
	$query->bind_param("s",  $_GET['presidentid']);
	execute_query_encode($query);	
} else {
	// Get all groups
	
}

?>