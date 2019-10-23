<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <style type="text/css">
      div.container{
        margin-top: 120px;
      }

    a{
    	background-color:red;
    }
    </style>
  </head>


  <body>
    
    <div class="container">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">

<?php 

include 'conn.php';
$errors="";

if(isset($_POST['signup']))
{
	$id=uniqid();
	$username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$password = $_POST['password'];
	$psw_repeat = $_POST['psw-repeat'];


		$user_check_query= "SELECT * FROM admin WHERE username='$username'";
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);


		if($user)
		{	
			
			if($user['username']==$username)
			{
				echo '<script language="javascript">';
				echo 'alert("Username is already used.")';
				echo '</script>';
			}
		}


		if($password!=$psw_repeat)
				{
				echo '<script language="javascript">';
				echo 'alert("password does not match....")';
				echo '</script>';
	   			 }
	   			 
		
		else {
		$password = md5($password);
		$sql = "INSERT INTO admin(id,username,firstname,lastname,password) 
				VALUES('$id','$username','$firstname','$lastname','$password')";	
				
	 	if(mysqli_query($conn,$sql))
		{
		echo '<script language="javascript">';
		echo 'alert("Registered Successfully....")';
		echo '</script>';
		?>
    <script type="text/javascript">
       window.location= "logout.php";
    </script>
  <?php
     }
		}
	 }		


	$conn->close();


?>

                <form method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required="required" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Firstname</label>
                    <input type="text" name="firstname" required="required" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" name="lastname" required="required" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required="required" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Re-type Password</label>
                    <input type="password" name="psw-repeat" required="required"class="form-control"/>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" name="signup" value="Signup" class="btn btn-primary" />
                  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="admin_login.php" color="red" class="btn btn-danger">Cancel</a>
                </form>
              </div>
            </div>
            </div>
          <div class="col-md-4"></div>    
    </div>
  </div>


  </body>
</html>