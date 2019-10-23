<?php 

$server="localhost";
$user="root";
$password="";
$dbname="bus_ticketing";

$conn = new mysqli($server, $user, $password, $dbname);

// Check Connection
// if ($conn->connect_error)
//{
//	die("Connection failed: ". $conn->connect_error);

//}
//echo "Connected";
?>