<?php 

require 'conn.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
	
	$email = $_POST['email'];
	$code = $_POST['code'];
	$password = $_POST['password'];
	$password = md5($password);

	$sql = "SELECT * FROM temp_password_reset WHERE code = '$code' AND email = '$email'";
	$response = mysqli_query($conn, $sql);

	if(mysqli_num_rows($response)==1){

		$row = mysqli_fetch_assoc($response);
		$id = $row['id'];
		$change_pass = mysqli_query($conn,"UPDATE users SET `password` = '$password' where id = '$id'");

		
		if($change_pass){

			$delete = "DELETE FROM temp_password_reset WHERE code = '$code' AND email = '$email'";
			mysqli_query($conn, $delete);

			$result['result'] = "Updated";
			echo json_encode($result);
			mysqli_close($conn);
		}


	}
	else{
		$result['result'] = "Code is invalid";
		echo json_encode($result);
		mysqli_close($conn);
	}
}
?>
