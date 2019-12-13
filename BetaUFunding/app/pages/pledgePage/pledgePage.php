<?php session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pledge Page</title>
</head>
<body>
<h1>BetaUFunding</h1>
<?php
    $amountPledged = $_POST['amountPledged'];
    $paymentPlan = $_POST['paymentPlan'];
    $projectName = $_POST['projectName'];
    $events = $_POST['events'];
    $paymentType = $_POST['paymentType'];
    $corpName = $_POST['corpName'];
    // Data passed from previous page
    $phoneNo = $_SESSION['phoneNo'];
    
    // Establish Connection
    $link = pg_connect("host=itcsdbms user= gebreks18 dbname=betaufunding2")
    or die ("Could not connect to database betaufunding");
    // Alert message
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
	if (isset($_POST)) {
		// Check to see if all fields are filled out
		if (empty($amountPledged) || empty($paymentPlan) || empty($projectName) || empty($events) || empty($paymentType) || empty($corpName)) {
			phpAlert(   "ERROR!\\n\\nPlease fill out all fields."   );
		} else {
			// query for getting eventID from database
			$result = pg_query ($link, "SELECT * FROM events WHERE eventname='$events'");
			$eventId = pg_fetch_result($result, 0, 0);
			// query to insert tuples into appropriate tables
			$query = "INSERT INTO pledge (pledgeId, amountPledged, paymentPlan, projectName, eventId, paymentType, corpName, phoneNo )
                            VALUES (DEFAULT, $amountPledged, '$paymentPlan', '$projectName', '$eventId', '$paymentType', '$corpName', '$phoneNo')";
			$result = pg_query ($query)
			or die ("\nQuery failed");
			// query to obtain pledgeId
			$result = pg_query ($link, "SELECT * FROM pledge WHERE phoneNo='$phoneNo'");
			$pledgeId = pg_fetch_result($result, 0, 0);
			$_SESSION['pledgeId'] = $pledgeId;
			$_SESSION['paymentPlan'] = $paymentPlan;
			header("Location: http://jcsites.juniata.edu/students/gebreks18/betaufunding/paymentpage.html");
			// add remaining amount attribute to pledge
		}
    }
    // Use a trigger to send a thank you email or text to who ever donates money or whenever due date is near
    // use a trigger to add whatever amount that a user pays and subtract that from the total amount that they pledged
    /*
     *  create trigger sample_trigger
     *  before insert
     *  for each row
     *  set new.marks = new.marks+6;
     * */

    // create attribute donor circle id thing for each person and check if (amount < value) => donorCircle = amethyst

    // use start date as a due date for payment
    // if undesignated use like 1 year or sth
?>
