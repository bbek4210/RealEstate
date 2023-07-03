<?php
// Start the session
session_start();

// Check if the user is authorized
if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
    // User is not authorized, redirect to the login page
    header('Location: login.html');
    exit();
}


$host = "localhost"; // host name
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave blank if you haven't set one)
$dbname = "dreamghar"; // name of the database you want to connect to

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// $id = $_GET['id'];

// // Display property listings
// $sql = "SELECT * FROM property";
// $result = mysqli_query($conn, $sql);

// while ($row = mysqli_fetch_assoc($result)) {
//     $propertyId = $row['id'];
//     $propertyType = $row['type'];
//     $propertyImage = $row['pimage'];
//     $propertyName = $row['property_name'];
//     $propertyPrice = $row['price'];

//     echo '<div class="property-listing">';
//     echo '<img src="admin/property/' . $propertyImage . '" alt="Property Image">';
//     echo '<h2>' . $propertyName . '</h2>';
//     echo '<p>Price: $' . $propertyPrice . '</p>';
//     echo '<a href="propertydetails.php?id=' . $propertyId . '"><button>View Details</button></a>';
//     echo '</div>';
// }

// ...

// property_details.php

// ...

if (isset($_GET['id'])) {
    $propertyId = $_GET['id'];
    // echo 'Property ID: ' . $propertyId; // Debug statement

    // Retrieve property details from the database based on the property ID
    $sql = "SELECT * FROM property WHERE pid = '$propertyId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $propertyType = $row['type'];
            $propertyImage1 = $row['pimage'];
            $propertyImage2 = $row['pimage1'];
            $propertyImage3 = $row['pimage2'];
            $propertyName = $row['property_name'];
            $propertyPrice = $row['price'];

            // Display property details
            echo '<h2>' . $propertyName . '</h2>';
            echo '<p>Price: ' . $propertyPrice . '</p>';
            echo '<img src="admin/property/' . $propertyImage1 . '" alt="Property Image 1">';
            echo '<img src="admin/property/' . $propertyImage2 . '" alt="Property Image 2">';
            echo '<img src="admin/property/' . $propertyImage3 . '" alt="Property Image 3">';

            // You can display additional details here if needed
        } else {
            echo 'No property found with ID: ' . $propertyId; // Debug statement
        }
    } else {
        echo 'Query failed: ' . mysqli_error($conn); // Debug statement
    }
} else {
    echo 'Invalid property ID.';
}
