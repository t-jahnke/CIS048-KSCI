

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event (Mockup) </title>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <img src="ksulogo.png" alt="Kent State Logo">
        </div>
    </header>

    <section class="content">
        <div class="addstyle">
            <h1>Enter details below to edit an event for Club</h1>
            <hr>
			<div class="container p-3 my-3 border">
            <form onsubmit="return validateForm()" action="procedure/createevent.php" method="post">
                <input type="hidden" id="groupid" name="groupid" value="<?php echo($GroupId);?>">
                <label for="groupname">Event Name</label><br>
                <input type="text" id="eventname" name="eventname" required><br><br>

                <label for="groupname">Event Location</label><br>
                <input type="text" id="eventlocation" name="eventlocation" required><br><br>
   
 <label for="groupname">Start Time</label><br>
<select id="eventstart_hour" name="eventstart_hour" required>
    <?php
    for ($hour = 0; $hour <= 23; $hour++) {
        $selected = ($hour == date('H', strtotime($EventStartDate))) ? 'selected' : '';
        echo "<option value='$hour' $selected>" . sprintf('%02d', $hour) . "</option>";
    }
    ?>
</select> :
<select id="eventstart_minute" name="eventstart_minute" required>
    <?php
    for ($minute = 0; $minute <= 59; $minute++) {
        $selected = ($minute == date('i', strtotime($EventStartDate))) ? 'selected' : '';
        echo "<option value='$minute' $selected>" . sprintf('%02d', $minute) . "</option>";
    }
    ?>
</select><br><br>

<label for="groupname">End Time</label><br>
<select id="eventend_hour" name="eventend_hour" required>
    <?php
    for ($hour = 0; $hour <= 23; $hour++) {
        $selected = ($hour == date('H', strtotime($EventEndDate))) ? 'selected' : '';
        echo "<option value='$hour' $selected>" . sprintf('%02d', $hour) . "</option>";
    }
    ?>
</select> :
<select id="eventend_minute" name="eventend_minute" required>
    <?php
    for ($minute = 0; $minute <= 59; $minute++) {
        $selected = ($minute == date('i', strtotime($EventEndDate))) ? 'selected' : '';
        echo "<option value='$minute' $selected>" . sprintf('%02d', $minute) . "</option>";
    }
    ?>
</select><br><br>

<label for="groupname">Start Date</label><br>
<select id="eventstart_month" name="eventstart_month" required>
    <?php
    for ($month = 1; $month <= 12; $month++) {
        $selected = ($month == date('m', strtotime($EventStartDate))) ? 'selected' : '';
        echo "<option value='$month' $selected>" . sprintf('%02d', $month) . "</option>";
    }
    ?>
</select> /
<select id="eventstart_day" name="eventstart_day" required>
    <?php
    for ($day = 1; $day <= 31; $day++) {
        $selected = ($day == date('d', strtotime($EventStartDate))) ? 'selected' : '';
        echo "<option value='$day' $selected>" . sprintf('%02d', $day) . "</option>";
    }
    ?>
</select> /
<select id="eventstart_year" name="eventstart_year" required>
    <?php
    $currentYear = date('Y');
    for ($year = $currentYear; $year <= $currentYear + 5; $year++) {
        $selected = ($year == date('Y', strtotime($EventStartDate))) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
    }
    ?>
</select><br><br>

<label for="groupname">End Date</label><br>
<select id="eventend_month" name="eventend_month" required>
    <?php
    for ($month = 1; $month <= 12; $month++) {
        $selected = ($month == date('m', strtotime($EventEndDate))) ? 'selected' : '';
        echo "<option value='$month' $selected>" . sprintf('%02d', $month) . "</option>";
    }
    ?>
</select> /
<select id="eventend_day" name="eventend_day" required>
    <?php
    for ($day = 1; $day <= 31; $day++) {
        $selected = ($day == date('d', strtotime($EventEndDate))) ? 'selected' : '';
        echo "<option value='$day' $selected>" . sprintf('%02d', $day) . "</option>";
    }
    ?>
</select> /
<select id="eventend_year" name="eventend_year" required>
    <?php
    $currentYear = date('Y');
    for ($year = $currentYear; $year <= $currentYear + 5; $year++) {
        $selected = ($year == date('Y', strtotime($EventEndDate))) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
    }
    ?>
</select><br><br>
   
<button type="submit" class="btn btn-warning">Edit Event</button>
<button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Cancel</button>

            </form>
        </div>
		</div>
    </section>


</body>

    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>