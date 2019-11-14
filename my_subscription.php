<?php 

require 'conn.php';

date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y-m-d");

if($_SERVER['REQUEST_METHOD']=='GET'){

	$id=$_GET['id'];

	$sql = "SELECT * FROM subscription WHERE id = '$id' ORDER BY validity DESC LIMIT 1";

	$response = mysqli_query($conn, $sql);

	$result=array();
	$result['subscriptions'] = array();

	if(mysqli_num_rows($response)>=1){
		
		$row = mysqli_fetch_assoc($response);

			$index['id'] = $row['id'];
			$index['subno'] = $row['subno'];
			$index['date_subscribed'] = $row['date_subscribed'];
			$index['validity'] = $row['validity'];
			$index['qr_code'] = $row['qr_code'];
			$index['photo'] = $row['photo'];
 

			array_push($result['subscriptions'], $index);
			


			if($row['validity']>=$currentdate){

				$date1=date_create($currentdate);
				$date2=date_create($row['validity']);
				$diff=date_diff($date1,$date2);

				$result['days_left'] = $diff->format('%d');
				$result['status'] ="Active";
				echo json_encode($result);

				mysqli_close($conn);

			}else{

				$result['days_left'] = "0";
				$result['status'] ="Expired";
				echo json_encode($result);

				mysqli_close($conn);
			}
	}
}else {
	echo 'wala';
}
		
	
?>
