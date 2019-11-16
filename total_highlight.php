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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.1/html2pdf.bundle.min.js"></script>
  
    <title>Sales Reports</title>

    <link href="bootstrap/css/w3.css" rel="stylesheet">
      <style type="text/css">



        
        #element{
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            border-collapse: collapse;
            width: 50%;
        }  
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
          <a href="total_highlight.php" type="submit" class="w3-bar-item w3-button">Sales Reports</a>
          <a href="add_prices_highlight.php" class="w3-bar-item w3-button">Add prices</a>
          <a href="edit_prices_highlight.php" class="w3-bar-item w3-button">Edit Default Prices</a>
          <a href="bus_route_highlight.php" class="w3-bar-item w3-button">Manage Route</a>
          <a href="logging_out.php" class="w3-bar-item w3-button">Log Out</a>
        </div>
    </form>

<!-- Page Content -->
<div style="margin-left:13%">


<div class="w3-container w3-teal">
  <h1>Sales Reports</h1>
</div>


<form method="POST">
  
  <input type="date" name="date" required="true">
  <input type="date" name="date_to" required="true">
  <input type="submit" name="submit" value="Filter">
  
</form>
<button id="print">Download pdf</button>
<?php 
require 'conn.php';

if(isset($_POST['submit'])){
  $date=$_POST['date'];
  $date_to=$_POST['date_to'];
  echo $date." to ".$date_to;
    $sql = "SELECT COUNT(*) AS users,
(SELECT COUNT(*) FROM subscription S where (S.date_subscribed BETWEEN '$date' and '$date_to')) AS subscription,
(SELECT SUM(amount) from payment p inner join subscription s on p.subno = s.subno WHERE (s.date_subscribed BETWEEN '$date' and '$date_to')) as total,
(SELECT COUNT(*) FROM subscription  where type = '7Days'AND (date_subscribed BETWEEN '$date' and '$date_to')) as 7Day,
(SELECT COUNT(*) FROM subscription  where type = '15Days'AND (date_subscribed BETWEEN '$date' and '$date_to')) as 15Day,
(SELECT COUNT(*) FROM subscription  where type = '30Days'AND (date_subscribed BETWEEN '$date' and '$date_to')) as 30Day,
(SELECT SUM(passengers) from total_passengers WHERE (date_transac BETWEEN '$date' and '$date_to')) as passengers,
(SELECT SUM(passengers) from total_passengers) as total_passengers
FROM users U WHERE (SELECT COUNT(*) FROM subscription S WHERE U.id = S.id AND (S.date_subscribed BETWEEN '$date' and '$date_to'))";
    $result = $conn-> query($sql);

   while($row = $result->fetch_assoc()) {
          
         $total = '<td>'.$row["total"] . "</td>";
         $subscription = '<td>'.$row["subscription"]. "</td>";  
         $total_passengers = '<td>'.$row['total_passengers'] . "</td>";  
         $passengers =  '<td>'.$row['passengers'] . "</td>"; 
         $Day7 = '<td>'.$row["7Day"] . "</td>"; 
         $Day15 = '<td>'.$row["15Day"] ."</td>"; 
         $Day30 = '<td>'.$row["30Day"] . "</td>"; 
         $users = '<td>'.$row['users'] . "</td>";

            echo "<table>
       <tr>
       <th>Total Amount for</br> $date to $date_to </th>
       <th>Total Subscriptions for</br> $date to $date_to </th>
       <th>Total Passengers</br> (Overall)</th>
       <th>Total Passengers for</br> $date to $date_to </br></th>
       <th>7Days Subscribers  for</br> $date to $date_to </th>
       <th>15Days Subscribers  for</br> $date to $date_to </th>
       <th>30Days Subscribers for</br> $date to $date_to </th>
       <th>Total Users  Registered for</br> $date to $date_to </th>
       </tr>";
    // output data of each row
        echo "<tr><td>" . "Php ".$row["total"] ."</td><td>" . $row["subscription"].  "</td><td>" .$row['total_passengers'] . "</td><td>" . $row['passengers'] . "</td><td>" . $row["7Day"]   ."</td><td>" . $row["15Day"] ."</td><td>" . $row["30Day"] . "</td><td>". $row['users'] . "</td></tr";
        echo "</table>";
    

    }
 
    
 
if ($result->num_rows > 0) {

       echo "
       <table id='element'>
       <tr>
       <th>
        Reports for </br> $date to $date_to
       </th>
       </tr>
       <tr>
       <th>Total Amount </th> $total
       </tr>
       <tr>
       <th>Total Subscriptions</th> $subscription
       </tr>
       <tr>
       <th>Total Passengers</br> (Overall)</th> $total_passengers
       </tr>
       <tr>
       <th>Total Passengers for</br> $date to $date_to </br></th> $passengers
       </tr>
       <tr>
       <th>7Days Subscribers $Day7
       </tr>
       <tr>
       <th>15Days Subscribers $Day15 
       </tr>
       <tr>
       <th>30Days Subscribers $Day30
       </tr>
       <tr>
       <th>Total Users  Registered $users
       </tr> </table> ";

     }
    // output data of each row
}else{
  date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y-m-d");

$d = strtotime("+7 Day");
$validitydate = date("Y/m/d", $d);
$sql = "SELECT COUNT(U.id) AS users,(SELECT COUNT(*) FROM subscription) AS subscription, (SELECT SUM(amount) from payment) as total, (SELECT COUNT(*) FROM subscription where type = '7Days') as 7Days, 
     (SELECT COUNT(*) FROM subscription where type = '15Days') as 15Days,
    (SELECT COUNT(*) FROM subscription where type = '30Days') as 30Days, (SELECT passengers from total_passengers WHERE date_transac='$currentdate') as passengers,(SELECT SUM(passengers) from total_passengers) as total_passengers from users U";
$result = $conn-> query($sql);



    // output data of each row
    while($row = $result->fetch_assoc()) {

       $total = '<td>'.$row["total"] . "</td>";
         $subscription = '<td>'.$row["subscription"]. "</td>";  
         $total_passengers = '<td>'.$row['total_passengers'] . "</td>";  
         $passengers =  '<td>'.$row['passengers'] . "</td>"; 
         $Day7 = '<td>'.$row["7Days"] . "</td>"; 
         $Day15 = '<td>'.$row["15Days"] ."</td>"; 
         $Day30 = '<td>'.$row["30Days"] . "</td>"; 
         $users = '<td>'.$row['users'] . "</td>";

        echo "<table >
       <tr>
       <th>Total Amount</th>
       <th>Total Subscriptions</th>
       <th>Total Passengers</br> (Overall)</th>
       <th>Total Passengers for </br>$currentdate</th>
       <th>7Days Subscribers</th>
       <th>15Days Subscribers</th>
       <th>30Days Subscribers</th>
       <th>Total Users</th>
       </tr>"; 

        echo "<tr><td>" . "Php ".$row["total"] ."</td><td>" . $row["subscription"].  "</td><td>" .$row['total_passengers'] . "</td><td>" . $row['passengers'] . "</td><td>" . $row["7Days"]   ."</td><td>" . $row["15Days"] ."</td><td>" . $row["30Days"] . "</td><td>". $row['users'] . "</td></tr";
        echo "</table>";
    }
 
if ($result->num_rows > 0) {

       echo "
       <table id='element'>
       <tr>
       <th>
        Overall Reports
       </th>
       </tr>
       <tr>
       <th>Total Amount </th> $total
       </tr>
       <tr>
       <th>Total Subscriptions</th> $subscription
       </tr>
       <tr>
       <th>Total Passengers</br> (Overall)</th> $total_passengers
       </tr>
       <tr>
       <th>7Days Subscribers $Day7
       </tr>
       <tr>
       <th>15Days Subscribers $Day15 
       </tr>
       <tr>
       <th>30Days Subscribers $Day30
       </tr>
       <tr>
       <th>Total Users  Registered $users
       </tr> </table> ";

     }
         
 

}
$conn->close();

// else{
//   include 'total.php';
// }

?>


<script type="text/javascript">

  var btn = document.getElementById('print');
  btn.addEventListener("click", printFunction);
  
  // Print
  function printFunction () {
    var element = document.getElementById('element');
    
    var opt = {
        margin:       [1,2],
        filename:     'reports.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
    html2pdf(element, opt);
    
  }
  
</script>
  
  
</body>
</html>


  
    

