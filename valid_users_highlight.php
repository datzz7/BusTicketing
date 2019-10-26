<?php
  include "conn.php";
  session_start();
if(!isset($_SESSION['username']))
  {
   header('location: admin_login.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>Valid Users</title>

    <link href="bootstrap/css/w3.css" rel="stylesheet">
      <style type="text/css">

        .footer{
           position: fixed;
           left: 0px;
           bottom: 0;
           width: 100%;
                }
        div.container{
           float: right;
           padding-right: 50px;
        }

      </style>
  </head>


  <body>


    <form action="" method="post">
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:13%">
          <h3 class="w3-bar-item">Menu</h3>
          <!-- <a href="#" class="w3-bar-item w3-button">Account</a>
          <a href="arts.php"  class="w3-bar-item w3-button">Artists List</a> -->
          <a href="users_list_highlight.php"  class="w3-bar-item w3-button">All Users List</a>
          <a href="valid_users_highlight.php" type="submit" class="w3-bar-item w3-button">Users with valid tickets</a>
          <a href="total_highlight.php" class="w3-bar-item w3-button">Total</a>
          <a href="logging_out.php" class="w3-bar-item w3-button">Log Out</a>
        </div>
    </form>

<!-- Page Content -->
<div style="margin-left:13%">


<div class="w3-container w3-teal">
  <h1>Valid Users</h1>
</div>


<?php
include 'valid_users.php';
?>




</body>
</html>


  
    

