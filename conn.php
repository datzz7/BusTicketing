<?php

$dbconn = pg_connect(getenv("DATABASE_URL"));

// $host = "ec2-35-168-77-215.compute-1.amazonaws.com";
// $db = "d80artqjpkfnbo";
// $username = "unwnmcpugqljbn";
// $password = "9814c64a8614bc5f2686ae74f9a1a0327d745c0f40fc4b93035932b8bdab95e5";

// $dbconn = pg_connect("host=$this->host dbname=$this->db user=$this->username password=$this->password");

// $conn_string = "
// host=ec2-35-168-77-215.compute-1.amazonaws.com 
// port=5432 
// dbname=d80artqjpkfnbo 
// user=unwnmcpugqljbn 
// password=9814c64a8614bc5f2686ae74f9a1a0327d745c0f40fc4b93035932b8bdab95e5
// ";
// $dbconn = pg_connect($conn_string);

// Check Connection

?>
