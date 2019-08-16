<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = 'native_php_sample';

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// echo "Connected successfully";