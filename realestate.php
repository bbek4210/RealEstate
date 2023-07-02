<?php



// ini_set('session.cache_limiter', 'public');
// session_cache_limiter(false);
// include("config.php");
$host = "localhost"; // host name
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave blank if you haven't set one)
$dbname = "dreamghar"; // name of the database you want to connect to

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>DreamGhar - Property Listing.</title>
  <link rel="stylesheet" href="realestate.css" />
</head>

<body>
  <div>
    <header>
      <nav>
        <img src="logo.png" alt="Dream Ghar Logo" />
        <ul style="display: flex; justify-content: flex-end">

          <li>
            <a href="submitproperty.php" id="hover">Submit Property</a>
          </li>

          <li><a href="about.html" id="hover">About</a></li>
          <li><a href="contactpage1.html" id="hover">Contact</a></li>
          <li><a href="login.html" id="hover">Login</a></li>
          <li><a href="logout.php" id="hover">LogOut</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="featured-listings">
        <h2>Featured Listings</h2>
        <ul>
          <?php $query = mysqli_query($conn, "SELECT * FROM `property` ");
          while ($row = mysqli_fetch_array($query)) {

          ?>

            <li>
              <img src="./admin/property/<?php echo $row['10']; ?>" width="600" height="300" alt="Listing Image" />
              <div class="listing-info">
                <h1><?php echo $row['pid']; ?></h1>
                <h3><?php echo $row['8']; ?>, <?php echo $row['9']; ?></h3>
                <p> Type : On <?php echo $row['2']; ?></p>
                <p> Area : <?php echo $row['6']; ?>sqft</p>
                <p><b>Posted By</b> : <?php echo $row['14']; ?></p>
                <p><b>Contact Number : </b> <?php echo $row['15']; ?></p>
                <button><a href="propertydetails.php?id=<?php echo $row['0']; ?>">View Details</a></button>


              </div>
            </li>
          <?php } ?>

        </ul>
      </section>

      <section id="search-listings">
        <h2>Search Listings</h2>

        <form action="search.php" method="get">
          <label>Location:</label>
          <input type="text" id="location" name="location" placeholder="City,Province or Tole" />

          <label for="stype">Selling Type:</label>
          <select name="stype">
            <option value="">Select Selling Type</option>
            <option value="rent">Rent</option>
            <option value="sale">Sale</option>
          </select>


          <button type="submit">Search</button>
        </form>
      </section>
    </main>

    <footer>
      <p>&copy; DreamGhar-Property Listing</p>
    </footer>
  </div>
  <script src="realestate.js"></script>
</body>

</html>