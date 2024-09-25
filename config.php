<?php

// Retrieve connection information from environment variables
$serverName = getenv('SERVER_NAME');
$databaseName = getenv('DATABASE_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

// Construct the full server name (including port)
$fullServerName = $serverName . ",1433";

try {
    // Create connection
    $conn = new PDO(
        "sqlsrv:server=$fullServerName;Database=$databaseName",
        $username,
        $password,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // If you want to confirm the connection, uncomment the next line
    // echo "Connected successfully";
}
catch(PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Function to get the database connection
function getDbConnection() {
    global $conn;
    return $conn;
}