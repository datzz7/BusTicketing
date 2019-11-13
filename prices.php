<?php 

require 'conn.php';

date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y-m-d");

$sql = "SELECT * FROM prices WHERE ('$currentdate' BETWEEN date_from and date_to) HAVING type ='7Days' ";
$response = mysqli_query($conn, $sql);
$result=array();
$result['prices'] = array();

if(mysqli_num_rows($response)>=1){

	while($row = mysqli_fetch_assoc($response)){

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
}
	

}else{
	$sql = "SELECT * FROM default_prices where type = '7Days'";
	$response = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($response);

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
	
}

$sql = "SELECT * FROM prices WHERE ('$currentdate' BETWEEN date_from and date_to) HAVING type ='15Days'";
$response = mysqli_query($conn, $sql);

if(mysqli_num_rows($response)>=1){

	while($row = mysqli_fetch_assoc($response)){

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
}
	

}else{
	$sql = "SELECT * FROM default_prices where type = '15Days'";
	$response = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($response);

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
	
}

$sql = "SELECT * FROM prices WHERE ('$currentdate' BETWEEN date_from and date_to) HAVING type ='30Days' ";
$response = mysqli_query($conn, $sql);

if(mysqli_num_rows($response)>=1){

	while($row = mysqli_fetch_assoc($response)){

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
}
	

}else{
	$sql = "SELECT * FROM default_prices where type = '30Days'";
	$response = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($response);

	$index['name'] = $row['name'];
	$index['price'] = $row['price'];
	$index['type'] = $row['type'];

	array_push($result['prices'], $index);
	
}

	echo json_encode($result);
	mysqli_close($conn);






?>
