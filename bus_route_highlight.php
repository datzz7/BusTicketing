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
  
    <title>Route Management</title>

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
        #route{
          margin: 10px;
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
          <a href="valid_users_highlight.php"  class="w3-bar-item w3-button">Users with valid tickets</a>
          <a href="total_highlight.php"  class="w3-bar-item w3-button">Sales Reports</a>
          <a href="add_prices_highlight.php" class="w3-bar-item w3-button">Add prices</a>
          <a href="edit_prices_highlight.php" class="w3-bar-item w3-button">Edit Default Prices</a>
          <a href="bus_route_highlight.php" type="submit"class="w3-bar-item w3-button">Manage Route</a>
          <a href="logging_out.php" class="w3-bar-item w3-button">Log Out</a>
        </div>
    </form>

<!-- Page Content -->
<div style="margin-left:13%">


<div class="w3-container w3-teal">
  <h1>Route Management</h1>
</div>

<?php 
  include 'bus_route_mange.php';
?>

  <div id="route">

    <form method="POST">

      <textarea id="route"rows="6" name="route" cols="60" placeholder="Input here...."></textarea>
      <select name="plate">
      
          <option value="TORIL-1234">TORIL-1234 </option> 
          <option value="GRND-2345">GRND-2345 </option> 

        </select>
       <input type="submit" name="submit">

    </form>

  </div>

<?php 
  require 'conn.php';
 
  if(isset($_POST['submit'])){
    
    $route = $_POST['route'];
    $plate = $_POST['plate'];
    
    $sql = "UPDATE bus_route R SET R.route_description ='$route' WHERE R.plate = '$plate'";
    $conn->query($sql);

    }
?>



</body>
</html>


  
    

