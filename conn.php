<?php 

$server="ec2-35-168-77-215.compute-1.amazonaws.com";
$user="unwnmcpugqljbn";
$password="9814c64a8614bc5f2686ae74f9a1a0327d745c0f40fc4b93035932b8bdab95e5";
$dbname="d80artqjpkfnbo";

$conn = new mysqli($server, $user, $password, $dbname);

// Check Connection
if ($conn->connect_error)
{
	die("Connection failed: ". $conn->connect_error);

}
echo "Connected";
?>
