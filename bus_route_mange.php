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

$sql = "SELECT * FROM bus_route R inner join bus B on R.plate = B.plate 
          inner join bus_driver D on  D.driver_id = B.driver_id";
$result = $conn-> query($sql);


if ($result->num_rows > 0) {
       echo "<table>
       <tr>
       <th>Plate #</th>
       <th>Driver</th>
       <th>Origin</th>
       <th>Destination</th>
       <th>Route Description</th>
       </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["plate"] ."</td><td>" . $row["name"].  "</td><td>" . $row['origin'] . "</td><td>" . $row['destination']  .  "</td><td>" . $row['route_description'] . "</td></tr>";
    }
    echo "</table>";
 } 
$conn->close();
?> 
</body>
</html>
