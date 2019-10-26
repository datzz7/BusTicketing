<?php 

require 'conn.php';


date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y-m-d");

if($_SERVER['REQUEST_METHOD']=='GET'){

	$qr_code = $_GET['qr_code'];

	$sql = "SELECT firstname, lastname, qr_code, date_subscribed,validity FROM subscription inner join users on qr_code = '$qr_code' and subscription.id=users.id";

	$response = mysqli_query($conn, $sql);

	$result=array();
	$result['qrresult'] = array();


	if(mysqli_num_rows($response)>=1){
		
		$row = mysqli_fetch_assoc($response);

		$index['firstname'] = $row['firstname'];
		$index['lastname'] = $row['lastname'];
		$index['date_subscribed'] = $row['date_subscribed'];
		$index['validity'] = $row['validity'];
	


		array_push($result['qrresult'], $index);

		if($row['validity']>=$currentdate){

			$sql_passengers = "INSERT INTO total_passengers (date_transac,passengers) VALUES ('$currentdate',1) ON DUPLICATE KEY UPDATE passengers = passengers +1 ";
			$conn->query($sql_passengers);

			$result['status'] ="Active";
			echo json_encode($result);

			mysqli_close($conn);
				

		}else{

			$result['status'] ="Expired";
			echo json_encode($result);

			mysqli_close($conn);
		}

	}else{

		$result['status'] ="NotExist";
		echo json_encode($result);
		mysqli_close($conn);

	}


}





?>
