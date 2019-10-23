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

$sql = "CALL `validUsers`()";
$result = $conn-> query($sql);



if ($result->num_rows > 0) {
    echo "<table><tr><th>Id</th><th>Email</th><th>Firstname</th><th>Lastname</th><th>Date Subscribed</th><th>Validity</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] ."</td><td>" . $row["email"].  "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname']  .  "</td><td>" . 
        $row['date_subscribed'] . "</td><td>" . $row['validity'] .  "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?> 
</body>
</html>
