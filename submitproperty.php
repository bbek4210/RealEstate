<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);



// Starting the session
session_start();

// Checking if the user is authorized
if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] !== true) {
    // User is not authorized, redirecting to the login page
    header('Location: login_sign.php');
    exit();
}



$host = "localhost";
$username = "root";
$password = "";
$dbname = "dreamghar";

// Creating connection
$conn = new mysqli($host, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$error = "";
$msg = "";



if (isset($_POST['add'])) {
    echo ("Uploading111");
    $property_name = $_POST['property_name'];
    $type = $_POST['ptype'];
    $bedroom = $_POST['bed'];
    $stype = $_POST['stype'];
    $bathroom = $_POST['bath'];
    $kitchen = $_POST['kitc'];
    $price = $_POST['price'];
    $city = $_POST['city'];
    $size = $_POST['asize'];
    $author = $_POST['author'];
    $number = $_POST['number'];
    $location = $_POST['loc'];



    $temp_name = $_FILES['aimage']['tmp_name'];
    $temp_name1 = $_FILES['aimage1']['tmp_name'];
    $temp_name2 = $_FILES['aimage2']['tmp_name'];


    $aimage = $_FILES['aimage']['name'];
    $aimage1 = $_FILES['aimage1']['name'];
    $aimage2 = $_FILES['aimage2']['name'];

    move_uploaded_file($temp_name, "admin/property/$aimage");
    move_uploaded_file($temp_name1, "admin/property/$aimage1");
    move_uploaded_file($temp_name2, "admin/property/$aimage2");

    // echo $property_name;

    $sql = "INSERT INTO property (type, stype, bedroom, bathroom, kitchen, size, price, location, city, pimage, pimage1, pimage2, property_name,author,number)
    VALUES ('$type', '$stype', '$bedroom', '$bathroom', '$kitchen', '$size', '$price', '$location', '$city', '$aimage', '$aimage1', '$aimage2', '$property_name','$author','$number')";


    $result = mysqli_query($conn, $sql);

    echo $result;

    if ($result) {
        // Redirect to the home page
        header('Location: realestate.php');
    } else {
        // User was not found or login credentials are incorrect, show an error message
        // Redirect to the login page

        header('Location: login_sign.php');
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submitproperty</title>
    <link rel="stylesheet" href="submitproperty.css" </head>

<body>

    <div>
        <header>
            <nav>
                <a href="realestate.php"><img src="logo.png" alt="Dream Ghar Logo" /></a>
                <ul style="display: flex; justify-content: flex-end">
                    <li><a href="realestate.php" id="hover">Home</a></li>

                    <li><a href="about.html" id="hover">About</a></li>
                    <li><a href="contactpage1.php" id="hover">Contact</a></li>

                    <li><a href="logout.php" id="hover">LogOut</a></li>

                </ul>
            </nav>
        </header>

        <div class="container">
            <div class="form-container">
                <form method="post" action="submitproperty.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="property-type">
                            <b>
                                <h1 style="color: #007bff">Property Type</h1> </label>
                        <select class="form-control" id="property-type" required name="ptype">
                            <option value="">Select Type</option>
                            <option value="apartment">Apartment</option>
                            <option value="flat">Flat</option>
                            <option value="house">House</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="property_name">
                            <b>
                                <h1 style="color: #007bff">Name of property</h1> </label>
                        <input type="text" class="form-control" id="property_name" name="property_name" required placeholder="Enter name of property" />
                    </div>

                    <div class="form-group">
                        <label for="selling-type">
                            <b>
                                <h1 style="color: #007bff">Selling Type</h1> </label>
                        <select class="form-control" id="selling-type" required name="stype">
                            <option value="">Select Status</option>
                            <option value="rent">Rent</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="author">
                            <b>
                                <h1 style="color: #007bff">Your Name</h1>
                            </b>
                        </label>
                        <input type="text" class="form-control" id="author" name="author" required placeholder="Enter your name" pattern="[A-Za-z\s]+" />
                    </div>



                    <div class="form-group">
                        <label for="number">
                            <b>
                                <h1 style="color: #007bff">Your PhoneNumber</h1>
                            </b>
                        </label>
                        <input type="text" class="form-control" id="number" name="number" required placeholder="Enter your phone number" pattern="[0-9]{10}" />
                    </div>


                    <div class="form-group">
                        <label for="bathroom">
                            <b>
                                <h1 style="color: #007bff">Bathroom</h1> </label>
                        <input type="text" class="form-control" id="bathroom" name="bath" required placeholder="Enter Bathroom ( 1 to 10)" pattern="[1-9]|10" />
                    </div>

                    <div class="form-group">
                        <label for="kitchen">
                            <b>
                                <h1 style="color: #007bff">Kitchen</h1> </label>
                        <input type="text" class="form-control" id="kitchen" name="kitc" required placeholder="Enter Kitchen (1 to 10)" pattern="[1-9]|10" />
                    </div>

                    <div class="form-group">
                        <label for="bedroom">
                            <b>
                                <h1 style="color: #007bff">Bedroom</h1> </label>
                        <input type="text" class="form-control" id="bedroom" name="bed" required placeholder="Enter Bedroom (1 to 10)" pattern="[1-9]|10" />
                    </div>

                    <div class="form-group">
                        <label for="price">
                            <b>
                                <h1 style="color: #007bff">Price</h1> </label>
                        <input type="text" class="form-control" id="price" name="price" required placeholder="Enter Price" pattern="\d+(\.\d+)?" />
                    </div>

                    <div class="form-group">
                        <label for="city">
                            <b>
                                <h1 style="color: #007bff">City</h1> </label>
                        <input type="text" class="form-control" id="city" name="city" required placeholder="Enter City" pattern="^(?=.*[a-zA-Z])[\w\s]+$" />
                    </div>
                    <div class="form-group">
                        <label for="area-size">
                            <b>
                                <h1 style="color: #007bff">Area-size</h1>
                            </b>
                        </label>
                        <input type="text" class="form-control" id="area-size" name="asize" required placeholder="Enter Area Size (in sqft or sqm)" pattern="\d+(\.\d+)?\s*(?:sqft|sqm)?" />
                    </div>


                    <div class="form-group">
                        <label for="address">
                            <b>
                                <h1 style="color: #007bff">Address</h1> </label>
                        <input type="text" class="form-control" id="address" name="loc" required placeholder="Enter Address" pattern="^(?=.*[a-zA-Z])[\w\s]+$" />
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">
                                    <b>
                                        <h1 style="color: #007bff">Image 1</h1> </label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="aimage" type="file" required="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">
                                    <b>
                                        <h1 style="color: #007bff">Image 2</h1> </label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="aimage1" type="file" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">
                                    <b>
                                        <h1 style="color: #007bff">Image 3</h1> </label>
                                <div class="col-lg-9">
                                    <input class="form-control" name="aimage2" type="file" />
                                </div>
                            </div>

                            <input type="submit" value="Submit Property" class="btn btn-info" name="add" style="margin-left:200px;margin-top: 10px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


</body>

</html>