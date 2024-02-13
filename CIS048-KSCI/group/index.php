<?php
header("Content-Type:application/json");
include('../import/db.php');
if (isset($_GET['groupid']) && $_GET['groupid']!="") {
	// Get group based off groupid	
	$query = $database_connection->prepare("SELECT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as President, G.Details, G.Location, G.Website, G.Created, G.Updated, GT.GroupTypeName, G.PresidentId, GT.GroupTypeId  FROM Groups G, Users U, GroupTypes GT WHERE G.GroupId=? and G.PresidentId = U.UserId and G.GroupTypeId = GT.GroupTypeId ");
	$query->bind_param("s", $_GET['groupid']);
	execute_query_encode($query);
} elseif(isset($_GET['grouptypeid']) && $_GET['grouptypeid']!="") {
	// Get all groups for group type
	$query = $database_connection->prepare("SELECT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as President, G.Details, G.Location, G.Website, G.Created, G.Updated, GT.GroupTypeName, G.PresidentId, GT.GroupTypeId   FROM Groups G, Users U, GroupTypes GT WHERE G.GroupTypeId = GT.GroupTypeId and G.PresidentId = U.UserId and G.GroupTypeId=?");
	$query->bind_param("s",  $_GET['grouptypeid']);
	execute_query_encode($query);	
} elseif(isset($_GET['userid']) && $_GET['userid']!="") {
	// Get all groups for group type
	$query = $database_connection->prepare("SELECT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as President, G.Details, G.Location, G.Website, G.Created, G.Updated, GT.GroupTypeName, G.PresidentId, GT.GroupTypeId   FROM Groups G, Users U, GroupTypes GT, UserGroups UG WHERE G.GroupTypeId = GT.GroupTypeId and G.PresidentId = U.UserId and UG.GroupId = G.GroupId and UG.UserId =?");
	$query->bind_param("s",  $_GET['userid']);
	execute_query_encode($query);	
} elseif(isset($_GET['search']) && $_GET['search']!="") {
	// Get all groups that match search
	$Search = "%".$_GET['search']."%";
	$query = $database_connection->prepare("SELECT DISTINCT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as President, G.Details, G.Location, G.Website, G.Created, G.Updated, GT.GroupTypeName, G.PresidentId, GT.GroupTypeId   FROM Groups G, Users U, GroupTypes GT, UserGroups UG WHERE G.GroupTypeId = GT.GroupTypeId and G.PresidentId = U.UserId and UG.GroupId = G.GroupId and G.GroupName LIKE ?");
	$query->bind_param("s", $Search);
	execute_query_encode($query);	
} else {
	// Get all groups
	$query = $database_connection->prepare("SELECT G.GroupId, G.GroupName, CONCAT(U.FirstName, ' ', U.LastName) as President, G.Details, G.Location, G.Website, G.Created, G.Updated, GT.GroupTypeName, G.PresidentId, GT.GroupTypeId  FROM Groups G, Users U, GroupTypes GT WHERE G.GroupTypeId = GT.GroupTypeId and G.PresidentId = U.UserId");
	execute_query_encode($query);
}

?>