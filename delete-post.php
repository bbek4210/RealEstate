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
    // Geting the post ID from the request
    $postId = $_POST['post-id'];

    // Performing post deletion logic here
    $success = deletePostByPid($conn, $postId);

    // Preparing the response
    $response = [
        'success' => $success,
        'message' => $success ? 'Post deleted successfully.' : 'Failed to delete the post.'
    ];

    // Sending the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function deletePostByPid($conn, $postId)
{
    // Implement your post deletion logic here


    $sql = "DELETE FROM property WHERE pid = $postId";

    return $conn->query($sql) === TRUE;
}

$conn->close();
