<?php
session_start();
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

// Checking if the user is logged in
if (!isset($_SESSION['email'])) {
    // User is not logged in, redirecting to the login page
    header('Location: login_sign.php');
    exit();
}

// Retrieving user's email from the session
if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];

    // Fetching user's listed properties from the database
    $listedProperties = array();

    // Perform a database query to fetch the properties associated with the user's email
    $query = "SELECT property_name FROM property
              WHERE author IN (SELECT id FROM users WHERE email = '$user_email')";

    $result = $conn->query($query);

    // Check if the query executed successfully
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $listedProperties[] = $row['property_name'];
        }
    } else {
        echo "Error executing query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Head content remains the same -->
</head>

<body>
    <div>
        <header>
            <!-- Header content remains the same -->
        </header>

        <main>
            <section>
                <h2>Your Listed Property</h2>
                <?php if (!empty($listedProperties)) : ?>
                    <ul>
                        <?php foreach ($listedProperties as $property) : ?>
                            <li><?php echo $property; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No properties listed.</p>
                <?php endif; ?>
            </section>
        </main>

        <footer>
            <!-- Footer content remains the same -->
        </footer>
    </div>
    <!-- Include any necessary scripts here -->
</body>

</html>