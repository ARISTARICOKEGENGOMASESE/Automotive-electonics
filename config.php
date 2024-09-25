<?php

// Azure SQL Database connection settings
define('DB_SERVER', 'tcp:electroniks.database.windows.net,1433');
define('DB_NAME', 'ecommerce');
define('DB_USERNAME', 'electroniks');
define('DB_PASSWORD', 'Shadrack72shadrack72');

try {
    $conn = new PDO(
        "sqlsrv:Server=" . DB_SERVER . ";Database=" . DB_NAME,
        DB_USERNAME,
        DB_PASSWORD,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30,
            PDO::SQLSRV_ATTR_ENCRYPT => 1,
            PDO::SQLSRV_ATTR_TRUST_SERVER_CERTIFICATE => 0
        )
    );
    
    // If connection is successful, you can add a comment here or log it
    // error_log("Connected successfully to Azure SQL Database");
} catch (PDOException $e) {
    // Log the error and die
    error_log("Error connecting to Azure SQL Database: " . $e->getMessage());
    die("Error: Cannot connect to database. Please check the configuration.");
}