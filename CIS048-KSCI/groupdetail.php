<?php
// This page will display group details given a group id in the query string

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"]) or !isset($_GET["groupid"])) {
    header("Location: login.php");
}
    $UserId = $_SESSION["UserId"];    
    $GroupId = $_GET["groupid"];


    // Get group detail
    $ch = curl_init();
    $url = "http://poppatees.com/KSUProject/group/?groupid=".$_GET['groupid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = json_decode($response);
	
	// Get group members
	$ch = curl_init();
	$url = "http://poppatees.com/KSUProject/members/?groupid=".$_GET['groupid'];
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$members = curl_exec($ch);
	$members = json_decode($members);
    
    // get all users
    $ch = curl_init();
	$url = "http://poppatees.com/KSUProject/user/";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$users = curl_exec($ch);
	$users = json_decode($users);
	
    // Get events for group
    $url = "http://poppatees.com/KSUProject/event/?groupid=".$_GET['groupid'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $events = curl_exec($ch);
    $events = json_decode($events);



foreach ($events as $event) {
    $startDateTime = (new DateTime($event->StartDateTime))->format("m/d/Y h:i a");
    $endDateTime = (new DateTime($event->EndDateTime))->format("m/d/Y h:i a");

    $fullCalendarEvent = array(
        'title' => $event->EventName,
        'start' => $startDateTime,
        'end' => $endDateTime,
		'location' => $event->EventLocation
    );
	
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
	    .event-box {
        border: 1px solid; /* Blue border */
		border-left: 1px solid;
		border-left-width: 6px;
		border-left-style: solid;
		border-left-color: #00205B;
        padding: 5px; /* Padding around the event */
        margin: 10px; /* Margin between events */
        background-color: #f0f0f0; /* Light blue background color */
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Detail</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include("import/header.php"); ?>
    <section class="main-content">
        <?php include("import/sidebar.php"); ?>

        <div class="content">
            <section>
                <h2 class="memtitle">Group Detail</h2>
                

<hr>
				<?php
			echo ("<div><b><button type='button' class='btn btn-secondary' onclick=\"location.href='http://poppatees.com/KSUProject/groups.php'\"><- List of All Groups</button></b></div>");
			?>
				<?php
                    $IsMember = false;
					foreach ($members as $member) {
						if ($UserId == $member->UserId)
						{
							$IsMember = true;
						}
					}
				?>
            </section>
            <section class="prettytext">
			<div class="container p-3 my-3 border">
                <p id="groups">
                    <?php
                        foreach ($response as $group) {
                            $PresidentId = $group->PresidentId;        
                            $GroupId = $group->GroupId;
                            echo ("<div>");
                                echo ("<div><h1>$group->GroupName</h1></div>");
                                echo ("<div><b>Type:</b> $group->GroupTypeName</div>");
                                echo ("<div><b>President:</b> $group->President</div>");
                                echo ("<div><b>Location:</b> $group->Location</div>");
                                echo ("<div><b>Website:</b> <a href='$group->Website' target='_blank'>$group->Website</a></div>");
                                echo ("<div><b>Details:</b> $group->Details</div>");
								 // Format start date and time for display
								$CreatedTimeDisplay = date("m/d/Y h:i a", strtotime($group->Created));
								echo ("<div><b>Created:</b> $CreatedTimeDisplay</div>");
								echo ("<br>");
								
								                    if ($IsMember) {
echo ("<button type='button' class='btn btn-danger' onclick=\"location.href='procedure/leavegroup.php?groupid=$GroupId&userid=$UserId'\">Leave This Group</button>");
} else {
    echo ("<button type='button' class='btn btn-primary' onclick=\"location.href='procedure/joingroup.php?groupid=$GroupId&userid=$UserId'\">Request To Join This Group</button>");
}
echo ("<br>");
                                if ($_SESSION["UserId"] == $group->PresidentId)
                                {
echo ("<br>");
echo ("<div>");
echo ("<button type='button' class='btn btn-warning' onclick=\"location.href='editgroup.php?groupid=" . $_GET['groupid'] . "'\">Edit Group</button>");
echo ("</div>");
echo ("<br>");
echo ("<div>");
echo ("<button type='button' class='btn btn-warning' onclick=\"location.href='manageevent.php?groupid=" . $_GET['groupid'] . "'\">Manage Events</button>");
echo ("</div>");
                                }
                            echo ("</div>");
							
                        }
                    ?>
                </p>
				</div>
                <p>&nbsp;</p>
				<div class="container p-3 my-3 border">
				<h2 class="memtitle">Members</h2>
				
				<hr>
				<p id="members">
					<?php
                    $IsPresident = false;
                    if ($UserId == $PresidentId)
                    {
                        $IsPresident = true;
                    }
                    
                    $MembersArray = array();
					foreach ($members as $member) {
                        array_push($MembersArray,$member->UserId);
						echo ("<div>");
							echo ("<div><b>");
                            echo $member->Member;
                            if ($IsPresident && $member->UserId <> $PresidentId)
                            {
echo ("<br><button type='button' class='btn btn-danger' onclick=\"location.href='procedure/leavegroup.php?userid=" . $member->UserId . "&groupid=" . $GroupId . "'\">Remove</button>");

                            }
                            echo ("</b></div>");
						echo ("</div>");
					}

                    if ($IsPresident){
                        echo ("<div><p>&nbsp;<p>");
                            echo ("<form action='procedure/addusertogroup.php' method=post>");
                                echo ("<input type=hidden name=groupid value='".$GroupId."'>");
                                echo ("<select name=userid>");
                                foreach ($users as $user) {
                                    if (!in_array($user->UserId, $MembersArray)){
                                        echo ("<option value='".$user->UserId."'>".$user->FirstName." ".$user->LastName."</option>");
                                    }
                                }							
echo ("</select>");
echo ("&nbsp;<button type='submit' class='btn btn-success'>Add User</button><br>");
echo ("</form>");

                        echo ("</div>");
                    }

					?>
				
				</p>
				
				</div>
				<div class="container p-3 my-3 border">
				<h2 class="memtitle">Events</h2>
				<hr>
				<p id="events">
					<?php
        foreach ($events as $event) {
            echo ("<div class='event-box'>"); // Add a class for styling
            echo ("<div><b>Group Name:</b> $event->GroupName</div>");
            echo ("<div><b>Event Name:</b> $event->EventName</div>");

            // Format start date and time for display
            $startDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->StartDateTime));
            echo ("<div><b>Start Date:</b> $startDateTimeDisplay</div>");

            // Format end date and time for display
            $endDateTimeDisplay = date("m/d/Y h:i a", strtotime($event->EndDateTime));
            echo ("<div><b>End Date:</b> $endDateTimeDisplay</div>");

            echo ("<div><b>Location:</b> $event->EventLocation</div>");
            echo ("<div>&nbsp;</div>");
            echo ("</div>");
			
			
        }
        ?>
				</p>
				</div>
            </section>
        </div>
    </section>


    <script>
  document.addEventListener('DOMContentLoaded', function() {
            var username = "<?php echo($_SESSION["UserName"]) ?>";
            var welcomeMessage = document.getElementById('welcome-message');
            welcomeMessage.textContent = 'Welcome, ' + username;
        });
</script>

</body>
    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>