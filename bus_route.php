<?php 
  require 'conn.php';

  $sql = "SELECT * FROM bus_route R inner join bus B on R.plate = B.plate
          inner join bus_driver D on  D.driver_id = B.driver_id";
  $response = mysqli_query($conn, $sql);
  $result=array();
  $result['route'] = array();


if(mysqli_num_rows($response)>=1){

  while($row = mysqli_fetch_assoc($response)){

  $index['origin'] = $row['origin'];
  $index['destination'] = $row['destination'];
  $index['name'] = $row['name'];
  $index['route_description'] = $row['route_description'];
  $index['plate#'] = $row['plate'];
  

  array_push($result['route'], $index);

  }
}
  echo json_encode($result);
  mysqli_close($conn);


?>
