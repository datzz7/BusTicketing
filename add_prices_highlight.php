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
  
    <title>Add Prices</title>

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

        #left{
          float:left;
          padding: 10px;
        }

        #right{
          float:right;
          width: 60%;
          margin-top: 10px;
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
          <a href="total_highlight.php" class="w3-bar-item w3-button">Sales Reports</a>
          <a href="add_prices_highlight.php"   type="submit" class="w3-bar-item w3-button">Add prices</a>
          <a href="edit_prices_highlight.php" class="w3-bar-item w3-button">Edit Default Prices</a>
          <a href="logging_out.php" class="w3-bar-item w3-button">Log Out</a>
        </div>
    </form>

<!-- Page Content -->
<div style="margin-left:13%">


<div class="w3-container w3-teal">
  <h1>Add prices</h1>
</div>


<?php
include 'add_prices.php';
?>
</br>

<div id="left">
<form method="POST">

Name/Description: </br> <input type="text" name="name" id="name" required="true"></br>
Price: </br> <input type="number" name="prices" id="prices" required="true"></br>
Date_From: </br> <input type="date" name="date_from" id="date_from" required="true"></br>
Date_To: </br> <input type="date" name="date_to" id="date_to" required="true"></br>
Type: </br> <select name="type">
        
              <option value="7Days">7Days </option> 
              <option value="15Days">15Days </option> 
              <option value="30Days">30Days </option> 

            </select>
</br> </br> 

<input type="submit" value="Add" name="submit" >

</form>

</div>

  <div id="right">
  
    <form method="POST">

    Id : </br> 
    <input type="text" name="id" id="id">
    <input type="submit" value="Delete" name="delete" >

    </form></br>
<?php
  require 'conn.php';
      if(isset($_POST['delete'])){
      $id = $_POST['id'];

      $check = "SELECT * FROM prices WHERE id ='$id'";
      $result = mysqli_query($conn, $check);

      if(mysqli_num_rows($result)==0){

         echo "Please Select an id from the table";

        }
          
          else{
             $sql = "DELETE FROM prices WHERE id = '$id'";
             $conn->query($sql);

              echo "Prices Deleted";
            }
       }       
       else{

        echo "Choose an Id from the table";
       }
?>

  </div>
<?php 

require 'conn.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $price = $_POST['prices'];
   $date_from = $_POST['date_from'];
   $date_to = $_POST['date_to'];
   $type = $_POST['type'];

  if($price<1){
    echo "Price cannot be set to 0";
  }

 if($price>0){

    $check = "SELECT * FROM prices WHERE ('$date_from' BETWEEN date_from and date_to) OR
      ('$date_to' BETWEEN date_from and date_to) HAVING type ='$type'";
    $result = mysqli_query($conn, $check);

  if(mysqli_num_rows($result)>=1){

   echo "Dates cannot be overlaped";

   }

  else{
      
       $sql = "INSERT INTO prices(name, price, date_from, date_to, type) VALUES('$name', '$price', '$date_from', '$date_to', '$type')";
       $conn->query($sql);
       mysqli_close($conn);


       echo "Prices added for:</br> " ;
       echo "'$name'";
    }
  }
}


//delete



?>


</body>
</html>


  
    

