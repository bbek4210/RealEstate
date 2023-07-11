<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the request
    $email = $_POST['email'];

    // Perform user deletion logic here
    $success = deleteUserByEmail($conn, $email);

    // Prepare the response
    $response = [
        'success' => $success,
        'message' => $success ? 'User deleted successfully.' : 'Failed to delete the user.'
    ];

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function deleteUserByEmail($conn, $email)
{
    // Implement your user deletion logic here
    // Perform the SQL deletion statement based on your database schema

    $sql = "DELETE FROM users WHERE email = '$email'";

    return $conn->query($sql) === TRUE;
}

$conn->close();
