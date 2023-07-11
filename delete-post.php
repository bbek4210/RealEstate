<?php
// delete-post.php

// Include your database connection code here
// Replace 'your_database_connection_code' with your actual code

// Example code using MySQLi
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
    // Get the post ID from the request
    $postId = $_POST['post-id'];

    // Perform post deletion logic here
    $success = deletePostByPid($conn, $postId);

    // Prepare the response
    $response = [
        'success' => $success,
        'message' => $success ? 'Post deleted successfully.' : 'Failed to delete the post.'
    ];

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function deletePostByPid($conn, $postId)
{
    // Implement your post deletion logic here
    // Perform the SQL deletion statement based on your database schema

    $sql = "DELETE FROM property WHERE pid = $postId";

    return $conn->query($sql) === TRUE;
}

$conn->close();
