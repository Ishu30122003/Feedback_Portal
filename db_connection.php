php
<?php

$server = "localhost"; 
$username = "root"; 
$pwd = ""; 
$database = "project"; 


$con= new mysqli($server, $username, $pwd, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

