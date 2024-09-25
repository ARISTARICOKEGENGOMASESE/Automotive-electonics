<?php

$serverName = "tcp:electroniks.database.windows.net,1433";
$databaseName = "ecommerce";
$username = "electroniks";
$password = "Shadrack72shadrack72"; 

try {
    $conn = new PDO(
        "sqlsrv:server=$serverName;Database=$databaseName",
        $username,
        $password,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}