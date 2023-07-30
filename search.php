<?php
// Establishing a database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";
$conn = new mysqli($host, $username, $password, $dbname);

// Checking for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checking if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieving the form data
    $location = $_GET['location'];
    $sellingType = $_GET['stype'];

    // Preparing the SQL query based on the search parameters
    $sql = "SELECT * FROM property";
    $whereClause = [];
    if (!empty($location)) {
        $whereClause[] = "location LIKE '%$location%'";
    }
    if (!empty($sellingType)) {
        $whereClause[] = "stype = '$sellingType'";
    }
    if (!empty($whereClause)) {
        $sql .= " WHERE " . implode(" AND ", $whereClause);
    }


    // Executing the query
    $result = $conn->query($sql);

    // Handling the search results
    $searchListings = [];
    if ($result->num_rows > 0) {
        // Fetching the search results as an associative array
        while ($row = $result->fetch_assoc()) {
            $searchListings[] = $row;
        }
    }
}

// Closing the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>DreamGhar - Property Listing.</title>
    <link rel="stylesheet" href="realestate.css">
</head>

<body>
    <div>
        <header>
            <nav>
                <a href="realestate.php"><img src="logo.png" alt="Dream Ghar Logo" /></a>
                <ul>
                    <li><a href="realestate.php" id="hover">Home</a></li>

                    <li>
                        <a href="submitproperty.html" id="hover">Submit Property</a>
                    </li>
                    <li><a href="about.html" id="hover">About</a></li>
                    <li><a href="contactpage1.php" id="hover">Contact</a></li>
                   
                </ul>
            </nav>
        </header>
       
        <section id="search-listings">
            <h2>Search Listings</h2>

            <form action="search.php" method="get">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" placeholder="City, Province or Tole">

                <label for="stype">Selling Type:</label>
                <select id="stype" name="stype">
                    <option value="">Select Selling Type</option>
                    <option value="rent">Rent</option>
                    <option value="sale">Sale</option>
                </select>

                <button type="submit" style="
    margin-top: 100px;
    margin-right: 50px;
">Search</button>
            </form>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($searchListings) && !empty($searchListings)) { ?>
                <h3>Search Results</h3>
                <ul>
                    <?php foreach ($searchListings as $listing) { ?>
                        <li>
                            <img src="./admin/property/<?php echo $listing['pimage']; ?>" width="600" height="300" alt="Listing Image">
                            <div class="listing-info">
                                <h1><?php echo $listing['property_name']; ?></h1>
                                <h3><?php echo $listing['location']; ?></h3>
                                <p>Type: <?php echo $listing['stype']; ?></p>
                                <p>Area: <?php echo $listing['size']; ?> sqft</p>
                                <p><b>Posted By:</b> <?php echo $listing['author']; ?></p>
                                <p><b>Contact Number:</b> <?php echo $listing['number']; ?></p>
                                <button style="margin-bottom: 10px;"><a href="propertydetails.php?id=<?php echo $listing['pid']; ?>">View Details</a></button>
                                <br>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($location) && !empty($sellingType) && empty($searchListings)) { ?>
                <p>No results found.</p>
            <?php } ?>
        </section>
        

        <footer>
           
            <p>&copy; DreamGhar-Property Listing</p>
        </footer>
    </div>
    <script src="realestate.js"></script>
</body>

</html>