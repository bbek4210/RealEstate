
document.getElementById('search-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent form submission

  // Get the values from the form inputs
  var location = document.getElementById('location').value;
  var bedrooms = document.getElementById('bedrooms').value;
  var bathrooms = document.getElementById('bathrooms').value;
  var minPrice = document.getElementById('min-price').value;
  var maxPrice = document.getElementById('max-price').value;

  // Perform the search operation based on the collected values
  // You can use AJAX to send the search criteria to the server and retrieve matching results
  // Display the search results on the webpage accordingly
});



<?php
// search.php

// Retrieve the search criteria from the request
$searchData = json_decode(file_get_contents('php://input'), true);

// Extract the search criteria
$location = isset($searchData['location']) ? $searchData['location'] : null;
$bedrooms = $searchData['bedrooms'];
$bathrooms = $searchData['bathrooms'];
$minPrice = $searchData['minPrice'];
$maxPrice = $searchData['maxPrice'];

// Perform the search operation based on the criteria
// Example: Query the database with the search criteria
// Replace this with your actual database query logic

// Connect to the database (replace db_host, db_username, db_password, db_name with your database credentials)
$mysqli = new mysqli('db_host', 'db_username', 'db_password', 'db_name');

// Construct the SQL query based on the search criteria
$sql = "SELECT * FROM listings WHERE 1=1";

if ($location !== null) {
  $sql .= " AND location LIKE '%$location%'";
}

if ($bedrooms !== 'any') {
  $sql .= " AND bedrooms >= $bedrooms";
}

if ($bathrooms !== 'any') {
  $sql .= " AND bathrooms >= $bathrooms";
}

if (!empty($minPrice)) {
  $sql .= " AND price >= $minPrice";
}

if (!empty($maxPrice)) {
  $sql .= " AND price <= $maxPrice";
}

// Execute the query
$result = $mysqli->query($sql);

// Process the search results
$searchResults = array();
if ($result) {
  while ($row = $result->fetch_assoc()) {
    // Store each row of data in the searchResults array
    $searchResults[] = $row;
  }
}

// Return the search results as JSON
header('Content-Type: application/json');
echo json_encode($searchResults);
?>
