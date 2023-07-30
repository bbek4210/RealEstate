<?php


// Starting the session
session_start();

// Clearing all session variables
session_unset();

// Destroying the session
session_destroy();

// Redirecting to the login page or any other desired page
header('Location: login_sign.php');
exit();
