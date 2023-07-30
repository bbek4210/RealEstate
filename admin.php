<?php


$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";

// Creating connection
$conn = new mysqli($host, $username, $password, $dbname);

// Starting the session
session_start();




$email =  $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";
$result = mysqli_query($conn, $query);

// Checking if the user is found

if (mysqli_num_rows($result) == 1) {
    // User was found, do something here 

    // Storing the email in the session
    $_SESSION['email'] = $email;

    // Redirecting to the home page
    header('Location: adminpage.php');
    exit();
} else {
    // User was not found  or login details incorrect, showing an error message
    // Redirecting to the login page
    header('Location: adminloginunsucess.html');
    exit();
}
