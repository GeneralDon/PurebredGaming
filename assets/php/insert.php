<?php
$servername = "localhost:3306";
$username = "puresjhh_dbwrite";
$password = "q8sJk=~bQ6Q4";
$dbname = "puresjhh_base_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email_address = mysqli_real_escape_string($link, $_POST['email']);
$date = mysqli_real_escape_string($link, $_POST['date']);


$sql = "INSERT INTO Base (email, date)
VALUES ('$email_address', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>