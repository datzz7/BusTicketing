<?php 
echo "wew";
?>

<!-- <?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
if($_SERVER['REQUEST_METHOD']=='POST'){

		$emailTo = $_POST['email'];
		$code = uniqid(true);

		$check = "SELECT * FROM users where email='$emailTo'";
		$response = mysqli_query($conn, $check);


	if(mysqli_num_rows($response)==1){
		$row = mysqli_fetch_assoc($response);
		$id = $row['id'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$fullname = $firstname." ".$lastname;
		$sql = "INSERT INTO temp_password_reset VALUES('$id','$emailTo', '$code')";
		$conn->query($sql);
	 	

		$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = 1;                      // Enable verbose debug output SMTP::DEBUG_SERVER
			    $mail->isSMTP();                                            // Send using SMTP
			    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			    $mail->Username   = 'dats.astapan@gmail.com';                     // SMTP username
			    $mail->Password   = 'Datsjayson#7';                               // SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			    $mail->Port       = 587;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom("bus-ticketing-noreply@gmail.com", 'Bus Ticketing');
			    $mail->addAddress('skreamsure@gmail.com');     // Add a recipient
			   //$mail->addAddress('ellen@example.com');               // Name is optional
			   //$mail->addReplyTo('info@example.com', 'Information');
			   //$mail->addCC('cc@example.com');
			   //$mail->addBCC('bcc@example.com');

			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Password Reset';
			    $mail->Body    = '<h1>This contains your password reset code</h1>
										use this code: '. $code. ' to reset password.';
			    $mail->AltBody = '';							//This is the body in plain text for non-HTML mail clients

			    $mail->send();
			    echo 'Message has been sent';
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}

			$result['result'] = "Sent";	
			echo json_encode($result);		
			mysqli_close($conn);
	}
	else{

		$result['result'] = "Does Not Exists";
		echo json_encode($result);
		mysqli_close($conn);
	}
	
}
?> -->
