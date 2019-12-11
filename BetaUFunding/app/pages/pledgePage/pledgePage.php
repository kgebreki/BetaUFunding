<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pledge Page</title>
</head>
<body>
<h1>BetaUFunding</h1>
<?php
    // Establish Connection
    $link = pg_connect("host=itcsdbms user= gebreks18 dbname=test3")
    or die ("Could not connect to database betaufunding");
    // Alert message
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

?>
