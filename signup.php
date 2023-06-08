<?php

$host = "localhost"; // host name
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave blank if you haven't set one)
$dbname = "dreamghar"; // name of the database you want to connect to

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";




//

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

if(isset($_POST['submit'])){
    
    $firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];
$address =  $_POST['address'];

$email = $_POST['email'];
$password = $_POST['password'];
}

    
  
  

// Insert data into the database
$sql = "INSERT INTO users (firstname, lastname, email, gender,password,address) VALUES ('$firstname', '$lastname', '$email','$gender','$password','$address')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();







// print "<br>";
// print "firstname: $firstname";
// print "<br>";
// print "lastname: $lastname";
// print "<br>";
// print "gender: $gender";
// print "<br>";
// print "address: $address";
// print "<br>";
// print "email: $email";
// print "<br>";
// print "password: $password";
// print "<br>";


 header("Location: signupsucess.html");
 exit;

?>