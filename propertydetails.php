<html>

<head>
    <title>Property Details</title>

    <link href="propertydetails.css" rel="stylesheet" type="text/css" />

<body>

    <?php
    // Starting the session
    session_start();

    // Checking if the user is authorized
    if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
        // if User is not authorized, redirectinh to the login page
        header('Location: login_sign.php');
        exit();
    }


    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dreamghar";

    // Creating connection
    $conn = new mysqli($host, $username, $password, $dbname);



    if (isset($_GET['id'])) {
        $propertyId = $_GET['id'];


        // Retrieving property details from the database based on the property ID
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

                // Displaying property details
                echo '<h2>' . $propertyName . '</h2>';
                echo '<p>Price: ' . $propertyPrice . '</p>';

                // Creating a gallery layout for property images
                echo '<div class="property-gallery">';
                echo '<div class="property-image"><img src="admin/property/' . $propertyImage1 . '" alt="Property Image 1"></div>';
                echo '<div class="property-image"><img src="admin/property/' . $propertyImage2 . '" alt="Property Image 2"></div>';
                echo '<div class="property-image"><img src="admin/property/' . $propertyImage3 . '" alt="Property Image 3"></div>';
                echo '</div>';
            } else {
                echo 'No property found with ID: ' . $propertyId;
            }
        } else {
            echo 'Query failed: ' . mysqli_error($conn);
        }
    } else {
        echo 'Invalid property ID.';
    }
    ?>

</body>

</html>