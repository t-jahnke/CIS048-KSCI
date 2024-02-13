<?php
header("Content-Type:application/json");
include('../import/db.php');
if (isset($_GET['eventid']) && $_GET['eventid']!="") {
	//Get event based off eventid
	$query = $database_connection->prepare("SELECT E.EventId, E.EventName, E.StartDateTime, E.EndDateTime, E.EventLocation, E.Created, E.Updated, G.GroupName FROM Events E, Groups G WHERE E.EventId=? and G.GroupId = E.GroupId");
	$query->bind_param("s", $_GET['eventid']);
	execute_query_encode($query);
} elseif(isset($_GET['groupid']) && $_GET['groupid']!="") {
	//Get events for groupid
	$query = $database_connection->prepare("SELECT E.EventId, E.EventName, E.StartDateTime, E.EndDateTime, E.EventLocation, E.Created, E.Updated, G.GroupName FROM Events E, Groups G WHERE E.GroupId=? and G.GroupId = E.GroupId");
	$query->bind_param("s", $_GET['groupid']);
	execute_query_encode($query);	
} elseif(isset($_GET['userid']) && $_GET['userid']!="") {
	//Get events for groupid
	$query = $database_connection->prepare("SELECT E.EventId, E.EventName, E.StartDateTime, E.EndDateTime, E.EventLocation, E.Created, E.Updated, G.GroupName  FROM Events E, UserGroups UG, Groups G WHERE E.GroupId = UG.GroupId and UG.Status = 'A' and UG.UserId=? and G.GroupId = E.GroupId");
	$query->bind_param("s", $_GET['userid']);
	execute_query_encode($query);	
} else {
	//Get next 10 events
	$query = $database_connection->prepare("Select * From Events E, Groups G Where E.GroupId = G.GroupId and E.StartDateTime >= NOW() Order By E.StartDateTime LIMIT 10");
	execute_query_encode($query);
}
?>