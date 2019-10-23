<?php 

include 'conn.php';

$email = $_POST['email'];

$check = "SELECT * FROM users where email='$email'";

 $response = mysqli_query($conn, $check);
 $result = mysqli_fetch_assoc($response);

 
 // $result['exists'] = array();
 

if(!$result['email']==$email){

	sleep(1);
		$res['message'] ="0";
		echo json_encode($res);
		mysqli_close($conn);

}

else{		

	sleep(1);

	$res['message'] ="1";
	echo json_encode($res);	
	mysqli_close($conn);
		
	}
	



?> 