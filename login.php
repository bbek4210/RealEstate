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

$query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";
$result = mysqli_query($conn, $query);

// Checking if the user is found
if (mysqli_num_rows($result) == 1) {
  // User was found, do something here 

  // Fetching the user data from the result
  $user = mysqli_fetch_assoc($result);


  // Storing the email in the session
  $_SESSION['email'] = $email;
  $_SESSION['firstname'] = $user['firstname'];
  $_SESSION['lastname'] = $user['lastname'];



  // Set the authorized session variable
  $_SESSION['authorized'] = true;

  // Redirecting to the  home page
  header('Location: realestate.php');
  exit();
} else {
  // User was not found or login credentials are incorrect,
  // Redirecting to the login page
  header('Location: loginunsucess.html');
  exit();
}
