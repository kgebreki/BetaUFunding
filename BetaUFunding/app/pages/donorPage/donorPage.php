<!--********************************************************************************************************************
    ** Database Management Systems                                                                                    **
    ** PHP Exercise                                                                                                   **
    ** 11/25/2019                                                                                                     **
    **                                                                                                                **
    ** Kaleb Gebrekirstos, Nick Smith, Justin Wagner                                                                  **
    **                                                                                                                **
    ** Project Summary: The objective of this assignment was to give students first-hand experience with using PHP    **
    ** to manipulate data from a static webpage that has a backend connected to a database. Through this project, we  **
    ** were able to insert and delete tuples from the Donor table in the database betaUFunding.                       **
    **                                                                                                                **
    ** Assumptions/Limitations during the system design include - database populated with only one pledgeId '22222',  **
    ** thus currently unable to insert a different pledgeId since it is a foreign key to pledge table & a donor must  **
    ** be matched by a corporation when making pledge. These assumptions will be addressed later on.                  **
    **                                                                                                                **
    ** PHP file for processing queries.                                                                               **
    **                                                                                                                **
    ********************************************************************************************************************
    -->
<html>
<head>
    <meta name="GENERATOR" content="Microsoft FrontPage 5.0">
    <meta name="ProgId" content="FrontPage.Editor.Document">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Presidents Table</title>
</head>
<body>
<h1>Person Table</h1>
<?php
// Establish Connection
$link = pg_connect("host=itcsdbms user= gebreks18 dbname=test3")
or die ("Could not connect to database betaufunding");
// Alert message
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
$SSN = $_POST['SSN'];
$pledgeId = $_POST['pledgeIds'];
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$street = $_POST['street'];
$zip = $_POST['zip'];
$gradYr = $_POST['gradYr'];
$corpName = $_POST['corpName'];
$spouseSSN = $_POST['spouseSSN'];

if ($_POST['action'] == 'insert') {
    // Creating null values
    $spouseSSN = !empty($spouseSSN) ? "'$spouseSSN'" : "NULL";
    $gradYr = !empty($gradYr) ? "'$gradYr'" : "NULL";
    // Error handling for required fields
    if (empty($SSN) || empty($lastName) || empty($firstName) || empty($street) || empty($zip) || empty($corpName)) {
        phpAlert(   "ERROR!\\n\\nFields: SSN, Pledge Id, Last Name, First Name, Street, Zip, Matching Corporation cannot be left blank."   );
    } else {
        // query for inserting tuple into table
        $query = "INSERT INTO person (SSN, pledgeId, lastName, firstName, street, zip, gradYr, corpName, spouseSSN)
                        VALUES ($SSN, '$pledgeId', '$lastName', '$firstName', '$street', $zip, $gradYr, '$corpName', $spouseSSN)";
        $result = pg_query ($query)
        or die ("\nQuery failed");
        phpAlert(   "SUCCESS!\\n\\nDonor Id $SSN has been successfully added to the donor table."   );
    }
} else if ($_POST['action'] == 'delete') {
    if (empty($SSN)) {
        phpAlert(   "ERROR!\\n\\nField: Social Security Number cannot be left blank."   );
    } else {
        // query for deleting tuple
        $query = "DELETE FROM person WHERE SSN=$SSN";
        $result = pg_query ($query)
        or die ("Query failed");
        phpAlert(   "SUCCESS!\\n\\nDonor Id $SSN has been successfully removed from the donor table."   );
    }
} else if ($_POST['action'] == 'report') {
    // query for fetching tuples
    $query = "SELECT * FROM person";
    $result = pg_query ($query)
    or die ("\nQuery failed");
    // displaying result
    print "<table style='border-collapse:collapse'>\n";
    print "\t<tr>\n";
    print "\t\t<td align='center' width='100'>SSN</td>\n";
    print "\t\t<td align='center' width='100'>pledgeId</td>\n";
    print "\t\t<td align='center' width='100'>lastName</td>\n";
    print "\t\t<td align='center' width='100'>firstName</td>\n";
    print "\t\t<td align='center' width='100'>street</td>\n";
    print "\t\t<td align='center' width='100'>zip</td>\n";
    print "\t\t<td align='center' width='100'>gradYr</td>\n";
    print "\t\t<td align='center' width='100'>corpName</td>\n";
    print "\t\t<td align='center' width='100'>spouseSSN</td>\n";
    print "\t</tr>\n";
    while($line = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
        print "\t<tr>\n";
        while(list($col_name, $col_value) = each($line)){
            print "\t\t<td align='center' width='100'>$col_value</td>\n";
        }
        print "\t</tr>\n";
    }
    print "<table>\n";
} else {
    // Invalid function
    phpAlert(   "ERROR!\\n\\nInvalid function!"   );
}
pg_close($link);
?>
</body>
</html>
