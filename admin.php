<?php


$host = "localhost"; // host name
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave blank if you haven't set one)
$dbname = "dreamghar"; // name of the database you want to connect to

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Start the session
session_start();

// Check if the user is already logged in
// if(isset($_SESSION['email'])){
//   header('Location: realestate.html');
//   exit();
// }


$email =  $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if the user is found

if (mysqli_num_rows($result) == 1) {
    // User was found, do something here (e.g. set session data and redirect to another page)

    // Store the email in the session
    $_SESSION['email'] = $email;

    // Redirect to the dashboard or home page
    header('Location: adminpage.html');
    exit();
} else {
    // User was not found or login credentials are incorrect, show an error message
    // Redirect to the login page
    header('Location: adminloginunsucess.html');
    exit();
}
