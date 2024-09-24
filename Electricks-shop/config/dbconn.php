<?php
// Azure MySQL connection details
$host = "electroniks.mysql.database.azure.com";  // Replace with your server name
$user = "electroniks@electroniks";           // Replace with your admin user and server name
$password = "Shadrack72shadrack72";                          // Replace with your password
$database = "electricks";                             // Replace with your database name

// Establish a connection to the Azure MySQL database
$dbconn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Set the default timezone
date_default_timezone_set("Asia/Manila");
?>
