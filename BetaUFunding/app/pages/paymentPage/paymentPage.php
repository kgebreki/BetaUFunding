<?php
	session_start();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payment Page</title>
</head>
<body>
<h1>BetaUFunding</h1>
<?php
	$amountPaid = $_POST['amountPaid'];
	$paymentDate = date("Y-m-d");
	// Data passed from previous page
	$pledgeId = $_SESSION['pledgeId'];
	$paymentPlan = $_SESSION['paymentPlan'];
	
	// Establish Connection
	$link = pg_connect("host=itcsdbms user= gebreks18 dbname=betaufunding2")
	or die ("Could not connect to database betaufunding");
	// Alert message
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	
	// query to insert payment into db
	$query = "INSERT INTO payments (paymentId, amountPaid, paymentDate, pledgeId )
                            VALUES (DEFAULT, '$amountPaid', '$paymentDate', '$pledgeId')";
	$result = pg_query ($query)
	or die ("\nQuery failed");
	phpAlert(   "SUCCESS!\\n\\n Payment has been successfully added to the database."   );
?>
