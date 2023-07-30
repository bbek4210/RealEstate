<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Geting the email from the request
    $email = $_POST['email'];

    // Performing user deletion logic here
    $success = deleteUserByEmail($conn, $email);

    // Preparing the response
    $response = [
        'success' => $success,
        'message' => $success ? 'User deleted successfully.' : 'Failed to delete the user.'
    ];

    // Sending the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function deleteUserByEmail($conn, $email)
{
    // Implementing user deletion logic here
    // Performing the SQL deletion statement based on database schema

    $sql = "DELETE FROM users WHERE email = '$email'";

    return $conn->query($sql) === TRUE;
}

$conn->close();
