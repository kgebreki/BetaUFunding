<?php session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Person Page</title>
</head>
<body>
<h1>BetaUFunding</h1>
<?php
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $street = $_POST['street'];
    $zip = $_POST['zip'];
    $gradYr = $_POST['gradYr'];
    $spousePhoneNo = $_POST['spousePhoneNo'];
    // Pass phone number into session variable
    $_SESSION['phoneNo'] = $phoneNo;
    // Establish Connection
    $link = pg_connect("host=itcsdbms user= gebreks18 dbname=betaufunding2")
    or die ("Could not connect to database betaufunding");
	/*pg_query($link, 'LISTEN "new_user"'); // listen to notifications from trigger*/
    // Alert message
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    // Add person to db
    if (isset($_POST)) {
		// Creating null values
		$spousePhoneNo = !empty($spousePhoneNo) ? "'$spousePhoneNo'" : "NULL";
		$gradYr = !empty($gradYr) ? "'$gradYr'" : "NULL";
		// Error handling for required fields
		if (empty($phoneNo) || empty($lastName) || empty($firstName) || empty($street) || empty($zip) || empty($email)) {
			phpAlert(   "ERROR!\\n\\nFields: Last Name, First Name, Email, Phone Number, Street, Zip cannot be left blank."   );
		} else {
			// query for inserting tuple into table
			$query = "INSERT INTO person (lastName, firstName, email, phoneNo, street, zip, gradYr, spousePhoneNo, circle )
                            VALUES ('$lastName', '$firstName', '$email', '$phoneNo', '$street', '$zip', $gradYr, $spousePhoneNo, 'NULL')";
			$result = pg_query ($query)
			or die ("\nQuery failed");
			
			if ($_POST['action'] == 'yes') {
				header("Location: http://jcsites.juniata.edu/students/gebreks18/betaufunding/pledgepage.html");
			} else if ($_POST['action'] == 'no') {
				header("Location: http://www.juniata.edu");
			} else {
				// Invalid function
				phpAlert(   "ERROR!\\n\\nInvalid function!"   );
			}
		}
    }
/*	while(1) {
		$notify = pg_get_notify($link);
		if (!$notify) {
			echo "No messages\n";
		} else {
			mail($email,'BetaUFunding','Thank you for registering with BetaUFunding');
			phpAlert("Email Sent");
		}
	}*/
    pg_close($link);
?>
</body>
</html>
