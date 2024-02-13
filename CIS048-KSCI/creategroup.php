<?php
// This page will display all gruops in the system regardless of who is logged in

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
}

// Get all groups
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://poppatees.com/KSUProject/user/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$response = json_decode($response);

// Get all group types
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://poppatees.com/KSUProject/grouptype/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$grouptypes = curl_exec($ch);
$grouptypes = json_decode($grouptypes);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
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
            <h1>Enter details below to create a group</h1>
            <hr>
            <form onsubmit="return validateForm()" action="procedure/creategroup.php" method="post">
                <label for="groupname">Group Name</label><br>
                <input type="text" id="groupname" name="groupname" required><br><br>

                <label for="grouptypeid">Group Type (Use CNTL to select multiple)</label><br>
                <select id="grouptypeid" name="grouptypeid" required size=10>
                    <option value="">Please Select</option>
                    <?php
                    // Loop through groups and display
                    foreach ($grouptypes as $grouptype) {
                        echo ("<option value=\"$grouptype->GroupTypeId\">$grouptype->GroupTypeName</option>");
                    }
                    ?>
                </select><br><br>

                <label for="presidentid" >President</label><br>
                <select id="presidentid" name="presidentid" required>
                    <option value="">Please Select</option>
                    <?php
                    // Loop through groups and display
                    foreach ($response as $user) {
                        echo ("<option value=\"$user->UserId\">$user->LastName, $user->FirstName</option>");
                    }
                    ?>
                </select><br><br>

                <label for="lastname">Details</label><br>
                <input type="text" id="details" name="details" required><br><br>

                <label for="email">Location</label><br>
                <input type="text" id="location" name="location" required><br><br>

                <label for="password">Website</label><br>
                <input type="text" id="website" name="website" required><br><br>

                <input type="submit" value="Create Group"> 
                <input type="button" value="Cancel" onclick="window.location.href='index.php'">
            </form>
        </div>
    </section>




</body>

    <footer style="text-align: center;">
        <p>&copy; 2023 KSCI</p>
    </footer>
</html>
<?php include("import/footer.php"); ?>
