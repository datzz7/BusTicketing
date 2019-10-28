<?php 

require 'conn.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

	$code = $_POST['code'];
	$email = $_POST['email'];

	$sql = "SELECT * FROM temp_email_verification WHERE code = '$code' AND email = '$email' ";
	$response = mysqli_query($conn, $sql);

	if(mysqli_num_rows($response)==1){

		$row = mysqli_fetch_assoc($response);

		$delete = "DELETE FROM temp_email_verification WHERE code = '$code'";
		mysqli_query($conn, $delete);

		$result['result'] = "Valid";
		echo json_encode($result);
		mysqli_close($conn);


	}
	else{
		$result['result'] = "Code is invalid";
		echo json_encode($result);
		mysqli_close($conn);
	}
}
?>
