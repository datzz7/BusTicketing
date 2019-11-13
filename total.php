<!DOCTYPE html>
<html>
<head>
<style>
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
<?php 

include 'conn.php';

date_default_timezone_set("Asia/Singapore");
$currentdate = date("Y-m-d");

$d = strtotime("+7 Day");
$validitydate = date("Y/m/d", $d);

$sql = "SELECT COUNT(U.id) AS users,(SELECT COUNT(*) FROM subscription) AS subscription, (SELECT SUM(amount) from payment) as total, (SELECT COUNT(*) FROM subscription where type = '7Days') as 7Days, 
     (SELECT COUNT(*) FROM subscription where type = '15Days') as 15Days,
    (SELECT COUNT(*) FROM subscription where type = '30Days') as 30Days, (SELECT passengers from total_passengers WHERE date_transac='$currentdate') as passengers,(SELECT SUM(passengers) from total_passengers) as total_passengers from users U";
$result = $conn-> query($sql);



if ($result->num_rows > 0) {
       echo "<table>
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
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . "Php ".$row["total"] ."</td><td>" . $row["subscription"].  "</td><td>" .$row['total_passengers'] . "</td><td>" . $row['passengers'] . "</td><td>" . $row["7Days"]   ."</td><td>" . $row["15Days"] ."</td><td>" . $row["30Days"] . "</td><td>". $row['users'] . "</td></tr";
    }
    echo "</table>";
 } else {
     echo "<table>
       <tr>
         <th>Total Amount</th>
         <th>Total Subscriptions</th>
         <th>Total Passengers for this day</th>
         <th>7Days Subscribers</th>
         <th>15Days Subscribers</th>
         <th>30Days Subscribers</th>
         <th>Total Users</th>
       </tr>";
     
        echo "<tr><td>" ."0" ."</td><td>" ."0".  "</td><td>" . "0" . "</td><td>" . "0" . "</td><td>" . "0".      "</td><td>" . "0"  .  "</td><td>" . "0" . "</td><td>" .  
        "0". "</td><td>" .   "</td></tr>";
    echo "</table>";
 }

$conn->close();
?> 

</body>
</html>
