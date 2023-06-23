<?php



$searchData = json_decode(file_get_contents('php://input'), true);


$location = isset($searchData['location']) ? $searchData['location'] : null;
$bedrooms = $searchData['bedrooms'];
$bathrooms = $searchData['bathrooms'];
$minPrice = $searchData['minPrice'];
$maxPrice = $searchData['maxPrice'];

// Perform the search operation based on the criteria
// Example: Query the database with the search criteria
// Replace this with your actual database query logic

// Connect to the database (replace db_host, db_username, db_password, db_name with your database credentials)
$mysqli = new mysqli('localhost', 'root', " ", 'dreamghar');

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


$result = $mysqli->query($sql);


$searchResults = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {

        $searchResults[] = $row;
    }
}


header('Content-Type: application/json');
echo json_encode($searchResults);
