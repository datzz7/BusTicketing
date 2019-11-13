<?php 

require 'conn.php';

if($_SERVER['REQUEST_METHOD']=='POST'){

	$email = $_POST['email'];
	$password = md5($_POST['password']);



	$sql = "SELECT * FROM users WHERE email = '$email'";

	$response = mysqli_query($conn, $sql);

	$result=array();
	$result['login'] = array();

	if(mysqli_num_rows($response)==1){

		$row = mysqli_fetch_assoc($response);

		if(strcmp($password, $row['password']) == 0){



			$index['firstname'] = $row['firstname'];
			$index['lastname'] = $row['lastname'];
			$index['email'] = $row['email'];
			$index['id'] = $row['id'];
			$index['photo'] = $row['photo'];


			array_push($result['login'], $index);

				
			$result['success'] ="1";
			$result['message'] ="success";
			echo json_encode($result);

			mysqli_close($conn);
		}
		else{

				
			$result['success'] ="0";
			$result['message'] = "error";
			echo json_encode($result);	

			mysqli_close($conn);	
		}
	}
}


?>
