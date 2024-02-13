<?php
header("Content-Type:application/json");
include('../import/db.php');

// Get all group types
$stmt = $database_connection->prepare("SELECT GroupTypeId, GroupTypeName, Created, Updated FROM GroupTypes");
execute_query_encode($stmt);

?>