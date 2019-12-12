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
	
	// query to insert payment into db
	$query = "INSERT INTO payments (amountPaid, paymentDate, pledgeId )
                            VALUES ('$amountPaid', '$paymentDate', '$pledgeId')";
	$result = pg_query ($query)
	or die ("\nQuery failed");
	phpAlert(   "SUCCESS!\\n\\n Pledge has been successfully added to the database."   );
?>
