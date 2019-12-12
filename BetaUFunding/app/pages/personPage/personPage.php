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
    $spousePhNo = $_POST['spousePhNo'];
    // Pass phone number into session variable
    $_SESSION['phoneNo'] = $phoneNo;
    // Establish Connection
    $link = pg_connect("host=itcsdbms user= gebreks18 dbname=test3")
    or die ("Could not connect to database betaufunding");
    // Alert message
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    // Add person into DB
    function AddPerson() {
        // Creating null values
        $spousePhNo = !empty($spousePhNo) ? "'$spousePhNo'" : "NULL";
        $gradYr = !empty($gradYr) ? "'$gradYr'" : "NULL";
        // Error handling for required fields
        if (empty($phoneNo) || empty($lastName) || empty($firstName) || empty($street) || empty($zip) || empty($email)) {
            phpAlert(   "ERROR!\\n\\nFields: Last Name, First Name, Email, Phone Number, Street, Zip cannot be left blank."   );
        } else {
            // query for inserting tuple into table
            $query = "INSERT INTO person (lastName, firstName, email, phoneNo, street, zip, gradYr, spousePhNo )
                            VALUES ('$lastName', '$firstName', '$email', '$phoneNo', '$street', '$zip', '$gradYr', '$spousePhNo')";
            $result = pg_query ($query)
            or die ("\nQuery failed");
            phpAlert(   "SUCCESS!\\n\\n$firstName $lastName has been successfully added to the database."   );
        }
    }
    if ($_POST['action'] == 'yes') {
        //AddPerson();
        header("Location: http://jcsites.juniata.edu/students/gebreks18/betaufunding/pledgepage.html");
    } else if ($_POST['action'] == 'no') {
        //AddPerson();
        phpAlert(   "Thank you, and have a wonderful day!"   );
        //header("Location: http://www.juniata.edu");
    } else {
        // Invalid function
        phpAlert(   "ERROR!\\n\\nInvalid function!"   );
    }
    pg_close($link);
?>
</body>
</html>
