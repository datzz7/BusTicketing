  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <style type="text/css">
      div.container{
        margin-top: 120px;
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
              
                if(isset($_POST['username']) && isset($_POST['password']))
                {
                  $username = $_POST['username'];
                  $password = md5($_POST['password']);
                                                  
                  $sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
                  $result = mysqli_query($conn, $sql);
                  $user = mysqli_fetch_assoc($result);

                  if($user)
                  {
                    
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
         
                    require_once 'logging_in.php';
                    
                    ?>
                    <script>window.location.href='admin_dashboard.php'</script>
                   <?php 
                 } 
                  
                    else{
                  ?>
                  <div class="alert alert-danger" role="alert">
                    Username or password does not match!
                    </div>
                  <?php

                }
                }
              
                ?>
                <form method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control"/>
                  </div>
                  <input type="submit" name="login" value="Login" class="btn btn-primary" />
                  <!-- <a href="admin_signup.php" color="red" class="btn btn-primary">Sign up</a> -->
                </form>
              </div>
            </div>
            </div>
          <div class="col-md-4"></div>    
    </div>
  </div>


  </body>
</html>
