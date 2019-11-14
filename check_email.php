<?php 

require 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$code = uniqid(true);
$email = $_POST['email'];



$check = "SELECT * FROM users where email='$email'";

 $response = mysqli_query($conn, $check);
 $result = mysqli_fetch_assoc($response);

 

if(!$result['email']==$email){

		$emailTo = $email;
		$image = $_POST['image'];
// 		$path = "img/$email-$code.png";
// 		$actualpath = "http://192.168.254.194/thesis/$path";
// 		$resimage = file_put_contents($path,base64_decode($image));
		  $image1 = base64_decode($image);
		  $client_id="2102e2bbd15ed2c";
		  $timeout = 30;
		  $curl = curl_init();
		  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
		  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		  curl_setopt($curl, CURLOPT_POST, 1);
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, array('image' =>$image1));
		  $out = curl_exec($curl);
		  curl_close ($curl);
		  $pms = json_decode($out,true);

		  $url=$pms['data']['link'];

		$delete = "DELETE FROM temp_email_verification where email ='$emailTo'";
		$conn->query($delete);
	 	

		$mail = new PHPMailer(true);

			try {
				$sql = "INSERT INTO temp_email_verification VALUES('$emailTo', '$code','$url')";
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

			    $res['picture'] = $url;
				$res['message'] ="0";
				echo json_encode($res);
				mysqli_close($conn);

			}
			catch (Exception $e) {
					    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
		}

		else{		
			$res['picture'] ="0";
			$res['message'] ="1";
			echo json_encode($res);	
			mysqli_close($conn);
				
			}



?> 
