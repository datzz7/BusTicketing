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

$currentdate = date("Y/m/d");

$d = strtotime("+7 Day");
$validitydate = date("Y/m/d", $d);

$sql = "SELECT * FROM default_prices ORDER BY case when type ='7Days' then 1 else 2 end, type ASC";

$result = $conn-> query($sql);

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
    <th>Type</th>
    <th>Name</th>
    <th>Price</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["type"] ."</td><td>" . $row["name"].  "</td><td>" . $row['price'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<table>
    <tr>
    <th>Type</th>
    <th>Name</th>
    <th>Price</th>
    </tr>";
    
        echo "<tr><td>" ."0" ."</td><td>" ."0".  "</td><td>" . "0" . "</td></tr>";
    echo "</table>";
}

$conn->close();
?> 
</body>
</html>
