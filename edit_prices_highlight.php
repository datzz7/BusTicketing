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
  
    <title>Defaul Prices</title>

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
        table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #left{
          float:left;
          padding: 20px;
        }

         td,  th {
            border: 1px solid #ddd;
            padding: 8px;
        }

         tr:nth-child(even){background-color: #f2f2f2;}

         tr:hover {background-color: #ddd;}

         th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
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
          <a href="edit_prices_highlight.php" type="submit"class="w3-bar-item w3-button">Edit Default Prices</a>
          <a href="logging_out.php" class="w3-bar-item w3-button">Log Out</a>
        </div>
    </form>

<!-- Page Content -->
<div style="margin-left:13%">



<div class="w3-container w3-teal">
  <h1>Default Prices</h1>
</div>

<?php 
include 'edit_prices.php';
?>

<div id="left">
  <form method="POST">

  Type: </br> <select name="type">
          
                <option value="7Days">7Days </option> 
                <option value="15Days">15Days </option> 
                <option value="30Days">30Days </option> 

              </select> </br>
   Price: </br> <input type="number" name="price" id="price" required="true"></br></br>

  <input type="submit" value="Update" name="submit" >

  </form>

<?php 

include 'conn.php';


if(isset($_POST['submit'])){

  $price = $_POST['price'];
  $type = $_POST['type'];

  if($price<1){

    echo "Price cannot be set to 0";
  }
  else{

    $sql = "UPDATE default_prices SET price = '$price' WHERE type = '$type'";
    $result = mysqli_query($conn, $sql);
    
    echo "Prices Updated";
  }
  

}


?>
</div>


</body>
</html>


  
    

