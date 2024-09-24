<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:electroniks.database.windows.net,1433; Database = electroniks", "electroniks", "{your_password_here}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "electroniks", "pwd" => "Shadrack72shadrack72", "Database" => "electroniks", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:electroniks.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
