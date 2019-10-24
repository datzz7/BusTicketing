<?php 

include 'conn.php';

$uniqueID =$_POST['uniqueID'];
$subscription =$_POST["subscription"];
//$subno = $_POST['subno'];
$qr_code = md5(uniqid());

date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y/m/d");
 
 // $result['exists'] = array();


	if($subscription == "7Days"){

		$d = strtotime("+7 Day");
		$validitydate = date("Y/m/d", $d);


		$sql = "INSERT INTO subscription(id,type, date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'7Days','$currentdate', '$validitydate', '$qr_code')";
		$conn->query($sql);

		$sql2 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID',(SELECT subno from subscription where id='$uniqueID' ORDER BY subno DESC LIMIT 1), 300)";
		$conn->query($sql2);

		$conn->close();
	}
	else if($subscription =="15Days"){

		$d = strtotime("+15 Day");
		$validitydate = date("Y/m/d", $d);


		$sql1 = "INSERT INTO subscription(id,type ,date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'15Days','$currentdate' , '$validitydate', '$qr_code')";
		$conn->query($sql1);

		$sql2 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID',(SELECT subno from subscription where id='$uniqueID' ORDER BY subno DESC LIMIT 1), 600)";
		$conn->query($sql2);
		
		$conn->close();

	}
	else if($subscription == "30Days"){

		$d = strtotime("+30 Day");
		$validitydate = date("Y/m/d", $d);


		$sql1 = "INSERT INTO subscription(id, type,date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'30Days','$currentdate' , '$validitydate', '$qr_code')";
		$conn->query($sql1);

		$sql2 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID', (SELECT subno from subscription where id='$uniqueID' ORDER BY subno DESC LIMIT 1), 1100)";
		$conn->query($sql2);
		
		$conn->close();

	}
	
		
?>
