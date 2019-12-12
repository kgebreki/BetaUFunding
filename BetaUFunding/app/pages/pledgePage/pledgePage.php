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
    $projects = $_POST['projects'];
    $events = $_POST['events'];
    $paymentOption = $_POST['paymentOption'];
    $matchingCorp = $_POST['matchingCorp'];

    // Establish Connection
    $link = pg_connect("host=itcsdbms user= gebreks18 dbname=test3")
    or die ("Could not connect to database betaufunding");
    // Alert message
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
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
