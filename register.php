<?php 

include 'conn.php';

//unique id
$uniqueIDgenerator1 = substr(uniqid(rand(), true), 15, 4); 
$uniqueIDgenerator2 = random_int(0, 1000);

$uniqueIDgenerator = $uniqueIDgenerator1."d4tS".$uniqueIDgenerator2;

$check_id= "SELECT id FROM users where id='$uniqueIDgenerator'";
$res = mysqli_query($conn, $check_id);
$result1 = mysqli_fetch_assoc($res);

if($result1['id']==$uniqueIDgenerator){

	$uniqueIDgenerator2 = random_int(0, 1000); 
}



$uniqueID = $uniqueIDgenerator;
$email = $_POST['email'];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password =$_POST["password"];
$subscription = $_POST["subscription"];
$password = md5($password);
$qr_code = md5(uniqid());

date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y/m/d");


// $check = "SELECT * FROM users where email='$email'";

//  $response = mysqli_query($conn, $check);
//  $result = mysqli_fetch_assoc($response);

 
 // $result['exists'] = array();


//if($_SERVER['REQUEST_METHOD']=='POST'){

	if($subscription == "7Days"){

		$d = strtotime("+7 Day");
		$validitydate = date("Y/m/d", $d);



		$sql1 =	"INSERT INTO users (id, email, firstname, lastname, password) VALUES ('$uniqueID','$email','$firstname','$lastname', '$password')";	
		$conn->query($sql1);

		$sql2 = "INSERT INTO subscription(id, type ,date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'7Days','$currentdate' , '$validitydate', '$qr_code')";
		$conn->query($sql2);

		$sql3 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID', (SELECT subno from subscription where id='$uniqueID'), 300)";
		$conn->query($sql3);
		
		$conn->close();
	}
	else if($subscription =="15Days"){

		$d = strtotime("+15 Day");
		$validitydate = date("Y/m/d", $d);



		$sql1 =	"INSERT INTO users (id, email, firstname, lastname, password) VALUES ('$uniqueID','$email','$firstname','$lastname', '$password')";	
		$conn->query($sql1);


		$sql2 = "INSERT INTO subscription(id, type ,date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'15Days','$currentdate' , '$validitydate', '$qr_code')";
		$conn->query($sql2);

		$sql3 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID', (SELECT subno from subscription where id='$uniqueID'), 600)";
		$conn->query($sql3);
		
		$conn->close();

	}
	else if($subscription == "30Days"){

		$d = strtotime("+30 Day");
		$validitydate = date("Y/m/d", $d);



		$sql1 =	"INSERT INTO users (id, email, firstname, lastname, password) VALUES ('$uniqueID','$email','$firstname','$lastname', '$password')";	
		$conn->query($sql1);


		$sql2 = "INSERT INTO subscription(id, type ,date_subscribed, validity, qr_code) VALUES ('$uniqueID',
		'30Days','$currentdate' , '$validitydate', '$qr_code')";
		$conn->query($sql2);

		$sql3 = "INSERT INTO payment(id,subno, amount) VALUES('$uniqueID', (SELECT subno from subscription where id='$uniqueID'), 1100)";
		$conn->query($sql3);
		
		$conn->close();

	}
	
		// $res['message'] ="0";
		// echo json_encode($res);
		
		// mysqli_close($conn);

//}
// else{		

// 			$res['message'] ="1";
// 			echo json_encode($res);
			
// 			mysqli_close($conn);
// 		}




	

//$sql =	"INSERT INTO users (email, firstname, lastname, password) VALUES ('$email','$firstname','$lastname', '$password')";	

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else 	{
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }


//$conn->close();


?> 


<!--<?php 

//include 'conn.php';

//$email = $_POST["email"];
//$firstname = $_POST["firstname"];
//$lastname = $_POST["lastname"];
//$password = $_POST["password"];

//$sql = "SELECT * from users where email = '$email'";



//$sql =	"INSERT INTO users (email, firstname, lastname, password) VALUES ('$email','$firstname','$lastname', '$password')";	

//if ($conn->query($sql) === TRUE) {
   //echo "New record created successfully";
//} else 	{
  //echo "Error: " . $sql . "<br>" . $conn->error;
//}


//$conn->close();


?> 
