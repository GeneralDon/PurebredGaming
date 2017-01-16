<?php
$servername = "localhost";
$username = "puresjhh_dbwrite";
$password = "q8sJk=~bQ6Q4";
$dbname = "puresjhh_base_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$email_address = mysqli_real_escape_string($conn, $_POST['email']);

if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
  die("Invalid email format");
}

$date = date("Y-m-d H:i:s");


$sql = "INSERT INTO Enterprise (email, date)
VALUES ('$email_address', '$date')";

if ($conn->query($sql) === TRUE) {

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

header("Location: https://www.purebredgaming.com/styles/enterprise.html")

?>