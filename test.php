<?php 

require 'conn.php';


$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$sql = 	"INSERT INTO users (firstname, lastname) VALUES ('wew', 'wew')";	

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>