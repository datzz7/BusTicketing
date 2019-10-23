<?php 

require 'conn.php';


date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y/m/d");

$d = strtotime("+7 Day");
$validitydate = date("Y/m/d", $d);
$sql = "INSERT INTO subscription(date_subscribed, validity) VALUES ('$currentdate' , '$validitydate')";
//

$conn->query($sql);
//if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
    //echo $validitydate;
//} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
	//}

$conn->close();



?>