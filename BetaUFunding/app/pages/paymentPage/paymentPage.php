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
	// query for fetching tuples
    $query = "SELECT * FROM pledge";
    $result = pg_query ($query)
    or die ("\nQuery failed");
    // displaying result
    print "<table style='border-collapse:collapse'>\n";
    print "\t<tr>\n";
    print "\t\t<td align='center' width='100'>pledgeId</td>\n";
    print "\t\t<td align='center' width='100'>amountpledged</td>\n";
    print "\t\t<td align='center' width='100'>paymentplan</td>\n";
    print "\t\t<td align='center' width='100'>projectname</td>\n";
    print "\t\t<td align='center' width='100'>eventid</td>\n";
    print "\t\t<td align='center' width='100'>paymenttype</td>\n";
    print "\t\t<td align='center' width='100'>corpname</td>\n";
    print "\t\t<td align='center' width='100'>phoneno</td>\n";
    print "\t</tr>\n";
    while($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
        print "\t<tr>\n";
        while(list($col_name, $col_value) = each($line)){
            print "\t\t<td align='center' width='100'>$col_value</td>\n";
        }
        print "\t</tr>\n";
    }
    print "<table>\n";
?>