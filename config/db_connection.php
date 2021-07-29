<?php
//connection strings
$serverName =  'localhost';
$dbUserName = 'root';
$dbPassword = '';
$dbName = 'hostel';
//creating connection
$connection = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
//checking connection
if (!$connection) {
    die('Connection Error' . mysqli_error($connection));
}

