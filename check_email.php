<?php 

require 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = $_POST['email'];

$check = "SELECT * FROM users where email='$email'";

 $response = mysqli_query($conn, $check);
 $result = mysqli_fetch_assoc($response);

 

if(!$result['email']==$email){

		$emailTo = $email;
		$code = uniqid(true);

		$delete = "DELETE FROM temp_email_verification where email ='$emailTo'";
		$conn->query($delete);
	 	

		$mail = new PHPMailer(true);

			try {
				$sql = "INSERT INTO temp_email_verification VALUES('$emailTo', '$code')";
				$conn->query($sql);
			    //Server settings
			    //$mail->SMTPDebug = 1;                     
			    $mail->isSMTP();                                           
			    $mail->Host       = 'smtp.gmail.com';                  
			    $mail->SMTPAuth   = true;                                   
			    $mail->Username   = 'bus.ticketing.no.reply@gmail.com';                 
			    $mail->Password   = 'Datsjayson#7';                             
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
			    $mail->Port       = 587;                                   

			    //Recipients
			    $mail->setFrom('bus-ticketing-no-reply@gmail.com', 'Bus Ticketing');
			    $mail->addAddress($emailTo);     // Add a recipient
			   //$mail->addAddress('ellen@example.com');               // Name is optional
			   //$mail->addReplyTo('info@example.com', 'Information');
			   //$mail->addCC('cc@example.com');
			   //$mail->addBCC('bcc@example.com');

			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Verify Email';
			    $mail->Body    = '<h1>This contains your email verification code</h1>
										use this code: '. $code. ' to verifiy and proceed to registration.';
			    $mail->AltBody = '';							//This is the body in plain text for non-HTML mail clients

			    $mail->send();


				$res['message'] ="0";
				echo json_encode($res);
				mysqli_close($conn);

			}
			catch (Exception $e) {
					    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
		}

		else{		

			$res['message'] ="1";
			echo json_encode($res);	
			mysqli_close($conn);
				
			}



?> 
